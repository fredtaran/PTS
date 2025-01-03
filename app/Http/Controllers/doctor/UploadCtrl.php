<?php

namespace App\Http\Controllers\doctor;

use App\Models\Uploads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UploadCtrl extends Controller
{
    /**
     * Upload Body
     */
    public function uploadBody(Request $req)
    {
        $code = $req->code;
        $data = Uploads::select("uploads.*",
            "filetypes.description as file_type",
            "users.fname",
            "users.mname",
            "users.lname"
        )->leftjoin("filetypes","filetypes.id","=","uploads.type_id")
        ->leftjoin("users","users.id","=","uploads.uploaded_by")
        ->where('uploads.referral_code',$code)
        ->get();
        
        return view('doctor.upload_body',[
            'code' => $code,
            'data' => $data
        ]);
    }

    /**
     * Upload file
     */
    public function uploadFile(Request $req)
    {
        Session::put('unique_referral_code', $req->refer_code);
        $user = Auth::user();
        $refer_code = $req->refer_code;

        $folder = public_path() . "/uploads/$refer_code";

        // dd(file_exists($folder));
        if(!file_exists($folder)) {
            $folder = File::makeDirectory(public_path() . "/uploads/$refer_code", 0777, true);

            foreach ($req->file as $num => $file) {   
                $validator = Validator::make($req->all(), [
                    'file.*' => 'required|mimetypes:application/pdf|max:5000'
                ]);

                if($validator->fails()) {
                    Session::put('validated', true);
                    return Redirect::back();
                }
                
                $filename = $file->getClientOriginalName();
                $file->move(base_path('public/uploads/' . $refer_code), $filename);

                $data = array(
                    'name' => $filename,
                    'path' => "app/uploads/" . $refer_code,
                    'uploaded_date' => date('Y-m-d H:i:s'),
                    'uploaded_by' => $user->id,
                    'type_id' => $req->file_type[$num],
                    'referral_code' => $refer_code
                );

                Uploads::create($data);
                Session::put('upload_file', true);
                Session::put('upload_file_message', 'File Uploaded Successfully!');
            }

            return Redirect::back();
        } else {
            foreach ($req->file as $num => $file) {   
                $validator = Validator::make($req->all(), [
                    'file.*' => 'required|mimetypes:application/pdf|max:5000'
                ]);

                if($validator->fails()) {
                    Session::put('validated', true);
                    return Redirect::back();
                }
                
                $filename = $file->getClientOriginalName();
                $file->move(base_path('public/uploads/' . $refer_code), $filename);

                $data = array(
                    'name' => $filename,
                    'path' => "app/uploads/" . $refer_code,
                    'uploaded_date' => date('Y-m-d H:i:s'),
                    'uploaded_by' => $user->id,
                    'type_id' => $req->file_type[$num],
                    'referral_code' => $refer_code
                );

                Uploads::create($data);
                Session::put('upload_file', true);
                Session::put('upload_file_message', 'File Uploaded Successfully!');
            }

            return Redirect::back();
        }
    }

    /**
     * View file
     */
    public function fileView($id)
    {
       $data = Uploads::find($id);

       return view('doctor.viewfile',[
           'data' => $data
       ]);
    }

    /**
     * Delete file
     */
    public function fileDelete($id)
    {
        $data = Uploads::find($id)->delete();
        Session::put('upload_file',true);
        Session::put('upload_file_message','File Deleted Successfully!');

        return Redirect::back();
    }
}
