<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Modul 7</title>
    <style type = "text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color         : salmon;
      }
    table {
      border         : solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing : 0;
      width          : 70%;
      margin         : 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border          : solid 1px #DDEEEE;
        color           : #336B6B;
        padding         : 10px;
        text-align      : left;
        text-shadow     : 1px 1px 1px #fff;
        text-decoration : none;
    }
    table tbody td {
        border     : solid 1px #DDEEEE;
        color      : #333;
        padding    : 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: salmon;
          color           : #fff;
          padding         : 10px;
          text-decoration : none;
          font-size       : 12px;
    }
    </style>
  </head>
  <body>
    <center><h1>Biodata Mahasiswa</h1><center>
    <center><a href = "tambah_data.php">+ &nbsp; Tambah Data</a><center>
    <br/>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>NRP</th>
          <th>NAMA</th>
          <th>ALAMAT </th>
          <th>JURUSAN</th>
          <th>FOTO</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM mahasiswa 
                INNER JOIN jurusan ON mahasiswa.id_jur = jurusan.id_jur
      ";
  
      $result = mysqli_query($koneksi, $query);
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }

      $no = 1;
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nrp']; ?></td>
          <td><?php echo $row['nama']; ?></td>
          <td><?php echo $row['alamat']; ?></td>
          <td><?php echo $row['nama_jur']; ?></td>
          <td style = "text-align: center;"><img src = "gambar/<?php echo $row['foto']; ?>" style = "width: 120px;"></td>
          <td>
              <a href = "edit.php?id=<?php echo $row['nrp']; ?>">Edit</a> |
              <a href = "proses_hapus.php?id=<?php echo $row['nrp']; ?>" onclick = "return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
      </tr>
         
      <?php
        $no++; 
      }
      ?>
    </tbody>
    </table>
    <br>
    <center><a href = "cari_data.php">+ &nbsp; Cari Data</a><center>
  </body>
</html>