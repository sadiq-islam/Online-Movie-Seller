<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>

	<style type="text/css">
	 .links:link,  .links:visited {
    background-color: #ac8f39;
    color: white;
    padding: 4px 20px;
    text-align: center;
    text-decoration: none;
    
    display: inline-block;
}


 .links:hover, .links:active {
    background-color: #736026;
}
	</style>
</head>
<body>





	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<!--    NEVIGATION BAR     -->
		<table align="center" border="0">


			<tr align= "center"><td>
				<a href="Homepage.php"> <img src="icons/movies.com.png" height="120" width="325"></a>
			</td></tr>
			<!-- 
			<tr >
				<td align="right" width="370"> <img src="movieicon.jpg" width="70" height="70">  </td>
				<td width="530"> <h1>  MOVIES.COM </h1>  </td>
			</tr>
			-->

			<tr></tr><tr></tr>

			<tr align="center">
				<td colspan="2">
					<table border="0">
						<tr align="center">

							<td width="200" align="center">
								<a href="Homepage.php" class="links"> Home </a>
							</td>

							<td width="200" align="center">
								  <a href="Registration.php" class="links" > Registration </a> 
							</td>

							<td width="200" align="center">
								  <a href="Sign In.php" class="links"> Sign In </a>  
							</td>
<!--
							<td width="200">
								<a href="About Us.php">About Us</a>
							</td>
						-->
						</tr>
					</table>
				</td>
			</tr>
		</table>







	</form>
</body>
</html>

