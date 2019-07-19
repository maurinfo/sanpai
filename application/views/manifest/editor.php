<?php
$editFlag = isset($manifest['id']);

echo $editFlag ?
form_open('manifest/save/' . $manifest['id']) :
form_open('manifest/save');
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

<input type="hidden" name="id" value="<?=($editFlag ? $manifest['id'] : '')?>" />
<input type="hidden" id="contractorid" name="contractorid" value="<?=($editFlag ? $manifest['contractorid'] : '')?>" />
<input type="hidden" id="contractorbranchid" name="contractorbranchid" value="<?=($editFlag ? $manifest['contractorbranchid'] : '')?>" />
<input type="hidden" id="1forwarderid" name="1forwarderid" value="<?=($editFlag ? $manifest['1forwarderid'] : '')?>" />
<input type="hidden" id="2forwarderid" name="2forwarderid" value="<?=($editFlag ? $manifest['2forwarderid'] : '')?>" />
<input type="hidden" id="3forwarderid" name="3forwarderid" value="<?=($editFlag ? $manifest['3forwarderid'] : '')?>" />
<input type="hidden" id="1permitid" name="1forwardpermitid" value="<?=($editFlag ? $manifest['1forwardpermitid'] : '')?>" />
<input type="hidden" id="2permitid" name="2forwardpermitid" value="<?=($editFlag ? $manifest['2forwardpermitid'] : '')?>" />
<input type="hidden" id="3permitid" name="3forwardpermitid" value="<?=($editFlag ? $manifest['3forwardpermitid'] : '')?>" />
<input type="hidden" id="recyclefirmid" name="recyclefirmid" value="<?=($editFlag ? $manifest['recyclefirmid'] : '')?>" />
<input type="hidden" id="recyclepermitid" name="recyclepermitid" value="<?=($editFlag ? $manifest['recyclepermitid'] : '')?>" />

