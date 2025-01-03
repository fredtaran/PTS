<style>
    @media
    only screen and (min-device-width: 280px)
    and (max-device-width: 568px) {
        #icd_table_group, tr td:nth-child(3) { display: none; visibility: hidden; }
        #icd_table_cr, tr td:nth-child(4) { display: none; visibility: hidden; }
        #icd_table_pf, tr td:nth-child(5) { display: none; visibility: hidden; }
        #icd_table_hcf, tr td:nth-child(6) { display: none; visibility: hidden; }
        #icd_table_source, tr td:nth-child(7) { display: none; visibility: hidden; }
    }
</style>

@if(!empty($facility) && count($facility) > 0)
    <table class="table table-bordered table-hover icd-table">
        <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th id="icd_table_group">Address</th>
            <th id="icd_table_cr">Chief Hospital</th> <!--Case Rate -->
            <th id="icd_table_pf">Level</th> <!-- Professional Fee -->
            <th id="icd_table_hcf">Type</th> <!-- Health Care Fee -->
            <th>Option</th>
        </tr>
        </thead>
        @foreach($facility as $row)
            <tr>
                <td>{{ $row->facility_code }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->chief_hospital }}</td>
                <td>{{ $row->level }}</td>
                <td>{{ $row->hospital_type }}</td>
                <td>
                    <div class="custom-control custom-checkbox checkbox-xl">
                        <input type="checkbox" class="custom-control-input" value="{{ $row->id }}" name="facility_checkbox[]" style="height: 30px;width: 30px;cursor: pointer;">
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        {{ $facility->links() }}
    </div>
@else
    <div class="alert alert-warning">
        <div class="text-warning">
            <i class="fa fa-warning"></i> No Facility Found!
        </div>
    </div>
@endif
