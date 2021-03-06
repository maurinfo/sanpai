<div class="modal hide fade" tabindex="-1" id="sales_add_item_modal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Add / Update Sales Item</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form class="modal-form" method="POST" action="" name="ajx">
               <input type="hidden" class="form-control" name="id"/>
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title">Manifest No.</h4>
                        <div class="input-group">
                           <input type="number" class="form-control" name="referenceno" placeholder="Manifest Number" value="" required readonly/>
                           <input type="hidden" class="form-control" name="manifestid"/>
                           <div class="input-group-append">
                              <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#manifest_search_modal"></button>
                           </div>
                        </div>
                        <br>
                        <h4 class="example-title"> Date</h4>
                        <span class="text-danger"><?=form_error('datesale');?></span>
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="icon md-calendar" aria-hidden="true"></i>
                           </span>
                           <input type="text" class="form-control" data-plugin="datepicker" name="datedelivered"
                              value="" required>
                        </div>
                        <br>
                        <h4 class="example-title">Contractor Branch</h4>
                        <div class="input-group">
                           <input type="text" name="contractorbranch_name" class="form-control" placeholder="Contractor Branch" required>
                        </div>
                        <br>
                        <h4 class="example-title">Waste Name</h4>
                        <div class="input-group">
                           <input type="text" class="form-control" name="item_name" placeholder="Waste Name" value="" readonly required/>
                           <input type="text" name="itemid" value="" class="hidden"/>
                           <div class="input-group-append">
                              <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#waste_search_modal"></button>
                           </div>
                        </div>
                        <br>
                        <h4 class="example-title">Description</h4>
                        <div class="input-group">
                           <input type="text" name="spec" class="form-control" placeholder="Description">
                        </div>
                        <br>
                     </div>
                     <div class="col-lg-6">
                        <h4 class="example-title">Quantity</h4>
                        <div class="input-group">
                           <input type="float" onChange="handlesQuantityAndPriceOnChange()" name="qty" class="form-control" placeholder="Quantity" required>
                        </div>
                        <br>
                        <h4 class="example-title">Unit</h4>
                        <div class="input-group">
                           <select id="itemunit_option" data-plugin="selectpicker" name="itemunitid">
                              <option value="0" dislable selected>Select Unit</option>
                              <?php foreach ($itemunits as $itemunit): ?>
                                 <?="<option value='" . $itemunit['id'] . "'>" . $itemunit['name'] . "</option>"?>
                              <?php endforeach;?>
                           </select>
                           <input type="hidden" name="itemunit_name"/>
                        </div>
                        <br>
                        <h4 class="example-title">Price</h4>
                        <div class="input-group">
                           <input type="number" onChange="handlesQuantityAndPriceOnChange()" name="price" class="form-control" placeholder="Price" required/>
                        </div>
                        <br>
                        <h4 class="example-title">Amount</h4>
                        <div class="input-group">
                           <input type="number" name="amount" class="form-control" placeholder="Amount" readonly>
                        </div>
                        <br>
                     </div>
                  </div>
                  <div class="float-right">
                     <button type="submit" class="btn btn-success" >Save</button>
                     <button id="sales_form_reset" type="reset" class="btn btn-warning">Clear</button>
                     <button id="sale_close_modal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
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

   $("#sale_close_modal").on("click", function() {
      resetForm();
   });

   $("#sales_form_reset").on("click", function() {
      $("[name=itemunitid]")
         .val(0)
         .change();
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
         const row = `
         <tr id="item-${key}">
            <td>${key + 1}</td>
            <td>${item.datedelivered}</td>
            <td>${item.referenceno}</td>
            <td>${item.contractorbranch_name}</td>
            <td>${item.item_name}</td>
            <td>${item.spec}</td>
            <td>${item.qty}</td>
            <td>${item.itemunit_name}</td>
            <td>${item.price}</td>
            <td>${item.amount}</td>
            <td class="actions">
               <a href="javascript:handlesEditItem(${key})" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Edit">
                  <i class="icon md-edit" aria-hidden="true"></i>
               </a>
               <a href="javascript:handlesDeleteItem(${key})" class="btn btn-sm btn-icon btn-pure btn-default on-default" data-toggle="tooltip" data-original-title="Remove">
                  <i class="icon md-close" aria-hidden="true"></i>
               </a>
            </td>
         </tr>`;
         $("#itemlist tbody").append(row);
      });

      updateTotal();
   }

   function updateTotal() {
      const { subtotal, tax, total } = getTotals();

      $("[name=subtotal]").val(subtotal);
      $("[name=tax]").val(tax);
      $("[name=total]").val(total);
   }

   function getTotals() {
      let subtotal = saleitems.reduce((sum, i) => +sum + +i.amount, 0);
      let tax;

      tax = Math.floor(subtotal * (taxrate / 100));

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
