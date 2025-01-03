<?php

namespace App\Http\Controllers\admin;

use App\Models\DiagMain;
use App\Models\Diagnosis;
use App\Models\DiagSubcat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomeCtrl extends Controller
{
    /**
     * Main Category
     */
    public function mainCat(Request $request)
    {
        if ($request->keyword) {
            $keyword = $request->keyword;
            $data = DiagMain::where(function($q) use ($keyword) {
                $q->where('diagcat', "like", "%$keyword%")
                    ->orwhere('catdesc', "like", "%$keyword%");
                })
                ->where('void',0)
                ->orderby('id','asc')
                ->paginate(50);
        } else {
            $data = DiagMain::where('void', 0)
                            ->orderby('id', 'asc')
                            ->paginate(50);
        }

        return view('admin.diagnosis.maincat', [
            'data' => $data
        ]);
    }

    /**
     * Main Category (Body)
     */
    public function maincatBody(Request $request)
    {   
        $data = DiagMain::find($request->maincat_id);
        return view('admin.maincat_body', [
            'data' => $data
        ]);
    }

    /**
     * Save main category
     */
    public function maincatAdd(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if(isset($request->id)){
            DiagMain::find($request->id)->update($data);
            Session::put('maincat_message', 'Successfully updated main category');
        } else {
            DiagMain::create($data);
            Session::put('maincat_message', 'Successfully added main category');
        }

        Session::put('maincat',true);
        return Redirect::back();    
    }

    /**
     * Delete main category
     */
    public function maincatDelete(Request $request)
    {
        DiagMain::where('id', $request->maincat_id)
                ->update([
                    'void' => '1'
                ]);

        Session::put('main_delete_message', 'Deleted Main Category');
        Session::put('main_delete', true);
        return Redirect::back();
    }

    /**
     * Subcategory
     */
    public function subCat(Request $request)
    {
        if ($request->keyword) {
              $keyword = $request->keyword;
              $data = DiagSubcat::where(function($q) use ($keyword){
                  $q->where('diagsubcat',"like","%$keyword%")
                      ->orwhere('diagscatdesc',"like","%$keyword%");
                     
                  })
                  ->where('void',0)
                  ->orderby('id','asc')
                  ->paginate(50);
        } else {
            $data = DiagSubcat::where('void',0)
                ->orderby('id','asc')
                ->paginate(50);
        }

        return view('admin.diagnosis.subcat', [
            'data' => $data
        ]);
    }
    
    /**
     * Subcat body
     */
    public function subcatBody(Request $request)
    {
        $data = DiagSubcat::find($request->subcat_id);

        return view('admin.subcat_body', [
            'data' => $data
        ]);
        
    }

    /**
     * Save subcat
     */
    public function subcatAdd(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if(isset($request->id)){
            DiagSubcat::find($request->id)->update($data);
            Session::put('subcat_message', 'Successfully updated sub category');
        } else {
            DiagSubcat::create($data);
            Session::put('subcat_message', 'Successfully added sub category');
        }

        Session::put('subcat', true);
        return Redirect::back();
    }

    /**
     * Delete subcat
     */
    public function subcatDelete(Request $request)
    {
        DiagSubcat::where('id', $request->subcat_id)
                    ->update([
                        'void' => '1'
                    ]);

        Session::put('sub_delete_message', 'Deleted Sub Category');
        Session::put('sub_delete', true);
        return Redirect::back();
    }

    /**
     * Diagnosis
     */
    public function diag(Request $request)
    {
        if($request->keyword) {
            $keyword = $request->keyword;
            $data = Diagnosis::where(function($q) use ($keyword){
                $q->where('diagcode', "like", "%$keyword%")
                    ->orwhere('diagdesc', "like", "%$keyword%");
                })
                ->where('void', 0)
                ->orderby('id', 'asc')
                ->paginate(50);
        } else {
            $data = Diagnosis::where('void', 0)
                            ->orderby('id', 'asc')
                            ->paginate(50);
        }

        return view('admin.diagnosis.diagnosis', [
            'data' => $data
        ]);
    }

    /**
     * Diagnosis body
     */
    public function diagBody(Request $request)
    {
        $data = Diagnosis::find($request->diag_id);
        return view('admin.diagnosis_body', [
            'data' => $data
        ]);
    }

    /**
     * Save diagnosis
     */
    public function diagnosisAdd(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if(isset($request->id)){
            Diagnosis::find($request->id)->update($data);
            Session::put('diagnosis_message', 'Successfully updated diagnosis');
        } else {
            Diagnosis::create($data);
            Session::put('diagnosis_message', 'Successfully added diagnosis');
        }

        Session::put('diagnosis', true);
        return Redirect::back();
    }

    /**
     * Delete diagnosis
     */
    public function diagnosisDelete(Request $request)
    {
        Diagnosis::where('id', $request->diag_id)
                    ->update([
                        'void' => '1'
                    ]);

        Session::put('diag_delete_message', 'Deleted Diagnosis');
        Session::put('diag_delete', true);
        return Redirect::back();

    }

    /**
     * Get subcategory by main
     */
    static function getMaincat($id)
    {
        $code = DiagSubcat::where('diagmcat', $id)->get();

        if($code) {
            return $code;
        }

        return 'N/A';
    }
}
