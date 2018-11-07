<?php
$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

mysqli_select_db($con, "my_database") or die ("no database");


$str="SELECT * FROM person WHERE  `U_ID` ='".$_REQUEST["q"]."';";
$res=mysqli_query($con,$str);
$list="";

for($i=0;$i<mysqli_num_rows($res);$i++)
{	
	$row[$i] = mysqli_fetch_array($res);
	$list.= $row[$i]['Name'] ."|";
	$list.= $row[$i]['Email']."|";
	$list.= $row[$i]['DOB']."|";
	$list.= $row[$i]['Gender']."|";
	$list.= $row[$i]['ContactNo']."|";
	$list.= $row[$i]['Address']."|";
}

//$list.="<br/><br/>" . "!!!AVAILABLE!!!";

echo $list===""?"No Suggestion":$list;

?>