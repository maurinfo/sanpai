<?php echo validation_errors();?>

<?php 
if ($action=='add') {
  echo form_open('employee/save');
} else{
echo form_open('employee/save/'.$employee['id']);
echo $employee['gender'];
}



//print_r($employee)
?>


<link rel="stylesheet" href="<?php echo base_url();?>global/vendor/select2/select2.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/bootstrap-select/bootstrap-select.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/icheck/icheck.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/switchery/switchery.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/asrange/asRange.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/ionrangeslider/ionrangeslider.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/asspinner/asSpinner.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/clockpicker/clockpicker.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/ascolorpicker/asColorPicker.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/bootstrap-touchspin/bootstrap-touchspin.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/jquery-labelauty/jquery-labelauty.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/timepicker/jquery-timepicker.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/jquery-strength/jquery-strength.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/multi-select/multi-select.css">
        <link rel="stylesheet" href="<?php echo base_url();?>global/vendor/typeahead-js/typeahead.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/examples/css/forms/advanced.css">

      <div class="page-content">
          <div class="panel">
          
            <header class="panel-heading">
              <a href="<?php echo base_url();?>/employee"><h3 class="panel-title"><?php echo $title ;?></h3></a>
            </header>
          
            <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                  <button class="btn btn-success" type="submit">
                    <i class="aria-hidden="true"></i> Save
                  </button>
                </div>
              </div>
            </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                    <div class="example-wrap">
                        <input type="hidden" name="id"  placeholder="Name" value="<?php  echo $employee['id'];?>">  
                        
                        <h4 class="example-title">Name</h4>
                        <input type="text" class="form-control" name="name"  placeholder="Name" value="<?php 
                              if ($action=='edit'){echo $employee['name'];}?>">    
                        
                        <h4 class="example-title">Furigana</h4>
                        <input type="text" class="form-control" name="furigana" placeholder="Furigana" value="<?php 
                              if ($action=='edit'){echo $employee['furigana'];}?>">    

                                        <!-- Panel Date Picker -->
                        <h4 class="example-title">Birthdate</h4>
                        <div class="example">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="icon md-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="9/9/1999" data-plugin="datepicker" name="birthdate" value="<?php 
                            if ($action=='edit'){echo (date("m/d/Y",strtotime($employee['birthdate'])));}?>">    
                          </div>
                        </div>

                                <!-- End Example Default Datepicker 
                        <div class="radio-custom radio-success">
                            <input type="radio"  id="
                            inputRadiosChecked" value="1" name="gender" checked />
                            <label for="inputRadiosChecked" style="margin-right: 100px">Male   </label>
                            <input type="radio" id="inputRadiosUnChecked" value="0" name="gender"  />
                            <label for="inputRadiosUnchecked">Female</label>
                        </div> -->
                        
                          <h4 class="example-title">Gender</h4>

                          <div class="form-group">
                            <select id ="gender" class="form-control">
                            <?php 
                                if ($action=='edit'){
                                  switch ($employee['gender']) {
                                      case 1:{
                                         
                                          echo '<option value="1" selected="selected"> Male </option>';
                                          echo '<option value="0" >Female</option>';
                                          break;
                                        }
                                      case 0:{
                                         
                                          echo '<option value="1" >Male</option>';
                                          echo '<option value="0" selected="selected"> Female </option>';
                                          break;
                                      }
                                  }
                                 
                                }else{
                                    echo '<option value="1" > Male </option>';
                                    echo '<option value="0" selected="selected"> Female</option>';
                                }
                            ?>
                            <!--    <option value="1" selected="selected">Male</option>
                                <option value="0" >Female</option> -->
                            </select>
                          </div>                         
                        
                        <h4 class="example-title">Zip Code</h4>
                        <input type="text" class="form-control" name="zip" placeholder="123-4567">
                        <h4 class="example-title">Address 1</h4>
                        <input type="text" class="form-control" name="address1" placeholder="Prefeture and City ">
                        <h4 class="example-title">Address 2</h4>
                        <input type="text" class="form-control" name="address2" placeholder="Street and Building">
                        <h4 class="example-title">Tel. No.</h4>
                        <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1">
                        <h4 class="example-title">E-mail</h4>
                        <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com">
                        <h4 class="example-title">Position</h4>
                        <input type="text" class="form-control" name="position" placeholder="Position">

                        <h4 class="example-title">TIME IN</h4>
                        <div class="example">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="md-time"></span>
                              </span>
                              <input type="text" class="timepicker form-control" data-plugin="clockpicker" data-autoclose="true">
                            </div>
                        </div>
                      
                        <h4 class="example-title">TIME OUT</h4>
                        <div class="example">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="md-time"></span>
                              </span>
                              <input type="text" class="timepicker form-control" data-plugin="clockpicker" data-autoclose="true">
                            </div>
                        </div>
                        
                                       <!-- Panel Date Picker -->
                          <h4 class="example-title">Resignation Date</h4>
                          <div class="example">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="icon md-calendar" aria-hidden="true"></i>
                              </span>
                              <input type="text" class="form-control" data-plugin="datepicker" name="resigndate">
                            </div>
                          </div>
                        
                        
                        <h4 class="example-title">Username</h4>
                        <input type="text" class="form-control" name="username" placeholder="Username">    
                        <h4 class="example-title">Password</h4>
                        <input type="password" class="form-control" name="password" placeholder="Password">

                    </div>
                </div>
              </div>
            </div>
               　　
        </div>
        
  

      </div><!-- End Page -->

 