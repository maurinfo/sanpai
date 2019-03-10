<div class="modal fade" id="waste_search_modal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Waste Search</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="searchString" oninput="wasteSearch.handleOnInput(this.value)" id="waste_search_text" placeholder="Waste Search" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="result" class="table table-striped table-hover">
                  <thead>
                     <tr>
                     　 <th style="width:15%">ID </th>
                        <th style="width:30%">WASTE NAME</th>
                        <th style="width:30%">UNIT</th>
                        <th class="hidden">UNIT ITEM ID</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button id="waste_close_modal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

let wasteSearch = {...search};

wasteSearch.setUrl("<?php echo base_url(); ?>index.php/wastename/fetch");
wasteSearch.setTable($("#waste_search_modal table tbody"));
wasteSearch.setColSpan(4);
wasteSearch.setDataKey(["id", "name", "unit", "itemunitid"]);
wasteSearch.setDataKeyClass({ itemunitid: "hidden" });

$("#waste_search_modal table tbody").on("click", "tr", function() {
   // Set the input field  value  from the modal table.
   $("[name=item_name]").val($(this).find("[data-key='name']").text());
   $("[name=itemid]").val($(this).find("[data-key='id']").text());
   $("[name=itemunitid]").val($(this).find("[data-key='itemunitid']").text()).change();
   // close the modal
   $("#waste_close_modal").trigger( "click" );
});

</script>
