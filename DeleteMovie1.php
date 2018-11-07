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
					header("Location:AdminHome.php");
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

	<script type="text/javascript">
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

									

										<select name="mid" required="required"  oninput="getData(this.value)">
									
									<?php
									$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

											mysqli_select_db($con, "my_database") or die ("no database"); 
											$req = mysqli_query($con,'select * from movie_info where M_ID="'.$_GET['mid'].'" ');


											while($dnn = mysqli_fetch_array($req))
											{?>
								
					
										<option value="<?php echo $dnn['M_ID']?>" > <?php echo $dnn['M_ID']?> </option>
										


									</select><br/>

								</td>
								</tr>
							</table>
							<hr/>


							<table >
								<tr>
									<td width="150"><label> Movie Name : </label></td>
									<td><label id="moviename"><?php echo $dnn['Name']?></label></td>
									
								</tr>
							</table>
							<hr/>
							
							<table >
								<tr>
									<td width="150"><label>Language : </label>
									</td>
									<td><label id="language"><?php echo $dnn['Language']?></label></td>
								</tr>
							</table>

							<hr/>
							<table >
								<tr>
									<td width="150"><label>Genre : </label>
									</td>
									<td><label id="genre"><?php echo $dnn['Genre']?></label><br/>
									</td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label> Released Year : </label>
									</td>
									<td align="center" ><label id="ryear"><?php echo $dnn['Year']?></label></td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label>Quantity : </label>
									</td>
									<td><label id="quantity"><?php echo $dnn['Quantity']?></label></td>
								</tr>
							</table>
							<hr/>


							<table >
								<tr>
									<td width="150"><label>Unit Price : </label>
									</td>
									<td align="center"><label id="unitprice"><?php echo $dnn['Unitprice']?></label></td>
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
						<img src="<?php echo $dnn['Picture']?>" name="movieimage" id="movieimage" width="250" height="250"  onerror="if (this.src != 'icons/movie.gif') this.src = 'icons/movie.gif';"/> <br/>
						
						</td>
					</tr>
				<?php  } 
									mysqli_close($con);?>
				
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

























