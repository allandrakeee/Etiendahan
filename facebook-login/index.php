<?php  

	require_once 'app/init.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php if(!isset($_SESSION['facebook'])): ?>
		<a href="<?php echo $facebook->getLoginUrl(); ?>">Sign in with facebook</a>
	<?php else: ?>
		You are signed in.<a href="/etiendahan/facebook-login/signout/">Signout</a>
	<?php endif; ?>
</body>
</html>