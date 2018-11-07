<?php include 'Config.php';?>




<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='User' ){                ?>



<?php include 'UserNavBar.php';?>


<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>

<style type="text/css">
		a:link, a:visited {
    text-decoration: none;
}

a:hover,a:active {
    text-decoration: underline;
}
	</style>


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

					xhttp.open("GET","data.php?q="+str,true);
					//for asynchronous request boolean value would be "true"
					xhttp.send();
				 
			}
		}
	</script>





</head>

<body style="color: #1a4c40; font-family: sans-serif; font-size: 14px">



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<br/><br/><br/>

	<table align="center" border="0" >


		<tr>
			<td width="1000">
				<h2><u>Latest Movies</u></h2>
			</td>
			<td  align="center">
				<input type="text" name="searchbox" onkeyup="getData(this.value)"   size="30" placeholder="Search By Name"> 
				<input type="submit" name="search" value="Search">
				<label id="sug"></label>
			</td>
		</tr>

	</table>
	
	
	<table align="center" border="0">

		<?php

		if($_SERVER["REQUEST_METHOD"]=="POST"){

		if(isset($_POST['search']))
		{

			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database");



		$query = $_POST['searchbox']; 
    // gets value sent over search form
     
    //$min_length = 3;
    // you can set minimum length of the query if you want
     
    //if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
         
        $query = mysqli_real_escape_string($con,$query);
         
        $rawres = mysqli_query($con,"SELECT * FROM movie_info
            WHERE (`name` LIKE '%".$query."%')") or die(mysqli_error($con));
             
         
        if(mysqli_num_rows($rawres) > 0){
             
            while($res = mysqli_fetch_array($rawres)){  
            	if($res["Quantity"]>0)
			{

            	?>

		<tr>

			<td align="center" width="600">
			<img src="<?php echo $res['Picture']; ?>" width="225" height="225">
			</td>
			<td align="center" width="600">
			<b>Movie ID :</b> <?php echo " ".$res['M_ID']; ?><br/>
			<b>Name :</b> <?php echo " ".$res['Name']; ?><br/>
			<b>Language : </b><?php echo " ".$res['Language']; ?><br/>
			<b>Genre : </b><?php echo " ".$res['Genre']; ?><br/>
			<b>Year : </b><?php echo " ".$res['Year']; ?><br/>
			<b>Price : </b><?php echo " ".$res['Unitprice']." TK"; ?><br/>
			<b>Available Quantity : </b><?php echo " ".$res['Quantity']." TK"; ?><br/>

			<a href="UserAddToCart.php?mid=<?php echo $res['M_ID']?>"><h4><i>Add To Cart!</i></h4></a>
			</td>

		</tr>
		<?php  }
	}


		mysqli_close($con);} 

		else{ 
            echo "No results";
        }
         
    }
    //else{ 
        //echo "Minimum length is ".$min_length;
    //}
		//} 
	}




















		else{

		$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

		mysqli_select_db($con, "my_database") or die ("no database"); 
		$query = "select * from movie_info order by year desc";
		$req = mysqli_query($con,$query);


		while($dnn = mysqli_fetch_array($req))
		{ if($dnn["Quantity"]>0)
			{
		?>		

		<tr>

			<td align="center" width="600">
			<img src="<?php echo $dnn['Picture']; ?>" width="225" height="225"  onerror="if (this.src != 'icons/movie.gif') this.src = 'icons/movie.gif';">
			</td>
			<td align="center"  width="600">
			<b>Movie ID :</b> <?php echo " ".$dnn['M_ID']; ?><br/>
			<b>Name :</b> <?php echo " ".$dnn['Name']; ?><br/>
			<b>Language : </b><?php echo " ".$dnn['Language']; ?><br/>
			<b>Genre : </b><?php echo " ".$dnn['Genre']; ?><br/>
			<b>Year : </b><?php echo " ".$dnn['Year']; ?><br/>
			<b>Price : </b><?php echo " ".$dnn['Unitprice']." TK"; ?><br/>
			<b>Available Quantity : </b><?php echo " ".$dnn['Quantity']." pc"; ?><br/>

			<a href="UserAddToCart.php?mid=<?php echo $dnn['M_ID']?>"><h4><i>Add To Cart!</i></h4></a>
			</td>
			</td>

		</tr>
		<?php  }

		} 

		mysqli_close($con); 
	}    ?>



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
