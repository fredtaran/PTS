@extends('layouts.app')

@section('content')
<div class="row col-md-12">
    <div class="box box-success">
        <div class="box-header">
            <form action="{{ asset('opcen/client') }}" method="GET">
                {{ csrf_field() }}
                <div class="input-group input-group-md" style="width: 70%">
                    <input type="text" class="form-control" style="width: 100%" placeholder="Reference Number or Name" name="search" value="{{ $search }}">
                    <span class="input-group-btn">
                        <input type="text" class="form-control" style="width: 50%" id="date_range" placeholder="Enter date range.." name="date_range" value="{{ date('m/d/Y', strtotime($date_range_start)) . ' - ' . date('m/d/Y', strtotime($date_range_end)) }}">

                        <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>

                        <a href="{{ asset('export/client/call') }}" type="button" class="btn btn-danger"><i class="fa fa-file-excel-o"></i> Export Excel</a>

                        <button type="button" class="btn btn-warning" onclick="refreshPage()"><i class="fa fa-eye"></i> View All</button>
                        
                        <button type="button" class="btn btn-primary" onclick="newCall('new_call')"><i class="fa fa-phone-square"></i> New Call</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="row" style="padding-left: 1%;padding-right: 1%">
            <div class="col-lg-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $call_total }}</h3>

                        <p>Total Call</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-call"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $call_new }}</h3>

                        <p>New Call</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-call"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $call_repeat }}</h3>

                        <p>Repeat Call</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-call"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $no_classification }}</h3>

                        <p>No Classification</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-call"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div style="padding: 1%;">
            <span class="badge bg-green">{{ $call_inquiry }}</span> Inquiry
            <span class="badge bg-green">{{ $call_referral }}</span> Referral
            <span class="badge bg-green">{{ $call_others }}</span> Others
            <span class="badge bg-green">{{ $no_reason_for_calling }}</span> No Reason for Calling
            <span class="badge bg-yellow">{{ $call_complete }}</span> Completed Call
            <span class="badge bg-yellow">{{ $call_incomplete }}</span> In-Complete Call
            <span class="badge bg-yellow">{{ $no_transaction }}</span> No Transaction
        </div>

        <div class="box-body">
            <div class="call_classification table-responsive">
                @if(count($client)>0)
                <table class="table table-striped">
                    <thead class="bg-gray">
                    <tr>
                        <th>Client Name</th>
                        <th>Transacted By</th>
                        <th>Time Started</th>
                        <th>Time Ended</th>
                        <th>Time Duration</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($client as $row)
                        <tr>
                            <td>
                                <a
                                    href="#client_modal"
                                    data-toggle="modal"
                                    data-id = "{{ $row->id }}"
                                    onclick="ClientBody('<?php echo $row->id ?>',$(this))"
                                    class="client_info"
                                >
                                    <span class="text-green font_size">{{ $row->name }}</span><br>
                                    @if($row->transaction_complete)
                                        <small class="text-blue">Completed Call</small>
                                    @else
                                        <small class="text-red">In-Complete Call</small>
                                    @endif<br>
                                    <small class="text-yellow">{{ $row->reference_number }}</small>
                                    <?php
                                        $client_addendum = \App\ClientAddendum::where("client_id",$row->id)->count();
                                    ?>
                                    @if($client_addendum > 0)
                                        <span class="badge bg-yellow">Addendum {{ $client_addendum }}</span>
                                    @endif
                                    <br>
                                </a>
                            </td>

                            <td>
                                <?php
                                    $transacted_by = \App\User::find($row->encoded_by);
                                    $transacted_by = $transacted_by->fname.' '.ucfirst($transacted_by->mname[0]).'. '.$transacted_by->lname;
                                ?>
                                <span class="text-green font_size">{{ $transacted_by }}</span><br>
                                @if($row->call_classification == 'new_call')<small class="text-blue">(New Call)</small>@else<small class="text-red">(Repeat Call)</small>@endif
                            </td>

                            <td>
                                <span class="text-green font_size">
                                    {{ date('F d,Y',strtotime($row->time_started)) }}
                                </span><br>
                                <small class="text-yellow">
                                    ({{ date('h:i:s A',strtotime($row->time_started)) }})
                                </small>
                            </td>

                            <td>
                                <span class="text-green font_size">
                                    {{ date('F d,Y',strtotime($row->time_ended)) }}
                                </span><br>
                                <small class="text-yellow">
                                    ({{ date('h:i:s A',strtotime($row->time_ended)) }})
                                </small>
                            </td>

                            <td>
                                <span class="font_size text-blue">
                                    {{ date('H:i:s',strtotime($row->time_duration)) }}
                                </span><br>
                                <small class="text-yellow">
                                    ({{ ucfirst($row->reason_calling) }})
                                </small>
                            </td>

                            <td width="10%">
                                <button type="button" class="btn btn-sm btn-info" onclick="repeatCall('<?php echo $row->id; ?>','repeat_call')">
                                    <i class="fa fa-phone-square"></i> Repeat Call
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $client->links() }}
                </div>
                @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No data found!
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="loading_modal">
    <center style="margin-top: 10%;">
        <img src="{{ asset('img/loading.gif') }}" alt="">
    </center>
