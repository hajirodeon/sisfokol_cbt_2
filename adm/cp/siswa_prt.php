<?php
session_start();


//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



nocache;

//nilai
$filenya = "siswa_prt.php";
$judul = "Print Kartu Tes";
$judulku = $judul;
$ku_judul = $judulku;
$s = nosql($_REQUEST['s']);
$kdx = nosql($_REQUEST['ckd']);
$kd = nosql($_REQUEST['ckd']);





require_once("../../inc/class/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
$dompdf = new Dompdf();






//profil
$qx = mysqli_query($koneksi, "SELECT * FROM siswa ".
					"WHERE kd = '$kdx'");
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





//jika null
if (empty($e_pass))
	{
	//pass
	$passku = substr($x,0,5);
	$passkux = md5($passku);
	}
//jika ada
else 
	{
	$passku = $e_pass;
	$passkux = md5($e_pass);	
	}	



//bikin user
mysqli_query($koneksi, "UPDATE siswa SET usernamex = '$e_nis', ".
				"passwordx = '$passkux', ".
				"passwordx2 = '$passku', ".
				"aktif = 'true', ".
				"aktif_postdate = '$today' ".
				"WHERE kd = '$kdx'");






//profil
$qx = mysqli_query($koneksi, "SELECT * FROM siswa ".
					"WHERE kd = '$kdx'");
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












//isi *START
ob_start();

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
/*
echo '<table width="300" border="1" cellpadding="1" cellspacing="0">
	<tr valign="top">
		<td align="center">
			<img src="../../img/logo.jpg" height="50">
		</td>
		<td width="100%" align="left">
			KARTU UJIAN
			<br>
			
			<b>'.$sek_nama.'</b>
		</td>
	</tr>
</table>

<table width="300" border="1" cellpadding="1" cellspacing="0">
	<tr valign="top">
	<td align="left">
	
		<table width="100%" cellpadding="1" cellspacing="0">
			<tr valign="top">
				<td width="100" align="left">
					NIS
				</td>
				<td align="left">
					: <b>'.$e_nis.'</b>
				</td>
			</tr>
			
			<tr valign="top">
				<td width="100" align="left">
					NISN
				</td>
				<td align="left">
					: <b>'.$e_nisn.'</b>
				</td>
			</tr>
			
			<tr valign="top">
				<td width="100" align="left">
					NAMA
				</td>
				<td align="left">
					: <b>'.$e_nama.'</b>
				</td>
			</tr>
			
			<tr valign="top">
				<td width="100" align="left">
					KELAS
				</td>
				<td align="left">
					: <b>'.$e_kelas.'</b>
				</td>
			</tr>
			
			<tr valign="top">
				<td width="100" align="left">
					USERNAME
				</td>
				<td align="left">
					: <b>'.$e_nis.'</b>
				</td>
			</tr>
			
			<tr valign="top">
				<td width="100" align="left">
					PASSWORD
				</td>
				<td align="left">
					: <b>'.$e_passx2.'</b>
				</td>
			</tr>
		</table>
			

		</td>
	</tr>
</table>';
	
 * 
 */






//isi
$isi = ob_get_contents();
ob_end_clean();



//echo $isi;





$dompdf->loadHtml($isi);

// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('siswa-'.$e_nis.'.pdf');
?>