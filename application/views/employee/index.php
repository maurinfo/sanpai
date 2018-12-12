<!--    <div class="page">
      <div class="page-header">
        <h1 class="page-title">Employees</h1>
        <div class="page-header-actions">

        </div>
      </div>-->

      <div class="page-content">

        <!-- Panel Table Add Row -->
        <div class="panel">
         <header class="panel-heading">
            <h3 class="panel-title">Employee List</h3>
          </header>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-15">
                <a href="<?php echo base_url();?>employee/input">
                  <button  class="btn  btn-success" type="button">
                    <i class="icon md-plus" aria-hidden="true"></i> Add Row
                  </button>
                 </a>
                </div>
              </div>
            </div>
            <table class="table table-bordered table-hover " cellspacing="0" id="exampleAddRow">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Birthday</th>
                  <th>E-Mail</th>
                  <th>Contact No.</th>
                  <th>Position</th>
                  <th>Username</th>        
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($employee as $emp) : ?>
                   
                  <tr class="gradeA">
                   <td><?php echo $emp['name']; ?></td>
                  <td><?php echo $emp['birthdate']; ?></td>
                   <td><?php echo $emp['email']; ?></td>
                    <td><?php echo $emp['telno']; ?></td>
                    <td><?php echo $emp['position']; ?></td>
                  <td><?php echo $emp['username']; ?></td>
                  <td class="actions">
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                      data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                      data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                    <a href="employee/input/<?php echo $emp['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                      data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="employee/delete/<?php echo $emp['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                      data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                  </td>
                </tr>
                 <?php endforeach;?> 

              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Table Add Row -->

  

      </div>
    </div>
    <!-- End Page -->

    