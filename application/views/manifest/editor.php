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
<input type="hidden" name="contractorid" value="<?=($editFlag ? $manifest['contractorid'] : '')?>" />
<input type="hidden" name="contractorbranchid" value="<?=($editFlag ? $manifest['contractorbranchid'] : '')?>" />
<input type="hidden" name="1forwarderid" value="<?=($editFlag ? $manifest['1forwarderid'] : '')?>" />
<input type="hidden" name="2forwarderid" value="<?=($editFlag ? $manifest['2forwarderid'] : '')?>" />
<input type="hidden" name="3forwarderid" value="<?=($editFlag ? $manifest['3forwarderid'] : '')?>" />
<input type="hidden" name="1forwardpermitid" value="<?=($editFlag ? $manifest['1forwardpermitid'] : '')?>" />
<input type="hidden" name="2forwardpermitid" value="<?=($editFlag ? $manifest['2forwardpermitid'] : '')?>" />
<input type="hidden" name="3forwardpermitid" value="<?=($editFlag ? $manifest['3forwardpermitid'] : '')?>" />
<input type="hidden" name="recyclefirmid" value="<?=($editFlag ? $manifest['recyclefirmid'] : '')?>" />
<input type="hidden" name="recyclepermitid" value="<?=($editFlag ? $manifest['recyclepermitid'] : '')?>" />
<input type="hidden" name="disposalmethodid" value="<?=($editFlag ? $manifest['disposalmethodid'] : '')?>" />
<input type="hidden" name="employeeid" value="<?=($editFlag ? $manifest['employeeid'] : '')?>" />



