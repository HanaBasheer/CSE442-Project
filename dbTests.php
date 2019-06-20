<?php
include "database.php";
/*
//storeCode and checkCode tests

$testemail = "orionpal@buffalo.edu";
$testcode = 1234;
$falsecode = 4321;
storeCode($testcode, $testemail);
checkCode($testcode);
checkCode($falsecode);

//storeForm and getForm tests

$testemail = "orionpal@buffalo.edu";
$testpeer = "hanab@buffalo.edu";
$testteam = "c";
$trole = 3;
$tlead = 3;
$tpar = 3;
$tprof = 3;
$tqual = 3;
storeFormData($testemail, $testpeer, $testteam, $trole, $tlead, $tpar, $tprof, $tqual);
$trole = 3;
$tlead = 2;
$tpar = 4;
$tprof = 2;
$tqual = 1;
storeFormData($testemail, $testpeer, $testteam, $trole, $tlead, $tpar, $tprof, $tqual);

$fdata = getFormData($testemail, $testpeer, $testteam);
foreach ($fdata as $val){
	echo "$val <br>";
}*/

//getTeammates tests
$temail = "orionpal@buffalo.edu";
$MYMATES = getTeammates($temail);
foreach ($MYMATES as $mate){
	echo "$mate";
	$name = getName($mate);
	echo "$name";
}

?>