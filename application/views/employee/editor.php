<?php
$editFlag = isset($employee['id']);

echo $editFlag ?
form_open('employee/save/' . $employee['id']) :
form_open('employee/save');
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
            <a href="<?=base_url();?>/employee">
                <h3 class="panel-title">
                    <?=$title;?>
                </h3>
            </a>
        </header>

        <div class="panel-body">

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">
                            <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $employee['id'] : '')?>" />

                            <div class="small-spacing">
                                <h4 class="example-title">Name</h4>
                                <span class="text-danger"><?=form_error('name');?></span>
                                <input type="text" class="form-control" name="name" placeholder="Name" 
                                    value="<?=($editFlag ? $employee['name'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Furigana</h4>
                                <input type="text" class="form-control" name="furigana" placeholder="Furigana" 
                                    value="<?=($editFlag ? $employee['furigana'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Birthdate</h4>
                                <span class="text-danger"><?=form_error('birthdate');?></span>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="9/9/1999" data-plugin="datepicker" name="birthdate"
                                        value="<?=($editFlag && isset($employee['birthdate']) ? date("m/d/Y", strtotime($employee['birthdate'])) : '')?>" 
                                    />
                                </div>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Gender</h4>
                                <div class="form-group">
                                    <select name="gender" data-plugin="selectpicker" class="form-control">
                                        <?="<option value='1' " . ($editFlag && $employee['gender'] == 1 ? 'selected' : '') . ">Male</option>"?>
                                        <?="<option value='0' " . ($editFlag && $employee['gender'] == 0 ? 'selected' : '') . ">Female</option>"?>
                                    </select>
                                </div>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Zip Code</h4>
                                <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                    value="<?=($editFlag ? $employee['zip'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 1</h4>
                                <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                                    value="<?=($editFlag ? $employee['address1'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 2</h4>
                                <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                                    value="<?=($editFlag ? $employee['address2'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Tel. No.</h4>
                                <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                                    value="<?=($editFlag ? $employee['telno'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">E-mail</h4>
                                <span class="text-danger"><?=form_error('email');?></span>
                                <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                                    value="<?=($editFlag ? $employee['email'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Position</h4>
                                <input type="text" class="form-control" name="position" placeholder="Position"
                                    value="<?=($editFlag ? $employee['position'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">TIME IN</h4>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="md-time"></span>
                                    </span>
                                    <input type="text" class="timepicker form-control" data-plugin="clockpicker" data-autoclose="true" name="schedulein"
                                        value="<?=($editFlag ? $employee['schedulein'] : '')?>" 
                                    />
                                </div>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">TIME OUT</h4>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="md-time"></span>
                                    </span>
                                    <input type="text" class="timepicker form-control" data-plugin="clockpicker" data-autoclose="true" name="scheduleout"
                                        value="<?=($editFlag ? $employee['scheduleout'] : '')?>" />
                                </div>
                            </div>

                            <!-- Panel Date Picker -->
                            <div class="small-spacing">
                                <h4 class="example-title">Hire Date</h4>
                                <span class="text-danger"><?=form_error('hiredate');?></span>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="hiredate"
                                        value="<?=($editFlag && isset($employee['hiredate']) ? date("m/d/Y", strtotime($employee['hiredate'])) : '')?>" 
                                    />
                                </div>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Resignation Date</h4>
                                <span class="text-danger"><?=form_error('resigndate');?></span>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="resigndate"
                                        value="<?=($editFlag && isset($employee['resigndate']) ? date("m/d/Y", strtotime($employee['resigndate'])) : '')?>" 
                                    />
                                </div>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Username</h4>
                                <span class="text-danger"><?=form_error('username');?></span>
                                <input type="text" class="form-control" name="username" placeholder="Username"
                                    value="<?=($editFlag ? $employee['username'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Password</h4>
                                <span class="text-danger"><?=form_error('password');?></span>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    value="<?=($editFlag ? $employee['password'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Re-Enter Password</h4>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Password"
                                    value="<?=($editFlag ? $employee['password'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">User Type</h4>
                                <div class="form-group">
                                    <select name="accesslevel" class="form-control">
                                        <?="<option value='0' " . ($editFlag && $employee['accesslevel'] == 0 ? 'selected' : '') . ">Administrator</option>"?>
                                        <?="<option value='1' " . ($editFlag && $employee['accesslevel'] == 1 ? 'selected' : '') . ">User</option>"?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-15">
                        <button class="btn btn-success" type="submit">
                            <i class="aria-hidden=" true></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Page -->
