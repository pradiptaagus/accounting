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
    <title>Negara</title>
  	<?php include 'asset_css.php' ?>
</head>
<body>
    <?php include "navigation.php" ?>

    <div class="container-fluid mt-3">
        <h3 class="mt-3">Master Negara</h3>
        <div class="mb-3 mt-4">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus mr-2"></i>Tambah Negara</button>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Negara</th>
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

    <!-- Modal add -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=" exampleModalLabel">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label    ="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama-add">Nama Negara <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama-add" id="nama-add" onblur="isEmpty('nama-add', 'nama-add-error', 'Nama negara')">
                        <small class="text-danger" id="nama-add-error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="add" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label    ="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id-edit" id="id-edit" value="">
                    <div class="mb-3">
                        <label for="nama-edit">Nama Negara <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama-edit" id="nama-edit" onblur="isEmpty('nama-edit', 'nama-edit-error', 'Nama negara')">
                        <small class="text-danger" id="nama-edit-error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"   aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apakah Anda yakin menghapus data berikut?</p>
                    <input type="hidden" id="id-delete" name="id-delete">
                    <table class="table table-borderless">
                        <tr>
                            <td>Nama negara</td>
                            <td>:</td>
                            <td id="nama-delete"></td>
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
        // add data to table
        function refresh(){
            $.ajax({
                url: url+"Country.php",
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
                        "<button id='edit-negara"+data['data'][i]['id']+"' data-id='"+data['data'][i]['id']+"' class='btn btn-primary btn-sm mr-2' data-toggle='modal' data-target='#edit-modal'><i class='fa fa-pen'></i></button>"+
                        "<button id='delete-negara"+data['data'][i]['id']+"' data-id='"+data['data'][i]['id']+"' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-trash'></i></button>"+
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

        // add ajax data
        $('#add').click(function(){
            $.ajax({
                url: url+"Country.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'store',
                    'nama': $('#nama-add').val()
                },
                success: function(data){
                    $('#add-modal').modal('hide')
                    $('#table').DataTable().destroy()
                    refresh()
                    toastr.success('Data negara berhasil ditambahkan')
                    // clear input in add modal
                    $('#nama-add').val('')
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // add value to edit modal
        $('#edit-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"Country.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                },
                success: function(data){
                    $('#id-edit').val(data[0]['id'])
                    $('#nama-edit').val(data[0]['nama'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // ajax edit
        $('#edit').click(function(){
            $.ajax({
                url: url+"Country.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'update',
                    'id': $('#id-edit').val(),
                    'nama': $('#nama-edit').val()
                },
                success: function(data){
                    $('#edit-modal').modal('hide')
                    $('#nama'+data['id']).html(data['nama'])
                    toastr.success('Data negara berhasil diperbaharui')
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // add value to delete modal
        $('#delete-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"Country.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                },
                success: function(data){
                    $('#id-delete').val(data[0]['id'])
                    $('#nama-delete').html(data[0]['nama'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // delete ajax
        $('#delete').click(function(){
            $.ajax({
                url: url+"Country.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'delete',
                    'id': $('#id-delete').val()
                },
                success: function(data){
                    $('#delete-modal').modal('hide')
                    $('#table').DataTable().destroy()
                    refresh()
                    toastr.success('Data negara berhasil dihapus')
                },
                error: function(data){
                    toastr.error('Data negara gagal dihapus')
                }
            })
        })
    </script>
</body>
</html>