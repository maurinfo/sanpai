<div class="page-content">
    <div class="panel" id="projects">
        <div class="panel-heading">
            <h3 class="panel-title">売上書 SA</h3>
        </div>
        <div class="panel-body">
            <a href="<?php echo base_url(); ?>sale/create">
                <button name="new" class="btn  btn-success" type="button">
                    <i class="icon md-plus" aria-hidden="true"></i> New
                </button>
            </a>

            <!-- Search -->

            <div class="form-group-lg" style="float: right; width: 30%;">
                <form method="get" action="<?php echo base_url(); ?>/sale" id="formsubmit" name="formsearch">
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
                        <th>Date</th>
                        <th>Reference No.</th>
                        <th>Customer</th>
                        <th>Note</th>
                        <th>Sub Total</th>
                        <th>Tax</th>
                        <th>Total</th>
                        <th style="width:10%; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sale as $sal): ?>
                    <tr class="gradeA">
                        <td style="line-height:14px"><?php echo $sal['datedelivered']; ?></td>
                        <td style="line-height:14px"><?php echo $sal['referenceno']; ?></td>
                        <td style="line-height:14px"><?php echo $sal['name']; ?></td>
                        <td><?php echo $sal['note']; ?></td>
                        <td style="line-height:14px; text-align:right;"><?php echo number_format($sal['subtotal'] , 0); ?></td>
                        <td style="line-height:14px; text-align:right;"><?php echo number_format($sal['tax'] ,0); ?></td>
                        <td style="line-height:14px; text-align:right;"><?php echo number_format($sal['total'] , 0); ?></td>
                        <td style="line-height:14px;" class="actions">
                            <a href="<?php echo base_url(); ?>sale/update/<?php echo $sal['id']; ?>" 
                                class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" 
                                data-toggle="tooltip" data-original-title="Edit"
                            >
                                <i class="icon md-edit" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:DeleteRecord('sale/delete/<?php echo $sal['id']; ?>')" 
                                class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" 
                                data-toggle="tooltip" data-original-title="Remove"
                            >
                                <i class="icon md-close" aria-hidden="true"></i>
                            </a>
                            <button type="button" id="<?php echo $sal['id']; ?>" name="print<?php echo $sal['id']; ?>" 
                                class="btn-pure btn-<?=($sal['referenceid']==null ? 'default' : 'danger')?> icon md-print" 
                                data-toggle="tooltip" data-original-title="Print">
                            </button>
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

    <script type="text/javascript">
        var baseURL = "<?php echo base_url();?>";
    </script>
    <script type='text/javascript' src="<?php echo base_url(); ?>js/sale.js"></script>
