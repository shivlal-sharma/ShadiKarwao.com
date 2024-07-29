<?php
session_start();
if(!isset($_SESSION['fullName'])){
    header('location:login.php');
}

require('fpdf186/fpdf.php'); // Include FPDF library

// Database connection
include 'connect.php';
// Fetch data from database
    $paymentDetails = $_SESSION['paymentDetails'];

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Add details to PDF
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,'Payment Details',0,1,'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,10,'Name :  ' . $paymentDetails['FirstName'].' '.$paymentDetails['LastName'],0,1);
    $pdf->Cell(0,10,'Email :  ' . $paymentDetails['Email'],0,1);
    $pdf->Cell(0,10,'Location Name :  ' . $paymentDetails['Location_Name'],0,1);

    // Add image
    $pdf->Cell(0,10,'Location :',0,1);
    $pdf->Image('location_img/'.$paymentDetails["Location_Image"],11,69,30); // Assuming 'location_image' is the column name where you store the image URL

    $pdf->Ln(19);
    $pdf->Cell(0,10,'Capacity :  ' . $paymentDetails['Capacity'].' People',0,1);
    $pdf->Cell(0,10,'Price :  Rs.' . $paymentDetails['Price'].'/-',0,1);
    $pdf->Cell(0,10,'Wedding Date :  ' . $paymentDetails['Wed_Date'],0,1);
    $pdf->Cell(0,10,'Transaction Id :  ' . $paymentDetails['Transaction_Id'],0,1);
    $pdf->Cell(0,10,'Booking Date :  ' . $paymentDetails['Date'],0,1);

    $pdf->Image('images/logo.png', 170, 20, 30);

    // Output PDF
    $pdf->Output('D', 'invoice.pdf'); // 'D' for download, 'I' for inline display, 'F' for saving to a file, 'S' for returning the document as a string

$con->close();
?>
