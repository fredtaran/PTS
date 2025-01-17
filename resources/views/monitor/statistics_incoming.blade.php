<?php
     $user = Session::get('auth');
    
     $facility = App\Facility::where('status',1)
     ->where('province',$user->province)
     ->orderBy('name','asc')
     ->get();
?>

@extends('layouts.app')

@section('content')

    <style>
        label {
            padding: 0px !important;
        }
    </style>
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <div class="pull-right">
                    <form action="{{ asset('monitoring/statistics/incoming') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-md">
                            <input type="text" class="form-control" name="date_range" value="{{ date("m/d/Y",strtotime($date_range_start)).' - '.date("m/d/Y",strtotime($date_range_end)) }}" 
                            placeholder="Filter your daterange here..." id="consolidate_date_range">
                         
                            <select class="form-control" name="facility_filter" id="facility">
                                <option value="">All Facility</option>
                                @foreach($facility as $f)
                                    <option {{ ($facility_filter==$f->id) ? 'selected':'' }} value="{{ $f->id }}">{{ $f->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-sm btn-info btn-flat"><i class="fa fa-search"></i> Filter</button>
                            <button type="button" class="btn-sm btn-primary btn-flat" onclick="printDocu()"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </form>
                </div>
                <h3 id="titlePage">{{ $title }}</h3>
            </div>
            <div id="section-to-print" class="box-body">
                @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr class="bg-black">
                                <th></th>
                                <th>Facility Name</th>
                                <th>Incoming</th>
                                <th>Accepted</th>
                                <th>Redirected</th>
                                <th>Seen only</th>
                                <th>Not Seen</th>
                            </tr>
                            <?php
                            $count = 0;
                            ?>
                            @foreach($data as $row)
                                <?php
                                $count++;

                                ?>
                                @if(!isset($province[$row->province]))
                                    <?php $province[$row->province] = true; ?>
                                    <tr>
                                        <td colspan="5">
                                            <strong class="text-green">{{ $row->province }}</strong>
                                        </td>
                                    </tr>
                                @endif
                                <tr class="">
                                    <td>{{ $count }}</td>
                                    <td >
                                        <span style="font-size: 12pt;">
                                            {{ $row->name }}
                                        </span><br>
                                        <small class="@if($row->hospital_type == 'government'){{ 'text-yellow' }}@else{{ 'text-maroon' }}@endif">{{ ucfirst($row->hospital_type) }}</small>
                                    </td>
                                    <td width="10%">
                                        <span class="text-blue" style="font-size: 15pt">{{ $row->incoming }}</span><br><br>
                                    </td>
                                    <td width="10%">
                                        <?php
                                            $accept_percent = ($row->accepted / $row->incoming) * 100;
                                        ?>
                                        <span class="text-blue">{{ $row->accepted }}</span><br>
                                        <b style="font-size: 15pt" class="<?php if($accept_percent >= 50) echo 'text-green'; else echo 'text-red'; ?>">({{ round($accept_percent)."%" }})</b>
                                    </td>
                                    <td width="10%">
                                        <span class="text-blue" style="font-size: 15pt;">{{ $row->redirected }}</span><br><br>
                                    </td>
                                    <?php
                                        $seen_only = $row->seen_total - $row->seen_accepted_redirected;
                                        $seen_only = $seen_only <= 0 ? 0 : $seen_only;
                                    ?>
                                    <td width="10%">
                                        <span class="text-blue" style="font-size: 15pt;">{{ $seen_only }}</span><br><br>
                                    </td>
                                    <?php
                                        $no_action = $row->incoming - ($row->accepted + $row->redirected + $seen_only);
                                        $no_action = $no_action <= 0 ? 0 : $no_action;
                                    ?>
                                    <td width="10%">
                                        <span class="text-blue" style="font-size: 15pt;">{{ $no_action }}</span><br><br>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
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

@endsection
@section('css')
@endsection

@section('js')
<script src="{{ url('plugin/printThis.js') }}"></script>
<script>
    var title = $('#titlePage').text();
    $('#consolidate_date_range').daterangepicker();
    function printDocu() {
        $('#section-to-print').printThis({
            header: '<h3>' + title + '</h3>'
        });
    }
</script>
@endsection

