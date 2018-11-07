<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>

	<style type="text/css">
	 .links:link,  .links:visited {
    background-color: #ac8f39;
    color: white;
    padding: 4px 20px;
    font-family: sans-serif;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    
    display: inline-block;
}


 .links:hover, .links:active {
    background-color: #736026;
}


#logout{
	color: white; background-color: #ff3300; font-size: 15px; padding: 4px 15px;
}

#logout:hover{
	color: white; background-color: #330a00; font-size: 15px; padding: 4px 15px;
}


	</style>

	<script type="text/javascript">
		
						function logoutalert()
						  {
						  	alert("You have logged out!");
						  }
	</script>
</head>
<body>


	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<!--    NEVIGATION BAR     -->
		<table align="center" border="0">

			<tr align= "center"><td>
				<a href="AdminHome.php"> <img src="icons/movies.com.png" height="120" width="325"></a>
			</td></tr>

			<tr></tr><tr></tr>

			<tr align="center">
				<td colspan="2">
					<table>
						<tr align="center">

							<td width="200">
								<a href="AdminHome.php" class="links"> All Movies </a>
							</td>

							<td width="200">
								  <a href="AdminProfile.php" class="links"> My Profile </a> 
							</td>

							<td width="200">
								  <a href="AdminManageMovies.php" class="links"> Manage Movies </a>  
							</td>

							<td width="200">
								<a href="AdminManageUsers.php" class="links">Manage Users</a>
							</td>

							<td width="200">
								<a href="AdminRecruit.php" class="links">Manage Admins</a>
							</td>

							<td width="200">
								<a href="AdminAllPurchaseDetails.php" class="links">All Purchase Details </a>
							</td>

							
						</tr>

						<tr><td><br/></td></tr>

						<tr align="center">
							<td colspan="6">
								<input type="submit" name="logout" id="logout" onclick="logoutalert()" value="Log Out">
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>







	</form>
</body>
</html>

<?php 

		if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST['logout']))
		{	
			session_destroy();
			header("Location: Homepage.php");
		
		} 
	}
		
?>