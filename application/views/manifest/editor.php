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
            <a href="<?=base_url();?>/manifest">
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


                            <h4 class="example-title"> Date</h4>
                            <span class="text-danger"><?=form_error('hiredate');?></span>
                            <div class="example">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="icon md-calendar" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" data-plugin="datepicker" name="hiredate"
                                    value="<?=($editFlag && isset($employee['hiredate']) ? date("m/d/Y", strtotime($employee['hiredate'])) : '')?>" />
                                </div>
                            </div>
                            <h4 class="example-title">Reference No</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />
                             <h4 class="example-title">In Charge</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />

                            <h4 class="example-title">Contractor</h4>
                            <span class="text-danger"><?=form_error('name');?></span>

                            <div class="input-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />
                                <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                                </div>
                            </div>
                            <h4 class="example-title">Branch Name</h4>
                            <span class="text-danger"><?=form_error('name');?></span>

                            <div class="input-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />
                                <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                                </div>
                            </div>

                            <h4 class="example-title">Permit</h4>
                            <input type="text" class="form-control" name="furigana" placeholder="Furigana" value="<?=($editFlag ? $employee['furigana'] : '')?>" />

                            <h4 class="example-title">Contact Person</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $employee['name'] : '')?>" />

                            <h4 class="example-title">Department</h4>
                            <input type="text" class="form-control" name="furigana" placeholder="Furigana" value="<?=($editFlag ? $employee['furigana'] : '')?>" />


                            <h4 class="example-title">Zip Code</h4>
                            <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                value="<?=($editFlag ? $employee['zip'] : '')?>" />

                            <h4 class="example-title">Prefecture</h4>
                            <div class="example">
                                <select data-plugin="selectpicker">
                                    <?php foreach ($prefecture as $pref) : ?>
                                    <option value="<?php echo $pref['id']; ?>"><?php echo $pref['name']; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <h4 class="example-title">Address 1</h4>
                            <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                                value="<?=($editFlag ? $employee['address1'] : '')?>" />

                            <h4 class="example-title">Address 2</h4>
                            <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                                value="<?=($editFlag ? $employee['address2'] : '')?>" />

                            <h4 class="example-title">Tel. No.</h4>
                            <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                                value="<?=($editFlag ? $employee['telno'] : '')?>" />

                            <h4 class="example-title">E-mail</h4>
                            <span class="text-danger"><?=form_error('email');?></span>
                            <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                                value="<?=($editFlag ? $employee['email'] : '')?>" />

                            <h4 class="example-title">Notes</h4>
                            <input type="text" class="form-control" name="position" placeholder="Position"
                                value="<?=($editFlag ? $employee['position'] : '')?>" />



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

  <script type="text/javascript">
      $(document).ready(function() {
           $('#example').DataTable();
         } );

       var table= $('#example').DataTable();
       var tableBody = '#modal-body';
       $(tableBody).on('click', 'tr', function () {
           var cursor = table.row($(this).parents('tr'));//get the clicked row
           var data=cursor.data();// this will give you the data in the current row.
        $('form').find("input[name='name'][type='text']").val(data.name);
        });

    </script>
