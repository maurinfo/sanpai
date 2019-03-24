<?php
$editFlag = isset($receipt['id']);

echo $editFlag ?
form_open('receipt/save/' . $receipt['id']) :
form_open('receipt/save');
?>
<div class="page-content">
    <div class="panel">
        <header class="panel-heading">
            <h3 class="panel-title">
                <a style="text-decoration:none" href="<?=base_url();?>receipt">
                    Receipt /
                </a>
                <?=$title;?>
            </h3>
        </header>
        <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $receipt['id'] : '')?>" />
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success panel-line">
                        <div class="panel-heading">
                            <h3 class="panel-title">Details</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="example-title">Reference No</h4>
                                    <span class="text-danger"><?=form_error('referenceno');?></span>
                                    <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $receipt['referenceno'] : '')?>" readonly />

                                    <br>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="example-title">Customer</h4>
                                    <span class="text-danger"><?=form_error('customer');?></span>
                                    <div class="input-group">
                                        <input id="customer_name" type="text" class="form-control" name="customername" placeholder="customer" value="<?=($editFlag ? $receipt['name'] : '')?>" readonly />
                                        <input id="customer_id" type="hidden" class="form-control" name="customerid" value="<?=($editFlag ? $receipt['customerid'] : '')?>" />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#customer_search_modal"></button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <h4 class="example-title"> Date From</h4>
                                    <span class="text-danger"><?=form_error('datestart');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="datestart" type="text" class="form-control" data-plugin="datepicker" name="datestart" value="<?=($editFlag && isset($receipt['datestart']) ? date("Y/m/d", strtotime($receipt['datestart'])) : '')?>" />
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <h4 class="example-title"> Date To</h4>
                                    <span class="text-danger"><?=form_error('dateend');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="dateend" type="text" class="form-control" data-plugin="datepicker" name="dateend" value="<?=($editFlag && isset($receipt['dateend']) ? date("Y/m/d", strtotime($receipt['dateend'])) : '')?>" />
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-3">
                                    <h4 class="example-title"> Date Due</h4>
                                    <span class="text-danger"><?=form_error('datedue');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="datedue" type="text" class="form-control" data-plugin="datepicker" name="datedue" value="<?=($editFlag && isset($receipt['datedue']) ? date("Y/m/d", strtotime($receipt['datedue'])) : '')?>" />
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                    <br>
                                    <div class="checkbox-custom checkbox-success">
                                        <input type="checkbox" name="showduedate" value="1" <?=($editFlag && $receipt['showduedate']== 0 ? '' : 'checked')?> />
                                        <label>Show Due Date</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Notes</h4>
                                    <input type="text" class="form-control" name="note" placeholder="Notes" value="<?=($editFlag ? $receipt['note'] : '')?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-success panel-line">
                        <div class="panel-heading">
                            <h3 class="panel-title">Transactions</h3>
                        </div>
                        <div class="panel-body">
                            <!--    <button id="receipts_additem_btn" type="button" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true" data-toggle="modal" data-target="#receipts_add_item_modal">Add Item</button>
                        <br>-->
                            <table id="itemlist" class="table table-striped">
                                <thead>
                                    <tr>

                                        <th>Date</th>
                                        <th>Ref. No</th>
                                        <th>Description</th>
                                        <th class='text-right'>Qty</th>
                                        <th>Unit</th>
                                        <th class='text-right'>Price</th>
                                        <th class='text-right'>Amount</th>

                                    </tr>
                                </thead>
                                <tbody id="tblBody">
                                    <!-- ITEMS HERE -->
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped">

                <tr>

                    <td>
                        <h4 class="example-title">Previous Balance</h4>
                        <input type="text" class="form-control" id="prevbal" name="prevbal" placeholder="Prev Balance" value=0 readonly /><br>
                        <!--    <input type="text" class="form-control" id="prevbal" name="prevbal" placeholder="Prev Balance" value="<?=($editFlag ? floor($receipt['prevbal']) : '')?>" readonly /><br> -->

                    </td>
                    <td>
                        <h4 class="example-title">Payment Received</h4>
                        <input type="text" class="form-control" id="totalpayment" name="totalpayment" placeholder="Total Payment" value=0 readonly /><br>
                        <!--<input type="text" class="form-control" id="totalpayment" name="totalpayment" placeholder="Total Payment" value="<?=($editFlag ? floor($receipt['totalpayment']) : '')?>" readonly /><br>-->

                    </td>
                    <td>
                        <h4 class="example-title">Balance</h4>
                        <input type="text" class="form-control" id="balance" name="balance" placeholder="Balance" value=0 readonly /><br>
                        <!--        <input type="text" class="form-control" id="balance" name="balance" placeholder="Balance" value="<?=($editFlag ? floor($receipt['balance']) : '')?>" readonly /><br> -->

                    </td>
                    <td>
                        <h4 class="example-title">SUB TOTAL</h4>
                        <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="Sub Total" value=0 readonly /><br>
                        <!--<input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="Sub Total" value="<?=($editFlag ? floor($receipt['subtotal']) : '')?>" readonly /><br>  -->


                    </td>
                    <td>
                        <h4 class="example-title">Tax</h4>
                        <input type="text" class="form-control" id="tax" name="tax" placeholder="Tax" value=0 readonly /><br>
                        <!--     <input type="text" class="form-control" id="tax" name="tax" placeholder="Tax" value="<?=($editFlag ? floor($receipt['tax']) : '')?>" readonly /><br> -->
                    </td>

                    <td>
                        <h4 class="example-title">TOTAL</h4>
                        <input type="text" class="form-control" id="total" name="total" placeholder="Total" value=0 readonly /><br>
                        <!-- <input type="text" class="form-control" id="total" name="total" placeholder="Total" value="<?=($editFlag ? floor($receipt['total'] ): '')?>" readonly /><br>  -->
                    </td>

                    <td>
                        <h4 class="example-title">AMOUNT DUE</h4>
                        <input type="text" class="form-control" id="totaldue" name="total" placeholder="Amount Due" value=0 readonly /><br>
                        <!--    <input type="text" class="form-control" id="totaldue" name="total" placeholder="Amount Due" value="<?=($editFlag ? floor($receipt['totaldue'] ): '')?>" readonly /><br>-->
                    </td>

                </tr>

            </table>
            <br>
            <button class="btn btn-success" type="submit">
                <i class="aria-hidden=" true></i> Save
            </button>
        </div>
        <br>
    </div>
