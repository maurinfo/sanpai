
 <!-- RYD Added -->
<!-- The Modal -->
<div class="modal fade" id="myModal" style="margin-top: 50px;">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Contractor Table Lookup</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->

        <div class="modal-body">
          <form method="POST" action="" name="ajx">
              <input type="text" name="search_text" id="search_text" placeholder="Contractor" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
         </form>

         <div id="table-lst-regions">
             <table id="result" class="fixed_header table-striped table-hover">

                 <!--*****************************************-->
                 <!--Data Will be insert here using result ID -->
                 <!--*****************************************-->

            </tbody></table>
         </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button id="closemodal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

 <!-- RYD Added -->



<?php
$editFlag = isset($contractorbranch['id']);

echo $editFlag ?
form_open('contractorbranch/save/' . $contractorbranch['id']) :
form_open('contractorbranch/save');
?>

<link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-touchspin/bootstrap-touchspin.css" />


<div class="page-content">
    <div class="panel">

        <header class="panel-heading">
            <a href="<?=base_url();?>contractorbranch">
                <h3 class="panel-title">
                    <?=$title;?>
                </h3>
            </a>
        </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="example-wrap">

                           <input type="hidden" name="id" value="<?=($editFlag ? $contractorbranch['id'] : '')?>" />



                            <h4 class="example-title">Contractor</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <div class="input-group">
                              <input id="cname" type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $contractorbranch['name'] : '')?>" />
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Browse</button>
                                </div>
                              </div>
                            <input id="contractorid" type="hidden" name="contractorid" value="<?=($editFlag ? $contractorbranch['contractorid'] : '')?>" />
                            <h4 class="example-title">Name</h4>
                            <span class="text-danger"><?=form_error('name');?></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?=($editFlag ? $contractorbranch['name'] : '')?>" />

                            <h4 class="example-title">Furigana</h4>
                            <input type="text" class="form-control" name="yomi" placeholder="Furigana" value="<?=($editFlag ? $contractorbranch['yomi'] : '')?>" />

                            <h4 class="example-title">Contact Person</h4>
                            <span class="text-danger"><?=form_error('contactperson');?></span>
                            <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" value="<?=($editFlag ? $contractorbranch['contactperson'] : '')?>" />

                            <h4 class="example-title">Department</h4>
                            <input type="text" class="form-control" name="department" placeholder="Department" value="<?=($editFlag ? $contractorbranch['department'] : '')?>" />


                            <h4 class="example-title">Zip Code</h4>
                            <input type="text" class="form-control" name="zip" placeholder="123-4567"
                                value="<?=($editFlag ? $contractorbranch['zip'] : '')?>" />

                            <h4 class="example-title">Prefecture</h4>
                            <div class="example">
                                <select data-plugin="selectpicker" name="prefectureid">
                                    <option value="0">Select Prefecture</option>
                                    <?php foreach ($prefectures as $prefecture): ?>

                                    <?="<option value='" .$prefecture['id']."'". ($editFlag && $prefecture['id'] == $contractorbranch['prefectureid'] ? 'selected' : ''). ">". $prefecture['name']."</option>"?>

                                    <?php endforeach;?>
                                </select>
                            </div>
                            <h4 class="example-title">Address 1</h4>
                            <input type="text" class="form-control" name="address1" placeholder="Prefeture and City "
                                value="<?=($editFlag ? $contractorbranch['address1'] : '')?>" />

                            <h4 class="example-title">Address 2</h4>
                            <input type="text" class="form-control" name="address2" placeholder="Street and Building"
                                value="<?=($editFlag ? $contractorbranch['address2'] : '')?>" />

                            <h4 class="example-title">Tel. No.</h4>
                            <input type="text" class="form-control" name="telno" placeholder="000-0000-0000 line 1"
                                value="<?=($editFlag ? $contractorbranch['telno'] : '')?>" />

                                <h4 class="example-title">Fax No.</h4>
                            <input type="text" class="form-control" name="faxno" placeholder="000-0000-0000 line 1"
                                value="<?=($editFlag ? $contractorbranch['faxno'] : '')?>" />

                            <h4 class="example-title">E-mail</h4>
                            <span class="text-danger"><?=form_error('email');?></span>
                            <input type="text" class="form-control" name="email" placeholder="john.doe@mail.com"
                                value="<?=($editFlag ? $contractorbranch['email'] : '')?>" />

                            <h4 class="example-title">Notes</h4>
                            <input type="text" class="form-control" name="notes" placeholder="Notes"
                                value="<?=($editFlag ? $contractorbranch['notes'] : '')?>" />

                        </div>
                    </div>
                </div>

            </div>

            <div class="panel-footer">
            <button class="btn btn-success" type="submit">
                <i class="aria-hidden=" true></i> Save
            </button>
            </div>


        </div>
    </div>
<!-- End Page -->

 <!-- Ruel Added -->
<script>

function load_data(query)
 {


  $.ajax({
    url: "<?php echo base_url(); ?>index.php/contractorbranch/fetch",
    method: "POST",
    data: {
        query: query
    },
    success: function(data) {
        $('#result').html(data);
    }
});

}

 $('#search_text').on('input', function(e) {

    var search = $(this).val();
    if (search != null || search != '' || search != 'undefined' || search != undefined) {
        if (search.length > 0) {
            load_data(search);
        } else {

            $('#result').html("<div> No Data Found </div>");
       }
    }
});


  $("#result").on("click", "tr", function() {

    // Set the input field  value  from the modal table.
   $("#cname").val($(this).find('td:eq(1)').text());
   $("#contractorid").val($(this).find('td:eq(0)').text());

    // close the modal
     $( "#closemodal" ).trigger( "click" );

  });

</script>
<!-- Ruel Added -->

