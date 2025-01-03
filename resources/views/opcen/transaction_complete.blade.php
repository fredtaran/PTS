<style>
    input[type=radio] {
        width: 20%;
        height: 2em;
    }
</style>
<table class="table table-hover table-bordered">
    <tr>
        <td >
            <small>Concerns Addressed</small>
            <input type="radio" value="concern_address" name="transaction_complete" <?php if(Session::get("client")->transaction_complete == 'concern_address') echo 'checked'; ?>>
        </td>
        <td >
            <small>Need Provided</small>
            <input type="radio" value="need_provide" name="transaction_complete" <?php if(Session::get("client")->transaction_complete == 'need_provide') echo 'checked'; ?>>
        </td>
        <td >
            <small>Completed Call</small>
            <input type="radio" value="complete_call" name="transaction_complete" <?php if(Session::get("client")->transaction_complete == 'complete_call') echo 'checked'; ?>>
        </td>
    </tr>
</table>