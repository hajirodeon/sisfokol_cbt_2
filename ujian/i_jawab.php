<?php
session_start();

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
	




$filenyax = "$sumber/ujian/i_jawab.php";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//ambil nilai
	$skd = trim(cegah($_GET['skd']));
	$jkd = trim(cegah($_GET['jkd']));
	$nilku = trim(cegah($_GET['nilku']));
	$soalkd = trim(cegah($_GET['soalkd']));
	

	
	
	//nilai
	$xyz = md5("$skd$jkd$soalkd");
	
	
	
	
	//baca kunci...
	$qku = mysqli_query($koneksi, "SELECT * FROM m_soal ".
						"WHERE jadwal_kd = '$jkd' ".
						"AND kd = '$soalkd'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_kunci = balikin($rku['kunci']); 
	
	
		
	//hapus dulu yg lama...
	mysqli_query($koneksi, "DELETE FROM siswa_soal ".
						"WHERE siswa_kd = '$skd' ".
						"AND jadwal_kd = '$jkd' ".
						"AND soal_kd = '$soalkd'");
	
	
	
	//jika benar
	if ($nilku == $ku_kunci)
		{
		$ku_benar = "true";
		}
	else if ($nilku <> $ku_kunci)
		{
		$ku_benar = "false";
		}
	
	
	
	//insert
	mysqli_query($koneksi, "INSERT INTO siswa_soal(kd, jadwal_kd, siswa_kd, ".
								"soal_kd, jawab, kunci, benar, postdate) VALUES ".
								"('$xyz', '$jkd', '$skd', ".
								"'$soalkd', '$nilku', '$ku_kunci', '$ku_benar', '$today')");

	
	

	//re-direct, kerjakan lainnya...
	$ke = "soal.php?jkd=$jkd";
	xloc($ke);
	exit();
	}
	









//jika selesai
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'selesai'))
	{
	//ambil nilai
	$skd = trim(cegah($_GET['skd']));
	$jkd = trim(cegah($_GET['jkd']));

	$tablenya2 = "siswa_soal";
	$tablenilai2 = "siswa_soal_nilai";


	
	
	//semua
	$qyuk1 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
							"WHERE siswa_kd = '$skd' ".
							"AND jadwal_kd = '$jkd')");
	$ryuk1 = mysqli_fetch_assoc($qyuk1);
	$jml_semua = mysqli_num_rows($qyuk1);
	
	
	
	
	//hitung benar
	$qyuk1 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
							"WHERE siswa_kd = '$skd' ".
							"AND jadwal_kd = '$jkd' ".
							"AND benar = 'true')");
	$ryuk1 = mysqli_fetch_assoc($qyuk1);
	$jml_benar = mysqli_num_rows($qyuk1);
	$jml_salah = $jml_semua - $jml_benar;
	



	//jika ada yg belum dikerjakan
	$qcc = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
							"WHERE siswa_kd = '$skd' ".
							"AND jadwal_kd = '$jkd' ".
							"AND jawab = ''");
	$tcc = mysqli_num_rows($qcc);
	

	//jika iya
	if (!empty($tcc))
		{
		//re-direct
		echo "<h3><font color=red>
		Masih Ada Soal Yang Belum Dikerjakan. Silahkan Dicek Lagi...!!
		</font>
		</h3>";
		
		//null-kan
		mysqli_free_result();
		xclose($koneksi);		
		exit();
		}
		
	else
		{
		//hitung jumlah yg dikerjakan
		$qyuk = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
								"WHERE siswa_kd = '$skd' ".
								"AND jadwal_kd = '$jkd' ".
								"AND jawab <> ''");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
		
		
	
	
		//update nilai
		mysqli_query($koneksi, "UPDATE siswa_soal_nilai SET waktu_selesai = '$today', ".
						"jml_soal_dikerjakan = '$tyuk', ".
						"jml_benar = '$jml_benar', ".
						"jml_salah = '$jml_salah' ".
						"WHERE siswa_kd = '$skd' ".
						"AND jadwal_kd = '$jkd'");

					
						
	
		//null-kan
		mysqli_free_result();
		xclose($koneksi);
		
		//re-direct
		$ke = "soal.php?jkd=$jkd";
		xloc($ke);
		exit();
		}


	//null-kan
	mysqli_free_result();
	xclose($koneksi);
	exit();
	}
	






