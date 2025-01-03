<input type="hidden" class="user_id" value="{{ @$user_id }}" name="user_id">

<div class="modal-body">
    <fieldset>
        <legend><i class="fa fa-user-plus"></i> Add User</legend>
    </fieldset>

    <div class="form-group">
        <label>First Name:</label>
        <input type="text" class="form-control" value="{{ @$user->fname }}" name="fname" required>
    </div>

    <div class="form-group">
        <label>Middle Name:</label>
        <input type="text" class="form-control" value="{{ @$user->mname }}" name="mname">
    </div>

    <div class="form-group">
        <label>Last Name:</label>
        <input type="text" class="form-control" value="{{ @$user->lname }}" name="lname" required>
    </div>

    <div class="form-group">
        <label>Contact Number:</label>
        <input type="text" class="form-control" value="{{ @$user->contact }}" name="contact" required>
    </div>

    <div class="form-group">
        <label>Email Address <small class="text-muted"><em>(Optional):</em></small></label>
        <input type="text" class="form-control" name="email" value="{{ @$user->email }}">
    </div>

    <hr />

    <div class="form-group">
        <label>Facility:</label>
        <select class="form-control select2" name="facility_id" required>
            <option value="">Select options</option>
            @foreach($facility as $fac)
                <option value="{{ $fac->id }}" <?php if($fac->id == @$user->facility_id) echo 'selected'; ?> >{{ $fac->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Designation:</label>
        <input type="text" class="form-control" value="{{ @$user->designation }}" name="designation" required>
    </div>

    <div class="form-group">
        <label>Level:</label>
        <select class="form-control" name="level" required>
            <option value="">Select options</option>
            <option value="support" <?php if(@$user->level == "support") echo 'selected'; ?>>IT Support</option>
            <option value="opcen" <?php if(@$user->level == "opcen") echo 'selected'; ?>>OPCEN</option>
            <option value="bed_tracker" <?php if(@$user->level == "bed_tracker") echo 'selected'; ?>>BED TRACKER</option>
        </select>
    </div>

    <hr />
    
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control username_1" name="username" value="{{ @$user->username }}" <?php if($user_id != 'no_id') echo 'readonly'; else echo 'required'; ?>>
        @if($user_id == 'no_id')
        <div class="username-has-error text-bold text-danger hide">
            <small>Username already taken!</small>
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" pattern=".{3,}" title="Password - minimum of 3 character" class="form-control" id="password1" name="password" <?php if($user_id != 'no_id') echo 'placeholder="(Password Unchanged)"'; else echo 'required' ?>>
    </div>

    <div class="form-group">
        <label>Confirm Password</label>

        <input type="password" pattern=".{3,}" title="Confirm password - minimum of 3 Character" class="form-control" id="password2" name="confirm" <?php if($user_id != 'no_id') echo 'placeholder="(Password Unchanged)"'; else echo 'required' ?>>

        <div class="password-has-error has-error text-bold text-danger hide">
            <small>Password not match!</small>
        </div>

        <div class="password-has-match has-match text-bold text-success hide">
            <small><i class="fa fa-check-circle"></i> Password matched!</small>
        </div>
    </div>
</div>

<input type="hidden" name="department_id" value="0">

<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
</div>
<script>
    $(".select2").select2({ width: '100%' });
</script>