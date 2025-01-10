<form action="{{ url('doctor/uploadfile') }}" method="POST" class="form-submit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="refer_code" value="@if(isset($code)) {{$code}} @endif" class="form-submit">
    <h2>File Upload</h2>

    <hr>

    <input type="button" class="add_row btn btn-info" value="Add Row">
    <input type="button" class="delete_row btn btn-danger" value="Delete Row">

    <br>
    <br>

    <table class="table table-striped"  style="white-space:nowrap;">
        <thead>
            <tr>
                <th>File</th>
                <th>File Type</th>
            </tr>
        </thead>

        <tbody class="add_col form-submit">
            <tr>
                <td>
                    <input type="file" accept="application/pdf" name="file[]" class="form-submit" required>
                </td>

                <?php
                $type = \App\Models\Filetypes::all();
                ?>

                <td>
                    <select name="file_type[]" class="form-control" required>
                        <option value ="">Select...</option>
                        @foreach($type as $row)
                        <option value="{{ $row->id }}">{{ $row->description }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    <input type="submit" class="btn btn-success" value="Submit">
</form>

<hr>

@if(count($data) > 0)
<div class="table-responsive">
    <table class="table table-striped " id="test"  style="white-space:nowrap;">
        <tbody>
            <tr>
                <th>Name</th>
                <th>File Type</th>
                <th>Uploaded By</th>
                <th>Uploader</th>
                <th>Date Uploaded</th>
            </tr>

            @foreach($data as $row)                      
            <tr>
                <td>
                    <a target="_blank" href="{{ url('doctor/fileView/' . $row->id) }}"
                    class="btn btn-info btn-xs">
                        <i class="fa fa-file"></i>
                        {{ $row->name }}
                    </a>
                    
                    @if($row->uploaded_by == Auth::user()->id)
                    <a href="{{ url('doctor/fileDelete/' . $row->id) }}"
                    data-toggle="modal"
                    class="btn btn-danger btn-xs">
                        <i class="fa fa-remove"></i>
                        Delete
                    </a>
                    @endif
                </td>

                <td>
                    {{ $row->file_type }}
                </td>

                <td>
                    {{ $row->fname }} {{ $row->mname }} {{ $row->lname }}
                </td>

                <td>
                    <?php
                        $user = \App\Models\User::find($row->uploaded_by);
                        $facility = \App\Models\Facility::find($user->facility_id)->name;
                    ?>
                    {{ $facility }}
                </td>

                <td>
                    {{ $row->uploaded_date }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@else
<div class="alert alert-warning">
    <span class="text-warning">
        <i class="fa fa-warning"></i> No data found!
    </span>
</div>
@endif

<script>
    $(document).ready(function(){
        $(".add_row").click(function(){
            <?php
            $type = \App\Models\Filetypes::all();?>
            var markup = "<tr><td><span><input type='file' name='file[]'></td><td><select name='file_type[]' class='form-control'><option value =''>Select...</option> @foreach($type as $row) <option value='{{ $row->id }}'>{{ $row->description }}</option>  @endforeach</select></span></td></tr>";
            $(".add_col").append(markup);
        });

        $(".delete_row").click(function(){
            $('.add_col').children().last().remove();
        });
    });    
</script>