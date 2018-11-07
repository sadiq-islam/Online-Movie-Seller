<?php include 'Config.php';?>



<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>
</head>
<body>
	<?php include 'HomeNavBar.php';?>

	<script>
			function showhidepass() {
		    var x = document.getElementById("passinput");
		    if (x.type === "password") {
		        x.type = "text";
		    } else {
		        x.type = "password";
		    }
			}
	</script>






	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		

		<br/><br/><br/><br/><br/><br/><br/>


			<!--             Sign In Panel               -->	
			<table align="center" width="250"><tr><td>
			
		<fieldset>
			<legend align="center"><h3><u>LOG IN</u></h3></legend>
		<table align="center">
			<!--<tr align="center">
				<td><h4><u>LOG IN</u></h4></td>
			</tr>-->

			<tr>
				<td>
					Username<br/>
					<input type="text" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" required = "required" placeholder="Enter Your Username!" >
				</td>	
			</tr>
			
			<tr>
				<td>
					Password<br/>
					<input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" id="passinput" required = "required" placeholder="Enter Your Password!" >
				</td>

			</tr>

			<tr><td><br/></td></tr>

			<tr align="center">
				<td>
					<input type="radio" name="usertype" required="required" value="Admin" > Admin
					<input type="radio" name="usertype" value="User" > User
				</td>
			</tr>

			
			<tr><td><br/></td></tr>



			<tr align="center">
				<td>
					<input type="checkbox" onclick="showhidepass()">Show/Hide Password 
				</td>
			</tr>

			<tr align="center">
				<td>
					<input type="checkbox" name="rm">Remember Me
				</td>
			</tr>


			<tr align="center">
				<td>
					<br/>
					<input type="submit" name="login" value="LOG IN">
					<br/>
				</td>
			</tr>
		</table>
		
		<table align="center">

			<tr align="center">
				<td>
					<a href="ForgetPassword.php"> Forget Password! </a>
				</td>
			</tr>
			<tr align="center">
				<td>
					<a href="Registration.php"> Not registerd yet! </a>
				</td>
			</tr>

			<tr><td>  <br/>  </td></tr>


		</table>

		</fieldset>

		</td></tr></table>

	</form>

</body>
</html>



<?php              if(!isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']))  {                  } 

else
{ 
	if($_SESSION['usertype']=="Admin")
	{
		header("Location: AdminHome.php");
	}
	else
	{
		header("Location: UserHome.php");
	}

	
}



?>


	
<?php 

		

		if($_SERVER["REQUEST_METHOD"]=="POST"){

	

		if(isset($_POST['login']))
		{	
			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

			mysqli_select_db($con, "my_database") or die ("no database"); 


		if(!empty($_POST['rm']))
			{
				setcookie('username',$_POST['username'],time()+ 86400);
				setcookie('password',$_POST['password'],time()+ 86400);
			}

				$uname=$_POST['username'];
				$pass=$_POST['password'];
				$utype=$_POST['usertype'];

				$query = 'select password,usertype from person where U_ID="'.$uname.'" ';
				$req = mysqli_query($con,$query);

				$dn = mysqli_fetch_array($req);

		if($dn['usertype']==$utype and $dn['password']==$pass and mysqli_num_rows($req)>0)
		{	
			
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['usertype'] = $_POST['usertype'];
			header("Location: AdminHome.php");
	
		}
		else if ($dn['usertype']==$utype and $dn['password']==$pass and mysqli_num_rows($req)>0)
		{	
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['usertype'] = $_POST['usertype'];
			header("Location: UserHome.php");
		}

		else
		{

			echo "Error!!!Username or Password doesn't match!";	
		}




		/*if(!empty($_POST["rm"]))
		{
			setcookie( "Username" , $_POST['username'] , time()+86400 , "/" );
			setcookie( "Password" , $_POST['password'] , time()+86400 , "/" );
			//setcookie( "Usertype" , $_POST['usertype'] , time()+86400 , "/" );
		}*/


		} 
	}
		
?>


