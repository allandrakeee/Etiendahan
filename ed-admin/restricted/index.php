<?php  
    require '/../../db.php';
    session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator Page | Etiendahan Dagupan</title> 

    <!-- favicon -->
    <link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <!-- <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" /> -->
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand waves-effect waves-dark" href="/etiendahan/ed-admin/restricted/"><img src="/etiendahan/temp-img/etiendahan-logo-half.png" style="position: relative;width: 50px;bottom: 8px;margin: 0;display: inline-block;"> <strong>Etiendahan</strong></a>
                
        <div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
            </div>

            <ul class="nav navbar-top-links navbar-right"> 
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown4"><i class="fa fa-envelope fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>               
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown2"><i class="fa fa-flag fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b>John Doe</b> <i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </nav>
        <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
<li><a href="/etiendahan/ed-admin/"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
</li>
</ul>
<ul id="dropdown2" class="dropdown-content w250">
  <li>
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Reports</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
</ul>  
<ul id="dropdown4" class="dropdown-content dropdown-tasks w250 taskList">
  <li>
                                <div>
                                    <strong>John Doe</strong>
                                    <span class="pull-right text-muted">
                                        <em>Today</em>
                                    </span>
                                </div>
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since an kwilnw...</p>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the...</p>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
</ul>  
       <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu waves-effect waves-dark" href="/etiendahan/ed-admin/restricted/"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/slides/" class="waves-effect waves-dark"><i class="fa fa-picture-o"></i> Slides</a>
                    </li>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/categories/" class="waves-effect waves-dark"><i class="fa fa-list"></i> Categories</a>
                    </li>
                    <li>
                        <a href="tab-panel.html" class="waves-effect waves-dark"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
                    </li>
                    
                    <li>
                        <a href="table.html" class="waves-effect waves-dark"><i class="fa fa-table"></i> Responsive Tables</a>
                    </li>
                    <li>
                        <a href="form.html" class="waves-effect waves-dark"><i class="fa fa-edit"></i> Forms </a>
                    </li>


                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="empty.html" class="waves-effect waves-dark"><i class="fa fa-fw fa-file"></i> Empty Page</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
      
        <div id="page-wrapper">
          <div class="header"> 
                        <h1 class="page-header">
                            Dashboard
                        </h1>
                                    
        </div>
            <div id="page-inner">

            <div class="dashboard-cards"> 
                <div class="row">
                    <!-- customers -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">supervisor_account</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                            <?php  
                                $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_customers WHERE banned = 0");
                                $product_count = $result_product_count->fetch_row();
                            ?>
                        <h3><?php if($product_count[0] == 0): ?>
                                0
                            <?php else: ?>
                            <?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?></h3> 
                        </div>
                        <div class="card-action">
                        <strong>CUSTOMERS</strong>
                        </div>
                        </div>
                        </div> 
                    </div>
                    
                    <!-- sellers -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">face</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                            <?php  
                                $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_sellers WHERE banned = 0");
                                $product_count = $result_product_count->fetch_row();
                            ?>
                        <h3><?php if($product_count[0] == 0): ?>
                                0
                            <?php else: ?>
                            <?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?></h3> 
                        </div>
                        <div class="card-action">
                        <strong>SELLERS</strong>
                        </div>
                        </div>
                        </div> 
                    </div>

                    <!-- products -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">shopping_cart</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                            <?php  
                                $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_products WHERE banned = 0");
                                $product_count = $result_product_count->fetch_row();
                            ?>
                        <h3><?php if($product_count[0] == 0): ?>
                                0
                            <?php else: ?>
                            <?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?></h3> 
                        </div>
                        <div class="card-action">
                        <strong>PRODUCTS</strong>
                        </div>
                        </div>
                        </div> 
                    </div>    
                    
                    <!-- sales -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">import_export</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                        <h3>84,198</h3> 
                        </div>
                        <div class="card-action">
                        <strong>SALES</strong>
                        </div>
                        </div>
                        </div>
                    </div>

                    <!-- visits -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">equalizer</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                        <h3>84,198</h3> 
                        </div>
                        <div class="card-action">
                        <strong>VISITS</strong>
                        </div>
                        </div>
                        </div>
                    </div>
                    
                    <!-- banned customers -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">pan_tool</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                        <h3>84,198</h3> 
                        </div>
                        <div class="card-action">
                        <strong>BANNED CUSTOMERS</strong>
                        </div>
                        </div>
                        </div>
                    </div>
                    
                    <!-- banned sellers -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">pan_tool</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                        <h3>84,198</h3> 
                        </div>
                        <div class="card-action">
                        <strong>BANNED SELLERS</strong>
                        </div>
                        </div>
                        </div>
                    </div>
                    
                    <!-- banned products -->
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="card horizontal cardIcon waves-effect waves-dark">
                        <div class="card-image dimgrey">
                        <i class="material-icons dp48">pan_tool</i>
                        </div>
                        <div class="card-stacked dimgrey">
                        <div class="card-content">
                            <?php  
                                $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_products WHERE banned = 1");
                                $product_count = $result_product_count->fetch_row();
                            ?>
                        <h3><?php if($product_count[0] == 0): ?>
                                0
                            <?php else: ?>
                            <?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?></h3> 
                        </div>
                        <div class="card-action">
                        <strong>BANNED PRODUCTS</strong>
                        </div>
                        </div>
                        </div>
                    </div>

                                        
                </div>
               </div>
                
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    
    <script src="assets/materialize/js/materialize.min.js"></script>
    
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <!-- <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script> -->
    
    
    <script src="assets/js/easypiechart.js"></script>
    <script src="assets/js/easypiechart-data.js"></script>
    
     <script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
    
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script> 
 

</body>

</html>