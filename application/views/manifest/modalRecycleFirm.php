<div class="modal fade" id="recycleFirmModal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Select Recycle Firm</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="rSearch1" id="rSearch1" placeholder="Recycle Firm" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="rectable1" class="table table-striped table-hover">
                  <thead>
                     <tr>
                     　 <th style="width:20%">ID </th>
                        <th style="width:40%">Recycle Firm Name</th>
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
            <button id="recclosemodal1" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var rtbody1 = $(".modal-body table tbody");

   function recloadData1(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>recycleFirm/fetch",
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

   function rSearch1(stringToSearch) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch == null ||
            stringToSearch == undefined ||
            stringToSearch.length == 0)
         {
            rtbody1.empty().append('<tr class="table-info"><td colspan="4">No Data Found 2</td></tr>');
            return
         }

         recloadData1(stringToSearch, recAppendData1);

      }, 500);
   }

   function recAppendData1(data) {
      rtbody1.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            rtbody1.append($("<tr>")
               .append($("<td>").append(row.id))
               .append($("<td>").append(row.name))
               //.append($("<td>").append(row.zip))
               .append($("<td>").append(row.zip + " " + row.address1))
            );
         })
      }else {
         rtbody1.append('<tr class="table-info"><td colspan="4">No Data Found  2</td></tr>');
      }
   }

   $('#rSearch1').on('input', function(e) {
      rSearch1($(this).val());
   });

    $("#rectable1").on("click", "tr", function() {


      // Set the input field  value  from the modal table.
      $("#recfirm").val($(this).find('td:eq(1)').text());
      $("#recyclefirmid").val($(this).find('td:eq(0)').text());

      // close the modal
      $( "#recclosemodal1" ).trigger( "click" );

   });

    $('#recycleFirmModal').on('hidden.bs.modal', function () {
        $('#rSearch1').val('');
        alert($("#recyclefirmid").val());
        rtbody1.empty();
    } )
</script>
