<?php include 'Config.php';?>

<?php include 'AdminNavBar.php'; ?>


<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='Admin' ){       } 

else
{
	header("Location: Sign In.php");
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>

		<script type="text/javascript">
						function deletealert()
						  {
						  	alert("Admin Deleted!");
						  }
	</script>


</head>
<body>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">


		<br/>

<!--             Delete Movies             -->



					<table align="center" >
			<tr>
				<td width="400">
					<fieldset>
						<legend align="center"><h3><u>DELETE ADMIN</u></h3></legend>



<table align="center" border="0"><tr><td>


						



							<table >
								<tr>
									<td width="150"><label> Username : </label></td>
									<td>

										<select name="uid" required="required" onchange="getData(this.value)">
										

									<?php
									$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

											mysqli_select_db($con, "my_database") or die ("no database"); 
											$req = mysqli_query($con,'select * from person WHERE U_ID="'.$_GET['uuid'].'" ');


											while($dnn = mysqli_fetch_array($req))
											{?>
								
					
										<option value="<?php echo $dnn['U_ID']?>"> <?php echo $dnn['U_ID']?> </option>
										

	<br/>

								</td>
								</tr>






								<tr>
								<td>
									<label>Name :</label>
								</td>
								<td>
									<label id="name"><?php echo $dnn['Name']?></label>
								</td>
								</tr>




								<tr>
								<td>
									<label>Email :</label>
								</td>
								<td>
									<label id="email"><?php echo $dnn['Email']?></label>
								</td>
								</tr>





								<tr>
								<td>
									<label>DOB :</label>
								</td>
								<td>
									<label id="dob"><?php echo $dnn['DOB']?></label>
								</td>
								</tr>





								<tr>
								<td>
									<label>Gender :</label>
								</td>
								<td>
									<label id="gender"><?php echo $dnn['Gender']?></label>
								</td>
								</tr>





								<tr>
								<td>
									<label>Contact No. :</label>
								</td>
								<td>
									<label id="conno"><?php echo $dnn['ContactNo']?></label>
								</td>
								</tr>





								<tr>
								<td>
									<label>Address :</label>
								</td>
								<td>
									<label id="address"><?php echo $dnn['Address']?></label>
								</td>
								</tr>




<?php  } 
									mysqli_close($con);?>


								<tr><td></td></tr>
								<tr><td></td></tr>

								<tr align="center"><td colspan="2">
									
										<input type="submit" name="deleteadmin" onclick="deletealert()" value="Delete Admin"/>

								</td></tr>
							</table>
							<hr/>


</td>
</tr>


</tr></table>							
					</fieldset>
				</td>
			</tr>
		
		</table>
				
		


	</form>



</body>
</html>







<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{	

		if(isset($_POST["deleteadmin"]))
		{
			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

			mysqli_select_db($con, "my_database") or die ("no database"); 

				$mid=$_POST['uid'];
				$q1='select * from person where u_id="'.$mid.'"';
				$rq1=mysqli_query($con,$q1);
				$dn11=mysqli_fetch_array($rq1);
				
				if (mysqli_num_rows($rq1)==1)
				{
					$q = 'delete from person where u_id="'.$mid.'"';
					$rq = mysqli_query($con,$q);


		    	$file = $dn11['Picture'];
					if (!unlink($file))
					  {
					  echo ("Error deleting $file!");
					  }
					else
					  {
					  echo ("Deleted $file!");
					  }


					echo "Admin Deleted!<br/>";
					header("Location:DeleteAdmin.php");
				}
				else
				{
					echo "No Such User ID!<br/>";
				}

			
				mysqli_close($con);
		}
	}

?>




