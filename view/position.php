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
    <title>Jabatan</title>
    <?php include 'asset_css.php' ?>
</head>
<body>
    <?php include "navigation.php" ?>

    <div class="container-fluid mt-3">
        <h3 class="mt-3">Master Jabatan</h3>
        <div class="mb-3 mt-4">
            <button class="btn btn-primary ml-0" data-toggle="modal" data-target="#add-position-modal"><i class="fa fa-plus mr-2"></i>Tambah Jabatan</button>
        </div>
        <div class="table table-responsive">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Jabatan</th>
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

    <!-- Modal Tambah position -->
    <div class="modal fade" id="add-position-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="nama-position-add">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama-position-add" id="nama-position-add" onblur="isEmpty('nama-position-add', 'nama-position-add-error', 'Nama')">
                        <small class="text-danger" id="nama-position-add-error"></small>
                    </div>
                    <div>
                        <label for="keterangan-position-add">Keterangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="keterangan-position-add" id="keterangan-position-add" onblur="isEmpty('keterangan-position-add', 'keterangan-position-add-error', 'Keterangan')">
                        <small class="text-danger" id="keterangan-position-add-error"></small>
                    </div>
                </div>              
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="button" id="add" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit position -->
    <div class="modal fade" id="edit-position-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" id="id-position-edit" name="id-position-edit">
                        <label for="nama-position-edit">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama-position-edit" id="nama-position-edit" onblur="isEmpty('nama-position-edit', 'nama-position-edit-error', 'Nama')">
                        <small class="text-danger" id="nama-position-edit-error"></small>
                    </div>
                    <div>
                        <label for="keterangan-position-edit">Keterangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="keterangan-position-edit" id="keterangan-position-edit" onblur="isEmpty('keterangan-position-edit', 'keterangan-position-edit-error', 'Keterangan')">
                        <small class="text-danger" id="keterangan-position-edit-error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="button" id="edit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete position -->
    <div class="modal fade" id="delete-position-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="id-position-delete" name="id-position-delete">
                    <table class="table table-borderless">
                        <tr>
                            <td>Nama jabatan</td>
                            <td>:</td>
                            <td id="nama-position-delete"></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td id="keterangan-position-delete"></td>
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
                url: url+"Position.php",
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
                        "<td id='keterangan"+data['data'][i]['id']+"'>"+data['data'][i]['keterangan']+"</td>"+
                        "<td>"+
                        "<button id='edit-position"+data['data'][i]['id']+"' class='btn btn-primary btn-sm mr-2' data-id='"+data['data'][i]['id']+"' data-toggle='modal' data-target='#edit-position-modal'><i class='fa fa-pen'></i></button>"+
                        "<button id='delete-position"+data['data'][i]['id']+"' class='btn btn-danger btn-sm' data-id='"+data['data'][i]['id']+"' data-toggle='modal' data-target='#delete-position-modal'><i class='fa fa-trash'></i></button>"+
                        "</td></tr>"
                    })
                    $('#table-content').html(row)
                    $('#table').DataTable();
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        }

        // call refresh funtion
        refresh()

        // ajax add data
        $('#add').click(function(){
            $.ajax({
                url: url+"Position.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'store',
                    'nama': $('#nama-position-add').val(),
                    'keterangan': $('#keterangan-position-add').val()
                },
                success: function(data){
                    $('#add-position-modal').modal('hide')
                    $('#table').DataTable().destroy()
                    refresh()
                    toastr.success('Data jabatan berhasil ditambahkan')
                    // clear input in add modal
                    $('#nama-position-add').val('')
                    $('#keterangan-position-add').val('')
                },
                error: function(data){
                    toastr.error('Data jabatan gagal ditambahkan')
                }
            })
        })

        // add value to edit modal
        $('#edit-position-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"Position.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                }, 
                success: function(data){
                    $('#id-position-edit').val(data[0]['id'])
                    $('#nama-position-edit').val(data[0]['nama'])
                    $('#keterangan-position-edit').val(data[0]['keterangan'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // ajax edit
        $('#edit').click(function(){
            $.ajax({
                url: url+"Position.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'update',
                    'id': $('#id-position-edit').val(),
                    'nama': $('#nama-position-edit').val(),
                    'keterangan': $('#keterangan-position-edit').val()
                }, 
                success: function(data){
                    $('#edit-position-modal').modal('hide')
                    $('#nama'+data['id']).html(data['nama'])
                    $('#keterangan'+data['id']).html(data['info'])
                    toastr.success('Data jabatan berhasil diperbaharui')
                },
                error: function(data){
                    toastr.error('Data jabatan gagal diperbaharui')
                }
            })
        })

        // add value to delete modal
        $('#delete-position-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"Position.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                }, 
                success: function(data){
                    $('#id-position-delete').val(data[0]['id'])
                    $('#nama-position-delete').html(data[0]['nama'])
                    $('#keterangan-position-delete').html(data[0]['keterangan'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // delete ajax
        $('#delete').click(function(){
            $.ajax({
                url: url+"Position.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'delete',
                    'id': $('#id-position-delete').val()
                },
                success: function(data){
                    $('#delete-position-modal').modal('hide')
                    $('#table').DataTable().destroy()
                    refresh()
                    toastr.success('Data jabatan berhasil dihapus')
                },
                error: function(data){
                    toastr.error('Data jabatan gagal ditambahkan')
                }
            })
        })
    </script>
</body>
</html>