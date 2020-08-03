<?php
session_start();

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/siswa.php");
require("../inc/class/paging.php");
$tpl = LoadTpl("../template/siswa.html");

nocache;

//nilai
$filenya = "soal.php";
$judul = "[SOAL YANG DIKERJAKAN]...";
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


$sesiku = $kd61_session;


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///ke index
if ($_POST['btnDF'])
	{
	//re-direct
	$ke = "index.php";
	xloc($ke);
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//require
require("../template/js/jumpmenu.js");
require("../template/js/swap.js");
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

echo '<form action="'.$filenya.'" method="post" name="formxx"><p>
<input name="jkd" type="hidden" value="'.$jkd.'">
<input name="btnDF" type="submit" value="KEMBALI KE BERANDA >" class="btn btn-danger">
</p>
<br>

</form>';





$limit = 50;




//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../template/adminlte/dist/css/skins/skins-biasawae.css">
	
	
	
	


  
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
mysqli_free_result($qku);
$u_waktu = balikin($rku['waktu']);
$u_pukul = balikin($rku['pukul']);
$u_durasi = balikin($rku['durasi']);
$u_mapel = balikin($rku['mapel']);
$u_tingkat = balikin($rku['tingkat']);
$u_proses = balikin($rku['proses']);



//jumlah soal
$qjml = mysqli_query($koneksi, "SELECT * FROM m_soal ".
						"WHERE jadwal_kd = '$jkd' ".
						"ORDER BY round(no) ASC");
$tjml = mysqli_num_rows($qjml);	
	
	
	

//yg dikerjakan...
$qyuk = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
						"WHERE siswa_kd = '$sesiku' ".
						"AND jadwal_kd = '$jkd' ".
						"AND jawab <> ''");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_dikerjakan = mysqli_num_rows($qyuk);


//jika lebih, itu tjml
if ($yuk_dikerjakan > $tjml)
	{
	$yuk_dikerjakan = $tjml;
	}

?>


<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

		$.ajax({
			url: "<?php echo $sumber;?>/ujian/i_timer.php?aksi=sisawaktu&jkd=<?php echo $jkd;?>&skd=<?php echo $sesiku;?>",
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){					
				$("#sisawaktu").html(data);
				}
			});
			
			






		$.ajax({
			url: "<?php echo $sumber;?>/ujian/i_timer.php?aksi=setpostdate&jkd=<?php echo $jkd;?>&skd=<?php echo $sesiku;?>",
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){					
				$("#setpostdate").html(data);
				}
			});
			
			





		
		setInterval(poll,1000);
		
		function poll()
			{
			$.ajax({
				url: "<?php echo $sumber;?>/ujian/i_jawabku.php?aksi=form&jkd=<?php echo $jkd;?>&skd=<?php echo $sesiku;?>",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){					
					$("#jawabanku").html(data);
					}
				});
			}
		


		
});

</script>


      <div class="row">

        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-edit"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?php echo $u_mapel;?> [<?php echo $tjml;?> Soal]</span>
              <span class="info-box-number">
              
				<?php
				echo '<p>
				[<b>'.$u_waktu.'</b>]. [<b>'.$u_pukul.'</b>]. [<b>'.$u_durasi.' Menit</b>].
				</p>';
				?>

              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->



        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-education"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Telah Dikerjakan</span>
              <span class="info-box-number">
              <div id="udahjawab">
              	<b><?php echo $yuk_dikerjakan;?></b>
				</div>

              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->




        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-time"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sisa Waktu</span>
              <span class="info-box-number">
              <div id="sisawaktu"></div>
              <div id="setpostdate"></div>

              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        




       </div>
      <!-- /.row -->


              
				
<?php



echo '</form>
<hr>';




	
//jml soal yg ada
$qyuk7 = mysqli_query($koneksi, "SELECT * FROM m_soal ".
						"WHERE jadwal_kd = '$jkd'");
$ryuk7 = mysqli_fetch_assoc($qyuk7);
$tyuk7 = mysqli_num_rows($qyuk7);




//yg dijawab
$qyuk8 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
						"WHERE siswa_kd = '$sesiku' ".
						"AND jadwal_kd = '$jkd' ".
						"AND jawab <> ''");
