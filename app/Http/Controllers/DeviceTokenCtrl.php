<?php

namespace App\Http\Controllers;

use Kawankoding\Fcm\Fcm;
use App\Models\Devicetoken;
use Illuminate\Http\Request;

class DeviceTokenCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Send function
     */
    static function send($title, $body, $facility_id)
    {
        $list = Devicetoken::where('facility_id', $facility_id)->get();

        if(count($list) == 0)
            exit();

        $devices = array();
        foreach($list as $row) {
            $devices[] = $row->token;
        }

        Fcm()
            ->to($devices)
            ->data([
                'title' => $title,
                'body' => $body,
                'icon' => url('img/DOHCHDNM.png')
            ])
            ->send();
    }
}
