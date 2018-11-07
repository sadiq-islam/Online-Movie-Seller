<?php include 'Config.php';?>



<?php              if(isset($_SESSION['username'],$_SESSION['password'],$_SESSION['usertype']) && $_SESSION['usertype']=='User' ){               } 

else
{
    header("Location: Sign In.php");
}
 ?>





<?php


include_once('libs/fpdf.php');
 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('icons/movies.com.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Movie Purchase List ('.date("Y-m-d"). ')',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
$con = mysqli_connect("localhost", "root","" ,"my_database" ) or die ("Could not connect to mysql"); 

        mysqli_select_db($con, "my_database") or die ("no database");
$display_heading = array('M_ID'=> 'M_ID', 'Movie_Name'=> 'Movie Name', 'Quantity'=> 'Quantity','Total_Price'=> 'Total_Price',);
 
$result = mysqli_query($con, 'SELECT cart_info.M_ID,movie_info.Name,cart_info.Quantity, cart_info.Total_Price  FROM cart_info left outer join movie_info on cart_info.M_ID= movie_info.M_ID WHERE cart_info.U_ID= "'.$_SESSION['username'].'" ') or die("database error:". mysqli_error($con));
$header = mysqli_query($con, "SHOW columns FROM cart_info");
 
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
foreach($header as $heading) {
$pdf->Cell(40,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(40,12,$column,1);
}
$pdf->Output();


?>