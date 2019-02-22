<div class="page-content">
<div class="panel" id="projects">
   <div class="panel-heading">
      <h3 class="panel-title">Expenses</h3>
   </div>
   <div class="panel-body">
      <a href="<?php echo base_url();?>expense/create">
      <button  class="btn  btn-success" type="button">
      <i class="icon md-plus" aria-hidden="true"></i> New
      </button>
      </a>
   </div>
   <div class="table-responsive">
      <table class="table table-striped">
         <thead>
            <tr>
               <th>Date Received</th>
               <th>Reference No.</th>

               <th>Suppliers</th>
               <th>Sub Total</th>
               <th>Tax</th>
               <th>Total</th>
               <th>Note</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($expense as $sal): ?>
            <tr class="gradeA">
               <td><?php echo $sal['datedelivered']; ?></td>
               <td><?php echo $sal['referenceno']; ?></td>

               <td><?php echo $sal['name']; ?></td>
               <td align="right"><?php echo number_format($sal['subtotal'] , 2); ?></td>
               <td align="right"><?php echo number_format($sal['tax'] , 2); ?></td>
               <td align="right"><?php echo number_format($sal['total'] , 2); ?></td>
               <td><?php echo $sal['note']; ?></td>
               <td class="actions">
                  <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                     data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                  <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                     data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                  <a href="<?php echo base_url();?>expense/update/<?php echo $sal['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                     data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                  <a href="javascript:DeleteRecord('expense/delete/<?php echo $sal['id']; ?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
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
