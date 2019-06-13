<?php
$editFlag = isset($sale['id']);
echo $editFlag ?
form_open('sale/save/' . $sale['id'], array("id" => "sales_form")) :
form_open('sale/save', array("id" => "sales_form"));
?>
   <div class="page-content">
      <div class="panel">
         <header class="panel-heading">
            <h3 class="panel-title">
               <a style="text-decoration:none" href="<?=base_url();?>sale">
               Sale /
               </a>
               <?=$title;?>
            </h3>
         </header>
         <input type="hidden" name="id" value="<?=($editFlag ? $sale['id'] : '')?>" />
         <div class="panel-body">
            <div class="row">
               <div class="col-md-8">
                  <div class="panel panel-success panel-line">
                     <div class="panel-heading">
                        <h3 class="panel-title">Details</h3>
                     </div>
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">Customer</h4>
                              <span class="text-danger"></span>
                              <div class="input-group">
                                 <input id="customer_name" type="text" class="form-control" name="customername" placeholder="Customer" value="<?=($editFlag ? $sale['name'] : '')?>" readonly/>
                                 <input id="customer_id" type="hidden" class="form-control" name="customerid"  value="<?=($editFlag ? $sale['customerid'] : '')?>"/>
                                 <div class="input-group-append">
                                    <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#customer_search_modal"></button>
                                 </div>
                              </div>
                              <br>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                              <h4 class="example-title"> Date</h4>
                              <span class="text-danger"><?=form_error('datesale');?></span>
                              <div class="input-group">
                                 <span class="input-group-addon">
                                 <i class="icon md-calendar" aria-hidden="true"></i>
                                 </span>
                                 <input type="text" class="form-control" data-plugin="datepicker" name="datesale"
                                    value="<?=($editFlag && isset($sale['datedelivered']) ? date("m/d/Y", strtotime($sale['datedelivered'])) : '')?>" readonly/>
                              </div>
                              <br>
                           </div>
                           <div class="col-lg-6 <?=$editFlag ? '' : 'hidden'?>">
                              <h4 class="example-title">Reference No</h4>
                              <span class="text-danger"><?=form_error('referenceno');?></span>
                              <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $sale['referenceno'] : '')?>" readonly/>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">Notes</h4>
                              <input type="text" class="form-control" name="notes" placeholder="Notes"
                                 value="<?=($editFlag ? $sale['note'] : '')?>" />
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel panel-success panel-line">
                     <div class="panel-heading">
                        <h3 class="panel-title">Total </h3>
                     </div>
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">SUB TOTAL</h4>
                              <input type="text" class="form-control text-right" name="subtotal"
                                 value="<?=($editFlag ? $sale['subtotal'] : '')?>" readonly/><br>
                           </div>
                           <br>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">Tax</h4>
                              <input type="text" class="form-control text-right" name="tax"
                                 value="<?=($editFlag ? $sale['tax'] : '')?>" readonly/><br>
                           </div>
                           <br>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">TOTAL</h4>
                              <input type="text" class="form-control text-right" name="total"
                                 value="<?=($editFlag ? $sale['total'] : '')?>" readonly/><br>
                           </div>
                           <br>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="panel panel-success panel-line">
                     <div class="panel-heading">
                        <h3 class="panel-title">Items</h3>
                     </div>
                     <div class="panel-body">
                        <div style="margin-bottom: 20px;">
                           <button onClick="SaleItemFunc.addNewItem()" type="button" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true">Add Item</button>
                        </div >
                        <table id="itemlist" name="saleitems" class="table table-striped" >
                           <span class="text-danger"></span>
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th colspan="2">Date</th>
                                 <th colspan="2">Manifest No</th>
                                 <th>Contractor Branch</th>
                                 <th colspan="2">Waste Name</th>
                                 <th>Description</th>
                                 <th>Qty</th>
                                 <th>Price</th>
                                 <th>Amount</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <!-- ITEMS HERE -->
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <button id="save_sales" class="btn btn-success" type="submit">
            <i class="aria-hidden=" true></i> Save
            </button>
         </div>
         <br>
      </div>
   </div>
</form>

<script>
   const taxrate = <?=(int) $taxrate?>;
   $("#sales_form").on("submit", function(e) {
      e.preventDefault();
      const url = $(this).attr("action");
      let inputs = {};
      $(this)
         .serializeArray()
         .map(v => (inputs[v.name] = v.value));
      inputs.saleitems = SaleItemFunc.saleitems;
      if (utility.validateInputs("sales_form", inputs, getValidationRules())) {
         utility.post(url, JSON.stringify(inputs), redirectToSalePage);
      }
   });
   function redirectToSalePage(data, status) {
      window.location = `<?=base_url();?>sale`;
   }
   function getValidationRules() {
      return {
         customername: {
            presence: {
               allowEmpty: false,
               message: "^Customer Name is required!"
            }
         },
         datesale: {
            presence: {
               allowEmpty: false,
               message: "^Date is required!"
            }
         },
         saleitems: {
            presence: {
               allowEmpty: false,
               message: "^There should be atleast one(1) item!"
            }
         }
      };
   }
   $('document').ready(function(){
      SaleItemFunc.saleitems = <?=$saleitems ? json_encode($saleitems) : "[]"?>;
      SaleItemFunc.itemUnits = <?=$itemunits ? json_encode($itemunits) : "[]"?>;
      console.log(SaleItemFunc.itemUnits);
      SaleItemFunc.updateSalesRowUI();
   });
</script>
<!-- End Page -->
