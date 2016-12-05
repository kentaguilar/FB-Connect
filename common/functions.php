<?php	

	function check_user($fb_id, $fb_name, $fb_email){
		$user_exists = mysql_query("SELECT * FROM fb_users WHERE fb_id='$fb_id'");

		if(empty(mysql_num_rows($user_exists))){
			$query = "INSERT INTO fb_users (fb_id,fb_name,fb_email) VALUES ('$fb_id','$fb_name','$fb_email')";
			mysql_query($query);
		}
		else{
			$query = "UPDATE fb_users SET fb_name='$fb_name', fb_email='$fb_email' where fb_id='$fb_id'";
			mysql_query($query);			
		}
	}

?>