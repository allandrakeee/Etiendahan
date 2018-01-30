<?php  
    require '../../../db.php';
    session_start();

    $logged_in_admin  = ((isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] != '')?htmlentities($_SESSION['logged_in_admin']):'');
    if($logged_in_admin == false) {
        $_SESSION['cant-proceed-message'] = 'You must logged in before viewing admin page.';
        header('location: /etiendahan/ed-admin/');
    }
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
    <link rel="stylesheet" href="../assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <!-- <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" /> -->
    <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />
    <link href="../assets/css/custom-scss.scss" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../assets/js/Lightweight-Chart/cssCharts.css"> 
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
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b><?php echo $_SESSION['admin_fullname']; ?></b> <i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </nav>
        <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
<li><a href="/etiendahan/ed-admin/logout/"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                    <!-- dashboard -->
                    <li>
                        <a class="waves-effect waves-dark" href="/etiendahan/ed-admin/restricted/"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>

                    <!-- slides -->
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/slides/" class="waves-effect waves-dark"><i class="fa fa-picture-o"></i> Slides</a>
                    </li>

                    <!-- categories -->
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/categories/" class="waves-effect waves-dark"><i class="fa fa-list"></i> Categories</a>
                    </li>
                    
                    <!-- sales -->
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/sales/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">import_export</i> Sales</a>
                    </li>

                    <!-- customers -->
                    <?php  
                        $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_customers WHERE banned = 0");
                        $product_count = $result_product_count->fetch_row();
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/customers/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">supervisor_account</i> Customers (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
                    </li>
                    <?php  
                        $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_customers WHERE banned = 1");
                        $product_count = $result_product_count->fetch_row();
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/banned-customers/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">pan_tool</i> Banned Customers (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
                    </li>  

                    <!-- sellers -->
                    <?php  
                        $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_sellers WHERE banned = 0");
                        $product_count = $result_product_count->fetch_row();
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/sellers/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">face</i> Sellers (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
                    </li>
                    <?php  
                        $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_sellers WHERE banned = 1");
                        $product_count = $result_product_count->fetch_row();
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/banned-sellers/" class="active-menu waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">pan_tool</i> Banned Sellers (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
                    </li> 

                    <!-- products -->
                    <?php  
                        $count = 1;
                        $product_result = $mysqli->query("SELECT * FROM tbl_products WHERE banned = 0");
                        while($product_row = mysqli_fetch_assoc($product_result)):
                            $product_seller_email = $product_row['seller_email'];
                            $seller_result = $mysqli->query("SELECT * FROM tbl_sellers WHERE banned = 0 AND seller_email LIKE '$product_seller_email' ");
                            while($seller_row = mysqli_fetch_assoc($seller_result)):

                                if($seller_row['seller_email'] == $product_row['seller_email']):
                                    // echo $count;
                                    $count++;
                                endif;
                            endwhile;
                        endwhile;
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/products/" class="add-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">shopping_cart</i> Products (<?php echo $count-1; ?>)</a>
                    </li>
                    <?php  
                        $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_products WHERE banned = 1");
                        $product_count = $result_product_count->fetch_row();
                    ?>    
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/banned-products/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">pan_tool</i> Banned Products (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
                    </li>
                    
                    <!-- visits -->
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/visits/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">equalizer</i> Visits</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
      
        <div id="page-wrapper">
          <div class="header"> 
            <h1 class="page-header">
                Banned Sellers
                <!-- <a href="/etiendahan/ed-admin/restricted/slides/new/"><div class="header-link" style="position: relative;left: 5px;bottom: 3px;display: inline-block;font-size: 15px;background-color: #fff;padding: 5px 8px;border: 1px solid #dcdcdc;cursor: pointer;">Add New</div></a>  -->
            </h1>           
        </div>
        
            <div id="page-inner" class="table-responsive">
                <?php $customers_result = $mysqli->query("SELECT * FROM tbl_sellers WHERE banned = 1"); ?>
                <?php if ($customers_result->num_rows == 0): ?>
                    No Banned Sellers Yet
                <?php else: ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Fullname</th>
                          <th scope="col">Email</th>
                          <th scope="col">Joined at</th>
                          <th scope="col">Unbanned</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                            $sellers_result = $mysqli->query("SELECT * FROM tbl_sellers WHERE banned = 1");
                            while($sellers_row = mysqli_fetch_assoc($sellers_result)):
                            $seller_id = $sellers_row['seller_id'];
                            $customers_result = $mysqli->query("SELECT * FROM tbl_customers WHERE id = '$seller_id'");
                            while($customers_row = mysqli_fetch_assoc($customers_result)):
                        ?>
                            <tr>
                              <td style=""><?php echo ($customers_row['fullname'] != '')?$customers_row['fullname']:'-' ?></td>
                              <td style=""><?php $customer_email = $customers_row['email']; echo ($customers_row['email'] != '')?"<a href='mailto:$customer_email' target='_blank' style='text-decoration:none;'>$customer_email</a>":'-' ?></td>
                              <td style="">
                                <?php  
                                    $phpdate = strtotime($sellers_row['joined_at']);
                                    echo $mysqldate = date('M j, Y', $phpdate);
                                ?>
                              </td>
                              <td><a href="/etiendahan/ed-admin/restricted/banned-sellers/unbanned/" class="action-banned-customer" id="<?php echo $customers_row['id'] ?>" style="color: dimgrey;"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">pan_tool</i></a></td>
                            </tr>
                        <?php endwhile; endwhile; ?>
                      </tbody>
                    </table>
                <?php endif; ?>
            
            <!-- /. PAGE INNER  -->
            </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <!-- POPUP NOTIFICATION -->
    <div id="popup-notification-welcome" class="wow fadeIn">
        <div id="etiendahan-notification">Etiendahan Notification</div>
        <div id="popup-close-welcome" class="popup-close"><i class="fa fa-times"></i></div>
        <div class="popup-title text-center" style="margin-top: 5px;"><i class="fa fa-info-circle" style="margin-right: 2px; color: #004085; border-color: #b8daff; font-size: 18px;"></i>Completed!</div>
        <div class="popup-content-welcome text-center" style="font-size: 14px;">
            <?php  
                // Display message only once
                if ( isset($_SESSION['delete-slide']) ) {
                    echo $_SESSION['delete-slide'];
                    // Don't annoy the user with more messages upon page refresh
                    unset($_SESSION['delete-slide']);
                }
            ?>
        </div>
    </div>
    <!-- END OF POPUP NOTIFICATION -->
    
    <!-- POPUP NOTIFICATION -->
    <div id="popup-notification-logout-redirect" class="wow fadeIn">
        <div id="etiendahan-notification">Etiendahan Notification</div>
        <div id="popup-close-logout-redirect" class="popup-close"><i class="fa fa-times"></i></div>
        <div class="popup-title text-center" style="margin-top: 5px;"><i class="fa fa-times-circle" style="margin-right: 2px; color: #721c24; border-color: #f5c6cb; font-size: 18px;"></i>Can't proceed!</div>
        <div class="popup-content-logout-redirect text-center">
           <?php  
                // Display message only once
                if ( isset($_SESSION['cant-proceed-delete-slide']) ) {
                    echo $_SESSION['cant-proceed-delete-slide'];
                    // Don't annoy the user with more messages upon page refresh
                    unset($_SESSION['cant-proceed-delete-slide']);
                }
            ?>
        </div>
    </div>
    <!-- END OF POPUP NOTIFICATION -->

    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    
    <!-- Bootstrap Js -->
    <script src="../assets/js/bootstrap.min.js"></script>
    
    <script src="../assets/materialize/js/materialize.min.js"></script>
    
    <!-- Metis Menu Js -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <!-- <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script> -->
    
    
    <script src="../assets/js/easypiechart.js"></script>
    <script src="../assets/js/easypiechart-data.js"></script>
    
     <script src="../assets/js/Lightweight-Chart/jquery.chart.js"></script>
    
    <!-- Custom Js -->
    <script src="../assets/js/custom-scripts.js"></script> 
 

</body>

</html>