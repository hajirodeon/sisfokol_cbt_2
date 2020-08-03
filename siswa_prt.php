<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");




nocache;

//nilai
$filenya = "siswa_prt.php";
$judul = "Print Kartu Tes";
$judulku = $judul;
$ku_judul = $judulku;
$s = nosql($_REQUEST['s']);
$kdx = nosql($_REQUEST['ckd']);
$kd = nosql($_REQUEST['ckd']);




require_once("inc/class/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
$dompdf = new Dompdf();





//isi *START
ob_start();





//profil
$qx = mysqli_query($koneksi, "SELECT * FROM siswa ".
					"WHERE aktif = 'true' ".
					"AND kd = '$kdx'");
$rowx = mysqli_fetch_assoc($qx);
$tx = mysqli_num_rows($qx);
$e_nis = balikin($rowx['nis']);
$e_nisn = balikin($rowx['nisn']);
$e_nama = balikin($rowx['nama']);
$e_user = balikin($rowx['usernamex']);
$e_pass = balikin($rowx['passwordx2']);
$e_kelas = balikin($rowx['kelas']);
$e_lahir_tmp = balikin($rowx['lahir_tmp']);
$e_lahir_tgl = balikin($rowx['lahir_tgl']);
$e_user = balikin($rowx['username']);
$e_passx2 = balikin($rowx['passwordx2']);




?>


<table cellpadding="1" border="1" cellspacing="0">
	<tr valign="top">
		<td width="350">


		<table cellpadding="1" border="0" cellspacing="0">
			<tr valign="top">
				<td width="50">
					<img src="img/logo.jpg" width="50">					
				</td>
				<td width="200">
					<font face="Sans, sans-serif"><font size="2" style="font-size: 10pt"> 
						KARTU UJIAN
					</font></font>
					<br>
					
					<font face="Sans, sans-serif"><font size="2" style="font-size: 14pt"> 
						<?php echo $sek_nama;?>
					</font></font>
				</td>
			</tr>
		</table>
		
		<hr>
		
		<table cellpadding="1" cellspacing="0">
			<tr valign="top">
				<td width="100">
					NIS
					
				</td>
				<td width="200">
					<font face="Sans, sans-serif"><font size="2" style="font-size: 10pt">: 
						<?php echo $e_nis;?>
					</font></font>
				</td>
			</tr>
			
			
			<tr valign="top">
				<td>
					NISN
					
				</td>
				<td>
					<font face="Sans, sans-serif"><font size="2" style="font-size: 10pt">: 
						<?php echo $e_nisn;?>
					</font></font>
				</td>
			</tr>
		
			<tr valign="top">
				<td>
					NAMA
					
				</td>
				<td>
					<font face="Sans, sans-serif"><font size="2" style="font-size: 10pt">: 
						<?php echo $e_nama;?>
					</font></font>
				</td>
			</tr>
			
			<tr valign="top">
				<td>
					KELAS
					
				</td>
				<td>
					<font face="Sans, sans-serif"><font size="2" style="font-size: 10pt">: 
						<?php echo $e_kelas;?>
					</font></font>
				</td>
			</tr>
		
			<tr valign="top">
				<td>
					USERNAME
					
				</td>
				<td>
					<font face="Sans, sans-serif"><font size="2" style="font-size: 10pt">: 
						<?php echo $e_nis;?>
					</font></font>
				</td>
			</tr>
			
			
			<tr valign="top">
				<td>
					PASSWORD
					
				</td>
				<td>
					<font face="Sans, sans-serif"><font size="2" style="font-size: 10pt">: 
						<?php echo $e_passx2;?>
					</font></font>
				</td>
			</tr>
			
		</table>
		


		</td>
	</tr>	
</table>


<?php
//isi
$isi = ob_get_contents();
ob_end_clean();



//echo $isi;





$dompdf->loadHtml($isi);

// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();


$pdf = $dompdf->output();

ob_end_clean();

// Melakukan output file Pdf
//$dompdf->stream('raport-$nis-$ku_nama2.pdf');
$dompdf->stream('siswa-'.$e_nis.'.pdf');
?>