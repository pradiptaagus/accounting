<?php 
	include '../config/connection.php';

	// mengaktifkan session
	session_start();

	// cek apakah user sudah login atau belum
	// jika belum, user akan dialihkan ke halaman login
	if($_SESSION['status'] != 'login'){
		header("location:../view/login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Karyawan</title>
	<?php include 'asset_css.php' ?>
</head>
<body>
	<?php include "navigation.php" ?>
	
	<div class="container-fluid mt-3">
		<h3>Master Karyawan</h3>
		<div class="mb-3 mt-4">
			<button class="btn btn-primary ml-0" id="add-karyawan" data-toggle="modal" data-target="#add-user-modal"><i class="fa fa-plus mr-2"></i>Tambah User</button>
		</div>
		<div class="table-responsive">
			<table id="table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jabatan</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Hp</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="table-content">
					<tr>
						<td colspan="9" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td>
					</tr>         
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal Tambah User -->
	<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title">Tambah</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label for="nik-add">NIK <span class="text-danger">*</span></label>
						<input type="text" id="nik-add" name="nik-add" class="form-control" placeholder="NIK = Nomor Induk Karyawan" onblur="isEmpty('nik-add', 'nik-add-error', 'NIK')">
						<small id="nik-add-error" class="text-danger"></small>
						<small id="nik-add-success" class="text-success"></small>
					</div>
					<div class="mb-3">
						<label for="nama-add">Nama <span class="text-danger">*</span></label>
						<input type="text" id="nama-add" name="nama-add" class="form-control" onblur="isEmpty('nama-add', 'nama-add-error', 'Nama')">
						<small id="nama-add-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="username-add">Username <span class="text-danger">*</span></label>
						<input type="text" id="username-add" name="username-add" class="form-control" onblur="isEmpty('username-add', 'username-add-error', 'Username')">
						<small id="username-add-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="password-add">Password <span class="text-danger">*</span></label>
						<input type="password" id="password-add" name="password-add" class="form-control" onblur="isEmpty('password-add', 'password-add-error', 'Password')">
						<small id="password-add-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="jabatan-add">Jabatan <span class="text-danger">*</span></label>
						<select class="form-control" id="jabatan-add" onblur="isEmpty('jabatan-add', 'jabatan-add-error', 'Jabatan')">
							<option value="">- Pilih jabatan -</option>
							<?php 
								$sql = "SELECT * FROM tb_jabatan";
								$result = mysqli_query($db, $sql);
								while ($data = mysqli_fetch_assoc($result)) {
									echo 
									"<option value='".$data['id']."'>".$data['nama']."</option>";
								}
							?>
						</select>
						<small id="jabatan-add-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="tempat-lahir-add">Tempat Lahir</label>
						<input type="text" id="tempat-lahir-add" name="tempat-lahir-add" class="form-control">
						<small id="tempat-lahir-add-error"></small>
					</div>
					<div class="mb-3">
						<label for="tgl-lahir-add">Tanggal Lahir</label>
						<input type="date" id="tgl-lahir-add" name="tgl-lahir-add" class="form-control">
						<small id="tgl-lahir-add-error" class="text-danger"></small>
					</div>
					<hr style="border: 1px solid black">
					<h5>Alamat</h5>
					<div class="mb-3">
						<div class="mb-3">
							<label for="negara-add">Negara <span class="text-danger">*</span></label>
							<select class="form-control" id="negara-add" onblur="isEmpty('negara-add', 'negara-add-error', 'Negara')">
								<option value="">- Pilih negara -</option>
								<?php 
									$sql = "SELECT * FROM tb_negara";
									$result = mysqli_query($db, $sql);
									while ($data = mysqli_fetch_assoc($result)) {
										echo 
										"<option value='".$data['id']."'>".$data['nama']."</option>";
									}
								?>
							</select>
							<small class="text-danger" id="negara-add-error"></small>
						</div>
						
						<div class="mb-3 propinsi">
							<label for="propinsi-add">Propinsi <span class="text-danger">*</span></label>
							<select class="form-control" id="propinsi-add" onblur="isEmpty('propinsi-add', 'propinsi-add-error', 'Propinsi')">
								<option value="">- Pilih propinsi -</option>
							</select>
							<small class="text-danger" id="propinsi-add-error"></small>
						</div>
						
						<div class="mb-3 kab/kota">
							<label for="kota-add">Kabupaten/Kota <span class="text-danger">*</span></label>
							<select class="form-control" id="kota-add" onblur="isEmpty('kota-add', 'kota-add-error', 'Kabupaten/kota')">
								<option value="">- Pilih Kabupaten/Kota -</option>
							</select>
							<small class="text-danger" id="kota-add-error"></small>
						</div>

						<div class="mb-3">
							<label for="alamat-add">Alamat Spesifik <span class="text-danger">*</span></label>
							<input type="text" id="alamat-add" name="alamat-add" class="form-control" onblur="isEmpty('alamat-add', 'alamat-add-error', 'Alamat')">
							<small class="text-danger" id="alamat-add-error"></small>
						</div>
					</div>
					<hr style="border: 1px solid black">
					<div class="mb-3">
						<label for="telepon-add">Telepon</label>
						<input type="text" id="telepon-add" name="telepon-add" class="form-control">
						<small id="telepon-add-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="hp-add">HP</label>
						<input type="text" id="hp-add" name="hp-add" class="form-control">
						<small id="hp-add-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="email-add">Email</label>
						<input type="email" id="email-add" name="email-add" class="form-control">
						<small id="email-add-error" class="text-danger"></small>
					</div>      				
					<div class="mb-3">
						<label for="status-add">Status <span class="text-danger">*</span></label><br>
						<select id="status-add" class="form-control" onblur="isEmpty('status-add', 'status-add-error', 'Status')">
							<option value="">- Pilih Status -</option>
							<option value="1">Aktif</option>
							<option value="2">Tidak Aktif</option>
						</select>
						<small id="status-add-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="keterangan-add">Keterangan</label>
						<input type="text" id="keterangan-add" name="keterangan-add" class="form-control">
					</div>
					<small>( <span class="text-danger">*</span> ) <i>Harus diisi</i></small>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="button" id="add" class="btn btn-primary btn-sm">Simpan</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Edit User -->
	<div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title">Edit</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id-edit" id="id-edit">
					<div class="mb-3">
						<label for="nik-edit">NIK <span class="text-danger">*</span></label>
						<input type="text" id="nik-edit" name="nik-edit" class="form-control" placeholder="NIK = Nomor Induk Karyawan">
						<small id="nik-edit-error" class="text-danger"></small>
						<small id="nik-edit-success" class="text-success"></small>
					</div>
					<div class="mb-3">
						<label for="nama-edit">Nama <span class="text-danger">*</span></label>
						<input type="text" id="nama-edit" name="nama-edit" class="form-control">
						<small id="nama-edit-error"></small>
					</div>
					<div class="mb-3">
						<label for="jabatan-edit">Jabatan <span class="text-danger">*</span></label>
						<select class="form-control" id="jabatan-edit">
							<option value="">- Pilih jabatan -</option>
							<?php
								$sql = "SELECT * FROM tb_jabatan";
								$result = mysqli_query($db, $sql);
								while ($data = mysqli_fetch_assoc($result)) {
									echo
									"<option value='".$data['id']."'>".$data['nama']."</option>";
								}
							?>
						</select>
						<small id="jabatan-edit-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="tempat-lahir-edit">Tempat Lahir</label>
						<input type="text" id="tempat-lahir-edit" name="tempat-lahir-edit" class="form-control">
						<small id="tempat-lahir-edit-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="tgl-lahir-edit">Tanggal Lahir</label>
						<input type="date" id="tgl-lahir-edit" name="tgl-lahir-edit" class="form-control">
						<small id="tgl-lahir-edit-error"></small>
					</div>
					<hr style="border: 1px solid black">
					<h5>Alamat</h5>
					<div class="mb-3">
						<div class="mb-3">
							<label for="negara-edit">Negara <span class="text-danger">*</span></label>
							<select class="form-control" id="negara-edit" onblur="isEmpty('negara-edit', 'negara-edit-error', 'Negara')">
								<option value="">- Pilih negara -</option>
								<?php 
									$sql = "SELECT * FROM tb_negara";
									$result = mysqli_query($db, $sql);
									while ($data = mysqli_fetch_assoc($result)) {
										echo 
										"<option value='".$data['id']."'>".$data['nama']."</option>";
									}
								?>
							</select>
							<small class="text-danger" id="negara-edit-error"></small>
						</div>
						
						<div class="mb-3 propinsi">
							<label for="propinsi-edit">Propinsi <span class="text-danger">*</span></label>
							<select class="form-control" id="propinsi-edit" onblur="isEmpty('propinsi-edit', 'propinsi-edit-error', 'Propinsi')">
								<option value="">- Pilih propinsi -</option>
								<?php 
									$sql = "SELECT * FROM tb_propinsi";
									$result = mysqli_query($db, $sql);
									while ($data = mysqli_fetch_assoc($result)) {
										echo 
										"<option value='".$data['id']."'>".$data['nama']."</option>";
									}
								?>
							</select>
							<small class="text-danger" id="propinsi-edit-error"></small>
						</div>
						
						<div class="mb-3 kab/kota">
							<label for="kota-edit">Kabupaten/Kota <span class="text-danger">*</span></label>
							<select class="form-control" id="kota-edit" onblur="isEmpty('kota-edit', 'kota-edit-error', 'Kabupaten/kota')">
								<option value="">- Pilih Kabupaten/Kota -</option>
								<?php
									$sql = "SELECT * FROM tb_kota";
									$result = mysqli_query($db, $sql);
									while ($data = mysqli_fetch_assoc($result)) {
										echo 
										"<option value='".$data['id']."'>".$data['nama']."</option>";
									}
								?>
							</select>
							<small class="text-danger" id="kota-edit-error"></small>
						</div>

						<div class="mb-3">
							<label for="alamat-edit">Alamat Spesifik <span class="text-danger">*</span></label>
							<input type="text" id="alamat-edit" name="alamat-edit" class="form-control" onblur="isEmpty('alamat-edit', 'alamat-edit-error', 'Alamat')">
							<small class="text-danger" id="alamat-edit-error"></small>
						</div>
					</div>
					<hr style="border: 1px solid black">
					<div class="mb-3">
						<label for="telepon-edit">Telepon</label>
						<input type="text" id="telepon-edit" name="telepon-edit" class="form-control">
						<small id="telepon-edit-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="hp-edit">HP</label>
						<input type="text" id="hp-edit" name="hp-edit" class="form-control">
						<small id="hp-edit-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="email-edit">Email</label>
						<input type="email" id="email-edit" name="email-edit" class="form-control">
						<small id="email-edit-error" class="text-danger"></small>
					</div>      				
					<div class="mb-3">
						<label for="status-edit">Status <span class="text-danger">*</span></label><br>
						<select id="status-edit" class="form-control" onblur="isEmpty('status-edit', 'status-edit-error', 'Status')">
							<option value="">- Pilih Status -</option>
							<option value="1">Aktif</option>
							<option value="2">Tidak Aktif</option>
						</select>
						<small id="status-edit-error" class="text-danger"></small>
					</div>
					<div class="mb-3">
						<label for="keterangan-edit">Keterangan</label>
						<input type="text" id="keterangan-edit" name="keterangan-edit" class="form-control">
					</div>
					<small>( <span class="text-danger">*</span> ) <i>Harus diisi</i></small>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
					<button type="button" id="edit" class="btn btn-primary btn-sm">Simpan</button>
				</div>
			</div>
		</div>
	</div>

	<!-- modal delete user -->
	<div class="modal fade" id="delete-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p class="text-center">Apakah Anda yakin menghapus data berikut?</p>
					<table class="table table-borderless">
						<input type="hidden" id="id-delete" name="id-delete">
						<tr>
							<td>NIK</td>
							<td>:</td>
							<td id="nik-delete"></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td id="nama-delete"></td>
						</tr>
						<tr>
							<td>Jabatan</td>
							<td>:</td>
							<td id="jabatan-delete"></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="button" id="delete" class="btn btn-danger">Hapus</button>
				</div>
			</div>
		</div>
	</div>

	<?php include 'asset_js.php' ?>
	<script>
		// NIK validation
		function checkNikAddUser(){
			$.ajax({
				url: url+"User.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'checkNikAdd',
					'nik': $('#nik-add').val()
				},
				success: function(data){
					var jml = 0
					$.each(data['data'], function(i){
						jml +=1
					})
					if (jml == 0 && $('#nik-add').val() == '') {
						$('#nik-add-error').html('<i class="fa fa-times"></i> NIK harus diisi')
						$('#nik-add-success').html('')
					}else if (jml > 0 && $('#nik-add').val() != ''){
						$('#nik-add-error').html('<i class="fa fa-times"></i> NIK sudah digunakan')
						$('#nik-add-success').html('')
					}else if (jml == 0 && $('#nik-add').val() != ''){
						$('#nik-add-error').html('')
						$('#nik-add-success').html('<i class="fa fa-check"></i> NIK tersedia')
					}
				},
				error: function(data){
					console.log('error: '+data)
				}
			})
		}

		function checkNikEditUser(){
			$.ajax({
				url: url+"User.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'checkNikEdit',
					'nik': $('#nik-edit').val(),
					'id': $('#id-edit').val()
				},
				success: function(data){
					var jml = 0
					$.each(data['data'], function(i){
						jml +=1
					})
					if (jml == 0 && $('#nik-edit').val() == '') {
						$('#nik-edit-error').html('<i class="fa fa-times"></i> NIK harus diisi')
						$('#nik-edit-success').html('')
					}else if (jml > 0 && $('#nik-edit').val() != ''){
						$('#nik-edit-error').html('<i class="fa fa-times"></i> NIK sudah digunakan')
						$('#nik-edit-success').html('')
					}else if (jml == 0 && $('#nik-edit').val() != ''){
						$('#nik-edit-error').html('')
						$('#nik-edit-success').html('<i class="fa fa-check"></i> NIK tersedia')
					}
				},
				error: function(data){
					console.log('error: '+data)
				}
			})
		}

		// generate NIK function
		function generateNik(){
			console.log('test1')
			$.ajax({
				url: url+"User.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'lastId'
				},
				success: function(data){
					$('#nik-add').val('user_'+data['id'])
				},
				error: function(data){
					console.log('error')
				}
			})
		}

		// add NIK on modal add
		$('#add-user-modal').on('show.bs.modal', function(event){
			generateNik()
		})

		// call nik validation on focusout
		$('#nik-add').focusout(function(){
			checkNikAddUser()
		})

		$('#nik-edit').focusout(function(){
			checkNikEditUser()
		})

		// add data to table
		function refresh(){
			$.ajax({
				url: url+"User.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'selectAll'
				},
				success: function(data){
					var row;
					$.each(data['data'], function(i, val){
						row += "<tr id='row"+data['data'][i]['id']+"'>"+
							"<td id='index"+data['data'][i]['id']+"'>"+(i+1)+"</td>"+
							"<td id='nik"+data['data'][i]['id']+"'>"+data['data'][i]['nik']+"</td>"+
							"<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
							"<td id='jabatan"+data['data'][i]['id']+"'>"+data['data'][i]['nama_jabatan']+"</td>"+
							"<td id='alamat"+data['data'][i]['id']+"'>"+data['data'][i]['nama_propinsi']+", "+data['data'][i]['nama_kota']+", "+data['data'][i]['alamat']+"</td>"+
							"<td id='telepon"+data['data'][i]['id']+"'>"+data['data'][i]['telepon']+"</td>"+
							"<td id='hp"+data['data'][i]['id']+"'>"+data['data'][i]['hp']+"</td>"+
							"<td id='email"+data['data'][i]['id']+"'>"+data['data'][i]['email']+"</td>"+
							"<td>"+
							"<button id='edit-user"+data['data'][i]['id']+"' data-toggle='modal' data-target='#edit-user-modal' class='btn btn-primary btn-sm mr-2' data-id='"+data['data'][i]['id']+"'><i class='fa fa-pen'></i></button>"+
							"<button class='btn btn-danger btn-sm' data-id='"+data['data'][i]['id']+"' data-toggle='modal' data-target='#delete-user-modal'><i class='fa fa-trash'></i></button>"+
							"</td>"+
							"</tr>";
					})

					$('#table-content').html(row)
					$('#table').DataTable({
						"columnDefs": [
							{"width": "4%", "targets": 0}
						]
					})
				},
				error: function(data){

				}
			})
		}

		//call refresh function
		refresh()

		// get propinsi
		$('#negara-add').change(function(){
			$.ajax({
				url: url+"Province.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'selectSome',
					'id': $('#negara-add').val()
				},
				success: function(data){
					var option = '';
					$.each(data['data'], function(i, val){
						$('#propinsi-add').append("<option value='"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</option>")
					});
				},
				error: function(data){
					console.log('gagal')
				}
			});
		});

		// get kota/kabupaten
		$('#propinsi-add').change(function(){
			$.ajax({
				url: url+"City.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'selectSome',
					'id': $('#propinsi-add').val()
				},
				success: function(data){
					var option = '';
					$.each(data['data'], function(i, val){
						$('#kota-add').append("<option value='"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</option>");
					});
				},
				error: function(data){
					console.log('gagal');
				}
			})
		});

		//Add AJAX
		$('#add').click(function(){
			var nik = $('#nik-add').val()
			var nama = $('#nama-add').val()
			var username = $('#username-add').val()
			var password = $('#password-add').val()
			var jabatan = $('#jabatan-add').val()
			var negara = $('#negara-add').val()
			var propinsi = $('#propinsi-add').val()
			var kota = $('#kota-add').val()
			var alamat = $('#alamat-add').val()
			var status = $('#status-add').val()

			if (nik === "" || nama === "" || username === "" || password === "" || jabatan === "" || negara === "" || propinsi === "" || kota === "" || alamat === "" || status === "") {
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong')
			}else{
				$.ajax({
					url: url+"User.php",
					type: "POST",
					dataType: "JSON",
					data: {
						'action': 'store',
						'nik': $('#nik-add').val(),
						'nama': $('#nama-add').val(),
						'username': $('#username-add').val(),
						'password': $('#password-add').val(),
						'id-jabatan': $('#jabatan-add').val(),
						'tempat-lahir': $('#tempat-lahir-add').val(),
						'tgl-lahir': $('#tgl-lahir-add').val(),
						'alamat': $('#alamat-add').val(),
						'id-kota': $('#kota-add').val(),
						'id-propinsi': $('#propinsi-add').val(),
						'id-negara': $('#negara-add').val(),
						'telepon': $('#telepon-add').val(),
						'hp': $('#hp-add').val(),
						'email': $('#email-add').val(),
						'website': $('#website-add').val(),
						'keterangan': $('#keterangan-add').val(),
						'status': $('#status-add').val()
					},
					success: function(data){	
						// hide modal add
						$('#add-user-modal').modal('hide')
					   	// destroy datatable
						$('#table').DataTable().destroy()
						refresh()
						// show notification
						toastr.success('Data berhasil ditambahkan')
						// clear input modal add
						$('#nik-add').val('');
						$('#nama-add').val('');
						$('#username-add').val('');
						$('#password-add').val('');
						$('#jabatan-add').val('');
						$('#tempat-lahir-add').val('');
						$('#tgl-lahir-add').val('');
						$('#alamat-add').val('');
						$('#kota-add').val('');
						$('#propinsi-add').val('');
						$('#negara-add').val('');
						$('#telepon-add').val('');
						$('#hp-add').val('');
						$('#email-add').val('');
						$('#website-add').val('');
						$('#keterangan-add').val('');
						$('#status-add').val('');
					},
					error: function(){
						console.log('error')
					}
				});
			}
		})

		// insert value in edit modal
		$('#edit-user-modal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			console.log(id)
			$.ajax({
				url: url+"User.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'select',
					'id': id
				},
				success: function(data){
					$('#id-edit').val(data[0]['id'])
					$('#nik-edit').val(data[0]['nik'])
					$('#nama-edit').val(data[0]['nama'])
					$('#jabatan-edit').val(data[0]['id_jabatan'])
					$('#tempat-lahir-edit').val(data[0]['tempat_lahir'])
					$('#tgl-lahir-edit').val(data[0]['tgl_lahir'])
					$('#negara-edit').val(data[0]['id_negara'])
					$('#propinsi-edit').val(data[0]['id_propinsi'])
					$('#kota-edit').val(data[0]['id_kota'])
					$('#alamat-edit').val(data[0]['alamat'])
					$('#telepon-edit').val(data[0]['telepon'])
					$('#hp-edit').val(data[0]['hp'])
					$('#email-edit').val(data[0]['email'])
					$('#status-edit').val(data[0]['status'])
					$('#keterangan-edit').val(data[0]['keterangan'])
				},
				error: function(data){
					console.log('gagal')
				}
			})
		})

		// Edit AJAX
		$('#edit').click(function(){
			var nik = $('#nik-edit').val()
			var nama = $('#nama-edit').val()
			var jabatan = $('#jabatan-edit').val()
			var negara = $('#negara-edit').val()
			var propinsi = $('#propinsi-edit').val()
			var kota = $('#kota-edit').val()
			var alamat = $('#alamat-edit').val()
			var status = $('#status-edit').val()

			if (nik === "" || nama === "" || jabatan === "" || negara === "" || propinsi === "" || kota === "" || alamat === "" || status === "") {
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong')
			}else{
				$.ajax({
					url: url+"User.php",
					type: "POST",
					dataType: "JSON",
					data: {
						'action': 'update',
						'id': $('#id-edit').val(),
						'nik': $('#nik-edit').val(),
						'nama': $('#nama-edit').val(),
						'id-jabatan': $('#jabatan-edit').val(),
						'tempat-lahir': $('#tempat-lahir-edit').val(),
						'tgl-lahir': $('#tgl-lahir-edit').val(),
						'id-negara': $('#negara-edit').val(),
						'id-propinsi': $('#propinsi-edit').val(),
						'id-kota': $('#kota-edit').val(),
						'alamat': $('#alamat-edit').val(),
						'telepon': $('#telepon-edit').val(),
						'hp': $('#hp-edit').val(),
						'email': $('#email-edit').val(),
						'status': $('#status-edit').val(),
						'keterangan': $('#keterangan-edit').val()
					},
					success: function(data){
						// hide modal edit
						$('#edit-user-modal').modal('hide');
						// update data in the table
						$('#nik'+data['id']).html(data['nik'])
						$('#nama'+data['id']).html(data['nama'])
						$('#jabatan'+data['id']).html(data['nama-jabatan'])
						$('#alamat'+data['id']).html(data['nama-propinsi']+', '+data['nama-kota']+', '+data['alamat'])
						$('#telepon'+data['id']).html(data['telepon'])
						$('#hp'+data['id']).html(data['hp'])
						// show notification
						toastr.success('Data berhasil diperbaharui')
					},
					error: function(data){
						console.log('gagal')
					}
				})
			}
		})

		// insert value in delete modal
		$('#delete-user-modal').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget)
			var id = button.data('id') 

			var modal = $(this)

			$.ajax({
				url: url+"User.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'select',
					'id': id
				},
				success: function(data){
					$('#id-delete').val(data[0]['id'])
					$('#nik-delete').html(data[0]['nik'])
					$('#nama-delete').html(data[0]['nama'])
					$('#jabatan-delete').html(data[0]['nama_jabatan'])

				},
				error: function(data){
					console.log('gagal')
				}
			})
		})

		// delete User
		$('#delete').click(function(){
			$.ajax({
				url: url+"User.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'delete',
					'id': $('#id-delete').val()
				},
				success: function(data){
					$('#delete-user-modal').modal('hide')
					$('#table').DataTable().destroy()
					refresh()
					toastr.success('Data berhasil dihapus')
				},
				error: function(data){
					console.log('gagal')
				}
			})
		})
	</script>
</body>
</html>