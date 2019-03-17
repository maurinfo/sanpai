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
                    Invoice /
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
                                        <input id="customer_id" type="hidden" class="form-control" name="customerid" value="<?=($editFlag ? $sale['customerid'] : '')?>" />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#customer_search_modal"></button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h4 class="example-title"> Date From</h4>
                                    <span class="text-danger"><?=form_error('dateinvoice');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="datefrom" type="text" class="form-control" data-plugin="datepicker" name="datefrom" value="<?=($editFlag && isset($invoice['dateinvoice']) ? date("m/d/Y", strtotime($invoice['dateinvoice'])) : '')?>" readonly />
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-4">
                                    <h4 class="example-title"> Date To</h4>
                                    <span class="text-danger"><?=form_error('datefrom');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="dateto" type="text" class="form-control" data-plugin="datepicker" name="dateto" value="<?=($editFlag && isset($invoice['dateinvoice']) ? date("m/d/Y", strtotime($invoice['dateinvoice'])) : '')?>" readonly />
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-4">
                                    <h4 class="example-title"> Date Due</h4>
                                    <span class="text-danger"><?=form_error('datefrom');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="datedue" type="text" class="form-control" data-plugin="datepicker" name="datedue" value="<?=($editFlag && isset($invoice['dateinvoice']) ? date("m/d/Y", strtotime($invoice['dateinvoice'])) : '')?>" readonly />
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Notes</h4>
                                    <input type="text" class="form-control" name="notes" placeholder="Notes" value="<?=($editFlag ? $customer['notes'] : '')?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-success panel-line">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">SUB TOTAL</h4>
                                    <input type="text" class="form-control" name="subtotal" placeholder="Sub Total" value="" readonly /><br>
                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">Tax</h4>
                                    <input type="text" class="form-control" name="tax" placeholder="Tax" value="" readonly /><br>
                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="example-title">TOTAL</h4>
                                    <input type="text" class="form-control" name="total" placeholder="Total" value="" readonly /><br>
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
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Ref. No</th>
                                        <th>Waste Name</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th>Action</th>
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

var tablebody = $("#tblBody");

//    $("#dateto").datepicker({});
//    const taxrate = <?=(int) $taxrate?>;
 function append_data(data) {
      tablebody.empty();
      if(data.length > 0) {
         $(data).each(function(e, row) {
            tablebody.append($("<tr>")
               .append($("<td>").append(row.date))
               .append($("<td>").append(row.refno))
               .append($("<td>").append(row.itemname))
               .append($("<td>").append(row.specs))
               .append($("<td>").append(row.qty))

            );
         })
      }else {
         tablebody.append('<tr class="table-info"><td colspan="4">No Data Found</td></tr>');
      }
   }

    function loadLedger(cusID, dateFrom,dateTo){

   //     alert(dateFrom);
    //    alert(dateTo);
    //    alert(cusID);

       $.ajax({
         url: "<?php echo base_url(); ?>/invoice/fetchLedgers",
         method: "POST",
         dataType : 'json',
         data: {
            cusID   : cusID,
            dateFrom: dateFrom,
            dateTo  : dateTo
         },
         success: function(data) {
            append_data(data);
         }
      });



    }

  $("#dateto").on('change',function(e){

      var cusID    = $("#customer_id").val();
      var dateTo   = $("#dateto").val();
      var dateFrom = $("#datefrom").val();

      loadLedger(cusID, dateFrom, dateTo);

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
    });

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
    }
</script>
<!-- End Page -->
