<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id     = $_POST['id'];
$query  = "SELECT * FROM tbl_mahasiswa WHERE id=? ORDER BY id DESC";
$dewan1 = $db1->prepare($query);
$dewan1->bind_param('i', $id);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    $h['id']       = $row["id"];
    $h['nim']      = $row["nim"];
    $h['nama']     = $row["nama"];
    $h['prodi']    = $row["prodi"];
    $h['angkatan'] = $row["angkatan"];
}
echo json_encode($h);

$db1->close();
?>