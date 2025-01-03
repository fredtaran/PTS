<?php
$error = \Illuminate\Support\Facades\Input::get('error');
?>
@extends('layouts.app')

@section('content')
    <div style="padding-right: 2%;padding-left: 2%">

        <div class="row">
            <div class="jim-content">
                <form action="{{ asset('vaccine/vaccineview').'/'.$province_id }}" method="GET">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <select name="typeof_vaccine_filter" id="typeof_vaccine_filter" class="select2">
                                <option value="">Select Type of Vaccine</option>
                                <option value="Sinovac" <?php if(isset($typeof_vaccine_filter)){if($typeof_vaccine_filter == 'Sinovac')echo 'selected';} ?>>Sinovac</option>
                                <option value="Astrazeneca" <?php if(isset($typeof_vaccine_filter)){if($typeof_vaccine_filter == 'Astrazeneca')echo 'selected';} ?>>Astrazeneca</option>
                                <option value="SputnikV" <?php if(isset($typeof_vaccine_filter)){if($typeof_vaccine_filter == 'SputnikV')echo 'selected';} ?>>SputnikV</option>
                                <option value="Pfizer" <?php if(isset($typeof_vaccine_filter)){if($typeof_vaccine_filter == 'Pfizer')echo 'selected';} ?> disabled>Pfizer</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="muncity_filter" id="muncity_filter" class="select2">
                                <option value="">Select Municipality</option>
                                @foreach($muncity as $row)
                                    <option value="{{ $row->id }}" <?php if(isset($muncity_filter)){if($muncity_filter == $row->id)echo 'selected';} ?> >{{ $row->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="date_range" placeholder="Enter date range.." name="date_range" value="{{ date("m/d/Y",strtotime($date_start)).' - '.date("m/d/Y",strtotime($date_end)) }}">
                        </div>
                        <div class="col-md-3">
                         <span class="input-group-btn">
                            <button type="submit" class="btn btn-success" onclick="loadPage()"><i class="fa fa-filter"></i> Filter</button>
                             <a href="{{ asset('vaccine/export/excel') }}" type="button" class="btn btn-danger"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                            <a href="{{ asset('vaccine/vaccineview').'/'.$province_id }}" type="button" class="btn btn-warning" onclick="loadPage()"><i class="fa fa-eye"></i> View All</a>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9 jim-content">
                @if($error)
                    <div class="alert alert-danger">
                <span class="text-danger">
                    <i class="fa fa-times"></i> Error switching account! Please try again.
                </span>
                    </div>
                @endif
                <h3 class="page-header">Dashboard</h3>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Bar Chart</a></li>
                        <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false" onclick="tab2();">Line Chart</a></li>
                        <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false" onclick="tab3();">Vaccination Map</a></li>
                        <li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false" onclick="tab4();">Eligible Pop.(A1)</a></li>
                        <li class=""><a href="#tab5" data-toggle="tab" aria-expanded="false" onclick="tab5();">Eligible Pop.(A2)</a></li>
                        <li class=""><a href="#tab6" data-toggle="tab" aria-expanded="false" onclick="tab6();">Eligible Pop.(A3)</a></li>
                        <li class=""><a href="#tab7" data-toggle="tab" aria-expanded="false" onclick="tab7();">Eligible Pop.(A4)</a></li>
                        <li class=""><a href="#tab8" data-toggle="tab" aria-expanded="false" onclick="tab8();">Grand Total</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="row" style="padding-left: 1%;padding-right: 1%; ">
                                <div class="col-lg-3">
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3 style="font-size: 20pt;">Sinovac</h3>
                                            <p style="font-size:13pt"  class="sinovac_dashboard">{{ $sinovac_count >= 1 ? $sinovac_count : 0 }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-erlenmeyer-flask-bubbles"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3 style="font-size: 20pt;">Astrazeneca</h3>
                                            <p style="font-size:13pt" class="astra_dashboard">{{ $astrazeneca_count >= 1 ? $astrazeneca_count : 0 }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-erlenmeyer-flask-bubbles"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3 style="font-size: 20pt;">Sputnik V</h3>
                                            <p style="font-size:13pt" class="sputnikv_dashboard">{{ $sputnikv_count >= 1 ? $sputnikv_count : 0 }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-erlenmeyer-flask-bubbles"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3 style="font-size: 20pt;">Pfizer</h3>
                                            <p style="font-size:13pt" class="pfizer_dashboard">{{ $pfizer_count >= 1 ? $pfizer_count : 0 }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-erlenmeyer-flask-bubbles"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="page-header">Monthly Activity</h3>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="ion ion-erlenmeyer-flask-bubbles"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Target vaccination for A1</span>
                                            <span class="info-box-number">{{ number_format($a1_target) }}</span>

                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $a1_completion }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                                {{ $a1_completion }}% Goal Completion
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>

                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="ion ion-erlenmeyer-flask-bubbles"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Target vaccination for A2</span>
                                            <span class="info-box-number">{{ number_format($a2_target) }}</span>

                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $a2_completion }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                                {{ $a2_completion }}% Goal Completion
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>


                                    <div class="info-box bg-aqua">
                                        <span class="info-box-icon"><i class="ion ion-erlenmeyer-flask-bubbles"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Target vaccination for A3</span>
                                            <span class="info-box-number">{{ number_format($a3_target) }}</span>

                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $a3_completion }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                                {{ $a3_completion }}% Goal Completion
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>

                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="ion ion-erlenmeyer-flask-bubbles"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Targer vaccination for A4</span>
                                            <span class="info-box-number">{{ number_format($a4_target) }}</span>

                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ $a4_completion }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                                {{ $a4_completion }}% Goal Completion
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="jim-content tab_content2">

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div style="width: 100%">
                                <div class="jim-content row tab_content3">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab4">
                            <div style="width: 100%">
                                <div class="jim-content row tab_content4">
                                    Under Development
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab5">
                            <div style="width: 100%">
                                <div class="jim-content row tab_content5">
                                    Under Development
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab6">
                            <div style="width: 100%">
                                <div class="jim-content row tab_content6">
                                    Under Development
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab7">
                            <div style="width: 100%">
                                <div class="jim-content row tab_content7">
                                    Under Development
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab8">
                            <div style="width: 100%">
                                <div class="jim-content row tab_content8">
                                    Under Development
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row" style="padding-left:6%">
                    <div class="jim-content">
                        <div id="chartPercentCoverage" style="height: 335px; width: 100%;"></div>
                        <div style="width: 20%;height:20px;background-color: white;position: absolute;margin-top: -12px;"></div>
                    </div>
                </div>

                <div class="row" style="padding-left:6%">
                    <div class="jim-content">
                        <div id="chartConsumptionRate" style="height: 335px; width: 100%;"></div>
                        <div style="width: 20%;height:20px;background-color: white;position: absolute;margin-top: -12px;"></div>
                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection

@section('js')
    @include('script.chart')
    <script type="text/javascript">

        function tab2(){
            var path_gif_content = "<?php echo asset('img/loading.gif'); ?>";
            var loading_content = '<center><img src="'+path_gif_content+'" alt="" style="width:30%;"></center>';

            $(".tab_content2").html(loading_content);
            setTimeout(function(){
                $(".tab_content2").html('<iframe style="width: 100%;height: 800px;" src="<?php echo asset('vaccine/line_chart'); ?>"></iframe>');
            },1000);
        }

        function tab3(){
            var path_gif_content = "<?php echo asset('img/loading.gif'); ?>";
            var loading_content = '<center><img src="'+path_gif_content+'" alt="" style="width: 30%;"></center>';

            $(".tab_content3").html(loading_content);
            $.get("<?php echo asset('vaccine/map'); ?>",function(data){
                setTimeout(function(){
                    $(".tab_content3").html(data);
                },500);
            });
        }
        function tab4(){
            var path_gif_content = "<?php echo asset('img/loading.gif'); ?>";
            var loading_content = '<center><img src="'+path_gif_content+'" alt="" style="width: 30%;"></center>';

            $(".tab_content4").html(loading_content);
            $.get("<?php echo asset('vaccine/summary/report'); ?>",function(data){
                setTimeout(function(){
                    $(".tab_content4").html(data);
                },500);
            });
        }

        function tab5(){
            var path_gif_content = "<?php echo asset('img/loading.gif'); ?>";
            var loading_content = '<center><img src="'+path_gif_content+'" alt="" style="width: 30%;"></center>';

            $(".tab_content5").html(loading_content);
            $.get("<?php echo asset('vaccine/tab5/report'); ?>",function(data){
                setTimeout(function(){
                    $(".tab_content5").html(data);
                },500);
            });
        }


          function tab6(){
            var path_gif_content = "<?php echo asset('img/loading.gif'); ?>";
            var loading_content = '<center><img src="'+path_gif_content+'" alt="" style="width: 30%;"></center>';

            $(".tab_content6").html(loading_content);
            $.get("<?php echo asset('vaccine/tab6/report'); ?>",function(data){
                setTimeout(function(){
                    $(".tab_content6").html(data);
                },500);
            });
        }
        function tab7(){
            var path_gif_content = "<?php echo asset('img/loading.gif'); ?>";
            var loading_content = '<center><img src="'+path_gif_content+'" alt="" style="width: 30%;"></center>';

            $(".tab_content7").html(loading_content);
            $.get("<?php echo asset('vaccine/tab7/report'); ?>",function(data){
                setTimeout(function(){
                    $(".tab_content7").html(data);
                },500);
            });
        }

        function tab8(){
            var path_gif_content = "<?php echo asset('img/loading.gif'); ?>";
            var loading_content = '<center><img src="'+path_gif_content+'" alt="" style="width: 30%;"></center>';

            $(".tab_content8").html(loading_content);
            $.get("<?php echo asset('vaccine/tab8/report'); ?>",function(data){
                setTimeout(function(){
                    $(".tab_content8").html(data);
                },500);
            });
        }



        window.onload = function() {

            var percent_coverage_first = <?php echo $percent_coverage_first; ?>;
            var percent_coverage_second = <?php echo $percent_coverage_second ; ?>;
            var options3 = {
                legend:{
                    cursor:"pointer",
                    verticalAlign: "top",
                    horizontalAlign: "center",
                    dockInsidePlotArea: false,
                    fontSize: 12
                },
                title: {
                    text: "Percentage Coverage",
                    fontSize: 23,
                },
                animationEnabled: true,
                data: [{
                    type: "doughnut",
                    startAngle: 45,
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabel: "{label} ({y}%)",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "First Dose", y: percent_coverage_first, color:"#00a65a" },
                        { label: "Second Dose", y: percent_coverage_second, color:"#f39c12" },

                    ]
                }]
            };
            $("#chartPercentCoverage").CanvasJSChart(options3);

            var consumption_rate_first = <?php echo $consumption_rate_first; ?>;
            var consumption_rate_second = <?php echo $consumption_rate_second ; ?>;
            var options4 = {
                legend:{
                    cursor:"pointer",
                    verticalAlign: "top",
                    horizontalAlign: "center",
                    dockInsidePlotArea: false,
                    fontSize: 12
                },
                title: {
                    text: "Consumption Rate",
                    fontSize: 23,
                },
                animationEnabled: true,
                data: [{
                    type: "doughnut",
                    startAngle: 45,
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabel: "{label} ({y}%)",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "First Dose", y: consumption_rate_first, color:"#00a65a" },
                        { label: "Second Dose", y: consumption_rate_second, color:"#f39c12" },

                    ]
                }]
            };
            $("#chartConsumptionRate").CanvasJSChart(options4);

        };


        var chartdata = {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                // labels: month,
                datasets: [
                    {
                        label: 'Sinovac',
                        backgroundColor: '#dd4b39',
                        data: <?php echo json_encode($data["sinovac"]); ?>
                    },
                    {
                        label: 'Astrazeneca',
                        backgroundColor: '#f39c12',
                        data: <?php echo json_encode($data["astrazeneca"]); ?>
                    },
                    {
                        label: 'SputnikV',
                        backgroundColor: '#00a65a',
                        data: <?php echo json_encode($data["sputnikv"]); ?>
                    },
                    {
                        label: 'Pfizer',
                        backgroundColor: '#00c0ef',
                        data: <?php echo json_encode($data["pfizer"]); ?>
                    }
                ]
            }
        };
        var ctx = document.getElementById('barChart').getContext('2d');
        new Chart(ctx, chartdata);



    </script>
@endsection