</div>
</form>
<script>
    $(window).bind("load", function() {
        getPrevTotal();

        loadLedger();

    });



    var subtotal = 0;
    var tablebody = $("#tblBody");
    var taxrate = 0;


    function flashEmpty() {
        tablebody.append('<tr class="table-info"><td colspan="4">No Data Found</td></tr>');
    }

    function setTaxRate(rate) {
        //  taxrate = rate;
        //    $("#tax").val(rate);
    }

    function getTaxRate(dtreceipt) {

        $.ajax({
            url: "<?php echo base_url(); ?>taxrate/get_taxrate_of_date",
            method: "POST",
            dataType: 'text',
            data: {
                date: dtreceipt
            },
            success: function(data) {
                //         $("#tax").val(Number(data)/100　*　subtotal);

            }
        });

    }


    function setDates(firmid, dd, termid) {

     //   var dateFrom = new Date();
     //   var dateTo = new Date();

        $.ajax({
            url: "<?php echo base_url(); ?>receipt/getNextreceiptDate",
            method: "POST",
            dataType: 'text',
            data: {
                firmid: firmid
            },
            success: function(data) {
                var nextInvDate = new Date(data);
                alert(nextInvDate);
                //   dateTo = nextInvDate;


                if (dd == 31) {

                    var nowdate = new Date(nextInvDate);
                    var monthStartDay = new Date(nowdate.getFullYear(), nowdate.getMonth(), 1);
                    var monthEndDay = new Date(nowdate.getFullYear(), nowdate.getMonth() + 1, 0);

                    var dateTo = new Date(monthEndDay);
                    var dateFrom = new Date(monthStartDay);

                } else {
                    var dateTo = new Date(nextInvDate);
                    var nowdate = new Date(nextInvDate);
                    var dateFrom = new Date(nowdate.getFullYear(), nowdate.getMonth() - 1, nowdate.getDate() + 1);

                };

                var dateDue = new Date(dateTo.getFullYear(), dateTo.getMonth() + Number(termid), dateTo.getDate());

                $("#datestart").val($.datepicker.formatDate('yy/m/d', dateFrom));
                $("#dateend").val($.datepicker.formatDate('yy/m/d', dateTo));
                $("#datedue").val($.datepicker.formatDate('yy/m/d', dateDue));

                getPrevTotal();
                loadLedger();


            }

        });

    }

    function getPrevTotal() {

        var firmid = $("#customer_id").val();
        var datefrom = $('#datestart').val();
        var dateend = $('#dateend').val();

        if (firmid !== null) {

            $.ajax({
                url: "<?php echo base_url(); ?>receipt/getCustomerPrevAmountDue",
                method: "POST",
                dataType: 'text',
                data: {
                    firmid: firmid,
                    datefrom: datefrom,
                    dateend: dateend

                },
                success: function(data) {
                    //alert(data);
                    $("#prevbal").val(Math.floor(Number(data)));
                    // return Math.floor(Number(data));
                    //     alert($("#prevbal").val());

                }
            });
        }

    }

    function append_data(data) {
        var prevdue = 0;
        var totalreceipt = 0;
        var balance = 0;
        var subtotal = 0;
        var taxamount = 0;
        var amount = 0;
        var total = 0;

        tablebody.empty();
        if (data !== null) {
            $(data).each(function(e, row) {

                //$price
                tablebody
                    .append($("<tr>")
                        .append($('<td style="width:10%" >').append(row.date))
                        .append($('<td style="width:10%" >').append(row.refno))
                        .append($("<td>").append(row.item_name))
                        .append($('<td style="width:7%" align="right">').append(row.qty))
                        .append($('<td style="width:7%" > ').append(row.item_unit))
                        .append($('<td style="width:7%" align="right">').append(row.price))
                        .append($('<td style="width:7%"  align="right">').append(row.amount))

                    );
                switch (row.type) {
                    case 'tax':
                        taxamount = taxamount + Number(row.amount);
                        //   alert(taxamount);
                        break;
                    case 'receipt':
                        totalreceipt = totalreceipt + Number(row.amount);
                        break;
                    default:
                        subtotal = subtotal + Number(row.amount);

                };

            })
        } else {
            tablebody.append('<tr class="table-info"><td colspan="4">No Data Found</td></tr>');
        };
        // prevdue = getPrevTotal();
        prevdue = Number($("#prevbal").val());

        //      alert (prevdue);

        $("#totalpayment").val(totalreceipt);
        balance = prevdue - totalreceipt;
        $("#balance").val(balance);
        $("#subtotal").val(subtotal);
        //  alert(taxamount);
        $("#tax").val(taxamount);
        total = subtotal + taxamount;
        $("#total").val(total);
        $("#totaldue").val(total + balance);


    }

    function loadLedger() {

        var cusID = $("#customer_id").val();
        var dateend = $("#dateend").val();
        var datestart = $("#datestart").val();

        var firmid = $("#customer_id").val();
        var date = $('#dateend').val();

        $.ajax({
            url: "<?php echo base_url(); ?>receipt/fetchLedgers",
            method: "POST",
            dataType: 'json',
            data: {
                cusID: cusID,
                datestart: datestart,
                dateend: dateend
            },
            success: function(data) {

                append_data(data);
                //      getTaxRate(dateend);


            }
        });

    }

    $("#dateend").on('change', function(e) {
        getPrevTotal();
        loadLedger();
        //  getPrevTotal();

    });

    $("#datestart").on('change', function(e) {
        getPrevTotal();
        loadLedger();
        //   getPrevTotal();
    });

    $("#receipt_form").on("submit", function(e) {
        e.preventDefault();
        const url = $(this).attr("action");
        let inputs = {};

        $(this)
            .serializeArray()
            .map(v => (inputs[v.name] = v.value));

        inputs.receiptitems = receiptitems;

        if (utility.validateInputs("receipt_form", inputs, getValidationRules())) {
            utility.post(url, JSON.stringify(inputs), redirectToreceiptPage);
        }
    })

    function redirectToreceiptPage(data, status) {
        window.location = `<?=base_url();?>receipt`;
    }

    function getValidationRules() {
        return {
            customername: {
                presence: {
                    allowEmpty: false,
                    message: "^Customer Name is required!"
                }
            },
            datereceipt: {
                presence: {
                    allowEmpty: false,
                    message: "^Date is required!"
                }
            },
            receiptitems: {
                presence: {
                    allowEmpty: false,
                    message: "^There should be atleast one(1) item!"
                }
            }
        };
    };
</script>
<!-- End Page -->
