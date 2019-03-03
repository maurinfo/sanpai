<?php
$editFlag = isset($sale['id']);

echo $editFlag ?
form_open('sale/save/' . $sale['id']) :
form_open('sale/save');
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
         <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $sale['id'] : '')?>" />
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
                              <span class="text-danger"><?=form_error('customer');?></span>
                              <div class="input-group">
                                 <input id="customer" type="text" class="form-control" name="customer" placeholder="customer" value="<?=($editFlag ? $sale['contractor'] : '')?>" readonly/>
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
                                    value="<?=($editFlag && isset($sale['datesale']) ? date("m/d/Y", strtotime($sale['datesale'])) : '')?>" readonly/>
                              </div>
                              <br>
                           </div>
                           <div class="col-lg-6">
                              <h4 class="example-title">Reference No</h4>
                              <span class="text-danger"><?=form_error('referenceno');?></span>
                              <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $sale['referenceno'] : '')?>" readonly/>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">Notes</h4>
                              <input type="text" class="form-control" name="notes" placeholder="Notes"
                                 value="<?=($editFlag ? $customer['notes'] : '')?>" />
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
                              <input type="text" class="form-control" name="subtotal" placeholder="Sub Total" value="" readonly/><br>
                           </div>
                           <br>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">Tax</h4>
                              <input type="text" class="form-control" name="tax" placeholder="Tax" value="" readonly/><br>
                           </div>
                           <br>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <h4 class="example-title">TOTAL</h4>
                              <input type="text" class="form-control" name="total" placeholder="Total" value="" readonly/><br>
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
                        <button id="sales_additem_btn" type="button" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true" data-toggle="modal" data-target="#sales_add_item_modal">Add Item</button>
                        <br>
                        <table id="itemlist" class="table table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Date</th>
                                 <th>Manifest No</th>
                                 <th>Contractor Branch</th>
                                 <th>Waste Name</th>
                                 <th>Description</th>
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
            <button class="btn btn-success" type="submit">
            <i class="aria-hidden=" true></i> Save
            </button>
         </div>
         <br>
      </div>
   </div>
</form>
<script>

</script>
<!-- End Page -->
