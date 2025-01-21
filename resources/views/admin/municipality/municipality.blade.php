@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="pull-right">
            <form action="{{ asset('admin/municipality').'/'.$province_id }}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <div class="form-group-lg" style="margin-bottom: 10px;">
                    <input type="text" class="form-control" name="keyword_muncity" placeholder="Search municipality..." value="{{ Session::get('keyword_muncity') }}">

                    <button type="submit" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-search"></i> Search
                    </button>

                    <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                        <i class="fa fa-eye"></i> View All
                    </button>

                    <a href="#facility_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat" onclick="municipalityBody('<?php echo $province_id; ?>','empty')">
                        <i class="fa fa-hospital-o"></i> Add Municipality
                    </a>
                </div>
            </form>
        </div>
        
        <h1>{{ $title }}</h1>
        <b class="text-yellow" style="font-size: 13pt;">{{ $province_name }} Province</b>
    </div>
    
    <div class="box-body">
        @if(count($data) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr class="bg-black">
                    <th>Municipality Name</th>
                    <th>Municipality Code</th>
                    <th>Frontline Health Workers</th>
                    <th width="5%;">Option</th>
                </tr>

                @foreach($data as $row)
                <tr>
                    <td style="white-space: nowrap;">
                        <b>
                            <a href="#facility_modal" data-toggle="modal" onclick="municipalityBody('<?php echo $province_id; ?>','<?php echo $row->id; ?>')">
                                {{ $row->description }}
                            </a>
                        </b>
                    </td>

                    <td>
                        <b class="text-green">{{ $row->muncity_code }}</b>
                    </td>

                    <td>
                        <p>
                            <a href="#" class="text_editable" id="frontline_health_workers{{ $row->id }}" style="font-size: 10pt;">
                                {{ $row->frontline_health_workers }}
                            </a>
                        </p>
                    </td>

                    <td>
                        <a href="{{ asset('admin/barangay') . '/' . $province_id . '/' . $row->id }}" class="btn btn-block btn-social btn-instagram">
                            <i class="fa fa-dropbox"></i> Show Barangay
                        </a>
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
                <i class="fa fa-warning"></i> No Municipalities/Cities found!
            </span>
        </div>
        @endif
    </div>
</div>

@include('admin.modal.facility_modal')
@endsection

@section('js')
<script src="{{ asset('plugin/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
<script>
    <?php $user = Auth::user(); ?>
    //turn to inline mode
    $.fn.editable.defaults.mode = 'popup';
    //editables
    $(".text_editable").each(function(){
        $('#' + this.id).editable({
            type : this.id == 'remarks' ? 'textarea' : 'text',
            name: 'username',
            title: $(this).data("title"),
            emptytext: 'empty',
            success: function(response, newValue) {
                
            }
        });
    });

    function municipalityBody(province_id,muncity_id){
        var json;
        
        if(muncity_id == 'empty'){
            json = {
                "province_id" : province_id,
                "_token" : "<?php echo csrf_token()?>"
            };
        } else {
            json = {
                "province_id" : province_id,
                "muncity_id" : muncity_id ,
                "_token" : "<?php echo csrf_token()?>"
            };
        }

        var url = "<?php echo asset('admin/municipality/crud/body') ?>";

        $.post(url,json,function(result){
            $(".facility_body").html(result);
        })
    }

    function MunicipalityDelete(muncity_id){
        $(".muncity_id").val(muncity_id);
    }

    @if(Session::get('municipality'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("municipality_message"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
        
        <?php
            Session::put("municipality",false);
            Session::put("municipality_message",false)
        ?>
    @endif
</script>
@endsection
