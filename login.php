<?php

  if(!session_id()) {
      session_start();
  }

  require_once __DIR__ . '/config/fb.php';
  require_once __DIR__ . '/vendor/autoload.php';

  $fb = new Facebook\Facebook([
    'app_id' => APP_ID, 
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.2'
    ]);

  $helper = $fb->getRedirectLoginHelper();
  
  $loginUrl = $helper->getLoginUrl('http://localhost/playground/fbconnect/dashboard.php', $permissions);

?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Login with Facebook</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> 
 </head>
  <body>

  	<div class="container">
	<h1>Login</h1>	

	<div>
  		<?php echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';?>
  	</div>

  	</body>
</html>
