<?php

namespace App\Http\Controllers\admin;

use App\Models\Filetypes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class FiletypeCtrl extends Controller
{
    /**
     * Filetype Dashboard
     */
    public function index()
    {
        $data = Filetypes::orderBy('id','asc')->paginate(20);

        return view('admin.filetypes', [
            'data' => $data
        ]);
    }

    /**
     * Add filetype body
     */
    public function filetypesBody(Request $req)
    {

        $data = Filetypes::find($req->id);

        return view('admin.filetypes_body', [
            'data' => $data
        ]);
    }

    /**
     * Save filetype
     */
    public function filetypeOptions(Request $req)
    {
        Filetypes::updateOrCreate(
            [
                'id' => $req->id
            ], 
            [
            'description' => $req->description
            ]
        );

        Session::put("types_message", "File types successfully added");
        Session::put("types", true);

        return Redirect::back();
    }

    /**
     * Delete filetype
     */
    public function delete(Request $req)
    {
        $filetype = Filetypes::find($req->filetype_id);

        if ($filetype) {
            $filetype->delete();
        }

        Session::put("types_message", "File type successfully removed");
        Session::put("types", true);

        return Redirect::back();
    }
}
