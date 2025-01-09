<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcelCtrl extends Controller
{
    /**
     * Export excel incoming
     */
    public function ExportExcelIncoming()
    {
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=incoming.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $title = 'Incoming Report';
        $table_body = "";
        foreach(Session::get('data') as $row) {
            $table_body .= "<tr>
                <td>" . $row->name . "</td>
                <td>$row->count_incoming</td>
                <td>" . Session::get('accepted_incoming')[$row->id] . "</td>
                <td>" . Session::get('seenzoned_incoming')[$row->id] . "</td>
                <td>" . Session::get('common_source_incoming')[$row->id] . "</td>
                <td>" . Session::get('referring_doctor_incoming')[$row->id] . "</td>
                <td>" . Session::get('turnaround_time_accept_incoming')[$row->id] . "</td>
                <td>" . Session::get('turnaround_time_arrived_incoming')[$row->id] . "</td>
                <td>" . Session::get('diagnosis_ref_incoming')[$row->id] . "</td>
                <td>" . Session::get('reason_ref_incoming')[$row->id] . "</td>
                <td>Under development this column</td>
                <td>Under development this column</td>
                <td>" . Session::get('transport_ref_incoming')[$row->id] . "</td>
                <td>" . Session::get('department_ref_incoming')[$row->id] . "</td>
                <td>" . Session::get('issue_ref_incoming')[$row->id]."</td>
            </tr>";
        }

        $display =
            '
                <h1>' . $title . '</h1>
                <table cellspacing="1" cellpadding="5" border="1">
                <tr>
                    <td style="background-color:lightgreen">Name of Facility</td>
                    <td style="background-color:lightgreen">Total Incoming  Referrals</td>
                    <td style="background-color:lightgreen">Total Accepted Referrals</td>
                    <td style="background-color:lightgreen">Total Viewed Only Referrals</td>
                    <td style="background-color:lightgreen">Common Sources(Facility)</td>
                    <td style="background-color:lightgreen">Common Referring Doctor HCW/MD (Top 10)</td>
                    <td style="background-color:lightgreen">Average Referral Acceptance Turnaround time</td>
                    <td style="background-color:lightgreen">Average Referral Arrival Turnaround Time</td>
                    <td style="background-color:lightgreen">Diagnoses (Top 10)</td>
                    <td style="background-color:lightgreen">Reasons (Top 10)</td>
                    <td style="background-color:lightgreen">Number of Horizontal referrals</td>
                    <td style="background-color:lightgreen">Number of Vertical Referrals</td>
                    <td style="background-color:lightgreen">Common Methods of Transportation</td>
                    <td style="background-color:lightgreen">Department</td>
                    <td style="background-color:lightgreen">Remarks</td>
                </tr>'
                . $table_body .
            '</table>';

        return $display;

        /*return Excel::download(new QueryExport, 'export.xlsx');*/
    }

    public function importExcel(Request $request) {
        if($request->isMethod('post')) {
            $import = new ExcelImport();
            Excel::import($import, request()->file('import_file'));
            foreach($import->data as $row) {
                if(
                    !(
                        $row[0] == "code" &&
                        $row[1] == "description" &&
                        $row[2] == "group" &&
                        $row[3] == "case_rate" &&
                        $row[4] == "professional_fee" &&
                        $row[5] == "health_care_fee" &&
                        $row[6] == "source"
                    )
                ) {
                    if(!Icd10::where("code", $row[0])->first()) {
                        Icd10::create([
                            "code" => $row[0],
                            "description" => $row[1],
                            "group" => $row[2],
                            "case_rate" => $row[3],
                            "professional_fee" => $row[4],
                            "health_care_fee" => $row[5],
                            "source" => $row[6]
                        ]);
                    }
                }
            }

            return back()->with('success', 'Successfully import!');
        }

        return view('admin.excel.import_excel');
    }
}
