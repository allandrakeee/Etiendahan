<?php  
    require '../../../db.php';
	session_start();

    $logged_in_admin  = ((isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] != '')?htmlentities($_SESSION['logged_in_admin']):'');
    if($logged_in_admin == false) {
        $_SESSION['cant-proceed-message'] = 'You must logged in before viewing admin page.';
        header('location: /etiendahan/ed-admin/');
    }

	$id = $_SESSION['parent_category_id'];
    // echo $id;

    $categories_result = $mysqli->query("SELECT * FROM tbl_categories WHERE id = '$id'");
    $categories_row = $categories_result->fetch_assoc();

	$categories_sub_result = $mysqli->query("SELECT * FROM tbl_categories_sub WHERE parent_id = '$id'");
	$categories_sub_row = $categories_sub_result->fetch_assoc();
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
    <link rel="stylesheet" href="../../assets/materialize/css/materialize.min.css" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <!-- <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" /> -->
    <!-- Custom Styles-->
    <link href="../../assets/css/custom-styles.css" rel="stylesheet" />
    <link href="../../assets/css/custom-scss.scss" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="../../assets/js/Lightweight-Chart/cssCharts.css"> 
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
                        <a href="/etiendahan/ed-admin/restricted/categories/" class="active-menu waves-effect waves-dark"><i class="fa fa-list"></i> Categories</a>
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
                        <a href="/etiendahan/ed-admin/restricted/banned-sellers/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">pan_tool</i> Banned Sellers (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
                    </li> 

                    <!-- products -->
                    <?php  
                        $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_products WHERE banned = 0");
                        $product_count = $result_product_count->fetch_row();
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/products/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">shopping_cart</i> Products (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
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
                Categories
                <ol class="breadcrumb" style="margin-left: 0; padding-left: 0;">
                  <li><a href="/etiendahan/ed-admin/restricted/categories/"><i class="fa fa-list" style="position: relative;top: 6px;"></i></a></li>
                  <li class="active">Modify</li>
                </ol> 
            </h1>           
        </div>
        
            <div id="page-inner">
                
                <form action="/etiendahan/c8NLPYLt-functions/modify-categories-function/" method="POST" enctype="multipart/form-data" style="margin-bottom: 80px;">
                    <div class="form-group">
                        <label for="parent_category"><strong>Parent Category:</strong></label>
                        <input type="text" class="form-control" id="parent_category" name="parent_category" value="<?php echo $categories_row['name'] ?>" required autofocus>
                    </div>
                    
                    <div class="form-group" style="width: 25%">
                        <label for="file"><strong>Image:</strong></label>
                        <input type="file" class="form-control image-admin" id="file" name="file">
                    </div>
                    <img src="<?php echo ($categories_row['image'] != '') ? $categories_row['image'] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>" style="height: 150px; margin-bottom: 15px;" alt="">
                    
                    
                        <div class="form-group dynamic" style="width: 30%; margin-bottom: 8px">
                            <label for="sub_category"><strong>Sub Categories:</strong></label>
                            <?php 
                                $sub_categories_result = $mysqli->query("SELECT * FROM tbl_categories_sub WHERE parent_id = '$id'");
                                while($sub_categories_row = mysqli_fetch_assoc($sub_categories_result)):
                            ?>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" id="sub_category" name="sub_category[<?php echo $sub_categories_row['id'] ?>]" value="<?php echo $sub_categories_row['name']; ?>" required autofocus>
                                    </td>
                                    <td>
                                        <a href="/etiendahan/ed-admin/restricted/categories/delete/" class="btn btn-danger delete-sub-category" id="<?php echo $sub_categories_row['id']; ?>" style="position: relative;bottom: 58px;left: 103%;"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <a href="/etiendahan/ed-admin/restricted/categories/add-row/" class="clearfix" style="text-decoration: none;"><i class="fa fa-plus"></i> Add Sub Categories</a>
                        </div>
                    

                    <a href="/etiendahan/ed-admin/restricted/categories/" class="pull-right" style="text-decoration: none; position: absolute;right: 118px;margin-top: 9px">Cancel</a><button type="submit" class="btn btn-default pull-right" name="submit_categories">Save</button>
                </form>
            <!-- /. PAGE INNER  -->
            </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <!-- POPUP NOTIFICATION -->
    <div id="popup-notification-welcome" class="wow fadeIn">
        <div id="etiendahan-notification">Etiendahan Notification</div>
        <div id="popup-close-welcome" class="popup-close"><i class="fa fa-times"></i></div>
        <div class="popup-title text-center" style="margin-top: 5px;"><i class="fa fa-info-circle alert-primary" style="margin-right: 2px; color: #004085; border-color: #b8daff; font-size: 18px;"></i>Completed!</div>
        <div class="popup-content-welcome text-center" style="font-size: 14px;">
            <?php  
                // Display message only once
                if ( isset($_SESSION['modify-category']) ) {
                    echo $_SESSION['modify-category'];
                    // Don't annoy the user with more messages upon page refresh
                    unset($_SESSION['modify-category']);
                }
            ?>

            <?php  
                // Display message only once
                if ( isset($_SESSION['delete-sub-category']) ) {
                    echo $_SESSION['delete-sub-category'];
                    // Don't annoy the user with more messages upon page refresh
                    unset($_SESSION['delete-sub-category']);
                }
            ?>
        </div>
    </div>
    <!-- END OF POPUP NOTIFICATION -->

    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="../../assets/js/jquery-1.10.2.js"></script>
    
    <!-- Bootstrap Js -->
    <script src="../../assets/js/bootstrap.min.js"></script>
    
    <script src="../../assets/materialize/js/materialize.min.js"></script>
    
    <!-- Metis Menu Js -->
    <script src="../../assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <!-- <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script> -->
    
    
    <script src="../../assets/js/easypiechart.js"></script>
    <script src="../../assets/js/easypiechart-data.js"></script>
    
     <script src="../../assets/js/Lightweight-Chart/jquery.chart.js"></script>
    
    <!-- Custom Js -->
    <script src="../../assets/js/custom-scripts.js"></script> 
 

</body>

</html>