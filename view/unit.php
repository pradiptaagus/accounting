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
	<title>Satuan</title>
	<?php include 'asset_css.php' ?>
</head>
<body>
	<?php include "navigation.php" ?>

    <div class="container-fluid">
    	<h3 class="mt-3">Master Satuan</h3>
  		<div class="mb-3 mt-4">
    		<button class="btn btn-primary ml-0" id="add-barang" data-toggle="modal" data-target="#add-satuan-modal"><i class="fa fa-plus mr-2"></i>Tambah Satuan</button>
    	</div>
    	<div class="table-responsive">
    		<table id="table" class="table table-bordered table-striped">
    			<thead>
    				<tr>
    					<th>#</th>
    					<th>Nama Satuan</th>
    					<th>Keterangan</th>
    					<th>Aksi</th>
    				</tr>
    			</thead>
    			<tbody id="table-content">
    				<tr>
						<td colspan="4" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td>
					</tr>
    			</tbody>
    		</table>
    	</div>
    </div>

    <!-- Modal Tambah Satuan -->
	<div class="modal fade" id="add-satuan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	  	  	<div class="modal-content">
	  	  	  	<div class="modal-header">
	  	  	  	  	<h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
	  	  	  	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  	  	  	  	  	<span aria-hidden="true">&times;</span>
	  	  	  	  	</button>
	  	  	  	</div>
	  	  	  	<div class="modal-body">
	  	  	  		<div class="mb-3">
		  	  	  		<label for="nama-satuan-add">Nama satuan <span class="text-danger">*</span></label>
		  	  	  	  	<input type="text" class="form-control" name="nama-satuan-add" id="nama-satuan-add" onblur="isEmpty('nama-satuan-add', 'nama-satuan-add-error', 'Nama')">
		  	  	  	  	<small class="text-danger" id="nama-satuan-add-error"></small>
	  	  	  	  	</div>
	  	  	  	  	<div>
	  	  	  	  		<label for="keterangan-satuan-add">Keterangan <span class="text-danger">*</span></label>
		  	  	  	  	<input type="text" class="form-control" name="keterangan-satuan-add" id="keterangan-satuan-add" onblur="isEmpty('keterangan-satuan-add', 'keterangan-satuan-add-error', 'Keterangan')">
		  	  	  	  	<small class="text-danger" id="keterangan-satuan-add-error"></small>
	  	  	  	  	</div>
	  	  	  	</div>	  	  	  	
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-mdb-color btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="add" class="btn btn-primary btn-sm">Simpan</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>

	<!-- Modal Edit Satuan -->
	<div class="modal fade" id="edit-satuan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	  	  	<div class="modal-content">
	  	  	  	<div class="modal-header">
	  	  	  	  	<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
	  	  	  	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  	  	  	  	  	<span aria-hidden="true">&times;</span>
	  	  	  	  	</button>
	  	  	  	</div>
	  	  	  	<div class="modal-body">
	  	  	  		<div class="mb-3">
		  	  	  		<input type="hidden" id="id-satuan-edit" name="id-satuan-edit">
		  	  	  		<label for="nama-satuan-edit">Nama satuan <span class="text-danger">*</span></label>
		  	  	  	  	<input type="text" class="form-control" name="nama-satuan-edit" id="nama-satuan-edit" onblur="isEmpty('nama-satuan-edit', 'nama-satuan-edit-error', 'Nama')">
		  	  	  	  	<small class="text-danger" id="nama-satuan-edit-error"></small>
		  	  	  	</div>
		  	  	  	<div>
		  	  	  		<label for="keterangan-satuan-edit">Keterangan <span class="text-danger">*</span></label>
		  	  	  	  	<input type="text" class="form-control" name="keterangan-satuan-edit" id="keterangan-satuan-edit" onblur="isEmpty('keterangan-satuan-edit', 'keterangan-satuan-edit-error', 'Keterangan')">
		  	  	  	  	<small class="text-danger" id="keterangan-satuan-edit-error"></small>
		  	  	  	</div>
	  	  	  	</div>
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-mdb-color btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="edit" class="btn btn-primary btn-sm">Simpan</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>

	<!-- Modal Delete Satuan -->
	<div class="modal fade" id="delete-satuan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	  	  	  		<input type="hidden" id="id-satuan-delete" name="id-satuan-delete">
	  	  	  		<table class="table table-borderless">
	  	  	  			<tr>
	  	  	  				<td>Nama satuan</td>
	  	  	  				<td>:</td>
	  	  	  				<td id="nama-satuan-delete"></td>
	  	  	  			</tr>
	  	  	  			<tr>
	  	  	  				<td>Keterangan</td>
	  	  	  				<td>:</td>
	  	  	  				<td id="keterangan-satuan-delete"></td>
	  	  	  			</tr>
	  	  	  		</table>
	  	  	  	</div>
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-mdb-color btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="delete" class="btn btn-danger btn-sm">Hapus</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>


	<?php include 'asset_js.php' ?>
	<script>
		// Add data
		function refresh(){
			$.ajax({
				url: url+"Unit.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'selectAll'
				},
				success: function(data){
					var row = "";
					$.each(data['data'], function(i, val){
						row += 
							"<tr id='row"+data['data'][i]['id']+"'>"+
							"<td id='index"+data['data'][i]['id']+"'>"+(i+1)+"</td>"+
							"<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
							"<td id='keterangan"+data['data'][i]['id']+"'>"+data['data'][i]['keterangan']+"</td>"+
							"<td>"+
							"<button id='edit-barang"+data['data'][i]['id']+"' data-toggle='modal' data-target='#edit-satuan-modal' class='btn btn-primary btn-sm mr-2' data-id='"+data['data'][i]['id']+"'><i class='fa fa-pen'></i></button>"+
							"<button id='hapus-barang"+data['data'][i]['id']+"' data-toggle='modal' data-target='#delete-satuan-modal' class='btn btn-danger btn-sm' data-id='"+data['data'][i]['id']+"'><i class='fa fa-trash'></i></button>"+
							"</td>"
					})
					$('#table-content').html(row)
					$('#table').DataTable({
						"columnDefs": [
							{"width": "4%", "targets": 0},
							{"width": "10%", "targets": 1},
							{"width": "15%", "targets": 3}
						]
					});
				},
				error: function(data){
					console.log('gagal')
				}
			})
		}

		// call refresh function
		refresh();

		// Add AJAX
		$('#add').click(function(){
			if($('#nama-satuan-add').val() === "" || $('#keterangan-satuan-add').val() === ""){
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong')
			}else{
				$.ajax({
					url: url+"Unit.php",
					type: "POST",
					dataType: "JSON",
					data:{
						'action': 'store',
						'nama': $('#nama-satuan-add').val(),
						'keterangan': $('#keterangan-satuan-add').val()
					},
					success: function(data){
						$('#add-satuan-modal').modal('hide');
						$('#table').DataTable().destroy();
						refresh();
						toastr.success('Data satuan berhasil ditambahkan')
						// clear data in modal add
						$('#nama-satuan-add').val('');
						$('#keterangan-satuan-add').val('');
					},
					error: function(data){
						toastr.error('Data satuan gagal ditambahkan')
					}
				});
			}
		});

		// set value di model edit
		$('#edit-satuan-modal').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget)
			var id = button.data('id');
			$.ajax({
				url: url+"Unit.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'id': id,
					'action': 'select'
				},
				success: function(data){
					$('#id-satuan-edit').val(data[0]['id'])
					$('#nama-satuan-edit').val(data[0]['nama'])
					$('#keterangan-satuan-edit').val(data[0]['keterangan'])
				},
				error: function(data){

				}
			})
		});

		// Edit AJAX
		$('#edit').click(function(){
			if($('#nama-satuan-edit').val() === "" || $('#keterangan-satuan-edit').val() === ""){
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong')
			}else{
				$.ajax({
					url: url+"Unit.php",
					type: "POST",
					dataType: "JSON",
					data:{
						'action': 'update',
						'id': $('#id-satuan-edit').val(),
						'nama': $('#nama-satuan-edit').val(),
						'keterangan': $('#keterangan-satuan-edit').val()
					},
					success: function(data){
						$('#edit-satuan-modal').modal('hide');
						$('#nama'+$('#id-satuan-edit').val()).html($('#nama-satuan-edit').val())
						$('#keterangan'+$('#id-satuan-edit').val()).html($('#keterangan-satuan-edit').val())
						toastr.success('Data satuan berhasil diperbaharui')
					},
					error: function(){
						console.log('gagal');
						toastr.success('Data satuan gagal diperbaharui')
					}
				});
			}
		});

		// set value di modal delete
		$('#delete-satuan-modal').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget)
			var id = button.data('id');
			$.ajax({
				url: url+"Unit.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'id': id,
					'action': 'select'
				}, 
				success: function(data){
					$('#id-satuan-delete').val(data[0]['id'])
					$('#nama-satuan-delete').html(data[0]['nama'])
					$('#keterangan-satuan-delete').html(data[0]['keterangan'])
				},
				error: function(data){
					console.log('gagal')
				}
			})
		});

		// Delete AJAX
		$('#delete').click(function(){
			$.ajax({
				url: url+"Unit.php",
				type: "POST",
				dataType: "JSON",
				data:{
					'action': 'delete',
					'id': $('#id-satuan-delete').val()
				},
				success: function(data){
					$('#delete-satuan-modal').modal('hide');
					$('#table').DataTable().destroy();
					refresh()
					toastr.success('Data satuan berhasil dihapus')
				},
				error: function(data){
					toastr.error('Data satuan gagal diperbaharui')
				}
			});
		});
	</script>
</body>
</html>