$ryuk8 = mysqli_fetch_assoc($qyuk8);
$tyuk8 = mysqli_num_rows($qyuk8);






//yg dijawab
$xyzz = md5("$jkd$sesiku");


//insert
mysqli_query($koneksi, "INSERT INTO siswa_soal_nilai(kd, siswa_kd, jadwal_kd, waktu_mulai, postdate) VALUES ".
				"('$xyzz', '$sesiku', '$jkd', '$today', '$today')");

					



//jika udah semua... ///////////////////////////////////////////////////////////////////////////////////
if ($tyuk7 <= $tyuk8)
	{
	//hitung yg benar
	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
							"WHERE siswa_kd = '$sesiku' ".
							"AND jadwal_kd = '$jkd' ".
							"AND benar = 'true'");
	$ryuk2 = mysqli_fetch_assoc($qyuk2);
	$jml_benar = mysqli_num_rows($qyuk2);
	$jml_salah = $tyuk7 - $jml_benar; 


	//update
	mysqli_query($koneksi, "UPDATE siswa_soal_nilai SET jml_benar = '$jml_benar', ".
					"jml_salah = '$jml_salah', ".
					"postdate = '$today' ".
					"WHERE siswa_kd = '$sesiku' ".
					"AND jadwal_kd = '$jkd'");
	?>



        <!-- /.col -->
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-duplicate"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rekap Jawaban</span>
              <span class="info-box-number">
              [Benar : <font color="green"><?php echo $jml_benar;?></font>].
              [Salah : <font color="red"><?php echo $jml_salah;?></font>]. 

              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
	<?php
	}



