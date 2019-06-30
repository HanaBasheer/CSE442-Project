<?php
include 'database.php';
$email = 'ztperini@buffalo.edu';
$class = getClasses($email);
echo "<script type='text/javascript'>alert('First class is $class[0]');</script>";
echo "<script type='text/javascript'>alert('Second class is $class[1]');</script>";
$var = $class[1];
#echo "<script type='text/javascript'>alert('The first class is $var');</script>";
$peers = getTeammates($email, $var);

#echo "<script type='text/javascript'>alert('teammate 1 is $peers[0]');</script>";
#echo "<script type='text/javascript'>alert('teammate 2 is $peers[1]');</script>";
#echo "<script type='text/javascript'>alert('teammate 3 is $peers[2]');</script>";


?>
<html>

<head>
  <link rel="stylesheet" href="styles/evalForm.css">

  <script type="text/javascript">
    function submitSuccessMsg() {
      alert("Your form has been submitted successfully.")
    }
  </script>

</head>
<body>
  

  <form action='storeEvalFormData.php' onsubmit="JavaScript:submitSuccessMsg()" method='post'> 
  <h2>Peer Evaluation Form</h2>

  <p>Select your teammate: <input type="radio" name="teammates" value="t1"> <?php echo getName($peers[0]); ?> <input type="radio" name="teammates" value="t2"> <?php echo getName($peers[1]); ?> <input type="radio" name="teammates" value="t3"> <?php echo getName($peers[2]); ?></p>
  
	

  <table>
    <thead class="header">

      <tr>
        <!-- Headers -->
        <td>CATEGORY</td>
        <td>Unsatisfactory</td>
        <td>Developing</td>
        <td>Satisfactory</td>
        <td>Exemplary</td>
      </tr>

    </thead>

    <tr id="row-1">
      <!-- 1st Row - Role -->
      <td>ROLE</td>
      <td>
        <p>Does not willingly assume <br> team roles;</p>
        <p>Rarely completes assigned work</p>
        <input type="radio" id="r1-zero" name="r1" value=0>
      </td>
      <td>
        <p>Usually accepts assigned <br> team roles;</p>
        <p>Occasionally completes assigned work</p>
        <input type="radio" id="r1-one" name="r1" value=1>
      </td>
      <td>
        <p>Accepts assigned team <br> roles;</p>
        <p>Mostly completes assigned work</p>
        <input type="radio" id="r1-two" name="r1" value=2>
      </td>
      <td>
        <p>Accepts all assigned team <br> roles;</p>
        <p>Always completes assigned work</p>
        <input type="radio" id="r1-three" name="r1" value=3>
      </td>
    </tr>

    <tr id="row-2">
      <!-- 2nd Row - Leadership -->
      <td>LEADERSHIP</td>
      <td>
        <p>Rarely takes leadership <br>role; </p>
        <p>Does not collaborate;</p>
        <p>Sometime willing to assist teammates</p>
        <input type="radio" id="r2-zero" name="r2" value=0>
      </td>
      <td>
        <p>Occasionally shows <br>leadership;</p>
        <p>Mostly collaborates;</p>
        <p>Generally willing to assist teammates</p>
        <input type="radio" id="r2-one" name="r2" value=1>
      </td>
      <td>
        <p>Shows an ability to lead <br>when necessary;</p>
        <p>Willing to collaborate;</p>
        <p>Willing to assist teammates</p>
        <input type="radio" id="r2-two" name="r2" value=2>
      </td>
      <td>
        <p>Takes leadership role;</p>
        <p>Is a good collaborator;</p>
        <p>Always willing to assist teammates</p>
        <input type="radio" id="r2-three" name="r2" value=3>
      </td>
    </tr>

    <tr id="row-3">
      <!-- 3rd Row - Participation -->
      <td>PARTICIPATION</td>
      <td>
        <p>Often misses meetings; </p>
        <p>Routinely unprepared for meetings;</p>
        <p>Rarely participates in meetings <br>and does not share ideas</p>
        <input type="radio" id="r3-zero" name="r3" value=0>
      </td>
      <td>
        <p>Occasionally shows <br>leadership;</p>
        <p>Mostly collaborates;</p>
        <p>Generally willing to assist teammates</p>
        <input type="radio" id="r3-one" name="r3" value=1>
      </td>
      <td>
        <p>Shows an ability to lead <br>when necessary;</p>
        <p>Willing to collaborate;</p>
        <p>Willing to assist teammates</p>
        <input type="radio" id="r3-two" name="r3" value=2>
      </td>
      <td>
        <p>Takes leadership role;</p>
        <p>Is a good collaborator;</p>
        <p>Always willing to assist teammates</p>
        <input type="radio" id="r3-three" name="r3" value=3>
      </td>
    </tr>

    <tr>
      <!-- 4th Row - Professionalism -->
      <td>PROFESSIONALISM</td>
      <td>
        <p>Often discourteous and/or openly critical of teammates; </p>
        <p>Does not want to listen to any alternate perspectives</p>
        <input type="radio" id="r4-zero" name="r4" value=0>
      </td>
      <td>
        <p>Not always considerate or courteous towards teammates;</p>
        <p>Usually appreciates teammates' perspectives, but often unwilling to consider them</p>
        <input type="radio" id="r4-one" name="r4" value=1>
      </td>
      <td>
        <p>Mostly courteous to teammates;</p>
        <p>Values teammates' perspectives and often willing to consider them</p>
        <input type="radio" id="r4-two" name="r4" value=2>
      </td>
      <td>
        <p>Always courteous to teammates;</p>
        <p>Values teammates' perspectives, knowledge, and experiences, and always willing to consider them</p>
        <input type="radio" id="r4-three" name="r4" value=3>
      </td>
    </tr>

    <tr>
      <!-- 5th row - Quality -->
      <td>QUALITY</td>
      <td>
        <p>Rarely commits to shared documents; </p>
        <p>Others often required to revise, debug, or fix their work</p>
        <input type="radio" id="r5-zero" name="r5" value=0>
      </td>
      <td>
        <p>Occasionally commits to shared documents;</p>
        <p>Others sometimes needed to revise, debug, or fix their work</p>
        <input type="radio" id="r5-one" name="r5" value=1>
      </td>
      <td>
        <p>Often commits to shared documents;</p>
        <p>Others occasionally needed to revise, debug, or fix their work</p>
        <input type="radio" id="r5-two" name="r5" value=2>
      </td>
      <td>
        <p>Frequently commits to shared documents;</p>
        <p>Others rarely needed to revise, debug, or fix their work</p>
        <input type="radio" id="r5-three" name="r5" value=3>
      </td>
    </tr>

  </table>
  <br>
    <input type='submit' name='submit' value='Submit' />
	</form>
	
	
  

</body>

</html>
