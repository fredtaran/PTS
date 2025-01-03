<h3 class="page-header">Last 30 days vaccinated</h3>
<div id="past_days_1" style="height: 370px; width: 100%;"></div>
<div style="width: 20%;height:20px;background-color: white;position: absolute;margin-top: -12px;"></div><br>
<div id="past_days_2" style="height: 370px; width: 100%;"></div>
<div style="width: 20%;height:20px;background-color: white;position: absolute;margin-top: -12px;"></div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('assets/js/jquery.min.js?v='.date('mdHis')) }}"></script>
<script src="{{ asset('assets/js/jquery.canvasjs.min.js') }}?v=1"></script>
<script>
    window.onload = function () {
        //line chart 1

        var dataPoints1 = [];
        var dataPoints2 = [];
        $.each(<?php echo json_encode($first_dose_past_1)?>, function (index, value) {
            dataPoints1.push({
                x: new Date(value.date),
                y: value.value
            });
        });

        $.each(<?php echo json_encode($second_dose_past_1)?>, function (index, value) {
            dataPoints2.push({
                x: new Date(value.date),
                y: value.value,
            });
        });

        var chart = new CanvasJS.Chart("past_days_1", {
            axisX: {
                valueFormatString: "DD MMM"
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "bottom",
                horizontalAlign: "center",
                dockInsidePlotArea: false,
                fontSize: 15,
                itemclick: toogleDataSeries1
            },
            animationEnabled: true,
            data: [
                {
                    type: "line",
                    name: "First Dose",
                    showInLegend: true,
                    lineColor: "#00a65a",
                    color: '#00a65a',
                    yValueFormatString: "#,###",
                    dataPoints: dataPoints1
                },
                {
                    type: "line",
                    name: "Second Dose",
                    showInLegend: true,
                    lineColor: "#f39c12",
                    color: '#f39c12',
                    yValueFormatString: "#,###",
                    dataPoints: dataPoints2
                }
            ]
        });
        chart.render();

        function toogleDataSeries1(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }

        //line chart 1

        //line chart 2
        var dataPoints1_2 = [];
        var dataPoints2_2 = [];
        $.each(<?php echo json_encode($first_dose_past_2)?>, function (index, value) {
            dataPoints1_2.push({
                x: new Date(value.date),
                y: value.value
            });
        });

        $.each(<?php echo json_encode($second_dose_past_2)?>, function (index, value) {
            dataPoints2_2.push({
                x: new Date(value.date),
                y: value.value,
            });
        });

        var chart_2 = new CanvasJS.Chart("past_days_2", {
            axisX: {
                valueFormatString: "DD MMM"
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "bottom",
                horizontalAlign: "center",
                dockInsidePlotArea: false,
                fontSize: 15,
                itemclick: toogleDataSeries2
            },
            animationEnabled: true,
            data: [
                {
                    type: "line",
                    name: "First Dose",
                    showInLegend: true,
                    lineColor: "#00a65a",
                    color: '#00a65a',
                    yValueFormatString: "#,###",
                    dataPoints: dataPoints1_2
                },
                {
                    type: "line",
                    name: "Second Dose",
                    showInLegend: true,
                    lineColor: "#f39c12",
                    color: '#f39c12',
                    yValueFormatString: "#,###",
                    dataPoints: dataPoints2_2
                }
            ]
        });
        chart_2.render();

        function toogleDataSeries2(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart_2.render();
        }
    }
</script>