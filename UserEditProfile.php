<?php include 'Config.php';?>


<?php include 'UserNavBar.php';?>


<?php              
if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']))  
	{}   
		
else
{ 
	header("Location: Sign In.php");
	
}
?>



<?php 
	
	$sts=0;
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

		if(isset($_POST["updateinfo"]))

		{

		 if(!preg_match("/^[a-zA-Z\\-\\.\\s]*$/",test_input($_POST["name"])))
		{
			echo "Only letters and white space allowed in Name field!<br/>";
			$sts=1;
		}

		 if (str_word_count( test_input($_POST["name"]) )<2 )
		{
 			echo "Name should contain at least two words!<br/>";
			$sts=1;
  		}

  		 if(!filter_var( test_input($_POST["email"]) ,  FILTER_VALIDATE_EMAIL ))
		{
			echo "Email format is not valid!<br/>";
			$sts=1;
		} 

		 if (strlen(test_input($_POST["password"])) <8 ) 
  		{ 
  			echo "Password must not be less than eight (8) characters.<br/>";
			$sts=1;
  		}

  		if(!preg_match("/^(?=.*[$@$!%*?&]){8,}/",test_input($_POST["password"]))) 
  		{ 
  			echo "Password must contain at least one of the special characters (@, #, $, %)<br/>";
			$sts=1;
  		}


  		 if( test_input($_POST["password"]) != test_input($_POST["confirmpass"]) )
  		{
  			echo "New Password must match with the Retyped Password!<br/>";
			$sts=1;
  		}


  		$target_dir = "userprofilepicturesuploads/";
		$target_file = $target_dir . rand()  . basename($_FILES["profileimagefile"]["name"]) ;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.<br/>";
		    $sts=1;
		}
		// Check file size
		if ($_FILES["profileimagefile"]["size"] >= 4000000) {
		    echo "Sorry,  Picture size should not be more than 4MB!<br/>";
		    $sts=1;
		}






		if ($sts==0) {


			$name=$_POST['name'];
			$email=$_POST['email'];
			//$username=$_POST['username'];
			$password=$_POST['password'];
			$dob=$_POST['dob'];
			$conno=$_POST['conno'];
			$add=$_POST['add'];
			$gender=$_POST['gender'];
			$usertype='Admin';
			$point=50;
			$picture=$target_file;



			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

			mysqli_select_db($con, "my_database") or die ("no database"); 
			
				

				$q1 = 'select * from person where U_ID="'.$_SESSION['username'].'"';
				$rq1 = mysqli_query($con,$q1);
				$dn1=mysqli_fetch_array($rq1);

			
				

						if(empty($_FILES["profileimagefile"]["tmp_name"]))
						{
							$query = 'UPDATE `person` SET `U_ID`="'.$dn1['U_ID'].'",`Name`="'.$name.'",`Email`="'.$email.'",`DOB`="'.$dob.'",`Gender`="'.$gender.'",`ContactNo`="'.$conno.'",`Address`="'.$add.'",`Picture`="'.$dn1['Picture'].'", `Point`="'.$dn1['Point'].'",`Password`="'.$password.'",`Usertype`="'.$dn1['Usertype'].'" WHERE  U_ID="'.$dn1['U_ID'].'"' ;
					$req = mysqli_query($con,$query);

						}
						else if (move_uploaded_file($_FILES["profileimagefile"]["tmp_name"], $target_file)) {

							$query = 'UPDATE `person` SET `U_ID`="'.$dn1['U_ID'].'",`Name`="'.$name.'",`Email`="'.$email.'",`DOB`="'.$dob.'",`Gender`="'.$gender.'",`ContactNo`="'.$conno.'",`Address`="'.$add.'",`Picture`="'.$picture.'" ,`Point`="'.$dn1['Point'].'",`Password`="'.$password.'",`Usertype`="'.$dn1['Usertype'].'" WHERE  U_ID="'.$dn1['U_ID'].'"' ;
					$req = mysqli_query($con,$query);

		    	$file = $dn1['Picture'];
					if (!unlink($file))
					  {
					  echo ("Error deleting $file!");
					  }
					else
					  {
					  echo ("Deleted $file!");
					  }


		        			echo "The file ". basename( $_FILES["profileimagefile"]["name"]). " has been uploaded.<br/>";
		    			} else 
		    			{
		        			echo "Sorry, there was an error uploading your file!<br/>";
		        		}
						echo "Information Updated!<br/>";
						header("Location: UserProfile.php");
					
					
				}


				else
				{
					echo "Failed!";
				}





	}}
		
		/*// Check if $uploadOk is set to 0 by an error
		if ($sts == 1) {
		    echo "Sorry, your file was not uploaded!<br/>";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["profileimagefile"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["profileimagefile"]["name"]). " has been uploaded.<br/>";
		    
		    } else {
		        echo "Sorry, there was an error uploading your file!<br/>";
		        
		    }
		}*/


  		



		
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		  }

		  
	?>


	






