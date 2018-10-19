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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kota</title>
    <?php include 'asset_css.php' ?>
</head>
<body>
    <?php include "navigation.php" ?>
    
    <div class="container-fluid">
        <h3 class="mt-3">Master Kota</h3>
        <div class="mb-3 mt-4">
            <button class="btn btn-primary ml-0" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus mr-2"></i>Tambah Kota</button>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kota</th>
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

    <!-- modal add -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="id-propinsi-add">Propinsi <span class="text-danger">*</span></label>
                        <select class="form-control" id="id-propinsi-add">
                            <option value="">- Pillih propinsi -</option>
                            <?php
                                $sql = "SELECT tb_propinsi.`id`, tb_propinsi.`nama` FROM tb_propinsi";
                                $result = mysqli_query($db, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo 
                                        "<option value='".$row['id']."'>".$row['nama']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="nama-kota-add">Nama kota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama-kota-add" name="nama-kota-add">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-mdb-color" data-dismiss="modal">Batal</button>
                    <button type="button" id="add" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="id-propinsi-edit">Propinsi <span class="text-danger">*</span></label>
                        <select class="form-control" id="id-propinsi-edit">
                            <option value="">- Pillih propinsi -</option>
                            <?php
                                $sql = "SELECT tb_propinsi.`id`, tb_propinsi.`nama` FROM tb_propinsi";
                                $result = mysqli_query($db, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo 
                                        "<option value='".$row['id']."'>".$row['nama']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <input type="hidden" id="id-kota-edit" name="id-kota-edit">
                        <label for="nama-kota-edit">Nama kota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama-kota-edit" name="nama-kota-edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-mdb-color" data-dismiss="modal">Batal</button>
                    <button type="button" id="edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id-kota-delete" name="id-kota-delete">
                    <p class="text-center">Apakah Anda yakin menghapus data berikut?</p>
                    <table class="table table-borderless">
                        <tr>
                            <td>Nama kota</td>
                            <td>:</td>
                            <td id="nama-kota-delete"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-mdb-color" data-dismiss="modal">Batal</button>
                    <button type="button" id="delete" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>


    <?php include 'asset_js.php' ?>
    <script>
        // add data to table
        function refresh(){
            $.ajax({
                url: url+"City.php",
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
                        "<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
                        "<td>"+
                        "<button id='edit-province"+data['data'][i]['id']+"' class='btn btn-primary btn-sm mr-2'><i class='fa fa-pen' data-toggle='modal' data-target='#edit-modal' data-id='"+data['data'][i]['id']+"'></i></button>"+
                        "<button id='delete-province"+data['data'][i]['id']+"' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#delete-modal' data-id='"+data['data'][i]['id']+"'><i class='fa fa-trash'></i></button>"+
                        "</td></tr>"
                    })
                    $('#table-content').html(row)
                    $('#table').DataTable({
                        "columnDefs": [
                            {"width": "4%", "targets": 0},
                            {"width": "15%", "targets": 2}
                        ]
                    })
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        }

        // call refresh function
        refresh()

        // add ajax
        $('#add').click(function(){
            if ($('#id-propinsi-add').val() == '' || $('#nama-kota-add').val() == '') {
                alert('Kolom dengan tanda bintang (*) harus diisi')
            }else{
                $.ajax({
                    url: url+"City.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        'action': 'store',
                        'id-propinsi': $('#id-propinsi-add').val(),
                        'nama': $('#nama-kota-add').val()
                    },
                    success: function(data){
                        $('#add-modal').modal('hide')
                        $('#table').DataTable().destroy()
                        refresh()
                        toastr.success('Data berhasil ditambahkan')
                    },
                    error: function(data){
                        console.log('error')
                    }
                })
            }
        })

        // add data on edit modal
        $('#edit-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"City.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                },
                success: function(data){
                    $('#id-kota-edit').val(data['data']['id'])
                    $('#id-propinsi-edit').val(data['data']['id_propinsi'])
                    $('#nama-kota-edit').val(data['data']['nama'])
                },
                error: function(data){
                    console.log('error')
                }
            })
        })

        // update ajax
        $('#edit').click(function(){
            if ($('#id-propinsi-edit').val() == '' || $('#nama-kota-edit').val() == '') {
                alert('Kolom dengan tanda bintang (*) harus diisi')
            }else{
                $.ajax({
                    url: url+"City.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        'action': 'update',
                        'id': $('#id-kota-edit').val(),
                        'id-propinsi': $('#id-propinsi-edit').val(),
                        'nama': $('#nama-kota-edit').val()
                    },
                    success: function(data){
                        $('#edit-modal').modal('hide')
                        $('#nama'+data['id']).html(data['nama'])
                        toastr.success('Data berhasil diperbaharui')
                    },
                    error: function(data){
                        console.log('error')
                    }
                })
            }
        })

        // add data on delete modal
        $('#delete-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"City.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                },
                success: function(data){
                    $('#id-kota-delete').val(data['data']['id'])
                    $('#nama-kota-delete').html(data['data']['nama'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // delete ajax
        $('#delete').click(function(){
            $.ajax({
                url: url+"City.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'delete',
                    'id': $('#id-kota-delete').val()
                },
                success: function(data){
                    $('#delete-modal').modal('hide')
                    $('#table').DataTable().destroy()
                    refresh()
                    toastr.success("Data berhasil dihapus")
                },
                error: function(data){
                    console.log('error')
                }
            })
        })
    </script>
</body>
</html>