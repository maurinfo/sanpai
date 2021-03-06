<?php
$editFlag = isset($invoice['id']);

echo $editFlag ?
form_open('invoice/save/' . $invoice['id']) :
form_open('invoice/save');
?>
<div class="page-content">
    <div class="panel">
        <header class="panel-heading">
            <h3 class="panel-title">
                <a style="text-decoration:none" href="<?=base_url();?>invoice">
                    invoice /
                </a>
                <?=$title;?>
            </h3>
        </header>
        <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $invoice['id'] : '')?>" />
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-success panel-line">
                        <div class="panel-heading">
                            <h3 class="panel-title">Details</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="example-title">Reference No</h4>
                                    <span class="text-danger"><?=form_error('referenceno');?></span>
                                    <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $invoice['referenceno'] : '')?>" readonly />

                                    <br>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Customer</h4>
                                    <span class="text-danger"><?=form_error('customer');?></span>
                                    <div class="input-group">
                                        <input id="customer_name" type="text" class="form-control" name="customername" placeholder="customer" value="<?=($editFlag ? $invoice['name'] : '')?>" readonly />
                                        <input id="customer_id" type="hidden" class="form-control" name="customerid" value="<?=($editFlag ? $invoice['customerid'] : '')?>" />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#customer_search_modal"></button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="example-title"> Date From</h4>
                                    <span class="text-danger"><?=form_error('datestart');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="datestart" type="text" class="form-control" data-plugin="datepicker" name="datestart" value="<?=($editFlag && isset($invoice['datestart']) ? date("Y/m/d", strtotime($invoice['datestart'])) : '')?>"  />
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="example-title"> Date To</h4>
                                    <span class="text-danger"><?=form_error('dateend');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="dateend" type="text" class="form-control" data-plugin="datepicker" name="dateend" value="<?=($editFlag && isset($invoice['dateend']) ? date("Y/m/d", strtotime($invoice['dateend'])) : '')?>"  />
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <h4 class="example-title"> Date Due</h4>
                                    <span class="text-danger"><?=form_error('datedue');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="datedue" type="text" class="form-control" data-plugin="datepicker" name="datedue" value="<?=($editFlag && isset($invoice['datedue']) ? date("Y/m/d", strtotime($invoice['datedue'])) : '')?>"  />
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <br>
                                    <div class="checkbox-custom checkbox-success">
                                       <input type="checkbox" name="showduedate" value = "1" <?=($editFlag && $invoice['showduedate']== 0 ? '' : 'checked')?> />
                                       <label>Show Due Date</label><br>
                                    </div>
                                 </div>
                              </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Notes</h4>
                                    <input type="text" class="form-control" name="note" placeholder="Notes" value="<?=($editFlag ? $invoice['note'] : '')?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-success panel-line">
                        <div class="panel-heading">
                            <h3 class="panel-title">Footer </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Previous Balance</h4>
                                    <input type="text" class="form-control" id="prevbal" name="prevbal" placeholder="Prev Balance" value="<?=($editFlag ? floor($invoice['prevbal']) : '')?>" readonly /><br>

                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Payment Received</h4>
                                    <input type="text" class="form-control" id="totalpayment" name="totalpayment" placeholder="Total Payment" value="<?=($editFlag ? floor($invoice['totalpayment']) : '')?>" readonly /><br>

                                </div>
                                <br>
                            </div>
                             <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Balance</h4>
                                    <input type="text" class="form-control" id="balance" name="balance" placeholder="Balance" value="<?=($editFlag ? floor($invoice['balance']) : '')?>" readonly /><br>

                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">SUB TOTAL</h4>
                                    <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="Sub Total" value="<?=($editFlag ? floor($invoice['subtotal']) : '')?>" readonly /><br>

                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Tax</h4>
                                    <input type="text" class="form-control" id="tax" name="tax" placeholder="Tax" value="<?=($editFlag ? floor($invoice['tax']) : '')?>" readonly /><br>
                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">TOTAL</h4>
                                    <input type="text" class="form-control" id="total" name="total" placeholder="Total" value="<?=($editFlag ? floor($invoice['total'] ): '')?>" readonly /><br>
                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">AMOUNT DUE</h4>
                                    <input type="text" class="form-control" id="totaldue" name="total" placeholder="Amount Due" value="<?=($editFlag ? floor($invoice['totaldue'] ): '')?>" readonly /><br>
                                </div>
                                <br>
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
                            <!--    <button id="invoices_additem_btn" type="button" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true" data-toggle="modal" data-target="#invoices_add_item_modal">Add Item</button>
                        <br>-->
                            <table id="itemlist" class="table table-striped">
                                <thead>
                                    <tr>

                                        <th>Date</th>
                                        <th>Ref. No</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Price</th>
                                        <th>Amount</th>

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
            <button class="btn btn-success" type="submit">
                <i class="aria-hidden=" true></i> Save
            </button>
        </div>
        <br>
    </div>