//jika hitung
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'hitung'))
	{
	//ambil nilai
	$skd = trim(cegah($_GET['skd']));
	$jkd = trim(cegah($_GET['jkd']));
	$nilku = trim(cegah($_GET['nilku']));
	$soalkd = trim(cegah($_GET['soalkd']));
	
	$tablenya = "siswa_soal";
	$tablenilai = "siswa_soal_nilai";
	
	
	
	
	//jml soal yg ada
	$qyuk7 = mysqli_query($koneksi, "SELECT * FROM m_soal ".
							"WHERE jadwal_kd = '$jkd'");
	$ryuk7 = mysqli_fetch_assoc($qyuk7);
	$tyuk7 = mysqli_num_rows($qyuk7);
	
	
	

	
	//yg dijawab
	$qyuk = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
							"WHERE siswa_kd = '$skd' ".
							"AND jadwal_kd = '$jkd' ".
							"AND jawab <> ''");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$tyuk = mysqli_num_rows($qyuk);
	
		

	echo '<font color="green">
		<b>'.$tyuk.'</b> 
	
	</font>';




	/*
	//hitung yg benar
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM m_soal ".
							"WHERE jadwal_kd = '$jkd' ".
							"ORDER BY round(no) ASC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);

	do 
		{
		$i_kd = nosql($ryuk21['kd']);
		$i_no = balikin($ryuk21['no']);
		$i_isi = balikin($ryuk21['isi']);
		$i_kunci = balikin($ryuk21['kunci']);
		$i_postdate = balikin($ryuk21['postdate']);

		
		//yg dijawab
		$qyuk = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
								"WHERE siswa_kd = '$skd' ".
								"AND jadwal_kd = '$jkd' ".
								"AND soal_kd = '$i_kd'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$yuk_kd = nosql($ryuk['kd']);
		$yuk_jawabku = balikin($ryuk['jawab']);
		
		
		//jika benar, true
		if ($i_kunci == $yuk_jawabku)
			{
			$setjawab = "true";	
			}
					
		else if ($i_kunci <> $yuk_jawabku)
			{
			$setjawab = "false";	
			}
			


		//update
		mysqli_query($koneksi, "UPDATE $tablenya SET kunci = '$i_kunci', ".
						"benar = '$setjawab' ".
						"WHERE kd = '$yuk_kd'");
		}
	while ($data = mysqli_fetch_assoc($result));

	







	//jika udah semua...
	if ($tyuk7 == $tyuk)
		{
		//hitung yg benar
		$qyuk2 = mysqli_query($koneksi, "SELECT * FROM $tablenya ".
								"WHERE jadwal_kd = '$jkd' ".
								"AND benar = 'true'");
		$ryuk2 = mysqli_fetch_assoc($qyuk2);
		$jml_benar = mysqli_num_rows($qyuk2);
		$jml_salah = $count - $jml_benar; 
		$xyzz = md5("$jkd$kd61_session");
	
		
		
		//update
		mysqli_query($koneksi, "UPDATE $tablenilai SET jml_benar = '$jml_benar', ".
						"jml_salah = '$jml_salah', ".
						"postdate = '$today' ".
						"WHERE jadwal_kd = '$jkd'");


		//null-kan
		mysqli_free_result();
		xclose($koneksi);
		exit();
		}
		
	*/




	
	//null-kan
	mysqli_free_result();
	xclose($koneksi);
	exit();
	}
	
	
	

//null-kan
mysqli_free_result();
xclose($koneksi);
exit();
?>