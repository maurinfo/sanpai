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
               <input type="text" name="recSearch1" id="recSearch1" placeholder="recycleFirm" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
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

   var rectbody1 = $(".modal-body table tbody");

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

   function recSearch1(stringToSearch) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch == null ||
            stringToSearch == undefined ||
            stringToSearch.length == 0)
         {
            rectbody1.empty().append('<tr class="table-info"><td colspan="4">No Data Found 2</td></tr>');
            return
         }

         recloadData1(stringToSearch, recAppendData1);

      }, 500);
   }

   function recAppendData1(data) {
      rectbody1.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            rectbody1.append($("<tr>")
               .append($("<td>").append(row.id))
               .append($("<td>").append(row.name))
               //.append($("<td>").append(row.zip))
               .append($("<td>").append(row.zip + " " + row.address1))
            );
         })
      }else {
         rectbody1.append('<tr class="table-info"><td colspan="4">No Data Found  2</td></tr>');
      }
   }

   $('#recSearch1').on('input', function(e) {
      recSearch1($(this).val());
   });

    $("#rectable1").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("#recyclefirmid").val($(this).find('td:eq(0)').text());
      $("#recyclefirm").val($(this).find('td:eq(1)').text());


      // close the modal
      $( "#recclosemodal1" ).trigger( "click" );

   });

    $('#recycleFirmModal').on('hidden.bs.modal', function () {
    $('#recSearch1').val('')

    rectbody1.empty();
    } )
</script>
