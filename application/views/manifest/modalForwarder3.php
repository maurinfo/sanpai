<div class="modal fade" id="forwarderModal3" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Select Forwarder</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="fwSearch3" id="fwSearch3" placeholder="Forwarder" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="fwtable3" class="table table-striped table-hover">
                  <thead>
                     <tr>
                     　 <th style="width:30%">ID </th>
                        <th style="width:40%">Forwarder Name</th>
                  <!--      <th style="width:40%">Zip</th>-->
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
            <button id="fwclosemodal3" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var fwtbody3 = $(".modal-body table tbody");

   function fwloadData3(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>forwarder/fetch",
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

   function fwSearch3(stringToSearch) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch == null ||
            stringToSearch == undefined ||
            stringToSearch.length == 0)
         {
            fwtbody3.empty().append('<tr class="table-info"><td colspan="4">No Data Found 3</td></tr>');
            return
         }

         fwloadData3(stringToSearch, fwAppendData3);

      }, 500);
   }

   function fwAppendData3(data) {
      fwtbody3.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            fwtbody3.append($("<tr>")
               .append($("<td>").append(row.id))
               .append($("<td>").append(row.name))
               //.append($("<td>").append(row.zip))
               .append($("<td>").append(row.zip + " " + row.address1))
            );
         })
      }else {
         fwtbody3.append('<tr class="table-info"><td colspan="4">No Data Found  3</td></tr>');
      }
   }

   $('#fwSearch3').on('input', function(e) {
      fwSearch3($(this).val());
   });

    $("#fwtable3").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#3forwarder").val($(this).find('td:eq(1)').text());
      $("#3forwarderid").val($(this).find('td:eq(0)').text());

      // close the modal
      $( "#fwclosemodal3" ).trigger( "click" );

   });

    $('#forwarderModal3').on('hidden.bs.modal', function () {
    $('#fwSearch3').val('')

    fwtbody3.empty();
    } )
</script>
