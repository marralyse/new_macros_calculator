<?php
/* Template Name: register */
?>

//working on the password requirements
//need 20 to uncomment

<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

require_once('/home/mariah6/public_html/wp-load.php');

global $wpdb;


if (isset($_SESSION['userid'])) {
    wp_redirect("http://mariahshields.com/macronutrition-calculator/" );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$useremail = $_POST["useremail"];
$password = $_POST["password"];
$confirmation = $_POST["confirmation"];

print_r($_SESSION['userid']);

$error = false;

$checkdatabase = $wpdb->get_row("SELECT * FROM wp_calcregister WHERE useremail LIKE '$useremail'", ARRAY_A);
//print_r($checkdatabase);
//login
if (isset($_POST['submitlogin'])) {
	if (empty($useremail) || empty($password) ) {
	        if ( empty($useremail) ) {
	            $loginemailerror='*Email required';
	            $error = true;
	        }
	        if (empty($password) ) {
	            $loginpassworderror = "*Password required";
	            $error = true;
	        }
	}


	if (!$checkdatabase) {
		$nouser = "*User not found";
	}
	if ($checkdatabase)
	{
		if ($password == $checkdatabase[password] && $error == false)
		{
			//print_r("The password matches");
			$_SESSION['userid'] = $checkdatabase[userid];
			$_SESSION['useremail'] = $checkdatabase[useremail];
			wp_redirect("http://mariahshields.com/macronutrition-calculator/" );
	//exit;
			//redirect
		}
		else {
			$nopasswordmatch = "*Incorrect password for given username";
		}
	}
}
//registration
else{
	if (empty($useremail) || empty($password) ) {
	        if ( empty($useremail) ) {
	            $registeremailerror='*Email required';
	            $error = true;
	        }
	        if ( empty($password) ) {
	            $registerpassworderror = "*Password required";
	            $error = true;
	       }
	        if ( empty($confirmation) ) {
	            $confirmationerror = "*Please confirm password";
	            $error = true;
	       }
	 }
	 //print_r($password);
	 if(strlen($password) < 6) {
	 	$passwordlength = "*Password must be at least 6 characters";
	 	$error = true;
	 }
	 if((preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password) == false))
         {
                $passwordcomp = "*Password should contain letters and numbers";
                $error = true;
          }

	       if ($checkdatabase) {
	          $userexistserror = "*Username already exists";
	          $error = true;
	      }


	if ($password != $confirmation) {
	       	   $noconfirmationmatch = "*Passwords don't match";
	       	   $error = true;
	}

	if ($error == false) {
		$data = array('useremail' => $useremail,'password' => $password);

		$test_insert = $wpdb->insert('wp_calcregister', $data);

		$rows = $wpdb->get_results("SELECT LAST_INSERT_ID() AS userid");
		print_r($rows);
		$userid = $rows[0]->userid;

		print_r($userid);

		//start session
		//register_my_function(
		$_SESSION['useremail'] = $useremail;
		$_SESSION['userid'] = $userid;


		wp_redirect("http://mariahshields.com/macronutrition-calculator/" );
		exit;
		//$success = "Success";
	}
}
}



?>

<div class="container-fluid">
  <div class="row row-centered">
    <div class="col-md-3 col-centered" id="leftside">
    	<h4>Register</h4>
    	<p>Enter your email for the username and a password 6 characters or longer, composed of both letters and numbers.</p>
	<form id = "userRegister" action="" method="post">
	    <fieldset>
	        <div class="form-group">
	            <input autocomplete="off" autofocus class="form-control" name="useremail" placeholder="User Email" type="text"/>
	            <span class="text-danger"><?php print_r( '<p>'.$registeremailerror.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$userexistserror.'</p>');?></span>
	        </div>
	        <div class="form-group">
	            <input class="form-control" name="password" placeholder="Password" type="password"/>
	            <span class="text-danger"><?php print_r( '<p>'.$registerpassworderror.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$passwordcomp.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$passwordlength.'</p>');?></span>

	        </div>
	        <div class="form-group">
	            <input class="form-control" name="confirmation" placeholder="Confirm Password" type="password"/>
	            <span class="text-danger"><?php print_r( '<p>'.$confirmationerror.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$noconfirmationmatch.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$success.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$password.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$confirmation.'</p>');?></span>


	        </div>
	        <div class="form-group">
	            <button class="btn btn-default" name="submitregistration" type="submit">
	                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
	                Register
	            </button>
	        </div>
	    </fieldset>
	</form>
     </div>
     <div class="col-md-3 col-centered" id="rightside">
     <h4>Login</h4>
	<form id = "userLogin" action="" method="post">
	    <fieldset>
	        <div class="form-group">
	            <input autocomplete="off" autofocus class="form-control" name="useremail" placeholder="User Email" type="text"/>
	            <span class="text-danger"><?php print_r( '<p>'.$loginemailerror.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$nouser.'</p>');?></span></div>
	        <div class="form-group">
	            <input class="form-control" name="password" placeholder="Password" type="password"/>
	            <span class="text-danger"><?php print_r( '<p>'.$loginpassworderror.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$nopasswordmatch.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$success.'</p>');?></span>
	            <span class="text-danger"><?php print_r( '<p>'.$exiting.'</p>');?></span>
	        </div>
	        <div class="form-group">
	            <button class="btn btn-default" name="submitlogin" type="submit">
	                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
	                Login
	            </button>
	        </div>
	    </fieldset>
	</form>
      </div>
  </div>
</div>


<?php get_footer(); ?>
