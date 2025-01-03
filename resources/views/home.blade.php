@extends('layouts.app')

@section('content')
<div class="col-md-9 wrapper">
    <div class="alert alert-jim">
        <h3 class="page-header">Member
            <small>Added</small>
        </h3>
        <canvas id="progress" width="400" height="200"></canvas>
    </div>
</div>
@include('sidebar.home')
@endsection

@section('js')
<script src="{{ asset('plugin/Chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('plugin/Chart.js/utils.js') }}"></script>
<script>

    $.ajax({
        url: "<?php echo asset('report/home'); ?>",
        type: "GET",
        success: function(data){
            console.log(data.bohol);
            var randomScalingFactor = function() {
                return Math.round(Math.random() * 100);
            };
            var config = {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Bohol",
                        fill: false,
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: data.bohol
                    }, {
                        label: "Cebu",
                        fill: false,
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: data.cebu
                    }, {
                        label: "Negros Or.",
                        fill: false,
                        backgroundColor: window.chartColors.green,
                        borderColor: window.chartColors.green,
                        data: data.negros
                    }, {
                        label: "Siquijor",
                        fill: false,
                        backgroundColor: window.chartColors.orange,
                        borderColor: window.chartColors.orange,
                        data: data.siquijor
                    }]
                },
                options: {
                    responsive: true,
                    showTooltips: true,
                    title:{
                        display:true,
                        text:'Member per Province'
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }]
                    }
                }
            };
            var ctx = document.getElementById("progress").getContext("2d");
            window.myLine = new Chart(ctx, config);
        }
    });

</script>
@endsection

