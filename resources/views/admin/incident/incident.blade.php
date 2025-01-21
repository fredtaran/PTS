@extends('layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('admin/incident_type') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-lg" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search incident..." value="{{ Session::get("keyword") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a href="#facility_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat" onclick="IncidentBody('empty')">
                            <i class="fa fa-hospital-o"></i> Add Incident
                        </a>
                    </div>
                </form>
            </div>
            <h3>{{ $title }}</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Incident Type</th>
                            <th>Date Created</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                            href="#facility_modal"
                                            data-toggle="modal"
                                            onclick="IncidentBody('<?php echo $row->id ?>')">
                                            {{ $row->type }}
                                        </a>
                                    </b>
                                </td><td style="white-space: nowrap;">
                                    <b>
                                        <a
                                            href="#facility_modal"
                                            data-toggle="modal"
                                            onclick="IncidentBody('<?php echo $row->id ?>')">
                                            {{ $row->created_at }}
                                        </a>
                                    </b>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                         <!-- $data->links()  -->
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Incident found!
                    </span>
                </div>
            @endif
        </div>
    </div>

    @include('admin.modal.facility_modal')
@endsection
@section('js')
    <script>
        <?php $user = Session::get('auth'); ?>
        function IncidentBody(data){
            var json;
            if(data == 'empty'){
                json = {
                    "_token" : "<?php echo csrf_token()?>"
                };
            } else {
                json = {
                    "inci_id" : data,
                    "_token" : "<?php echo csrf_token()?>"
                };
            }
            var url = "<?php echo asset('admin/incident_type/body') ?>";
            $.post(url,json,function(result){
                $(".facility_body").html(result);
            })
        }

        function IncidentDelete(facility_id) {
            $(".inci_id").val(facility_id);
            console.log(facility_id);
        }

        @if(Session::get('incident'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("incident_message"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
        <?php
        Session::put("incident",false);
        Session::put("incident_message",false)
        ?>
        @endif
    </script>
@endsection

