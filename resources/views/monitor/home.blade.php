<?php
    $error = \Illuminate\Support\Facades\Input::get('error');
    $user = Session::get('auth');
    
    $facility = App\Facility::where('status',1)
    ->where('province',$user->province)
    ->orderBy('name','asc')
    ->get();
?>
@extends('layouts.app')

@section('content')
<style>
    @media print {
        .toHide {
            display: none;
        }
        .myBtn
        {
          display: none;  
        }
    }
</style>
    <!--
    <div class="jim-content">
        <iframe style="width: 100%;height: 700px;" src="https://dohph.maps.arcgis.com/apps/webappviewer/index.html?id=cf43a3468a4f4ee99ef128d89ea8a150&fbclid=IwAR0MHBpMuSjr0-ToS6oDHYI0c_gdhftfK3MTwioeIoLJPV5HPZaCexyqmw4"></iframe>
    </div>
    -->
         <div class="row toHide">
            <form action="{{ url('monitor') }}" method="POST" class="form-submit ">
                  {{ csrf_field() }}
                 <div class="col-md-4">
                        <select name="facility_filter" class="select2">
                    <option value="">Select Facility</option>
                        @foreach($facility as $row)
                        <option value="{{ $row->id }}" <?php if($facility_filter == $row->id)echo 'selected'; ?>>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    </div>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Filter</button>
                <button type="button" class="btn btn-primary btn-flat" onclick="printDocu()"><i class="fa fa-print"></i> Print</button>
                </div>
        </form>
        <br>
<div id="section-to-print">
    <div class="row">
                   
        <div class="col-md-9">
            <div class="jim-content">
                @if($error)
                    <div class="alert alert-danger">
                <span class="text-danger">
                    <i class="fa fa-times"></i> Error swtiching account! Please try again.
                </span>
                    </div>
                @endif
                <h3 class="page-header">Monthly Activity</h3>
                <div class="chart">
                    <canvas id="barChart"></canvas>
                </div>

                <h3 class="page-header" style="margin-top: 5%">Incoming Transaction as of <span class="text-primary" style="font-size: 10pt;"><i>{{ date('F d,Y',strtotime($date_start)) }} to {{ date('F d,Y',strtotime($date_end)) }}</i></span></h3>
                <div class="row" style="margin-top: 3%;">
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <br>
                            <h5 class="description-header">{{ $incoming_statistics->incoming }}</h5>
                            <span class="description-text">Incoming</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <?php
                                $accept_percent = ($incoming_statistics->accepted / $incoming_statistics->incoming) * 100;
                            ?>
                            <span class="description-percentage <?php if($accept_percent >= 50) echo 'text-green'; else echo 'text-red'; ?>"><i class="fa fa-<?php if($accept_percent >= 50) echo 'thumbs-o-up'; else echo 'thumbs-o-down'; ?>"></i> <b>({{ round($accept_percent)."%" }})</b></span>
                            <h5 class="description-header">{{ $incoming_statistics->accepted }}</h5>
                            <span class="description-text">Accepted</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <br>
                            <h5 class="description-header">
                                <?php
                                    $seen_only = $incoming_statistics->seen_total - $incoming_statistics->seen_accepted_redirected;
                                    echo $seen_only;
                                ?>
                            </h5>
                            <span class="description-text">Seen Only</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block">
                            <br>
                            <h5 class="description-header">
                                <?php
                                    $no_action = $incoming_statistics->incoming - ($incoming_statistics->accepted + $incoming_statistics->redirected + $seen_only);
                                    echo $no_action > 0 ? $no_action : 0;
                                ?>
                            </h5>
                            <span class="description-text">No Action</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-success">
                <div id="user_per_department" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-success">
                <div id="number_of_transaction" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>

    <div>
        <div class="row col-md-12">
            <div class="jim-content">
                <h3 class="page-header">Last 15 days transaction</h3>
                <div id="doctor_past_transaction" style="height: 370px; width: 100%;"></div>
                <div style="width: 20%;height:20px;background-color: white;position: absolute;margin-top: -12px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('plugin/printThis.js') }}"></script>
