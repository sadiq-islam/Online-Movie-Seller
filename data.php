<?php
$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

mysqli_select_db($con, "my_database") or die ("no database");


$str="SELECT * FROM movie_info WHERE Name LIKE '".$_REQUEST["q"]."%';";
$res=mysqli_query($con,$str);
$list="";

for($i=0;$i<mysqli_num_rows($res);$i++)
{	
	$a=$i+1;
	$row[$i] = mysqli_fetch_array($res);

	$list.="<br/>" .$a.". ". $row[$i]['Name'];

}

//$list.="<br/><br/>" . "!!!AVAILABLE!!!";

echo $list===""?"No Suggestion":$list;

?>