</div><!-- /.modal -->

<div class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" id="client_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body client_modal_body">

            </div><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('js')
<script>
    @if(Session::get('opcen'))
        Lobibox.notify('success', {
            title: "",
            msg: "New client saved!",
            size: 'mini',
            rounded: true
            sound: false
        });
        <?php Session::put("opcen", false); ?>
    @elseif(Session::get('addendum'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added addendum!",
            size: 'mini',
            rounded: true,
            sound: false
        });
        <?php Session::put("addendum", false); ?>
    @endif

    $('#date_range').daterangepicker();

    function newCall($call_classification) {
        $(".call_classification").html(loading);
        var url = "<?php echo asset('opcen/new_call'); ?>";
        $.get(url, function(data) {
            setTimeout(function() {
                $(".call_classification").html(data);

                $(".select2").select2({ width: '100%' });

                $("#call_classification_text").html("New Call");
                $("#call_classification").val($call_classification);

                var d = new Date();
                $("#time_started").val(d.toLocaleString());
                $("#time_started_text").html(d.toLocaleString());
            }, 500);
        });
    }

    function ClientBody($client_id, data) {
        $("a").css("background-color", "");
        data.css("background-color", "yellow");
        $(".client_modal_body").html(loading);
        var url = "<?php echo asset('opcen/client/form') . '/'; ?>" + $client_id;
        $.get(url, function(data) {
            setTimeout(function() {
                $(".client_modal_body").html(data);
            }, 500);
        });
    }

    function repeatCall($client_id, $call_classification) {
        $(".call_classification").html(loading);
        var url = "<?php echo asset('opcen/repeat_call') . '/'; ?>" + $client_id;
        $.get(url, function(data) {
            setTimeout(function() {
                $(".call_classification").html(data);
                $(".select2").select2({ width: '100%' });

                $("#call_classification_text").html("Repeat Call");
                $("#call_classification").val($call_classification);

                var d = new Date();
                $("#time_started").val(d.toLocaleString());
                $("#time_started_text").html(d.toLocaleString());
            }, 500);
        });
    }

    function reasonCalling($reason) {
        $("#reason_calling").val($reason);
        $(".reason_calling").html(loading);
        var url = "<?php echo asset('opcen/reason_calling') . '/'; ?>" + $reason;
        $.get(url, function(data) {
            setTimeout(function() {
                $(".reason_calling").html(data);
            }, 500);
        });
    }

    function transactionComplete() {
        $(".transaction_status").html(loading);
        var url = "<?php echo asset('opcen/transaction/complete'); ?>";
        $.get(url, function(data) {
            setTimeout(function() {
                $(".transaction_status").html(data);
            }, 500);
        });
    }

    function transactionInComplete() {
        $(".transaction_status").html(loading);
        var url = "<?php echo asset('opcen/transaction/incomplete'); ?>";
        $.get(url, function(data) {
            setTimeout(function() {
                $(".transaction_status").html(data);
            }, 500);
        });
    }

    function actionInComplete() {
        Lobibox.notify('error', {
            title: 'Action In-Complete',
            msg: "Sending SMS!",
            sound: false
        });
    }

    function endTransaction($element) {
        var d = new Date();
        $("#time_ended").val(d.toLocaleString());

        $($element).prop('disabled', true);
        $('.loading').show();
        $("#form_submit").submit();
    }

    function onChangeProvince($province_id) {
        if($province_id) {
            var url = "{{ url('opcen/onchange/province') }}";
            $.ajax({
                url: url + '/' + $province_id,
                type: 'GET',
                success: function(data) {
                    $("#municipality").select2("val", "");
                    $('#municipality').empty()
                        .append($('<option>', {
                            value: '',
                            text : 'Select Option'
                        }));
                        
                    jQuery.each(data, function(i, val) {
                        $('#municipality').append($('<option>', {
                            value: val.id,
                            text : val.description
                        }));
                    });
                },
                error: function() {
                    $('#serverModal').modal();
                }
            });
        } else {
            $("#municipality").select2("val", "");
            $('#municipality').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Option'
                }));
        }
    }

    function onChangeMunicipality($municipality_id) {
        if($municipality_id) {
            var url = "{{ url('opcen/onchange/municipality') }}";
            $.ajax({
                url: url + '/' + $municipality_id,
                type: 'GET',
                success: function(data) {
                    $("#barangay").select2("val", "");
                    $('#barangay').empty()
                        .append($('<option>', {
                            value: '',
                            text : 'Select Option'
                        }));
                    jQuery.each(data, function(i,val) {
                        $('#barangay').append($('<option>', {
                            value: val.id,
                            text : val.description
                        }));
                    });
                },
                error: function() {
                    $('#serverModal').modal();
                }
            });
        } else {
            $("#barangay").select2("val", "");
            $('#barangay').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Option'
                }));
        }
    }
</script>
<!-- <link href="{{ asset('plugin/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css') }}" rel="stylesheet"> -->
@vite('resources/plugin/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css')
<!-- <script src="{{ asset('plugin/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js') }}"></script> -->
@vite('resources/plugin/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js')
@endsection

