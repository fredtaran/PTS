@extends('layouts.app')

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('admin/facility') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-lg" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search name..." value="{{ Session::get('keyword') }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a href="#facility_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat" onclick="FacilityBody('empty')">
                            <i class="fa fa-hospital-o"></i> Add Facility
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
                            <th>Facility Name</th>
                            <th>Facility Code</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Chief Hospital</th>
                            <th>
                                Service<br>
                                Capability
                            </th>
                            <th>Ownership</th>
                            <th>Status</th>
                            <th>Referral Used</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                                href="#facility_modal"
                                                data-toggle="modal"
                                                data-id = "{{ $row->id }}"
                                                onclick="FacilityBody('<?php echo $row->id ?>')"
                                                class="update_info"
                                        >
                                            {{ $row->name }}
                                        </a>
                                    </b><br>
                                    <small class="text-success">
                                        (
                                        <?php
                                        isset($row->muncity) ? $comma_mun = "," : $comma_mun = " ";
                                        isset($row->barangay) ? $comma_bar = "," : $comma_bar = " ";
                                        !empty($row->address) ? $concat_addr = " - " : $concat_addr = " ";

                                        echo $row->province.$comma_mun.$row->muncity.$comma_bar.$row->barangay.$concat_addr.$row->address;
                                        ?>
                                        )
                                    </small>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->facility_code }}</b>
                                </td>
                                <td><small>{{ $row->contact }}</small></td>
                                <td><small>{{ $row->email }}</small></td>
                                <td><small>{{ $row->chief_hospital }}</small></td>
                                <td>
                                    <span class="badge bg-purple">{{ $row->level == 'primary_care_facility' ? 'Primary Care Facility' : $row->level }}</span>
                                </td>
                                <td>
                                    <span class="
                                        <?php
                                    if($row->hospital_type == 'government'){
                                        echo 'badge bg-green';
                                    }
                                    elseif($row->hospital_type == 'private'){
                                        echo 'badge bg-blue';
                                    }
                                    elseif($row->hospital_type == 'RHU'){
                                        echo 'badge bg-yellow';
                                    }
                                    elseif($row->hospital_type == 'CIU/TTMF'){
                                        echo 'badge bg-purple';
                                    }
                                    elseif($row->hospital_type == 'birthing_home'){
                                        echo 'badge bg-orange';
                                    }
                                    ?>">{{ $row->hospital_type == 'birthing_home' ? 'Birthing Home' : ucfirst($row->hospital_type) }}</span>
                                </td>
                                <td>
                                    <span class="{{ $row->status ? 'badge bg-blue' : 'badge bg-red' }}">{{ $row->status ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <span class="{{ $row->referral_used == 'yes' ? 'badge bg-blue' : 'badge bg-red' }}">{{ ucfirst($row->referral_used) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $data->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Facility found!
                    </span>
                </div>
            @endif
        </div>
    </div>

    @include('admin.modal.facility_modal')
@endsection
@section('js')
    <script>
        $("#container").removeClass("container");
        $("#container").addClass("container-fluid");
        <?php $user = Auth::user(); ?>
        function FacilityBody(data) {
            var json;
            if(data == 'empty'){
                json = {
                    "_token" : "<?php echo csrf_token()?>"
                };
            } else {
                json = {
                    "facility_id" : data,
                    "_token" : "<?php echo csrf_token()?>"
                };
            }
            var url = "<?php echo asset('admin/facility/body') ?>";
            $.post(url, json, function(result) {
                $(".facility_body").html(result);
            })
        }

        function FacilityDelete(facility_id){
            $(".facility_id").val(facility_id);
        }

        @if(Session::get('facility'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("facility_message"); ?>",
                size: 'mini',
                rounded: true
            });
        <?php
            Session::put("facility",false);
            Session::put("facility_message",false)
        ?>
        @endif
    </script>
@endsection

