<?php
$user = Session::get('auth');
$searchKeyword = Session::get('searchKeyword');
$keyword = '';
if($searchKeyword){
    $keyword = $searchKeyword['keyword'];
}
?>
@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px;
        }
        .form-group {
            margin-bottom: 10px;
        }
    </style>
    <div class="col-md-9">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}</h3>
            </div>
            <div class="box-body">
                <div class="col-sm-4 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL DOCTORS</span>
                            <span class="info-box-number countDoctors"><i class="fa fa-refresh fa-spin"></i></span>
                            <div class="progress">
                                <div class="progress-bar profilePercentageBar"></div>
                            </div>
                            <span class="progress-description">
                  </span>
                        </div><!-- /.info-box-content -->
                    </div>
                </div>

                <div class="col-sm-4 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ONLINE DOCTORS</span>
                            <span class="info-box-number countOnline"><i class="fa fa-refresh fa-spin"></i></span>
                            <div class="progress">
                                <div class="progress-bar profilePercentageBar"></div>
                            </div>
                            <span class="progress-description">
                  </span>
                        </div><!-- /.info-box-content -->
                    </div>
                </div>

                <div class="col-sm-4 col-xs-12">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-file-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">REFERRED PATIENTS</span>
                            <span class="info-box-number countReferral"><i class="fa fa-refresh fa-spin"></i></span>
                            <div class="progress">
                                <div class="progress-bar profilePercentageBar"></div>
                            </div>
                            <span class="progress-description"></span>
                        </div><!-- /.info-box-content -->
                    </div>
                </div>
            </div>
        </div>

        <div class="jim-content">
            <h3 class="page-header">Monthly Activity
            </h3>
            <div class="chart">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box box-success">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
    </div>
@endsection
@section('js')
    @include('script.chart')
    <script>
        var accepted = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var rejected = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var link = "{{ url('chart') }}";
        $.ajax({
            url: link,
            type: "GET",
            success: function(data){
                console.log(data)
                var chartdata = {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        // labels: month,
                        datasets: [
                            {
                                label: 'Accepted',
                                backgroundColor: '#26B99A',
                                data: data.accepted
                            },
                            {
                                label: 'Redirected',
                                backgroundColor: '#03586A',
                                data: data.rejected
                            }
                        ]
                    }
                };


                var ctx = document.getElementById('barChart').getContext('2d');
                new Chart(ctx, chartdata);
            }
        });

        var url = "{{ url('mcc/dashboard/count') }}";
        $.ajax({
            url: url,
            type: "GET",
            success: function(data)
            {
                setTimeout(function () {
                    $('.countDoctors').html(data.countDoctors);
                    $('.countOnline').html(data.countOnline);
                    $('.countReferral').html(data.countReferral);
                },500);
            }
        });
        $(".hospital_online").text("<?php echo Session::get('hospital_online_count'); ?>");


        window.onload = function() {

            var options = {
                title: {
                    text: "Users per department",
                    fontFamily: "Arial"
                },
                legend: {
                    horizontalAlign: "center", // "center" , "right"
                    verticalAlign: "top"  // "top" , "bottom"
                },
                animationEnabled: true,
                data: [{
                    type: "pie",
                    startAngle: 80,
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabel: "{label} ({y})",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: <?php echo $group_by_department; ?>
                }]
            };
            $("#chartContainer").CanvasJSChart(options);
        }

    </script>
@endsection

