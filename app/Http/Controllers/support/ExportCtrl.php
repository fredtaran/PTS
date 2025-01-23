<?php

namespace App\Http\Controllers\support;

use App\Models\User;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\support\ReportCtrl;

class ExportCtrl extends Controller
{
    /**
     * Export daily user
     */
    static function dailyUsers()
    {
        $user = Auth::user();

        $date = Session::get('dateReportUsers');
        if(!$date) {
            $date = date('Y-m-d');
        }

        $users = User::where('facility_id', $user->facility_id)
            ->where('level', 'doctor')
            ->orderBy('lname', 'asc')
            ->get();
        $data[] = array('Monitoring Tool for Central Visayas Electronic Health Referral System');
        $data[] = array('Form 1');
        $data[] = array('DAILY REPORT FOR AVAILABLE USERS');
        $data[] = array('');
        $data[] = array('Name of Hospital: ' . Facility::find($user->facility_id)->name);
        $data[] = array('Date: '. date('F d, Y',strtotime($date)));
        $data[] = array('');
        $data[] = array('Name of User','On Duty','Off Duty','Login','Logout','Remarks');

        foreach($users as $row)
        {
            $log = ReportCtrl::getLoginLog($row->id); //&#10004;
            $loginStatus = '';
            $logoutStatus = '';
            $login = '';
            $logout = '';

            if($log->status == 'login') {
                $loginStatus = '✓';
            }

            if($log->status == 'login_off') {
                $logoutStatus = '✓';
            }

            if($log->login) {
                $login = date('h:i A', strtotime($log->login));
            }

            if($log->logout) {
                $logout = date('h:i A', strtotime($log->logout));
            }

            $data[] = array(
                'users' => $row->lname . ', ' . $row->fname,
                'loginStatus' => $loginStatus,
                'logoutStatus' => $logoutStatus,
                'login' => $login,
                'logout' => $logout
            );
        }

        return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithStyles {
            private $data;

            public function __construct(array $data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                return $this->data;
            }

            public function headings(): array
            {
                return [];
            }

            public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
            {
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(10);
                $sheet->getColumnDimension('C')->setWidth(10);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(15);

                $totalCell = count($this->data) + 9;

                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');
                $sheet->mergeCells('A4:F4');
                $sheet->mergeCells('A5:F5');
                $sheet->mergeCells('A6:F6');
                $sheet->mergeCells('A7:F7');

                $sheet->getStyle("A8:F$totalCell")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $sheet->getStyle("A1:F4")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("A8:F8")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("B9:F$totalCell")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('A1:A7')->getFont()->setBold(true);
                $sheet->getStyle('A8:F8')->getFont()->setBold(true);
            }
        }, "DailyUsers.xlsx");
    }
}
