<?php  
  require '/../../db.php';
  session_start();

  $logged_in        = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
  $activateSeller   = ((isset($_SESSION['activateSeller']) && $_SESSION['activateSeller'] != '')?htmlentities($_SESSION['activateSeller']):'');

  // Check if user is logged in using the session variable
  if ($logged_in == false) {
    $_SESSION['profile-cant-proceed-message'] = "You must log in before you activate your seller centre page.";
    header("location: /etiendahan/seller-centre/account/signin/");    
  }

  echo $activateSeller;

  if ($activateSeller == 1) {
    $_SESSION['profile-cant-proceed-message'] = "You already activated your seller centre account.";
    header("location: /etiendahan/seller-centre/"); 
  }
  else {
      // Makes it easier to read
      // $fullname   = $_SESSION['fullname'];
      // $gender     = $_SESSION['gender'];
      // $email      = $_SESSION['email'];
      // $active     = $_SESSION['active'];
      // $birthday   = $_SESSION['birthday'];
      // $birthmonth = $_SESSION['birthmonth'];
      // $birthyear  = $_SESSION['birthyear'];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Active Seller Centre Account - Etiendahan Dagupan</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name=viewport content="width=device-width, initial-scale=1">
  
  <!-- favicon -->
  <link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

  <!-- link inner -->
  <?php  
    include '../../header-link.php';
  ?>

</head>

<?php  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '/../../c8NLPYLt-functions/activate-function.php';  
  }
?>

<body>
  <div id="seller-centre-page" class="main-container">
    <div class="main-wrapper">
      <div class="main">
        <!-- SECTION 1 -->
        <div id="etiendahan-section-1" class="etiendahan-section">
          <!-- navbar -->
          <nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
              <a class="navbar-brand" href="http://localhost:8080/etiendahan/seller-centre/account/signin/">
              <img src="/etiendahan/temp-img/etiendahan-logo-seller-centre.png" width="178" height="58" class="d-inline-block align-top" alt="">
            </a>  

            <div class="ml-auto d-flex">
              <!-- CART -->
              <div class="nav-item right-nav dropdown" id="cart">
                <a class="nav-link" href="http://localhost:8080/etiendahan/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
                  Etiendahan Homepage
                </a>
              </div>

              <div class="nav-item right-nav dropdown" id="user-account">
                <div class="social">
                  <ul class="social-icons">
                    <li class="facebook">
                      <a class="fa fa-facebook" href="https://web.facebook.com/etiendahan/" target="_blank"></a>
                    </li>
                    <li class="instagram">
                      <a class="fa fa-instagram" href="https://www.instagram.com/etiendahan/" target="_blank"></a>
                    </li>
                    <li class="twitter">
                      <a class="fa fa-twitter" href="https://twitter.com/etiendahan/" target="_blank"></a>
                    </li>
                    <li class="google-plus">
                      <a class="fa fa-google-plus" href="https://plus.google.com/u/2/110265818297635318631/" target="_blank"></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </nav>
        </div>
        <!-- END OF SECTION 1 --> 
        
        <!-- ACTIVATE PAGE -->
        <div id="etiendahan-activate-page" class="etiendahan-section">
          <div class="container">
            <div class="toggle-wrapper">
              <span class="title text-center">Activate now your Seller Centre account?</span>
                <form class="myform" class="activate" action="/etiendahan/seller-centre/account/activate/" method="POST">
                  <input class="activate-seller" name="activateSeller" type="checkbox" id="switch" value="yes">
                  <label for="switch">Toggle</label>
                </form>
            </div>  
          </div>
        </div>
        <!-- END OF ACTIVATE PAGE -->

                <!-- POPUP NOTIFICATION -->
        <div id="popup-notification" class="wow fadeIn">
          <div id="etiendahan-notification">Etiendahan Notification</div>
          <div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
          <div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
          <div class="popup-content text-center">
            <?php  
              // Display message only once
              if ( isset($_SESSION['cant-proceed-message']) ) {
                echo $_SESSION['cant-proceed-message'];
                // Don't annoy the user with more messages upon page refresh
                unset( $_SESSION['cant-proceed-message'] );
              }
            ?>
          </div>
        </div>
        <!-- END OF POPUP NOTIFICATION -->    
      </div>
    </div>
  </div>

    <!-- Development - Normal import of theme.js -->
  <script src="/etiendahan/assets/js/theme.js"></script>
  
  <!-- Development - Minifies import of theme.js -->
  <!-- <script src="/etiendahan/assets/js/theme.min.js"></script> -->

  <!-- Production - Normal import of theme.js -->
  <!-- <script src="/assets/js/theme.js"></script> -->

  <!-- Production - Minified import of theme.js -->
  <!-- <script src="/assets/js/theme.min.js"></script> -->
</body>
</html>