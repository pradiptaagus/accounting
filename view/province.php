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
        <h3 class="mt-3">Master Propinsi</h3>
        <div class="mb-3 mt-4">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus mr-2"></i>Tambah Propinsi</button>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Propinsi</th>
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

    <!-- add modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby   ="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id-negara-add">Negara <span class="text-danger">*</span></label>
                        <select class="form-control" id="id-negara-add">
                            <option>- Pilih negara -</option>
                            <?php
                                $sql = "SELECT tb_negara.`id`, tb_negara.`nama` FROM tb_negara";
                                $exec = mysqli_query($db, $sql);
                                while ($data = mysqli_fetch_assoc($exec)) {
                                    echo
                                    "<option value='".$data['id']."'>".$data['nama']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="nama-propinsi-add">Nama Provinsi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama-propinsi-add" id="nama-propinsi-add">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="add" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby   ="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id-negara-edit">Negara <span class="text-danger">*</span></label>
                        <select class="form-control" id="id-negara-edit">
                            <option>- Pilih negara -</option>
                            <?php
                                $sql = "SELECT tb_negara.`id`, tb_negara.`nama` FROM tb_negara";
                                $exec = mysqli_query($db, $sql);
                                while ($data = mysqli_fetch_assoc($exec)) {
                                    echo
                                    "<option value='".$data['id']."'>".$data['nama']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="nama-propinsi-edit">Nama Provinsi <span class="text-danger">*</span></label>
                        <input type="hidden" id="id-propinsi-edit" name="id-propinsi-edit">
                        <input type="text" class="form-control" name="nama-propinsi-edit" id="nama-propinsi-edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" id="edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby   ="exampleModalLabel" aria-hidden="true">
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
                    <table class="table table-borderless">
                        <input type="hidden" name="id-propinsi-delete" id="id-propinsi-delete" value="">
                        <tr>
                            <td>Nama propinsi</td>
                            <td>:</td>
                            <td id="nama-propinsi-delete"></td>
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
                url: url+"Province.php",
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
                        "<button id='edit-province"+data['data'][i]['id']+"' data-id='"+data['data'][i]['id']+"' class='btn btn-primary btn-sm mr-2' data-toggle='modal' data-target='#edit-modal'><i class='fa fa-pen'></i></button>"+
                        "<button id='delete-province"+data['data'][i]['id']+"' data-id='"+data['data'][i]['id']+"' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#delete-modal'><i class='fa fa-trash'></i></button>"+
                        "</td></tr>"
                    })
                    $('#table-content').html(row)
                    $('#table').DataTable({
                        "columnDefs": [
                            {"width": "5%", "targets": 0},
                            {"width": "8%", "targets": 2}
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
            if ($('#nama-propinsi-add').val() == '' || $('#id-negara-add').val() == '') {
                alert('Kolom dengan tanda bintang (*) harus diisi')
            }else{
                $.ajax({
                    url: url+"Province.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        'action': 'store',
                        'nama': $('#nama-propinsi-add').val(),
                        'id-negara': $('#id-negara-add').val()
                    },
                    success: function(data){
                        $('#add-modal').modal('hide')
                        $('#table').DataTable().destroy()
                        refresh()
                        toastr.success('Data berhasil ditambahkan')
                    },
                    error: function(data){
                        toastr.error('Data gagal ditambahkan')
                    }
                })
            }
        })

        // add data on modal edit
        $('#edit-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"Province.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                },
                success: function(data){
                    $('#id-negara-edit').val(data['data']['id_negara'])
                    $('#id-propinsi-edit').val(data['data']['id'])
                    $('#nama-propinsi-edit').val(data['data']['nama'])
                },
                error: function(data){
                    console.log('error')
                }
            })
        })

        // edit ajax
        $('#edit').click(function(){
            if ($('#id-negara-edit').val() == '' || $('#nama-propinsi-edit').val() == '') {
                alert('Kolom dengan tanda bintang (*) harus diisi')
            }else{
                $.ajax({
                    url: url+"Province.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        'action': 'update',
                        'id': $('#id-propinsi-edit').val(),
                        'nama': $('#nama-propinsi-edit').val(),
                        'id-negara': $('#id-negara-edit').val()
                    },
                    success: function(data){
                        console.log('berhasil')
                        $('#edit-modal').modal('hide')
                        $('#nama'+$('#id-propinsi-edit').val()).html(data['nama'])
                        toastr.success('Data berhasil diperbaharui')
                    },
                    error: function(data){
                        console.log('gagal')
                    }
                })
            }
        })

        // add data on modal delete
        $('#delete-modal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            $.ajax({
                url: url+"Province.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'select',
                    'id': id
                },
                success: function(data){
                    $('#id-propinsi-delete').val(data['data']['id'])
                    $('#nama-propinsi-delete').html(data['data']['nama'])
                },
                error: function(data){
                    console.log('gagal')
                }
            })
        })

        // delete ajax
        $('#delete').click(function(){
            $.ajax({
                url: url+"Province.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'delete',
                    'id': $('#id-propinsi-delete').val()
                },
                success: function(data){
                    $('#delete-modal').modal('hide')
                    $('#table').DataTable().destroy()
                    refresh()
                    toastr.success('Data berhasil dihapus')
                },
                error: function(data){
                    console.log('error')
                }
            })
        })
    </script>
</body>
</html>