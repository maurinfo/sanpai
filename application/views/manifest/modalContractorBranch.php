<div class="modal fade" id="contractorBranchModal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Select Branch</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="cbsearch" id="cbsearch" placeholder="Branch" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="cbtable" class="table table-striped table-hover">
                  <thead>
                     <tr>
                     　 <th style="width:15%">ID </th>
                        <th style="width:30%">Branch Name</th>
                        <th style="width:15%">Zip</th>
                        <th style="width:40%">Address</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button id="cbclosemodal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var cbtbody = $(".modal-body table tbody");

   function load_data1(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>contractorbranch/fetch",
         method: "POST",
         dataType : 'json',
         data: {
            query: query
         },
         success: function(data) {
            callbackfunc(data);
         }
      });
   }

   var delayTimeOut;

   function search1(stringToSearch1) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch1 == null ||
            stringToSearch1 == undefined ||
            stringToSearch1.length == 0)
         {
            cbtbody.empty().append('<tr class="table-info"><td colspan="4">No Data Found 2</td></tr>');
            return
         }

         load_data1(stringToSearch1, append_data1);

      }, 500);
   }

   function append_data1(data) {
      cbtbody.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            cbtbody.append($("<tr>")
               .append($("<td>").append(row.id))
               .append($("<td>").append(row.name))
               .append($("<td>").append(row.zip))
               .append($("<td>").append(row.address1))
            );
         })
      }else {
         cbtbody.append('<tr class="table-info"><td colspan="4">No Data Found  2</td></tr>');
      }
   }

   $('#cbsearch').on('input', function(e) {
      search1($(this).val());
   });

    $("#cbtable").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#contractorbranch").val($(this).find('td:eq(1)').text());
      $("#contractorbranchid").val($(this).find('td:eq(0)').text());

      // close the modal
      $( "#cbclosemodal" ).trigger( "click" );

   });


   $('#contractorBranchModal').on('show.bs.modal', function () {
        $( "#cbsearch" ).trigger( "input" );
    } );
    $('#contractorBranchModal').on('shown.bs.modal', function () {
        $('#cbsearch').focus();

    } );
</script>
