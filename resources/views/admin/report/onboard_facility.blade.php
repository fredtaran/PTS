@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px !important;
        }
    </style>
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-body">
                @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <?php
                                $count = 0;

                                $facility_onboard[6] = 0;
                                $facility_total[6] = 0;
                                $facility_transaction[6]['with_transaction'] = 0;
                                $facility_transaction[6]['no_transaction'] = 0;

                                $facility_onboard[7] = 0;
                                $facility_total[7] = 0;
                                $facility_transaction[7]['with_transaction'] = 0;
                                $facility_transaction[7]['no_transaction'] = 0;

                                $facility_onboard[8] = 0;
                                $facility_total[8] = 0;
                                $facility_transaction[8]['with_transaction'] = 0;
                                $facility_transaction[8]['no_transaction'] = 0;

                                $facility_onboard[9] = 0;
                                $facility_total[9] = 0;
                                $facility_transaction[9]['with_transaction'] = 0;
                                $facility_transaction[9]['no_transaction'] = 0;

                                $hospital_type[6]['government'] = 0;
                                $hospital_type[6]['RHU'] = 0;
                                $hospital_type[6]['birthing_home'] = 0;
                                $hospital_type[6]['private'] = 0;

                                $hospital_type[7]['government'] = 0;
                                $hospital_type[7]['RHU'] = 0;
                                $hospital_type[7]['birthing_home'] = 0;
                                $hospital_type[7]['private'] = 0;

                                $hospital_type[8]['government'] = 0;
                                $hospital_type[8]['RHU'] = 0;
                                $hospital_type[8]['birthing_home'] = 0;
                                $hospital_type[8]['private'] = 0;

                                $hospital_type[9]['government'] = 0;
                                $hospital_type[9]['RHU'] = 0;
                                $hospital_type[9]['birthing_home'] = 0;
                                $hospital_type[9]['private'] = 0;

                                
                                $hospital_type_total[6]['government'] = 0;
                                $government_transaction[6]['with_transaction'] = 0;
                                $government_transaction[6]['no_transaction'] = 0;

                                $hospital_type_hospital[7]['government'] = 0;
                                $hospital_type_total[7]['government'] = 0;
                                $government_transaction[7]['with_transaction'] = 0;
                                $government_transaction[7]['no_transaction'] = 0;

                                $hospital_type_hospital[8]['government'] = 0;
                                $hospital_type_total[8]['government'] = 0;
                                $government_transaction[8]['with_transaction'] = 0;
                                $government_transaction[8]['no_transaction'] = 0;

                                $hospital_type_hospital[9]['government'] = 0;
                                $hospital_type_total[9]['government'] = 0;
                                $government_transaction[9]['with_transaction'] = 0;
                                $government_transaction[9]['no_transaction'] = 0;

                                $private_transaction[6]['with_transaction'] = 0;
                                $private_transaction[6]['no_transaction'] = 0;
                                $private_transaction[7]['with_transaction'] = 0;
                                $private_transaction[7]['no_transaction'] = 0;
                                $private_transaction[8]['with_transaction'] = 0;
                                $private_transaction[8]['no_transaction'] = 0;
                                $private_transaction[9]['with_transaction'] = 0;
                                $private_transaction[9]['no_transaction'] = 0;

                                $rhu_transaction[6]['with_transaction'] = 0;
                                $rhu_transaction[6]['no_transaction'] = 0;
                                $rhu_transaction[7]['with_transaction'] = 0;
                                $rhu_transaction[7]['no_transaction'] = 0;
                                $rhu_transaction[8]['with_transaction'] = 0;
                                $rhu_transaction[8]['no_transaction'] = 0;
                                $rhu_transaction[9]['with_transaction'] = 0;
                                $rhu_transaction[9]['no_transaction'] = 0;

                                $birthing_transaction[6]['with_transaction'] = 0;
                                $birthing_transaction[6]['no_transaction'] = 0;
                                $birthing_transaction[7]['with_transaction'] = 0;
                                $birthing_transaction[7]['no_transaction'] = 0;
                                $birthing_transaction[8]['with_transaction'] = 0;
                                $birthing_transaction[8]['no_transaction'] = 0;
                                $birthing_transaction[9]['with_transaction'] = 0;
                                $birthing_transaction[9]['no_transaction'] = 0;

                                $province = [];
                            ?>
                            @foreach($data as $row)
                                <?php
                                    $count++;

                                    if($row->status == 'onboard'){
                                        $facility_onboard[$row->province_id]++;
                                        $hospital_type[$row->province_id][$row->hospital_type]++;
                                        if($row->transaction == 'transaction'){
                                            $facility_transaction[$row->province_id]['with_transaction']++;
                                            if($row->hospital_type == 'government'){
                                               
                                                $government_transaction[$row->province_id]['with_transaction']++;
                                            }elseif($row->hospital_type == 'private'){
                                
                                                $private_transaction[$row->province_id]['with_transaction']++;
                                            }
                                            elseif($row->hospital_type == 'RHU'){
                                            
                                                $rhu_transaction[$row->province_id]['with_transaction']++;
                                            }
                                            elseif($row->hospital_type == 'birthing_home'){
                                             
                                                $birthing_transaction[$row->province_id]['with_transaction']++;
                                            }
                                        } else {
                                            $facility_transaction[$row->province_id]['no_transaction']++;
                                            if($row->hospital_type == 'government'){
                                                $government_transaction[$row->province_id]['no_transaction']++;
                                            }elseif($row->hospital_type == 'private'){
                                                $private_transaction[$row->province_id]['no_transaction']++;
                                            }
                                            elseif($row->hospital_type == 'RHU'){
                                                $rhu_transaction[$row->province_id]['no_transaction']++;
                                            }
                                            elseif($row->hospital_type == 'birthing_home'){
                                                $birthing_transaction[$row->province_id]['no_transaction']++;
                                            }
                                        }
                                    }

                                    $hospital_type_total[$row->province_id][$row->hospital_type]++;
                                    $facility_total[$row->province_id]++;
                                ?>
                                @if(!isset($province[$row->province]))
                                    <?php $province[$row->province] = true; ?>
                                    <tr>
                                        <td colspan="9">
                                            <div class="form-group">
                                                <b style="color: #ff298e;font-size: 17pt;">{{ $row->province }} - as of {{ date('F d, Y') }}</b><br>
                                                <div id="chartOverall{{ $row->province_id }}" style="height: 200px; width: 100%;"></div>
                                                <strong class="text-green">Overall - </strong>
                                                <span class="progress-number"><b class="{{ 'facility_onboard'.$row->province_id }}"></b> <small class="text-blue">(ON BOARD)</small> / <b class="{{ 'facility_total'.$row->province_id }}"></b> <small class="text-blue">(REGISTER)</small></span> = <b class="text-red facility_percent{{ $row->province_id }}"></b>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-striped facility_progress{{ $row->province_id }}" ></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div id="chartGovernment{{ $row->province_id }}" style="height: 200px; width: 100%;"></div>
                                                <strong class="text-green"> Government Hospital - {{ $hospital_type[$row->province][$row->hospital_type] }}</strong>
                                                <span class="progress-number"><b class="{{ 'government_hospital'.$row->province_id }}"></b> <small class="text-blue">(ON BOARD)</small> / <b class="{{ 'government_hospital_total'.$row->province_id }}"></b> <small class="text-blue">(REGISTER)</small></span> = <b class="text-red government_percent{{ $row->province_id }}"></b>
                                                <div class="progress sm" >
                                                    <div class="progress-bar progress-bar-striped government_hospital_progress{{ $row->province_id }}" ></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div id="chartPrivate{{ $row->province_id }}" style="height: 200px; width: 100%;"></div>
                                                <strong class="text-green">Private Hospital - </strong>
                                                <span class="progress-number"><b class="{{ 'private_hospital'.$row->province_id }}"></b> <small class="text-blue">(ON BOARD)</small> / <b class="{{ 'private_hospital_total'.$row->province_id }}"></b> <small class="text-blue">(REGISTER)</small></span> = <b class="text-red private_percent{{ $row->province_id }}"></b>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red private_hospital_progress{{ $row->province_id }}" ></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div id="chartRhu{{ $row->province_id }}" style="height: 200px; width: 100%;"></div>
                                                <strong class="text-green">RHU - </strong>
                                                <span class="progress-number"><b class="{{ 'rhu_hospital'.$row->province_id }}"></b> <small class="text-blue">(ON BOARD)</small> / <b class="{{ 'rhu_hospital_total'.$row->province_id }}"></b> <small class="text-blue">(REGISTER)</small></span> = <b class="text-red rhu_percent{{ $row->province_id }}"></b>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red rhu_hospital_progress{{ $row->province_id }}" ></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div id="chartBirthing{{ $row->province_id }}" style="height: 200px; width: 100%;"></div>
                                                <strong class="text-green">BIRTHING HOME - </strong>
                                                <span class="progress-number"><b class="{{ 'birthing_hospital'.$row->province_id }}"></b> <small class="text-blue">(ON BOARD)</small> / <b class="{{ 'birthing_hospital_total'.$row->province_id }}"></b> <small class="text-blue">(REGISTER)</small></span> = <b class="text-red birthing_percent{{ $row->province_id }}"></b>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red birthing_hospital_progress{{ $row->province_id }}" ></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="bg-black">
                                        <th></th>
                                        <th>Facility Name</th>
                                        <th>Chief Hospital</th>
                                        <th>Contact No</th>
                                        <th>Registered On</th>
                                        <th>First Login</th>
                                        <th>Last Login From</th>
                                        <th>Last Logout To</th>
                                        <th>Last Transaction</th>
                                    </tr>
                                @endif
                                <tr class="@if($row->status == 'onboard'){{ 'bg-yellow' }}@endif">
                                    <td>{{ $count }}</td>
                                    <td class="@if($row->transaction == 'no_transaction' && $row->status == 'onboard'){{ 'bg-red' }}@endif">
                                        {{ $row->name }} <br>
                                        <span class="{{ $row->hospital_type == 'government' ? 'badge bg-green' : 'badge bg-blue' }}">{{ ucfirst($row->hospital_type) }}</span>
                                    </td>
                                    <td>{{ $row->chief_hospital }}</td>
                                    <td width="10%"><small>{{ $row->contact }}</small></td>
                                    <td >
                                        <small>{{ date("F d,Y",strtotime($row->registered_on)) }}</small><br>
                                        <i>(<small>{{ date("g:i a",strtotime($row->registered_on)) }}</small>)</i>
                                    </td>
                                    <td >
                                        @if($row->first_login == 'not_login')
                                            <small>NOT LOGIN</small>
                                        @else
                                            <small>{{ date("F d,Y",strtotime($row->first_login)) }}</small><br>
                                            <i>(<small>{{ date("g:i a",strtotime($row->first_login)) }}</small>)</i>
                                        @endif
                                    </td>
                                    <td >
                                        @if($row->last_login_from == 'not_login')
                                            <small>NOT LOGIN</small>
                                        @else
                                            <small>{{ date("F d,Y",strtotime($row->last_login_from)) }}</small><br>
                                            <i>(<small>{{ date("g:i a",strtotime($row->last_login_from)) }}</small>)</i>
                                        @endif
                                    </td>
                                    <td >
                                        @if($row->last_logout_to == 'not_login')
                                            <small>NOT LOGOUT</small>
                                        @elseif($row->last_logout_to == '0000-00-00 00:00:00')
                                            <small>{{ date("F d,Y",strtotime(explode(" ",$row->last_login_from)[0]." 23:59:59")) }}</small><br>
                                            <i>(<small>{{ date("g:i a",strtotime(explode(" ",$row->last_login_from)[0]." 23:59:59")) }}</small>)</i>
                                        @else
                                            <small>{{ date("F d,Y",strtotime($row->last_logout_to)) }}</small><br>
                                            <i>(<small>{{ date("g:i a",strtotime($row->last_logout_to)) }}</small>)</i>
                                        @endif
                                    </td>
                                    <td >
                                        @if($row->last_transaction_date == 'no_transaction')
                                            <small>NO TRANSACTION</small>
                                        @else
                                            <small>{{ date("F d,Y",strtotime($row->last_transaction_date)) }}</small><br>
                                            <i>(<small>{{ date("g:i a",strtotime($row->last_transaction_date)) }}</small>)</i>
                                            <span class="badge bg-green">{{ ucfirst($row->last_transaction_status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <span class="text-warning">
                            <i class="fa fa-warning"></i> No data found!
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('css')

@endsection

@section('js')
    <script>
        window.onload = function() {
            CanvasJS.addColorSet("greenShades",
                [//colorSet Array
                    "#6762ff",
                    "#ff686b"
                ]);

  

            @if($hospital_type[6]['government'] != 0)
            var government_with_transaction1 = Math.round("<?php echo $government_transaction[6]['with_transaction']; ?>" / "<?php echo $hospital_type[6]['government']; ?>" * 100);
            var government_no_transaction1 = Math.round("<?php echo $government_transaction[6]['no_transaction']; ?>" / "<?php echo $hospital_type[6]['government']; ?>" * 100);
            var government_options1 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Government"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+government_with_transaction1+"% in "+"<?php echo $government_transaction[6]['with_transaction']; ?> out of <?php echo $hospital_type[6]['government']; ?>",legendText : "With Transaction", y: government_with_transaction1 },
                        { label: "No Transaction in "+government_no_transaction1+"% in "+"<?php echo $government_transaction[6]['no_transaction']; ?> out of <?php echo $hospital_type[6]['government'] ?>",legendText : "No Transaction", y: government_no_transaction1 }
                    ]
                }]
            };
            $("#chartGovernment6").CanvasJSChart(government_options1);
            @endif

            @if($hospital_type[7]['government'] != 0)
            var government_with_transaction2 = Math.round("<?php echo $government_transaction[7]['with_transaction']; ?>" / "<?php echo $hospital_type[7]['government']; ?>" * 100);
            var government_no_transaction2 = Math.round("<?php echo $government_transaction[7]['no_transaction']; ?>" / "<?php echo $hospital_type[7]['government']; ?>" * 100);
            var government_options2 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Government"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+government_with_transaction2+"% in "+"<?php echo $government_transaction[7]['with_transaction']; ?> out of <?php echo $hospital_type[7]['government']; ?>",legendText : "With Transaction", y: government_with_transaction2 },
                        { label: "No Transaction in "+government_no_transaction2+"% in "+"<?php echo $government_transaction[7]['no_transaction']; ?> out of <?php echo $hospital_type[7]['government'] ?>",legendText : "No Transaction", y: government_no_transaction2 }
                    ]
                }]
            };
            $("#chartGovernment7").CanvasJSChart(government_options2);
            @endif

            @if($hospital_type[8]['government'] != 0)
            var government_with_transaction3 = Math.round("<?php echo $government_transaction[8]['with_transaction']; ?>" / "<?php echo $hospital_type[8]['government']; ?>" * 100);
            var government_no_transaction3 = Math.round("<?php echo $government_transaction[8]['no_transaction']; ?>" / "<?php echo $hospital_type[8]['government']; ?>" * 100);
            var government_options3 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Government"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+government_with_transaction3+"% in "+"<?php echo $government_transaction[8]['with_transaction']; ?> out of <?php echo $hospital_type[8]['government']; ?>",legendText : "With Transaction", y: government_with_transaction3 },
                        { label: "No Transaction in "+government_no_transaction3+"% in "+"<?php echo $government_transaction[8]['no_transaction']; ?> out of <?php echo $hospital_type[8]['government'] ?>",legendText : "No Transaction", y: government_no_transaction3 }
                    ]
                }]
            };
            $("#chartGovernment8").CanvasJSChart(government_options3);
            @endif

            @if($hospital_type[9]['government'] != 0)
            var government_with_transaction4 = Math.round("<?php echo $government_transaction[9]['with_transaction']; ?>" / "<?php echo $hospital_type[9]['government']; ?>" * 100);
            var government_no_transaction4 = Math.round("<?php echo $government_transaction[9]['no_transaction']; ?>" / "<?php echo $hospital_type[9]['government']; ?>" * 100);
            var government_options4 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Government"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+government_with_transaction4+"% in "+"<?php echo $government_transaction[9]['with_transaction']; ?> out of <?php echo $hospital_type[9]['government']; ?>",legendText : "With Transaction", y: government_with_transaction4 },
                        { label: "No Transaction in "+government_no_transaction4+"% in "+"<?php echo $government_transaction[9]['no_transaction']; ?> out of <?php echo $hospital_type[9]['government'] ?>",legendText : "No Transaction", y: government_no_transaction4 }
                    ]
                }]
            };
            $("#chartGovernment9").CanvasJSChart(government_options4);
            @endif

            @if($hospital_type[6]['private'] != 0)
            var private_with_transaction1 = Math.round("<?php echo $private_transaction[6]['with_transaction']; ?>" / "<?php echo $hospital_type[6]['private']; ?>" * 100);
            var private_no_transaction1 = Math.round("<?php echo $private_transaction[6]['no_transaction']; ?>" / "<?php echo $hospital_type[6]['private']; ?>" * 100);
            var private_options1 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Private"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+private_with_transaction1+"% in "+"<?php echo $private_transaction[6]['with_transaction']; ?> out of <?php echo $hospital_type[6]['private']; ?>",legendText : "With Transaction", y: private_with_transaction1 },
                        { label: "No Transaction in "+private_no_transaction1+"% in "+"<?php echo $private_transaction[6]['no_transaction']; ?> out of <?php echo $hospital_type[6]['private'] ?>",legendText : "No Transaction", y: private_no_transaction1 }
                    ]
                }]
            };
            $("#chartPrivate6").CanvasJSChart(private_options1);
            @endif

            @if($hospital_type[7]['private'] != 0)
            var private_with_transaction2 = Math.round("<?php echo $private_transaction[7]['with_transaction']; ?>" / "<?php echo $hospital_type[7]['private']; ?>" * 100);
            var private_no_transaction2 = Math.round("<?php echo $private_transaction[7]['no_transaction']; ?>" / "<?php echo $hospital_type[7]['private']; ?>" * 100);
            var private_options2 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Private"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+private_with_transaction2+"% in "+"<?php echo $private_transaction[7]['with_transaction']; ?> out of <?php echo $hospital_type[7]['private']; ?>",legendText : "With Transaction", y: private_with_transaction2 },
                        { label: "No Transaction in "+private_no_transaction2+"% in "+"<?php echo $private_transaction[7]['no_transaction']; ?> out of <?php echo $hospital_type[7]['private'] ?>",legendText : "No Transaction", y: private_no_transaction2 }
                    ]
                }]
            };
            $("#chartPrivate7").CanvasJSChart(private_options2);
            @endif


            @if($hospital_type[8]['private'] != 0)
            var private_with_transaction3 = Math.round("<?php echo $private_transaction[8]['with_transaction']; ?>" / "<?php echo $hospital_type[8]['private']; ?>" * 100);
            var private_no_transaction3 = Math.round("<?php echo $private_transaction[8]['no_transaction']; ?>" / "<?php echo $hospital_type[8]['private']; ?>" * 100);
            var private_options3 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Private"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+private_with_transaction3+"% in "+"<?php echo $private_transaction[8]['with_transaction']; ?> out of <?php echo $hospital_type[8]['private']; ?>",legendText : "With Transaction", y: private_with_transaction3 },
                        { label: "No Transaction in "+private_no_transaction3+"% in "+"<?php echo $private_transaction[8]['no_transaction']; ?> out of <?php echo $hospital_type[8]['private'] ?>",legendText : "No Transaction", y: private_no_transaction3 }
                    ]
                }]
            };
            $("#chartPrivate8").CanvasJSChart(private_options3);
            @endif

            @if($hospital_type[9]['private'] != 0)
            var private_with_transaction4 = Math.round("<?php echo $private_transaction[9]['with_transaction']; ?>" / "<?php echo $hospital_type[9]['private']; ?>" * 100);
            var private_no_transaction4 = Math.round("<?php echo $private_transaction[9]['no_transaction']; ?>" / "<?php echo $hospital_type[9]['private']; ?>" * 100);
            var private_options4 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Private"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+private_with_transaction4+"% in "+"<?php echo $private_transaction[9]['with_transaction']; ?> out of <?php echo $hospital_type[9]['private']; ?>",legendText : "With Transaction", y: private_with_transaction4 },
                        { label: "No Transaction in "+private_no_transaction4+"% in "+"<?php echo $private_transaction[9]['no_transaction']; ?> out of <?php echo $hospital_type[9]['private'] ?>",legendText : "No Transaction", y: private_no_transaction4 }
                    ]
                }]
            };
            $("#chartPrivate9").CanvasJSChart(private_options4);
            @endif

            @if($hospital_type[6]['RHU'] != 0)
            var rhu_with_transaction1 = Math.round("<?php echo $rhu_transaction[6]['with_transaction']; ?>" / "<?php echo $hospital_type[6]['RHU']; ?>" * 100);
            var rhu_no_transaction1 = Math.round("<?php echo $rhu_transaction[6]['no_transaction']; ?>" / "<?php echo $hospital_type[6]['RHU']; ?>" * 100);
            var rhu_options1 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "RHU"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+rhu_with_transaction1+"% in "+"<?php echo $rhu_transaction[6]['with_transaction']; ?> out of <?php echo $hospital_type[6]['RHU']; ?>",legendText : "With Transaction", y: rhu_with_transaction1 },
                        { label: "No Transaction in "+rhu_no_transaction1+"% in "+"<?php echo $rhu_transaction[6]['no_transaction']; ?> out of <?php echo $hospital_type[6]['RHU'] ?>",legendText : "No Transaction", y: rhu_no_transaction1 }
                    ]
                }]
            };
            $("#chartRhu6").CanvasJSChart(rhu_options1);
            @endif


            @if($hospital_type[7]['RHU'] != 0)
            var rhu_with_transaction2 = Math.round("<?php echo $rhu_transaction[7]['with_transaction']; ?>" / "<?php echo $hospital_type[7]['RHU']; ?>" * 100);
            var rhu_no_transaction2 = Math.round("<?php echo $rhu_transaction[7]['no_transaction']; ?>" / "<?php echo $hospital_type[7]['RHU']; ?>" * 100);
            var rhu_options2 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "RHU"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+rhu_with_transaction2+"% in "+"<?php echo $rhu_transaction[7]['with_transaction']; ?> out of <?php echo $hospital_type[7]['RHU']; ?>",legendText : "With Transaction", y: rhu_with_transaction2 },
                        { label: "No Transaction in "+rhu_no_transaction2+"% in "+"<?php echo $rhu_transaction[7]['no_transaction']; ?> out of <?php echo $hospital_type[7]['RHU'] ?>",legendText : "No Transaction", y: rhu_no_transaction2 }
                    ]
                }]
            };
            $("#chartRhu7").CanvasJSChart(rhu_options2);
            @endif


            @if($hospital_type[8]['RHU'] != 0)
            var rhu_with_transaction3 = Math.round("<?php echo $rhu_transaction[8]['with_transaction']; ?>" / "<?php echo $hospital_type[8]['RHU']; ?>" * 100);
            var rhu_no_transaction3 = Math.round("<?php echo $rhu_transaction[8]['no_transaction']; ?>" / "<?php echo $hospital_type[8]['RHU']; ?>" * 100);
            var rhu_options3 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "RHU"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+rhu_with_transaction3+"% in "+"<?php echo $rhu_transaction[8]['with_transaction']; ?> out of <?php echo $hospital_type[8]['RHU']; ?>",legendText : "With Transaction", y: rhu_with_transaction3 },
                        { label: "No Transaction in "+rhu_no_transaction3+"% in "+"<?php echo $rhu_transaction[8]['no_transaction']; ?> out of <?php echo $hospital_type[8]['RHU'] ?>",legendText : "No Transaction", y: rhu_no_transaction3 }
                    ]
                }]
            };
            $("#chartRhu8").CanvasJSChart(rhu_options3);
            @endif

            @if($hospital_type[9]['RHU'] != 0)
            var rhu_with_transaction4 = Math.round("<?php echo $rhu_transaction[9]['with_transaction']; ?>" / "<?php echo $hospital_type[9]['RHU']; ?>" * 100);
            var rhu_no_transaction4 = Math.round("<?php echo $rhu_transaction[9]['no_transaction']; ?>" / "<?php echo $hospital_type[9]['RHU']; ?>" * 100);
            var rhu_options4 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "RHU"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+rhu_with_transaction4+"% in "+"<?php echo $rhu_transaction[9]['with_transaction']; ?> out of <?php echo $hospital_type[9]['RHU']; ?>",legendText : "With Transaction", y: rhu_with_transaction4 },
                        { label: "No Transaction in "+rhu_no_transaction4+"% in "+"<?php echo $rhu_transaction[9]['no_transaction']; ?> out of <?php echo $hospital_type[9]['RHU'] ?>",legendText : "No Transaction", y: rhu_no_transaction4 }
                    ]
                }]
            };
            $("#chartRhu4").CanvasJSChart(rhu_options4);
            @endif



            @if($hospital_type[6]['birthing_home'] != 0)
            var birthing_with_transaction1 = Math.round("<?php echo $birthing_transaction[6]['with_transaction']; ?>" / "<?php echo $hospital_type[6]['birthing_home']; ?>" * 100);
            var birthing_no_transaction1 = Math.round("<?php echo $birthing_transaction[6]['no_transaction']; ?>" / "<?php echo $hospital_type[6]['birthing_home']; ?>" * 100);
            var birthing_options1 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "BIRTHING HOME"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+birthing_with_transaction1+"% in "+"<?php echo $birthing_transaction[6]['with_transaction']; ?> out of <?php echo $hospital_type[6]['birthing_home']; ?>",legendText : "With Transaction", y: birthing_with_transaction1 },
                        { label: "No Transaction in "+birthing_no_transaction1+"% in "+"<?php echo $birthing_transaction[6]['no_transaction']; ?> out of <?php echo $hospital_type[6]['birthing_home'] ?>",legendText : "No Transaction", y: birthing_no_transaction1 }
                    ]
                }]
            };
            $("#chartBirthing6").CanvasJSChart(birthing_options1);
            @endif


            @if($hospital_type[7]['birthing_home'] != 0)
            var birthing_with_transaction2 = Math.round("<?php echo $birthing_transaction[7]['with_transaction']; ?>" / "<?php echo $hospital_type[7]['birthing_home']; ?>" * 100);
            var birthing_no_transaction2 = Math.round("<?php echo $birthing_transaction[7]['no_transaction']; ?>" / "<?php echo $hospital_type[7]['birthing_home']; ?>" * 100);
            var birthing_options2 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "BIRTHING HOME"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+birthing_with_transaction2+"% in "+"<?php echo $birthing_transaction[7]['with_transaction']; ?> out of <?php echo $hospital_type[7]['birthing_home']; ?>",legendText : "With Transaction", y: birthing_with_transaction2 },
                        { label: "No Transaction in "+birthing_no_transaction2+"% in "+"<?php echo $birthing_transaction[7]['no_transaction']; ?> out of <?php echo $hospital_type[7]['birthing_home'] ?>",legendText : "No Transaction", y: birthing_no_transaction2 }
                    ]
                }]
            };
            $("#chartBirthing7").CanvasJSChart(birthing_options2);
            @endif


            @if($hospital_type[8]['birthing_home'] != 0)
            var birthing_with_transaction3 = Math.round("<?php echo $birthing_transaction[8]['with_transaction']; ?>" / "<?php echo $hospital_type[8]['birthing_home']; ?>" * 100);
            var birthing_no_transaction3 = Math.round("<?php echo $birthing_transaction[8]['no_transaction']; ?>" / "<?php echo $hospital_type[8]['birthing_home']; ?>" * 100);
            var birthing_options3 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "BIRTHING HOME"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+birthing_with_transaction3+"% in "+"<?php echo $birthing_transaction[8]['with_transaction']; ?> out of <?php echo $hospital_type[8]['birthing_home']; ?>",legendText : "With Transaction", y: birthing_with_transaction3 },
                        { label: "No Transaction in "+birthing_no_transaction3+"% in "+"<?php echo $birthing_transaction[8]['no_transaction']; ?> out of <?php echo $hospital_type[8]['birthing_home'] ?>",legendText : "No Transaction", y: birthing_no_transaction3 }
                    ]
                }]
            };
            $("#chartBirthing8").CanvasJSChart(birthing_options3);
            @endif

            @if($hospital_type[9]['birthing_home'] != 0)
            var birthing_with_transaction4 = Math.round("<?php echo $birthing_transaction[9]['with_transaction']; ?>" / "<?php echo $hospital_type[9]['birthing_home']; ?>" * 100);
            var birthing_no_transaction4 = Math.round("<?php echo $birthing_transaction[9]['no_transaction']; ?>" / "<?php echo $hospital_type[9]['birthing_home']; ?>" * 100);
            var birthing_options4 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "BIRTHING HOME"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+birthing_with_transaction4+"% in "+"<?php echo $birthing_transaction[9]['with_transaction']; ?> out of <?php echo $hospital_type[9]['birthing_home']; ?>",legendText : "With Transaction", y: birthing_with_transaction4 },
                        { label: "No Transaction in "+birthing_no_transaction4+"% in "+"<?php echo $birthing_transaction[9]['no_transaction']; ?> out of <?php echo $hospital_type[9]['birthing_home'] ?>",legendText : "No Transaction", y: birthing_no_transaction4 }
                    ]
                }]
            };
            $("#chartBirthing9").CanvasJSChart(birthing_options4);
            @endif

            var with_transaction1 = Math.round("<?php echo $facility_transaction[6]['with_transaction']; ?>" / "<?php echo $facility_onboard[6]; ?>" * 100);
            var no_transaction1 = Math.round("<?php echo $facility_transaction[6]['no_transaction']; ?>" / "<?php echo $facility_onboard[6]; ?>" * 100);
            var options1 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Overall"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+with_transaction1+"% in "+"<?php echo $facility_transaction[6]['with_transaction']; ?> out of <?php echo $facility_onboard[6]; ?>",legendText : "With Transaction", y: with_transaction1 },
                        { label: "No Transaction in "+no_transaction1+"% in "+"<?php echo $facility_transaction[6]['no_transaction']; ?> out of <?php echo $facility_onboard[6]; ?>",legendText : "No Transaction", y: no_transaction1 }
                    ]
                }]
            };
            $("#chartOverall6").CanvasJSChart(options1);


            var with_transaction2 = Math.round("<?php echo $facility_transaction[7]['with_transaction']; ?>" / "<?php echo $facility_onboard[7]; ?>" * 100);
            var no_transaction2 = Math.round("<?php echo $facility_transaction[7]['no_transaction']; ?>" / "<?php echo $facility_onboard[7]; ?>" * 100);
            var options2 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Overall"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+with_transaction2+"% in "+"<?php echo $facility_transaction[7]['with_transaction']; ?> out of <?php echo $facility_onboard[7]; ?>",legendText : "With Transaction", y: with_transaction2 },
                        { label: "No Transaction in "+no_transaction2+"% in "+"<?php echo $facility_transaction[7]['no_transaction']; ?> out of <?php echo $facility_onboard[7]; ?>",legendText : "No Transaction", y: no_transaction2 }
                    ]
                }]
            };
            $("#chartOverall7").CanvasJSChart(options2);


            var with_transaction3 = Math.round("<?php echo $facility_transaction[8]['with_transaction']; ?>" / "<?php echo $facility_onboard[8]; ?>" * 100);
            var no_transaction3 = Math.round("<?php echo $facility_transaction[8]['no_transaction']; ?>" / "<?php echo $facility_onboard[8]; ?>" * 100);
            var options3 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Overall"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+with_transaction3+"% in "+"<?php echo $facility_transaction[8]['with_transaction']; ?> out of <?php echo $facility_onboard[8]; ?>",legendText : "With Transaction", y: with_transaction3 },
                        { label: "No Transaction in "+no_transaction3+"% in "+"<?php echo $facility_transaction[8]['no_transaction']; ?> out of <?php echo $facility_onboard[8]; ?>",legendText : "No Transaction", y: no_transaction3 }
                    ]
                }]
            };
            $("#chartOverall8").CanvasJSChart(options3);

            var with_transaction4 = Math.round("<?php echo $facility_transaction[9]['with_transaction']; ?>" / "<?php echo $facility_onboard[9]; ?>" * 100);
            var no_transaction4 = Math.round("<?php echo $facility_transaction[9]['no_transaction']; ?>" / "<?php echo $facility_onboard[9]; ?>" * 100);
            var options4 = {
                colorSet: "greenShades",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Overall"
                },
                data: [{
                    type: "pie",
                    startAngle: 45,
                    showInLegend: "true",
                    toolTipContent: "{y}%",
                    legendText: "{label}",
                    yValueFormatString:"#,##0.#"%"",
                    dataPoints: [
                        { label: "With Transaction in "+with_transaction4+"% in "+"<?php echo $facility_transaction[9]['with_transaction']; ?> out of <?php echo $facility_onboard[9]; ?>",legendText : "With Transaction", y: with_transaction4 },
                        { label: "No Transaction in "+no_transaction4+"% in "+"<?php echo $facility_transaction[9]['no_transaction']; ?> out of <?php echo $facility_onboard[9]; ?>",legendText : "No Transaction", y: no_transaction4 }
                    ]
                }]
            };
            $("#chartOverall9").CanvasJSChart(options4);
        }
    </script>

    <script>
        //Date range picker
        $('#onboard_picker').daterangepicker({
            "singleDatePicker": true
        });

        $(".facility_onboard1").html("<?php echo $facility_onboard[6] ?>");
        $(".facility_total1").html("<?php echo $facility_total[6] ?>");
        var facility_progress1 = Math.round("<?php echo $facility_onboard[6] ?>" / "<?php echo $facility_total[61] ?>" * 100);
        $('.facility_progress1').css('width',facility_progress1+"%");
        $('.facility_percent1').html(facility_progress1+"%");

        $(".facility_onboard2").html("<?php echo $facility_onboard[7] ?>");
        $(".facility_total2").html("<?php echo $facility_total[7] ?>");
        var facility_progress2 = Math.round("<?php echo $facility_onboard[7] ?>" / "<?php echo $facility_total[7] ?>" * 100);
        $('.facility_progress2').css('width',facility_progress2+"%");
        $('.facility_percent2').html(facility_progress2+"%");

        $(".facility_onboard3").html("<?php echo $facility_onboard[8] ?>");
        $(".facility_total3").html("<?php echo $facility_total[8] ?>");
        var facility_progress3 = Math.round("<?php echo $facility_onboard[8] ?>" / "<?php echo $facility_total[8] ?>" * 100);
        $('.facility_progress3').css('width',facility_progress3+"%");
        $('.facility_percent3').html(facility_progress3+"%");

        $(".facility_onboard4").html("<?php echo $facility_onboard[9] ?>");
        $(".facility_total4").html("<?php echo $facility_total[9] ?>");
        var facility_progress4 = Math.round("<?php echo $facility_onboard[9] ?>" / "<?php echo $facility_total[9] ?>" * 100);
        $('.facility_progress4').css('width',facility_progress4+"%");
        $('.facility_percent4').html(facility_progress4+"%");


        $(".government_hospital1").html("<?php echo $hospital_type[6]['government']; ?>");
        $(".government_hospital_total1").html("<?php echo $hospital_type_total[6]['government']; ?>");
        var government_hospital_progress1 = Math.round("<?php echo $hospital_type[6]['government'] ?>" / "<?php echo $hospital_type_total[6]['government'] ?>" * 100);
        $('.government_hospital_progress1').css('width',government_hospital_progress1+"%");
        $('.government_percent1').html(government_hospital_progress1+"%");


        $(".government_hospital2").html("<?php echo $hospital_type[7]['government']; ?>");
        $(".government_hospital_total2").html("<?php echo $hospital_type_total[7]['government']; ?>");
        var government_hospital_progress2 = Math.round("<?php echo $hospital_type[7]['government'] ?>" / "<?php echo $hospital_type_total[7]['government'] ?>" * 100);
        $('.government_hospital_progress2').css('width',government_hospital_progress2+"%");
        $('.government_percent2').html(government_hospital_progress2+"%");

        $(".government_hospital3").html("<?php echo $hospital_type[8]['government']; ?>");
        $(".government_hospital_total3").html("<?php echo $hospital_type_total[8]['government']; ?>");
        var government_hospital_progress3 = Math.round("<?php echo $hospital_type[8]['government'] ?>" / "<?php echo $hospital_type_total[8]['government'] ?>" * 100);
        $('.government_hospital_progress3').css('width',government_hospital_progress3+"%");
        $('.government_percent3').html(government_hospital_progress3+"%");

        $(".government_hospital4").html("<?php echo $hospital_type[9]['government']; ?>");
        $(".government_hospital_total4").html("<?php echo $hospital_type_total[9]['government']; ?>");
        var government_hospital_progress4 = Math.round("<?php echo $hospital_type[9]['government'] ?>" / "<?php echo $hospital_type_total[9]['government'] ?>" * 100);
        $('.government_hospital_progress4').css('width',government_hospital_progress4+"%");
        $('.government_percent4').html(government_hospital_progress4+"%");

        $(".private_hospital1").html("<?php echo $hospital_type[6]['private']; ?>");
        $(".private_hospital_total1").html("<?php echo $hospital_type_total[6]['private']; ?>");
        var private_hospital_progress1 = Math.round("<?php echo $hospital_type[6]['private'] ?>" / "<?php echo $hospital_type_total[6]['private'] ?>" * 100);
        $('.private_hospital_progress1').css('width',private_hospital_progress1+"%");
        $('.private_percent1').html(private_hospital_progress1+"%");

        $(".private_hospital2").html("<?php echo $hospital_type[7]['private']; ?>");
        $(".private_hospital_total2").html("<?php echo $hospital_type_total[7]['private']; ?>");
        var private_hospital_progress2 = Math.round("<?php echo $hospital_type[7]['private'] ?>" / "<?php echo $hospital_type_total[7]['private'] ?>" * 100);
        $('.private_hospital_progress2').css('width',private_hospital_progress2+"%");
        $('.private_percent2').html(private_hospital_progress2+"%");

        $(".private_hospital3").html("<?php echo $hospital_type[8]['private']; ?>");
        $(".private_hospital_total3").html("<?php echo $hospital_type_total[8]['private']; ?>");
        var private_hospital_progress3 = Math.round("<?php echo $hospital_type[8]['private'] ?>" / "<?php echo $hospital_type_total[8]['private'] ?>" * 100);
        $('.private_hospital_progress3').css('width',private_hospital_progress3+"%");
        $('.private_percent3').html(private_hospital_progress3+"%");

        $(".private_hospital4").html("<?php echo $hospital_type[9]['private']; ?>");
        $(".private_hospital_total4").html("<?php echo $hospital_type_total[9]['private']; ?>");
        var private_hospital_progress4 = Math.round("<?php echo $hospital_type[9]['private'] ?>" / "<?php echo $hospital_type_total[9]['private'] ?>" * 100);
        $('.private_hospital_progress4').css('width',private_hospital_progress4+"%");
        $('.private_percent4').html(private_hospital_progress4+"%");

        $(".rhu_hospital1").html("<?php echo $hospital_type[6]['RHU']; ?>");
        $(".rhu_hospital_total1").html("<?php echo $hospital_type_total[6]['RHU']; ?>");
        var rhu_hospital_progress1 = Math.round("<?php echo $hospital_type[6]['RHU'] ?>" / "<?php echo $hospital_type_total[6]['RHU'] ?>" * 100);
        $('.rhu_hospital_progress1').css('width',rhu_hospital_progress1+"%");
        $('.rhu_percent1').html(rhu_hospital_progress1+"%");

        $(".rhu_hospital2").html("<?php echo $hospital_type[7]['RHU']; ?>");
        $(".rhu_hospital_total2").html("<?php echo $hospital_type_total[7]['RHU']; ?>");
        var rhu_hospital_progress2 = Math.round("<?php echo $hospital_type[7]['RHU'] ?>" / "<?php echo $hospital_type_total[7]['RHU'] ?>" * 100);
        $('.rhu_hospital_progress2').css('width',rhu_hospital_progress2+"%");
        $('.rhu_percent2').html(rhu_hospital_progress2+"%");

        $(".rhu_hospital3").html("<?php echo $hospital_type[8]['RHU']; ?>");
        $(".rhu_hospital_total3").html("<?php echo $hospital_type_total[8]['RHU']; ?>");
        var rhu_hospital_progress3 = Math.round("<?php echo $hospital_type[8]['RHU'] ?>" / "<?php echo $hospital_type_total[8]['RHU'] ?>" * 100);
        $('.rhu_hospital_progress3').css('width',rhu_hospital_progress3+"%");
        $('.rhu_percent3').html(rhu_hospital_progress3+"%");


        $(".rhu_hospital4").html("<?php echo $hospital_type[9]['RHU']; ?>");
        $(".rhu_hospital_total4").html("<?php echo $hospital_type_total[9]['RHU']; ?>");
        var rhu_hospital_progress4 = Math.round("<?php echo $hospital_type[9]['RHU'] ?>" / "<?php echo $hospital_type_total[9]['RHU'] ?>" * 100);
        $('.rhu_hospital_progress4').css('width',rhu_hospital_progress4+"%");
        $('.rhu_percent4').html(rhu_hospital_progress4+"%");


        $(".birthing_hospital1").html("<?php echo $hospital_type[6]['birthing_home']; ?>");
        $(".birthing_hospital_total1").html("<?php echo $hospital_type_total[6]['birthing_home']; ?>");
        var birthing_hospital_progress1 = Math.round("<?php echo $hospital_type[6]['birthing_home'] ?>" / "<?php echo $hospital_type_total[6]['birthing_home'] ?>" * 100);
        $('.birthing_hospital_progress1').css('width',birthing_hospital_progress1+"%");
        $('.birthing_percent1').html(birthing_hospital_progress1+"%");

        $(".birthing_hospital2").html("<?php echo $hospital_type[7]['birthing_home']; ?>");
        $(".birthing_hospital_total2").html("<?php echo $hospital_type_total[7]['birthing_home']; ?>");
        var birthing_hospital_progress2 = Math.round("<?php echo $hospital_type[7]['birthing_home'] ?>" / "<?php echo $hospital_type_total[7]['birthing_home'] ?>" * 100);
        $('.birthing_hospital_progress2').css('width',birthing_hospital_progress2+"%");
        $('.birthing_percent2').html(birthing_hospital_progress2+"%");

        $(".birthing_hospital3").html("<?php echo $hospital_type[8]['birthing_home']; ?>");
        $(".birthing_hospital_total3").html("<?php echo $hospital_type_total[8]['birthing_home']; ?>");
        var birthing_hospital_progress3 = Math.round("<?php echo $hospital_type[8]['birthing_home'] ?>" / "<?php echo $hospital_type_total[8]['birthing_home'] ?>" * 100);
        $('.birthing_hospital_progress3').css('width',birthing_hospital_progress3+"%");
        $('.birthing_percent3').html(birthing_hospital_progress3+"%");


        $(".birthing_hospital4").html("<?php echo $hospital_type[9]['birthing_home']; ?>");
        $(".birthing_hospital_total4").html("<?php echo $hospital_type_total[9]['birthing_home']; ?>");
        var birthing_hospital_progress4 = Math.round("<?php echo $hospital_type[9]['birthing_home'] ?>" / "<?php echo $hospital_type_total[9]['birthing_home'] ?>" * 100);
        $('.birthing_hospital_progress4').css('width',birthing_hospital_progress4+"%");
        $('.birthing_percent4').html(birthing_hospital_progress4+"%");

    </script>
@endsection

