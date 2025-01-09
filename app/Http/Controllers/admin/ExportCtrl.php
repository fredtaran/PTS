<?php

namespace App\Http\Controllers\admin;

use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\admin\DailyCtrl;
use Maatwebsite\Excel\Facades\Excel;

class ExportCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Export daily users
     */
    public function dailyUsers()
    {
        $user = Auth::user();

        $date = Session::get('dateDailyUsers');
        if(!$date) { 
            $date = date('Y-m-d');
        }

        $facilities = Facility::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        $data[] = array('Monitoring Tool for Northern Mindanao Pregnancy Tracking and Referral System');
        $data[] = array('Form 1');
        $data[] = array('DAILY REPORT FOR AVAILABLE USERS');
        $data[] = array('');
        $data[] = array('Date: ' . date('F d, Y', strtotime($date)));
        $data[] = array('');
        $data[] = array('Name of Hospital', 'Health Professional', '', '', 'Subtotal', 'IT', '', 'Subtotal', 'TOTAL');
        $data[] = array('', 'On Duty', 'Off Duty', 'Offline', '', 'Online', 'Offline', '');

        foreach($facilities as $row)
        {
            $log = DailyCtrl::countDailyUsers($row->id);
            $offline = $log['total'] - ($log['on'] + $log['off']);
            $it_offline = $log['it_total'] - $log['it_on'];

            $data[] = array(
                'users' => $row->name,
                'on' => $log['on'],
                'off' => $log['off'],
                'offline' => $offline,
                'h_total' => $log['total'],
                'it_on' => $log['it_on'],
                'it_offline' => $it_offline,
                'it_total' => $log['it_total'],
                'total' => $log['total'] + $log['it_total']
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
                $totalCell = count($this->data) + 1;

                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->mergeCells('A3:I3');
                $sheet->mergeCells('A4:I4');
                $sheet->mergeCells('A5:I5');
                $sheet->mergeCells('A6:I6');

                $sheet->mergeCells('A7:A8');
                $sheet->mergeCells('B7:D7');
                $sheet->mergeCells('E7:E8');
                $sheet->mergeCells('F7:G7');
                $sheet->mergeCells('H7:H8');
                $sheet->mergeCells('I7:I8');

                $sheet->getColumnDimension('A')->setWidth(40);
                $sheet->getColumnDimension('I')->setWidth(15);

                $sheet->getStyle("A7:I$totalCell")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $sheet->getStyle("A1:I4")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("A7:I8")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Set headers to center
                $sheet->getStyle("A7:I8")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set headers to center
                $sheet->getStyle("B9:I$totalCell")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("B8:I9")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('A1:I8')->getFont()->setBold(true);
            }
        }, "Daily_Users.xlsx");
    }

    /**
     * Daily referral
     */
    public function dailyReferral()
    {
        $user = Auth::user();

        $date = Session::get('dateReportReferral');
        if(!$date) {
            $date = date('Y-m-d');
        }

        $users = Facility::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        $data[] = array('Monitoring Tool for Central Visayas Electronic Health Referral System');
        $data[] = array('Form 2');
        $data[] = array('DAILY REPORT FOR REFERRALS');
        $data[] = array('');
        $data[] = array('Date: '. date('F d, Y',strtotime($date)));
        $data[] = array('');
        $data[] = array('Name of Hospital','Number of Referrals To','','','','TOTAL','Number of Referrals From','','','TOTAL');
        $data[] = array('','Accepted','Redirected','Seen','Unseen','','Accepted','Redirected','Seen');

        foreach($users as $row)
        {
            $referral = DailyCtrl::countOutgoingReferral($row->id);
            $incoming = DailyCtrl::countIncommingReferral($row->id);
            $data[] = array(
                'users' => $row->name,
                'accepted' => $referral['accepted'],
                'redirected' => $referral['redirected'],
                'seen' => $referral['seen'],
                'unseen' => $referral['unseen'],
                'total' => $referral['total'],
                'i_accepted' => $incoming['accepted'],
                'i_redirected' => $incoming['redirected'],
                'i_seen' => $incoming['seen'],
                'i_total' => $incoming['total']
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
                $totalCell = count($this->data) + 1;

                $sheet->mergeCells('A1:J1');
                $sheet->mergeCells('A2:J2');
                $sheet->mergeCells('A3:J3');
                $sheet->mergeCells('A4:J4');
                $sheet->mergeCells('A5:J5');
                $sheet->mergeCells('A6:J6');
                $sheet->mergeCells('A7:A8');
                $sheet->mergeCells('B7:E7');
                $sheet->mergeCells('F7:F8');
                $sheet->mergeCells('G7:I7');
                $sheet->mergeCells('J7:J8');

                $sheet->getColumnDimension('A')->setWidth(40);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(20);
                $sheet->getColumnDimension('J')->setWidth(15);

                $sheet->getStyle("A7:J$totalCell")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $sheet->getStyle("A1:J4")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("A7:J8")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Set headers to center
                $sheet->getStyle("A7:J8")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set headers to center
                $sheet->getStyle("B10:J$totalCell")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("B9:J10")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('A1:J8')->getFont()->setBold(true);
            }
        }, "Daily_Referral.xlsx");
    }
}
