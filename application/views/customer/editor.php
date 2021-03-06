<?php
   //print_r($customer['code']) ;
   $editFlag = isset($customer['id']);

   echo $editFlag ?

   form_open('customer/save/' . $customer['id']) :
   form_open('customer/save');
   ?>
<input type="hidden" name="id" value="<?=($editFlag ? $customer['id'] : '')?>" />
<input type="hidden" name="code" value="<?=($editFlag ? $customer['code'] : '')?>" />
<div class="page-content">
<div class="panel">
   <header class="panel-heading">
      <h3 class="panel-title">
         <a style= "text-decoration:none" href="<?=base_url();?>customer">得意先 CU / </a>
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
                        <div class="small-spacing">
                           <h4 class="example-title">Name</h4>
                           <span class="text-danger"><?=form_error('name');?></span>
                           <input type="text" class="form-control" name="name" placeholder="Name" 
                              value="<?=($editFlag ? $customer['name'] : '')?>" 
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="small-spacing">
                           <h4 class="example-title">Furigana</h4>
                           <input type="text" class="form-control" name="yomi" placeholder="Furigana" 
                              value="<?=($editFlag ? $customer['yomi'] : '')?>"
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Contact Person</h4>
                           <span class="text-danger"><?=form_error('contactperson');?></span>
                           <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" 
                              value="<?=($editFlag ? $customer['contactperson'] : '')?>" 
                           />
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Department</h4>
                           <input type="text" class="form-control" name="department" placeholder="Department" 
                              value="<?=($editFlag ? $customer['department'] : '')?>" 
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Zip Code</h4>
                           <input type="text" class="form-control" name="zip" placeholder="123-4567"
                              value="<?=($editFlag ? $customer['zip'] : '')?>" 
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="small-spacing">
                           <h4 class="example-title">Address 1</h4>
                           <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                              value="<?=($editFlag ? $customer['address1'] : '')?>" 
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="small-spacing">
                           <h4 class="example-title">Address 2</h4>
                           <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                              value="<?=($editFlag ? $customer['address2'] : '')?>" 
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Tel. No.</h4>
                           <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                              value="<?=($editFlag ? $customer['telno'] : '')?>" 
                           />
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Fax No.</h4>
                           <input type="text" class="form-control" name="faxno" placeholder="000-0000-0000 line 1"
                              value="<?=($editFlag ? $customer['faxno'] : '')?>" 
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="small-spacing">
                           <h4 class="example-title">E-mail</h4>
                           <span class="text-danger"><?=form_error('email');?></span>
                           <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                              value="<?=($editFlag ? $customer['email'] : '')?>" 
                           />
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="small-spacing">
                           <h4 class="example-title">Notes</h4>
                           <input type="text" class="form-control" name="notes" placeholder="Notes"
                              value="<?=($editFlag ? $customer['notes'] : '')?>" 
                           />
                        </div>
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
                        <div class="small-spacing">
                           <h4 class="example-title">Tax Setting</h4>
                           <div class="input-group">
                              <select data-plugin="selectpicker" name="taxinclusive">
                                 <option value="0" <?=($editFlag && $customer['taxinclusive']== 0 ? 'selected' : '')?> >No Tax</option>
                                 <option value="1" <?= ($editFlag && $customer['taxinclusive']== 1 ? 'selected' : '')?>>Exclusive</option>
                                 <option value="2" <?= ($editFlag && $customer['taxinclusive']== 2 ? 'selected' : '')?>>Inclusive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Rounding Method</h4>
                           <select data-plugin="selectpicker" name="roundofftypeid">
                              <option value="0" <?=($editFlag && $customer['roundofftypeid']== 0 ? 'selected' : '')?>>Truncation</option>
                              <option value="1" <?=($editFlag && $customer['roundofftypeid']== 1 ? 'selected' : '')?>>Round Off</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Payment Terms</h4>
                           <select data-plugin="selectpicker" name="termid">
                              <option value="0" <?=($editFlag && $customer['termid']== 0 ? 'selected' : '')?>>当月</option>
                              <option value="1" <?=($editFlag && $customer['termid']== 1 ? 'selected' : '')?>>翌月</option>
                              <option value="2" <?=($editFlag && $customer['termid']== 2 ? 'selected' : '')?>>翌々月</option>
                              <option value="3" <?=($editFlag && $customer['termid']== 3 ? 'selected' : '')?>>3ヶ月</option>
                              <option value="4" <?=($editFlag && $customer['termid']== 4 ? 'selected' : '')?>>4ヶ月</option>
                              <option value="5" <?=($editFlag && $customer['termid']== 5 ? 'selected' : '')?>>5ヶ月</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Payment Method</h4>
                           <select data-plugin="selectpicker" name="paymethodid">
                              <option value="0" <?=($editFlag && $customer['paymethodid']== 0 ? 'selected' : '')?>>現金</option>
                              <option value="1" <?=($editFlag && $customer['paymethodid']== 1 ? 'selected' : '')?>>小切手</option>
                              <option value="2" <?=($editFlag && $customer['paymethodid']== 2 ? 'selected' : '')?>>手形</option>
                              <option value="3" <?=($editFlag && $customer['paymethodid']== 3 ? 'selected' : '')?>>相殺</option>
                              <option value="4" <?=($editFlag && $customer['paymethodid']== 4 ? 'selected' : '')?>>口座</option>
                              <option value="5" <?=($editFlag && $customer['paymethodid']== 5 ? 'selected' : '')?>>手数料</option>
                              <option value="6" <?=($editFlag && $customer['paymethodid']== 6 ? 'selected' : '')?>>カード</option>
                           </select>
                        </div>   
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Cutoff Date</h4>
                           <select data-plugin="selectpicker" name="cutoffdate">
                              <option value="5" <?=($editFlag && $customer['cutoffdate']== 5 ? 'selected' : '')?>>5</option>
                              <option value="10" <?=($editFlag && $customer['cutoffdate']== 10 ? 'selected' : '')?>>10</option>
                              <option value="15" <?=($editFlag && $customer['cutoffdate']== 15 ? 'selected' : '')?>>15</option>
                              <option value="20" <?=($editFlag && $customer['cutoffdate']== 20 ? 'selected' : '')?>>20</option>
                              <option value="25" <?=($editFlag && $customer['cutoffdate']== 25 ? 'selected' : '')?>>25</option>
                              <option value="31" <?=($editFlag && $customer['cutoffdate']== 31 ? 'selected' : '')?>>31</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="small-spacing">
                           <h4 class="example-title">Collection Date</h4>
                           <select data-plugin="selectpicker" name="collectdate">
                              <option value="5" <?=($editFlag && $customer['collectdate']== 5 ? 'selected' : '')?>>5</option>
                              <option value="10" <?=($editFlag && $customer['collectdate']== 10 ? 'selected' : '')?>>10</option>
                              <option value="15" <?=($editFlag && $customer['collectdate']== 15 ? 'selected' : '')?>>15</option>
                              <option value="20" <?=($editFlag && $customer['collectdate']== 20 ? 'selected' : '')?>>20</option>
                              <option value="25" <?=($editFlag && $customer['collectdate']== 25 ? 'selected' : '')?>>25</option>
                              <option value="31" <?=($editFlag && $customer['collectdate']== 31 ? 'selected' : '')?>>31</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="small-spacing">
                           <div class="checkbox-custom checkbox-success">
                              <input type="checkbox" name="reportvisibility" value = "1" <?=($editFlag && $customer['reportvisibility']== 0 ? '' : 'checked')?> />
                              <label>Show in Reports</label>
                           </div>
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
      
   </div>
</div>
