<div class="modal fade" id="permitModal1" style="margin-top: 50px;">
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
               <input type="hidden" name="pSearch1" id="pSearch1" placeholder="Branch" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>-->
            <div id="table-lst-regions">
               <table id="pTable1" class="table table-striped table-hover">
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
            <button id="pclosemodal1" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var ptbody1 = $(".modal-body table tbody");

   function pLoadData1(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>permit/fetch",
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

   function psearch1(stringToSearch1) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch1 == null ||
            stringToSearch1 == undefined ||
            stringToSearch1.length == 0)
         {
            ptbody1.empty().append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
            return
         }

         pLoadData1(stringToSearch1, pAppend_Data1);

      }, 500);
   }

   function pAppend_Data1(data) {
      ptbody1.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            ptbody1.append($("<tr>")
               .append($("<td style='display:none;'>").append(row.id))
               .append($("<td>").append(row.prefecture))
               .append($("<td>").append(row.permitclass))
               .append($("<td>").append(row.permitno))
               .append($("<td>").append(row.dateexpire))
            );
         })
      }else {
         ptbody1.append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
      }
   }

   $('#pSearch1').on('input', function(e) {
      psearch1($(this).val());
   });

    $("#pTable1").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#1permitid").val($(this).find('td:eq(0)').text());
      $("#permitno1").val($(this).find('td:eq(1)').text()+' '+$(this).find('td:eq(2)').text()+'  '+$(this).find('td:eq(3)').text());

      // close the modal
      $( "#pclosemodal1" ).trigger( "click" );

   });
    $('#permitModal1').on('show.bs.modal', function () {
       //alert($("#1forwarderid").val());
      //  $('#pSearch1').val($("#1forwarderid").val());
        psearch1($("#1forwarderid").val());
    });

    $('#permitModal1').on('hidden.bs.modal', function () {
        $('#pSearch1').val($("#1forwarderid").value);

        ptbody1.empty();
    });
</script>
