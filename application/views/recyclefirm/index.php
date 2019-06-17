<div class="page-content">
    <div class="panel" id="projects">

        <div class="panel-heading">
            <h3 class="panel-title">Recycle Firms</h3>
        </div>
        <div class="panel-body">
          <a href="<?php echo base_url();?>recyclefirm/create">
          <button  class="btn  btn-success" type="button">
            <i class="icon md-plus" aria-hidden="true"></i> New
          </button>
         </a>
            
            <!-- Search -->

             <div class="form-group-lg" style="float: right; width: 30%;">
                 <form method="get" action="<?php echo base_url(); ?>/recyclefirm"  id="formsubmit" name="formsearch">
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

            <!-- Search -->
            
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
                  <th>Contact Person</th>
                  <th>Permit</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($recyclefirm as $con) : ?>

                  <tr class="gradeA">
                  <td><?php echo $con['id']; ?></td>
                   <td><?php echo $con['name']; ?></td>

                   <td><?php echo $con['zip'].' '.$con['address1'].$con['address2']; ?></td>
                    <td><?php echo $con['telno']; ?></td>
                    <td><?php echo $con['faxno']; ?></td>
                  <td><?php echo $con['contactperson']; ?></td>
                  <td><a href="<?php echo base_url();?>permit/<?php echo $con['id']; ?>/2/"  style ="text-decoration: none" class="badge badge-<?=($con['haspermit']==1 ? 'primary">View Permit' : 'danger"> No Permit')?></a></td>
                  <td class="actions">
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                      data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                      data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                    <a href="recyclefirm/update/<?php echo $con['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                      data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="recyclefirm/delete/<?php echo $con['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
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

<script>
  $(document).ready(function() {

       $("#submitsearch").click(function (event) {
            event.preventDefault();
        $("form").submit();
    });
});
</script>

