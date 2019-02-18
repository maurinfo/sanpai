<div class="page-content">
    <div class="panel" id="projects">

        <div class="panel-heading">
            <h3 class="panel-title">Customers</h3>
        </div>
        <div class="panel-body">
          <a href="<?php echo base_url(); ?>customer/create">
          <button  class="btn  btn-success" type="button">
            <i class="icon md-plus" aria-hidden="true"></i> New
          </button>
         </a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>

                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Tel. No.</th>
                  <th>FAX</th>
                  <th>e-mail</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($customer as $con): ?>

                  <tr class="gradeA">
                  <td><?php echo $con['code']; ?></td>


                   <td><?php echo $con['name']; ?></td>

                   <td><?php echo $con['zip'] . ' ' . $con['address1'] . $con['address2']; ?></td>
                    <td><?php echo $con['telno']; ?></td>
                    <td><?php echo $con['faxno']; ?></td>
                  <td><?php echo $con['contactperson']; ?></td>
                  <td class="actions">

                    <a href="<?php echo base_url();?>customer/update/<?php echo $con['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                      data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="javascript:DeleteRecord('<?=base_url()?>customer/delete/<?=$con['id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                      data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                  </td>
                </tr>
                 <?php endforeach;?>

              </tbody>
            </table>
            <div class="panel-body">
                <div class="mb-15">
                    <?=$this->pagination->create_links()?>
                </div>
            </div>
      </div>

</div>


