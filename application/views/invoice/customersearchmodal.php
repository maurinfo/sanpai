<div class="modal fade" id="customer_search_modal" style="margin-top: 50px;">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">Customer Search</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <form method="POST" action="" name="ajx">
               <input type="text" name="searchString" oninput="customerSearch.handleOnInput(this.value)" id="customer_search_text" placeholder="Customer Search" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
            </form>
            <div id="table-lst-regions">
               <table id="result" class="table table-striped table-hover">
                  <thead>
                     <tr>
                        <th style="width:0%;" class="hidden">Customer ID</th>
                     　 <th style="width:15%">CUSTOMER CODE</th>
                        <th style="width:30%">NAME</th>
                        <th style="width:15%">ZIP</th>
                        <th style="width:30%">ADDRESS</th>
                        <th style="width:0%;" class="hidden">CUTOFF</th>
                        <th style="width:0%;" class="hidden">COLLECTION DATE</th>
                        <th style="width:0%;" class="hidden">TERM</th>

                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <!-- Modal footer -->
         <div class="modal-footer">
            <button id="customer_close_modal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>

let customerSearch = {...search};

customerSearch.setUrl("<?php echo base_url(); ?>index.php/customer/fetch");
customerSearch.setTable($("#customer_search_modal table tbody"));
customerSearch.setColSpan(4);
customerSearch.setDataKeyClass({id:"hidden"})
customerSearch.setDataKey(["id", "code", "name", "zip", "address1","cutoffdate","collectdate","termid"])

$("#customer_search_modal table tbody").on("click", "tr", function() {
   // Set the input field  value  from the modal table.
   $("[name=customername]").val($(this).find("[data-key='name']").text());
   $("[name=customerid]").val($(this).find("[data-key='id']").text());
   $("[name=customercode]").val($(this).find("[data-key='code']").text());

  //  alert($(this).find("[data-key='cutoffdate']").text());

   var dtcut = new Date();
   var dd = $(this).find("[data-key='cutoffdate']").text();
   var termid = $(this).find("[data-key='termid']").text();
 //   alert(termid)
   dtcut.setDate(dd);
   var dtStart = new Date();
    dtStart.setDate(dtcut.getDate()+1);
    dtStart.setMonth(dtStart.getMonth() -1);
    var dtDue = new Date();

    dtDue.setDate(dtcut.getDate());
    dtDue.setMonth(dtcut.getMonth() + Number(termid));

   $("#dateto").val($.datepicker.formatDate('mm/dd/yy', dtcut));
   $("#datefrom").val($.datepicker.formatDate('mm/dd/yy', dtStart));
   $("#datedue").val($.datepicker.formatDate('mm/dd/yy', dtDue));



    // close the modal
   $("#customer_close_modal").trigger( "click" );
});


</script>
