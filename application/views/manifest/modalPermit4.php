<div class="modal fade" id="permitModal4" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Select Permit</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
        <!--    <form method="POST" action="" name="ajx">
               <input type="hidden" name="pSearch4" id="pSearch4" placeholder="Branch" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>-->
            <div id="table-lst-regions">
               <table id="pTable4" class="table table-striped table-hover">
                  <thead>
                     <tr>
                        <th style= "display:none">id</th>
                     　 <th style="width:20%">Prefecture </th>
                        <th style="width:20%">Permit Class</th>
                        <th style="width:40%">Permit No</th>
                        <th style="width:20%">Expiry Date</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button id="pclosemodal4" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var ptbody4 = $(".modal-body table tbody");

   function pLoadData4(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>permit/fetch/",
         method: "POST",
         dataType : 'json',
         data: {
            query: query,
            permittype:'2'
         },
         success: function(data) {
            callbackfunc(data);
         }
      });
   }

   var delayTimeOut;

   function psearch4(stringToSearch4) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch4 == null ||
            stringToSearch4 == undefined ||
            stringToSearch4.length == 0)
         {
            ptbody4.empty().append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
            return
         }

         pLoadData4(stringToSearch4, pAppend_Data4);

      }, 500);
   }

   function pAppend_Data4(data) {
      ptbody4.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            ptbody4.append($("<tr>")
               .append($("<td style='display:none;'>").append(row.id))
               .append($("<td>").append(row.prefecture))
               .append($("<td>").append(row.permitclass))
               .append($("<td>").append(row.permitno))
               .append($("<td>").append(row.dateexpire))
            );
         })
      }else {
         ptbody4.append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
      }
   }

   $('#pSearch4').on('input', function(e) {
      psearch4($(this).val());
   });

    $("#pTable4").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#recyclepermitid").val($(this).find('td:eq(0)').text());
      $("#permitno4").val($(this).find('td:eq(0)').text());

      // close the modal
      $( "#pclosemodal4" ).trigger( "click" );

   });
    $('#permitModal4').on('show.bs.modal', function () {
       // alert($("#recyclefirmid").val());
      //  $('#pSearch4').val($("#4forwarderid").val());
        psearch4($("#recyclefirmid").val());
    });

    $('#permitModal4').on('hidden.bs.modal', function () {
    //    $('#pSearch４').val($("#recfirmid").value);


        ptbody4.empty();
    });
</script>
