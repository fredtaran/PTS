<?php
    $user = Auth::user();
    $users = \App\Models\User::where('facility_id',$user->facility_id)
                ->where('level','doctor')
                ->orderBy('lname','asc')
                ->get();
?>

<div class="modal fade" role="dialog" id="loginModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fa fa-user-md"></i> Change Login</h4>
            </div>
            <form method="post"  action="{{ url('doctor/change/login') }}">
                {{ csrf_field() }}
            <div class="modal-body" style="padding-bottom:5px ">
                <div class="form-group">
                    <label style="padding: 0px;">User</label>
                    <select class="form-control" name="loginId">
                        @foreach($users as $u)
                        <option @if($u->id==$user->id) selected @endif value="{{ $u->id }}">{{ $u->lname }}, {{ $u->fname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label style="padding: 0px;">Password</label>
                    <input autofocus type="password" class="form-control" name="loginPassword" />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" type="submit">
                    <i class="fa fa-sign-in"></i> Login
                </button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->