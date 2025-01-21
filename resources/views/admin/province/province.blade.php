@extends('layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('admin/province') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-lg" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search province..." value="{{ Session::get("keyword") }}">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-eye"></i> View All
                        </button>
                        <a href="#facility_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat" onclick="ProvinceBody('empty')">
                            <i class="fa fa-hospital-o"></i> Add Province
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
                            <th>Province Name</th>
                            <th>Province Code</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                            href="#facility_modal"
                                            data-toggle="modal"
                                            onclick="ProvinceBody('<?php echo $row->id ?>')"
                                        >
                                            {{ $row->description }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->province_code }}</b>
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
                        <i class="fa fa-warning"></i> No Province found!
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
        function ProvinceBody(data){
            var json;
            if(data == 'empty'){
                json = {
                    "_token" : "<?php echo csrf_token()?>"
                };
            } else {
                json = {
                    "province_id" : data,
                    "_token" : "<?php echo csrf_token()?>"
                };
            }
            var url = "<?php echo asset('admin/province/body') ?>";
            $.post(url,json,function(result){
                $(".facility_body").html(result);
            })
        }

        function ProvinceDelete(facility_id){
            $(".province_id").val(facility_id);
        }

        @if(Session::get('province'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("province_message"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
        <?php
        Session::put("province",false);
        Session::put("province_message",false)
        ?>
        @endif
    </script>
@endsection

