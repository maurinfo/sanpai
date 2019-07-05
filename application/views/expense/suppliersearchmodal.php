<div class="modal fade" id="supplier_search_modal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Supplier Search</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="searchString" oninput="supplierSearch.handleOnInput(this.value)" id="supplier_search_text" placeholder="Supplier Search" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="result" class="table table-striped table-hover">
                  <thead>
                     <tr>
                        <th style="width:0%;" class="hidden">Supplier ID</th>
                     　 <th style="width:15%">SUPPLIER CODE</th>
                        <th style="width:30%">NAME</th>
                        <th style="width:15%">ZIP</th>
                        <th style="width:40%">ADDRESS</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button id="supplier_close_modal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

let supplierSearch = {...search};

supplierSearch.setUrl("<?php echo base_url(); ?>index.php/supplier/fetch");
supplierSearch.setTable($("#supplier_search_modal table tbody"));
supplierSearch.setColSpan(4);
supplierSearch.setDataKeyClass({id:"hidden"});
supplierSearch.setDataKey(["id", "code", "name", "zip", "address1"]);

$("#supplier_search_modal table tbody").on("click", "tr", function() {
   // Set the input field  value  from the modal table.
   $("[name=suppliername]").val($(this).find("[data-key='name']").text());
   $("[name=supplierid]").val($(this).find("[data-key='id']").text());
   $("[name=suppliercode]").val($(this).find("[data-key='code']").text());
   // close the modal
   $("#supplier_close_modal").trigger( "click" );
});

</script>
