<div class="modal fade" id="permitModal3" style="margin-top: 50px;">
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
               <input type="hidden" name="pSearch3" id="pSearch3" placeholder="Branch" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>-->
            <div id="table-lst-regions">
               <table id="pTable3" class="table table-striped table-hover">
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
            <button id="pclosemodal3" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var ptbody3 = $(".modal-body table tbody");

   function pLoadData3(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>permit/fetch/",
         method: "POST",
         dataType : 'json',
         data: {
            query: query,
            permittype:'1'
         },
         success: function(data) {
            callbackfunc(data);
         }
      });
   }

   var delayTimeOut;

   function psearch3(stringToSearch3) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch3 == null ||
            stringToSearch3 == undefined ||
            stringToSearch3.length == 0)
         {
            ptbody3.empty().append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
            return
         }

         pLoadData3(stringToSearch3, pAppend_Data3);

      }, 500);
   }

   function pAppend_Data3(data) {
      ptbody3.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            ptbody3.append($("<tr>")
               .append($("<td style='display:none;'>").append(row.id))
               .append($("<td>").append(row.prefecture))
               .append($("<td>").append(row.permitclass))
               .append($("<td>").append(row.permitno))
               .append($("<td>").append(row.dateexpire))
            );
         })
      }else {
         ptbody3.append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
      }
   }

   $('#pSearch3').on('input', function(e) {
      psearch3($(this).val());
   });

    $("#pTable3").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#3permitid").val($(this).find('td:eq(0)').text());
      $("#permitno3").val($(this).find('td:eq(3)').text());

      // close the modal
      $( "#pclosemodal3" ).trigger( "click" );

   });
    $('#permitModal3').on('show.bs.modal', function () {
     //alert($("#3forwarderid").val());
      //  $('#pSearch3').val($("#3forwarderid").val());
        psearch3($("#3forwarderid").val());
    });

    $('#permitModal3').on('hidden.bs.modal', function () {
        $('#pSearch3').val($("#3forwarderid").value);

        ptbody3.empty();
    });
</script>