<!-- MODAL WINDOW-->
<div class="page-content">
<div class="panel">
   <header class="panel-heading">
      <h3 class="panel-title">
         <a style="text-decoration:none" href="<?=base_url();?>manifest">
         マニフェスト mnf /
         </a>
         <?=$title;?>
      </h3>
   </header>
   <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $manifest['id'] : '')?>" />
   <div class="panel-body">
      <div class="row">
         <div class="col-lg-4">
            <div class="small-spacing">
            <h4 class="example-title"> 交付日</h4>
            <span class="text-danger"><?=form_error('datemanifest');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                  value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
            </div>
             </div>
         </div>
         <div class="col-lg-4">
            <div class="small-spacing">
            <h4 class="example-title">交付番号</h4>
            <span class="text-danger"><?=form_error('referenceno');?></span>
            <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $manifest['referenceno'] : '')?>" />
         </div>
          </div>
         <div class="col-lg-4">
             <div class="small-spacing">

               <h4 class="example-title">交付担当者</h4>
               <span class="text-danger"><?=form_error('incharge');?></span>
               <input type="text" class="form-control" name="incharge" placeholder="In-charge" value="<?=($editFlag ? $manifest['incharge'] : '')?>" />

         </div>
          </div>
      </div>

      <div class="row ">
         <div class="col-lg-6">
             <div class="small-spacing">
            <h4 class="example-title">排出事業所</h4>
            <span class="text-danger"><?=form_error('contractor');?></span>
            <div class="input-group">
               <input id="contractor" type="text" class="form-control" name="contractor" placeholder="Contractor" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#contractorModal"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="small-spacing">
            <h4 class="example-title">排出事業所</h4>
            <span class="text-danger"><?=form_error('contractorbranch');?></span>
            <div class="input-group">
               <input id="contractorbranch" type="text" class="form-control" name="contractorbranch" placeholder="Contractor Branch" value="<?=($editFlag ? $manifest['contractorbranch'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#contractorBranchModal"></button>
               </div>
            </div>
             </div>

         </div>
      </div>



      <div class="row ">
         <div class="col-lg-2">
             <div class="small-spacing">
            <h4 class="example-title">許可の種類</h4>
            <select id="permitclassbox" class="form-control" name="permitclassid">
               <option value="0">Select Permit Class</option>
               <?php foreach ($permitclasses as $permitclass): ?>
               <?="<option value='" . $permitclass['id'] . "'" . ($editFlag && $permitclass['id'] == $manifest['permitclassid'] ? 'selected' : '') . ">" . $permitclass['name'] . "</option>"?>
               <?php endforeach;?>
            </select>
         </div>
          </div>

         <div class="col-lg-2">
             <div class="small-spacing">
            <h4 class="example-title">廃棄物種類</h4>
            <select class="form-control" name="wasteclassid">
               <option value="0">Select Waste Class</option>
               <?php foreach ($wasteclasses as $wasteclass): ?>
               <?="<option value='" . $wasteclass['id'] . "'" . ($editFlag && $wasteclass['id'] == $manifest['wasteclassid'] ? 'selected' : '') . ">" . $wasteclass['name'] . "</option>"?>
               <?php endforeach;?>
            </select>
             </div>
         </div>
         <div class="col-lg-2">
             <div class="small-spacing">
            <h4 class="example-title">廃棄物名称</h4>
            <select class="form-control" name="itemid">
               <option value="0">Select Waste Name</option>
               <?php foreach ($items as $item): ?>
               <?="<option value='" . $item['id'] . "'" . ($editFlag && $item['id'] == $manifest['itemid'] ? 'selected' : '') . ">" . $item['name'] . "</option>"?>
               <?php endforeach;?>
            </select>
         </div>
          </div>
         <div class="col-lg-2">
             <div class="small-spacing">
            <h4 class="example-title">Others </h4>
            <span class="text-danger"><?=form_error('otheritemname');?></span>
            <input type="text" class="form-control" name="otheritemname" placeholder="Others" value="<?=($editFlag ? $manifest['otheritemname'] : '')?>" />
         </div>
          </div>
         <div class="col-lg-2">
             <div class="small-spacing">
            <h4 class="example-title">数 量</h4>
            <input type="text" class="form-control" name="qty" placeholder="123-4567"
               value="<?=($editFlag ? $manifest['qty'] : '')?>" />
         </div>
          </div>

         <div class="col-lg-2">
             <div class="small-spacing">
            <h4 class="example-title"></h4>
            <select class="form-control"name="itemunitid">
               <option value="0">Select Unit</option>
               <?php foreach ($itemunits as $itemunit): ?>
               <?="<option value='" . $itemunit['id'] . "'" . ($editFlag && $itemunit['id'] == $manifest['itemunitid'] ? 'selected' : '') . ">" . $itemunit['name'] . "</option>"?>
               <?php endforeach;?>
            </select>
         </div>
          </div>
      </div>

      <div class="row ">
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"><span class="badge badge-md badge-primary">1</span> 収集業者 </h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="1forwarder" type="text" class="form-control" name="1forwarder" placeholder="Forwarder 1" value="<?=($editFlag ? $manifest['1forwarder'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#forwarderModal"></button>
               </div>

            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title">許可 </h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="permitno1" type="text" class="form-control" name="permitno1" placeholder="Permit No" value="<?=($editFlag ? $manifest['1forwardpermit'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#permitModal1"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"> 運搬完了日</h4>
            <span class="text-danger"><?=form_error('manifestdate');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="1dateforward"
                  value="<?=($editFlag && isset($manifest['1dateforward']) ? date("m/d/Y", strtotime($manifest['1dateforward'])) : '')?>" />
            </div>
         </div>
          </div>
      </div>

      <div class="row ">
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"><span class="badge badge-md badge-primary">2 </span>  運搬業者 </h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="2forwarder" type="text" class="form-control" name="2forwarder" placeholder="Name" value="<?=($editFlag ? $manifest['2forwarder'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#forwarderModal2"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title">許可 </h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="permitno2" type="text" class="form-control" name="permitno2" placeholder="Permit No" value="<?=($editFlag ? $manifest['2forwardpermit'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#permitModal2"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"> 運搬完了日</h4>
            <span class="text-danger"><?=form_error('manifestdate');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="2dateforward"
                  value="<?=($editFlag && isset($manifest['2dateforward']) ? date("m/d/Y", strtotime($manifest['2dateforward'])) : '')?>" />
            </div>
         </div>
          </div>
      </div>

      <div class="row ">
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"><span class="badge badge-md badge-primary">3</span> 運搬業者  </h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="3forwarder" type="text" class="form-control" name="3forwarder" placeholder="Name" value="<?=($editFlag ? $manifest['3forwarder'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#forwarderModal3"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title">許可 </h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="permitno3" type="text" class="form-control" name="permitno3" placeholder="Permit No" value="<?=($editFlag ? $manifest['3forwardpermit'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#permitModal3"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"> 運搬完了日</h4>
            <span class="text-danger"><?=form_error('manifestdate');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="3dateforward"
                  value="<?=($editFlag && isset($manifest['3dateforward']) ? date("m/d/Y", strtotime($manifest['3dateforward'])) : '')?>" />
            </div>
             </div>
         </div>
      </div>

      <div class="row ">
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title">処理工場</h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="recfirm" type="text" class="form-control" name="recfirm" placeholder="Name" value="<?=($editFlag ? $manifest['recyclefirm'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#recycleFirmModal"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title">許可 </h4>
            <span class="text-danger"><?=form_error('name');?></span>
            <div class="input-group">
               <input id="permitno4" type="text" class="form-control" name="permitno4" placeholder="R" value="<?=($editFlag ? $manifest['recyclepermit'] : '')?>" />
               <div class="input-group-append">
                  <button type="button" class="btn btn-icon btn-success icon md-menu" data-toggle="modal" data-target="#permitModal4"></button>
               </div>
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"> 処分終了日</h4>
            <span class="text-danger"><?=form_error('1recycledate');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="1recycledate"
                  value="<?=($editFlag && isset($manifest['1recycledate']) ? date("m/d/Y", strtotime($manifest['1recycledate'])) : '')?>" />
            </div>
             </div>
         </div>
      </div>

      <div class="row ">
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title">処分方法 </h4>
            <select class="form-control" name="disposalmethodid">
               <option value="0">Select Disposal Method</option>
               <?php foreach ($disposalmethods as $disposalmeth): ?>
               <?="<option value='" . $disposalmeth['id'] . "'" . ($editFlag && $disposalmeth['id'] == $manifest['disposalmethodid'] ? 'selected' : '') . ">" . $disposalmeth['name'] . "</option>"?>
               <?php endforeach;?>
            </select>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"> 最終処分終了日</h4>
            <span class="text-danger"><?=form_error('2recycledate');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="2recycledate"
                  value="<?=($editFlag && isset($manifest['2recycledate']) ? date("m/d/Y", strtotime($manifest['2recycledate'])) : '')?>" />
            </div>
         </div>
          </div>
      </div>

      <div class="row">
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"> 受託日</h4>
            <span class="text-danger"><?=form_error('datereceived');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="datereceived"
                  value="<?=($editFlag && isset($manifest['datereceived']) ? date("m/d/Y", strtotime($manifest['datereceived'])) : '')?>" />
            </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title">入力担当者</h4>
            <select class="form-control" name="receivedbyid">
               <option value="0">Select Employee</option>
               <?php foreach ($employees as $employee): ?>
               <?="<option value='" . $employee['id'] . "'" . ($editFlag && $employee['id'] == $manifest['receivedbyid'] ? 'selected' : '') . ">" . $employee['name'] . "</option>"?>
               <?php endforeach;?>
            </select>
         </div>
          </div>
         <div class="col-lg-4">
             <div class="small-spacing">
            <h4 class="example-title"> マニフェスト郵送日</h4>
            <span class="text-danger"><?=form_error('datemailed');?></span>
            <div class="input-group">
               <span class="input-group-addon">
               <i class="icon md-calendar" aria-hidden="true"></i>
               </span>
               <input type="text" class="form-control" data-plugin="datepicker" name="datemailed"
                  value="<?=($editFlag && isset($manifest['datemailed']) ? date("m/d/Y", strtotime($manifest['datemailed'])) : '')?>" />
            </div>
         </div>
          </div>
      </div>

      <div class="row ">
         <div class="col-lg-12">
             <div class="small-spacing">
            <h4 class="example-title">備考</h4>
            <input type="text" class="form-control" name="notes" placeholder="Notes"
               value="<?=($editFlag ? $manifest['notes'] : '')?>" />
         </div>
          </div>
      </div>
   </div>
   <div class="panel-footer">
      <button class="btn btn-success" type="submit">
      <i class="aria-hidden=" true></i> Save
      </button>
   </div>
   <br>
</div>
<!-- End Page -->
