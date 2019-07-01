<?php
session_start();
$code = $_SESSION['confCode'];
include 'database.php';
#$email = 'ztperini@buffalo.edu';
#echo "<script type='text/javascript'>alert('Confirmation code is : $code');</script>";
$email = checkCode($code);
if ($email == FALSE){
	header("refresh:0; url=invalidCode.html");
}
#echo "<script type='text/javascript'>alert('User email address is: $email');</script>";
$class = getClasses($email);
$countVar = count($class);
#echo "<script type='text/javascript'>alert('Number of classes is $countVar');</script>";

$_SESSION['emailAddress'] = $email;

?>
<html>

<head>
  <link rel="stylesheet" href="styles/evalForm.css">
  
  
  <script type="text/javascript">
    function submitSuccessMsg() {
      alert("Your form has been submitted successfully.")
    }
	function fillFormData(arr){
		//alert('in fill form data function!');
		//alert('teammate selected is ' + element.value);
		//alert(arr.join("\n")); //arr works
		//console.log(arr.join("\n"));
		var element = document.getElementById('teammates');
		var role = arr[0];
		var leadership = arr[1];
		var participation = arr[2];
		var professionalism = arr[3];
		var quality = arr[4];
				
		switch(+role) {
			case 0:
				document.getElementById("r1-zero").checked = true;
				break;
			case 1:
				document.getElementById("r1-one").checked = true;
				break;
			case 2:
				document.getElementById("r1-two").checked = true;
				break;
			case 3:
				document.getElementById("r1-three").checked = true;
				break;				
		}
		
		switch(+leadership) {
			case 0:
				document.getElementById("r2-zero").checked = true;
				break;
			case 1:
				document.getElementById("r2-one").checked = true;
				break;
			case 2:
				document.getElementById("r2-two").checked = true;
				break;
			case 3:
				document.getElementById("r2-three").checked = true;
				break;				
		}
		
		switch(+participation) {
			case 0:
				document.getElementById("r3-zero").checked = true;
				break;
			case 1:
				document.getElementById("r3-one").checked = true;
				break;
			case 2:
				document.getElementById("r3-two").checked = true;
				break;
			case 3:
				document.getElementById("r3-three").checked = true;
				break;				
		}
		
		switch(+professionalism) {
			case 0:
				document.getElementById("r4-zero").checked = true;
				break;
			case 1:
				document.getElementById("r4-one").checked = true;
				break;
			case 2:
				document.getElementById("r4-two").checked = true;
				break;
			case 3:
				document.getElementById("r4-three").checked = true;
				break;				
		}
		
		switch(+quality) {
			case 0:
				document.getElementById("r5-zero").checked = true;
				break;
			case 1:
				document.getElementById("r5-one").checked = true;
				break;
			case 2:
				document.getElementById("r5-two").checked = true;
				break;
			case 3:
				document.getElementById("r5-three").checked = true;
				break;				
		}

		
		
	}
	
  </script>
  

