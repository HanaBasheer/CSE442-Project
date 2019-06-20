<?php 


include"database.php";


if(isset($_POST['teammates'])) {
    $teammates = $_POST['teammates'];
	echo $teammates;
}

if(isset($_POST['r1'])) {
    $r1 = $_POST['r1'];
	#echo $r1;
}

if(isset($_POST['r2'])) {
    $r2 = $_POST['r2'];
	#echo $r2;
}

if(isset($_POST['r3'])) {
    $r3 = $_POST['r3'];
	#echo $r3;
}

if(isset($_POST['r4'])) {
    $r4 = $_POST['r4'];
	#echo $r4;
}

if(isset($_POST['r5'])) {
    $r5 = $_POST['r5'];
	#echo $r5;
}
$email = "ztperini@buffalo.edu"; //testing sake, don't know how to pass this
	

$team = "b"; //just for testing,no method to get team name yet

$peers = getTeammates($email);

/*
foreach ($peers as $peer) {
    echo "$peer\n";
}
*/


if ($teammates == "t1"){
	$tm = $peers[0];
}
else {$tm = $peers[1];}

if (storeFormData($email, $tm, $team, $r1, $r2, $r3, $r4, $r5) == TRUE){ header("refresh:2; url = evalForm.html");}

else{
echo 'didnt work';}	





?>