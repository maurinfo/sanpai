
<div class="page-content">
<div class="panel" id="projects">
   <div class="panel-heading">
      <h3 class="panel-title">Print Queue</h3>
   </div>
   <div class="panel-body">
      <a href="<?php echo base_url(); ?>PDF/create_pdf">
      <button  class="btn  btn-success" type="button">
      <i class="icon md-print" aria-hidden="true"></i> Print All
      </button>
      </a>
       <a href="<?php echo base_url(); ?>printq/clearall">
      <button  class="btn  btn-danger" type="button">
      <i class="icon md-delete" aria-hidden="true"></i> Clear All
      </button>
      </a>


  <!-- Search

   <div class="form-group-lg" style="float: right; width: 30%;">
       <form method="get" action="<?php echo base_url(); ?>/sale"  id="formsubmit" name="formsearch">
         <div id="custom-search-input">
            <div class="input-group col-md-12">
             <?php $getpost = isset($_GET['search_text']) ? $_GET['search_text'] : ""?>
               <input  id="search_text" type="text" class="search-query form-control" placeholder="Search" value='<?php echo $getpost ?>'  name="search_text" />
               <div class="input-group-append">
                  <button class="btn btn-success btn-icon md-search" type="button" id="submitsearch"></button>
               </div>
            </div>
         </div>
      </form>
   </div>

  Search -->


   </div>
   <div class="table-responsive">
      <table class="table table-striped">
         <thead>
            <tr>
               <th>Type</th>
               <th>Date</th>
               <th>Reference No.</th>
               <th>Customer</th>

            <!--   <th data-toggle="tooltip" data-original-title="Note">Note</th>
               <th aria-activedescendant=""class='text-right'>Sub Total</th>
               <th class='text-right'>Tax</th>
               <th class='text-right'>Total</th>
               <th>Actions</th> -->
            </tr>
         </thead>
         <tbody>
            <?php foreach ($printq as $prq): ?>
            <tr class="gradeA">
               <td ><?php echo $prq['type']; ?></td>
               <td ><?php echo $prq['date']; ?></td>
               <td><?php echo $prq['refno']; ?></td>
              <td><?php echo $prq['customer']; ?></td>

<!--
                <td align="right"><?php echo number_format($sal['subtotal'] , 0); ?></td>
               <td align="right"><?php echo number_format($sal['tax'] ,0); ?></td>
               <td align="right"><?php echo number_format($sal['total'] , 0); ?></td>
               <td alighn="right" class="actions">
                  <a href="<?php echo base_url(); ?>sale/update/<?php echo $sal['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                     data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                  <a href="javascript:DeleteRecord('sale/delete/<?php echo $sal['id']; ?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                     data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                   <a href="salepdf/create_pdf/<?php echo $sal['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default print"
                     data-toggle="tooltip" data-original-title="Print"><i class="icon md-print" aria-hidden="true"></i></a>
               </td>!-->
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
