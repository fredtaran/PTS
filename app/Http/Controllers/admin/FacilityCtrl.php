<?php

namespace App\Http\Controllers\admin;

use App\Models\Muncity;
use App\Models\Barangay;
use App\Models\Facility;
use App\Models\Incident;
use App\Models\Incident_type;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class FacilityCtrl extends Controller
{
    /**
     * Index - Facility List
     */
    public function index(Request $request)
    {
        if($request->view_all == 'view_all') {
            $keyword = '';
        } else {
            if(Session::get("keyword")) {
                if(!empty($request->keyword) && Session::get("keyword") != $request->keyword)
                    $keyword = $request->keyword;
                else
                    $keyword = Session::get("keyword");
            } else {
                $keyword = $request->keyword;
            }
        }

        Session::put('keyword',$keyword);

        $data = Facility::select(
            "facility.id",
            'facility.facility_code',
            "facility.name",
            "facility.address",
            "prov.description as province",
            "mun.description as muncity",
            "bar.description as barangay",
            "facility.contact",
            "facility.email",
            "facility.chief_hospital",
            "facility.level",
            "facility.hospital_type",
            "facility.status",
            "facility.referral_used"
        )->leftJoin("province as prov", "prov.id", "=", "facility.province")
        ->leftJoin("muncity as mun", "mun.id", "=", "facility.muncity")
        ->leftJoin("barangay as bar", "bar.id", "=", "facility.brgy");

        $data = $data->where('facility.name', "like", "%$keyword%");

        $data = $data->orderBy('name', 'asc')->paginate(20);

        return view('admin.facility', [
            'title' => 'List of Facility',
            'data' => $data
        ]);
    }
    
    /**
     * Facility Body (Add)
     */
    public function facilityBody(Request $request){
        $data = Facility::find($request->facility_id);
        return view('admin.facility_body', [
            "data" => $data
        ]);
    }

    /**
     * Save Facility
     */
    public function facilityAdd(Request $request){
        $data = $request->all();
        unset($data['_token']);

        if(isset($request->id)){
            Facility::find($request->id)->update($data);
            Session::put('facility_message', 'Successfully updated facility');
        } else {
            Facility::create($data);
            Session::put('facility_message', 'Successfully added facility');
        }

        Session::put('facility', true);
        return Redirect::back();
    }

    /**
     * Delete facility
     */
    public function facilityDelete(Request $request){
        Facility::find($request->facility_id)->delete();
        Session::put('facility_message', 'Deleted facility');
        Session::put('facility', true);
        return Redirect::back();
    }

    /**
     * Provinces
     */
    public function provinceView(Request $request)
    {
        if ($request->view_all == 'view_all') {
            $keyword = '';
        } else {
            if(Session::get("keyword")){
                if(!empty($request->keyword) && Session::get("keyword") != $request->keyword)
                    $keyword = $request->keyword;
                else
                    $keyword = Session::get("keyword");
            } else {
                $keyword = $request->keyword;
            }
        }

        Session::put('keyword',$keyword);

        $data = Province::where('description', "like", "%$keyword%")
            ->orderBy("description","asc")
            ->paginate(20);

        return view('admin.province.province', [
            'title' => 'List of Province',
            'data' => $data
        ]);
    }

    /**
     * Add Province (Body)
     */
    public function provinceBody(Request $request){
        $data = Province::find($request->province_id);
        return view('admin.province.province_body', [
            "data" => $data
        ]);
    }

    /**
     * Save new province
     */
    public function provinceAdd(Request $request){
        $data = $request->all();
        unset($data['_token']);

        if(isset($request->id)){
            Province::find($request->id)->update($data);
            Session::put('province_message', 'Successfully updated province');
        } else {
            Province::create($data);
            Session::put('province_message', 'Successfully added province');
        }

        Session::put('province',true);
        return Redirect::back();
    }

    /**
     * Delete province
     */
    public function provinceDelete(Request $request){
        Province::find($request->province_id)->delete();
        Session::put('province_message', 'Deleted province');
        Session::put('province', true);
        return Redirect::back();
    }

    /**
     * Municipalities/Cities
     */
    public function municipalityView(Request $request,$province_id){
        if($request->view_all == 'view_all') {
            $keyword = '';
        } else {
            if(Session::get("keyword_muncity")){
                if(!empty($request->keyword_muncity) && Session::get("keyword_muncity") != $request->keyword_muncity)
                    $keyword = $request->keyword_muncity;
                else
                    $keyword = Session::get("keyword_muncity");
            } else {
                $keyword = $request->keyword_muncity;
            }
        }

        Session::put('keyword_muncity', $keyword);

        $data = Muncity::where('description', "like", "%$keyword%")
            ->where("province_id", $province_id)
            ->orderBy("description", "asc")
            ->paginate(20);

        return view('admin.municipality.municipality', [
            'title' => 'List of Municipalities/Cities',
            'province_name' => Province::find($province_id)->description,
            'province_id' => $province_id,
            'data' => $data
        ]);
    }

    /**
     * Add Municipalities/Cities (Body)
     */
    public function municipalityBody(Request $request){
        $muncity = Muncity::where("id", $request->muncity_id)
                        ->where("province_id", $request->province_id)
                        ->first();

        $province = Province::find($request->province_id);
        return view('admin.municipality.municipality_body', [
            "muncity" => $muncity,
            "province_name" => $province->description,
            "province_id" => $request->province_id
        ]);
    }

    /**
     * Save municipality/city
     */
    public function municipalityAdd(Request $request){
        $data = $request->all();
        unset($data['_token']);

        if(isset($request->id)) {
            Muncity::find($request->id)->update($data);
            Session::put('municipality_message', 'Successfully updated municipality');
        } else {
            Muncity::create($data);
            Session::put('municipality_message', 'Successfully added municipality');
        }

        Session::put('municipality', true);
        return Redirect::back();
    }

    /**
     * Delete municipality/city
     */
    public function municipalityDelete(Request $request){
        Muncity::find($request->muncity_id)->delete();
        Session::put('municipality_message', 'Deleted municipality');
        Session::put('municipality', true);
        return Redirect::back();
    }

    /**
     * Barangay View
     */
    public function barangayView(Request $request, $province_id, $muncity_id){
        if($request->view_all == 'view_all') {
            $keyword = '';
        } else {
            if(Session::get("keyword_barangay")){
                if(!empty($request->keyword_barangay) && Session::get("keyword_barangay") != $request->keyword_barangay)
                    $keyword = $request->keyword_barangay;
                else
                    $keyword = Session::get("keyword_barangay");
            } else {
                $keyword = $request->keyword_barangay;
            }
        }

        Session::put('keyword_barangay', $keyword);

        $data = Barangay::where('description', "like", "%$keyword%")
            ->where("province_id", $province_id)
            ->where("muncity_id", $muncity_id)
            ->orderBy("description", "asc")
            ->paginate(20);

        return view('admin.barangay.barangay',[
            'title' => 'List of Barangay',
            'province_name' => Province::find($province_id)->description,
            'province_id' => $province_id,
            'muncity_name' => Muncity::find($muncity_id)->description,
            'muncity_id' => $muncity_id,
            'data' => $data
        ]);
    }

    /**
     * Add barangay (body)
     */
    public function barangayBody(Request $request){
        $province = Province::find($request->province_id);
        $muncity = Muncity::where("id", $request->muncity_id)
                            ->where("province_id", $request->province_id)
                            ->first();

        $barangay = Barangay::find($request->barangay_id);

        return view('admin.barangay.barangay_body', [
            "barangay" => $barangay,
            "muncity" => $muncity,
            "province_name" => $province->description,
            "province_id" => $request->province_id
        ]);
    }

    /**
     * Save barangay
     */
    public function barangayAdd(Request $request){
        $data = $request->all();
        unset($data['_token']);

        if (isset($request->id)) {
            Barangay::find($request->id)->update($data);
            Session::put('barangay_message', 'Successfully updated barangay');
        } else {
            Barangay::create($data);
            Session::put('barangay_message', 'Successfully added barangay');
        }

        Session::put('barangay', true);
        return Redirect::back();
    }

    /**
     * Delete barangay
     */
    public function barangayDelete(Request $request){
        Barangay::find($request->barangay_id)->delete();
        Session::put('barangay_message', 'Deleted barangay');
        Session::put('barangay', true);
        return Redirect::back();
    }

    /**
     * Incident type
     */
    public function incidentTab(Request $request){
        
        $data = Incident_type::all();

        return view('admin.incident.incident', [
            'data' => $data,
            'title' => 'List of Incident Types'
        ]);
    }

    /**
     * Incident body
     */
    public function IncidentBody(Request $req)
    {
      $data = Incident_type::find($req->inci_id);
        
        return view('admin.incident_body', [
            'data' =>  $data
        ]);
    }

    /**
     * Incident Add
     */
    public function incidentAdd(Request $req)
    {
        $data = $req->all();

        if(isset($req->id)) {
            Incident_type::find($req->id)->update($data);
        } else {
            Incident_type::create($data);
        }

        return Redirect::back();
    }

    /**
     * Incident
     */
    public function Incident(Request $req)
    {
        $data = Incident::find($req->inci_id);
        $referred_from = $req->referred_from;

        return view('doctor.inci_body', [
            'data' => $data,
            'referred_from' => $referred_from
        ]);
    }
}
