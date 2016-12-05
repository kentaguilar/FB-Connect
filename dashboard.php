<?php

	if(!session_id()) {
	    session_start();
	}

	require_once __DIR__ . '/config/fb.php';
	require_once __DIR__ . '/config/db.php';
	require_once __DIR__ . '/common/functions.php';
	require_once __DIR__ . '/vendor/autoload.php';

	$fb = new Facebook\Facebook([
		'app_id' => APP_ID,
		'app_secret' => APP_SECRET,
		'default_graph_version' => 'v2.2',
	]);

	$helper = $fb->getRedirectLoginHelper();

	try {
		$accessToken = $helper->getAccessToken();
	} 
	catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} 
	catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	if(isset($accessToken)){
	 	$response = $fb->get('/me?fields=id,name,email', $accessToken);

	  	//if you intend to use fb data on other pages, you can pretty much use this session
		$_SESSION['fb_access_token'] = (string) $accessToken;

		$current_fb_user = $response->getGraphUser();

		//save user if not existing on db.
		check_user($current_fb_user['id'], $current_fb_user['name'], $current_fb_user['email']);

	}	
	else{
		if ($helper->getError()) {
			header('HTTP/1.0 401 Unauthorized');
			echo "Error: " . $helper->getError() . "\n";
			echo "Error Code: " . $helper->getErrorCode() . "\n";
			echo "Error Reason: " . $helper->getErrorReason() . "\n";
			echo "Error Description: " . $helper->getErrorDescription() . "\n";
		} 
		else {
			header('HTTP/1.0 400 Bad Request');
			echo 'Bad request';
		}
		
		exit;
	}
?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Login with Facebook</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> 
 </head>
  <body>

  	<div class="container">
	<h1>Dashboard</h1>	

	<section class="content">
		<div class="row">

			<div class="col-md-5">
		        <div class="box box-primary">

		            <div class="box-body">
		              
						<?php 
							if(isset($accessToken)){ 
						?>
							<div class="form-group">
								<label>ID</label>
								<input type="text" class="form-control" value="<?= $current_fb_user['id'] ?>" />
							</div> 

							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" value="<?= $current_fb_user['name'] ?>" />
							</div> 

							<div class="form-group">
								<label>Email</label>
								<input type="text" class="form-control" value="<?= $current_fb_user['email'] ?>" />
							</div>         
						<?php 
							}
						?>


		            </div>	          

		        </div>      
		    </div>
		</div>
	</section>

	</div>

  	</body>
</html>
