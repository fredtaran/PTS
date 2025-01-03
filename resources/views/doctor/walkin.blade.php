@extends('layouts.app')

@section('content')
    <div class="box box-success">
        <div class="box-body">
            <div class="box-header with-border">
                <h3>
                    Walk-in Patient
                    <form action="{{ asset('patient/walkin') }}" method="POST" class="form-inline pull-right" style="margin-right: 30%">
                        {{ csrf_field() }}
                        <div class="form-group-sm">
                            <input type="text" class="form-control active" name="date_range" value="{{ date("m/d/Y",strtotime($date_start)).' - '.date("m/d/Y",strtotime($date_end)) }}" placeholder="Filter your daterange here..." id="consolidate_date_range" autocomplete="off">
                            <button type="submit" class="btn-sm btn-info btn-flat" onclick="loadPage();"><i class="fa fa-search"></i> Filter</button>
                        </div>
                    </form>
                </h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-responsive">
                    <tr>
                        <th></th>
                        <th>Patient Contact No.</th>
                        <th>Referring Facility</th>
                        <th>Referred To</th>
                        <th>Date Referred</th>
                        <th>Remarks</th>
                    </tr>
                    @foreach($walkin_patient as $row)
                        <tr>
                            <td width="5%" style="vertical-align:top">
                                <a href="{{ asset('doctor/referred?referredCode=').$row->code }}" class="btn btn-sm btn-success" target="_blank">
                                    <i class="fa fa-stethoscope"></i> Track
                                </a>
                            </td>
                            <td class="text-blue">{{ $row->contact }}</td>
                            <td width="23%;">
                                {{ $row->referring_facility }}<br>
                                <span class="text-green">{{ $row->contact_from }}</span><br>.
                            </td>
                            <td width="23%;">
                                {{ $row->referred_to }}<br>
                                <?php
                                if($row->patient_normal_id){
                                    $referred_department = $row->referred_department_normal;
                                    $department_color = "blue";
                                } else {
                                    $referred_department = $row->referred_department_pregnant." - Pregnant";
                                    $department_color = "red";
                                }
                                ?>
                                <span class="text-green">{{ $row->contact_to }}</span><br>
                                <span class="text-{{ $department_color }}">{{ $referred_department }}</span>
                            </td>
                            <td width="13%">
                                {{ date("F d,Y",strtotime($row->date_referred)) }}<br>
                                <small class="text-yellow">({{ date('g:i a',strtotime($row->date_referred)) }})</small>
                            </td>
                            <td>
                                <?php
                                $monitoring_not_accepted = \App\Monitoring::where("code","=",$row->code)->orderBy("created_at","desc")->get();
                                ?>
                                @if(count($monitoring_not_accepted) > 0)
                                    @foreach($monitoring_not_accepted as $monitoring)
                                        <?php
                                        $remark_by = \App\User::find($monitoring->remark_by);
                                        ?>
                                        <div class="tab-pane active" id="timeline">
                                            <!-- The timeline -->
                                            <ul class="timeline timeline-inverse">
                                                <!-- timeline time label -->
                                                <li class="time-label">
                                                    <span class="bg-blue">
                                                      {{ date('F d, Y',strtotime($monitoring->created_at)) }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <i class="fa fa-phone bg-aqua"></i>
                                                    <div class="timeline-item">
                                                        <h3 class="timeline-header no-border"><a href="#">{{ $remark_by->fname }} {{ $remark_by->mname[0] }}. {{ $remark_by->lname }}</a>
                                                            <small class="text-warning">({{ date('H:i',strtotime($monitoring->created_at)) }})</small><br>
                                                            <small style="margin-left: 2%">
                                                                <span class="text-warning">Notes:</span> {{ $monitoring->notes }}
                                                            </small><br>
                                                            <small style="margin-left: 2%">
                                                                <span class="text-warning">Action Taken:</span> {{ $monitoring->remarks }}
                                                            </small>
                                                        </h3>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                    @if($user_level == 'admin')
                                        <button class="btn btn-sm btn-info" href="#add_remark" data-toggle="modal" onclick="addRemark(
                                                '<?php echo $row->activity_id; ?>',
                                                '<?php echo $row->code; ?>',
                                                '<?php echo $row->referring_facility_id ?>',
                                                '<?php echo $row->referred_to_id ?>'
                                                )"
                                        ><i class="fa fa-sticky-note"></i> Add more remark</button>
                                    @endif
                                @else
                                    @if($user_level == 'admin')
                                        <button class="btn btn-sm btn-primary" href="#add_remark" data-toggle="modal" onclick="addRemark(
                                                '<?php echo $row->activity_id; ?>',
                                                '<?php echo $row->code; ?>',
                                                '<?php echo $row->referring_facility_id ?>',
                                                '<?php echo $row->referred_to_id ?>'
                                                )"
                                        ><i class="fa fa-sticky-note"></i> Add remark</button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="add_remark">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body monitoring_remark">

                </div><!-- /.modal-content -->
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection

@section('js')
    <script>
        //Date range picker
        $('#consolidate_date_range').daterangepicker();

        @if(Session::get('add_remark'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added ramark!",
            size: 'mini',
            rounded: true
        });
        <?php Session::put("add_remark",false); ?>
        @endif

        function addRemark(activity_id,code,referring_facility,referred_to){
            $(".monitoring_remark").html(loading);
            var json = {
                "_token" : "<?php echo csrf_token()?>",
                "activity_id" : activity_id,
                "code" : code,
                "referring_facility" : referring_facility,
                "referred_to" : referred_to
            };
            console.log(json);
            var url = "<?php echo asset('monitoring/remark') ?>";
            $.post(url,json,function(result){
                setTimeout(function(){
                    $(".monitoring_remark").html(result);
                },500);
            })
        }
    </script>
@endsection

