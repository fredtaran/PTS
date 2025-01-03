@extends('layouts.app')

@section('content')

    <div class="box box-success">
        <div class="box-body no-padding">
            <div class="box-body">
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
            </div>
        </div>

    </div>

@endsection
@section('css')


@endsection

@section('js')

    <script>
        window.onload = function () {

            var options = {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: "Number of cases"
                },
                axisX:{
                    valueFormatString: "DD MMM"
                },
                axisY: {
                    title: "Number of Sales",
                    suffix: "K",
                    minimum: 0
                },
                toolTip:{
                    shared:true
                },
                legend:{
                    cursor:"pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "center",
                    dockInsidePlotArea: false,
                    fontSize: 20,
                    itemclick: toogleDataSeries
                },
                data: [
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases1",
                        markerType: "square",
                        xValueFormatString: "DD MMM, YYYY",
                        color: "#F08080",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 22 },
                            { x: new Date(2017, 10, 2), y: 69 },
                            { x: new Date(2017, 10, 3), y: 45 },
                            { x: new Date(2017, 10, 4), y: 20 },
                            { x: new Date(2017, 10, 5), y: 31 },
                            { x: new Date(2017, 10, 6), y: 65 },
                            { x: new Date(2017, 10, 7), y: 73 },
                            { x: new Date(2017, 10, 8), y: 96 },
                            { x: new Date(2017, 10, 9), y: 84 },
                            { x: new Date(2017, 10, 10), y: 85 },
                            { x: new Date(2017, 10, 11), y: 86 },
                            { x: new Date(2017, 10, 12), y: 92 },
                            { x: new Date(2017, 10, 13), y: 57 },
                            { x: new Date(2017, 10, 14), y: 66 },
                            { x: new Date(2017, 10, 15), y: 99 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases2",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 20 },
                            { x: new Date(2017, 10, 2), y: 57 },
                            { x: new Date(2017, 10, 3), y: 71 },
                            { x: new Date(2017, 10, 4), y: 86 },
                            { x: new Date(2017, 10, 5), y: 54 },
                            { x: new Date(2017, 10, 6), y: 95 },
                            { x: new Date(2017, 10, 7), y: 54 },
                            { x: new Date(2017, 10, 8), y: 19 },
                            { x: new Date(2017, 10, 9), y: 65 },
                            { x: new Date(2017, 10, 10), y: 36 },
                            { x: new Date(2017, 10, 11), y: 23 },
                            { x: new Date(2017, 10, 12), y: 27 },
                            { x: new Date(2017, 10, 13), y: 66 },
                            { x: new Date(2017, 10, 14), y: 46 },
                            { x: new Date(2017, 10, 15), y: 64 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases3",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 20 },
                            { x: new Date(2017, 10, 2), y: 57 },
                            { x: new Date(2017, 10, 3), y: 31 },
                            { x: new Date(2017, 10, 4), y: 46 },
                            { x: new Date(2017, 10, 5), y: 44 },
                            { x: new Date(2017, 10, 6), y: 85 },
                            { x: new Date(2017, 10, 7), y: 84 },
                            { x: new Date(2017, 10, 8), y: 29 },
                            { x: new Date(2017, 10, 9), y: 15 },
                            { x: new Date(2017, 10, 10), y: 26 },
                            { x: new Date(2017, 10, 11), y: 23 },
                            { x: new Date(2017, 10, 12), y: 47 },
                            { x: new Date(2017, 10, 13), y: 36 },
                            { x: new Date(2017, 10, 14), y: 56 },
                            { x: new Date(2017, 10, 15), y: 54 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases4",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 60 },
                            { x: new Date(2017, 10, 2), y: 87 },
                            { x: new Date(2017, 10, 3), y: 21 },
                            { x: new Date(2017, 10, 4), y: 26 },
                            { x: new Date(2017, 10, 5), y: 14 },
                            { x: new Date(2017, 10, 6), y: 15 },
                            { x: new Date(2017, 10, 7), y: 34 },
                            { x: new Date(2017, 10, 8), y: 79 },
                            { x: new Date(2017, 10, 9), y: 85 },
                            { x: new Date(2017, 10, 10), y: 16 },
                            { x: new Date(2017, 10, 11), y: 13 },
                            { x: new Date(2017, 10, 12), y: 27 },
                            { x: new Date(2017, 10, 13), y: 96 },
                            { x: new Date(2017, 10, 14), y: 26 },
                            { x: new Date(2017, 10, 15), y: 64 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases5",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 60 },
                            { x: new Date(2017, 10, 2), y: 97 },
                            { x: new Date(2017, 10, 3), y: 81 },
                            { x: new Date(2017, 10, 4), y: 56 },
                            { x: new Date(2017, 10, 5), y: 74 },
                            { x: new Date(2017, 10, 6), y: 25 },
                            { x: new Date(2017, 10, 7), y: 14 },
                            { x: new Date(2017, 10, 8), y: 69 },
                            { x: new Date(2017, 10, 9), y: 25 },
                            { x: new Date(2017, 10, 10), y: 86 },
                            { x: new Date(2017, 10, 11), y: 23 },
                            { x: new Date(2017, 10, 12), y: 67 },
                            { x: new Date(2017, 10, 13), y: 96 },
                            { x: new Date(2017, 10, 14), y: 26 },
                            { x: new Date(2017, 10, 15), y: 14 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases6",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 20 },
                            { x: new Date(2017, 10, 2), y: 57 },
                            { x: new Date(2017, 10, 3), y: 71 },
                            { x: new Date(2017, 10, 4), y: 96 },
                            { x: new Date(2017, 10, 5), y: 84 },
                            { x: new Date(2017, 10, 6), y: 25 },
                            { x: new Date(2017, 10, 7), y: 14 },
                            { x: new Date(2017, 10, 8), y: 19 },
                            { x: new Date(2017, 10, 9), y: 15 },
                            { x: new Date(2017, 10, 10), y: 26 },
                            { x: new Date(2017, 10, 11), y: 53 },
                            { x: new Date(2017, 10, 12), y: 27 },
                            { x: new Date(2017, 10, 13), y: 26 },
                            { x: new Date(2017, 10, 14), y: 56 },
                            { x: new Date(2017, 10, 15), y: 64 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases7",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 60 },
                            { x: new Date(2017, 10, 2), y: 57 },
                            { x: new Date(2017, 10, 3), y: 51 },
                            { x: new Date(2017, 10, 4), y: 56 },
                            { x: new Date(2017, 10, 5), y: 54 },
                            { x: new Date(2017, 10, 6), y: 55 },
                            { x: new Date(2017, 10, 7), y: 54 },
                            { x: new Date(2017, 10, 8), y: 69 },
                            { x: new Date(2017, 10, 9), y: 65 },
                            { x: new Date(2017, 10, 10), y: 66 },
                            { x: new Date(2017, 10, 11), y: 63 },
                            { x: new Date(2017, 10, 12), y: 67 },
                            { x: new Date(2017, 10, 13), y: 66 },
                            { x: new Date(2017, 10, 14), y: 56 },
                            { x: new Date(2017, 10, 15), y: 64 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases8",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 60 },
                            { x: new Date(2017, 10, 2), y: 57 },
                            { x: new Date(2017, 10, 3), y: 51 },
                            { x: new Date(2017, 10, 4), y: 56 },
                            { x: new Date(2017, 10, 5), y: 54 },
                            { x: new Date(2017, 10, 6), y: 55 },
                            { x: new Date(2017, 10, 7), y: 54 },
                            { x: new Date(2017, 10, 8), y: 69 },
                            { x: new Date(2017, 10, 9), y: 65 },
                            { x: new Date(2017, 10, 10), y: 66 },
                            { x: new Date(2017, 10, 11), y: 63 },
                            { x: new Date(2017, 10, 12), y: 67 },
                            { x: new Date(2017, 10, 13), y: 66 },
                            { x: new Date(2017, 10, 14), y: 56 },
                            { x: new Date(2017, 10, 15), y: 64 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases9",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 60 },
                            { x: new Date(2017, 10, 2), y: 57 },
                            { x: new Date(2017, 10, 3), y: 51 },
                            { x: new Date(2017, 10, 4), y: 56 },
                            { x: new Date(2017, 10, 5), y: 54 },
                            { x: new Date(2017, 10, 6), y: 55 },
                            { x: new Date(2017, 10, 7), y: 54 },
                            { x: new Date(2017, 10, 8), y: 69 },
                            { x: new Date(2017, 10, 9), y: 65 },
                            { x: new Date(2017, 10, 10), y: 66 },
                            { x: new Date(2017, 10, 11), y: 63 },
                            { x: new Date(2017, 10, 12), y: 67 },
                            { x: new Date(2017, 10, 13), y: 66 },
                            { x: new Date(2017, 10, 14), y: 56 },
                            { x: new Date(2017, 10, 15), y: 64 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cases10",
                        yValueFormatString: "#,##0K",
                        dataPoints: [
                            { x: new Date(2017, 10, 1), y: 60 },
                            { x: new Date(2017, 10, 2), y: 57 },
                            { x: new Date(2017, 10, 3), y: 51 },
                            { x: new Date(2017, 10, 4), y: 56 },
                            { x: new Date(2017, 10, 5), y: 54 },
                            { x: new Date(2017, 10, 6), y: 55 },
                            { x: new Date(2017, 10, 7), y: 54 },
                            { x: new Date(2017, 10, 8), y: 69 },
                            { x: new Date(2017, 10, 9), y: 65 },
                            { x: new Date(2017, 10, 10), y: 66 },
                            { x: new Date(2017, 10, 11), y: 63 },
                            { x: new Date(2017, 10, 12), y: 67 },
                            { x: new Date(2017, 10, 13), y: 66 },
                            { x: new Date(2017, 10, 14), y: 56 },
                            { x: new Date(2017, 10, 15), y: 64 }
                        ]
                    }

                ]
            };
            $("#chartContainer").CanvasJSChart(options);

            function toogleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else{
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }

        }
    </script>

@endsection

