<?php
include 'koneksi.php';

  $nrp = $_POST['nrp'];
  $nama   = $_POST['nama'];
  $alamat     = $_POST['alamat'];
  $id_jur   = $_POST['id_jur'];
  $foto = $_FILES['foto']['name'];
  if($foto != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); 
    $x = explode('.', $foto); 
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$foto; 
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); 
                      
            
                   $query  = "UPDATE mahasiswa SET nama = '$nama', alamat = '$alamat', id_jur = '$id_jur', foto = '$nama_gambar_baru'";
                    $query .= "WHERE nrp = '$nrp'";
                    $result = mysqli_query($koneksi, $query);
         
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                     
                      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                    }
              } else {     
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
              }
    } else {
      $query  = "UPDATE mahasiswa SET nama = '$nama', alamat = '$alamat', id_jur = '$id_jur'";
      $query .= "WHERE nrp = '$nrp'";
      $result = mysqli_query($koneksi, $query);
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
          echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
      }
    }
