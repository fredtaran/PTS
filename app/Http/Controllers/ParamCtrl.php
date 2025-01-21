<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tracking;
use App\Models\Affiliated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ParamCtrl extends Controller
{
    static function lastLogin()
    {
        $user = Auth::user();
        $date = date('Y-m-d H:i:s');
        User::where('id', $user->id)
            ->update([
                'last_login' => $date
            ]);
    }

    static function getAge($date)
    {
        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = date('m/d/Y',strtotime($date));

        //explode the date to get month, day and year
        $birthDate = explode("/", $birthDate);

        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
            
        return $age;
    }

    /**
     * Return to admin
     */
    public function returnToAdmin()
    {
        Session::forget('admin');
        $user = Auth::user();
        $user = User::find($user->id);
        Session::put('auth', $user);
        return redirect($user->level);
    }

    /**
     * Get doctor list
     */
    function getDoctorList($facility_id, $department_id)
    {
        $user1 = Affiliated::select('users.id', 'users.fname', 'users.mname', 'users.lname', 'users.contact')
            ->leftJoin('users', 'affiliated.user_id', '=', 'users.id')
            ->where('affiliated.facility_id', $facility_id)
            ->where('users.department_id', $department_id)
            ->where('users.level', 'doctor');

        $result = User::select('id', 'fname', 'mname', 'lname', 'contact')
            ->where('facility_id', $facility_id)
            ->where('department_id', $department_id)
            ->where('level', 'doctor')
            ->union($user1)
            ->get();
            
        return $result;
    }

    /**
     * Verify tracking code
     */
    public function verifyCode($code)
    {
        $user = Auth::user();
        if($user->level == 'admin') {
            return 1;
        }
        
        $tracking = Tracking::where('code', $code)->first();

        if($tracking) {
            if($tracking->referred_to == $user->facility_id) {
                return 1;
            }
            return 0;
        }
        return 0;
    }
}
