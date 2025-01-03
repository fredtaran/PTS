@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px !important;
        }
    </style>

    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <h2>Onboard Users</h2>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Province</th>
                            <th>Government Hospital</th>
                            <th>Private Hospital</th>
                            <th>RHU</th>
                            <th>Birthing</th>
                            <th>No hospital type</th>
                            <th>Total</th>
                        </tr>
                        @foreach($onboard_users as $row)
                        <tr>
                            <td width="13%"><strong class="text-yellow">{{ $row->province }}</strong></td>
                            <td width="15%">
                                <small>Total: </small> <span class="text-blue" style="font-size: 15pt;">{{ $row->onboard_government }}</span><br>
                                <small>With Transaction: </small><small class="text-green">{{ @$row->onboard_government_with }}</small><br>
                                <small>No Transaction: </small><small class="text-red">{{ $row->onboard_government - @$row->onboard_government_with }}</small>
                            </td>
                            <td width="15%">
                                <small>Total: </small> <span class="text-blue" style="font-size: 15pt;">{{ $row->onboard_private }}</span><br>
                                <small>With Transaction: </small><small class="text-green">{{ @$row->onboard_pri_with }}</small><br>
                                <small>No Transaction: </small><small class="text-red">{{ $row->onboard_private - @$row->onboard_pri_with }}</small>
                            </td>
                            <td width="15%">
                                <small>Total: </small> <span class="text-blue" style="font-size: 15pt;">{{ $row->onboard_rhu }}</span><br>
                                <small>With Transaction: </small><small class="text-green">{{ $row->onboard_rhu_with }}</small><br>
                                <small>No Transaction: </small><small class="text-red">{{ $row->onboard_rhu - $row->onboard_rhu_with }}</small>
                            </td>
                            <td width="15%">
                                <small>Total: </small> <span class="text-blue" style="font-size: 15pt;">{{ $row->onboard_birthing }}</span><br>
                                <small>With Transaction: </small><small class="text-green">{{ $row->onboard_birt_with }}</small><br>
                                <small>No Transaction: </small><small class="text-red">{{ $row->onboard_birthing - $row->onboard_birt_with }}</small>
                            </td>
                            <td width="15%">
                                <small>Total: </small> <span class="text-blue" style="font-size: 15pt;">{{ $row->onboard_no_hospital_type }}</span><br>
                                <small>With Transaction: </small><small class="text-green">{{ $row->onboard_no_hospital_type_with }}</small><br>
                                <small>No Transaction: </small><small class="text-red">{{ $row->onboard_no_hospital_type - $row->onboard_no_hospital_type_with }}</small>
                            </td>
                            <td width="17%;">
                                <small>Total: </small> <span class="text-blue" style="font-size: 15pt;">{{ $row->onboard_total }}</span><br>
                                <?php
                                    $onboard_total_with = @$row->onboard_government_with + @$row->onboard_pri_with + $row->onboard_rhu_with + $row->onboard_birt_with + $row->onboard_no_hospital_type_with;
                                ?>
                                <small>With Transaction: </small><small class="text-green">{{ $onboard_total_with }}</small><br>
                                <small>No Transaction: </small><small class="text-red">{{ $row->onboard_total - $onboard_total_with }}</small>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

