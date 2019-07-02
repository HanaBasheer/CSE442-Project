<?php
include "database.php";

//storeCode and checkCode tests

/*
$testemail = "orionpal@buffalo.edu";
$testpeer = "fake@buffalo.edu";
$notPeer = "snfsdlkfd";
$testcode = 1234;
$falsecode = 4321;
$testclass = "cse442";
$testteam = "c";

storeCode($testcode, $testemail);
$return = checkCode($testcode);
$badreturn = checkCode($falsecode);
if ($return){
	echo $return;
	echo "this correctly goes into an if statement for email return";
}else{
	echo "this incorrectly goes into an if statement for email return";
}
if (!$return){
	echo "this incorrectly goes into an if statement for email return";
}else{
	echo $return;
	echo "this correctly goes into an if statement for email return";
}
if ($badreturn){
	echo "this incorrectly goes into an if statement for false return";
}else{
	echo "this correctly goes into an if statement for false return";
}
if (!$badreturn){
	echo "this correctly goes into an if statement for false return";
}else{
	echo "this incorrectly goes into an if statement for false return";
}
*/
$cseemail1 = "orionpal@buffalo.edu";
$cseemail2 = "fake@buffalo.edu";
$cseemail3 = "ztperini@buffalo.edu";
$sedemail1 = "ManOMystery@buffalo.edu";
$sedemail4 = "Two@buffalo.edu";
$sedemail2 = "DrEvil@buffalo.edu";
$sedemail3 = "fatB@buffalo.edu";

$tclass1 = "cse442";
$tclass2 = "SED431";

$tTeam1 = "c";
$tTeam2 = "b";
$tTeam3 = "Alpha";
$tTeam4 = "Evil";

$trole = 3;
$tlead = 3;
$tpar = 3;
$tprof = 3;
$tqual = 3;

$num1 = 3;
$num2 = 6;



//getTeammates test
$orionMates = getTeammates($cseemail1, $tclass1);
$evilMates = getTeammates($sedemail2, $tclass2);
//storeForm tests (and storeNormForm tests)
//give each of orions teammates full scores using list from getTeammates
foreach ($orionMates as $mate){
	storeFormData($cseemail1, $mate, $tclass1, $tTeam1, $trole, $tlead, $tpar, $tprof, $tqual);
}
$trole = 2;
$tlead = 0;
$tpar = 0;
$tprof = 0;
$tqual = 0;
//give each of Dr Evil's teammates 0 score in everything except role (2)
foreach ($evilMates as $mate){
	storeFormData($sedemail2, $mate, $tclass2, $tTeam4, $trole, $tlead, $tpar, $tprof, $tqual);
}

$trole = 3;
$tlead = 3;
$tpar = 3;
$tprof = 3;
$tqual = 3;
//update Dr Evil's self evaluation to be full marks in everything
storeFormData($sedemail2, $sedemail4, $tclass2, $tTeam4, $trole, $tlead, $tpar, $tprof, $tqual);


//go to database and check Table "Forms" that these are the values
/* I'm shorting the owner and peer to first part of email
Owner | Peer | Class | Team | Role | Lead | Part | Prof | Qual
orion   orion  cse442   c       3      3     3      3      3	
orion   fake   cse442   c       3      3     3      3      3
drevil drevil  SED431  evil     3      3     3      3      3
drevil  two    SED431  evil     2      0     0      0      0
drevil  fatB   SED431  evil     2      0     0      0      0

*/
//go to database and check Table "NormForms" that these are the values
/* I'm shorting the owner and peer to first part of email
total orion: 30
total evil: 19 (I rounded 3/19 to 0.16 and 2/19 to 0.11)
Owner | Peer | Class | Team | Role | Lead | Part | Prof | Qual
orion   orion  cse442   c      0.1    0.1    0.1    0.1    0.1	
orion   fake   cse442   c      0.1    0.1    0.1    0.1    0.1
drevil drevil  SED431  evil   0.16   0.16   0.16   0.16   0.16
drevil  two    SED431  evil   0.11      0     0      0      0
drevil  fatB   SED431  evil   0.11      0     0      0      0

*/

//update Dr Evil's self evaluation for number 2 because he did great work
#storeFormData($sedemail2, $sedemail1, $tclass2, $tTeam4, $trole, $tlead, $tpar, $tprof, $tqual);

/*
storeFormData($testemail, $testpeer, $testteam, $trole, $tlead, $tpar, $tprof, $tqual);
$trole = 3;
$tlead = 2;
$tpar = 4;
$tprof = 2;
$tqual = 1;
storeFormData($testemail, $testpeer, $testteam, $trole, $tlead, $tpar, $tprof, $tqual);
*/

//getFormData tests
/*
$fdata = getFormData($testemail, $testclass, $testpeer, $testteam);
foreach ($fdata as $val){
	echo "$val <br>";
}
$notPeer = "nobody";
if ($badData = getFormData($testemail, $testclass, $notPeer, $testteam)){
	echo "Why did this print?";
}

if ($goodData = getFormData($testemail, $testclass, $testpeer, $testteam)){
	echo "This is what I want";
}
*/
?>