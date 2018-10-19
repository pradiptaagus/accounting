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
	<title>Kategori</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php include 'asset_css.php' ?>
</head>
<body>
	<?php include "navigation.php" ?>

	<div class="container-fluid mt-3">
		<h3 class="mt-3">Master Kategori</h3>
		<div class="mb-3 mt-4">
			<button class="btn btn-primary ml-0" data-toggle="modal" data-target="#add-category-modal"><i class="fa fa-plus mr-2"></i>Tambah Kategori</button>
		</div>
		<div class="table-responsive">
			<table id="table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama kategori</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="table-content">
					<tr>
						<td colspan="3" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal Tambah category -->
	<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		  	  	  		<label for="nama-category-add">Nama kategori <span class="text-danger">*</span></label>
		  	  	  	  	<input type="text" class="form-control" name="nama-category-add" id="nama-category-add" onblur="isEmpty('nama-category-add', 'nama-category-add-error', 'Nama kategori')">
		  	  	  	  	<small class="text-danger" id="nama-category-add-error"></small>
	  	  	  	  	</div>
	  	  	  	</div>	  	  	  	
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="add" class="btn btn-primary btn-sm">Simpan</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>

	<!-- Modal Edit category -->
	<div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		  	  	  		<input type="hidden" id="id-category-edit" name="id-category-edit">
		  	  	  		<label for="nama-category-edit">Nama category <span class="text-danger">*</span></label>
		  	  	  	  	<input type="text" class="form-control" name="nama-category-edit" id="nama-category-edit" onblur="isEmpty('nama-category-edit', 'nama-category-edit-error', 'Nama kategori')">
		  	  	  	  	<small class="text-danger" id="nama-category-edit-error"></small>
		  	  	  	</div>
	  	  	  	</div>
	  	  	  	<div class="modal-footer">
	  	  	  	  	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
	  	  	  	  	<button type="button" id="edit" class="btn btn-primary btn-sm">Simpan</button>
	  	  	  	</div>
	  	  	</div>
	  	</div>
	</div>

	<!-- Modal Delete category -->
	<div class="modal fade" id="delete-category-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	  	  	  		<input type="hidden" id="id-category-delete" name="id-category-delete">
	  	  	  		<table class="table table-borderless">
	  	  	  			<tr>
	  	  	  				<td>Nama kategori</td>
	  	  	  				<td>:</td>
	  	  	  				<td id="nama-category-delete"></td>
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
    	// add data to table
    	function refresh(){
    		$.ajax({
	    		url: url+"Category.php",
	    		type: "POST",
	    		dataType: "JSON",
	    		data:{
	    			'action': 'selectAll'
	    		},
	    		success: function(data){
	    			var row = "";
	    			$.each(data['data'], function(i, val){
	    				row += "<tr id='row"+data['data'][i]['id']+"'>"+
	    				"<td id='index"+data['data'][i]['id']+"'>"+(i+1)+"</td>"+
	    				"<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
	    				"<td>"+
	    				"<button id='edit-kategori"+data['data'][i]['id']+"' class='btn btn-primary btn-sm mr-2' data-id='"+data['data'][i]['id']+"' data-toggle='modal' data-target='#edit-category-modal'><i class='fa fa-pen'></i></button>"+
	    				"<button id='delete-kategori"+data['data'][i]['id']+"' class='btn btn-danger btn-sm' data-id='"+data['data'][i]['id']+"' data-toggle='modal' data-target='#delete-category-modal'><i class='fa fa-trash'></i></button>"+
	    				"</td></tr>"
	    			})
	    			$('#table-content').html(row)
	    			$('#table').DataTable({
	    				"columnDefs": [
	    					{"width": "5%", "targets": 0},
	    					{"width": "15%", "targets": 2}
	    				]
	    			})
	    		},
	    		error: function(data){
	    			console.log('gagal')
	    		}
	    	})
    	}

    	// call function refresh
    	refresh()
		
		// add data to database 
		$('#add').click(function(){
			$.ajax({
				url: url+"Category.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'store',
					'nama': $('#nama-category-add').val()
				},
				success: function(data){
					$('#add-category-modal').modal('hide')
					$('#table').DataTable().destroy()
					refresh()
					toastr.success('Data kategori berhasil ditambahkan')
					// clear input field in add modal
					$('#nama-category-add').val('')
				},
				error: function(data){
					console.log('gagal')
					toastr.error('Data kategori gagal ditambahkan')
				}
			})
		})

		// insert value in edit modal
		$('#edit-category-modal').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget)
			var id = button.data('id')
			$.ajax({
				url: url+"Category.php",
				type: "POST", 
				dataType: "JSON",
				data: {
					'id': id,
					'action': 'select'
				},
				success: function(data){
					$('#id-category-edit').val(data[0]['id'])
					$('#nama-category-edit').val(data[0]['nama'])
				},
				error: function(data){
					console.log('gagal')
				}
			})
		})

		// edit ajax
		$('#edit').click(function(){
			$.ajax({
				type: "POST",
				url: url+"Category.php",
				dataType: "JSON",
				data: {
                    'action': 'update',
					'id': $('#id-category-edit').val(),
					'kode': $('#kode-barang-edit').val(),
					'nama': $('#nama-category-edit').val(),
				},
				success: function(data){
					$('#edit-category-modal').modal('hide')
					$('#nama'+data['id']).html(data['nama'])
					toastr.success('Data kategori berhasil diperbaharui')
				},
				error: function(data){
					console.log('gagal');
					toastr.error('Data kategori gagal diperbaharui')
				}
			});
		});

		// add value to delete modal
		$('#delete-category-modal').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget)
			var id = button.data('id')
			$.ajax({
				url: url+"Category.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'select',
					'id': id
				},
				success: function(data){
					$('#id-category-delete').val(data[0]['id'])
					$('#nama-category-delete').html(data[0]['nama'])
				}
			})
		})

		// delete ajax
		$('#delete').click(function(){
			$.ajax({
				type: "POST",
				url: url+"Category.php",
				dataType: "JSON",
				data: {
					'action': 'delete',
					'id': $('#id-category-delete').val()
				},
				success: function(data){
					$('#delete-category-modal').modal('hide')
					$('#table-content').html(
						'<tr><td colspan="3" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td></tr>'
					)
					$('#table').DataTable().destroy();
					refresh()
					toastr.success('Data kategori berhasil dihapus')
				},
				error: function(data){
					console.log('gagal')
					toastr.error('Data kategori gagal dihapus')
				}
			})
		})
    </script>
</body>
</html>