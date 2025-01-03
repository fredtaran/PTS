@extends('layouts.app')

@section('content')
    <div class="row col-md-12">
        <div class="box box-success">
            <h3>Levels of Care Inventory <a href="{{ asset('eoc_city/excel') }}" class="btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Extract Excel</a></h3>
            <div class="box-body">
                @if(count($inventory) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <?php
                            $count = 0;
                            $facility = [];
                            $province = [];
                            ?>
                            @foreach($inventory as $row)
                                @if(!isset($province[$row->province]))
                                    <?php $province[$row->province] = true; ?>
                                    <tr>
                                        <td colspan="8"><b class="text-blue" style="font-size: 15pt;">{{ \App\Province::find($row->province)->description.' Province' }}</b></td>
                                    </tr>
                                @endif
                                @if(!isset($facility[$row->facility]))
                                    <?php
                                        $facility[$row->facility] = true;
                                        $count++;
                                    ?>
                                    <tr>
                                        <td width="3%">{{ $count }}</td>
                                        <td colspan="5"><strong class="text-green">{{ $row->facility }}</strong> <a href="{{ asset('inventory').'/'.$row->facility_id }}" class="btn-sm btn-warning"><i class="fa fa-database"></i> Manage Inventory</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-black">
                                            <strong>
                                                No.of {{ \App\Inventory::where("name","Patients Waiting for Admission")->where("facility_id",$row->facility_id)->first()->name }} :
                                            </strong>
                                            <b class="text-red" style="font-size: 15pt;">{{ \App\Inventory::where("name","Patients Waiting for Admission")->where("facility_id",$row->facility_id)->first()->capacity }}</b>
                                        </td>
                                    </tr>
                                    <tr class="bg-black">
                                        <th ></th>
                                        <th>Description</th>
                                        <th>Capacity</th>
                                        <th>Occupied</th>
                                        <th>Available</th>
                                    </tr>
                                @endif
                                @if($row->name != 'Patients Waiting for Admission')
                                    <tr>
                                        <td></td>
                                        <td>{{ $row->name }}</td>
                                        <td><strong class="text-blue">
                                                {{ $row->capacity }}
                                            </strong>
                                        </td>
                                        <td>
                                            <strong class="text-blue">
                                                {{ $row->occupied }}
                                            </strong>
                                        </td>
                                        <td>
                                            <strong class="text-green">
                                                {{ $row->capacity - $row->occupied }}
                                            </strong>
                                        </td>
                                    </tr>
                                    @if($row->name == 'Regular Covid Beds')
                                        <tr >
                                            <td colspan="5"></td>
                                        </tr>
                                    @endif
                                @endif
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

@section('js')

@endsection

