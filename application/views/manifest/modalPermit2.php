<div class="modal fade" id="permitModal2" style="margin-top: 50px;">
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
               <input type="hidden" name="pSearch2" id="pSearch2" placeholder="Branch" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>-->
            <div id="table-lst-regions">
               <table id="pTable2" class="table table-striped table-hover">
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
            <button id="pclosemodal2" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var ptbody2 = $(".modal-body table tbody");

   function pLoadData2(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>permit/fetch/",
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

   function psearch2(stringToSearch2) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch2 == null ||
            stringToSearch2 == undefined ||
            stringToSearch2.length == 0)
         {
            ptbody2.empty().append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
            return
         }

         pLoadData2(stringToSearch2, pAppend_Data2);

      }, 500);
   }

   function pAppend_Data2(data) {
      ptbody2.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            ptbody2.append($("<tr>")
               .append($("<td style='display:none;'>").append(row.id))
               .append($("<td>").append(row.prefecture))
               .append($("<td>").append(row.permitclass))
               .append($("<td>").append(row.permitno))
               .append($("<td>").append(row.dateexpire))
            );
         })
      }else {
         ptbody2.append('<tr class="table-info"><td colspan="4">No Permit Found</td></tr>');
      }
   }

   $('#pSearch2').on('input', function(e) {
      psearch2($(this).val());
   });

    $("#pTable2").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#2permitid").val($(this).find('td:eq(0)').text());
      $("#permitno2").val($(this).find('td:eq(3)').text());

      // close the modal
      $( "#pclosemodal2" ).trigger( "click" );

   });
    $('#permitModal2').on('show.bs.modal', function () {
      //  alert($("#2forwarderid").val());
      //  $('#pSearch2').val($("#2forwarderid").val());
        psearch2($("#2forwarderid").val());
    });

    $('#permitModal2').on('hidden.bs.modal', function () {
        $('#pSearch2').val($("#2forwarderid").value);

        ptbody2.empty();
    });
</script>
