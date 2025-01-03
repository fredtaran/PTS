@extends('layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="pull-right">
                <form action="{{ asset('admin/diagnosis') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-lg" style="margin-bottom: 10px;">
                        <input type="text" class="form-control" name="keyword" placeholder="Search diagnosis...">
                        <button type="submit" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="#diagnosis_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat" onclick="diagBody('empty')">
                            <i class="fa fa-hospital-o"></i> Add Diagnosis
                        </a>
                    </div>
                </form>
            </div>
            <h3>List of Diagnosis</h3>
        </div>
        <div class="box-body">
            @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Diagnosis code</th>
                            <th>Diagnosis Description</th>
                            <th>Diagnosis Priority</th>
                            <th>Diagnosis Category</th>
                            <th>Diagnosis Sub Category</th>
                            <th>Diagnosis Main Category</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td style="white-space: nowrap;">
                                    <b>
                                        <a
                                            href="#diagnosis_modal"
                                            data-toggle="modal"
                                            onclick="diagBody('<?php echo $row->id ?>')"
                                        >
                                            {{ $row->diagcode }}
                                        </a>
                                    </b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagdesc }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagpriority }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagcategory }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagsubcat }}</b>
                                </td>
                                <td>
                                    <b class="text-green">{{ $row->diagmaincat }}</b>
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
                        <i class="fa fa-warning"></i> No Diagnosis Found!
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
        function diagBody(data){
            var json;
            if(data == 'empty'){
                json = {
                    "_token" : "<?php echo csrf_token()?>"
                };
            } else {
                json = {
                    "diag_id" : data,
                    "_token" : "<?php echo csrf_token()?>"
                };
          
            }
            var url = "<?php echo asset('admin/diagnosis/body') ?>";
            $.post(url,json,function(result){
                $(".diagnosis_body").html(result);
            })
        }

        function diagDelete(diag_id){
            $(".diag_id").val(diag_id);
        }

        @if(Session::get('diagnosis'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("diagnosis_message"); ?>",
            size: 'mini',
            rounded: true
        });
        <?php
        Session::put("diagnosis",false);
        Session::put("diagnosis_message",false)
        ?>
        @endif

        @if(Session::get('diag_delete'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("diag_delete_message"); ?>",
            size: 'mini',
            rounded: true
        });
        <?php
        Session::put("diag_delete",false);
        Session::put("diag_delete_message",false)
        ?>
        @endif
    </script>
@endsection

