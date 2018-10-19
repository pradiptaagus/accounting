<?php 
	include '../config/connection.php';

	// mengaktifkan session
	session_start();
	$username = $_SESSION['username'];

	// cek apakah user sudah login atau belum
	// jika belum, user akan dialihkan ke halaman login
	if($_SESSION['status'] != 'login'){
		header("location:../view/login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Kasir</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php include 'asset_css.php' ?>
</head>
<body>
	<?php include 'navigation.php' ?>

	<div class="container-fluid mt-3">
		<h3>Kasir</h3>
		<div class="mb-3 mt-4">
			<div class="row">
				<div class="col-md-8">
					<h3 class="text-center">Daftar Barang</h3>
					<div class="table-responsive">
						<table id="table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>Kategori</th>
									<th>Stok</th>
									<th>Harga Jual</th>
									<th>Diskon</th>
									<th>Pajak</th>
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
				<div class="col">
					<div class="card">
						<div class="card-body">
							<h3 class="text-center">Pembayaran</h3>
							<div class="d-flex justify-content-between">
								<button class="btn btn-primary btn-sm float-left" data-toggle="modal" data-target="#search-user-modal"><i class="fa fa-search"></i></button>
								<button class="btn btn-secondary btn-sm d-inline float-right"><i class="fa fa-user-plus"></i></button>							
							</div>
							<!-- <input type="text" id="search-user" class="form-control d-inline mb-3" name="search-user" placeholder="Ketikkan nama pelanggan"> -->
							<div class="table-responsive">
								<table class="table table-borderless font-14 checkout">
									<tr>
										<input type="hidden" id="customer-id" value="">
										<td class="sub">Pelanggan</td>
										<td>:</td>
										<td id="customer-name"><span class="badge badge-danger">Belum dipilih</span></td>
									</tr>
									<tr>
										<td class="sub">Penjual</td>
										<td>:</td>
										<td>											
											<?php
												$sql = "SELECT tb_user.`nama` FROM tb_user WHERE tb_user.`username` = '$username'";
												$exec = mysqli_query($db, $sql);
												$result = mysqli_fetch_assoc($exec);
												echo $result['nama'];
											?>
										</td>
									</tr>
									<tr>
										<td colspan="3"><hr class="m-0"></td>
									</tr>
									<tr>
										<td colspan="3"><h5 class="text-center mb-0">Barang yang dibeli</h5></td>
									</tr>
									<!-- ========================================= -->
									<tr>
										<td colspan="3"><hr class="m-0"></td>
									</tr>
								</table>
								<table class="table table-borderless font-14 checkout">
									<thead>
										<tr>
											<th style="max-width: 20%">Nama</th>
											<th>Qty</th>
											<th style="width: 35%">Harga</th>
											<th style="width: 35%">Total</th>
											<th>Aksi</th>
											<input type="hidden" id="product-count" value="0">
										</tr>
									</thead>
									<tbody id="product-payment">
										<tr id="no-data">
											<td colspan="5" class="text-center">Tidak ada data</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-borderless font-14 checkout">
									<tr>
										<td colspan="4"><hr class="m-0"></td>
									</tr>
									<!-- ========================================= -->
									<tr>
										<td class="sub">Total Pembayaran</td>
										<td>:</td>
										<td class="font-14 text-right" id="total-payment">Rp0</td>
									</tr>
									<tr>
										<td class="sub">Diskon</td>
										<td>:</td>
										<td class="font-14 text-right" id="discount">0%</td>
									</tr>
									<tr>
										<td class="sub">Total bayar</td>
										<td>:</td>
										<td class="font-14 text-right" id="total-pay">Rp0</td>
									</tr>
									<tr>
										<td class="sub">Jumlah bayar</td>
										<td>:</td>
										<td>
											<input id="payment-amount" type="text" class="form-control" onkeyup="checkBalance()">
										</td>
									</tr>
									<tr class="text-warning">
										<td class="sub font-16">Kurang bayar</td>
										<td>:</td>
										<td class="font-16 text-right font-weight-bold" id="insufficient-payment">Rp0</td>
									</tr>
									<tr class="text-success">
										<td class="sub font-16">Uang Kembali</td>
										<td>:</td>
										<td class="font-16 text-right font-weight-bold" id="change-money">Rp0</td>
									</tr>
								</table>
							</div>
							<div class="row justify-content-between">
								<div class="col">
									<button class="btn btn-success btn-block">Selesai</button>
								</div>
								<div class="col">
									<button class="btn btn-info btn-block">Tunggu</button>
								</div>
								<div class="col">
									<button class="btn btn-danger btn-block">Batal</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal search user -->
	<div class="modal fade" id="search-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Cari Pelanggan</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        </button>
		      	</div>
	      		<div class="modal-body">
			        <div class="table-responsive">
			        	<table id="table-search-user" class="table table-bordered table-striped">
				        	<thead>
								<tr>
									<th>#</th>
									<th>No Pelanggan</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody id="user-content">
							</tbody>
				        </table>
			        </div>
		      	</div>
		    </div>
	  	</div>
	</div>

	<?php include 'asset_js.php' ?>
    <script>
    	function loadingSearchUser(){
    		'<tr>'+
				'<td colspan="9" class="text-center"><i class="fas fa-circle-notch fa-spin fa-2x"></i></td>'+
			'</tr>'
    	}

    	// Add data to table
    	function refresh(){
    		$.ajax({
    			url: url+"Product.php",
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
							"<td id='kode"+data['data'][i]['id']+"'>"+data['data'][i]['kode']+"</td>"+
							"<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
							"<td id='kategori"+data['data'][i]['id']+"'>"+data['data'][i]['nama_kategori']+"</td>"+
							"<td id='stok"+data['data'][i]['id']+"'>"+data['data'][i]['stok']+" "+data['data'][i]['nama_satuan']+"</td>"+
							"<td id='harga-jual"+data['data'][i]['id']+"'>"+accounting.formatMoney(data['data'][i]['harga_jual'], "Rp", 0)+"</td>"+
							"<td id='diskon"+data['data'][i]['id']+"'>"+data['data'][i]['diskon']+"%</td>"+
							"<td id='pajak"+data['data'][i]['id']+"'>"+data['data'][i]['pajak']+"%</td>"+
							"<td>"+
							"<div><button class='btn btn-primary btn-sm' onclick='addProduct("+data['data'][i]['id']+")'><i class='fa fa-plus'></i></button>"+
							"</td></div></tr>";
					});
					$('#table-content').html(row)
					$('#table').DataTable()
    			}
    		})
    	}

    	// call function refresh
    	refresh()

    	// search user
    	$(document).ready(function(){
			$('#table-search-user').DataTable()
    	})
    	$('#search-user-modal').on('show.bs.modal', function(event){
    		var button = $(event.relatedTarget)
    		$.ajax({
	    		url: url+"Customer.php",
	    		type: "POST",
	    		dataType: "JSON",
	    		data:{
	    			'action': 'selectAll',
	    		},

	    		success: function(data){
	    			$('#table-search-user').DataTable()
	    			loadingSearchUser()
	    			var row;
	    			$.each(data['data'], function(i, val){
	    				row += "<tr>"+
	    				"<td>"+(i+1)+"</td>"+
	    				"<td>"+data['data'][i]['idpel']+"</td>"+
	    				"<td>"+data['data'][i]['nama']+"</td>"+
	    				"<td>"+data['data'][i]['alamat']+"</td>"+
	    				"<td>"+
	    					"<button class='btn btn-primary btn-sm' onclick='addCustomer("+data['data'][i]['id']+")'><i class='fa fa-plus'></i></button>"+
	    				"</td>"+
	    				"</tr>"
	    			})
	    			$('#table-search-user').DataTable().destroy()
	    			$('#user-content').html(row)
	    			$('#table-search-user').DataTable()

	    		},
	    		error: function(data){
	    			console.log('gagal')		    			
	    		}
	    	})
    	})

    	function addCustomer(id){
    		$.ajax({
    			url: url+"Customer.php",
    			type: "POST",
    			dataType: "JSON",
    			data: {
    				'action': 'select',
    				'id': id
    			},
    			success: function(data){
    				$('#customer-id').val(data[0]['id'])
    				$('#customer-name').html(data[0]['nama'])
    				$('#search-user-modal').modal('hide')
    			},
    			error: function(data){
    				console.log('gagal')
    			}
    		})
    	}

    	// add product to payment checkout
    	function addProduct(id){
    		$.ajax({
    			url: url+"Product.php",
    			type: "POST",
    			dataType: "JSON",
    			data: {
    				'action': 'select',
    				'id': id
    			},
    			success: function(data){
    				$('#no-data').remove()
    				$('#product-payment').append(
    					"<tr id='product"+data[0]['id']+"'>"+
    						"<input id='id-product' type='hidden' value='"+data[0]['id']+"'>"+
							"<td>"+data[0]['nama']+"</td>"+
							"<td>"+
							"<input type='hidden' id='old-product-amount"+data[0]['id']+"' value='"+1+"'>"+
							"<div id='product-amount"+data[0]['id']+"' contenteditable onkeyup='updatePrice("+data[0]['id']+")'>"+1+"</div>"+
							"</td>"+
							"<td id='price"+data[0]['id']+"'>"+accounting.formatMoney(data[0]['harga_jual'],"Rp",0)+"</td>"+
							"<td id='price-sumary"+data[0]['id']+"'>"+accounting.formatMoney(data[0]['harga_jual'],"Rp",0)+"</td>"+
							"<td><button class='btn btn-danger btn-sm' onclick='removeProduct("+data[0]['id']+")'><i class='fa fa-trash'></i></button></td>"+
						+"</tr>"
    				)

    				// get value from html element
    				var total = accounting.unformat($('#total-payment').text())

    				// binding value
    				$('#product-count').val(Number($('#product-count').val()) + 1)
    				$('#total-payment').html(accounting.formatMoney(Number(total) + Number(data[0]['harga_jual']),"Rp",0))
    				$('#total-pay').html(accounting.formatMoney(Number(total) + Number(data[0]['harga_jual']),"Rp",0))
    			},
    			error: function(data){
    				console.log('gagal')
    			}
    		})
    	}

    	function removeProduct(id){
    		// mengambil nilai total harga pembelian keseluruhan
    		var total = Number(accounting.unformat($('#total-payment').text()))
    		// mengambil nilai jumlah item produk
    		var count = Number(accounting.unformat($('#product-count').val()))
    		// mengambil nilai total harga produk * jumlah pembelian
    		var price_sumary = Number(accounting.unformat($('#price-sumary'+id).text()))
    		// mengambil nilai total bayar keseluruhan
    		var total_pay = Number(accounting.unformat($('#total-pay').text()))
    		// menghilangkan element produk
    		console.log('total: '+total)
    		console.log('count: '+count)
    		console.log('price_sumary: '+price_sumary)
    		console.log('total_pay: '+total_pay)
    		
    		count = count - 1;
    		$('#product-count').val(count)
    		if (count < 1) {
    			$('#product-payment').html(
    			"<tr id='no-data'>"+
					"<td colspan='5' class='text-center'>Tidak ada data</td>"+
				"</tr>"
    			)
    		}
    		$('#total-payment').html(accounting.formatMoney(total - price_sumary,"Rp",0))
    		$('#total-pay').html(accounting.formatMoney(total_pay - price_sumary,"Rp",0))
    		$('#product'+id).remove()
    	}

    	function updatePrice(id){
    		// jumlah produk yg dibeli per produk sebelum diubah
    		var old_amount = Number($('#old-product-amount'+id).val())
    		// jumlah produk yg dibeli per produk setelah diubah
    		var new_amount = Number($('#product-amount'+id).text())
    		// mendapatkan value harga produk
    		var price = Number(accounting.unformat($('#price'+id).text()))
    		// total harga pembelian keseluruhan
    		var total = Number(accounting.unformat($('#total-payment').text()))
    		// harga total produk (jumlah produk * harga)
    		var price_sumary = Number(accounting.unformat($('#price-sumary'+id).text()))
    		// total bayar keseluruhan
    		var total_pay = Number(accounting.unformat($('#total-pay').text()))
    		// harga lama
    		var old_price = old_amount * price
    		// harga baru
    		var new_price = new_amount * price
    		// update total harga per item
    		$('#price-sumary'+id).html(new_price)
    		// set value product amount start
    		$('#old-product-amount'+id).val(new_amount)
    		// set total pembayaran
    		$('#total-payment').html(accounting.formatMoney((total - old_price) + new_price,"Rp",0))
    		// update total pembayaran setelah diskon
    		$('#total-pay').html(accounting.formatMoney((total_pay - old_price) + new_price,"Rp",0))
    		
    	}

    	function checkBalance(){
    		var total_pay = Number(accounting.unformat($('#total-pay').text()))
    		console.log("total pay: "+total_pay)
    		var payment_amount = Number(accounting.unformat($('#payment-amount').val()))
    		console.log('payment amount: '+payment_amount)
    		// var insufficient_payment = $('#insufficient-payment').text()
    		// var change_money = $('#change-money').text()
    		// console.log(payment_amount + "/" + insufficient_payment + "/" + change_money)
    		// 
    		var result = payment_amount - total_pay
    		console.log('result: '+result)
    		console.log(result >= 0)
    		if (result >= 0) {
    			$('#insufficient-payment').html(accounting.formatMoney(0,'Rp',0))
    			$('#change-money').html(accounting.formatMoney(result,'Rp',0))
    		}else{
    			$('#insufficient-payment').html(accounting.formatMoney(result,'Rp',0))
    			$('#change-money').html(accounting.formatMoney(0,'Rp',0))
    		}
    		console.log(result)
    	}
    </script>
</body>
</html>