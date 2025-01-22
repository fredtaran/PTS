<h3> Client Satisfaction Survey</h3>

<table class="table table-striped"  style="white-space:nowrap;">
    <tbody>
        <tr>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>
                The Respondent of this Servey Form: 
            </td>

            <td>
                <div class="row">
                    <div class="col-md-3">
                        <input type="radio" name="respondent" class="consent" value="patient"> <b>Patient</b> 
                    </div>
                    
                    <div class="col-md-3">
                        <input type="radio" name="respondent" class="consent" value="companion"> <b>Companion(Family/Relative)</b>
                    </div>

                    <div class="col-md-9">
                        <input type="radio" name="respondent" class="consent" > <b>Others(Specify):</b><input type="text" size="22" class="form-control">
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td>Name of Facility:</td>
            
            <td>
                <input type="text" value="{{ $hospital }}" class="form-control" disabled/>
                <input type="hidden" value="{{ $hospital_id }}" class="form-control " name="fac_id" />
                <input type="hidden" value="{{ $code }}" class="form-control " name="patient_code" />
            </td>
        </tr>

        <tr>
            <td>Date of Visit: </td>

            <td>
                <input type="text" value="{{ date('Y-m-d h:i:s A') }}" class="form-control form_datetime" name="date_of_visit" placeholder="Date/Time Admitted" />
            </td>
        </tr>
    </tbody>
</table>

<table class="table table-striped"  style="white-space:nowrap;">
    <tbody>
        <tr>
            <th style="width: 5%;"></th>
            <th style="width: 5%;">Excellent</th>
            <th style="width: 5%;">Good</th>
            <th style="width: 5%;">Poor</th>
        </tr>

        <tr>
            <td>How can you rate the overall services rendered?</td>

            <td>
                <input type="radio" name="overall" class="consent" value="1" required>
            </td>

            <td>
                <input type="radio" name="overall" class="consent" value="1" required>
            </td>
            
            <td>
                <input type="radio" name="overall" class="consent" value="1" required>
            </td>
        </tr>

        <tr>
            <td>Are you satisfied of our services?</td>

            <td>
                <input type="radio" name="satisfied" class="consent" value="Yes" required>
            </td>

            <td>
                <input type="radio" name="satisfied" class="consent" value="Yes" required>
            </td>

            <td>
                <input type="radio" name="satisfied" class="consent" value="Yes" required>
            </td>
        </tr>
        
        <tr>
            <td colspan="6">
                <span class="text-success">Suggestions/Comments:</span>
                <br />
                <textarea class="form-control" name="suggestions" style="resize: none;width: 100%;" rows="5" required></textarea>
            </td>
        </tr>
    </tbody>
</table>
<span class="text-success">Name of the respondent:(Optional) <input type="text" size="40" name="name_respondent" class="consent form-control"></span>

<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    <button type="submit" class="btn btn-success btn-sm" ><i class="fa fa-sumbit"></i> Submit</button>
</div>