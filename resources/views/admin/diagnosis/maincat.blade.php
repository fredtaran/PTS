@extends('layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('admin/maincat') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-lg" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search main category...">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="#maincat_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat" onclick="mainBody('empty')">
                            <i class="fa fa-hospital-o"></i> Add Main Category
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Main Categories</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                              <th>Diagnosis Category Code</th>
                                <th>Diagnosis Category Description</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                            href="#maincat_modal"
                                            data-toggle="modal"
                                            onclick="mainBody('<?php echo $row->id ?>')"
                                        >
                                            {{ $row->diagcat }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->catdesc }}</b>
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
                        <i class="fa fa-warning"></i> No Category found!
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
        function mainBody(data){
            var json;
            if(data == 'empty'){
                json = {
                    "_token" : "<?php echo csrf_token()?>"
                };
            } else {
                json = {
                    "maincat_id" : data,
                    "_token" : "<?php echo csrf_token()?>"
                };
            }
            var url = "<?php echo asset('admin/maincat/body') ?>";
            $.post(url,json,function(result){
                $(".maincat_body").html(result);
            })
        }

        function maincatDelete(maincat_id){
            $(".maincat_id").val(maincat_id);
        }

        @if(Session::get('maincat'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("maincat_message"); ?>",
            size: 'mini',
            rounded: true
        });
        <?php
        Session::put("maincat",false);
        Session::put("maincat_message",false)
        ?>
        @endif

        @if(Session::get('main_delete'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("main_delete_message"); ?>",
            size: 'mini',
            rounded: true
        });
        <?php
        Session::put("main_delete",false);
        Session::put("main_delete_message",false)
        ?>
        @endif
    </script>
@endsection

