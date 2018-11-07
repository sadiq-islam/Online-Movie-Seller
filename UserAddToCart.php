<?php include 'Config.php';?>

<?php include 'UserNavBar.php'; ?>


<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='User' ){       } 

else
{
	header("Location: Sign In.php");
}



?>




<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{	

		if(isset($_POST["addmovietocart"]))
		{
			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

			mysqli_select_db($con, "my_database") or die ("no database"); 


				$uname=$_SESSION['username'];
				

				$qr='select quantity,unitprice from movie_info where M_ID="'.$_POST["dmid"].'"';
				$rs=mysqli_query($con,$qr);

				$res = mysqli_fetch_array($rs);
				//echo "".$res['quantity']."  ".$res['unitprice'];

				if($res['quantity']<1 || $res['quantity']<$_POST['rquantity'] )
				{

				
					
					?>
					
					<script>
					var x = "<?php echo $_POST["dmid"]; ?>";	
					alert("Required quantity is not available!");
					window.location.href="UserAddToCart.php?mid="+x;
					</script>';
					
					<?php
					

				}
				else
				{


					$qr1='SELECT * FROM `cart_info` WHERE `U_ID`="'.$uname.'" AND `M_ID`="'.$_POST["dmid"].'"';


				    $rs1=mysqli_query($con,$qr1);


				    if (mysqli_num_rows($rs1)>0)
				    {
				    	
				    $qr2='DELETE FROM `cart_info` WHERE `U_ID`="'.$uname.'" AND `M_ID`="'.$_POST["dmid"].'"';


				    $rs2=mysqli_query($con,$qr2);


				    $t_price=$_POST['rquantity']*$res['unitprice'];
				    $qr3='INSERT INTO `cart_info`(`U_ID`, `M_ID`, `Quantity`, `Total_Price`) VALUES ("'.$uname.'","'.$_POST["dmid"].'","'.$_POST["rquantity"].'","'.$t_price.'")';


				    $rs3=mysqli_query($con,$qr3);

				    

					
					?>
					
					<script>
					alert("Movie was already in the cart!Required quantity updated!!");
					window.location.href="UserCart.php";
					</script>';
					
					<?php
					
					
				    }

				    else{

					$t_price=$_POST['rquantity']*$res['unitprice'];

					$q1='INSERT INTO `cart_info`(`U_ID`, `M_ID`, `Quantity`, `Total_Price`) VALUES ("'.$uname.'","'.$_POST["dmid"].'","'.$_POST["rquantity"].'","'.$t_price.'")';
					$rq1=mysqli_query($con,$q1);

					if($rq1)
					{
						echo "Movie Added To Cart!";
						header("Location:UserCart.php");
					}
					else
					{
						echo "Movie Could Not Be Added To Cart!";
					}
				}
			}

			
			
				mysqli_close($con);
		}
	}

?>










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
						var rt= this.responseText;
						var minfo= rt.split("|");

						document.getElementById("moviename").innerHTML=minfo[0];
						document.getElementById("language").innerHTML=minfo[1];
						document.getElementById("genre").innerHTML=minfo[2];
						document.getElementById("ryear").innerHTML=minfo[3];
						document.getElementById("quantity").innerHTML=minfo[4];
						document.getElementById("unitprice").innerHTML=minfo[5];
						document.getElementById("movieimage").src=minfo[6];


						

					} 
				};

					xhttp.open("GET","moviedata.php?q="+str,true);
					//for asynchronous request boolean value would be "true"
					xhttp.send();
				 
			}
		}
	</script>


	<script>
						  var loadFile = function(event) {
						    var output = document.getElementById('movieimage');
						    output.src = URL.createObjectURL(event.target.files[0]);
						  };
	</script>




</head>



<body onload="getData(<?php echo $_GET['mid'];?>)">





<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">


		<br/>
		<!--                    ADD TO CART                      -->
		<table align="center" >
			<tr>

				<td>
					<table align="center" >
			<tr>
				<td width="700">
					<fieldset>
						<legend align="center"><h3><u>ADD TO CART</u></h3></legend>



<table align="center" border="0" width="620" ><tr><td>

							<table >
								<tr>
									<td width="150"><label> Movie ID : </label></td>

									<td>


										<select name="dmid" required="required" onchange="getData(this.value)">
									
									<?php
									$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

											mysqli_select_db($con, "my_database") or die ("no database"); 
											$req = mysqli_query($con,'select M_ID from movie_info where M_ID="'.$_GET['mid'].'" ');


											while($dnn = mysqli_fetch_array($req))
											{?>
								
					
										<option value="<?php echo $dnn['M_ID']?>" > <?php echo $dnn['M_ID']?> </option>
										<?php  } 
									mysqli_close($con);?>


									</select><br/>

								</td>
								</tr>
							</table>
							<hr/>


							<table >
								<tr>
									<td width="150"><label> Movie Name : </label></td>
									<td><label id="moviename"></label></td>
									
								</tr>
							</table>
							<hr/>
							
							<table >
								<tr>
									<td width="150"><label>Language : </label>
									</td>
									<td><label id="language"></label></td>
								</tr>
							</table>

							<hr/>
							<table >
								<tr>
									<td width="150"><label>Genre : </label>
									</td>
									<td><label id="genre"></label><br/>
									</td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label> Released Year : </label>
									</td>
									<td align="center" ><label id="ryear"></label></td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label>Available Quantity : </label>
									</td>
									<td><label id="quantity"></label></td>
								</tr>
							</table>
							<hr/>


							<table >
								<tr>
									<td width="150"><label>Unit Price : </label>
									</td>
									<td align="center"><label id="unitprice"></label></td>
								</tr>
							</table>
							<hr/>

							<table>
								<tr>
									<td>Required Quanity : </td>
									<td>
									<input type="number" name="rquantity" min="1" required="required">
								</td>
							</tr>
							</table>
				
							
							<br/><br/>
							
								<input type="submit" name="addmovietocart" value="Add To Cart"/>
								
							
							<br/><br/>
				
</td>

<td align="center" >
	<table align="right" border="0">
					<tr align="center">
						<td align="center">
						<img src="movieicon.png" name="movieimage" id="movieimage" width="250" height="250" /> <br/>
						
						</td>
					</tr>
				
				
	</table>


</td>


</tr></table>							
					</fieldset>
				</td>
			</tr>
		
		</table>

				</td>


</tr></table>							
					</fieldset>
				</td>
			</tr>
		
		</table>
				</td>

			</tr>
		</table>
		


	</form>



</body>
</html>









