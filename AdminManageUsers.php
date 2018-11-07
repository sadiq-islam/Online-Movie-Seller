<?php include 'Config.php';?>






<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype'] )&& $_SESSION['usertype']=='Admin' ) {                ?>










<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>

	<script>
		function getData(str)
		{
			if(str.length==0)
			{
				document.getElementById("sug").innerHTML="";
			}
			else
			{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange= function()
				{
					if (this.readyState==4 && this.status==200)
					{
						document.getElementById("sug").innerHTML= this.responseText;

					} 
				};

					xhttp.open("GET","userdata.php?q="+str,true);
					//for asynchronous request boolean value would be "true"
					xhttp.send();
				 
			}
		}
	</script>
</head>
<body>

<?php include 'AdminNavBar.php';?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<br/><br/><br/>

	<table align="center" border="0" >


		<tr>
			<td width="1000">
				<h2><u>Users</u></h2>
			</td>
			<td  align="center">
				<input type="text" name="searchbox" onkeyup="getData(this.value)" placeholder="Search By Username/Name"> 
				<input type="submit" name="search" value="Search"><br/>
				<label id="sug"></label>
			</td>
		</tr>

	</table>


	<table align="center" border="0">
		
		<?php

		if($_SERVER["REQUEST_METHOD"]=="POST"){

		if(isset($_POST['search']))
		{

			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql!"); 

		mysqli_select_db($con, "my_database") or die ("no database");



		$query = $_POST['searchbox']; 
         
        $query = htmlspecialchars($query); 
         
        $query = mysqli_real_escape_string($con,$query);
         
        $rawres = mysqli_query($con,"SELECT * FROM person
            WHERE ((`Name` LIKE '%".$query."%') OR (`U_ID` LIKE '%".$query."%')) AND `Usertype`='User'") or die(mysqli_error($con));
             
         
        if(mysqli_num_rows($rawres) > 0){
             
            while($dnn = mysqli_fetch_array($rawres)){  

            	?>

            	<tr align="center">
			<td width="300" height="400">
			<img src= "<?php echo $dnn['Picture']; ?>" width="225" height="225" onerror="if (this.src != 'icons/profilepicture.gif') this.src = 'icons/profilepicture.gif';">
			</td>
			<td width="500" height="400">
			<b>Name :</b> <?php echo " ".$dnn['Name']; ?><br/>
			<b>Username : </b><?php echo " ".$dnn['U_ID']; ?><br/>
			<b>Email: </b><?php echo " ".$dnn['Email']; ?><br/>
			<b>DOB : </b><?php echo " ".$dnn['DOB']; ?><br/>
			<b>Gender : </b><?php echo " ".$dnn['Gender']; ?><br/>
			<b>Contact No. : </b><?php echo " ".$dnn['ContactNo']; ?><br/>
			<b>Address : </b><?php echo " ".$dnn['Address']; ?><br/>
			<!--<b>Point : </b><?php// echo " ".$dnn['Point']; ?><br/>-->
			<a href="DeleteUser.php?uuid=<?php echo $dnn['U_ID']?>"><b><i> Delete User</i> </b></a>
			</td>
			
		</tr>
		<?php }

	} 
	 


		else{ mysqli_close($con);
            echo "No results";
        }
         
    }
    
	}



















		else{
		$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");

		$query = 'select * from person where Usertype="User" ';

		$req = mysqli_query($con,$query);


		while($dnn = mysqli_fetch_array($req))
		{


		?>		
		


		<tr align="center">
			<td width="300" height="400">
			<img src= "<?php echo $dnn['Picture']; ?>" width="225" height="225" onerror="if (this.src != 'icons/profilepicture.gif') this.src = 'icons/profilepicture.gif';">
			</td>
			<td width="500" height="400">
			<b>Name :</b> <?php echo " ".$dnn['Name']; ?><br/>
			<b>Username : </b><?php echo " ".$dnn['U_ID']; ?><br/>
			<b>Email: </b><?php echo " ".$dnn['Email']; ?><br/>
			<b>DOB : </b><?php echo " ".$dnn['DOB']; ?><br/>
			<b>Gender : </b><?php echo " ".$dnn['Gender']; ?><br/>
			<b>Contact No. : </b><?php echo " ".$dnn['ContactNo']; ?><br/>
			<b>Address : </b><?php echo " ".$dnn['Address']; ?><br/>
			<!--<b>Point : </b><?php //echo " ".$dnn['Point']; ?><br/>-->			
			<a href="DeleteUser.php?uuid=<?php echo $dnn['U_ID']?>"><b><i> Delete User</i> </b></a>
			</td>
			
		</tr>
		<?php } mysqli_close($con); } ?>


	</table>
</form>



</body>
</html>



<?php   } 

else
{
	header("Location: Sign In.php");
}



?>
