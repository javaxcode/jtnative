<?php
require '../include/fungsi.php';
include '../include/fungsi_rupiah.php';
include '../include/fungsi_bulat.php';
require_once '../vendor/autoload.php';

// $module = $_GET['mod'];
// $act = $_GET['act'];

// if ($module != 'report' && $act != 'pdf') {
// 	exit();
// }

$month = $_GET['bul'];
$tahun = $_GET['y'];

if ($month === '01') {
	$bul = 'Januari';
} elseif ($month === '02') {
	$bul = 'Febuari';
} elseif ($month === '03') {
	$bul = 'Maret';
} elseif ($month === '04') {
	$bul = 'April';
} elseif ($month === '05') {
	$bul = 'Mei';
} elseif ($month === '06') {
	$bul = 'Juni';
} elseif ($month === '07') {
	$bul = 'Juli';
} elseif ($month === '08') {
	$bul = 'Agustus';
} elseif ($month === '09') {
	$bul = 'September';
} elseif ($month === '10') {
	$bul = 'Oktober';
} elseif ($month === '11') {
	$bul = 'November';
} elseif ($month === '12') {
	$bul = 'Desember';
}

$ls = query("SELECT * FROM listrikspeedy WHERE month(tanggal) = '03'  AND year(tanggal) ='2020' ORDER BY id DESC");

$jumlahi = "SELECT SUM(jumlah) AS total_i FROM listrikspeedy WHERE month(tanggal) = '03' AND year(tanggal) ='2020' "; //perintah untuk menjumlahkan
$hasili = mysqli_query($conn, $jumlahi) ;//melakukan query dengan varibel $jumlahkan
$inp = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
$totali = $inp['total_i'];



$html = '
	<html lang="en">
	<head>
		
		<title>Laporan</title>
				<style>
			.box{
				width:200px;
				height:200px;
				background:green;
				display: inline-block;
				margin-left: 10px;
			}
		</style>
	</head>
		<body>
		<table style="border-bottom: 3px solid #000000; padding-bottom: 10px; width: 283mm;">
		<tr valign="top">
		    <td style="width: 283mm;" valign="middle">
		        <div style="font-weight: bold; padding-bottom: 5px; font-size: 13pt;">
		            
		            <img src="../images/" width="90mm" />
		        </div>
		        <span style="font-size: 10pt;">Jl. Serua Raya No.9, Serua Bojongsari, Kota Depok, Jawa Barat 16517, <br> Telp. +62 821 1132 5711, Email: jt@javatechnic.co.id</span>
		    </td>
		</tr>
		</table>
			<p style="text-align: center; width: 206mm; font-size: 10pt;"><b><u>Laporan Listrik Speedy ' . $bul . ' ' . $tahun . '</u></b></p>

			<div class="row" >'; 
                           
                            
                foreach ($ls as $row ) {
                $html .= '
                <div class="box">
                    
                    <div class="panel panel-color panel-info">

                        <div class="panel-heading">
                            <h3 title=" '.$row['nomer'].' " class="panel-title"> '.$row['nomer'].'</h3>
                        </div>

                        <div class="panel-body">
                            <div class="text-center">
                                <img src="../images/nota/'.$row['gambar'].' " style="width: 60mm; ">
                            </div>
                            
                        </div>

                    </div>
                   
                </div>';
                }

				$html .= '
                            

            </div> 
			
		</body>
			
	</html>
';

$namafile = $month . ' Kaskecil - ' . $bul . '/' . $tahun . '.pdf';

//iki editanku
if ($_GET['format'] == 'html') {
	echo $html;
	exit();
}

$mpdf = new \Mpdf\Mpdf();


$mpdf->SetWatermarkImage('img/wmjt.png');
$mpdf->showWatermarkImage = true;
$mpdf->WriteHTML($html);
$mpdf->Output($namafile, \Mpdf\Output\Destination::INLINE);
