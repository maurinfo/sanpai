<?php
$editFlag = isset($permit['id']);

echo $editFlag ?
form_open('permit/save/' . $permit['id']) :
form_open('permit/save');
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
            <a href="<?=base_url();?>permit">
                <h3 class="panel-title">
                    <?=$title;?>
                </h3>
            </a>
          <!--  /<?=$firmid?>/<?=$permittype?>-->
        </header>


            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">
                            <input type="hidden" name="firmid" value="<?=($editFlag ? $permit['firmid'] : $firmid)?>" />
                            <input type="hidden" name="permittype" value="<?=($editFlag ? $permit['permittype'] : $permittype)?>" />
                            <input type="hidden" name="id" value="<?=($editFlag ? $permit['id'] : '')?>" />
                            <h4 class="example-title">Prefecture</h4>
                            <div class="example">
                                <select data-plugin="selectpicker" name="prefectureid">
                                    <option value="0">Select Prefecture</option>
                                    <?php foreach ($prefectures as $prefecture): ?>

                                    <?="<option value='" .$prefecture['id']."'". ($editFlag && $prefecture['id'] == $permit['prefectureid'] ? 'selected' : ''). ">". $prefecture['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>
                            </div>
                            <h4 class="example-title">Permit Class</h4>
                            <div class="example">
                                <select data-plugin="selectpicker" name="permitclassid">
                                    <option value="0">Select Permit Class</option>
                                    <?php foreach ($permitclasses as $permitclass): ?>

                                    <?="<option value='" .$permitclass['id']."'". ($editFlag && $permitclass['id'] == $permit['permitclassid'] ? 'selected' : ''). ">". $permitclass['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>
                            </div>

                            <h4 class="example-title">Permit No</h4>
                            <input type="text" class="form-control" name="permitno" placeholder="Permit No."
                                value="<?=($editFlag ? $permit['permitno'] : '')?>" />


                            <!-- Panel Date Picker -->
                            <h4 class="example-title">Expiry Date</h4>
                            <span class="text-danger"><?=form_error('contractdate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="dateexpire" placeholder="MM/DD/YYYY"
                                    value="<?=($editFlag && isset($permit['dateexpire']) ? date("m/d/Y", strtotime($permit['dateexpire'])) : '')?>" />
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
