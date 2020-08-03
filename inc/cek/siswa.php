<?php
///cek session //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$kd61_session = cegah($_SESSION['kd61_session']);
$username61_session = cegah($_SESSION['username61_session']);
$siswa_session = balikin($_SESSION['siswa_session']);
$pass61_session = cegah($_SESSION['pass61_session']);
$hajirobe_session = cegah($_SESSION['hajirobe_session']);

$qbw = mysqli_query($koneksi, "SELECT kd FROM siswa ".
						"WHERE kd = '$kd61_session' ".
						"AND usernamex = '$username61_session' ".
						"AND passwordx = '$pass61_session'");
$rbw = mysqli_fetch_assoc($qbw);
$tbw = mysqli_num_rows($qbw);

if (empty($tbw) OR (empty($kd61_session))
	OR (empty($username61_session))
	OR (empty($pass61_session))
	OR (empty($siswa_session))
	OR (empty($hajirobe_session)))
	{
	//re-direct
	$pesan = "ANDA BELUM LOGIN. SILAHKAN LOGIN DAHULU...!!!";
	pekem($pesan, $sumber);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>