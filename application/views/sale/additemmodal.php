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
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title"> Date</h4>
                        <span class="text-danger"><?=form_error('dateSale');?></span>
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="icon md-calendar" aria-hidden="true"></i>
                           </span>
                           <input type="text" class="form-control" data-plugin="datepicker" name="dateSale"
                              value="" required>
                        </div>
                        <br>
                        <h4 class="example-title">Manifest No.</h4>
                        <div class="input-group">
                           <input type="number" class="form-control" name="manifestNo" placeholder="Manifest Number" value="" required/>
                           <div class="input-group-append">
                              <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#manifest_search_modal"></button>
                           </div>
                        </div>
                        <br>
                        <h4 class="example-title">Contractor Branch</h4>
                        <div class="input-group">
                           <input type="text" name="contractorBranch" class="form-control" placeholder="Contractor Branch" required>
                        </div>
                        <br>
                        <h4 class="example-title">Waste Name</h4>
                        <div class="input-group">
                           <input type="text" class="form-control" name="wasteName" placeholder="Waste Name" value="" required/>
                           <div class="input-group-append">
                              <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#wasteName-search-modal"></button>
                           </div>
                        </div>
                        <br>
                        <h4 class="example-title">Description</h4>
                        <div class="input-group">
                           <input type="text" name="description" class="form-control" placeholder="Description">
                        </div>
                        <br>
                     </div>
                     <div class="col-lg-6">
                        <h4 class="example-title">Quantity</h4>
                        <div class="input-group">
                           <input type="number" onChange="handlesQuantityAndPriceOnChange()" name="quantity" class="form-control" placeholder="Quantity" required>
                        </div>
                        <br>
                        <h4 class="example-title">Unit</h4>
                        <div class="input-group">
                           <input type="text"  name="unit" class="form-control" placeholder="Unit" required>
                        </div>
                        <br>
                        <h4 class="example-title">Price</h4>
                        <div class="input-group">
                           <input type="number" onChange="handlesQuantityAndPriceOnChange()" name="price" class="form-control" placeholder="Price" required>
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
let items = [];
let itemToUpdate = null;

$(".modal-form").on("submit", function(e) {
   e.preventDefault();

   const inputs = {} ;
   $(this).serializeArray().map((v) => inputs[v.name] = v.value);

   if(itemToUpdate === null) {
      items.push(inputs);
   }else{
      items[items.indexOf(itemToUpdate)] = inputs;
   }
   itemToUpdate = null;
   updateItemUI();
   $(".modal-form #sales_form_reset").click()
   $(".modal-form #sale_close_modal").click()
});

function updateItemUI() {
   $("#itemlist tbody").empty();
   items.forEach((item, key) => {
      const row = `
      <tr id="item-${key}">
         <td>${key + 1}</td>
         <td contenteditable="true">${item.dateSale}</td>
         <td>${item.manifestNo}</td>
         <td>${item.contractorBranch}</td>
         <td onClick="console.log(this.textContent)">${item.wasteName}</td>
         <td>${item.description}</td>
         <td>${item.quantity}</td>
         <td>${item.unit}</td>
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
}

function handlesDeleteItem(itemId) {
   items = items.filter((item, key) => key !== itemId);
   updateItemUI();
}

function handlesEditItem(itemId) {
   itemToUpdate = items.find((item, key) => key === itemId);
   for(key in itemToUpdate) {
      $(`[name=${key}]`).val(itemToUpdate[key]);
   }
   $("#sales_additem_btn").click();
}

function handlesQuantityAndPriceOnChange() {
   const amount = $("[name=quantity]").val() * $("[name=price]").val();
   $("[name=amount]").val(amount);
}

</script>