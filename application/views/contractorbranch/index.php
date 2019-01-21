<div class="page-content">
    <div class="panel" id="projects">

        <div class="panel-heading">
            <h3 class="panel-title">Contractor Branches</h3>
        </div>
        <div class="panel-body">
          <a href="<?php echo base_url();?>contractorbranch/create">
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
               <?php foreach ($contractorbranch as $con) : ?>

                  <tr class="gradeA">
                  <td><?php echo $con['id']; ?></td>
                   <td><?php echo $con['name']; ?></td>

                   <td><?php echo $con['zip'].' '.$con['address1'].$con['address2']; ?></td>
                    <td><?php echo $con['telno']; ?></td>
                    <td><?php echo $con['faxno']; ?></td>
                  <td><?php echo $con['contactperson']; ?></td>
                  <td class="actions">
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                      data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                      data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                    <a href="contractorbranch/update/<?php echo $con['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                      data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="contractorbranch/delete/<?php echo $con['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
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


