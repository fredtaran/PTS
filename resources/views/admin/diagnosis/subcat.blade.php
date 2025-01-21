@extends('layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('admin/subcat') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-lg" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search Sub Category...">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="#subcat_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat" onclick="subBody('empty')">
                            <i class="fa fa-hospital-o"></i> Add Sub Category
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Sub Categories</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                        <th>Diagnosis Sub Category Code</th>
                            <th>Diagnosis Main Category Code</th>
                            <th>Diagnosis Sub Category Description</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                            <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                            href="#subcat_modal"
                                            data-toggle="modal"
                                            onclick="subBody('<?php echo $row->id ?>')"
                                        >
                                            {{ $row->diagsubcat }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagmcat }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagscatdesc }}</b>
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
        function subBody(data){
            var json;
            if(data == 'empty'){
                json = {
                    "_token" : "<?php echo csrf_token()?>"
                };
            } else {
                json = {
                    "subcat_id" : data,
                    "_token" : "<?php echo csrf_token()?>"
                };
            }
            var url = "<?php echo asset('admin/subcat/body') ?>";
            $.post(url,json,function(result){
                $(".subcat_body").html(result);
            })
        }

        function subDelete(subcat_id){
            $(".subcat_id").val(subcat_id);
        }

        @if(Session::get('subcat'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("subcat_message"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
        <?php
        Session::put("subcat",false);
        Session::put("subcat_message",false)
        ?>
        @endif

        @if(Session::get('sub_delete'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("sub_delete_message"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
        <?php
        Session::put("sub_delete",false);
        Session::put("sub_delete_message",false)
        ?>
        @endif
    </script>
@endsection

