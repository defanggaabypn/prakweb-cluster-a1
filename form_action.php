<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id       = stripslashes(strip_tags(htmlspecialchars($_POST['id'] ,ENT_QUOTES)));
$nim      = stripslashes(strip_tags(htmlspecialchars($_POST['nim'] ,ENT_QUOTES)));
$nama     = stripslashes(strip_tags(htmlspecialchars($_POST['nama'] ,ENT_QUOTES)));
$prodi    = stripslashes(strip_tags(htmlspecialchars($_POST['prodi'] ,ENT_QUOTES)));
$angkatan = stripslashes(strip_tags(htmlspecialchars($_POST['angkatan'] ,ENT_QUOTES)));

if ($id == "") {
	$query  = "INSERT into tbl_mahasiswa (nim, nama, prodi, angkatan) VALUES (?, ?, ?, ?)";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("ssss", $nim, $nama, $prodi, $angkatan);
	$dewan1->execute();
} else {
	$query  = "UPDATE tbl_mahasiswa SET nim=?, nama=?, prodi=?, angkatan=? WHERE id=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("ssssi", $nim, $nama, $prodi, $angkatan, $id);
	$dewan1->execute();
}

echo json_encode(['success' => 'Sukses']);

$db1->close();
?>