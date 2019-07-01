<?php
$editFlag = isset($payment['id']);
//print_r($payment);
echo $editFlag ?

form_open('payment/save/' . $payment['id']) :
form_open('payment/save');
?>
<div class="page-content">
    <div class="panel">
        <header class="panel-heading">
            <h3 class="panel-title">
                <a style="text-decoration:none" href="<?=base_url();?>payment">
                    Payment /
                </a>
                <?=$title;?>
            </h3>
        </header>
        <input type="hidden" name="id" placeholder="Name" value="<?=($editFlag ? $payment['id'] : '')?>" />
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
                                    <input type="text" class="form-control" name="referenceno" placeholder="Reference No" value="<?=($editFlag ? $payment['referenceno'] : '')?>" readonly />

                                    <br>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="example-title">Supplier</h4>
                                    <span class="text-danger"><?=form_error('supplier');?></span>
                                    <div class="input-group">
                                        <input id="supplier_name" type="text" class="form-control" name="supplier" placeholder="Supplier" value="<?=($editFlag ? $payment['supplier'] : '')?>" readonly />
                                        <input id="supplier_id" type="hidden" class="form-control" name="supplierid" value="<?=($editFlag ? $payment['supplierid'] : '')?>" />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-icon btn-success icon md-menu icon md-menu" data-toggle="modal" data-target="#supplier_search_modal"></button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <h4 class="example-title"> Date Paid</h4>
                                    <span class="text-danger"><?=form_error('datestart');?></span>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon md-calendar" aria-hidden="true"></i>
                                        </span>
                                        <input id="datepayment" type="text" class="form-control" data-plugin="datepicker" name="datepayment" value="<?=($editFlag && isset($payment['datepayment']) ? date("Y/m/d", strtotime($payment['datepayment'])) : '')?>" />
                                    </div>
                                    <br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success panel-line">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ledger</h3>
                        </div>
                        <div class="panel-body">
                            <!--    <button id="payments_additem_btn" type="button" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true" data-toggle="modal" data-target="#payments_add_item_modal">Add Item</button>
                    <br>-->
                            <table id="itemlist" class="table table-striped">
                                <thead>
                                    <tr>

                                        <th>Date</th>
                                        <th>Ref. No</th>
                                        <th class='text-right'>Debit</th>
                                        <th class='text-right'>Credit</th>
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
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">

                        <tr>


                            <td>
                                <h4 class="example-title">現金</h4>
                                <input type="text" style="text-align:right" class="form-control" id="amount0" name="amount0" placeholder="現金" value="<?=($editFlag ? floor($payment['amount0']) : '')?>" /><br>

                            </td>
                            <td>
                                <h4 class="example-title">小切手</h4>
                                <input type="text" style="text-align:right" class="form-control" id="amount1" name="amount1" placeholder="小切手" value="<?=($editFlag ? floor($payment['amount1']) : '')?>" /><br>

                            </td>
                            <td>
                                <h4 class="example-title">手形</h4>
                                <input type="text" style="text-align:right" class="form-control" id="amount2" name="amount2" placeholder="手形" value="<?=($editFlag ? floor($payment['amount2']) : '')?>" /><br>

                            </td>
                            <td>
                                <h4 class="example-title">相殺</h4>
                                <input type="text" style="text-align:right" class="form-control" id="amount3" name="amount3" placeholder="相殺" value="<?=($editFlag ? floor($payment['amount3']) : '')?>" /><br>


                            </td>
                            <td>
                                <h4 class="example-title">口座</h4>
                                <input type="text" style="text-align:right" class="form-control" id="amount4" name="amount4" placeholder="Tax" value="<?=($editFlag ? floor($payment['amount4']) : '')?>" /><br>
                            </td>

                            <td>
                                <h4 class="example-title">手数料</h4>
                                <input type="text" style="text-align:right" class="form-control" id="amount5" name="amount5" placeholder="手数料" value="<?=($editFlag ? floor($payment['amount5'] ): '')?>" /><br>
                            </td>

                            <td>
                                <h4 class="example-title">Total</h4>
                                <input type="text" style="text-align:right" class="form-control" id="total" name="total" placeholder="Amount Due" value="<?=($editFlag ? floor($payment['total'] ): '')?>" readonly /><br>
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
            $(function() {


                function updateTotal() {

                    const total = getTotal();
                    $("#total").val(total);

                }

                function getTotal() {

                    var total = 0;

                    var amt0 = 0;
                    var amt1 = 0;
                    var amt2 = 0;
                    var amt3 = 0;
                    var amt4 = 0;
                    var amt5 = 0;


                    amt0 = Number($("#amount0").val());
                    amt1 = Number($("#amount1").val());
                    amt2 = Number($("#amount2").val());
                    amt3 = Number($("#amount3").val());
                    amt4 = Number($("#amount4").val());
                    amt5 = Number($("#amount5").val());

                    total = amt0 + amt1 + amt2 + amt3 + amt4 + amt5;
                    return total;

                }
                $("#amount0").on('change', function(e) {

                    updateTotal();

                });
                $("#amount1").on('change', function(e) {
                    updateTotal();

                });
                $("#amount2").on('change', function(e) {
                    updateTotal();

                });
                $("#amount3").on('change', function(e) {
                    updateTotal();

                });
                $("#amount4").on('change', function(e) {
                    updateTotal();

                });
                $("#amount5").on('change', function(e) {
                    updateTotal();

                });
            });
        </script>
        <!-- End Page -->
