<div class="modal fade" id="manifest_search_modal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Manifest Search</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="search_text" id="manifest_search_text" placeholder="Manifest Search" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="result" class="table table-striped table-hover">
                  <thead>
                     <tr>
                     　 <th style="width:10%">ID</th>
                        <th style="width:20%">REFERENCE NO.</th>
                        <th style="width:25%">CONTRACTOR NAME</th>
                        <th style="width:25%">CONTRACTOR BRANCH NAME</th>
                        <th style="width:20%">WASTE NAME</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button id="manifest_close_model" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

   var tablebody = $("#manifest_search_modal table tbody");

   function load_data(query, callbackfunc) {
      $.ajax({
         url: "<?php echo base_url(); ?>index.php/manifest/fetch",
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

   function search(stringToSearch) {
      clearTimeout(delayTimeOut);

      delayTimeOut = setTimeout(() => {

         if (stringToSearch == null ||
            stringToSearch == undefined ||
            stringToSearch.length == 0)
         {
            tablebody.empty().append('<tr class="table-info"><td colspan="4">No Data Found</td></tr>');
            return
         }

         load_data(stringToSearch, append_data);

      }, 500);
   }

   function append_data(data) {
      tablebody.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            tablebody.append($("<tr>")
               .append($("<td>").append(row.id))
               .append($("<td>").append(row.referenceno))
               .append($("<td>").append(row.contractor))
               .append($("<td>").append(row.contractorbranch))
               .append($("<td>").append(row.wasteclass))
            );
         })
      }else {
         tablebody.append('<tr class="table-info"><td colspan="4">No Data Found</td></tr>');
      }
   }

   $('#manifest_search_text').on('input', function(e) {
      search($(this).val());
   });

   $("#result").on("click", "tr", function() {

      // Set the input field  value  from the modal table.
      $("[name=customer]").val($(this).find('td:eq(1)').text());

      // close the modal
      $("#manifest_close_model").trigger( "click" );

   });

</script>