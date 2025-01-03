<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Muncity;
use App\Models\Barangay;
use App\Models\Facility;
use Illuminate\Http\Request;

class LocationCtrl extends Controller
{
    /**
     * Get municipalities
     */
    function getMuncity($province_id)
    {
        $muncity = Muncity::where('province_id', $province_id)
            ->where(function($q) {
                $q->where("vaccine_used","!=","Yes")
                    ->orWhereNull("vaccine_used");
            })
            ->orderBy('description','asc')
            ->get();
        return $muncity;
    }

    /**
     * Get barangays
     */
    function getBarangay($muncity_id)
    {
        $brgy = Barangay::where('muncity_id', $muncity_id)
                        ->orderBy('description','asc')
                        ->get();
        return $brgy;
    }

    /**
     * Get barangays
     */
    function getBarangay1($province_id, $muncity_id)
    {
        $brgy = Barangay::where("province_id", $province_id)
                        ->where("muncity_id", $muncity_id)
                        ->orderBy('description','asc')
                        ->get();
        return $brgy;
    }

    /**
     * Get facility address
     */
    static function facilityAddress($facility_id)
    {
        $data['address'] = 'N/A';
        $data['departments'] = array();

        $facility = Facility::select(
                'barangay.description as brgy',
                'muncity.description as muncity',
                'province.description as province',
                'facility.address'
            )
            ->leftJoin('barangay','barangay.id','=','facility.brgy')
            ->leftJoin('muncity','muncity.id','=','facility.muncity')
            ->leftJoin('province','province.id','=','facility.province')
            ->where('facility.id',$facility_id)
            ->first();

        $address = '';
        if(!$facility){
            return $data;
        }

        $address .= ($facility->address) ? $facility->address.', ':null;
        $address .= ($facility->brgy) ? $facility->brgy.', ':null;
        $address .= ($facility->muncity) ? $facility->muncity.', ':null;
        $address .= ($facility->province) ? $facility->province:null;

        $data['address'] = $address;
        $data['facility_id'] = $facility_id;

        $data['departments'] = User::select('department.id', 'department.description')
                ->leftJoin('department', 'department.id', '=', 'users.department_id')
                ->where('users.department_id', '!=', 0)
                ->where('users.facility_id', $facility_id)
                ->groupBy('users.department_id', 'department.id', 'department.description')
                ->get();

        return $data;
    }
}
