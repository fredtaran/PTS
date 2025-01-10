@if(count($data)>0)
<div class="table-responsive">
                    <table class="table table-striped " id="test"  style="white-space:nowrap;">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <th>File Type</th>
                            <th>Uploaded By</th>
                          
                            <th>Date Uploaded</th>
                        </tr>   
                 
                   @foreach($data as $row)                      
                        <tr>
                            <td>
                                <a target="_blank" href="{{ url('doctor/fileView/' . $row->id) }}"
                                    data-toggle="modal"
                                    class="btn btn-info btn-xs">
                                    <i class="fa fa-file"></i>
                                    {{$row->name}}
                                </a>
                            </td>
                            <td>
                                {{$row->file_type}}
                            </td>
                            <td>
                                {{$row->fname}} {{$row->mname}} {{$row->lname}} 
                            </td>
                           
                            <td>
                                {{$row->uploaded_date}}
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