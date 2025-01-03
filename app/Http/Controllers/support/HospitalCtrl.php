<?php

namespace App\Http\Controllers\support;

use App\Models\Muncity;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HospitalCtrl extends Controller
{
    /**
     * Landing page
     */
    public function index()
    {
        $user = Auth::user();
        $muncity = Muncity::where('province_id', $user->province)
                    ->orderBy('description', 'asc')->get();
                    
        $info = Facility::find($user->facility_id);
        return view('support.hospital', [
            'title' => 'Hospital Information',
            'muncity' => $muncity,
            'info' => $info
        ]);
    }

    /**
     * Update facility data
     */
    public function update(Request $req)
    {
        $user = Auth::user();
        $data = array(
            'name' => $req->facility_name,
            'license_no' => $req->license_no,
            'abbr' => $req->abbr,
            'muncity' => $req->muncity,
            'brgy' => $req->brgy,
            'address' => $req->address,
            'contact' => $req->contact,
            'email' => $req->email,
            'status' => $req->status
        );
        Facility::where('id', $user->facility_id)->update($data);
        return redirect()->back()->with('status', 'updated');
    }
}
