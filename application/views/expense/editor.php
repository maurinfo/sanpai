<?php
   $editFlag = isset($expense['id']);

   echo $editFlag ?
   form_open('expense/save/' . $expense['id']) :
   form_open('expense/save');
   ?>
<input type="hidden" name="id" value="<?=($editFlag ? $expense['id'] : '')?>" />
<input type="hidden" id="contractorid" name="contractorid" value="<?=($editFlag ? $expense['contractorid'] : '')?>" />
<input type="hidden" id="contractorbranchid" name="contractorbranchid" value="<?=($editFlag ? $expense['contractorbranchid'] : '')?>" />
<input type="hidden" id="1forwarderid" name="1forwarderid" value="<?=($editFlag ? $expense['1forwarderid'] : '')?>" />
<input type="hidden" id="2forwarderid" name="2forwarderid" value="<?=($editFlag ? $expense['2forwarderid'] : '')?>" />
<input type="hidden" id="3forwarderid" name="3forwarderid" value="<?=($editFlag ? $expense['3forwarderid'] : '')?>" />
<input type="hidden" id="1permitid" name="1forwardpermitid" value="<?=($editFlag ? $expense['1forwardpermitid'] : '')?>" />
<input type="hidden" id="2permitid" name="2forwardpermitid" value="<?=($editFlag ? $expense['2forwardpermitid'] : '')?>" />
<input type="hidden" id="3permitid" name="3forwardpermitid" value="<?=($editFlag ? $expense['3forwardpermitid'] : '')?>" />
<input type="hidden" id="recyclefirmid" name="recyclefirmid" value="<?=($editFlag ? $expense['recyclefirmid'] : '')?>" />
<input type="hidden" id="recyclepermitid" name="recyclepermitid" value="<?=($editFlag ? $expense['recyclepermitid'] : '')?>" />
<!-- MODAL WINDOW-->
<div class="page-content">
   <div class="panel">
      <header class="panel-heading">
         <h3 class="panel-title">
            <a style="text-decoration:none" href="<?=base_url();?>expense">
            Expense /
            </a>
            <?=$title;?>
         </h3>
      </header>
      <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $expense['id'] : '')?>" />
      <div class="panel-body">
         <div class="row">
            <div class="col-md-8">
               <div class="panel panel-success panel-line">
                  <div class="panel-heading">
                     <h3 class="panel-title">Details</h3>
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6">
                           <h4 class="example-title"> Date</h4>
                           <span class="text-danger"><?=form_error('dateexpense');?></span>
                           <div class="input-group">
                              <span class="input-group-addon">
                              <i class="icon md-calendar" aria-hidden="true"></i>
                              </span>
                              <input type="text" class="form-control" data-plugin="datepicker" name="dateexpense"
                                 value="<?=($editFlag && isset($expense['dateexpense']) ? date("m/d/Y", strtotime($expense['dateexpense'])) : '')?>" />
                           </div>
                           <br>
                        </div>
                        <div class="col-lg-6">
                           <h4 class="example-title">Reference No</h4>
                           <span class="text-danger"><?=form_error('referenceno');?></span>
                           <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $expense['referenceno'] : '')?>" />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <h4 class="example-title">Customer</h4>
                           <span class="text-danger"><?=form_error('contractor');?></span>
                           <div class="input-group">
                              <input id="contractor" type="text" class="form-control" name="customer" placeholder="Contractor" value="<?=($editFlag ? $expense['contractor'] : '')?>" />
                              <div class="input-group-append">
                                 <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#contractorModal"></button>
                              </div>
                           </div>
                           <br>
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
                           <span class="text-danger"><?=form_error('referenceno');?></span>
                           <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $expense['referenceno'] : '')?>" /><br>
                        </div>
                        <br>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <h4 class="example-title">tax</h4>
                           <span class="text-danger"><?=form_error('referenceno');?></span>
                           <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $expense['referenceno'] : '')?>" /><br>
                        </div>
                        <br>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <h4 class="example-title">TOTAL</h4>
                           <span class="text-danger"><?=form_error('referenceno');?></span>
                           <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $expense['referenceno'] : '')?>" /><br>
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
                     <table class="table table-striped">
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

                           </tr>
                        </thead>
                        <tbody>

                           <tr class="Sale">
                               <td>1</td>
                               <td>2019-02-20</td>
                               <td>9999999</td>
                               <td>Maurin Co. Ltd</td>
                               <td>Basure</td>
                               <td>Tae</td>
                               <td>100</td>
                               <td>kg</td>
                               <td>200</td>
                               <td>20000</td>

                           </tr>

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
<!-- End Page -->
