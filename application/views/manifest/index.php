<div class="page-content">
    <div class="panel" id="projects">
        <div class="panel-heading">
            <h3 class="panel-title">Manifests</h3>
        </div>
        <div class="panel-body">
            <a href="<?php echo base_url();?>manifest/create">
                <button class="btn  btn-success" type="button">
                    <i class="icon md-plus" aria-hidden="true"></i> New
                </button>
            </a>
            <!-- Search -->

            <div class="form-group-lg" style="float: right; width: 30%;">
                <form method="get" action="<?php echo base_url(); ?>/manifest" id="formsubmit" name="formsearch">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <?php $getpost = isset($_GET['search_text']) ? $_GET['search_text'] : ""?>
                            <input id="search_text" type="text" class="search-query form-control" placeholder="Search" value='<?php echo $getpost ?>' name="search_text" />
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
                        <th>Date Received</th>
                        <th>Reference No.</th>
                        <th>Contractor</th>
                        <th>Contractor Branch</th>
                        <th>Permit Class</th>
                        <th>Waste Class</th>
                        <th>Waste Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manifest as $man): ?>
                    <tr class="gradeA">
                        <td style="max-width:10px"><?php echo $man['datereceived']; ?></td>
                        <td><?php echo $man['referenceno']; ?></td>
                        <td><?php echo $man['contractor']; ?></td>
                        <td><?php echo $man['contractorbranch']; ?></td>
                        <td><?php echo $man['permitclass']; ?></td>
                        <td><?php echo $man['wasteclass']; ?></td>
                        <td><?php echo $man['itemname']; ?></td>
                        <td align="right"><?php echo number_format($man['qty'],2); ?></td>
                        <td><?php echo $man['itemunit']; ?></td>
                        <td class="actions">
                            <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row" data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                            <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row" data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                            <a href="<?php echo base_url();?>manifest/update/<?php echo $man['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                            <a href="javascript:DeleteRecord('manifest/delete/<?php echo $man['id']; ?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>


                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="panel-body paging-body">
                <div class="mb-15">
                    <?=$this->pagination->create_links()?>
                </div>
            </div>
        </div>
    </div>
    <!-- form Submit using button -->

    <script>
        $(document).ready(function() {

            $("#submitsearch").click(function(event) {
                event.preventDefault();
                $("form").submit();
            });
        });
    </script>
