<?php
require_once 'pdo.php';
require_once 'fpdf.php';
session_start();



  $stmt=$pdo->prepare("SELECT projects.projectname as project ,time.start_time as stime,time.end_time as etime
    from time join projects on projects.projectid=time.projectid where projects.userid=:uid and time.userid=:uid and time.start_time!='1000-01-01 00:00:00'");
  $stmt->execute(array(':uid'=>$_SESSION['userid']));
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);


  if($_POST['datatype']=='csv'){
    $filename = 'data_for_'.$_SESSION['username'].'.csv';
    $file = fopen($filename,"w");

    fputcsv($file,array('Project Name','Start Time','End Time'));
    fputcsv($file,array('','',''));


    foreach ($rows as $line){
     fputcsv($file,$line);
   }
    echo($file);
    fclose($file);


    // download

    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=".$filename);
    header("Content-Type: application/csv; ");

    readfile($filename);

    // deleting file
    unlink($filename);

  }

  elseif ($_POST['datatype']=='json') {
    $filename = 'data_for_'.$_SESSION['username'].'.json';
    $file = fopen($filename, 'w');

    fwrite($file, json_encode($rows));

    echo($file);
    fclose($file);
    // download
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=".$filename);
    header("Content-Type: json; ");

    readfile($filename);

    // deleting file
    unlink($filename);



  }
  elseif ($_POST['datatype']=='pdf') {


    class PDF extends FPDF
    {
    // Load data
    function LoadData()
    {
        // Read file lines
        global $rows;
        return $rows;
    }
    function Header()
    {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(60);
        // Title
        $this->Cell(70,10,'Time Records for '.$_SESSION['username'],1,0,'C');
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
        $this->Cell(0,10,'Made by Aditya Kane and Tanvesh Chavan ',0,0,'C');
    }

      // Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(40, 35, 40, 45);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell(40,7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {

      $stime=date_create($row['stime']);
      $etime=date_create($row['etime']);
      $diff=date_diff($etime,$stime)->format('%H : %I : %S');

      $stime=date_format($stime,"D d M H:i:s");
      $etime=date_format($etime,"D d M H:i:s");



        $this->Cell(40,6,$row['project'],'LR',0,'C');
        $this->Cell(40,6,$stime,'LR',0,'C');
        $this->Cell(40,6,$etime,'LR',0,'C');
        $this->Cell(40,6,$diff,'LR',0,'C');

        $this->Ln();
    }
    // Closing line
    $this->Cell(160,0,'','T');
}
}

$pdf = new PDF();
// Column headings
$header = array('Project Name', 'Start Time', 'End Time','Time spent');
// Data loading


$data=$pdf->LoadData();
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
$pdf->ImprovedTable($header,$data);

$pdf->Output();


  }


 ?>