</head>
<body>
  <h2>Peer Evaluation Form</h2>
  
  <select id = 'classChoice' name="classChoice" onchange="window.location='evalForm.php?id='+this.value+'&pos='+this.selectedIndex;" required>
        <option selected="selected">Choose Class</option>
        <?php
        
        // Iterating through the array of classes 
        foreach($class as $item){
        ?>
        <option value="<?php echo $item; ?>"><?php echo strtoupper($item); ?></option>
        <?php
        }
        ?>
    </select>
	
	<?php
    if(isset($_GET['id']))
    {
        $CC=$_GET['id'];
        echo "<script type='text/javascript'>alert('class choice is $CC');</script>";
		$_SESSION['classChoice'] = $CC;
    ?>
    <script>
        var myselect = document.getElementById("classChoice");
        myselect.options.selectedIndex = <?php echo $_GET["pos"]; ?>
		
		<?php $peers = getTeammates($email, $CC); ?>
		
    </script>
    <?php
    }
    ?>
	<?php
	    $teamName = getTeamName($email, $CC);
		#echo "<script type='text/javascript'>alert('team name is $teamName');</script>";
		$countPeers = count($peers);
		#echo "<script type='text/javascript'>alert(' Number in group is $countPeers');</script>";
		#echo "<script type='text/javascript'>alert(' First peer is $peers[0]');</script>";
		#echo "<script type='text/javascript'>alert(' Second peer is $peers[1]');</script>";
		#echo "<script type='text/javascript'>alert(' Third peer is $peers[2]');</script>";
		
		for($i=0; $i<$countPeers; $i++) {
			${"formData" . $i} = getFormData($email, $CC, $peers[$i], $teamName);
			#echo "<script type='text/javascript'>alert('form $i retrieved');</script>";	
		}
		
		#echo "<script type='text/javascript'> alert('".json_encode($formData0)."') </script>";
		#echo "<script type='text/javascript'> alert('".json_encode($formData1)."') </script>";
		#echo "<script type='text/javascript'> alert('".json_encode($formData2)."') </script>";
		?>
		<script> 
		var peerNum = <?php echo $countPeers; ?>;
		//alert(peerNum);
		var i = 0;
		var ArryFormGet = [];
		ArryFormGet = Array(5).fill("");
		while(i < peerNum){
			if (i ==0){
				ArryFormGet[0] = <?php echo '["' . implode('", "', $formData0) . '"]' ?>;
			}
			else if (i ==1){
				ArryFormGet[1] = <?php echo '["' . implode('", "', $formData1) . '"]' ?>;
			}
			else if (i ==2){
				ArryFormGet[2] = <?php echo '["' . implode('", "', $formData2) . '"]' ?>;
			}
			else if (i ==3){
				ArryFormGet[3] = <?php echo '["' . implode('", "', $formData3) . '"]' ?>;
			}
			else if (i ==4){
				ArryFormGet[4] = <?php echo '["' . implode('", "', $formData3) . '"]' ?>;
			}
			i++
		}
			/*
		var arr0 = <?php echo '["' . implode('", "', $formData0) . '"]' ?>;
		var arr1 = <?php echo '["' . implode('", "', $formData1) . '"]' ?>;
		var arr2 = <?php echo '["' . implode('", "', $formData2) . '"]' ?>;
		*/
		</script>

		<?php
		//or however many are created.
		/*
		echo "<script type='text/javascript'>alert('First peer is $peers[0]');</script>";
		$formData = getFormData($email,$CC, $peers[0], $teamName) ;
		echo "<script type='text/javascript'>alert('role value is $formData[0]');</script>";
		echo "<script type='text/javascript'>alert('leadership value is $formData[1]');</script>";
		echo "<script type='text/javascript'>alert('participation value is $formData[2]');</script>";
		echo "<script type='text/javascript'>alert('professionalism value is $formData[3]');</script>";
		echo "<script type='text/javascript'>alert('quality value is $formData[4]');</script>";
		*/
		
		?>
	
  <form action='storeEvalFormData.php' onsubmit="JavaScript:submitSuccessMsg()" method='post'> 
  

  <p>Select your teammate: 
  <input type="radio" name="teammates" id = "teammates" value="t1" onclick="Javascript:fillFormData(ArryFormGet[0])" required> <?php echo getName($peers[0]); ?> 
  
  <input type="radio" name="teammates" id = "teammates" value="t2" onclick ="Javascript:fillFormData(ArryFormGet[1])" > <?php echo getName($peers[1]); ?> 
  
  <input type="radio" name="teammates" id = "teammates" value="t3" onclick ="Javascript:fillFormData(ArryFormGet[2])" > <?php echo getName($peers[2]); ?></p>
  
	

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
        <input type="radio" id="r1-zero" name="r1" value=0 required >
      </td>
      <td>
        <p>Usually accepts assigned <br> team roles;</p>
        <p>Occasionally completes assigned work</p>
        <input type="radio" id="r1-one" name="r1" value=1 required>
      </td>
      <td>
        <p>Accepts assigned team <br> roles;</p>
        <p>Mostly completes assigned work</p>
        <input type="radio" id="r1-two" name="r1" value=2 required>
      </td>
      <td>
        <p>Accepts all assigned team <br> roles;</p>
        <p>Always completes assigned work</p>
        <input type="radio" id="r1-three" name="r1" value=3 required>
      </td>
    </tr>

    <tr id="row-2">
      <!-- 2nd Row - Leadership -->
      <td>LEADERSHIP</td>
      <td>
        <p>Rarely takes leadership <br>role; </p>
        <p>Does not collaborate;</p>
        <p>Sometime willing to assist teammates</p>
        <input type="radio" id="r2-zero" name="r2" value=0 required>
      </td>
      <td>
        <p>Occasionally shows <br>leadership;</p>
        <p>Mostly collaborates;</p>
        <p>Generally willing to assist teammates</p>
        <input type="radio" id="r2-one" name="r2" value=1 required>
      </td>
      <td>
        <p>Shows an ability to lead <br>when necessary;</p>
        <p>Willing to collaborate;</p>
        <p>Willing to assist teammates</p>
        <input type="radio" id="r2-two" name="r2" value=2 required>
      </td>
      <td>
        <p>Takes leadership role;</p>
        <p>Is a good collaborator;</p>
        <p>Always willing to assist teammates</p>
        <input type="radio" id="r2-three" name="r2" value=3 required>
      </td>
    </tr>

    <tr id="row-3">
      <!-- 3rd Row - Participation -->
      <td>PARTICIPATION</td>
      <td>
        <p>Often misses meetings; </p>
        <p>Routinely unprepared for meetings;</p>
        <p>Rarely participates in meetings <br>and does not share ideas</p>
        <input type="radio" id="r3-zero" name="r3" value=0 required>
      </td>
      <td>
        <p>Occasionally shows <br>leadership;</p>
        <p>Mostly collaborates;</p>
        <p>Generally willing to assist teammates</p>
        <input type="radio" id="r3-one" name="r3" value=1 required>
      </td>
      <td>
        <p>Shows an ability to lead <br>when necessary;</p>
        <p>Willing to collaborate;</p>
        <p>Willing to assist teammates</p>
        <input type="radio" id="r3-two" name="r3" value=2 required>
      </td>
      <td>
        <p>Takes leadership role;</p>
        <p>Is a good collaborator;</p>
        <p>Always willing to assist teammates</p>
        <input type="radio" id="r3-three" name="r3" value=3 required>
      </td>
    </tr>

    <tr>
      <!-- 4th Row - Professionalism -->
      <td>PROFESSIONALISM</td>
      <td>
        <p>Often discourteous and/or openly critical of teammates; </p>
        <p>Does not want to listen to any alternate perspectives</p>
        <input type="radio" id="r4-zero" name="r4" value=0 required>
      </td>
      <td>
        <p>Not always considerate or courteous towards teammates;</p>
        <p>Usually appreciates teammates' perspectives, but often unwilling to consider them</p>
        <input type="radio" id="r4-one" name="r4" value=1 required>
      </td>
      <td>
        <p>Mostly courteous to teammates;</p>
        <p>Values teammates' perspectives and often willing to consider them</p>
        <input type="radio" id="r4-two" name="r4" value=2 required>
      </td>
      <td>
        <p>Always courteous to teammates;</p>
        <p>Values teammates' perspectives, knowledge, and experiences, and always willing to consider them</p>
        <input type="radio" id="r4-three" name="r4" value=3 required>
      </td>
    </tr>

    <tr>
      <!-- 5th row - Quality -->
      <td>QUALITY</td>
      <td>
        <p>Rarely commits to shared documents; </p>
        <p>Others often required to revise, debug, or fix their work</p>
        <input type="radio" id="r5-zero" name="r5" value=0 required>
      </td>
      <td>
        <p>Occasionally commits to shared documents;</p>
        <p>Others sometimes needed to revise, debug, or fix their work</p>
        <input type="radio" id="r5-one" name="r5" value=1 required>
      </td>
      <td>
        <p>Often commits to shared documents;</p>
        <p>Others occasionally needed to revise, debug, or fix their work</p>
        <input type="radio" id="r5-two" name="r5" value=2 required>
      </td>
      <td>
        <p>Frequently commits to shared documents;</p>
        <p>Others rarely needed to revise, debug, or fix their work</p>
        <input type="radio" id="r5-three" name="r5" value=3 required>
      </td>
    </tr>

  </table>
  <br>
    <input type='submit' name='submit' value='Submit' />
	</form>
	
	
  

</body>

</html>
