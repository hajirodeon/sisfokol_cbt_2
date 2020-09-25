<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admin.html");

nocache;

//nilai
$filenya = "lap_hasil_ujian.php";
$judul = "[LAPORAN] Hasil Ujian";
$judulku = "$judul";
$judulx = $judul;
$jkd = nosql($_REQUEST['jkd']);
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


$limit = 1000;







require '../../inc/class/phpofficeexcel/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika ke daftar
if ($_POST['btnDF'])
	{
	//re-direct
	$ke = "lap.php";
	xloc($ke);
	exit();
	}






//nek batal
if ($_POST['btnBTL'])
	{
	//nilai
	$jkd = nosql($_POST['jkd']);

	//re-direct
	$ke = "$filenya?jkd=$jkd";
	xloc($ke);
	exit();
	}





//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$jkd = nosql($_POST['jkd']);	
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?jkd=$jkd&kunci=$kunci";
	xloc($ke);
	exit();
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//jika excel
if ($s == "excel")
	{
	//detail jkd jadwal
	$qku = mysqli_query($koneksi, "SELECT * FROM m_jadwal ".
							"WHERE kd = '$jkd'");
	$rku = mysqli_fetch_assoc($qku);
	$u_waktu = balikin($rku['waktu']);
	$u_pukul = balikin($rku['pukul']);
	$u_durasi = balikin($rku['durasi']);
	$u_mapel = balikin($rku['mapel']);
	$u_tingkat = balikin($rku['tingkat']);
	$u_soal_jml = balikin($rku['soal_jml']);
	



	

	//nama file e...
	$i_pecahku = seo_friendly_url("hasilujian-$u_waktu-$u_mapel-$u_tingkat");
	$i_filename = "$i_pecahku.xls";
	$i_judul = "HasilUjian";
	





	//bikin...
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setCellValue('A1', 'NO');
	$sheet->setCellValue('B1', 'SOAL');
	$sheet->setCellValue('C1', 'DIKERJAKAN');
	$sheet->setCellValue('D1', 'BENAR');
	$sheet->setCellValue('E1', 'SALAH');
	$sheet->setCellValue('F1', 'NILAI');

	$i = 2;		
	$no = 1;


	//query	
	$qyukx = mysqli_query($koneksi, "SELECT * FROM m_soal ".
							"WHERE jadwal_kd = '$jkd' ".
							"ORDER BY round(no) ASC");
	$ryukx = mysqli_fetch_assoc($qyukx);

	do 
		{
		$i_kd = nosql($ryukx['kd']);
		$i_no = balikin($ryukx['no']);
		$dt_nox = $dt_nox + 1;
				 
		//detail nilai
		$qmboh = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
								"WHERE jadwal_kd = '$jkd' ".
								"AND soal_kd = '$i_kd'");
		$rmboh = mysqli_fetch_assoc($qmboh);
		$mboh_total = mysqli_num_rows($qmboh);

		
		//detail nilai
		$qmboh2 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
								"WHERE jadwal_kd = '$jkd' ".
								"AND soal_kd = '$i_kd' ".
								"AND benar = 'true'");
		$rmboh2 = mysqli_fetch_assoc($qmboh2);
		$mboh_jml_benar = mysqli_num_rows($qmboh2);
		
		
		//detail nilai
		$qmboh3 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
								"WHERE jadwal_kd = '$jkd' ".
								"AND soal_kd = '$i_kd' ".
								"AND benar = 'false'");
		$rmboh3 = mysqli_fetch_assoc($qmboh3);
		$mboh_jml_salah = mysqli_num_rows($qmboh3);
		
		
		
		//total siswa
		$mboh_total = $mboh_jml_benar + $mboh_jml_salah;
		
		//nilai
		$mboh_nilai = round(($mboh_jml_benar / $mboh_total) * 100,2);
				 

		$i_nox = "NOMOR $i_no";		
			
			  
		//ciptakan
		$sheet->setCellValue('A'.$i, $no++);
		$sheet->setCellValue('B'.$i, $i_nox);
		$sheet->setCellValue('C'.$i, $mboh_total);
		$sheet->setCellValue('D'.$i, $mboh_jml_benar);
		$sheet->setCellValue('E'.$i, $mboh_jml_salah);
		$sheet->setCellValue('F'.$i, $mboh_nilai);
		$i++;					
		}
	while ($ryukx = mysqli_fetch_assoc($qyukx));
		
	
	//tulis
	$targetfileku = "../../filebox/excel/$i_filename";
	$writer = new Xlsx($spreadsheet);
	$writer->save($targetfileku);
		
	


		
	//download
	header('Content-Type: Application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="'.$i_filename.'"');
	$writer->save('php://output');
		

	//hapus file, jika telah import
	$path1 = "../../filebox/excel/$i_filename";
	chmod($path1,0777);
	unlink ($path1);

	
	//re-direct
	//exit
	xclose($koneksi);
	$ke = "$filenya?jkd=$jkd";
	xloc($ke);
	exit();
	}



