<table class="table table-hover table-bordered">
    <tr>
        <td colspan="4"><span class="text-red">Note: This module is under development.</span></td>
    </tr>
    <tr>
        <td colspan="2">No.of {{ \App\Inventory::where("name","Patients Waiting for Admission")->where("facility_id",$facility_id)->first()->name }} :</td>
        <td colspan="2"><b class="text-red" style="font-size: 15pt;">{{ \App\Inventory::where("name","Patients Waiting for Admission")->where("facility_id",$facility_id)->first()->capacity }}</b></td>
    </tr>
    <tr class="bg-aqua">
        <th>Description</th>
        <th>Capacity</th>
        <th>Occupied</th>
        <th>Available</th>
    </tr>
    @foreach($inventory as $inven)
        @if($inven->name != 'Patients Waiting for Admission')
            <tr>
                <td>{{ $inven->name }}</td>
                <td>{{ $inven->capacity }}</td>
                <td>{{ $inven->occupied }}</td>
                <td><span class="text-green" style="font-size: 9pt;">{{ $inven->capacity - $inven->occupied }}</span> <input type="radio" name="available"></td>
            </tr>
        @endif
    @endforeach
</table>