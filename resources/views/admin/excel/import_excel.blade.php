@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3>IMPORT EXCEL</h3>
                </div>
                <div class="box-body">
                    <form action="{{ asset('excel/import') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" class="form-control" name="import_file">
                        <button class="btn btn-success" type="submit"> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        @if (Session::has('success'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("success"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
        @endif
    </script>
@endsection

