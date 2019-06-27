<?php
$editFlag = isset($forwarder['id']);

echo $editFlag ?
form_open('forwarder/save/' . $forwarder['id']) :
form_open('forwarder/save');
?>

<div class="page-content">
    <div class="panel">

        <header class="panel-heading">
                <h3 class="panel-title">
                    <a style= "text-decoration:none" href="<?=base_url();?>forwarder">Forwarder / </a>
                    <?=$title;?>
                </h3>
        </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">
                            <input type="hidden" name="id" value="<?=($editFlag ? $forwarder['id'] : '')?>" />

                            <div class="small-spacing">
                                <h4 class="example-title">Name</h4>
                                <span class="text-danger"><?=form_error('name');?></span>
                                <input type="text" class="form-control" name="name" placeholder="Name" 
                                    value="<?=($editFlag ? $forwarder['name'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Furigana</h4>
                                <input type="text" class="form-control" name="yomi" placeholder="Furigana" 
                                    value="<?=($editFlag ? $forwarder['yomi'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Contact Person</h4>
                                <span class="text-danger"><?=form_error('contactperson');?></span>
                                <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" 
                                    value="<?=($editFlag ? $forwarder['contactperson'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Department</h4>
                                <input type="text" class="form-control" name="department" placeholder="Department" 
                                    value="<?=($editFlag ? $forwarder['department'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Zip Code</h4>
                                <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                    value="<?=($editFlag ? $forwarder['zip'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Prefecture</h4>
                                <select data-plugin="selectpicker" name="prefectureid">
                                    <option value="0">Select Prefecture</option>
                                    <?php foreach ($prefectures as $prefecture): ?>
                                    <?="<option value='" .$prefecture['id']."'". ($editFlag && $prefecture['id'] == $forwarder['prefectureid'] ? 'selected' : ''). ">". $prefecture['name']."</option>"?>
                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 1</h4>
                                <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                                    value="<?=($editFlag ? $forwarder['address1'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Address 2</h4>
                                <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                                    value="<?=($editFlag ? $forwarder['address2'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Tel. No.</h4>
                                <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                                    value="<?=($editFlag ? $forwarder['telno'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Fax No.</h4>
                                <input type="text" class="form-control" name="faxno" placeholder="000-0000-0000 line 1"
                                    value="<?=($editFlag ? $forwarder['faxno'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">E-mail</h4>
                                <span class="text-danger"><?=form_error('email');?></span>
                                <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                                    value="<?=($editFlag ? $forwarder['email'] : '')?>" 
                                />
                            </div>

                            <div class="small-spacing">
                                <h4 class="example-title">Notes</h4>
                                <input type="text" class="form-control" name="notes" placeholder="Notes"
                                    value="<?=($editFlag ? $forwarder['notes'] : '')?>" 
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
