<?php
include 'koneksi.php';
$id = $_GET["id"];

    $query       = "DELETE FROM mahasiswa WHERE nrp='$id' ";
    $hasil_query = mysqli_query($koneksi, $query);

    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_error($koneksi).
       " - ".mysqli_error($koneksi));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>";
    }