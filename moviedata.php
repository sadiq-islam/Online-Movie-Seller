<?php
$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("could not connect to mysql"); 

mysqli_select_db($con, "my_database") or die ("no database");


$str="SELECT * FROM movie_info WHERE M_ID LIKE '".$_REQUEST["q"]."%';";
$res=mysqli_query($con,$str);
$list="";

for($i=0;$i<mysqli_num_rows($res);$i++)
{	

	$row[$i] = mysqli_fetch_array($res);
	$list.= $row[$i]['Name'] ."|";
	$list.= $row[$i]['Language']."|";
	$list.= $row[$i]['Genre']."|";
	$list.= $row[$i]['Year']."|";
	$list.= $row[$i]['Quantity']."|";
	$list.= $row[$i]['Unitprice']."|";
	$list.= $row[$i]['Picture']."|";
	$list.= $row[$i]['WholesalePrice']."|";
}

//$list.="<br/><br/>" . "!!!AVAILABLE!!!";

echo $list===""?"No Suggestion":$list;

?>