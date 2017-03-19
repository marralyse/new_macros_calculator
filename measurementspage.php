<?php
/* Template Name: calculator */
?>

<?php

get_header();

require_once('/home/mariah6/public_html/wp-load.php');

require_once('/home/mariah6/public_html/wp-content/themes/Divi/loadedmeasurements.php');

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

$errorcheck = false;

?>

<h1 id="title">Macronutrition Weekly Plan</h1>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4" id="leftside">
	<div>
		<form id = "logout" action = "../wp-content/themes/Divi/logout.php" method="post">
			<button class="btn btn-default topbuttons" type="submit" id = "logoutbutton" value="logout">
		        <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
		         Logout
		        </button>
		</form>
	</div>
	<h3><center>Enter Your Measurements<center></h3><br>
	<div id = "measurements" >
		<form name = "userInput" id="userAjax" action="../wp-content/themes/Divi/measurements.php" method="post">
			<table class = "input">
				<tr>
					<td><input type="radio" name="gender" value="male" id= "male" checked=<?php $malestatus ?> > Male</td>
					<td><input type="radio" name="gender" value="female" id="female" checked=<?php $femalestatus ?>> Female</td>
				</tr>
				<tr>
					<td class="input-labels">Height</td>
					<td ><input type="number" id="height" name="height" class = "recalculate" value=<?php print_r($existingheight) ?> > in</td>
				</tr>
				<tr>
					<td class="input-labels">Weight</td>
					<td ><input type="number" id="weight" name = "weight" class = "recalculate" value=<?php print_r($existingweight) ?> >lbs</td>
				</tr>
				<tr>
					<td class="input-labels">Waist</td>
					<td ><input type="number" id="waist" name="waist" class = "recalculate" value=<?php print_r($existingwaist) ?> >in</td>
				</tr>
				<tr>
					<td class="input-labels">Neck</td>
					<td ><input type="number" id="neck" name="neck" value=<?php print_r($existingneck) ?> >in</td>
				</tr>
				<tr>
					<td class="input-labels">Hip</td>
					<td ><input type="number" id="hip" name="hip" value=<?php print_r($existinghip) ?> >in</td>
				</tr>
			</table>
		</form>
	</div>
	<center><button class="btn btn-default topbuttons" type="submit" id = "calculate" value="Calculate">
	       	<span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
	       	Save
	</button></center>
	<div id = "errormessage" ></div>
	<br>
	<br>
	<br>
	<table class = "bodyFat">
	<p><center><strong>Measurement Calculations</strong><center></p>
		<tr>
			<td>Body Fat Percentage</td><td><div id="bfone" class = "toclear"></div></td>
		</tr>
		<tr>
			<td>Lean Body Mass</td><td><div id="lbm" class = "toclear"></div></td>
		</tr>
		<tr>
			<td>BMR-</td><td><div id="bmrneg" class = "toclear"></div></td>
		</tr>
		<tr>
			<td>BMR+</td><td><div id="bmrpos" class = "toclear"></div></td>
		</tr>
	</table>

    </div>
    <div class="col-sm-8" id= "rightside">
	<div id ="macronutrients">
	<h1><center>Results<center></h1>
	<div><h5>Results for: <strong><?php print_r(esc_html($_SESSION["useremail"]));?></strong></h5></div>
	<table>
		<tr>
			<td><strong>Daily Water Intake: </strong></td><td id= "water_intake" class = "toclear"></td>
		</tr>
		<tr>
			<td><strong>Daily Fiber Intake: </strong></td><td id="fiber_intake" class = "toclear"></td><br>
		</tr>
	</table>
	<br>
	<h4 class="week">Week 1</h4>
		<table class ="food">
			<thead>
				<tr>
					<th></th>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thur</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				<tr>
			</thead>
			<tbody>
				<tr>
					<td class="type" >Protein</td>
					<td id="promonone" class = "toclear"></td>
					<td id="protueone" class = "toclear"></td>
					<td id="prowedone" class = "toclear"></td>
					<td id="prothuone" class = "toclear"></td>
					<td id="profrione" class = "toclear"></td>
					<td id="prosatone" class = "toclear"></td>
					<td id="prosunone" class = "toclear"></td>
				</tr>
				<tr>
					<td class="type">Carbs</td>
					<td id="carbmonone" class = "toclear"></td>
					<td id="carbtueone" class = "toclear"></td>
					<td id="carbwedone" class = "toclear"></td>
					<td id="carbthuone" class = "toclear"></td>
					<td id="carbfrione" class = "toclear"></td>
					<td id="carbsatone" class = "toclear"></td>
					<td id="carbsunone" class = "toclear"></td>
				</tr>
				<tr>
					<td class= "type">Fat</td>
					<td id="fatmonone" class = "toclear"></td>
					<td id="fattueone" class = "toclear"></td>
					<td id="fatwedone" class = "toclear"></td>
					<td id="fatthuone" class = "toclear"></td>
					<td id="fatfrione" class = "toclear"></td>
					<td id="fatsatone" class = "toclear"></td>
					<td id="fatsunone" class = "toclear"></td>
				</tr>
				<tr>
					<td class= "type">Calories</td>
					<td id="calmonone" class = "toclear"></td>
					<td id="caltueone" class = "toclear"></td>
					<td id="calwedone" class = "toclear"></td>
					<td id="calthuone" class = "toclear"></td>
					<td id="calfrione" class = "toclear"></td>
					<td id="calsatone" class = "toclear"></td>
					<td id="calsunone" class = "toclear"></td>
				</tr>
			</tbody>
		</table>

	<h4 class="week">Week 2</h4>
		<table class ="food">
			<thead>
				<tr>
					<th></th>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thur</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				<tr>
			</thead>
			<tbody>
				<tr>
					<td class="type" >Protein</td>
					<td id="promontwo" class = "toclear"></td>
					<td id="protuetwo" class = "toclear"></td>
					<td id="prowedtwo" class = "toclear"></td>
					<td id="prothutwo" class = "toclear"></td>
					<td id="profritwo" class = "toclear"></td>
					<td id="prosattwo" class = "toclear"></td>
					<td id="prosuntwo" class = "toclear"></td>
				</tr>
				<tr>
					<td class="type">Carbs</td>
					<td id="carbmontwo" class = "toclear"></td>
					<td id="carbtuetwo" class = "toclear"></td>
					<td id="carbwedtwo" class = "toclear"></td>
					<td id="carbthutwo" class = "toclear"></td>
					<td id="carbfritwo" class = "toclear"></td>
					<td id="carbsattwo" class = "toclear"></td>
					<td id="carbsuntwo" class = "toclear"></td>
				</tr>
				<tr>
					<td class= "type">Fat</td>
					<td id="fatmontwo" class = "toclear"></td>
					<td id="fattuetwo" class = "toclear"></td>
					<td id="fatwedtwo" class = "toclear"></td>
					<td id="fatthutwo" class = "toclear"></td>
					<td id="fatfritwo" class = "toclear"></td>
					<td id="fatsattwo" class = "toclear"></td>
					<td id="fatsuntwo" class = "toclear"></td>
				</tr>
				<tr>
					<td class= "type">Calories</td>
					<td id="calmontwo" class = "toclear"></td>
					<td id="caltuetwo" class = "toclear"></td>
					<td id="calwedtwo" class = "toclear"</td>
					<td id="calthutwo" class = "toclear"></td>
					<td id="calfritwo" class = "toclear"></td>
					<td id="calsattwo" class = "toclear"></td>
					<td id="calsuntwo" class = "toclear"></td>
				</tr>
			</tbody>
		</table>
	<h4>Week 3</h4>
		<table class ="food">
			<thead>
				<tr>
					<th></th>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thur</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				<tr>
			</thead>
			<tbody>
				<tr>
					<td class="type" >Protein</td>
					<td id="promonthree" class = "toclear"></td>
					<td id="protuethree" class = "toclear"></td>
					<td id="prowedthree" class = "toclear"></td>
					<td id="prothuthree" class = "toclear"></td>
					<td id="profrithree" class = "toclear"></td>
					<td id="prosatthree" class = "toclear"></td>
					<td id="prosunthree" class = "toclear"></td>
				</tr>
				<tr>
					<td class="type">Carbs</td>
					<td id="carbmonthree" class = "toclear"></td>
					<td id="carbtuethree" class = "toclear"></td>
					<td id="carbwedthree" class = "toclear"></td>
					<td id="carbthuthree" class = "toclear"></td>
					<td id="carbfrithree" class = "toclear"></td>
					<td id="carbsatthree" class = "toclear"></td>
					<td id="carbsunthree" class = "toclear"></td>
				</tr>
				<tr>
					<td class= "type">Fat</td>
					<td id="fatmonthree" class = "toclear"></td>
					<td id="fattuethree" class = "toclear"></td>
					<td id="fatwedthree" class = "toclear"></td>
					<td id="fatthuthree" class = "toclear"></td>
					<td id="fatfrithree" class = "toclear"></td>
					<td id="fatsatthree" class = "toclear"></td>
					<td id="fatsunthree" class = "toclear"></td>
				</tr>
				<tr>
					<td class= "type">Calories</td>
					<td id="calmonthree" class = "toclear"></td>
					<td id="caltuethree" class = "toclear"></td>
					<td id="calwedthree" class = "toclear"></td>
					<td id="calthuthree" class = "toclear"></td>
					<td id="calfrithree" class = "toclear"></td>
					<td id="calsatthree" class = "toclear"></td>
					<td id="calsunthree" class = "toclear"></td>
				</tr>
			</tbody>
		</table>
	</div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
