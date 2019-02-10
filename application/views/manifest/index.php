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
                  <th>Date Received</th>
                 <th>Contractor Branch</th>
                <th>Permit Class</th>
                <th>Waste Details</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Actions</th>

                </tr>
              </thead>
              <tbody>
               <?php foreach ($manifest as $man): ?>

                  <tr class="gradeA">
                   <td><b><?php echo $man['referenceno']; ?></b>
                       <br><p style="font-size:12px"><?php echo $man['datemanifest']; ?></p></td>
                   <td><?php echo $man['datereceived']; ?></td>
                      <td><b><?php echo $man['contractorbranch']; ?></b>
                          <br><p style="font-size:12px"><?php echo $man['contractor']; ?></p></td>
                    <td><?php echo $man['permitclass']; ?></td>
                    <td><?php echo $man['wasteclass']; ?>
                    <br><?php echo $man['itemname']; ?></td>
                    <td align="right"><?php echo number_format($man['qty'],2); ?></td>
                    <td><?php echo $man['itemunit']; ?></td>

                  <td class="actions">
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                      data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                      data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                    <a href="manifest/update/<?php echo $man['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                      data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="javascript:DeleteRecord('manifest/delete/<?php echo $man['id']; ?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
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