</div>
</form>
<script>

var subtotal = 0;
var tablebody = $("#tblBody");
var taxrate = 0;


function flashEmpty(){
 tablebody.append('<tr class="table-info"><td colspan="4">No Data Found</td></tr>');
}

function setTaxRate(rate){
  //  taxrate = rate;
//    $("#tax").val(rate);
}

function getTaxRate(dtinvoice){

    $.ajax({
         url: "<?php echo base_url(); ?>taxrate/get_taxrate_of_date",
         method: "POST",
         dataType : 'text',
         data: {
            date  : dtinvoice
         },
         success: function(data) {
       // $("#tax").val(Number(data)/100　*　subtotal);

         }
    });

}

function append_data(data) {
    var totalreceipt     = 0;
    var subtotal    = 0;
    var taxamount   = 0;
    var amount      = 0;
    var total       = 0;

    tablebody.empty();
    if(data!==null) {
        $(data).each(function(e, row) {

        //$price
        tablebody
            .append($("<tr>")
            .append($("<td>").append(row.date))
            .append($("<td>").append(row.refno))
            .append($("<td>").append(row.item_name))
            .append($('<td align="right">').append(row.qty))
            .append($("<td> ").append(row.item_unit))
            .append($('<td align="right">').append(row.price))
            .append($('<td align="right">' ).append(row.amount))

        );
            switch(row.type){
                case 'tax':
                    taxamount = taxamount + Number(row.amount);
                    break;

                case 'receipt':
                    totalreceipt = totalreceipt + Number(row.amount);
                    break;
                default:
                    subtotal = subtotal + Number(row.amount);

            }


/*            if (row.type =='tax'){

            }else{
                if (row.amount!==''){
                subtotal = subtotal + Number(row.amount);

                }
            }
*/

     })
    }else {
        tablebody.append('<tr class="table-info"><td colspan="4">No Data Found</td></tr>');
    };
    $("#subtotal").val(subtotal);
    $("#tax").val(taxamount);
    $("#totalpayment").val(totalreceipt);


   // $("#total").val(subtotal + taxamount);
    total = subtotal + taxamount;
    $("#total").val(total);
};

function loadLedger(){

    var cusID    = $("#customer_id").val();
    var dateend   = $("#dateend").val();
    var datestart = $("#datestart").val();



    $.ajax({
         url: "<?php echo base_url(); ?>invoice/fetchLedgers",
         method: "POST",
         dataType : 'json',
         data: {
            cusID   : cusID,
            datestart: datestart,
            dateend  : dateend
         },
         success: function(data) {
            append_data(data);
            getTaxRate(dateend);

         }
    });

};

$("#dateend").on('change',function(e){

  loadLedger();

});

$("#datestart").on('change',function(e){
  loadLedger();
});

$("#invoice_form").on("submit", function(e) {
    e.preventDefault();
    const url = $(this).attr("action");
    let inputs = {};

    $(this)
        .serializeArray()
        .map(v => (inputs[v.name] = v.value));

    inputs.invoiceitems = invoiceitems;

    if (utility.validateInputs("invoice_form", inputs, getValidationRules())) {
        utility.post(url, JSON.stringify(inputs), redirectToinvoicePage);
    }
})

function redirectToinvoicePage(data, status) {
    window.location = `<?=base_url();?>invoice`;
}

function getValidationRules() {
    return {
        customername: {
            presence: {
                allowEmpty: false,
                message: "^Customer Name is required!"
            }
        },
        dateinvoice: {
            presence: {
                allowEmpty: false,
                message: "^Date is required!"
            }
        },
        invoiceitems: {
            presence: {
                allowEmpty: false,
                message: "^There should be atleast one(1) item!"
            }
        }
    };
};


</script>
<!-- End Page -->
