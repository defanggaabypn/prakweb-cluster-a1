<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
            <td>NIM</td>
            <td>Nama</td>
            <td>Prodi</td>
            <td>Angkatan</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'koneksi.php';
            $no     = 1;
            $query  = "SELECT * FROM tbl_mahasiswa ORDER BY id DESC";
            $dewan1 = $db1->prepare($query);
            $dewan1->execute();
            $res1 = $dewan1->get_result();

            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    $id       = $row['id'];
                    $nim      = $row['nim'];
                    $nama     = $row['nama'];
                    $prodi    = $row['prodi'];
                    $angkatan = $row['angkatan'];
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $nim; ?></td>
            <td><?php echo $nama; ?></td>
            <td><?php echo $prodi; ?></td>
            <td><?php echo $angkatan; ?></td>
            <td>
                <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data"> <i class="fa fa-edit"></i>
                    Edit </button>
                <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i>
                    Hapus </button>
            </td>
        </tr>
        <?php } } else { ?>
        <tr>
            <td colspan='7'>Tidak ada data ditemukan</td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });

    function reset() {
        document.getElementById("err_nim").innerHTML = "";
        document.getElementById("err_nama").innerHTML = "";
        document.getElementById("err_prodi").innerHTML = "";
        document.getElementById("err_angkatan").innerHTML = "";
    }

    $(document).on('click', '.edit_data', function () {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "get_data.php",
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                reset();
                document.getElementById("id").value = response.id;
                document.getElementById("nim").value = response.nim;
                document.getElementById("nama").value = response.nama;
                document.getElementById("prodi").value = response.prodi;
                document.getElementById("angkatan").value = response.angkatan;
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function () {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "hapus_data.php",
            data: {
                id: id
            },
            success: function () {
                $('.data').load("data.php");
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    });
</script>