<div class="modal hide fade" tabindex="-1" id="manifest_search_modal" style="margin-top: 50px;">
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
               <div class="row">
                  <div class="col-lg-6">
                  <h4 class="example-title">Name / Reference No</h4>
                     <input type="text" name="searchString"  oninput="manifestSearch.handleOnChange()" placeholder="Manifest Search" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
                  </div>
                  <div class="col-lg-3">
                     <h4 class="example-title">Date From</h4>
                     <div class="input-group">
                        <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="dateFrom" onchange="manifestSearch.handleOnChange()" class="form-control" data-plugin="datepicker"  value="" />
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <h4 class="example-title">Date To</h4>
                     <div class="input-group">
                        <span class="input-group-addon">
                        <i class="icon md-calendar" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="dateTo" onchange="manifestSearch.handleOnChange()" class="form-control" data-plugin="datepicker"  value="" />
                     </div>
                  </div>
               </div>

            </form>
            <div id="table-lst-regions">
               <table id="result" class="table table-striped table-hover">
                  <thead>
                     <tr>
                        <th style="width:10%">REFERENCE NO.</th>
                        <th style="width:15%">MANIFEST DATE</th>
                        <th style="width:25%">CONTRACTOR NAME</th>
                        <th style="width:25%">CONTRACTOR BRANCH NAME</th>
                        <th style="width:25%">WASTE NAME</th>
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

let manifestSearch = { ...search };

manifestSearch.setUrl("<?php echo base_url(); ?>index.php/manifest/fetch");
manifestSearch.setTable($("#manifest_search_modal table tbody"));
manifestSearch.setColSpan(5);
manifestSearch.setDataKey([
   "referenceno", "datemanifest", "contractor_name", "contractorbranch_name", "wasteclass_name"
]);

manifestSearch.handleOnChange = function ()  {
   let searchString = $("#manifest_search_modal [name=searchString]").val();
   let dateFrom = $("#manifest_search_modal [name=dateFrom]").val();
   let dateTo = $("#manifest_search_modal [name=dateTo]").val();
   let params = {
      search_string : searchString,
      date_from: dateFrom,
      date_to: dateTo
   };

   if (utility.checkSearchString(searchString)) {

      utility.delayCall(
         () =>
            utility.post(
               this.url,
               JSON.stringify(params),
               this.append_data.bind(this)
            ),
         500
      );
   } else {
      this.showNoRecordFound(this.tbody, this.colspan);
   }
};

$("#manifest_search_modal table tbody").on("click", "tr", function() {

   // Set the input field  value  from the modal table.
   $("#sales_add_item_modal [name=dateSale]").val($(this).find("[data-key='datemanifest']").text());
   $("#sales_add_item_modal [name=referenceNo]").val(parseInt($(this).find("[data-key='referenceno']").text()));
   $("#sales_add_item_modal [name=contractorBranch]").val($(this).find("[data-key='contractor_name']").text());
   $("#sales_add_item_modal [name=wasteName]").val($(this).find("[data-key='wasteclass_name']").text());
   // close the modal
   $("#manifest_close_model").trigger( "click" );

});

</script>