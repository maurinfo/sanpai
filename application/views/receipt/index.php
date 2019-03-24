<div class="page-content">
<div class="panel" id="projects">
   <div class="panel-heading">
      <h3 class="panel-title">receipts</h3>
   </div>
   <div class="panel-body">
      <a href="<?php echo base_url();?>receipt/create">
      <button  class="btn  btn-success" type="button">
      <i class="icon md-plus" aria-hidden="true"></i> New
      </button>
      </a>

   <div class="form-group-lg" style="float: right; width: 30%;">
       <form method="get" action="<?php echo base_url(); ?>receipt"  id="formsubmit" customer="formsearch">
         <div id="custom-search-input">
            <div class="input-group col-md-12">
               <?php $getpost = isset($_GET['search_text']) ? $_GET['search_text'] : ""?>
               <input  id="search_text" type="text" class="search-query form-control" placeholder="Search" value='<?php echo $getpost ?>'  customer="search_text" />
               <div class="input-group-append">
                  <button class="btn btn-success btn-icon md-search" type="button" id="submitsearch"></button>
               </div>
            </div>
         </div>
      </form>
   </div>

  <!-- Search -->

   </div>
   <div class="table-responsive">
      <table class="table table-striped">
         <thead>
            <tr>
               <th>Date</th>
               <th>Reference No.</th>
               <th>Customer</th>
               <th>Total</th>
               <th>Note</th>
               <th style="width:10%" align="right">Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($receipt as $sal): ?>
            <tr class="gradeA">
               <td><?php echo $sal['datereceipt']; ?></td>
               <td><?php echo $sal['referenceno']; ?></td>
               <td><?php echo $sal['customer']; ?></td>
          <!--     <td class="alight-right"><?php echo number_format($sal['subtotal'] , 0); ?></td>
               <td class="alight-right"><?php echo number_format($sal['tax'] ,0); ?></td> -->
               <td class='alight-right'><?php echo number_format($sal['total'] , 0); ?></td>
               <td><?php echo $sal['note']; ?></td>
               <td  class="actions" align="right">
                  <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                     data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                  <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                     data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>

                   <a href="<?php echo base_url();?>receipt/update/<?php echo $sal['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                     data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>

                   <a href="javascript:DeleteRecord('receipt/delete/<?php echo $sal['id']; ?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                     data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>

                   <a href="printmanifest/create_pdf/" class="btn btn-sm btn-icon btn-pure btn-default on-default print"
                     data-toggle="tooltip" data-original-title="Print"><i class="icon md-print" aria-hidden="true"></i></a>
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

<!-- form Submit using button -->

<script>
  $(document).ready(function() {

       $("#submitsearch").click(function (event) {
            event.preventDefault();
        $("form").submit();
    });
});
</script>

<!-- form Submit using button -->
