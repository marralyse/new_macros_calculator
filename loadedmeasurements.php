<?php


require_once('/home/mariah6/public_html/wp-load.php');

global $wpdb;

$userid = $_SESSION["userid"];

print_r($userid);

$existingdata = $wpdb->get_row("SELECT * FROM wp_calcmeasure WHERE userid LIKE '$userid'", ARRAY_A);

print_r($existingdata);

$existinggender = $existingdata[gender];

$male_status = 'unchecked';
$female_status = 'unchecked';

if (isset($existinggender)) {

$selected_radio = $existinggender;

if ($selected_radio == 'male') {

$male_status = 'checked';

}
if ($selected_radio == 'female') {

$female_status = 'checked';

}

}

$existingheight = $existingdata[height];
$existingweight = $existingdata[weight];
$existingwaist = $existingdata[waist];
$existingneck = $existingdata[neck];
$existinghip = $existingdata[hip];

print_r($existingheight);

?>
