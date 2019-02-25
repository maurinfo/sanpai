<div class="page-content">
   <div class="panel">
      <header class="panel-heading">
         <h3 class="panel-title">
            <a style= "text-decoration:none" href="<?=base_url();?>lists">Lists </a>
         </h3>
      </header>
      <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
               <!-- Example Tabs Left -->
               <div class="example-wrap m-xl-0">
                  <div class="nav-tabs-horizontal" data-plugin="tabs">
                     <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link <?=($tabno==1 ? 'active' : '')?>" data-toggle="tab" href="#wasteClassLine"
                           aria-controls="exampleTabsLineOne" role="tab">Waste Class</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link <?=($tabno==2 ? 'active' : '')?>" data-toggle="tab" href="#wasteNameLine"
                           aria-controls="exampleTabsLineTwo" role="tab">Waste Name</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link <?=($tabno==3 ? 'active' : '')?>" data-toggle="tab" href="#unitLine"
                           aria-controls="exampleTabsLineThree" role="tab">Unit</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link <?=($tabno==4 ? 'active' : '')?>" data-toggle="tab" href="#prefectureLine"
                           aria-controls="exampleTabsLineFour" role="tab">Prefecture</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link <?=($tabno==5 ? 'active' : '')?>" data-toggle="tab" href="#methodLine"
                           aria-controls="exampleTabsLineFive" role="tab">Disposal Method</a></li>
                     </ul>
                   </div>
                     <div class="tab-content pt-20">
                        <div class="tab-pane <?=($tabno==1 ? 'active' : '')?>" id="wasteClassLine" role="tabpanel">
                           <div class="panel-heading">
                              <a href="<?php echo base_url();?>wasteclass/create">
                              <button  class="btn  btn-success" type="button">
                              <i class="icon md-plus" aria-hidden="true"></i> New
                              </button>
                              </a>
                           </div>
                           <br>
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover " cellspacing="0" id="exampleAddRow">
                                 <thead>
                                    <tr>
                                       <th style ="width:10% right-margin:0">Code</th>
                                       <th>Name</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($wasteclasses as $row) : ?>
                                    <tr class="gradeA">
                                       <td><?php echo $row['code']; ?></td>
                                       <td><?php echo $row['name']; ?></td>
                                        <td style="width:7%" class="actions" align="right">
                                          <a href="<?php echo base_url();?>wasteclass/update/<?php echo $row['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                                             data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                          <a href="javascript:DeleteRecord('<?=base_url()?>wasteclass/delete/<?=$row['id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                             data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                                       </td>
                                    </tr>
                                    <?php endforeach;?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane <?=($tabno==2 ? 'active' : '')?>" id="wasteNameLine" role="tabpanel">
                           <div class="panel-heading">
                              <a href="<?php echo base_url();?>wastename/create">
                              <button  class="btn  btn-success" type="button">
                              <i class="icon md-plus" aria-hidden="true"></i> New
                              </button>
                              </a>
                           </div>
                           <br>
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover " cellspacing="0" id="exampleAddRow">
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Unit</th>
                                       <th>Category</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($items as $row) : ?>
                                    <tr class="gradeA">

                                       <td><?php echo $row['name']; ?></td>
                                       <td><?php echo $row['unit']; ?></td>
                                       <td><?php echo $row['category']; ?></td>
                                       <td style="width:7%" class="actions" align="right">
                                          <a href="<?php echo base_url();?>wastename/update/<?php echo $row['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                                             data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                          <a href="javascript:DeleteRecord('<?=base_url()?>wastename/delete/<?=$row['id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                             data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                                       </td>
                                    </tr>
                                    <?php endforeach;?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane <?=($tabno==3 ? 'active' : '')?>" id="unitLine" role="tabpanel">
                            <div class="panel-heading">
                              <a href="<?php echo base_url();?>itemunit/create">
                              <button  class="btn  btn-success" type="button">
                              <i class="icon md-plus" aria-hidden="true"></i> New
                              </button>
                              </a>
                           </div>
                           <br>
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover " cellspacing="0" id="exampleAddRow">
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($units as $row) : ?>
                                    <tr class="gradeA">

                                       <td><?php echo $row['name']; ?></td>
                                       <td style="width:7%" class="actions" align="right">
                                          <a href="<?php echo base_url();?>itemunit/update/<?php echo $row['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                                             data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                          <a href="javascript:DeleteRecord('<?=base_url()?>itemunit/delete/<?=$row['id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                             data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                                       </td>
                                    </tr>
                                    <?php endforeach;?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane <?=($tabno==4 ? 'active' : '')?>" id="prefectureLine" role="tabpanel">
                           <div class="panel-heading">
                              <a href="<?php echo base_url();?>prefecture/create">
                              <button  class="btn  btn-success" type="button">
                              <i class="icon md-plus" aria-hidden="true"></i> New
                              </button>
                              </a>
                           </div>
                           <br>
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover " cellspacing="0" id="exampleAddRow">
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($prefectures as $row) : ?>
                                    <tr class="gradeA">

                                       <td><?php echo $row['name']; ?></td>
                                       <td style="width:7%" class="actions" align="right">
                                          <a href="<?php echo base_url();?>prefecture/update/<?php echo $row['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                                             data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                          <a href="javascript:DeleteRecord('<?=base_url()?>prefecture/delete/<?=$row['id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                             data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                                       </td>
                                    </tr>
                                    <?php endforeach;?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane <?=($tabno==5 ? 'active' : '')?>" id="methodLine" role="tabpanel">
                           <div class="panel-heading">
                              <a href="<?php echo base_url();?>disposalmethod/create">
                              <button  class="btn  btn-success" type="button">
                              <i class="icon md-plus" aria-hidden="true"></i> New
                              </button>
                              </a>
                           </div>
                           <br>
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover " cellspacing="0" id="exampleAddRow">
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($disposalmethods as $row) : ?>
                                    <tr class="gradeA">

                                       <td><?php echo $row['name']; ?></td>
                                       <td style="width:7%" class="actions" align="right">
                                          <a href="<?php echo base_url();?>disposalmethod/update/<?php echo $row['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                                             data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                          <a href="javascript:DeleteRecord('<?=base_url()?>disposalmethod/delete/<?=$row['id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                             data-toggle="tooltip" data-original-title="Remove"><i class="icon md-close" aria-hidden="true"></i></a>
                                       </td>
                                    </tr>
                                    <?php endforeach;?>
                                 </tbody>
                              </table>
                           </div>
                        </div>




                     </div>



                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Panel Projects -->
