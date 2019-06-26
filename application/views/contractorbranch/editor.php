<?php
$editFlag = isset($contractorbranch['id']);

echo $editFlag ?
form_open('contractorbranch/save/' . $contractorbranch['id']) :
form_open('contractorbranch/save');
?>

<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-touchspin/bootstrap-touchspin.css" />

<div class="page-content">
    <div class="panel">

        <header class="panel-heading">
                <h3 class="panel-title">
                    <a style= "text-decoration:none" href="<?=base_url();?>contractorbranch">Contractor Branch / </a>
                    <?=$title;?>
                </h3>
        </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">

                           <input type="hidden" name="id" value="<?=($editFlag ? $contractorbranch['id'] : '')?>" />
                            <input id="contractorid" type="hidden" name="contractorid" value="<?=($editFlag ? $contractorbranch['contractorid'] : '')?>" />

                            <div class="small-spacing">
                                <h4 class="example-title">Contractor</h4>
                                <span class="text-danger"><?=form_error('name');?></span>
                                <div class="input-group">
                                    <input id="cname" type="text" class="form-control" name="name" placeholder="Name"
                                       value="<?=($editFlag ? $contractorbranch['contractor'] : '')?>"
                                    />
                                  <div class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                                    </div>
                                </div>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Name</h4>
                                <span class="text-danger"><?=form_error('name');?></span>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $contractorbranch['name'] : '')?>" />
                            </div>

                            <div class="small-spacing">
								<h4 class="example-title">Furigana</h4>
								<input type="text" class="form-control" name="yomi" placeholder="Furigana" 
									value="<?=($editFlag ? $contractorbranch['yomi'] : '')?>" 
								/>
							</div>

                            <div class="small-spacing">
                                <h4 class="example-title">Contact Person</h4>
                                <span class="text-danger"><?=form_error('contactperson');?></span>
                                <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" 
                                    value="<?=($editFlag ? $contractorbranch['contactperson'] : '')?>"
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Department</h4>
                                <input type="text" class="form-control" name="department" placeholder="Department" 
                                    value="<?=($editFlag ? $contractorbranch['department'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Zip Code</h4>
                                <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                    value="<?=($editFlag ? $contractorbranch['zip'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Prefecture</h4>
                                <select data-plugin="selectpicker" name="prefectureid">
                                    <option value="0">Select Prefecture</option>
                                    <?php foreach ($prefectures as $prefecture): ?>
                                    <?="<option value='" . $prefecture['id'] . "'" . ($editFlag && $prefecture['id'] == $contractorbranch['prefectureid'] ? 'selected' : '') . ">" . $prefecture['name'] . "</option>"?>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 1</h4>
                                <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                                    value="<?=($editFlag ? $contractorbranch['address1'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 2</h4>
                                <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                                    value="<?=($editFlag ? $contractorbranch['address2'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Tel. No.</h4>
                                <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                                    value="<?=($editFlag ? $contractorbranch['telno'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Fax No.</h4>
                                <input type="text" class="form-control" name="faxno" placeholder="000-0000-0000 line 1"
                                    value="<?=($editFlag ? $contractorbranch['faxno'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">E-mail</h4>
                                <span class="text-danger"><?=form_error('email');?></span>
                                <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                                    value="<?=($editFlag ? $contractorbranch['email'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Notes</h4>
                                <input type="text" class="form-control" name="notes" placeholder="Notes"
                                    value="<?=($editFlag ? $contractorbranch['notes'] : '')?>" 
                                />
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
<!-- End Page -->

