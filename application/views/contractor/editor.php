<?php
$editFlag = isset($contractor['id']);

echo $editFlag ?
form_open('contractor/save/' . $contractor['id']) :
form_open('contractor/save');
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

<div class="page-content">
    <div class="panel">

        <header class="panel-heading">

                <h3 class="panel-title">
                    <a style= "text-decoration:none" href="<?=base_url();?>contractor">Contractor / </a>
                    <?=$title;?>
                </h3>


        </header>


            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">
                            <input type="hidden" name="id" value="<?=($editFlag ? $contractor['id'] : '')?>" />

                            <div class="small-spacing">
                                <h4 class="example-title">Name</h4>
                                <span class="text-danger"><?=form_error('name');?></span>
                                <input type="text" class="form-control" name="name" placeholder="Name" 
                                    value="<?=($editFlag ? $contractor['name'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Furigana</h4>
                                <input type="text" class="form-control" name="yomi" placeholder="Furigana" 
                                    value="<?=($editFlag ? $contractor['yomi'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Contact Person</h4>
                                <span class="text-danger"><?=form_error('contactperson');?></span>
                                <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" 
                                    value="<?=($editFlag ? $contractor['contactperson'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Department</h4>
                                <input type="text" class="form-control" name="department" placeholder="Department" 
                                    value="<?=($editFlag ? $contractor['department'] : '')?>" 
                                />
                            </div>


                            <div class="small-spacing">
                                <h4 class="example-title">Zip Code</h4>
                                <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                    value="<?=($editFlag ? $contractor['zip'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Prefecture</h4>
                                <select data-plugin="selectpicker" name="prefectureid">
                                    <option value="0">Select Prefecture</option>
                                    <?php foreach ($prefectures as $prefecture): ?>
                                    <?="<option value='" .$prefecture['id']."'". ($editFlag && $prefecture['id'] == $contractor['prefectureid'] ? 'selected' : ''). ">". $prefecture['name']."</option>"?>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 1</h4>
                                <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                                    value="<?=($editFlag ? $contractor['address1'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 2</h4>
                                <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                                    value="<?=($editFlag ? $contractor['address2'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Tel. No.</h4>
                                <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                                    value="<?=($editFlag ? $contractor['telno'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Fax No.</h4>
                                <input type="text" class="form-control" name="faxno" placeholder="000-0000-0000 line 1"
                                    value="<?=($editFlag ? $contractor['faxno'] : '')?>"
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">E-mail</h4>
                                <span class="text-danger"><?=form_error('email');?></span>
                                <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                                    value="<?=($editFlag ? $contractor['email'] : '')?>"
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Notes</h4>
                                <input type="text" class="form-control" name="notes" placeholder="Notes"
                                    value="<?=($editFlag ? $contractor['notes'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Contract No.</h4>
                                <input type="text" class="form-control" name="contractno" placeholder="1234"
                                    value="<?=($editFlag ? $contractor['contractno'] : '')?>" 
                                />
                            </div>

                            <!-- Panel Date Picker -->
                            <div class="small-spacing">
                                <h4 class="example-title">Contract Date</h4>
                                <span class="text-danger"><?=form_error('contractdate');?></span>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="contractdate" placeholder="MM/DD/YYYY"
                                        value="<?=($editFlag && isset($contractor['contractdate']) ? date("m/d/Y", strtotime($contractor['contractdate'])) : '')?>" 
                                    />
                                </div>
                            </div>

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
    </div>
