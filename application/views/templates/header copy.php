<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    <title>サンパイ</title>
    <link rel="apple-touch-icon" href="<?=base_url();?>assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?=base_url();?>assets/images/favicon.ico">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?=base_url();?>global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/site.min.css">
    <!-- Plugins -->
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?=base_url();?>global/fonts/ionicons/ionicons.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/waves/waves.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/chartist/chartist.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/examples/css/dashboard/v1.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/examples/css/tables/datatable.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/examples/css/forms/advanced.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/bootstrap-touchspin/bootstrap-touchspin.css" />
    <link rel="stylesheet" href="<?=base_url();?>global/vendor/floatthead/jquery.floatThead.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/examples/css/tables/floatthead.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="<?=base_url();?>global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="<?=base_url();?>global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <!--Ruel Added-->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/customcss.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/app/validate.js"></script>
    <script src="<?=base_url()?>assets/js/common/functions.js"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
    <!--Ruel Added-->
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>global/vendor/html5shiv/html5shiv.min.js"></script>
      <![endif]-->
    <!--[if lt IE 10]>
      <script src="<?=base_url();?>global/vendor/media-match/media.match.min.js"></script>
      <script src="<?=base_url();?>global/vendor/respond/respond.min.js"></script>
      <![endif]-->
    <!-- Scripts -->
    <script src="<?=base_url();?>global/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="animsition dashboard">
    <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse" role="navigation">

        <div class="navbar-container container-fluid">
            <!-- Navbar Collapse -->
            <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                <!-- Navbar Toolbar -->
                <ul class="nav navbar-toolbar">
                    <li class="nav-item hidden-float" id="toggleMenubar">
                        <a class="nav-link" data-toggle="menubar" href="#" role="button">
                            <i class="icon hamburger hamburger-arrow-left">
                                <span class="sr-only">Toggle menubar</span>
                                <span class="hamburger-bar"></span>
                            </i>
                        </a>
                    </li>
                    <li>
                        <a class="navbar-brand" href="<?=base_url();?>">SanPai App </a>
                    </li>
                </ul>
                <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Print Queue" aria-expanded="false" data-animation="scale-up" role="button">
                            <i class="icon md-print" aria-hidden="true"></i>
                            <span class="badge badge-pill badge-danger up" id="printcounter"></span>
                        </a>
                        <div class="dropdown-menu" role="menu">


                            <a class="dropdown-item" href="<?php echo base_url(); ?>printq" role="menuitem">
                                <span class="icon md-eye"></span> View List
                            </a>

                            <a class="dropdown-item" href="<?php echo base_url(); ?>salepdf/create_pdf" role="menuitem">
                                <span class="icon md-print"></span>Print All
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>printq/clearall" role="menuitem">
                                <span class="icon md-delete"></span>Clear All
                            </a>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Settings" aria-expanded="false" data-animation="scale-up" role="button">
                            <i class="icon md-settings" aria-hidden="true"></i>

                        </a>

                        <div class="dropdown-menu" role="menu">


                            <a class="dropdown-item" href="<?php echo base_url(); ?>accounting" role="menuitem">
                                <span class="icon md-balance"></span> Accounting
                            </a>

                            <a class="dropdown-item" href="<?php echo base_url(); ?>lists" role="menuitem">
                                <span class="icon md-sort-amount-asc"></span>Lists
                            </a>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Print Queue" aria-expanded="false" data-animation="scale-up" role="button">
                            <i class="icon md-power" aria-hidden="true"></i>

                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>    <div class="site-menubar site-menubar-light">
        
        <div class="site-menubar">
            <div class="site-menubar-body">
                <div>
                    <div>

                        <div style="margin-left: 20px;">
                            <h5=10px><br>Transactions</h5>
                        </div>
                        <ul class="site-menu" data-plugin="menu">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?=base_url();?>">
                                    <i class="site-menu-icon ion-logo-windows" aria-hidden="true"></i>
                                    <span class="site-menu-title">ホーム</span>
                                </a>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon md-collection-text" aria-hidden="true"></i>
                                    <span class="site-menu-title">Manifest</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>manifest">
                                            <span class="site-menu-title">Manifest</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>contractor">
                                            <span class="site-menu-title">Contractor</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>contractorbranch">
                                            <span class="site-menu-title">Contractor Branch</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>forwarder">
                                            <span class="site-menu-title">Forwarder</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>recyclefirm">
                                            <span class="site-menu-title">Recycle Firm </span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>lists">
                                            <span class="site-menu-title">Lists</span>
                                        </a>
                                    </li>
                                </ul>


                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon md-label" aria-hidden="true"></i>
                                    <span class="site-menu-title">Sales</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>customer">
                                            <span class="site-menu-title">Customer</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>sale">
                                            <span class="site-menu-title">Sales</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>invoice">
                                            <span class="site-menu-title">Invoices</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>receipt">
                                            <span class="site-menu-title">Receipt</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon ion-md-cash" aria-hidden="true"></i>
                                    <span class="site-menu-title">Expenses</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>supplier">
                                            <span class="site-menu-title">Suppliers</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>expense">
                                            <span class="site-menu-title">Expenses</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>bill">
                                            <span class="site-menu-title">Bill</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?=base_url();?>payment">
                                            <span class="site-menu-title">Payments</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon icon ion-ios-stats" aria-hidden="true"></i>
                                    <span class="site-menu-title">レポート</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="pages/faq.html">
                                            <span class="site-menu-title">得意先元帳</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="pages/faq.html">
                                            <span class="site-menu-title">仕入先元帳</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="pages/faq.html">
                                            <span class="site-menu-title">残高一覧表</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon icon ion-md-options" aria-hidden="true"></i>
                                    <span class="site-menu-title">設定</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?php echo base_url(); ?>accounting">
                                            <span class="site-menu-title">Accounting</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?php echo base_url(); ?>lists">
                                            <span class="site-menu-title">Lists</span>
                                        </a>
                                    </li>
                                </ul>

                                <div style="margin-left: 20px; margin-top: 20px;">
                                    <h5=10px>Payroll</h5>
                                </div>
                            <li class="site-menu-item ">
                                <a class="animsition-link" href="<?=base_url();?>employee">
                                    <i class="site-menu-icon icon md-face" aria-hidden="true"></i>
                                    <span class="site-menu-title">Employees</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="uikit/cards.html">
                                    <i class="site-menu-icon icon ion-md-time" aria-hidden="true"></i>
                                    <span class="site-menu-title">Time Sheets</span>
                                </a>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon icon ion-md-options" aria-hidden="true"></i>
                                    <span class="site-menu-title">Setup</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="pages/map-google.html">
                                            <span class="site-menu-title">Payroll Period</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="pages/map-vector.html">
                                            <span class="site-menu-title">Attendance Type</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="pages/map-vector.html">
                                            <span class="site-menu-title">Holidays</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>

    </nav>
