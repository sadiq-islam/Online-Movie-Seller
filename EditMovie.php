<?php include 'Config.php';?>


<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='Admin' ){       } 

else
{
	header("Location: Sign In.php");
}



?>







<!-------------------------------------VALIDATION----------------------------->

<?php
	
	$sts=0;


		if(isset($_POST["updatemovie"])){
		 

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

			$moviename=$_POST['moviename'];
			$genre=$_POST['genre'];
			$language=$_POST['language'];
			$ryear=$_POST['ryear'];
			$quantity=$_POST['quantity'];
			$unitprice=$_POST['unitprice'];
			$wholesaleprice=$_POST['wholesaleprice'];
			$picture=$target_file ;


			$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

			mysqli_select_db($con, "my_database") or die ("no database"); 
			

			$q1 = 'select * from movie_info where M_ID="'.$_POST['mid'].'"';
				$rq1 = mysqli_query($con,$q1);
				$dn1=mysqli_fetch_array($rq1);



			if(empty($_FILES["movieimagefile"]["tmp_name"]))

			{
				$query = 'UPDATE `movie_info` SET `M_ID`="'.$dn1['M_ID'].'",`Name`="'.$moviename.'",`Language`="'.$language.'",`Genre`="'.$genre.'",`Year`="'.$ryear.'",`Quantity`="'.$quantity.'",`Unitprice`="'.$unitprice.'",`WholesalePrice`="'.$wholesaleprice.'",`Picture`="'.$dn1['Picture'].'" WHERE M_ID="'.$dn1['M_ID'].'"';

				$req = mysqli_query($con,$query);

				//echo "Movie Information Updated!<br/>";	
			}


		    else if (move_uploaded_file($_FILES["movieimagefile"]["tmp_name"], $target_file)) 
		    {	
		    	$query = 'UPDATE `movie_info` SET `M_ID`="'.$dn1['M_ID'].'",`Name`="'.$moviename.'",`Language`="'.$language.'",`Genre`="'.$genre.'",`Year`="'.$ryear.'",`Quantity`="'.$quantity.'",`Unitprice`="'.$unitprice.'",`WholesalePrice`="'.$wholesaleprice.'",`Picture`="'.$picture.'" WHERE M_ID="'.$dn1['M_ID'].'"';

		    	$req = mysqli_query($con,$query);

		    	$file = $dn1['Picture'];
					if (!unlink($file))
					  {
					  echo ("Error deleting $file!");
					  }
					else
					  {
					  echo ("Deleted $file!");
					  }

		        //echo "The file ". basename( $_FILES["movieimagefile"]["name"]). " has been uploaded.<br/>";
		        //echo "Movie Information Updated!<br/>";
					header("Location:EditMovie.php");
		    
		    } 

		    else {


		        echo "Sorry, there was an error uploading your file!<br/>";
		        
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
				//document.getElementById("sug").innerHTML="";
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

						document.getElementById("moviename").value=minfo[0];
						document.getElementById("language").value=minfo[1];
						document.getElementById("genre").value=minfo[2];
						document.getElementById("ryear").value=minfo[3];
						document.getElementById("quantity").value=minfo[4];
						document.getElementById("unitprice").value=minfo[5];
						document.getElementById("movieimage").src=minfo[6];
						document.getElementById("wholesaleprice").value=minfo[7];
						//var filename = minfo[6].split("/");
						//document.getElementById("pictureid").value=filename[1];


						

					} 
				};

					xhttp.open("GET","moviedata.php?q="+str,true);
					//for asynchronous request boolean value would be "true"
					xhttp.send();
				 
			}
		}
	</script>



</head>
<body>


	<script>
						  var loadFile = function(event) {
						    var output = document.getElementById('movieimage');
						    output.src = URL.createObjectURL(event.target.files[0]);
						  };
						  function updatealert()
						  {
						  	alert("Movie Information Updated!");
						  }
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
						<legend align="center"><h3><u>EDIT MOVIE INFORMATION</u></h3></legend>



<table align="center" border="0" width="650"><tr><td>

							<table >
								<tr>
									<td width="150"><label> Movie ID : </label></td>

									<td>

									

										<select name="mid" onchange="getData(this.value)" required="required">
											<option>Choose Movie ID</option>
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
									<td><input type="text" name="moviename" id="moviename" placeholder="Mandatory Field!" required="required" /><br/></td>
									
								</tr>
							</table>
							<hr/>
							
							<table >
								<tr>
									<td width="150"><label>Language : </label>
									</td>
									<td>
									<select name="language" id="language" required="required">
					
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
									<select name="genre" id="genre" required="required">
					
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
									<input type="number" id="ryear" name="ryear" min="1950" max="2018" required="required" >
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
							
								<input type="submit" name="updatemovie" value="Update Movie Info" onclick="updatealert()" />
								<input type="reset" name="reset" value="Reset"/>
							
							<br/><br/>
				
</td>

<td align="center" >
	<table align="right" border="0">
					<tr align="center">
						<td height="275">
						<img src="movieicon.png" name="movieimage" id="movieimage" width="250" height="250" onerror="if (this.src != 'icons/movie.gif') this.src = 'icons/movie.gif';"/> <br/>
						
						</td>
					</tr>
					<tr align="center">
						<td>
						<input type="file" name="movieimagefile" id="pictureid" accept="image/*" onchange="loadFile(event)">
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