@include('script.chart')
<script>
    $( document ).ready(function() {
        loadChart();
    });

    function loadChart() {
        var doctor_monthly_report = <?php echo json_encode($doctor_monthly_report); ?>;
        console.log(doctor_monthly_report);

        var chartdata = {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                // labels: month,
                datasets: [
                    {
                        label: 'Referred',
                        backgroundColor: '#8e9cff',
                        data: doctor_monthly_report.referred
                    },
                    {
                        label: 'Accepted',
                        backgroundColor: '#26B99A',
                        data: doctor_monthly_report.accepted
                    },
                    {
                        label: 'Redirected',
                        backgroundColor: '#03586A',
                        data: doctor_monthly_report.redirected
                    }
                ]
            }
        };

        var ctx = document.getElementById('barChart').getContext('2d');
        new Chart(ctx, chartdata);

        var options_user_per_department = {
            title: {
                text: "Number of users per Department",
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
        $("#user_per_department").CanvasJSChart(options_user_per_department);

        var options_activity = {
            title: {
                text: "Number of Activity",
                fontFamily: "Arial"
            },
            legend: {
                horizontalAlign: "center", // "center" , "right"
                verticalAlign: "top"  // "top" , "bottom"
            },
            animationEnabled: true,
            data: [{
                type: "doughnut",
                startAngle: 80,
                showInLegend: "true",
                legendText: "{label}",
                indexLabel: "{label} ({y})",
                yValueFormatString:"#,##0.#"%"",
                dataPoints: [
                    { label: "Referred", y: "<?php echo $incoming_statistics->referred; ?>" },
                    { label: "Accepted", y: "<?php echo $incoming_statistics->accepted; ?>" },
                    { label: "Redirected", y: "<?php echo $incoming_statistics->redirected; ?>" },
                    { label: "Called", y: "<?php echo $incoming_statistics->calling; ?>" },
                    { label: "Arrived", y: "<?php echo $incoming_statistics->arrived; ?>" },
                    { label: "Transferred", y: "<?php echo $incoming_statistics->transferred; ?>" },
                    { label: "Admitted", y: "<?php echo $incoming_statistics->accepted; ?>" },
                    { label: "Discharge", y: "<?php echo $incoming_statistics->discharge; ?>" }
                ]
            }]
        };
        $("#number_of_transaction").CanvasJSChart(options_activity);

        //line chart
        var datapoints_referred = [];
        var datapoints_accepted = [];
        var datapoints_redirected = [];
        var options_days = {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: ""
            },
            axisX:{
                valueFormatString: "DD MMM"
            },
            axisY: {
                title: "",
                suffix: "",
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
                fontSize: 15,
                itemclick: toogleDataSeries
            },
            data: [
                {
                    type: "line",
                    showInLegend: true,
                    name: "Referred",
                    markerType: "square",
                    xValueFormatString: "DD MMM, YYYY",
                    yValueFormatString: "#,##",
                    dataPoints: datapoints_referred
                }
                ,
                {
                    type: "line",
                    showInLegend: true,
                    name: "Accepted",
                    markerType: "square",
                    yValueFormatString: "#,##",
                    dataPoints: datapoints_accepted
                },
                {
                    type: "line",
                    showInLegend: true,
                    name: "Redirected",
                    markerType: "square",
                    yValueFormatString: "#,##",
                    dataPoints: datapoints_redirected
                },
            ]
        };

        $.each(<?php echo json_encode($referred_past)?>, function( index, value ) {
            datapoints_referred.push({
                x: new Date(value.date),
                y: value.value
            });
        });

        $.each(<?php echo json_encode($accepted_past)?>, function( index, value ) {
            datapoints_accepted.push({
                x: new Date(value.date),
                y: value.value
            });
        });

        $.each(<?php echo json_encode($redirected_past)?>, function( index, value ) {
            datapoints_redirected.push({
                x: new Date(value.date),
                y: value.value
            });
        });

        $("#doctor_past_transaction").CanvasJSChart(options_days);

    }
    
    function toogleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else{
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }

    function printDocu() {
        $('#section-to-print').printThis({
            canvas: true
        });
    }

</script>
@endsection

