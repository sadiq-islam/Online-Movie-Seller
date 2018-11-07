<?php include 'Config.php';?>


<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='Admin' ){       } 

else
{
	header("Location: Sign In.php");
}



?>

<?php include 'AdminNavBar.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>MOVIES.COM</title>
</head>
<body>


	<script>
						  var loadFile = function(event) {
						    var output = document.getElementById('movieimage');
						    output.src = URL.createObjectURL(event.target.files[0]);
						  };
	</script>







<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">


		<br/>
		<!--                    ADD MOVIES                        -->
		<table align="center" >
			<tr>

				<td>
					<table align="center" >
			<tr>
				<td width="700">
					<fieldset>
						<legend align="center"><h3><u>ADD MOVIE</u></h3></legend>



<table align="center" border="0"><tr><td>
							<table >
								<tr>
									<td width="150"><label> Movie Name : </label></td>
									<td><input type="text" name="moviename" placeholder="Mandatory Field!" required="required" /><br/></td>
									
								</tr>
							</table>
							<hr/>
							
							<table >
								<tr>
									<td width="150"><label>Language : </label>
									</td>
									<td>
									<select name="language" required="required">
					
										<option value=""></option>
										<option value="Bangla">Bangla</option>
										<option value="English">English</option>
										<option value="Hindi">Hindi</option>
										
									</select><br/>
									</td>
								</tr>
							</table>

							<hr/>
							<table >
								<tr>
									<td width="150"><label>Genre : </label>
									</td>
									<td>
									<select name="genre" required="required">
					
										<option value=""></option>
										<option value="Action">Action</option>
										<option value="Family">Family</option>
										<option value="Drama">Drama</option>
										<option value="Kids">Kids</option>
										<option value="Thriller">Thriller</option>
										<option value="Comedy">Comedy</option>
										<option value="Horror">Horror</option>
										<option value="Animation">Animation</option>
										<option value="Sci-fi">Sci-fi</option>
										
									</select><br/>
									</td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label> Released Year : </label>
									</td>
									<td align="center">
									<input type="number" name="ryear" min="1950" max="2018" required="required" >
									</td>
								</tr>
							</table>
							<hr/>

							<table >
								<tr>
									<td width="150"><label>Quantity : </label>
									</td>
									<td align="center">
									<input type="number" name="quantity" id="quantity"  min="1" max="9999" align="center" required="required" />
									</td>
								</tr>
							</table>
							<hr/>


							<table >
								<tr>
									<td width="150"><label>Wholesale Price : </label>
									</td>
									<td align="center">
									<input type="number" name="wholesaleprice" id="wholesaleprice" min="1" max="9999" required="required" /><br/>
									</td>
								</tr>
							</table>
							<hr/>



							<table >
								<tr>
									<td width="150"><label>Unit Price : </label>
									</td>
									<td align="center">
									<input type="number" name="unitprice" id="unitprice" min="1" max="9999" required="required" /><br/>
									</td>
								</tr>
							</table>
							<hr/>

				
							
							<br/><br/>
							
								<input type="submit" name="addmovie" value="Add Movie"/>
								<input type="reset" name="reset" value="Reset"/>
							
							<br/><br/>
				
</td>

<td align="center" >
	<table align="center" border="1">
					<tr align="center">
						<td height="275">
						<img src="movieicon.png" name="movieimage" id="movieimage" width="170" height="170"   onerror="if (this.src != 'icons/movie.gif') this.src = 'icons/movie.gif';"/> <br/>
						
						</td>
					</tr>
					<tr align="center">
						<td>
						<input type="file" name="movieimagefile" id="pictureid" required="required" accept="image/*" onchange="loadFile(event)">
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


<!--             Manage Movies             -->


<tr align="center">

<td>
	<a href="EditMovie.php"> Edit Movie </a>
		<hr/>
	<a href="DeleteMovie.php"> Delete Movie </a>

</td>
</tr>


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







<!-------------------------------------VALIDATION----------------------------->

<?php
	
	$sts=0;


		if(isset($_POST["addmovie"])){
		 

		 if(!preg_match("/^[a-zA-Z0-9\\-\\s]*$/",test_input($_POST["moviename"]))  )
		{
			echo "Movie Name can contain alpha numeric characters, space, dash only.<br/>";
			$sts=1;
		}

		if((int)$_POST["ryear"]<1950 || (int)$_POST["ryear"]>2018)
		{
			echo "Realeased year should be within 1950-2018!<br/>";
			$sts=1;
		}

		if((int)$_POST["quantity"]<1)
		{
			echo "Quantity should at least be 1!<br/>";
			$sts=1;
		}

		if((int)$_POST["unitprice"]<1)
		{
			echo "Unit price should at least be 1!<br/>";
			$sts=1;
		}



  		$target_dir = "movieimagesuploads/";
		$target_file = $target_dir .rand(). basename($_FILES["movieimagefile"]["name"]);
		
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.<br/>";
		    $sts=1;
		}
		// Check file size
		if ($_FILES["movieimagefile"]["size"] >= 4000000) {
		    echo "Sorry,  Picture size should not be more than 4MB!<br/>";
		    $sts=1;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($sts == 1) {
		    echo "Sorry, your file was not uploaded!<br/>";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["movieimagefile"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["movieimagefile"]["name"]). " has been uploaded.<br/>";
		    
		    } else {
		        echo "Sorry, there was an error uploading your file!<br/>";
		        
		    }
		}


  		

		if ($sts==0) {

			$moviename=$_POST['moviename'];
			$genre=$_POST['genre'];
			$language=$_POST['language'];
			$ryear=$_POST['ryear'];
			$quantity=$_POST['quantity'];
			$unitprice=$_POST['unitprice'];
			$picture=$target_file ;


			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

			mysqli_select_db($con, "my_database") or die ("no database"); 
			
				$q = 'INSERT INTO `movie_info`(`Name`, `Language`, `Genre`, `Year`, `Quantity`, `Unitprice`, `Picture`) VALUES ("'.$moviename.'","'.$language.'","'.$genre.'","'.$ryear.'","'.$quantity.'","'.$unitprice.'","'.$picture.'")';
				$rq = mysqli_query($con,$q);

				if($rq)
				{
					echo "Movie uploaded!<br/>";
				}
				else
				{
					echo "Failed!<br/>";
				}


			
		}
	}

		
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		  }
	?>