else
	{		
	//isi *START
	ob_start();
	
	
	//require
	require("../../template/js/jumpmenu.js");
	require("../../template/js/checkall.js");
	require("../../template/js/swap.js");
	?>
	
	  
	  <script>
	$(document).ready(function() {
	$('#table-responsive').dataTable( {
	"scrollX": true
	    } );
	} );
	  </script>
	  
	<?php
	//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//detail jkd jadwal
	$qku = mysqli_query($koneksi, "SELECT * FROM m_jadwal ".
							"WHERE kd = '$jkd'");
	$rku = mysqli_fetch_assoc($qku);
	$u_waktu = balikin($rku['waktu']);
	$u_pukul = balikin($rku['pukul']);
	$u_durasi = balikin($rku['durasi']);
	$u_mapel = balikin($rku['mapel']);
	$u_tingkat = balikin($rku['tingkat']);
	$u_soal_jml = balikin($rku['soal_jml']);
	$u_postdate_mulai = balikin($rku['postdate_mulai']);
	$u_postdate_selesai = balikin($rku['postdate_selesai']);
	
	
	
	
	echo '<form action="'.$filenya.'" method="post" name="formxx">
	
	<p>
	[<b>'.$u_waktu.'</b>]. [<b>'.$u_pukul.'</b>]. [<b>'.$u_durasi.' Menit</b>].
	</p>
	
	<p>
	Mapel : <b>'.$u_mapel.'</b>, Kelas : <b>'.$u_tingkat.'</b>
	</p>
	
	
	<p>
	Mulai : <b>'.$u_postdate_mulai.'</b>, Selesai : <b>'.$u_postdate_selesai.'</b>
	</p>
	
	
	
	<p>
	<input name="jkd" type="hidden" value="'.$jkd.'">
	<input name="btnDF" type="submit" value="LIHAT JADWAL LAIN >" class="btn btn-danger">
	</p>
	<br>
	
	</form>
	
	
	
	
	
	
	
	
	<form action="'.$filenya.'" method="post" name="formxx">';
	
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM m_soal ".
					"WHERE jadwal_kd = '$jkd' ".
					"ORDER BY round(no) ASC";
	
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?jkd=$jkd";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
		
	
	echo '<hr>
	<p>
	<input name="s" type="hidden" value="'.$s.'">
	<input name="jkd" type="hidden" value="'.$jkd.'">
	
	</p>
		
		
	
	
	 
	<a href="'.$filenya.'?s=excel&jkd='.$jkd.'" class="btn btn-success">EXPORT EXCEL >></a>
		
	<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td><strong><font color="'.$warnatext.'">SOAL</font></strong></td>
	<td width="100"><strong><font color="'.$warnatext.'">DIKERJAKAN</font></strong></td>
	<td width="100"><strong><font color="'.$warnatext.'">BENAR</font></strong></td>
	<td width="100"><strong><font color="'.$warnatext.'">SALAH</font></strong></td>
	<td width="100"><strong><font color="'.$warnatext.'">NILAI</font></strong></td>
	</tr>
	</thead>
	<tbody>';
	
	if ($count != 0)
		{
		do 
			{
			if ($warna_set ==0)
				{
				$warna = $warna01;
				$warna_set = 1;
				}
			else
				{
				$warna = $warna02;
				$warna_set = 0;
				}
	
			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_no = balikin($data['no']);
			
			
			//detail nilai
			$qmboh = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
									"WHERE jadwal_kd = '$jkd' ".
									"AND soal_kd = '$i_kd'");
			$rmboh = mysqli_fetch_assoc($qmboh);
			$mboh_total = mysqli_num_rows($qmboh);

			
			//detail nilai
			$qmboh2 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
									"WHERE jadwal_kd = '$jkd' ".
									"AND soal_kd = '$i_kd' ".
									"AND benar = 'true'");
			$rmboh2 = mysqli_fetch_assoc($qmboh2);
			$mboh_jml_benar = mysqli_num_rows($qmboh2);
			
			
			//detail nilai
			$qmboh3 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
									"WHERE jadwal_kd = '$jkd' ".
									"AND soal_kd = '$i_kd' ".
									"AND benar = 'false'");
			$rmboh3 = mysqli_fetch_assoc($qmboh3);
			$mboh_jml_salah = mysqli_num_rows($qmboh3);
			
			
			
			//total siswa
			$mboh_total = $mboh_jml_benar + $mboh_jml_salah;
			
			//nilai
			$mboh_nilai = round(($mboh_jml_benar / $mboh_total) * 100,2);
			
			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>Nomor Soal '.$i_no.'</td>
			<td>
			<b>'.$mboh_total.'</b> Siswa
			</td>
			
			<td>
			<b>'.$mboh_jml_benar.'</b> Siswa
			</td>
			
			<td>
			<b>'.$mboh_jml_salah.'</b> Siswa
			</td>
			
			<td>'.$mboh_nilai.'</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	
	
	echo '</tbody>
	  </table>
	  </div>
	
	
	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	
	<input name="jml" type="hidden" value="'.$count.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="page" type="hidden" value="'.$page.'">
	</td>
	</tr>
	</table>
	</form>';
	
	
	
	
	
	//isi
	$isi = ob_get_contents();
	ob_end_clean();
	
	require("../../inc/niltpl.php");
	}





//null-kan
xclose($koneksi);
exit();
?>