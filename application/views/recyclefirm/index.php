<!--    <div class="page">
      <div class="page-header">
        <h1 class="page-title">conloyees</h1>
        <div class="page-header-actions">

        </div>
      </div>-->

      <div class="page-content">

        <!-- Panel Table Add Row -->
        <div class="panel">
            <header class="panel-heading">
            <h3 class="panel-title">Recycle Firm List</h3>
            </header>
            <div class="panel-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-15">
                    <a href="<?php echo base_url();?>recyclefirm/create">
                      <button  class="btn  btn-success" type="button">
                        <i class="icon md-plus" aria-hidden="true"></i> New Recycle Firm
                      </button>
                     </a>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover " cellspacing="0" id="exampleAddRow">
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
                   <?php foreach ($recyclefirm as $rec) : ?>

                      <tr class="gradeA">
                      <td><?php echo $rec['id']; ?></td>
                       <td><?php echo $rec['name']; ?></td>

                       <td><?php echo $rec['zip'].' '.$rec['address1'].$rec['address2']; ?></td>
                        <td><?php echo $rec['telno']; ?></td>
                        <td><?php echo $rec['faxno']; ?></td>
                      <td><?php echo $rec['contactperson']; ?></td>
                      <td class="actions">
                        <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                          data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                          data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                        <a href="conloyee/update/<?php echo $rec['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                          data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                        <a href="conloyee/delete/<?php echo $rec['id'];?>" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                          data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                     <?php endforeach;?>

                  </tbody>
                </table>
              </div>
        </div>
        <!-- End Panel Table Add Row -->

