<!DOCTYPE html>
<html>

<head>
    <title>Cari Data</title>
    <style type = "text/css">
        * {
            font-family: "Trebuchet MS";
        }

        h1 {
            text-transform: uppercase;
            color         : salmon;
        }

        table {
            border         : 1px solid #ddeeee;
            border-collapse: collapse;
            border-spacing : 0;
            width          : 70%;
            margin         : 10px auto 10px auto;
        }

        th,
        td {
            border    : 1px solid #ddeeee;
            padding   : 20px;
            text-align: left;
        }
    </style>
</head>

<body>
    <center>
        <h1>Pencarian Data Mahasiswa</h1>
    </center>
    <form method = "GET" action = "index.php" style = "text-align: center;">
        <label>Kata Pencarian: </label>
        <input  type  = "text" name = "kata_cari"
                value = "<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>" />
        <button type  = "submit">Cari</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>NRP</th>
                <th>NAMA</th>
                <th>JURUSAN</th>
                <th>FOTO</th>
            </tr>
        </thead>
        <tbody>
            <?php 
			include('koneksi.php');

				if(isset($_GET['kata_cari'])) {
					$kata_cari = $_GET['kata_cari'];
					$query     = "SELECT * FROM mahasiswa WHERE nrp like '%".$kata_cari."%' ";
				} else {
					$query = "SELECT * FROM mahasiswa ";
				}
				

				$result = mysqli_query($koneksi, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
				}
				while ($row = mysqli_fetch_assoc($result)) {
			?>
            <tr>
                <td><?php echo $row['nrp']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['id_jur']; ?></td>
                <td style = "text-align: center;"><img src = "gambar/<?php echo $row['foto']; ?>" style = "width: 120px;"></td>
            </tr>
            <?php
			}
			?>

        </tbody>
    </table>
</body>

</html>