<!-- MODAL WINDOW-->
<div class="page-content">
      <div class="panel">

        <header class="panel-heading">
            <h3 class="panel-title">
            <a style="text-decoration:none" href="<?=base_url();?>/manifest">
                Manifest /
            </a>
                    <?=$title;?>
            </h3>
        </header>


        <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $manifest['id'] : '')?>" />
          <div class="panel-body">
            <div class="row">

                <div class="col-lg-4">

                        <h4 class="example-title"> Date</h4>
                        <span class="text-danger"><?=form_error('datemanifest');?></span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                            value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                        </div>

                </div>
                <div class="col-lg-4">

                        <h4 class="example-title">Reference No</h4>
                        <span class="text-danger"><?=form_error('name');?></span>
                        <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $manifest['referenceno'] : '')?>" />
                </div>
                <div class="col-lg-4">
                    <div class="example-col">
                        <h4 class="example-title">In Charge</h4>
                        <span class="text-danger"><?=form_error('incharge');?></span>
                        <input type="text" class="form-control" name="incharge" placeholder="In-charge" value="<?=($editFlag ? $manifest['incharge'] : '')?>" />
                   </div>
                </div>
           </div>
            <br>
            <div class="row ">
                <div class="col-lg-6">


                    <h4 class="example-title">Contractor</h4>
                    <span class="text-danger"><?=form_error('contractor');?></span>
                    <div class="input-group">
                      <input id="cname1" type="text" class="form-control" name="contractor" placeholder="Contractor" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                      </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h4 class="example-title">Contractor Branch</h4>
                    <span class="text-danger"><?=form_error('contractorbranch');?></span>
                    <div class="input-group">
                      <input id="cname" type="text" class="form-control" name="contractorbranch" placeholder="Contractor Branch" value="<?=($editFlag ? $manifest['contractorbranch'] : '')?>" />
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                        </div>
                      </div>
                </div>
            </div>
        <br>
            <div class="row ">
                <div class="col-lg-2">
                    <h4 class="example-title">Permit Class</h4>

                        <select data-plugin="selectpicker" name="permitclassid">
                            <option value="0">Select Permit Class</option>
                            <?php foreach ($permitclasses as $permitclass): ?>

                            <?="<option value='" .$permitclass['id']."'". ($editFlag && $permitclass['id'] == $manifest['permitclassid'] ? 'selected' : ''). ">". $permitclass['name']."</option>"?>

                            <?php endforeach;?>
                        </select>

                </div>
                <div class="col-lg-2">
                            <h4 class="example-title">Waste Class</h4>

                                <select data-plugin="selectpicker" name="wasteclassid">
                                    <option value="0">Select Waste Class</option>
                                    <?php foreach ($wasteclasses as $wasteclass): ?>

                                    <?="<option value='" .$wasteclass['id']."'". ($editFlag && $wasteclass['id'] == $manifest['wasteclassid'] ? 'selected' : ''). ">". $wasteclass['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>

                </div>
                <div class="col-lg-2">
                            <h4 class="example-title">Waste Name</h4>

                                <select data-plugin="selectpicker" name="itemnameid">
                                    <option value="0">Select Waste Name</option>
                                    <?php foreach ($itemnamees as $itemname): ?>

                                    <?="<option value='" .$itemname['id']."'". ($editFlag && $itemname['id'] == $manifest['itemnameid'] ? 'selected' : ''). ">". $itemname['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>

                </div>
                <div class="col-lg-2">
                            <h4 class="example-title">Others </h4>
                            <span class="text-danger"><?=form_error('otheritemname');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />

                </div>
                <div class="col-lg-2">
                            <h4 class="example-title">Quantity</h4>
                            <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                value="<?=($editFlag ? $employee['zip'] : '')?>" />
                </div>
                <div class="col-lg-2">

                            <h4 class="example-title">Unit</h4>

                                <select data-plugin="selectpicker">
                                    <?php foreach ($prefecture as $pref) : ?>
                                    <option value="<?php echo $pref['id']; ?>"><?php echo $pref['name']; ?></option>
                                    <?php endforeach;?>
                                </select>


                </div>
           </div>
        <br>
            <div class="row ">
                <div class="col-lg-4">
                       <h4 class="example-title">Forwarder <span class="badge badge-md badge-primary">1</span></h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                </div>
                <div class="col-lg-4">

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                </div>
                <div class="col-lg-4">
                        <h4 class="example-title"> Date</h4>
                        <span class="text-danger"><?=form_error('manifestdate');?></span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                            value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                        </div>
                </div>
            </div>
        <br>
            <div class="row ">
                <div class="col-lg-4">
                       <h4 class="example-title">Forwarder <span class="badge badge-md badge-primary">2</span></h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                </div>
                <div class="col-lg-4">

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                </div>
                <div class="col-lg-4">
                        <h4 class="example-title"> Date</h4>
                        <span class="text-danger"><?=form_error('manifestdate');?></span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                            value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                        </div>
                </div>
            </div>
        <br>
            <div class="row ">
                <div class="col-lg-4">
                       <h4 class="example-title">Forwarder <span class="badge badge-md badge-primary">3</span></h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                </div>
                <div class="col-lg-4">

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                </div>
                <div class="col-lg-4">
                        <h4 class="example-title"> Date</h4>
                        <span class="text-danger"><?=form_error('manifestdate');?></span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                            value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                        </div>
                </div>
            </div>
        <br>
            <div class="row ">
                <div class="col-lg-4">
                       <h4 class="example-title">Recycle Firm</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                </div>
                <div class="col-lg-4">

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                </div>
                <div class="col-lg-4">
                        <h4 class="example-title"> Date</h4>
                        <span class="text-danger"><?=form_error('manifestdate');?></span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                            value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                        </div>
                </div>
            </div>
        <br>
            <div class="row ">
                <div class="col-lg-2">
                            <h4 class="example-title">Disposal Method </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                </div>
                <div class="col-lg-2">
                            <h4 class="example-title"> Disposal Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>


                </div>
                <div class="col-lg-2">
                            <h4 class="example-title"> Receive Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>

                </div>
                <div class="col-lg-2">
                            <h4 class="example-title">Received by</h4>

                                <select data-plugin="selectpicker">
                                    <?php foreach ($prefecture as $pref) : ?>
                                    <option value="<?php echo $pref['id']; ?>"><?php echo $pref['name']; ?></option>
                                    <?php endforeach;?>
                                </select>

                </div>
                <div class="col-lg-2">
                            <h4 class="example-title"> Date Mailed</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                </div>
              </div>
            <br>
                <div class="row ">
                    <div class="col-lg-12">
                            <h4 class="example-title">Notes</h4>
                            <input type="text" class="form-control" name="position" placeholder="Position"
                                value="<?=($editFlag ? $employee['position'] : '')?>" />


                </div>
            </div>

        </div>


            <div class="panel-footer">
            <button class="btn btn-success" type="submit">
                <i class="aria-hidden=" true></i> Save
            </button>
            </div>
          <br>






</div><!-- End Page -->

