<div class="page-content">
    <div class="panel" id="projects">
        <div class="panel-heading">
            <h3 class="panel-title">Manifests</h3>
        </div>
        <div class="panel-body">
          <a href="<?php echo base_url();?>manifest/create">
          <button  class="btn  btn-success" type="button">
            <i class="icon md-plus" aria-hidden="true"></i> New
          </button>
         </a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>

                  <th>Reference No.</th>
                  <th>Date</th>
                  <th>In-charge</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($manifest as $man): ?>

                  <tr class="gradeA">
                   <td><?php echo $man['referenceno']; ?></td>
                   <td><?php echo $man['datemanifest']; ?></td>
                    <td><?php echo $man['contractor']; ?></td>
                    <td><?php echo $man['contractorbranch']; ?></td>
                    <td><?php echo $man['permitclass']; ?></td>
                    <td><?php echo $man['wasteclass']; ?></td>
                    <td><?php echo $man['itemname']; ?></td>
                    <td><?php echo $man['qty']; ?></td>
                    <td><?php echo $man['itemunit']; ?></td>
               <!--     <td><?php echo $man['incharge'] . ' ' . $man['address1'] . $man['address2']; ?></td>
                    <td><?php echo $man['telno']; ?></td>
                   <td><?php echo $man['faxno']; ?></td>
                  <td><?php echo $man['contactperson']; ?></td> -->

                  <td class="actions">
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                      data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                      data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                    <a href="conloyee/update/<?php echo $man['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                      data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="conloyee/delete/<?php echo $man['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
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

