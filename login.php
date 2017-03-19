<?php

require_once('/home/mariah6/public_html/wp-load.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$useremail = $_POST["useremail"];
$password = $_POST["password"];
//error check that useremail and password are filled in

//print_r($useremail);
//print_r($password);

//query database
//$checkdatabase = $wpdb->get_results("SELECT * FROM wp_calcregister WHERE useremail = 'test'"); WHERE id LIKE' . $id . ';")

$checkdatabase = $wpdb->get_row("SELECT * FROM wp_calcregister WHERE useremail LIKE '$useremail'", ARRAY_A);

//print_r($checkdatabase);
//print_r($checkdatabase[useremail]);
//print_r(gettype($checkdatabase[password]));

$error = new WP_Error();

//from wordpress authenticate_password()
if (empty($useremail) || empty($password) ) {
        if ( empty($useremail) )
            $useremailerror ='Email required';
            //$error->add('empty_username', __('<strong>ERROR</strong>: The useremail field is empty.'));
            //print_r("username empty");

        if ( empty($password) )
            $error->add('empty_password', __('<strong>ERROR</strong>: The password field is empty.'));
            //print_r("password empty");

        //print_r($error);
        return $useremailerror;
}

//if find user, check password
if ($checkdatabase)
{

	if ($password == $checkdatabase[password] )
	{
		print_r("The password matches");
		//redirect

	}
	else
	{
		//print_r("The passwords don't match");
            	$error->add('incorrect_password', __( '<strong>ERROR</strong>: The password you entered is incorrect.'));
            	//print_r($error);
            	return $error;
        }
}
else
{
	$error->add('nonexistent_username', __( '<strong>ERROR</strong>: The useremail you entered was not found.'));
	return $error;
}

//print_r($error);
}
?>
