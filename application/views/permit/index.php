<div class="page-content">
    <div class="panel" id="projects">

        <div class="panel-heading">
            <h3 class="panel-title"><a style="text-decoration: none" href="<?php echo base_url();?><?=($permittype==1 ? 'forwarder">Forwarder ' : 'recyclefirm">Recycle Firms ')?></a>/ Permits</h3>
        </div>
        <div class="panel-body">
          <a href="<?php echo base_url(); ?>permit/create/<?=$firmid?>/<?=$permittype?>">
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
                  <th>Prefecture</th>
                  <th>Permit Class</th>
                    <th>Permit No</th>
                  <th>Expiry Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($permit as $con): ?>

                  <tr class="gradeA">
                        <td><?php echo $con['id']; ?></td>
                        <td><?php echo $con['prefecture']; ?></td>
                        <td><?php echo $con['permitclass']; ?></td>
                        <td><?php echo $con['permitno']; ?></td>

                        <td><?php echo $con['dateexpire']; ?></td>
                        <td class="actions">

                        <a href="<?php echo base_url();?>permit/update/<?php echo $con['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                          data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                        <a href="javascript:DeleteRecord('<?=base_url()?>permit/delete/<?=$con['id']?>/<?=$firmid?>/<?=$permittype?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                          data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                 <?php endforeach;?>

              </tbody>
            </table>
 <!--           <div class="panel-body">
                <div class="mb-15">
                    <?=$this->pagination->create_links()?>
                </div>
            </div>-->
      </div>

</div>


