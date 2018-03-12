<?php  
    require '../../../db.php';
    session_start();
    // echo $review_go_to_message_id = $_SESSION['review_go_to_message'];

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
                <!-- <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown4"><i class="fa fa-envelope fa-fw"></i> <i class="material-icons right">arrow_drop_down</i></a></li>                -->
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown2">
                    <?php  
                        $read_result = $mysqli->query("SELECT COUNT(*) FROM tbl_ratings_reports WHERE read_status = 0");
                        $read_row = $read_result->fetch_row();
                    ?>
                    
                    <?php if($read_row[0] <= 0): ?>
                        <i class="fa fa-flag fa-fw" style="font-size: 16px; color: #1f2837;"></i><i class="material-icons right">arrow_drop_down</i></a></li>
                    <?php else: ?>
                        <span class="fa-stack has-badge" data-count="<?php echo $read_row[0]; ?>">
                            <!-- <i class="fa fa-circle fa-stack-2x"></i> -->
                            <i class="fa fa-flag fa-fw" style="font-size: 16px; color: #1f2837;"></i>
                            <!-- <i class="fa fa-shopping-bag fa-stack-1x"></i> -->
                        </span> <i class="material-icons right">arrow_drop_down</i></a></li>
                    <?php endif; ?>
                <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b><?php echo $_SESSION['admin_fullname']; ?></b> <i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </nav>
        <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
