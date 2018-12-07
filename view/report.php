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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'asset_css.php' ?>
</head>
<body>
    <?php include "navigation.php" ?>
    
    <div class="container-fluid">
        <h3 class="mt-3">Report</h3>
        <div class="row">
            <div class="col card ml-4 mr-2">
                <div class="card-body">
                    <h5 style="display: inline" class="mr-2">Penjualan</h5>
                    <select style="display: inline; width: 20%" class="form-control form-control-sm" type="text" name="timeChart" id="timeChart">
                        <option value="thisWeek">Minggu ini</option>
                        <option value="thisMonth">Bulan ini</option>
                        <option value="lastWeek">Minggu lalu</option>
                        <option value="LastMonth">Bulan lalu</option>
                    </select>

                    <div class="table-responsive mt-3">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama barang</th>
                                    <th>Total terjual</th>
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
            </div>
            <div class="col card ml-2 mr-4">
                <div class="card-body">
                    <h5 style="display: inline" class="mr-2">10 Barang terlaris</h5>
                    <select style="display: inline; width: 20%" class="form-control form-control-sm" type="text" name="timeChart" id="timeChart">
                        <option value="thisWeek">Minggu ini</option>
                        <option value="thisMonth">Bulan ini</option>
                        <option value="lastWeek">Minggu lalu</option>
                        <option value="LastMonth">Bulan lalu</option>
                    </select>
                    <canvas id="myChart" class="mt-4" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        
    </div>

    <?php include "asset_js.php" ?>
    <script>
        // add data
        function refresh(){
            $.ajax({
                url: url+"Report.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'selectAll'
                },
                success: function(data){
                    var row = ""
                    $.each(data['data'], function(i, val){
                        row += "<tr id='row"+data['data'][i]['id']+"'>"+
                            "<td id='index"+data['data'][i]['id']+"'>"+(i+1)+"</td>"+
                            "<td id='nama"+data['data'][i]['id']+"'>"+data['data'][i]['nama']+"</td>"+
                            "<td id='total"+data['data'][i]['id']+"'>"+data['data'][i]['total']+"</td>"+
                            "</tr>";
                    });
                    $("#table-content").html(row);
                    $("#table").DataTable();
                },
                error: function(){
                    
                }
            })

            console.log('test')
        }

        function topProduct(){
            $.ajax({
                url: url+"Report.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    'action': 'selectLimit'
                },
                success: function(data){
                    nameArr = [];
                    valueArr = [];
                    $.each(data['data'], function(i, val){
                        nameArr.push(data['data'][i]['nama'])   
                        valueArr.push(data['data'][i]['total'])
                    })  
                    var ctx = $('#myChart')
                    var myBarChart = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: {
                            labels: nameArr,
                            datasets: [{
                                label: '# of Votes',
                                data: valueArr,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(255, 99, 132, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            title: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });                
                },
                error: function(){
                    
                }
            })

            console.log('test')
        }

        topProduct();

        refresh();
    </script>
</body>
</html>