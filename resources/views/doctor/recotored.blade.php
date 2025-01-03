@extends('layouts.app')

@section('content')
    <div class="box box-success">
        <div class="box-body">
            <div class="box-header with-border">
                <h3>
                    Recommend to Redirect Logs
                    <form action="{{ asset('doctor/recotored') }}" method="POST" class="form-inline pull-right" style="margin-right: 30%">
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
                        <th>Patient Info</th>
                        <th>Referring Facility</th>
                        <th>Referred To</th>
                        <th>Date Referred</th>
                        <th>Status</th>
                    </tr>
          @foreach($data as $row)
                        <tr>
                            <td width="5%" style="vertical-align:top">
                            <a href="{{ asset('doctor/referred?referredCode=').$row->code }}" id="inci_view" class="btn btn-sm btn-success" target="_blank">
                                    <i class="fa fa-stethoscope"></i> Track
                                </a>

                            </td>
                            <td>{{ $row->fname }} {{ $row->mname }} {{ $row->lname }}
                                <br> {{ $row->contact }}</td>
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
                            <td width="13%">
                              <?php 
                                if($row->status == 'rejected')
                                {
                                    $status = 'Recommend to Redirect';
                                }
                              ?>
                              {{$status}}
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
@include('modal.accept')

@section('js')
    <script>
 @if(Session::get('incidentadd'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("incidentadd_message"); ?>",
            size: 'mini',
            rounded: true
        });
    <?php
        Session::put("incidentadd",false);
        Session::put("incidentadd_message",false)
    ?>
@endif

 $(".inc").click(function() {
   var  code = $(this).data('code');
    var id = $(this).data('id');

    var json;
            json = {
                    "inci_id" : id,
                    "_token" : "<?php echo csrf_token()?>"
                     };
            var url = "<?php echo asset('admin/incident/body') ?>";
         $.post(url,json,function(result){
            $('input#patient_code').val(code);
            $(".inci_body").html(result);
             })
    });
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