<li><a href="/etiendahan/ed-admin/logout/"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
</li>
</ul>
<ul id="dropdown2" class="dropdown-content w250">
    <?php 
        $result = $mysqli->query("SELECT * FROM tbl_ratings_reports");
        if($result->num_rows > 0):
    ?>
        <?php  
            function dateDifference($date1, $date2) {       
                $date1=strtotime($date1);
                $date2=strtotime($date2); 
                $diff = abs($date1 - $date2);
                
                $day = $diff/(60*60*24); // in day
                $dayFix = floor($day);
                $dayPen = $day - $dayFix;
                if($dayPen > 0)
                {
                    $hour = $dayPen*(24); // in hour (1 day = 24 hour)
                    $hourFix = floor($hour);
                    $hourPen = $hour - $hourFix;
                    if($hourPen > 0)
                    {
                        $min = $hourPen*(60); // in hour (1 hour = 60 min)
                        $minFix = floor($min);
                        $minPen = $min - $minFix;
                        if($minPen > 0)
                        {
                            $sec = $minPen*(60); // in sec (1 min = 60 sec)
                            $secFix = floor($sec);
                        }
                    }
                }
                $str = "";
                if($dayFix > 0)
                    if($dayFix == 1) {
                        $str.= $dayFix." day ";
                    } else {
                        $str.= $dayFix." days ";
                    }
                if($hourFix > 0)
                    if($dayFix < 1) {
                        if($hourFix == 1) {
                            $str.= $hourFix." hour ";
                        } else {
                            $str.= $hourFix." hours ";
                        }
                    }
                if($minFix > 0)
                    if($hourFix < 1 AND $dayFix < 1) {
                        if($minFix == 1) {
                            $str.= $minFix." min ";
                        } else {
                            $str.= $minFix." mins ";
                        }
                    }
                if($secFix > 0)
                    if($minFix < 1) {
                        if($secFix == 1) {
                            $str.= $secFix." sec ";
                        } else {
                            $str.= $secFix." secs ";
                        }
                    } 
                return $str;
            }

            // $ratings_report_result = $mysqli->query("SELECT GROUP_CONCAT(rating_id) as 'concat_id_rating' FROM tbl_ratings_reports");
            // $ratings_report_row = mysqli_fetch_assoc($ratings_report_result);
            // $concat_id_rating = $ratings_report_row['concat_id_rating'];

            $ratings_result1 = $mysqli->query("SELECT * FROM tbl_ratings_reports GROUP BY id desc LIMIT 5");
            while($ratings_row1 = mysqli_fetch_assoc($ratings_result1)):
                $rating_id1 = $ratings_row1['rating_id'];

            $ratings_result = $mysqli->query("SELECT * FROM tbl_ratings WHERE id = '$rating_id1'");
            while($ratings_row = mysqli_fetch_assoc($ratings_result)):
        ?>
        <a href="/etiendahan/ed-admin/restricted/report-as-inappropriate/" class="review-go-to-message" id="<?php echo $ratings_row1['id']; ?>" style="padding: 0; text-decoration: none;">
        <li>
                <div>
                    <div class="text-title" style="margin-top: 5px;height: 20px;;width: 175px;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">
                        <?php echo $ratings_row['title']; ?>
                    </div>
                    <span class="pull-right text-muted small" style="position: relative;top: -20px;">
                        <?php 
                            $sql_created_at = $ratings_row1['created_at'];
                            $datetime1 = $sql_created_at;
                            $datetime2 = date("Y-m-d H:i:s", strtotime('-9 hours'));                        
                            echo dateDifference($datetime1, $datetime2);
                        ?>
                    </span>
                </div>
        </li>
        </a>
        <li class="divider"></li>
        <?php endwhile; endwhile; ?>
        <li>
            <a class="text-center" href="/etiendahan/ed-admin/restricted/report-as-inappropriate/">
                <strong>See All Reports</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    <?php else: ?>
        <li style="cursor: default;">No Reports Yet</li>
    <?php endif; ?>
    
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
        <nav class="navbar-default navbar-side" role="navigation" style="height: 570px;overflow: hidden;overflow-y: scroll;">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <!-- dashboard -->
                    <li>
                        <a class="waves-effect waves-dark" href="/etiendahan/ed-admin/restricted/"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>

                    <!-- specialty in city -->
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/specialty-in-city/" class="waves-effect waves-dark"><i class="fa fa-building-o" style="display: inline-block;font-size: 15px;"></i> Specialty in City </a>
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
                        <a href="/etiendahan/ed-admin/restricted/banned-sellers/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">pan_tool</i> Banned Sellers (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
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
                        <a href="/etiendahan/ed-admin/restricted/products/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">shopping_cart</i> Products (<?php echo $count-1; ?>)</a>
                    </li>
                    <?php  
                        $result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_products WHERE banned = 1");
                        $product_count = $result_product_count->fetch_row();
                    ?>    
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/banned-products/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">pan_tool</i> Banned Products (<?php if($product_count[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$product_count[0], 0, '', ','); endif; ?>)</a>
                    </li>

                    <!-- report as inappropriate -->
                    <?php  
                        $read_result = $mysqli->query("SELECT COUNT(*) FROM tbl_ratings_reports WHERE read_status = 0");
                        $read_row = $read_result->fetch_row();
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/report-as-inappropriate/" class="waves-effect waves-dark"><i class="fa fa-flag" style="display: inline-block;font-size: 15px;"></i> Report as Inappropriate (<?php if($read_row[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$read_row[0], 0, '', ','); endif; ?>)</a>
                    </li>
                    
                    <!-- visits -->
                    <?php  
                        $visit_result = $mysqli->query("SELECT COUNT(*) FROM tbl_visits");
                        $visit_row = $visit_result->fetch_row();
                    ?>
                    <li>
                        <a href="/etiendahan/ed-admin/restricted/visits/" class="waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;">equalizer</i> Visits (<?php if($visit_row[0] == 0): ?>0<?php else: ?><?php echo number_format((int)$visit_row[0], 0, '', ','); endif; ?>)</a>
                    </li>

                    <li>
                        <a href="/etiendahan/ed-admin/restricted/quantity/" class="active-menu waves-effect waves-dark"><i class="material-icons dp48" style="display: inline-block;font-size: 15px;"></i> Quantity </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
      
        <div id="page-wrapper">
          <div class="header"> 
            <h1 class="page-header">
                Quantity
                <!-- <a href="/etiendahan/ed-admin/restricted/slides/new/"><div class="header-link" style="position: relative;left: 5px;bottom: 3px;display: inline-block;font-size: 15px;background-color: #fff;padding: 5px 8px;border: 1px solid #dcdcdc;cursor: pointer;">Add New</div></a>  -->
            </h1>           
        </div>
        
            <div id="page-inner" class="table-responsive">
                <form action="/etiendahan/c8NLPYLt-functions/add-slides-function/" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-field">
                            <input type="text" class="validate" style="margin-bottom: 8px; width: 30%;" id="search_input" name="search_input" required>
                            <label for="title"><strong>Enter quantity</strong></label>
                        </div>
                    </div>
                </form>    
                
                <div id="result"></div>

                <!-- <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Product ID</th>
                          <th scope="col">Description</th>
                          <th scope="col">Quantity</th>
                        </tr>
                      </thead>
                      <tbody id="fbody">
                         <?php  
                            $result_quantity = $mysqli->query("SELECT * FROM tbl_products WHERE stock > 0 AND banned = 0");
                            while($row_quantity = mysqli_fetch_assoc($result_quantity)):
                        ?>
                            <tr>
                              <td><?php echo $row_quantity['id'] ?></td>
                              <td><?php echo $row_quantity['description'] ?></td>
                              <td><?php echo $row_quantity['stock'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                      </tbody>
                </table>   -->          
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
                if ( isset($_SESSION['success-message']) ) {
                    echo $_SESSION['success-message'];
                    // Don't annoy the user with more messages upon page refresh
                    unset($_SESSION['success-message']);
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
    
    <script>
    $(document).ready(function(){

     load_data();

     function load_data(query)
     {
      $.ajax({
       url:"/etiendahan/c8NLPYLt-functions/quantity-function.php",
       method:"POST",
       data:{query:query},
       success:function(data)
       {
        $('#result').html(data);
       }
      });
     }
     $('#search_input').keyup(function(){
      var search = $(this).val();
      if(search != '')
      {
       load_data(search);
      }
      else
      {
       load_data();
      }
     });
    });
    </script>

</body>

</html>