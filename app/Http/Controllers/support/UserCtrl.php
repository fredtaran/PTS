<?php

namespace App\Http\Controllers\support;

use App\Models\User;
use App\Models\Facility;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserCtrl extends Controller
{
    /**
     * Landing page
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->search;

        $data = User::where('facility_id', $user->facility_id)
            ->where(function($q) use($search) {
                $q->where("users.level", "doctor")
                    ->orWhere("users.level", "midwife")
                    ->orWhere("users.level", "nurse");
            })
            ->where(function($q) use($search) {
                $q->where('fname', 'like', "%$search%")
                ->orwhere('mname', 'like', "%$search%")
                ->orwhere('lname', 'like', "%$search%")
                ->orwhere('username', 'like', "%$search%")
                ->orwhere(DB::raw('concat(fname, " ", lname)'), 'like', "$search")
                ->orwhere(DB::raw('concat(lname, " ", fname)'), 'like', "$search");
            });

        if($request->department_id)
            $data = $data->where("department_id", $request->department_id == 'no_department' ? 0 : $request->department_id);

        $data = $data
            ->orderBy('fname', 'asc')
            ->paginate(15);

        $departments = Department::get();
        $group_by_department = User::
            select(
                    DB::raw("count(users.id) as y"),
                    DB::raw("coalesce(department.description, 'NO DEPARTMENT') as label"),
                    DB::raw("coalesce(department.id, 'no_id') as department_id")
                )
                ->leftJoin("department", "department.id", "=", "users.department_id")
                ->where("users.facility_id", $user->facility_id)
                ->where(function($q) use($search) {
                    $q->where("users.level", "doctor")
                    ->orWhere("users.level", "midwife");
                })
                ->groupBy("users.department_id", "department.description", "department.id")
                ->get();

        return view('support.users', [
            'title' => 'Manage Users',
            'data' => $data,
            'departments' => $departments,
            'search' => $search,
            "group_by_department" => $group_by_department
        ]);
    }

    /**
     * Check username if existing
     */
    public function check($string)
    {
        $user = Auth::user();
        $check = User::where('username', $string)
                ->where('id', '!=', $user->id)
                ->first();

        if($check) {
            return '1';
        }

        return '0';
    }

    /**
     * Store user to database
     */
    public function store(Request $req)
    {
        $user = Auth::user();
        $match = array(
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname
        );

        $facility = Facility::find($req->facility_id);

        $data = array(
            'level' => $req->level,
            'facility_id' => $user->facility_id,
            'status' => 'active',
            'contact' => $req->contact,
            'email' => $req->email,
            'designation' => $req->designation,
            'department_id' => $req->department_id,
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'muncity' => $facility->muncity,
            'province' => $facility->province
        );
        User::updateOrCreate($match, $data);
        return 'added';
    }

    /**
     * Get user info
     */
    public function info($user_id)
    {
        return User::find($user_id);
    }
    
    /**
     * Check username for update
     */
    public function checkUpdate($string, $user_id)
    {
        $user = Auth::user();
        $check = User::where('username', $string)
                ->where('id', '!=', $user->id)
                ->where('id', '!=', $user_id)
                ->first();

        if($check) {
            return '1';
        }

        return '0';
    }

    /**
     * Update user
     */
    public function update(Request $req)
    {
        $user = Auth::user();
        $facility = Facility::find($user->facility_id);
        $data = array(
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
            'level' => $req->level,
            'contact' => $req->contact,
            'email' => ($req->email) ? $req->email: 'N/A',
            'designation' => $req->designation,
            'department_id' => $req->department_id,
            'username' => $req->username,
            'status' => $req->status,
            'muncity' => $facility->muncity,
            'province' => $facility->province
        );

        if ($req->password) {
            $data['password'] = bcrypt($req->password);
        }


        User::where('id',$req->user_id)->update($data);
        return 'updated';
    }
}
