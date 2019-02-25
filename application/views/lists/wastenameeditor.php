<?php
//print_r($categories);

$editFlag = isset($wastename['id']);

echo $editFlag ?
form_open('wastename/save/' . $wastename['id']) :
form_open('wastename/save');
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
                    <a style= "text-decoration:none" href="<?=base_url();?>lists/2">Lists / </a>
                    <?=$title;?>
                </h3>
        </header>


            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">
                            <input type="hidden" name="id" value="<?=($editFlag ? $wastename['id'] : '')?>" />


                            <h4 class="example-title">Name</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $wastename['name'] : '')?>" />

                            <h4 class="example-title">Furigana</h4>
                            <input type="text" class="form-control" name="yomi" placeholder="Furigana" value="<?=($editFlag ? $wastename['yomi'] : '')?>" />

                            <h4 class="example-title">Unit</h4>
                            <select data-plugin="selectpicker" name="unitid">
                                <option value="0">Select Unit</option>
                                <?php foreach ($units as $row): ?>

                                <?="<option value='" .$row['id']."'". ($editFlag && $row['id'] == $wastename['itemunitid'] ? 'selected' : ''). ">". $row['name']."</option>"?>

                                <?php endforeach;?>

                             </select>
                            <h4 class="example-title">Category</h4>
                            <select data-plugin="selectpicker" name="categoryid">
                                <option value="-1">Select Category</option>
                                <?php foreach ($categories as $row1): ?>

                                <?="<option value='" .$row1['id']."'". ($editFlag && $row1['id'] == $wastename['itemcategoryid'] ? 'selected' : ''). ">". $row1['name']."</option>"?>

                                <?php endforeach;?>
                             </select>

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
