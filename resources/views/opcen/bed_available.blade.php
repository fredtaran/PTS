@extends('layouts.app')

@section('content')
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <td colspan="3"><b style="font-size: 15pt;" class="text-green">Type of Beds:</b></td>
                        </tr>
                        <tr class="bg-black">
                            <th width="5%"></th>
                            <th>Description</th>
                            <th>Available</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Emergency Room (ER) Beds</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Intensive Care Unit(ICU) Beds</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Critical Care Beds</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Isolation Beds</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Mechanical Ventilators</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>TTMF/Isolation Beds</td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Dialysis Machine</td>
                            <td>70</td>
                        </tr>
                    </table>

                    <table class="table table-hover table-bordered">
                        <tr>
                            <td colspan="3"><b style="font-size: 15pt;" class="text-green">Services:</b></td>
                        </tr>
                        <tr class="bg-black">
                            <th width="5%"></th>
                            <th>Description</th>
                            <th>Available</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Out Patient Department (OPD)</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Animal Bite Center (ABC)</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>TB DOTS</td>
                            <td>30</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script></script>
@endsection

