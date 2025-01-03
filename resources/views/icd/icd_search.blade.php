<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Code</th>
            <th>Description</th>
            <th>Group</th>
            <th>Case Rate</th>
            <th>Professional Fee</th>
            <th>Heath Care Fee</th>
            <th>Source</th>
            <th>Option</th>
        </tr>
    </thead>
    @foreach($icd as $row)
        <tr>
            <td>{{ $row->code }}</td>
            <td>{{ $row->description }}</td>
            <td>{{ $row->group }}</td>
            <td>{{ $row->case_rate }}</td>
            <td>{{ $row->professional_fee }}</td>
            <td>{{ $row->health_care_fee }}</td>
            <td>{{ $row->source }}</td>
            <td>
                <div class="custom-control custom-checkbox checkbox-xl">
                    <input type="checkbox" class="custom-control-input">
                </div>
            </td>
        </tr>
    @endforeach
</table>