else		

	{
	
	?>




	<style>
	
	
	#myfooter{
	   position: fixed;
	   left: 0;
	   bottom: 0;
	  height: 6em;
	  background-color: #f5f5f5;
	  text-align: center;
	   width: 100%;
	   color: green;;
	
	}
	
	
	
	
	</style>
	




	   <!-- /.col -->
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-pushpin"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PERHATIAN</span>
              <span class="info-box-number">
              Pastikan semua soal telah dikerjakan, selanjutnya bisa tekan tombol "Selesai Mengerjakan". Terima Kasih.  

              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        



	<div id="myfooter">

	   <!-- /.col -->
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <div class="info-box-content">
              <span class="info-box-text">DIJAWAB</span>
              <span class="info-box-number">
              
              <div id="jawabanku"></div>  

              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       	 
	</div>

	<?php
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
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
	
	
	echo "&nbsp;";
	
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
		$i_kunci = balikin($data['kunci']);
		$i_isi = balikin($data['isi']);
		$i_postdate = balikin($data['postdate']);

		
		//yg dijawab
		$qyuk = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
								"WHERE siswa_kd = '$sesiku' ".
								"AND jadwal_kd = '$jkd' ".
								"AND soal_kd = '$i_kd'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		mysqli_free_result($qyuk);
		$yuk_kdku = nosql($ryuk['kd']);
		$yuk_jawabku = balikin($ryuk['jawab']);
		
		
		
		
		//nilai
		$xyz = md5("$sesiku$jkd$i_kd");
		

		//insert
		mysqli_query($koneksi, "INSERT INTO siswa_soal(kd, jadwal_kd, siswa_kd, soal_kd, jawab, postdate) VALUES ".
						"('$xyz', '$jkd', '$sesiku', '$i_kd', '', '$today')");

								
		?>
			<script language='javascript'>
		//membuat document jquery
		$(document).ready(function(){
						
			$('#xpilih<?php echo $nomer;?>').change(function() {
				var nilku = $(this).val();


				$('#iproses<?php echo $i_kd;?>').show();
				
				$.ajax({
					url: "<?php echo $sumber;?>/ujian/i_jawab.php?aksi=simpan&jkd=<?php echo $jkd;?>&skd=<?php echo $sesiku;?>&soalkd=<?php echo $i_kd;?>&nilku="+nilku,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){				
						$("#ihasil<?php echo $nomer;?>").html(data);
						$('#iproses<?php echo $i_kd;?>').hide();
						}
					});
				
				
				
				
				$.ajax({
					url: "<?php echo $sumber;?>/ujian/i_jawab.php?aksi=hitung&jkd=<?php echo $jkd;?>&skd=<?php echo $sesiku;?>&soalkd=<?php echo $i_kd;?>&nilku="+nilku,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#udahjawab").html(data);
						}
					});
				

				
				$.ajax({
					url: "<?php echo $sumber;?>/ujian/i_timer.php?aksi=setpostdate&jkd=<?php echo $jkd;?>&skd=<?php echo $sesiku;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#setpostdate").html(data);
						}
					});
					
				
		    });


				
		});
		
		</script>




		<?php

		echo '<a name="ku'.$i_kd.'"></a>
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">NO</font></strong></td>
		<td><strong><font color="'.$warnatext.'">SOAL</font></strong></td>
		</tr>
		</thead>
		<tbody>';
				
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td align="center">'.$i_no.'.</td>
		<td>
		'.$i_isi.'
		
		<hr>
		
		<p>
		 
		<form name="xformx'.$nomer.'" id="xformx'.$nomer.'">
		Jawab : <select name="xpilih'.$nomer.'" id="xpilih'.$nomer.'" class="btn btn-warning">
					<option value="'.$yuk_jawabku.'" selected>'.$yuk_jawabku.'</option>	
					<option value="A">A</option>	
					<option value="B">B</option>	
					<option value="C">C</option>	
					<option value="D">D</option>	
					<option value="E">E</option>	
					</select>			
		
		</p>		
		</form>
				
		<div id="iproses'.$i_kd.'" style="display:none">
			<img src="'.$sumber.'/template/img/progress-bar.gif" width="100" height="16">
		</div>
		
		<div id="ihasil'.$nomer.'"></div>
		
		
		</td>
        </tr>
		</tbody>
	  	</table>
	  	</div>';
		}
	while ($data = mysqli_fetch_assoc($result));
	



				
	?>
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
		
		$("#btnSELESAI").on('click', function(){
			
			$("#xformselesai").submit(function(){
				$.ajax({
					url: "<?php echo $sumber;?>/ujian/i_jawab.php?aksi=selesai&jkd=<?php echo $jkd;?>&skd=<?php echo $sesiku;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#iprosesku").show();
						$("#ihasilselesai").html(data);
						}
					});
				return false;
			});
		
		
		});	


			
	});
	
	</script>


	<?php
		
	
	echo '<br>
	<div id="ihasilselesai"></div>
	<div id="iprosesku" style="display:none">
		<img src="'.$sumber.'/template/img/progress-bar.gif" width="100" height="16">
	</div>

	<form name="xformselesai" id="xformselesai">
	<hr>
	<input name="btnSELESAI" id="btnSELESAI" type="submit" class="btn btn-block btn-danger" value="SELESAI MENGERJAKAN.">
	<hr>
	
	</form>
	
	
	<br>
	<br>
	<br>';
	
	
	
	
	

	
	
	//jml soal yg ada
	$qyuk7 = mysqli_query($koneksi, "SELECT * FROM m_soal ".
							"WHERE jadwal_kd = '$jkd'");
	$ryuk7 = mysqli_fetch_assoc($qyuk7);
	$tyuk7 = mysqli_num_rows($qyuk7);


	
	//hitung yg benar
	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM siswa_soal ".
							"WHERE siswa_kd = '$sesiku' ".
							"AND jadwal_kd = '$jkd' ".
							"AND benar = 'true'");
	$ryuk2 = mysqli_fetch_assoc($qyuk2);
	$jml_benar = mysqli_num_rows($qyuk2);
	$jml_salah = $count - $jml_benar; 
	$xyzz = md5("$jkd$sesiku");


					

	//update
	mysqli_query($koneksi, "UPDATE siswa_soal_nilai SET jml_benar = '$jml_benar', ".
					"jml_salah = '$jml_salah', ".
					"postdate = '$today' ".
					"WHERE siswa_kd = '$sesiku' ".
					"AND jadwal_kd = '$jkd'");
	}	






//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//null-kan

xclose($koneksi);
exit();
?>