<?php
include 'koneksi.php';
include 'tambah_data.php';

  $nrp      = $_POST['nrp'];
  $nama     = $_POST['nama'];
  $alamat   = $_POST['alamat'];
  $nama_jur = $_POST['nama_jur'];
  $foto     = $_FILES['foto']['name'];


if($foto != "") {
  $ekstensi_diperbolehkan = array('png','jpg');
  $x                      = explode('.', $foto);
  $ekstensi               = strtolower(end($x));
  $file_tmp               = $_FILES['foto']['tmp_name'];
  $angka_acak             = rand(1,999);
  $nama_gambar_baru       = $angka_acak.'-'.$foto;
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru);
                  $query  = "INSERT INTO mahasiswa (nrp, nama, alamat, nama_jur, foto) VALUES ('$nrp', '$nama', '$alamat', '$nama_jur', '$foto')";
                  $result = mysqli_query($koneksi, $query);
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }

            } else {     
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
            }
} else {
   $query  = "INSERT INTO mahasiswa (nrp, nama, alamat, nama_jur, foto) VALUES ($nrp', '$nama', '$alamat', '$nama_jur', '$foto', null)";
   $result = mysqli_query($koneksi, $query);
    
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }
}
