<?php include '../config/connection.php';

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
	<title>Supplier</title>
	<?php include 'asset_css.php' ?>
</head>
<body>
	<?php include "navigation.php" ?>

    <div class="container-fluid">
    	<h3 class="mt-3">Master Supplier</h3>
    	<div class="mb-3 mt-4">
    		<button class="btn btn-primary ml-0" id="add-barang" data-toggle="modal" data-target="#add-supplier-modal"><i class="fa fa-plus mr-2"></i>Tambah Supplier</button>
    	</div>
    	<div class="table-responsive">
    		<table id="table" class="table table-bordered table-striped">
    			<thead>
    				<tr>
    					<th>#</th>
    					<th>Nama</th>
    					<th>Alamat</th>
    					<th>Telepon</th>
    					<th>HP</th>
    					<th>Email</th>
    					<th>Website</th>
    					<th>Aksi</th>
    				</tr>
    			</thead>
    			<tbody id="table-content">
    				<tr>
						<td colspan="8" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td>
					</tr>
    			</tbody>
    		</table>
    	</div>
    </div>

    <!-- Modal Tambah Supplier -->
	<div class="modal fade" id="add-supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	  	  	<div class="modal-content">
	  	  	  	<div class="modal-header">
	  	  	  	  	<h5 class="modal-title" id="exampleModalCenterTitle">Tambah</h5>
	  	  	  	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  	  	  	  	  	<span aria-hidden="true">&times;</span>
	  	  	  	  	</button>
	  	  	  	</div>
	  	  	  	<div class="modal-body">
	  	  	  		<div class="mb-3">
	  	  	  	  		<label for="nama-supplier-add">Nama Supplier <span class="text-danger">*</span></label>
  	  	  	  			<input type="text" id="nama-supplier-add" name="nama-supplier-add" class="form-control" onblur="isEmpty('nama-supplier-add', 'nama-supplier-add-error', 'Nama')">
	  	  	  	  		<small class="text-success" id="nama-supplier-add-success"></small>
	  	  	  	  		<small class="text-danger" id="nama-supplier-add-error"></small>
	  	  	  	  	</div>

	  	  	  	  	<hr style="border: 1px solid black">

	  	  	  	  	<div class="">
	  	  	  	  		<h5>Alamat</h5>
	  	  	  	  	
		  	  	  	  	<div class="mb-3">
		  	  	  	  		<label for="negara-supplier-add">Negara <span class="text-danger">*</span></label>
		  	  	  	  		<select class="form-control" id="negara-supplier-add" onblur="isEmpty('negara-supplier-add', 'negara-supplier-add-error', 'Negara asal supplier')">
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
		  	  	  	  		<small class="text-danger" id="negara-supplier-add-error"></small>
		  	  	  	  	</div>
		  	  	  	  	
		  	  	  	  	<div class="mb-3 propinsi">
		  	  	  	  		<label for="propinsi-supplier-add">Propinsi <span class="text-danger">*</span></label>
		  	  	  	  		<select class="form-control" id="propinsi-supplier-add" onblur="isEmpty('propinsi-supplier-add', 'propinsi-supplier-add-error', 'Propinsi asal supplier')">
		  	  	  	  			<option value="">- Pilih propinsi -</option>
		  	  	  	  		</select>
		  	  	  	  		<small class="text-danger" id="propinsi-supplier-add-error"></small>
		  	  	  	  	</div>
		  	  	  	  	
		  	  	  	  	<div class="mb-3 kab/kota">
		  	  	  	  		<label for="kota-supplier-add">Kabupaten/Kota <span class="text-danger">*</span></label>
		  	  	  	  		<select class="form-control" id="kota-supplier-add" onblur="isEmpty('kota-supplier-add', 'kota-supplier-add-error', 'Kabupaten/kota asal supplier')">
		  	  	  	  			<option value="">- Pilih Kabupaten/Kota -</option>
		  	  	  	  		</select>
		  	  	  	  		<small class="text-danger" id="kota-supplier-add-error"></small>
		  	  	  	  	</div>

		  	  	  	  	<div class="mb-3">
		  	  	  	  		<label for="alamat-supplier-add">Alamat Spesifik <span class="text-danger">*</span></label>
		  	  	  	  		<input type="text" id="alamat-supplier-add" name="alamat-supplier-add" class="form-control" onblur="isEmpty('alamat-supplier-add', 'alamat-supplier-add-error', 'Alamat')">
		  	  	  	  		<small class="text-danger" id="alamat-supplier-add-error"></small>
		  	  	  	  	</div>
	  	  	  	  	</div>

	  	  	  	  	<hr style="border: 1px solid black">

	  	  	  	  	<div class="mb-3">
	  	  	  	  		<label for="telepon-supplier-add">Telepon</label>
	  	  	  	  		<input type="text" id="telepon-supplier-add" name="telepon-supplier-add" class="form-control">
	  	  	  	  	</div>
	  	  	  	  	<div class="mb-3">
	  	  	  	  		<label for="hp-supplier-add">HP</label>
	  	  	  	  		<input type="text" id="hp-supplier-add" name="hp-supplier-add" class="form-control">
	  	  	  	  	</div>
	  	  	  	  	<div class="mb-3">
	  	  	  	  		<label for="email-supplier-add">Email</label>
	  	  	  	  		<input type="text" id="email-supplier-add" name="email-supplier-add" class="form-control">
	  	  	  	  	</div>
	  	  	  	  	<div>
	  	  	  	  		<label for="website-supplier-add">Website</label>
	  	  	  	  		<input type="text" id="website-supplier-add" name="website-supplier-add" class="form-control">
	  	  	  	  	</div>
	  	  	  	</div>
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="add" class="btn btn-primary btn-sm">Simpan</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>

	<!-- Modal Edit Supplier -->
	<div class="modal fade" id="edit-supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	  	  	<div class="modal-content">
	  	  	  	<div class="modal-header">
	  	  	  	  	<h5 class="modal-title" id="exampleModalCenterTitle">Edit</h5>
	  	  	  	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  	  	  	  	  	<span aria-hidden="true">&times;</span>
	  	  	  	  	</button>
	  	  	  	</div>
	  	  	  	<div class="modal-body">
	  	  	  		<input type="hidden" id="id-supplier-edit" name="id-supplier-edit">
	  	  	  		<div class="mb-3">
	  	  	  	  		<label for="nama-supplier-edit">Nama Supplier <span class="text-danger">*</span></label>
	  	  	  	  			<input type="text" id="nama-supplier-edit" name="nama-supplier-edit" class="form-control" onblur="isEmpty('nama-supplier-edit', 'nama-supplier-edit-error', 'Nama supplier')">
	  	  	  	  		<small class="text-success" id="nama-supplier-edit-success"></small>
	  	  	  	  		<small class="text-danger" id="nama-supplier-edit-error"></small>
	  	  	  	  	</div>

	  	  	  	  	<hr style="border: 1px solid black">

	  	  	  	  	<div class="">
	  	  	  	  		<h5>Alamat</h5>
	  	  	  	  	
		  	  	  	  	<div class="mb-3">
		  	  	  	  		<label for="negara-supplier-edit">Negara <span class="text-danger">*</span></label>
		  	  	  	  		<select class="form-control" id="negara-supplier-edit" onblur="isEmpty('negara-supplier-edit', 'negara-supplier-edit-error', 'Negara asal supplier')">
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
		  	  	  	  		<small id="negara-supplier-edit-error" class="text-danger"></small>
		  	  	  	  	</div>
		  	  	  	  	
		  	  	  	  	<div class="mb-3 propinsi">
		  	  	  	  		<label for="propinsi-supplier-edit">Propinsi <span class="text-danger">*</span></label>
		  	  	  	  		<select class="form-control" id="propinsi-supplier-edit" onblur="isEmpty('propinsi-supplier-edit', 'propinsi-supplier-edit-error', 'Propinsi asal supplier')">
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
		  	  	  	  		<small id="propinsi-supplier-edit-error" class="text-danger"></small>
		  	  	  	  	</div>
		  	  	  	  	
		  	  	  	  	<div class="mb-3 kab/kota">
		  	  	  	  		<label for="kota-supplier-edit">Kabupaten/Kota <span class="text-danger">*</span></label>
		  	  	  	  		<select class="form-control" id="kota-supplier-edit" onblur="isEmpty('kota-supplier-edit', 'kota-supplier-edit-error', 'Kota/Kabupaten supplier')">
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
		  	  	  	  		<small id="kota-supplier-edit-error" class="text-danger"></small>
		  	  	  	  	</div>

		  	  	  	  	<div class="mb-3">
		  	  	  	  		<label for="alamat-supplier-edit">Alamat Spesifik <span class="text-danger">*</span></label>
		  	  	  	  		<input type="text" id="alamat-supplier-edit" name="alamat-supplier-edit" class="form-control" onblur="isEmpty('alamat-supplier-edit', 'alamat-supplier-edit-error', 'Alamat supplier')">
		  	  	  	  		<small class="text-danger" id="alamat-supplier-edit-error"></small>
		  	  	  	  	</div>
	  	  	  	  	</div>

	  	  	  	  	<hr style="border: 1px solid black">
	  	  	  	  	<div class="mb-3">
	  	  	  	  		<label for="telepon-supplier-edit">Telepon</label>
	  	  	  	  		<input type="text" id="telepon-supplier-edit" name="telepon-supplier-edit" class="form-control">
	  	  	  	  	</div>
	  	  	  	  	<div class="mb-3">
	  	  	  	  		<label for="hp-supplier-edit">HP</label>
	  	  	  	  		<input type="text" id="hp-supplier-edit" name="hp-supplier-edit" class="form-control">
	  	  	  	  	</div>
	  	  	  	  	<div class="mb-3">
	  	  	  	  		<label for="email-supplier-edit">Email</label>
	  	  	  	  		<input type="text" id="email-supplier-edit" name="email-supplier-edit" class="form-control">
	  	  	  	  	</div>
	  	  	  	  	<div>
	  	  	  	  		<label for="website-supplier-edit">Website</label>
	  	  	  	  		<input type="text" id="website-supplier-edit" name="website-supplier-edit" class="form-control">
	  	  	  	  	</div>
	  	  	  	</div>
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="edit" class="btn btn-primary btn-sm">Simpan</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>

	<!-- Modal Delete Supplier -->
	<div class="modal fade" id="delete-supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	  	  	<div class="modal-content">
	  	  	  	<div class="modal-header">
	  	  	  	  	<h5 class="modal-title" id="exampleModalCenterTitle">Hapus</h5>
	  	  	  	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  	  	  	  	  	<span aria-hidden="true">&times;</span>
	  	  	  	  	</button>
	  	  	  	</div>
	  	  	  	<div class="modal-body">
	  	  	  		<p class="text-center">Apakah Anda yakin menghapus data berikut?</p>
	  	  	  		<table class="table table-borderless">
	  	  	  			<input type="hidden" id="id-supplier-delete" name="id-supplier-delete">
	  	  	  			<tr>
	  	  	  				<td>Nama supplier</td>
	  	  	  				<td>:</td>
	  	  	  				<td id="nama-supplier-delete"></td>
	  	  	  			</tr>
	  	  	  			<tr>
	  	  	  				<td>Alamat</td>
	  	  	  				<td>:</td>
	  	  	  				<td id="alamat-supplier-delete"></td>
	  	  	  			</tr>
	  	  	  		</table>
	  	  	  	</div>
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="delete" class="btn btn-danger btn-sm">Hapus</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>

    <?php include 'asset_js.php' ?>
	<script>
		// function to chek if supplier is exist on modal add
		function checkSupplierNameAdd(){
			$.ajax({
				url: url+"Supplier.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'checkNameAdd',
					'nama': $('#nama-supplier-add').val()
				},
				success: function(data){
					console.log(data[0]['jml'])
					if (data[0]['jml'] < 1 && $('#nama-supplier-add').val() == ''){
						$('#nama-supplier-add-success').html('')
						$('#nama-supplier-add-error').html('<i class="fa fa-times"></i> Nama supplier harus diisi')
					}else if (data[0]['jml'] >= 1 && $('#nama-supplier-add').val() != ''){
						$('#nama-supplier-add-success').html('')
						$('#nama-supplier-add-error').html('<i class="fa fa-times"></i> Nama supplier sudah digunakan')
					}else if (data[0]['jml'] < 1 && $('nama-supplier-add').val() != ''){
						$('#nama-supplier-add-success').html('<i class="fa fa-check"></i> Nama supplier tersedia')
						$('#nama-supplier-add-error').html('')
					}
				},
				error: function(data){
					console.log('gagal')
				}
			})
		}

		// function to check if supplier is exist on modal edit
		function checkSupplierNameEdit(){
			$.ajax({
				url: url+"Supplier.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'checkNameEdit',
					'id': $('#id-supplier-edit').val(),
					'nama': $('#nama-supplier-edit').val()
				},
				success: function(data){
					console.log($('#nama-supplier-edit').val())
					if (data[0]['jml'] < 1 && $('#nama-supplier-edit').val() == ''){
						$('#nama-supplier-edit-success').html('')
						$('#nama-supplier-edit-error').html('<i class="fa fa-times"></i> Nama supplier harus diisi')
					}else if (data[0]['jml'] >= 1 && $('#nama-supplier-edit').val() != ''){
						$('#nama-supplier-edit-success').html('')
						$('#nama-supplier-edit-error').html('<i class="fa fa-times"></i> Nama supplier sudah digunakan')
					}else if (data[0]['jml'] < 1 && $('nama-supplier-edit').val() != ''){
						$('#nama-supplier-edit-success').html('<i class="fa fa-check"></i> Nama supplier tersedia')
						$('#nama-supplier-edit-error').html('')
					}
				},
				error: function(data){
					console.log('gagal')
				}
			})
		}

		// on focusout on modal add
		$('#nama-supplier-add').focusout(function(){
			checkSupplierNameAdd()
		})

		// on focus out on modal edit
		$('#nama-supplier-edit').focusout(function(){
			checkSupplierNameEdit()
		})

		// Add data to table
		function refresh(){
			$.ajax({
				url: url+"Supplier.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'selectAll'
				},
				success: function(data){
					var row = "";

					$.each(data['data'], function(i, val){
						row +=
							"<tr id='row"+data['data'][i]['id']+"'>"+
							"<td id='index"+data['data'][i]['id']+"'>"+(i+1)+"</td>"+
							"<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
							"<td id='alamat"+data['data'][i]['id']+"'>"+data['data'][i]['nama_propinsi']+", "+data['data'][i]['nama_kota']+", "+data['data'][i]['alamat']+"</td>"+
							"<td id='telepon"+data['data'][i]['id']+"'>"+data['data'][i]['telepon']+"</td>"+
							"<td id='hp"+data['data'][i]['id']+"'>"+data['data'][i]['hp']+"</td>"+
							"<td id='email"+data['data'][i]['id']+"'>"+data['data'][i]['email']+"</td>"+
							"<td id='website"+data['data'][i]['id']+"'>"+data['data'][i]['website']+"</td>"+
							"<td>"+
							"<button id='edit-barang"+data['data'][i]['id']+"' data-toggle='modal' data-target='#edit-supplier-modal' class='btn btn-primary btn-sm mr-2' data-id='"+data['data'][i]['id']+"'><i class='fa fa-pen'></i></button>"+
							"<button id='hapus-barang"+data['data'][i]['id']+"' data-toggle='modal' data-target='#delete-supplier-modal' class='btn btn-danger btn-sm' data-id='"+data['data'][i]['id']+"'><i class='fa fa-trash'></i></button>"+
							"</td>";
					})
					$('#table-content').html(row)
					$('#table').DataTable({
						"columnDefs": [
							{"width": "4%", "targets": 0},
							{"width": "15%", "targets": 7}
						]
					})
				},
				error: function(data){
					console.log('gagal')
				}
			})
		}

		// call refresh function
		refresh();

		// get propinsi
		$('#negara-supplier-add').change(function(){
			$.ajax({
				url: url+"Province.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'selectSome',
					'id': $('#negara-supplier-add').val()
				},
				success: function(data){
					var option = '';

					$.each(data['data'], function(i, val){
						$('#propinsi-supplier-add').append("<option value='"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</option>")
					});
				},
				error: function(data){
					console.log('gagal')
				}
			});
		});

		// get kota/kabupaten
		$('#propinsi-supplier-add').change(function(){
			$.ajax({
				url: url+"City.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'selectSome',
					'id': $('#propinsi-supplier-add').val()
				},
				success: function(data){
					var option = '';

					$.each(data['data'], function(i, val){
						$('#kota-supplier-add').append("<option value='"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</option>");
					});
				},
				error: function(data){
					console.log('gagal');
				}
			})
		});

		// Add AJAX
		$('#add').click(function(){
			if ($('#nama-supplier-add').val() === "" || $('#alamat-supplier-add').val() === "" || $('#kota-supplier-add').val() === "" || $('#propinsi-supplier-add').val() === "" || $('#negara-supplier-add').val() === "") {
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong');
			}else{
				$.ajax({
					url: url+"Supplier.php",
					type: "POST",
					dataType: "JSON",
					data:{
						'action': 'store',
						'nama': $('#nama-supplier-add').val(),
						'alamat': $('#alamat-supplier-add').val(),
						'id-kota': $('#kota-supplier-add').val(),
						'id-propinsi': $('#propinsi-supplier-add').val(),
						'id-negara': $('#negara-supplier-add').val(),
						'kontak': $('#kontak-supplier-add').val(),
						'telepon': $('#telepon-supplier-add').val(),
						'hp': $('#hp-supplier-add').val(),
						'email': $('#email-supplier-add').val(),
						'website': $('#website-supplier-add').val()
					},
					success: function(data){
						$('#add-supplier-modal').modal('hide');

						$('#table').DataTable().destroy()
						refresh()
						toastr.success('Data berhasil ditambahkan')

						$('#nama-supplier-add').val('')
						$('#nama-supplier-add-success').html('')
						$('#negara-supplier-add').val('')
						$('#propinsi-supplier-add').val('')
						$('#kota-supplier-add').val('')
						$('#alamat-supplier-add').val('')
						$('#kontak-supplier-add').val('')
						$('#telepon-supplier-add').val('')
						$('#hp-supplier-add').val('')
						$('#email-supplier-add').val('')
						$('#website-supplier-add').val('')
					},
					error: function(){
						console.log('gagal')
					}
				});
			}
		});

		// Set data edit-supplier-modal
		$('#edit-supplier-modal').on('show.bs.modal', 
            function(event){
			var button = $(event.relatedTarget)
			var id = button.data('id')
			$.ajax({
				url: url+"Supplier.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'id': id,
					'action': 'select'
				},
				success: function(data){
					$('#id-supplier-edit').val(data[0]['id'])
					$('#nama-supplier-edit').val(data[0]['nama'])
					$('#negara-supplier-edit').val(data[0]['id_negara'])
					$('#propinsi-supplier-edit').val(data[0]['id_propinsi'])
					$('#kota-supplier-edit').val(data[0]['id_kota'])
					$('#alamat-supplier-edit').val(data[0]['alamat'])
					$('#kontak-supplier-edit').val(data[0]['kontak'])
					$('#telepon-supplier-edit').val(data[0]['telepon'])
					$('#hp-supplier-edit').val(data[0]['hp'])
					$('#email-supplier-edit').val(data[0]['email'])
					$('#website-supplier-edit').val(data[0]['website'])
				},
				error: function(data){
					console.log('gagal')
				}
			})
		})

		// Edit AJAX
		$('#edit').click(function(){
			if ($('#nama-supplier-edit').val() === "" || $('#alamat-supplier-edit').val() === "" || $('#kota-supplier-edit').val() === "" || $('#propinsi-supplier-edit').val() === "" || $('#negara-supplier-edit').val() === "") {
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong');
			}else{
				$.ajax({
					url: url+"Supplier.php",
					type: "POST",
					dataType: "JSON",
					data:{
						'action': 'update',
						'id': $('#id-supplier-edit').val(),
						'nama': $('#nama-supplier-edit').val(),
						'alamat': $('#alamat-supplier-edit').val(),
						'id-kota': $('#kota-supplier-edit').val(),
						'id-propinsi': $('#propinsi-supplier-edit').val(),
						'id-negara': $('#negara-supplier-edit').val(),
						'kontak': $('#kontak-supplier-edit').val(),
						'telepon': $('#telepon-supplier-edit').val(),
						'hp': $('#hp-supplier-edit').val(),
						'email': $('#email-supplier-edit').val(),
						'website': $('#website-supplier-edit').val()
					},
					success: function(data){
						$('#edit-supplier-modal').modal('hide');
						// clear cache
						$('#nama-supplier-edit-success').html('')
						// update data on table			
						$('#nama'+data['id']).html(data['nama']);
						$('#alamat'+data['id']).html(data['nama-propinsi']+', '+data['nama-kota']+', '+data['alamat']);
						$('#kontak'+data['id']).html(data['kontak']);
						$('#telepon'+data['id']).html(data['telepon']);
						$('#hp'+data['id']).html(data['hp']);
						$('#email'+data['id']).html(data['email']);
						$('#website'+data['id']).html(data['website']);

						toastr.success('Data berhasil diperbaharui')
					},
					error: function(){
						console.log('gagal');
					}
				})
			}
		});

		// Set data delete-supplier-modal
		$('#delete-supplier-modal').on('show.bs.modal', 
            function(event){
			var button = $(event.relatedTarget)
			var id = button.data('id');
			$.ajax({
				url: url+"Supplier.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'select',
					'id': id
				},
				success: function(data){
					$('#id-supplier-delete').val(data[0]['id'])
					$('#nama-supplier-delete').html(data[0]['nama'])
					$('#alamat-supplier-delete').html(data[0]['nama_propinsi']+", "+data[0]['nama_kota']+", "+data[0]['alamat'])
				}
			})
		});

		$('#delete').click(function(){
			$.ajax({
				url: url+"Supplier.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'delete',
					'id': $('#id-supplier-delete').val()
				},
				success: function(data){
					$('#delete-supplier-modal').modal('hide');
					$('#table').DataTable().destroy();
					refresh()
					toastr.success('Data berhasil dihapus')
				},
				error: function(){
					console.log('gagal')
				}
			});
		});
	</script>
</body>
</html>