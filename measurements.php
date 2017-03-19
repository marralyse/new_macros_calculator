<?php

require_once('/home/mariah6/public_html/wp-load.php');

global $wpdb;

$userid = $_SESSION["userid"];
$gender = $_POST['gender'];
$height = $_POST["height"];
$weight = $_POST["weight"];
$waist = $_POST["waist"];
$neck = $_POST["neck"];
$hip= $_POST["hip"];

$checkmeasure = $wpdb->get_row("SELECT * FROM wp_calcmeasure WHERE userid LIKE '$userid'", ARRAY_A);
print_r($height);
print_r($hip);
print_r($checkmeasure[id]);
print_r("working");
print_r($userid);
print_r($checkmeasure);

$errorcheck = "";

if ($checkmeasure)
{
	$wpdb->update('wp_calcmeasure', array('userid' => $_SESSION["userid"],'gender' => $gender, 'height' => $height, 'weight' => $weight, 'waist' => $waist, 'neck' => $neck, 'hip'=> $hip), array('id' => $checkmeasure[id]));

	$errorcheck = "Saved Successfully";

}

else{
$measurements= array('userid' => $_SESSION["userid"],'gender' => $gender, 'height' => $height, 'weight' => $weight, 'waist' => $waist, 'neck' => $neck, 'hip'=> $hip);

$errorcheck = "Saved Successfully";

}

print_r($measurements);

$measure_insert = $wpdb->insert('wp_calcmeasure', $measurements);

?>
