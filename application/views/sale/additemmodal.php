<script>
   let saleitems = <?=$saleitems ? json_encode($saleitems) : "[]"?>;
   let itemToUpdate = null;

   $(".modal-form").on("submit", function(e) {
      e.preventDefault();

      const inputs = {};
      $(this)
         .serializeArray()
         .map(v => (inputs[v.name] = v.value));

      if (itemToUpdate === null) {
         saleitems.push(inputs);
      } else {
         saleitems[saleitems.indexOf(itemToUpdate)] = inputs;
      }

      itemToUpdate = null;

      updateItemUI();
      $(".modal-form #sale_close_modal").click();
   });

   $("#itemunit_option").on("change", function() {
      $("#sales_add_item_modal input[name=itemunit_name]").val(
         $(this)
            .find("option:selected")
            .text()
      );
   });

   function handlesDeleteItem(itemId) {
      saleitems = saleitems.filter((item, key) => key !== itemId);
      updateItemUI();
   }

   function handlesEditItem(itemId) {
      loadFormValues(itemId);
      $("#sales_additem_btn").click();
   }

   function handlesQuantityAndPriceOnChange() {
      const amount = $("[name=qty]").val() * $("[name=price]").val();
      $("[name=amount]").val(amount);
   }

   function loadFormValues(itemId) {
      itemToUpdate = saleitems.find((item, key) => key === itemId);
      for (key in itemToUpdate) {
         $(`#sales_add_item_modal [name=${key}]`).val(itemToUpdate[key]);
      }
      $("[name=itemunitid]").change();
   }

   function updateItemUI() {
      $("#itemlist tbody").empty();
      saleitems.forEach((item, key) => {

         if (item.referenceno == null) {item.referenceno = ''};
         if (item.contractorbranch_name == null) {item.contractorbranch_name = ''};
         item.qty = Number(item.qty);
         item.price = Math.floor(item.price);
         item.amount = Math.floor(item.amount);

         const row = createRow(item, key, key == 0)
         $("#itemlist tbody").append(row);
      });

      updateTotal();
   }

   function createRow(item, key, isEdit) {
      return `
         <tr id="item-${key}">
            <td>${key + 1}</td>
            <td>${item.datedelivered}</td>
            <td>${isEdit ? createIcon('handlesEditItem', key, 'Date', 'calendar', 'success') : ''}</td>
            <td>${item.referenceno}</td>
            <td>${item.contractorbranch_name}</td>
            <td>${isEdit ? createIcon('handlesEditItem', key, 'Contractor Branch', 'plus', 'success') : ''}</td>
            <td>${item.item_name}</td>
            <td>${isEdit ? createIcon('handlesEditItem', key, 'Waste', 'plus', 'success') : ''}</td>
            <td>${item.spec}</td>
            <td>${item.qty}</td>
            <td>${item.itemunit_name}</td>
            <td>${isEdit ? createIcon('handlesEditItem', key, 'Unit', 'plus', 'success') : ''}</td>
            <td>${item.price}</td>
            <td>${item.amount}</td>
            <td class="actions">
               ${createIcon('handlesEditItem', key, 'Edit', 'edit',)}
               ${createIcon('handlesEditItem', key, 'Close','close')}
            </td>
         </tr>`;
   }

   function createIcon(eventHandler, key, toolTipCaption, icon, btnType = 'default') {
      const tbnPure = btnType == 'default' ? 'btn-pure' : '';
      return `
         <a href="javascript:${eventHandler}(${key})"
            class="btn btn-xs btn-icon ${tbnPure} btn-${btnType}"
            data-toggle="tooltip" data-original-title="${toolTipCaption}">
            <i class="icon md-${icon}"></i>
         </a>`;
   }

   function updateTotal() {
      const { subtotal, tax, total } = getTotals();

      $("[name=subtotal]").val(subtotal);
      $("[name=tax]").val(tax);
      $("[name=total]").val(total);
   }

   function getTotals() {
      let subtotal = saleitems.reduce((sum, i) => +sum + +i.amount, 0);
      let tax = Math.floor(subtotal * (taxrate / 100));

      return {
         subtotal: subtotal,
         tax: tax,
         total: subtotal + tax
      };
   }

   function resetForm() {
      $(".modal-form #sales_form_reset").click();
      $("[name=itemunitid]")
         .val(0)
         .change();
   }

   $(document).ready(function() {
      updateItemUI();
      console.log(saleitems);
   });

</script>
