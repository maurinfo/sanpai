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

<!-- MODAL WINDOW-->
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Manifest Table Lookup</h4>
          </div>
          <div class="modal-body">
           <div class="table-responsive">
              <table class="table" id="example">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Zip</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Name1</td>
                    <td>Zip</td>
                    <td>Address</td>
                  </tr>
                 <tr>
                    <td>Name1</td>
                    <td>Zip</td>
                    <td>Address</td>
                  </tr>
                 <tr>
                    <td>Name1</td>
                    <td>Zip</td>
                    <td>Address</td>
                  </tr>
                    <tr>
                    <td>Name1</td>
                    <td>Zip</td>
                    <td>Address</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

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

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">

                            <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $manifest['id'] : '')?>" />

                            <h4 class="example-title"> Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>

                            <h4 class="example-title">Reference No</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest[referenceno] : '')?>" />

                            <h4 class="example-title">In Charge</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />

                            <h4 class="example-title">Contractor</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                            <h4 class="example-title">Contractor Branch</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractorbranch'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                                </div>
                              </div>

                            <h4 class="example-title">Permit Class</h4>
                            <div class="example">
                                <select data-plugin="selectpicker" name="permitclassid">
                                    <option value="0">Select Permit Class</option>
                                    <?php foreach ($permitclasses as $permitclass): ?>

                                    <?="<option value='" .$permitclass['id']."'". ($editFlag && $permitclass['id'] == $manifest['permitclassid'] ? 'selected' : ''). ">". $permitclass['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>
                            </div>

                            <h4 class="example-title">Waste Class</h4>
                            <div class="example">
                                <select data-plugin="selectpicker" name="wasteclassid">
                                    <option value="0">Select Waste Class</option>
                                    <?php foreach ($wasteclasses as $wasteclass): ?>

                                    <?="<option value='" .$wasteclass['id']."'". ($editFlag && $wasteclass['id'] == $manifest['wasteclassid'] ? 'selected' : ''). ">". $wasteclass['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>
                            </div>

                            <h4 class="example-title">Waste Name</h4>
                            <div class="example">
                                <select data-plugin="selectpicker" name="itemnameid">
                                    <option value="0">Select Waste Name</option>
                                    <?php foreach ($itemnamees as $itemname): ?>

                                    <?="<option value='" .$itemname['id']."'". ($editFlag && $itemname['id'] == $manifest['itemnameid'] ? 'selected' : ''). ">". $itemname['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>
                            </div>

                            <h4 class="example-title">Others </h4>
                            <span class="text-danger"><?=form_error('otheritemname');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />

                            <h4 class="example-title">Department</h4>
                            <input type="text" class="form-control" name="furigana" placeholder="Furigana" value="<?=($editFlag ? $employee['furigana'] : '')?>" />


                            <h4 class="example-title">Quantity</h4>
                            <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                value="<?=($editFlag ? $employee['zip'] : '')?>" />


                            <h4 class="example-title">Unit</h4>
                            <div class="example">
                                <select data-plugin="selectpicker">
                                    <?php foreach ($prefecture as $pref) : ?>
                                    <option value="<?php echo $pref['id']; ?>"><?php echo $pref['name']; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <h4 class="example-title">Forwarder</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                            <h4 class="example-title"> Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>

                            <h4 class="example-title">Forwarder</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                            <h4 class="example-title"> Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>
                            <h4 class="example-title">Forwarder</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                            <h4 class="example-title"> Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>

                            <h4 class="example-title">Recycle Firm</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>

                            <h4 class="example-title">Permit </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                            <h4 class="example-title"> Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>
                            <h4 class="example-title">Disposal Method </h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $manifest['contractor'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                              </div>
                            </div>
                            <h4 class="example-title"> Disposal Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>


                            <h4 class="example-title"> Receive Date</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>
                            <h4 class="example-title">Received by</h4>
                            <div class="example">
                                <select data-plugin="selectpicker">
                                    <?php foreach ($prefecture as $pref) : ?>
                                    <option value="<?php echo $pref['id']; ?>"><?php echo $pref['name']; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <h4 class="example-title"> Date Mailed</h4>
                            <span class="text-danger"><?=form_error('manifestdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="datemanifest"
                                    value="<?=($editFlag && isset($manifest['datemanifest']) ? date("m/d/Y", strtotime($manifest['datemanifest'])) : '')?>" />
                                </div>
                            </div>
                            <h4 class="example-title">Notes</h4>
                            <input type="text" class="form-control" name="position" placeholder="Position"
                                value="<?=($editFlag ? $employee['position'] : '')?>" />


                        </div>
                    </div>

                </div>
                </div>

            <div class="panel-footer">
            <button class="btn btn-success" type="submit">
                <i class="aria-hidden=" true></i> Save
            </button>
            </div>





    </div>
</div><!-- End Page -->

