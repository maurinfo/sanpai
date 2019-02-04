<div class="modal fade" id="forwarderModal2" style="margin-top: 50px;">
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
               <input type="text" name="fwSearch2" id="fwSearch2" placeholder="Forwarder" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="fwtable2" class="table table-striped table-hover">
                  <thead>
                     <tr>
                     　 <th style="width:20%">ID </th>
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
            <button id="fwclosemodal2" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var fwtbody2 = $(".modal-body table tbody");

   function fwloadData2(query, callbackfunc) {
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

   function fwSearch2(stringToSearch) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch == null ||
            stringToSearch == undefined ||
            stringToSearch.length == 0)
         {
            fwtbody2.empty().append('<tr class="table-info"><td colspan="4">No Data Found 2</td></tr>');
            return
         }

         fwloadData2(stringToSearch, fwAppendData2);

      }, 500);
   }

   function fwAppendData2(data) {
      fwtbody2.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            fwtbody2.append($("<tr>")
               .append($("<td>").append(row.id))
               .append($("<td>").append(row.name))
               //.append($("<td>").append(row.zip))
               .append($("<td>").append(row.zip + " " + row.address1))
            );
         })
      }else {
         fwtbody2.append('<tr class="table-info"><td colspan="4">No Data Found  2</td></tr>');
      }
   }

   $('#fwSearch2').on('input', function(e) {
      fwSearch2($(this).val());
   });

    $("#fwtable2").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#2forwarder").val($(this).find('td:eq(1)').text());
      $("#2forwarderid").val($(this).find('td:eq(0)').text());

      // close the modal
      $( "#fwclosemodal2" ).trigger( "click" );

   });

    $('#forwarderModal2').on('hidden.bs.modal', function () {
    $('#fwSearch2').val('')

    fwtbody2.empty();
    } )
</script>
