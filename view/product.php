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
	<title>Dashboard</title>
  	<?php include 'asset_css.php' ?>
</head>
<body>
	<?php include "navigation.php" ?>
	
    <div class="container-fluid mt-3">
    	<h3 class="mt-3">Master Barang</h3>
  		<div class="mb-3 mt-4">
    		<button class="btn btn-primary ml-0" data-toggle="modal" data-target="#add-barang-modal"><i class="fa fa-plus mr-2"></i>Tambah Barang</button>
    	</div>
    	<div class="table-responsive">
    		<table id="table" class="table table-bordered table-striped">
    			<thead>
    				<tr>
    					<th>#</th>
    					<th>Kode Barang</th>
    					<th>Nama Barang</th>
    					<th>Kategori</th>
    					<th>Stok</th>
    					<th>Harga Jual</th>
    					<th>Diskon (%)</th>
    					<th>Harga Beli</th>
    					<th>Supplier</th>
    					<th>Pajak (%)</th>
    					<th>Aksi</th>
    				</tr>
    			</thead>
    			<tbody id="table-content">
    				<tr>
						<td colspan="12" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td>
					</tr>
    			</tbody>
    		</table>
    	</div>
    </div>

    <!-- Modal Tambah Barang -->
	<div class="modal fade" id="add-barang-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
      					<label for="kode-barang-add">Kode Barang <span class="text-danger">*</span></label>
  						<input type="text" id="kode-barang-add" name="kode-barang-add" class="form-control" onblur="isEmpty('kode-barang-add', 'kode-barang-add-error', 'Kode barang')" disabled>
      					<small class="text-success" id="kode-barang-add-success"></small>
      					<small class="text-danger" id="kode-barang-add-error"></small>
      				</div>
        			<div class="mb-3">
        				<label for="nama-barang-add">Nama Barang <span class="text-danger">*</span></label>
        				<input type="text" id="nama-barang-add" name="nama-barang" class="form-control" placeholder="Contoh: Baju..." onblur="isEmpty('nama-barang-add', 'nama-barang-add-error', 'Nama barang')">
        				<small class="text-danger" id="nama-barang-add-error"></small>
        			</div>
        			<div class="mb-3">
        				<label for="kategori-barang-add">Kategori <span class="text-danger">*</span></label>
        				<select class="form-control" id="kategori-barang-add" onblur="isEmpty('kategori-barang-add', 'kategori-barang-add-error', 'Kategori barang')">
        					<option value="">- Pilih Kategori -</option>
        					<?php
        						$sql = "SELECT * FROM tb_kategori";
        						$result = mysqli_query($db,$sql);

        						while($data = mysqli_fetch_assoc($result)){
        							echo
        							"<option value='".$data['id']."'>".$data['nama']."</option>";
        						}
        					?>
        				</select>
        				<small class="text-danger" id="kategori-barang-add-error"></small>
        			</div>
        			<div class="mb-3">
        				<label for="harga-jual-add">Harga Jual (Rp) <span class="text-danger">*</span></label>
        				<input type="text" id="harga-jual-add" name="harga-barang" class="form-control" placeholder="Contoh: 10000" onblur="isEmpty('harga-jual-add', 'harga-jual-add-error', 'Harga jual barang')">
        				<small class="text-danger" id="harga-jual-add-error"></small>
        			</div>
        			<div class="mb-3">
        				<label for="pajak-add">Tarif Pajak (%)</label>
        				<input type="text" id="pajak-add" name="pajak-add" class="form-control">
        			</div>
        			<div class="mb-3">
        				<label for="harga-beli-add">Harga Beli (Rp) <span class="text-danger">*</span></label>
        				<input type="text" id="harga-beli-add" name="harga-beli-add" class="form-control" onblur="isEmpty('harga-beli-add', 'harga-beli-add-error', 'Harga beli barang')">
        				<small class="text-danger" id="harga-beli-add-error"></small>
        			</div>
        			<div class="mb-3">
	        			<label for="stok">Stok</label>
	        			<input type="text" id="stok-add" name="stok" class="form-control" placeholder="Contoh: 10">
	        		</div>
	        		<div class="mb-3">
	        			<label for="satuan">Satuan <span class="text-danger">*</span></label>
	        			<select class="form-control" id="satuan-add" name="satuan" onblur="isEmpty('satuan-add', 'satuan-add-error', 'Satuan barang')">
	        				<option value="">- Pilih satuan -</option>
	        				<?php
	        					$sql = "SELECT * FROM tb_satuan";
	        					$result = mysqli_query($db, $sql) or die(mysql_error());
	        					while ($data = mysqli_fetch_assoc($result)) {
	        						echo
	        						"<option value='".$data['id']."'>".$data['nama'].' ('.$data['keterangan'].')'."</option>";
	        					}
	        				?>
	        			</select>
	        			<small class="text-danger" id="satuan-add-error"></small>
	        		</div>
	        		<div class="mb-3">
	        			<label for="diskon-add">Diskon (%)</label>
	        			<input type="text" id="diskon-add" name="diskon-add" class="form-control">
	        		</div>
	        		<div class="mb-3">
	        			<label for="supplier">Supplier <span class="text-danger">*</span></label>
	        			<select class="form-control" id="supplier-add" name="supplier" onblur="isEmpty('supplier-add', 'supplier-add-error', 'Supplier barang')">
	        				<option value="">- Pilih supplier -</option>
	        				<?php
	        					$sql = "SELECT * FROM tb_supplier";
	        					$result = mysqli_query($db, $sql) or die(mysql_error());
	        					while ($data = mysqli_fetch_assoc($result)) {
	        						echo
	        						"<option value='".$data['id']."'>".$data['nama']."</option>";
	        					}
	        				?>
	        			</select>
	        			<small class="text-danger" id="supplier-add-error"></small>
	        		</div>
	        		<small>( <span class="text-danger">*</span> ) <i>Harus diisi</i></small>
	      		</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-mdb-color btn-sm" data-dismiss="modal">Batal</button>
	        		<button type="button" id="add" class="btn btn-primary btn-sm">Simpan</button>
	      		</div>
	    	</div>
	  	</div>
	</div>

	<!-- Modal Edit Barang -->
	<div class="modal fade" id="edit-barang-modal" tabindex="-1" role="dialog" aria-labelledby="edit-barang-modal" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="title">Edit</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
      			<div class="modal-body">
      				<input type="hidden" id="id-barang-edit" name="id-barang-edit" value="">
        			<div class="mb-3">
      					<label for="kode-barang-edit">Kode Barang <span class="text-danger">*</span></label>
  						<input type="text" id="kode-barang-edit" name="kode-barang-edit" class="form-control" onblur="isEmpty('kode-barang-edit', 'kode-barang-edit-error', 'Kode barang')" disabled>
      					<small class="text-success" id="kode-barang-edit-success"></small>
      					<small class="text-danger" id="kode-barang-edit-error"></small>
      				</div>
        			<div class="mb-3">
        				<label for="nama-barang-edit">Nama Barang <span class="text-danger">*</span></label>
        				<input type="text" id="nama-barang-edit" name="nama-barang" class="form-control" placeholder="Contoh: Baju..." onblur="isEmpty('nama-barang-edit', 'nama-barang-edit-error', 'Nama barang')">
        				<small class="text-danger" id="nama-barang-edit-error"></small>
        			</div>
        			<div class="mb-3">
        				<label for="kategori-barang-edit">Kategori <span class="text-danger">*</span></label>
        				<select class="form-control" id="kategori-barang-edit" onblur="isEmpty('kategori-barang-edit', 'kategori-barang-edit-error', 'Kategori barang')">
        					<option value="">- Pilih Kategori -</option>
        					<?php
        						$sql = "SELECT * FROM tb_kategori";
        						$result = mysqli_query($db,$sql);

        						while($data = mysqli_fetch_assoc($result)){
        							echo
        							"<option value='".$data['id']."'>".$data['nama']."</option>";
        						}
        					?>
        				</select>
        				<small class="text-danger" id="kategori-barang-edit-error"></small>
        			</div>
        			<div class="mb-3">
        				<label for="harga-jual-edit">Harga Jual (Rp) <span class="text-danger">*</span></label>
        				<input type="text" id="harga-jual-edit" name="harga-barang" class="form-control" placeholder="Contoh: 10000" onblur="isEmpty('harga-jual-edit', 'harga-jual-edit-error', 'Harga jual barang')">
        				<small class="text-danger" id="harga-jual-edit-error"></small>
        			</div>
        			<div class="mb-3">
        				<label for="pajak-edit">Tarif Pajak (%)</label>
        				<input type="text" id="pajak-edit" name="pajak-edit" class="form-control">
        			</div>
        			<div class="mb-3">
        				<label for="harga-beli-edit">Harga Beli (Rp) <span class="text-danger">*</span></label>
        				<input type="text" id="harga-beli-edit" name="harga-beli-edit" class="form-control" onblur="isEmpty('harga-beli-edit', 'harga-beli-edit-error', 'Harga beli barang')">
        				<small class="text-danger" id="harga-beli-edit-error"></small>
        			</div>
        			<div class="mb-3">
	        			<label for="stok">Stok</label>
	        			<input type="text" id="stok-edit" name="stok" class="form-control" placeholder="Contoh: 10">	        		</div>
	        		<div class="mb-3">
	        			<label for="satuan">Satuan <span class="text-danger">*</span></label>
	        			<select class="form-control" id="satuan-edit" name="satuan" onblur="isEmpty('satuan-edit', 'satuan-edit-error', 'Satuan barang')">
	        				<option value="">- Pilih satuan -</option>
	        				<?php
	        					$sql = "SELECT * FROM tb_satuan";
	        					$result = mysqli_query($db, $sql) or die(mysql_error());
	        					while ($data = mysqli_fetch_assoc($result)) {
	        						echo
	        						"<option value='".$data['id']."'>".$data['nama'].' ('.$data['keterangan'].')'."</option>";
	        					}
	        				?>
	        			</select>
	        			<small class="text-danger" id="satuan-edit-error"></small>
	        		</div>
	        		<div class="mb-3">
	        			<label for="diskon-edit">Diskon (%)</label>
	        			<input type="text" id="diskon-edit" name="diskon-edit" class="form-control">
	        		</div>
	        		<div class="mb-3">
	        			<label for="supplier">Supplier <span class="text-danger">*</span></label>
	        			<select class="form-control" id="supplier-edit" name="supplier" onblur="isEmpty('supplier-edit', 'supplier-edit-error', 'Supplier barang')">
	        				<option value="">- Pilih supplier -</option>
	        				<?php
	        					$sql = "SELECT * FROM tb_supplier";
	        					$result = mysqli_query($db, $sql) or die(mysql_error());
	        					while ($data = mysqli_fetch_assoc($result)) {
	        						echo
	        						"<option value='".$data['id']."'>".$data['nama']."</option>";
	        					}
	        				?>
	        			</select>
	        			<small class="text-danger" id="supplier-edit-error"></small>
	        		</div>
	      		</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-mdb-color btn-sm" data-dismiss="modal">Batal</button>
	        		<button type="button" id="edit" class="btn btn-primary btn-sm">Simpan</button>
	      		</div>
	    	</div>
	  	</div>
	</div>

	<!-- Modal Delete Barang -->
	<div class="modal fade" id="delete-barang-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	        		<input type="hidden" name="id-barang-delete" id="id-barang-delete">
	        		<table class="table table-borderless">
	        			<tbody>
	        				<tr>
	        					<td>Kode Barang</td>
	        					<td>:</td>
	        					<td id="kode-barang-delete"></td>
	        				</tr>
	        				<tr>
	        					<td>Nama barang</td>
	        					<td>:</td>
	        					<td id="nama-barang-delete"></td>
	        				</tr>
	        				<tr>
	        					<td>Kategori barang</td>
	        					<td>:</td>
	        					<td id="kategori-barang-delete"></td>
	        				</tr>
	        				<tr>
	        					<td>Stok</td>
	        					<td>:</td>
	        					<td id="stok-delete"></td>
	        				</tr>
	        				<tr>
	        					<td>Satuan</td>
	        					<td>:</td>
	        					<td id="satuan-delete">test</td>
	        				</tr>
	        				<tr>
	        					<td>Harga jual</td>
	        					<td>:</td>
	        					<td>Rp.<span id="harga-jual-delete"></span></td>
	        				</tr>
	        				<tr>
	        					<td>Diskon (%)</td>
	        					<td>:</td>
	        					<td><span id="diskon-delete"></span>%</td>
	        				</tr>
	        				<tr>
	        					<td>Harga beli</td>
	        					<td>:</td>
	        					<td>Rp.<span id="harga-beli-delete"></span></td>
	        				</tr>
	        				<tr>
	        					<td>Pajak (%)</td>
	        					<td>:</td>
	        					<td><span id="pajak-delete"></span>%</td>
	        				</tr>
	        				<tr>
	        					<td>Supplier</td>
	        					<td>:</td>
	        					<td id="supplier-delete"></td>
	        				</tr>
	        			</tbody>
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
		// check kode
		function checkCode(position){
			$.ajax({
				url: url+"Product.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'code',
					'kode': $('#kode-barang-'+position).val()
				},
				success: function(data){
					if (data['data'] == null && $('#kode-barang-'+position).val() == '') {
						$('#kode-barang-'+position+'-error').html('<i class="fa fa-times"></i> Kode barang hasus diisi')
						$('#kode-barang-'+position+'-success').html('')
					}else if (data['data'] != null && $('#kode-barang-'+position).val() != ''){
						$('#kode-barang-'+position+'-success').html('')
						$('#kode-barang-'+position+'-error').html('<i class="fa fa-times"></i> Kode barang sudah digunakan')
					}else if (data['data'] == null && $('#kode-barang-'+position).val() != ''){
						$('#kode-barang-'+position+'-success').html('<i class="fa fa-check"></i> Kode barang tersedia')
						$('#kode-barang-'+position+'-error').html('')
					}
				},
				error: function(data){
					console.log('gagal')
				}
			})
		}

		// check modal add code on focus out
		$('#kode-barang-add').focusout(function(){
			checkCode('add')
		})

		// check modal edit code on focus out
		$('#kode-barang-edit').focusout(function(){
			checkCode('edit')
		})

		// function generate code
		function generateCode(position){
			$.ajax({
				url: url+"Code.php",
				type: "POST",
				dataType: "JSON",
				success: function(data){
					$('#kode-barang-'+position).val('product_'+data)
					checkCode(position)
				},
				error: function(data){
					console.log('gagal')
				}
			})
		}

		// add data
		function refresh(){
			$.ajax({
				url: url+"Product.php",
				type: "POST",
				dataType: "JSON",
				data: {
					'action': 'selectAll'
				},
				success: function(data){
					var row = "";
					$.each(data['data'], function(i, val){
						row += "<tr id='row"+data['data'][i]['id']+"'>"+
							"<td id='index"+data['data'][i]['id']+"'>"+(i+1)+"</td>"+
							"<td id='kode"+data['data'][i]['id']+"'>"+data['data'][i]['kode']+"</td>"+
							"<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
							"<td id='kategori"+data['data'][i]['id']+"'>"+data['data'][i]['nama_kategori']+"</td>"+
							"<td id='stok"+data['data'][i]['id']+"'>"+data['data'][i]['stok']+" "+data['data'][i]['nama_satuan']+"</td>"+
							"<td id='harga-jual"+data['data'][i]['id']+"'>"+accounting.formatMoney(data['data'][i]['harga_jual'],"Rp",2)+"</td>"+
							"<td id='diskon"+data['data'][i]['id']+"'>"+data['data'][i]['diskon']+"%</td>"+
							"<td id='harga-beli"+data['data'][i]['id']+"'>"+accounting.formatMoney(data['data'][i]['harga_beli'],"Rp",2)+"</td>"+
							"<td id='supplier"+data['data'][i]['id']+"'>"+data['data'][i]['nama_supplier']+"</td>"+
							"<td id='pajak"+data['data'][i]['id']+"'>"+data['data'][i]['pajak']+"%</td>"+
							"<td>"+
							"<button type='button' id='edit-barang"+data['data'][i]['id']+"' data-toggle='modal' data-target='#edit-barang-modal' class='btn btn-primary btn-sm mr-2' data-id='"+data['data'][i]['id']+"'><i class='fa fa-pen'></i></button>"+
							"<button type='button' id='hapus-barang"+data['data'][i]['id']+"' data-toggle='modal' data-target='#delete-barang-modal' class='btn btn-danger btn-sm' data-id='"+data['data'][i]['id']+"'><i class='fa fa-trash'></i></button>"+
							"</td></tr>";
					});
					$('#table-content').html(row)
					$('#table').DataTable({
						"columnDefs": [
							{"width": "15%", "targets": 10}
						]
					})
				},
				error: function(data){
					$('#table-content').html('')
					$('#table').DataTable()
					if(data.status == 0){
						toastr.error('Gagal memuat data. Belum ada data tersimpan')
					}
				}
			})
		}

		// call function refresh
		refresh();

		$('#add-barang-modal').on('show.bs.modal', function(event){
			generateCode('add')
		})
		
		// add ajax
		$('#add').click(function(){
			var kode = $('#kode-barang-add').val();
			var nama = $('#nama-barang-add').val();
			var id_kategori = $('#kategori-barang-add').val();
			var harga_jual = $('#harga-jual-add').val();
			var stok = $('#stok-add').val();
			var id_satuan = $('#satuan-add').val();
			var diskon = $('#diskon-add').val();
			var harga_beli = $('#harga-beli-add').val();
			var pajak = $('#pajak-add').val();
			var id_supplier = $('#supplier-add').val();	

			if (kode === "" || nama === "" || id_kategori === "" || harga_jual === "" || harga_beli === "" || id_satuan === "" || id_supplier === "") {
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong')
			}else{
				$.ajax({
					url: url+"Product.php",
					type: "POST",
					dataType: "JSON",
					data: {
                        'action': 'store',
						'kode': kode,
						'nama': nama,
						'id-kategori': id_kategori,
						'harga-jual': harga_jual,
						'stok': stok,
						'id-satuan': id_satuan,
						'diskon': diskon,
						'harga-beli': harga_beli,
						'pajak': pajak,
						'id-supplier': id_supplier
					},
					success: function(data){
						// hide modal
						$('#add-barang-modal').modal('hide');
						// destroy datatable
						$('#table').DataTable().destroy();
						// add loading icon
						$('#table-content').html(
						'<tr><td colspan="12" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td></tr>'
						)
						// refresh data in the table
						refresh();
						// show success notification
						toastr.success('Data berhasil ditambahkan')

						// clear input field in add modal
						$('#kode-barang-add').val('');
						$('#nama-barang-add').val('');
						$('#kategori-barang-add').val('');
						$('#harga-jual-add').val('');
						$('#pajak-add').val('');
						$('#harga-beli-add').val('');
						$('#stok-add').val('');
						$('#satuan-add').val('');
						$('#diskon-add').val('');
						$('#supplier-add').val('');
					},
					error: function(){
						console.log('gagal');
					}
				});
			}
		});

		// Insert value in edit modal
		$('#edit-barang-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
		  	var id = button.data('id')
            $.ajax({
                url: url+"Product.php",
                type: "POST",
                dataType: "JSON",
                data:{
                    'id': id,
                    'action': 'select'
                },
                success: function(data){
                    $('#id-barang-edit').val(data[0]['id'])
                    $('#kode-barang-edit').val(data[0]['kode'])
                    $('#nama-barang-edit').val(data[0]['nama'])
                    $('#kategori-barang-edit').val(data[0]['id_kategori'])
                    $('#harga-jual-edit').val(data[0]['harga_jual'])
                    $('#pajak-edit').val(data[0]['pajak'])
                    $('#harga-beli-edit').val(data[0]['harga_beli'])
                    $('#stok-edit').val(data[0]['stok'])
                    $('#satuan-edit').val(data[0]['id_satuan'])
                    $('#diskon-edit').val(data[0]['diskon'])
                    $('#supplier-edit').val(data[0]['id_supplier'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
		});

		// edit ajax
		$('#edit').click(function(){
			var kode = $('#kode-barang-edit').val();
			var nama = $('#nama-barang-edit').val();
			var id_kategori = $('#kategori-barang-edit').val();
			var harga_jual = $('#harga-jual-edit').val();
			var stok = $('#stok-edit').val();
			var id_satuan = $('#satuan-edit').val();
			var diskon = $('#diskon-edit').val();
			var harga_beli = $('#harga-beli-edit').val();
			var pajak = $('#pajak-edit').val();
			var id_supplier = $('#supplier-edit').val();	

			if (kode === "" || nama === "" || id_kategori === "" || harga_jual === "" || harga_beli === "" || id_satuan === "" || id_supplier === "") {
				alert('Kolom dengan tanda bintang ( * ) tidak boleh kosong')
			}else{
				$.ajax({
					type: "POST",
					url: url+"Product.php",
					dataType: "JSON",
					data: {
	                    'action': 'update',
						'id': $('#id-barang-edit').val(),
						'kode': $('#kode-barang-edit').val(),
						'nama': $('#nama-barang-edit').val(),
						'id-kategori': $('#kategori-barang-edit').val(),
						'stok': $('#stok-edit').val(),
						'id-satuan': $('#satuan-edit').val(),
						'harga-jual': $('#harga-jual-edit').val(),
						'diskon': $('#diskon-edit').val(),
						'harga-beli': $('#harga-beli-edit').val(),				
						'id-supplier': $('#supplier-edit').val(),
						'pajak': $('#pajak-edit').val()
					},
					success: function(data){
						// hide modal edit
						$('#edit-barang-modal').modal('hide');
						// update data in the table
						$('#kode'+data['id']).html(data['kode']);
						$('#nama'+data['id']).html(data['nama']);
						$('#kategori'+data['id']).html(data['nama-kategori']);
						$('#stok'+data['id']).html(data['stok']);
						$('#satuan'+data['id']).html(data['nama-satuan']);
						$('#harga-jual'+data['id']).html(data['harga-jual']);
						$('#diskon'+data['id']).html(data['diskon']+'%');
						$('#harga-beli'+data['id']).html(data['harga-beli']);
						$('#supplier'+data['id']).html(data['nama-supplier']);
						$('#pajak'+data['id']).html(data['pajak']+'%');
						// notification
						toastr.success('Data berhasil diperbaharui')
					},
					error: function(data){
						console.log('gagal');
					}
				});
			}
		});

		// Set data di modal delete
		$('#delete-barang-modal').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget)
		  	var id = button.data('id');
            $.ajax({
                url: url+"Product.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'id': id,
                    'action': 'select'
                },
                success: function(data){
                    $('#id-barang-delete').val(data[0]['id'])
                    $('#kode-barang-delete').html(data[0]['kode'])
                    $('#nama-barang-delete').html(data[0]['nama'])
                    $('#kategori-barang-delete').html(data[0]['nama_kategori'])
                    $('#stok-delete').html(data[0]['stok']+' '+data[0]['nama_satuan'])
                    $('#satuan-delete').html(data[0]['nama_satuan']+' ('+data[0]['keterangan_satuan']+')')
                    $('#harga-jual-delete').html(data[0]['harga_jual'])
                    $('#diskon-delete').html(data[0]['diskon'])
                    $('#harga-beli-delete').html(data[0]['harga_beli'])
                    $('#pajak-delete').html(data[0]['pajak'])
                    $('#supplier-delete').html(data[0]['nama_supplier'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
		});

		// delete ajax
		$('#delete').click(function(){
			$.ajax({
				type: "POST",
				url: url+"Product.php",
				dataType: "JSON",
				data: {
					'id': $('#id-barang-delete').val(),
                    'action': 'delete'
				},
				success: function(data){
					$('#delete-barang-modal').modal('hide');
					$('#table').DataTable().destroy();
					refresh()
					toastr.success('Data berhasil dihapus')
				},
				error: function(){
					console.log('gagal');
				}
			});
		});
	</script>
</body>
</html>