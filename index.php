<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Minggu ke 6</title>
	<!-- Csrf Token -->
	<meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>">
	<!-- Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
		integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body>
	<nav class="navbar navbar-dark bg-danger">
		<a class="navbar-brand" href="index.php" style="color: #fff;">
			Defangga Aby Vonega 118140015
		</a>
	</nav>

	<div class="container">
		<h2 align="center" style="margin: 30px;">Praktikum Web Minggu ke 6 (AJAX)</h2>

		<form method="post" class="form-data" id="form-data">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>NIM</label>
						<input type="text" name="nim" id="nim" class="form-control" required="true">
						<p class="text-danger" id="err_nim"></p>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="form-group">
						<label>Nama Mahasiswa</label>
						<input type="hidden" name="id" id="id">
						<input type="text" name="nama" id="nama" class="form-control" required="true">
						<p class="text-danger" id="err_nama"></p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Prodi</label>
						<select name="prodi" id="prodi" class="form-control" required="true">
							<option value=""></option>
							<option value="Sistem Informasi">Aktuaria</option>
							<option value="Teknik Informatika">Teknik Informatika</option>
						</select>
						<p class="text-danger" id="err_prodi"></p>
					</div>
				</div>


				<div class="col-sm-3">
					<div class="form-group">
						<label>Angkatan</label>
						<select name="angkatan" id="angkatan" class="form-control" required="true">
							<option value=""></option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
						</select>
						<p class="text-danger" id="err_angkatan"></p>
					</div>
					<p class="text-danger" id="err_angkatan"></p>
				</div>
			</div>



			<div class="form-group">
				<button type="button" name="simpan" id="simpan" class="btn btn-primary">
					<i class="fa fa-save"></i> Simpan
				</button>
			</div>
		</form>
		<hr>

		<div class="data"></div>

	</div>

	<div class="text-center">© <?php echo date('Y'); ?> Copyright:
		<a href="#"> Defangga Aby Vonega</a>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- DataTable -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			//Send Token
			$.ajaxSetup({
				headers: {
					'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$('.data').load("data.php");
			$("#simpan").click(function () {
				var data = $('.form-data').serialize();
				var nim = document.getElementById("nim").value;
				var nama = document.getElementById("nama").value;
				var prodi = document.getElementById("prodi").value;
				var angkatan = document.getElementById("angkatan").value;

				if (nim == "") {
					document.getElementById("err_nim").innerHTML = "NIM Kamu Harus Diisi";
				} else {
					document.getElementById("err_nim").innerHTML = "";
				}
				if (nama == "") {
					document.getElementById("err_nama").innerHTML = "Nama Kamu Harus Diisi";
				} else {
					document.getElementById("err_nama").innerHTML = "";
				}
				if (prodi == "") {
					document.getElementById("err_prodi").innerHTML = "Prodi Kamu Harus Diisi";
				} else {
					document.getElementById("err_prodi").innerHTML = "";
				}
				if (angkatan == "") {
					document.getElementById("err_angkatan").innerHTML =
						"Angkatan Kamu Harus Diisi";
				} else {
					document.getElementById("err_angkatan").innerHTML = "";
				}

				if (nim != "" && nama != "" && prodi != "" && angkatan != "") {
					$.ajax({
						type: 'POST',
						url: "form_action.php",
						data: data,
						success: function () {
							$('.data').load("data.php");
							document.getElementById("id").value = "";
							document.getElementById("form-data").reset();
						},
						error: function (response) {
							console.log(response.responseText);
						}
					});
				}

			});
		});
	</script>
</body>

</html>