<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>
</head>
<body>

	<script>
						  var loadFile = function(event) {
						    var output = document.getElementById('profileimage');
						    output.src = URL.createObjectURL(event.target.files[0]);
						  };
	</script>

	<script>
			function showhidepass() {
		    var x = document.getElementById("passinput");
		    var y = document.getElementById("conpassinput");
		    if (x.type === "password" && y.type === "password") {
		        x.type = "text";
		        y.type = "text";
		    } else {
		        x.type = "password";
		        y.type = "password";
		    }
			}
	</script>



	


	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  enctype="multipart/form-data" >


		<br/>
		<!--                    REGISTRATION                        -->

		<table align="center" >
			<tr>
				<td width="950">
					<fieldset>
						<legend align="center"><h3><u>Edit Profile</u></h3></legend>





<table align="center" border="0"><tr><td>


	<?php	$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");

		$query = 'select * from person where U_ID="'.$_SESSION['username'].'" ';

		$req = mysqli_query($con,$query);


		$dnn = mysqli_fetch_array($req);
    ?>

							<table >
								<tr>
									<td width="150"><label>Name : </label></td>
									<td><input type="text" name="name" value="<?php echo $dnn['Name']?>" placeholder="Mandatory Field!" required="nreq" /><br/></td>
									
								</tr>
							</table>
							<hr/>
							
							<table >
								<tr>
									<td width="150"><label>Email : </label>
									</td>
									<td>
									<input type="text" name="email" value="<?php echo $dnn['Email']?>"   placeholder="Mandatory Field!" required="ereq" /><br/>
									</td>
								</tr>
							</table>
<!--
							<hr/>
							<table >
								<tr>
									<td width="150"><label>Username : </label>
									</td>
									<td>
									<input type="text" name="username" value="<?php //echo $dnn['U_ID']?>"  required="unreq"  placeholder="Mandatory Field!"/><br/>
									</td>
								</tr>
							</table>

						-->
							<hr/>
							<table >
								<tr>
									<td width="150"><label>Password : </label>
									</td>
									<td >
									<input type="password" name="password"  value="<?php echo $dnn['Password']?>"  id="passinput" placeholder="Mandatory Field!" required="preq" />
									</td>
									<td>
									<input type="checkbox" onclick="showhidepass()">Show/Hide Password 
									</td>
								</tr>
							</table>
							<hr/>


							<table >
								<tr>
									<td width="150"><label>Confirm Password : </label>
									</td>
									<td>
									<input type="password" name="confirmpass"  value="<?php echo $dnn['Password']?>"   id="conpassinput" placeholder="Mandatory Field!" required="conpreq" /><br/>
									</td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="155"><label>Date Of Birth : </label>
									</td>
									<td>
									<input type="date" name="dob"   value="<?php echo $dnn['DOB']?>"  placeholder="Mandatory Field!" required="dobreq" >
									</td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label>Contact No: </label>
									</td>
									<td>
									<input type="number" name="conno"  value="<?php echo $dnn['ContactNo']?>"   placeholder="Mandatory Field!" required="connoreq" >
									</td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label> Address : </label>
									</td>
									<td>
									<input type="text" name="add"   value="<?php echo $dnn['Address']?>"   placeholder="Mandatory Field!" required="paddreq" >
									</td>
								</tr>
							</table>
							<hr/>

	
							<table >
								<tr>
									<td width="135"><label>Gender : </label>
									</td>
									<td>
									<input type="radio" name="gender" value="Male" required="required">Male
									<input type="radio" name="gender" value="Female">Female
									<input type="radio" name="gender" value="Others">Others
									</td>
								</tr>
							</table>
							<hr/>
<!--
							<table >
								<tr>
									<td width="135"><label>User Type : </label>
									</td>
									<td>
									<input type="radio" name="usertype" value="Admin" required="required" ">Admin
									<input type="radio" name="usertype" value="User">User
									</td> 
								</tr>
							</table>
							
					
							<hr/>	-->

							<table >
								<tr>
									<td colspan= "2"> <input type="checkbox"  required="required"/> I agree to all the terms and conditions and hereby declare that the above information is true.
									</td>
								</tr>
							</table>
							<hr/>

							
							<br/><br/>
							
								<input type="submit" name="updateinfo" value="Update Information"/>
								<input type="reset" name="reset" value="Reset"/>
							
							<br/><br/>
				
</td>

<td align="center" >
	<table align="center" border="1">
					<tr align="center"><td>Profile Picture</td></tr>
					<tr align="center">
						<td height="275">
						<img src="<?php echo $dnn['Picture']?>" name="profileimage" id="profileimage" width="200" height="200"   onerror="if (this.src != 'icons/profilepicture.gif') this.src = 'icons/profilepicture.gif';"/> <br/>
						
						</td>
					</tr>
					<tr align="center">
						<td>
						<input type="file" name="profileimagefile" id="profileimagefile" accept="image/*" onchange="loadFile(event)">
						
						
						</td>
					</tr>
				
	</table>


</td>


</tr></table>							
					</fieldset>
				</td>
			</tr>
		
		</table>



	</form>
</body>
</html>










