<div class="modal fade" id="item_search_modal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Item Search</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="searchString" oninput="itemSearch.handleOnInput(this.value)" id="item_search_text" placeholder="Waste Search" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="result" class="table table-striped table-hover">
                  <thead>
                     <tr>
                     　 <th style="width:15%">ID </th>
                        <th style="width:30%">ITEM NAME</th>
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
            <button id="item_close_modal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

let itemSearch = {...search};

itemSearch.setUrl("<?php echo base_url(); ?>index.php/item/fetch");
itemSearch.setTable($("#item_search_modal table tbody"));
itemSearch.setColSpan(4);
itemSearch.setDataKey(["id", "name", "unit", "itemunitid"]);
itemSearch.setDataKeyClass({ itemunitid: "hidden" });

$("#item_search_modal table tbody").on("click", "tr", function() {
   const datakey = $(this).attr("data-key");
   const selectedItem = itemSearch.data[datakey];
   ExpenseItemFunc.updateItemSelectedByItem(selectedItem);
   // close the modal
   $("#item_close_modal").trigger( "click" );
});

</script>
