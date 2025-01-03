@extends('layouts.app')

@section('content')

    <style>
        label {
            padding: 0px !important;
        }
    </style>
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>Average User's Login Per Month</h3>
            </div>
            <div class="box-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
        </div>
    </div>

@endsection
@section('css')
@endsection

@section('js')
    <script>
        window.onload = function () {

            var dataPoints = [];
            $.each(<?php echo json_encode($data)?>, function( index, value ) {
                console.log(value.date);
                dataPoints.push({
                    x: new Date(value.date),
                    y: parseInt(value.value)
                });
            });

            console.log(dataPoints);

            var options = {
                animationEnabled: true,
                title:{
                    text: ""
                },
                axisY :{
                    valueFormatString: "",
                    prefix: "",
                    suffix: " users",
                    title: ""
                },
                toolTip: {
                    shared: true
                },
                data: [
                    {
                        type: "line",
                        markerType: "square",
                        color: "#00a65a",
                        name: "",
                        xValueFormatString: "MMM YYYY",
                        yValueFormatString: "",
                        dataPoints: dataPoints
                    }
                ]
            };

            $("#chartContainer").CanvasJSChart(options);


        }
    </script>
@endsection
