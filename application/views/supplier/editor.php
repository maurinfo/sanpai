<?php
 //  print_r($supplier) ;
   $editFlag = isset($supplier['id']);

   echo $editFlag ?

   form_open('supplier/save/' . $supplier['id']) :
   form_open('supplier/save');
   ?>
<link rel="stylesheet" href="<?=base_url();?>global/vendor/select2/select2.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-select/bootstrap-select.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/icheck/icheck.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/switchery/switchery.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/asrange/asRange.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/ionrangeslider/ionrangeslider.min.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/asspinner/asSpinner.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/clockpicker/clockpicker.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/ascolorpicker/asColorPicker.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-touchspin/bootstrap-touchspin.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/jquery-labelauty/jquery-labelauty.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-datepicker/bootstrap-datepicker.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-maxlength/bootstrap-maxlength.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/timepicker/jquery-timepicker.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/jquery-strength/jquery-strength.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/multi-select/multi-select.css" />
<link rel="stylesheet" href="<?=base_url();?>global/vendor/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="<?=base_url();?>assets/examples/css/forms/advanced.css" />
<input type="hidden" name="id" value="<?=($editFlag ? $supplier['id'] : '')?>" />
<input type="hidden" name="code" value="<?=($editFlag ? $supplier['code'] : '')?>" />
<div class="page-content">
<div class="panel">
   <header class="panel-heading">
      <h3 class="panel-title">
         <a style= "text-decoration:none" href="<?=base_url();?>supplier">Supplier / </a>
         <?=$title;?>
      </h3>
   </header>
   <div class="panel-body">
      <div class="row">
         <div class="col-md-6">
            <div class="panel panel-success panel-line">
               <div class="panel-heading">
                  <h3 class="panel-title">Customer Details</h3>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <h4 class="example-title">Name</h4>
                        <span class="text-danger"><?=form_error('name');?></span>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $supplier['name'] : '')?>" />
                        <br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <h4 class="example-title">Furigana</h4>
                        <input type="text" class="form-control" name="yomi" placeholder="Furigana" value="<?=($editFlag ? $supplier['yomi'] : '')?>" />
                        <br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title">Contact Person</h4>
                        <span class="text-danger"><?=form_error('contactperson');?></span>
                        <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" value="<?=($editFlag ? $supplier['contactperson'] : '')?>" />
                     </div>
                     <div class="col-lg-6">
                        <h4 class="example-title">Department</h4>
                        <input type="text" class="form-control" name="department" placeholder="Department" value="<?=($editFlag ? $supplier['department'] : '')?>" />
                        <br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title">Zip Code</h4>
                        <input type="text" class="form-control" name="zip" placeholder="123-4567"
                           value="<?=($editFlag ? $supplier['zip'] : '')?>" /><br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <h4 class="example-title">Address 1</h4>
                        <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                           value="<?=($editFlag ? $supplier['address1'] : '')?>" /><br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <h4 class="example-title">Address 2</h4>
                        <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                           value="<?=($editFlag ? $supplier['address2'] : '')?>" /><br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title">Tel. No.</h4>
                        <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                           value="<?=($editFlag ? $supplier['telno'] : '')?>" /><br>
                     </div>
                     <div class="col-lg-6">
                        <h4 class="example-title">Fax No.</h4>
                        <input type="text" class="form-control" name="faxno" placeholder="000-0000-0000 line 1"
                           value="<?=($editFlag ? $supplier['faxno'] : '')?>" /><br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <h4 class="example-title">E-mail</h4>
                        <span class="text-danger"><?=form_error('email');?></span>
                        <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                           value="<?=($editFlag ? $supplier['email'] : '')?>" /><br>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <h4 class="example-title">Notes</h4>
                        <input type="text" class="form-control" name="notes" placeholder="Notes"
                           value="<?=($editFlag ? $supplier['notes'] : '')?>" />
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="panel panel-success panel-line">
               <div class="panel-heading">
                  <h3 class="panel-title">Account Settings </h3>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title">Tax Setting</h4>
                        <div class="input-group">
                           <select data-plugin="selectpicker" name="taxinclusive">
                              <option value="0" <?=($editFlag && $supplier['taxinclusive']== 0 ? 'selected' : '')?> >No Tax</option>
                              <option value="1" <?= ($editFlag && $supplier['taxinclusive']== 1 ? 'selected' : '')?>>Exclusive</option>
                              <option value="2" <?= ($editFlag && $supplier['taxinclusive']== 2 ? 'selected' : '')?>>Inclusive</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <h4 class="example-title">Rounding Method</h4>
                        <select data-plugin="selectpicker" name="roundofftypeid">
                           <option value="0" <?=($editFlag && $supplier['roundofftypeid']== 0 ? 'selected' : '')?>>Truncation</option>
                           <option value="1" <?=($editFlag && $supplier['roundofftypeid']== 1 ? 'selected' : '')?>>Round Off</option>
                        </select>
                        <br>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title">Payment Terms</h4>
                        <select data-plugin="selectpicker" name="termid">
                           <option value="0" <?=($editFlag && $supplier['termid']== 0 ? 'selected' : '')?>>当月</option>
                           <option value="1" <?=($editFlag && $supplier['termid']== 1 ? 'selected' : '')?>>翌月</option>
                           <option value="2" <?=($editFlag && $supplier['termid']== 2 ? 'selected' : '')?>>翌々月</option>
                           <option value="3" <?=($editFlag && $supplier['termid']== 3 ? 'selected' : '')?>>3ヶ月</option>
                           <option value="4" <?=($editFlag && $supplier['termid']== 4 ? 'selected' : '')?>>4ヶ月</option>
                           <option value="5" <?=($editFlag && $supplier['termid']== 5 ? 'selected' : '')?>>5ヶ月</option>
                        </select>
                        <br>
                     </div>
                     <div class="col-lg-6">
                        <h4 class="example-title">Payment Method</h4>
                        <select data-plugin="selectpicker" name="paymethodid">
                           <option value="0" <?=($editFlag && $supplier['paymethodid']== 0 ? 'selected' : '')?>>現金</option>
                           <option value="1" <?=($editFlag && $supplier['paymethodid']== 1 ? 'selected' : '')?>>小切手</option>
                           <option value="2" <?=($editFlag && $supplier['paymethodid']== 2 ? 'selected' : '')?>>手形</option>
                           <option value="3" <?=($editFlag && $supplier['paymethodid']== 3 ? 'selected' : '')?>>相殺</option>
                           <option value="4" <?=($editFlag && $supplier['paymethodid']== 4 ? 'selected' : '')?>>口座</option>
                           <option value="5" <?=($editFlag && $supplier['paymethodid']== 5 ? 'selected' : '')?>>手数料</option>
                           <option value="6" <?=($editFlag && $supplier['paymethodid']== 6 ? 'selected' : '')?>>カード</option>
                        </select>
                        <br>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-lg-6">
                        <h4 class="example-title">Cutoff Date</h4>
                        <select data-plugin="selectpicker" name="cutoffdate">
                           <option value="5" <?=($editFlag && $supplier['cutoffdate']== 5 ? 'selected' : '')?>>5</option>
                           <option value="10" <?=($editFlag && $supplier['cutoffdate']== 10 ? 'selected' : '')?>>10</option>
                           <option value="15" <?=($editFlag && $supplier['cutoffdate']== 15 ? 'selected' : '')?>>15</option>
                           <option value="20" <?=($editFlag && $supplier['cutoffdate']== 20 ? 'selected' : '')?>>20</option>
                           <option value="25" <?=($editFlag && $supplier['cutoffdate']== 25 ? 'selected' : '')?>>25</option>
                           <option value="31" <?=($editFlag && $supplier['cutoffdate']== 31 ? 'selected' : '')?>>31</option>
                        </select>
                        <br>
                     </div>
                     <div class="col-lg-6">
                        <h4 class="example-title">Collection Date</h4>
                        <select data-plugin="selectpicker" name="collectdate">
                           <option value="5" <?=($editFlag && $supplier['collectdate']== 5 ? 'selected' : '')?>>5</option>
                           <option value="10" <?=($editFlag && $supplier['collectdate']== 10 ? 'selected' : '')?>>10</option>
                           <option value="15" <?=($editFlag && $supplier['collectdate']== 15 ? 'selected' : '')?>>15</option>
                           <option value="20" <?=($editFlag && $supplier['collectdate']== 20 ? 'selected' : '')?>>20</option>
                           <option value="25" <?=($editFlag && $supplier['collectdate']== 25 ? 'selected' : '')?>>25</option>
                           <option value="31" <?=($editFlag && $supplier['collectdate']== 31 ? 'selected' : '')?>>31</option>
                        </select>
                        <br>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="checkbox-custom checkbox-success">
                           <input type="checkbox" name="reportvisibility" value = "1" <?=($editFlag && $supplier['reportvisibility']== 0 ? '' : 'checked')?> />
                           <label>Show in Reports</label><br>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <button class="btn btn-success" type="submit">
      <i class="aria-hidden=" true></i> Save
      </button>
      <br>
   </div>
</div>
