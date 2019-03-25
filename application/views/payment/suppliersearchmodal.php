<div class="modal fade" id="supplier_search_modal" style="margin-top: 50px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">supplier Search</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="" name="ajx">
                    <input type="text" name="searchString" oninput="supplierSearch.handleOnInput(this.value)" id="supplier_search_text" placeholder="supplier Search" class="form-control" autocomplete="off" style="margin-bottom:  10px;" />
                </form>
                <div id="table-lst-regions">
                    <table id="result" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:0%;" class="hidden">supplier ID</th>
                                　 <th style="width:15%">supplier CODE</th>
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
                <button id="supplier_close_modal" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    let supplierSearch = {
        ...search
    };

    supplierSearch.setUrl("<?php echo base_url(); ?>index.php/supplier/fetch");
    supplierSearch.setTable($("#supplier_search_modal table tbody"));
    supplierSearch.setColSpan(4);
    supplierSearch.setDataKeyClass({
        id: "hidden"
    })
    supplierSearch.setDataKey(["id", "code", "name", "zip", "address1", "cutoffdate", "collectdate", "termid"])

    $("#supplier_search_modal table tbody").on("click", "tr", function() {
        // Set the input field  value  from the modal table.
        $("[name=supplier]").val($(this).find("[data-key='name']").text());
        $("[name=supplierid]").val($(this).find("[data-key='id']").text());
        $("[name=suppliercode]").val($(this).find("[data-key='code']").text());

        //  alert($(this).find("[data-key='cutoffdate']").text());

        // Set Dates
        //To get the last day of the current month in Javascript, you could use this :

        //var today = new Date();
        //var lastOfMonth = new Date(today.getFullYear(),today.getMonth()+1, 0);
        //For the first day of the current month, use this :

        //var today = new Date();
        //var firstOfMonth = new Date(today.getFullYear(),today.getMonth(), 1);
        //   var today = new Date();
        //   var lastOfMonth = new Date(today.getFullYear(),today.getMonth()+1, 0);
        //   alert(lastOfMonth);
        var firmid = $(this).find("[data-key='id']").text();
        var dd = $(this).find("[data-key='cutoffdate']").text();
        var termid = $(this).find("[data-key='termid']").text();
        // close the modal
        $("#supplier_close_modal").trigger("click");

        setDates(firmid,dd,termid);
      //  loadLedger();
    });

    $('#supplier_search_modal').on('shown.bs.modal', function() {
        $("#supplier_search_text").focus();
    });
</script>
