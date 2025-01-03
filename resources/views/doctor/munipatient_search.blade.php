<table class="table table-striped"  style="white-space:nowrap;">
    <tbody>
    <tr>
        <th>Name</th>
        <th>Gender</th>
        <th>Age / DOB</th>
        <th>Barangay</th>
        <th style="width:18%;">Facility Name</th>
        <th style="width:18%;">Action</th>
    </tr>
    @foreach($data as $row)
    <tr>
        <td>
            <b>
                {{ $row->lname }}, {{ $row->fname }} {{ $row->mname }}
            </b><br>
            <small class="text-success">{{ $row->contact }}</small>
        </td>
        <td>
            {{ $row->sex }}<br>
            <small class="text-success">{{ $row->civil_status }}</small>
        </td>
        <td>
            <?php $age = \App\Http\Controllers\ParamCtrl::getAge($row->dob);?>
            {{ $age }} years old
            <br />
            <small class="text-muted">{{ date('M d, Y',strtotime($row->dob)) }}</small>
        </td>
        <td>
            <?php
                $brgy_id = ($source=='tsekap') ? $row->barangay_id: $row->brgy;
                $city_id = ($source=='tsekap') ? $row->muncity_id: $row->muncity;
                $phic_id = ($source=='tsekap') ? $row->phicID: $row->phic_id;
                $phic_id_stat = 0;
                if($phic_id){
                    $phic_id_stat = 1;
                }
                
            ?>
            @if($brgy_id!=0)
            {{ $brgy = \App\Barangay::find($brgy_id)->description }}<br />
            <small class="text-success">{{ $city = \App\Muncity::find($city_id)->description }}</small>
            @else
                {{ $row->address }}
            @endif
        </td>
        <td>
            {{ $row->name }}
        </td>
        <td>
            <div class="custom-control custom-checkbox checkbox-xl">
                <input value="{{$row->patient_id}}" type="checkbox" class="custom-control-input" name="patient_id[]" require>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>