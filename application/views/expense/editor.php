<?php

print_r($expenseitems);
$editFlag = isset($expense['id']);
echo $editFlag ?
form_open('expense/save/' . $expense['id'], array("id" => "expenses_form")) :
form_open('expense/save/', array("id" => "expenses_form"));
?>
   <div class="page-content">
      <div class="panel">
         <header class="panel-heading">
            <h3 class="panel-title">
               <a style="text-decoration:none" href="<?=base_url();?>expense">
               Expense / <?=$title;?>
               </a>
            </h3>
         </header>
         <input type="hidden" name="id" value="<?=($editFlag ? $expense['id'] : '')?>" />
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
                              <div class="small-spacing">
                                 <h4 class="example-title">Supplier</h4>
                                 <span class="text-danger"></span>
                                 <div class="input-group">
                                    <input id="supplier_name" type="text" class="form-control" name="suppliername" placeholder="Supplier" value="<?=($editFlag ? $expense['name'] : '')?>" readonly/>
                                    <input id="supplier_id" type="hidden" class="form-control" name="supplierid"  value="<?=($editFlag ? $expense['supplierid'] : '')?>"/>
                                    <div class="input-group-append">
                                       <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#supplier_search_modal"></button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="small-spacing">
                                 <h4 class="example-title"> Date</h4>
                                 <span class="text-danger"><?=form_error('dateexpense');?></span>
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="dateexpense"
                                       value="<?=($editFlag && isset($expense['datedelivered']) ? date("m/d/Y", strtotime($expense['datedelivered'])) : '')?>" readonly/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 <?=$editFlag ? '' : 'hidden'?>">
                              <div class="small-spacing">
                                 <h4 class="example-title">Reference No</h4>
                                 <span class="text-danger"><?=form_error('referenceno');?></span>
                                 <input type="text" class="form-control" name="referenceno" placeholder="Reference No"
                                    value="<?=($editFlag ? $expense['referenceno'] : '')?>" readonly
                                 />
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="small-spacing">
                                 <h4 class="example-title">Notes</h4>
                                 <input type="text" class="form-control" name="notes" placeholder="Notes"
                                    value="<?=($editFlag ? $expense['note'] : '')?>"
                                 />
                              </div>
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
                              <div class="small-spacing">
                                 <h4 class="example-title">SUB TOTAL</h4>
                                 <input type="text" class="form-control text-right" name="subtotal"
                                    value="<?=($editFlag ? $expense['subtotal'] : '')?>" readonly
                                 />
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="small-spacing">
                                 <h4 class="example-title">Tax</h4>
                                 <input type="text" class="form-control text-right" name="tax"
                                    value="<?=($editFlag ? $expense['tax'] : '')?>" readonly
                                 />
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="small-spacing">
                                 <h4 class="example-title">TOTAL</h4>
                                 <input type="text" class="form-control text-right" name="total"
                                    value="<?=($editFlag ? $expense['total'] : '')?>" readonly
                                 />
                              </div>
                           </div>
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
                           <button onClick="ExpenseItemFunc.addNewItem()" type="button" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true">Add Item</button>
                        </div >
                        <table id="itemlist" name="expenseitems" class="table table-striped" >
                           <span class="text-danger"></span>
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th colspan="3">Item Name</th>
                                 <th>Qty</th>
                                 <th>Unit</th>
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
            <button id="save_expenses" class="btn btn-success" type="submit">
            <i class="aria-hidden=" true></i> Save
            </button>
         </div>
         <br>
      </div>
   </div>
</form>

<script>
   const taxrate = <?=(int) $taxrate?>;
   $("#expenses_form").on("submit", function(e) {
      e.preventDefault();
      const url = $(this).attr("action");
      let inputs = {};
      $(this)
         .serializeArray()
         .map(v => (inputs[v.name] = v.value));
      inputs.expenseitems = ExpenseItemFunc.expenseitems;
      if (utility.validateInputs("expenses_form", inputs, getValidationRules())) {
         utility.post(url, JSON.stringify(inputs), redirectToExpensePage);
      }
   });
   function redirectToExpensePage(data, status) {
      window.location = `<?=base_url();?>expense`;
   }
   function getValidationRules() {
      return {
         suppliername: {
            presence: {
               allowEmpty: false,
               message: "^Supplier Name is required!"
            }
         },
         dateexpense: {
            presence: {
               allowEmpty: false,
               message: "^Date is required!"
            }
         },
         expenseitems: {
            presence: {
               allowEmpty: false,
               message: "^There should be atleast one(1) item!"
            }
         }
      };
   }
   $('document').ready(function(){
      ExpenseItemFunc.expenseitems = <?=$expenseitems ? json_encode($expenseitems) : "[]"?>;
      ExpenseItemFunc.itemUnits = <?=$itemunits ? json_encode($itemunits) : "[]"?>;
      console.log(ExpenseItemFunc.itemUnits);
      ExpenseItemFunc.updateExpensesRowUI();
   });
</script>
<!-- End Page -->
