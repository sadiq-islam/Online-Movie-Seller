<?php include 'Config.php';?>


<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='Admin' ){       } 

else
{
	header("Location: Sign In.php");
}



?>


<!-------------------------------------VALIDATION----------------------------->

<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{	

		if(isset($_POST["deletemovie"]))
		{
			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

			mysqli_select_db($con, "my_database") or die ("no database"); 

				$mid=$_POST['mid'];
				$q1='select * from movie_info where m_id="'.$mid.'"';
				$rq1=mysqli_query($con,$q1);
				$dn11=mysqli_fetch_array($rq1);
				
				if (mysqli_num_rows($rq1)==1)
				{
					$q = 'delete from movie_info where m_id="'.$mid.'"';
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


					echo "Movie Deleted!<br/>";
					header("Location:DeleteMovie.php");
				}
				else
				{
					echo "No Such Movie ID!<br/>";
				}

			
				mysqli_close($con);
		}
	}

?>





<?php include 'AdminNavBar.php';?>

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

						  function deletealert()
						  {
						  	alert("Movie Deleted!");
						  }
	</script>
</head>
<body>


	







<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">


		<br/>
		<!--                    DELETE MOVIES                        -->
		<table align="center" >
			<tr>

				<td>
					<table align="center" >
			<tr>
				<td width="700">
					<fieldset>
						<legend align="center"><h3><u>DELETE MOVIE</u></h3></legend>



<table align="center" border="0" width="620"><tr><td>

							<table >
								<tr>
									<td width="150"><label> Movie ID : </label></td>

									<td>

									

										<select name="mid" required="required" onchange="getData(this.value)">
										<option>Choose Movie ID!</option>
									<?php
									$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

											mysqli_select_db($con, "my_database") or die ("no database"); 
											$req = mysqli_query($con,"select M_ID from movie_info");


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
									<td width="150"><label>Quantity : </label>
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

				
							
							<br/><br/>
							
								<input type="submit" name="deletemovie" value="Delete Movie" onclick="deletealert()" />
								<input type="reset" name="reset" value="Reset"/>
							
							<br/><br/>
				
</td>

<td align="center" >
	<table align="right" border="0">
					<tr align="center">
						<td align="center">
						<img src="movieicon.png" name="movieimage" id="movieimage" width="250" height="250"  onerror="if (this.src != 'icons/movie.gif') this.src = 'icons/movie.gif';"/> <br/>
						
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

























