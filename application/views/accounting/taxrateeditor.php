<?php
$editFlag = isset($taxrate['id']);

echo $editFlag ?
form_open('taxrate/save/' . $taxrate['id']) :
form_open('taxrate/save');
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

            <a style="text-decoration:none"href="<?=base_url();?>accounting/">Accounting /</a>

             <?=$title;?>
            </h3>
        </header>


            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="example-wrap">
                            <input type="hidden" name="id" value="<?=($editFlag ? $taxrate['id'] : '')?>" />


                            <!-- Panel Date Picker -->
                            <h4 class="example-title">Start Date</h4>
                            <span class="text-danger"><?=form_error('startdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="startdate" placeholder="MM/DD/YYYY"
                                    value="<?=($editFlag && isset($taxrate['startdate']) ? date("m/d/Y", strtotime($taxrate['startdate'])) : '')?>" />
                                </div>
                            </div>
                            <h4 class="example-title"> Rate</h4>
                            <div class="input-group">
                            <input type="text" class="form-control" name="rate" placeholder="Percentage"
                                value="<?=($editFlag ? number_format($taxrate['rate'],2) : '')?>" />
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
