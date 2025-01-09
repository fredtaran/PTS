<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Authentication Routes
 */
Route::get('login', [App\Http\Controllers\LoginCtrl::class, 'index'])->name('login')->middleware(['guest']);
Route::post('login', [App\Http\Controllers\LoginCtrl::class, 'validateLogin'])->middleware(['guest']);
Route::post('reset/password', [App\Http\Controllers\LoginCtrl::class, 'resetPassword'])->middleware(['auth']);
Route::get('logout', function(){
    $user = Illuminate\Support\Facades\Session::get('auth');
    Illuminate\Support\Facades\Session::flush();

    if(isset($user)){
        App\Models\User::where('id',$user->id)
            ->update([
                'login_status' => 'logout'
            ]);
        $logout = date('Y-m-d H:i:s');
        $logoutId = App\Models\Login::where('userId',$user->id)
            ->orderBy('id','desc')
            ->first()
            ->id;

        App\Models\Login::where('id',$logoutId)
            ->update([
                'status' => 'login_off',
                'logout' => $logout
            ]);
    }
    
    return redirect('login');
});

/**
 * Authenticated controller route
 */
Route::middleware(['auth'])->group(function() {
    /**
     * Set logout time
     */
    Route::post('/logout/set', [App\Http\Controllers\doctor\UserCtrl::class, 'setLogoutTime']);

    /**
     * HomeCtrl Routes
     */
    Route::get('/', [App\Http\Controllers\HomeCtrl::class, 'index']);

    /**
     * Doctor\UserCtrl
     */
    Route::get('doctor/list', [App\Http\Controllers\doctor\UserCtrl::class, 'index']);
    Route::post('doctor/list','doctor\UserCtrl@searchDoctor');
    
    /**
     * Doctor\HomeCtrl
     */
    Route::get('/admin', [App\Http\Controllers\doctor\HomeCtrl::class, 'index']);

    /**
     * Doctor pages
     */
    Route::get('doctor', [App\Http\Controllers\doctor\HomeCtrl::class, 'index']);

    /**
     * Doctor\PatientCtrl
     */
    Route::get('doctor/patient', [App\Http\Controllers\doctor\PatientCtrl::class, 'index']);
    Route::post('doctor/patient', [App\Http\Controllers\doctor\PatientCtrl::class, 'searchProfile']);
    Route::post('doctor/patient/store', [App\Http\Controllers\doctor\PatientCtrl::class, 'storePatient']);
    Route::post('doctor/patient/update', [App\Http\Controllers\doctor\PatientCtrl::class, 'updatePatient']);
    Route::get('doctor/patient/add', [App\Http\Controllers\doctor\PatientCtrl::class, 'addPatient']);
    Route::get('doctor/patient/info/{id}', [App\Http\Controllers\doctor\PatientCtrl::class, 'showPatientProfile']);
    Route::get('doctor/accepted', [App\Http\Controllers\doctor\PatientCtrl::class, 'accepted']);
    Route::post('doctor/accepted', [App\Http\Controllers\doctor\PatientCtrl::class, 'searchAccepted']);

    // Doctor discharge
    Route::get('doctor/discharge', [App\Http\Controllers\doctor\PatientCtrl::class, 'discharge']);
    Route::post('doctor/discharge', [App\Http\Controllers\doctor\PatientCtrl::class, 'searchDischarged']);

    // Doctor transfered
    Route::get('doctor/transferred', [App\Http\Controllers\doctor\PatientCtrl::class, 'transferred']);
    Route::post('doctor/transferred', [App\Http\Controllers\doctor\PatientCtrl::class, 'searchTransferred']);

    // Cancelled patient transfer
    Route::get('doctor/cancelled', [App\Http\Controllers\doctor\PatientCtrl::class, 'cancel']);
    Route::post('doctor/cancelled', [App\Http\Controllers\doctor\PatientCtrl::class, 'searchCancelled']);

    // Archieved patients
    Route::get('doctor/archived', [App\Http\Controllers\doctor\PatientCtrl::class, 'archived']);
    Route::post('doctor/archived', [App\Http\Controllers\doctor\PatientCtrl::class, 'searchArchived']);

    //walkin
    Route::match(['GET','POST'],'patient/walkin', [App\Http\Controllers\doctor\PatientCtrl::class, 'walkinPatient']);

    /**
     * Admin\UserCtrl
     */
    Route::get('admin/users', [App\Http\Controllers\admin\UserCtrl::class, 'index']);
    Route::get('admin/users/info/{user_id}', [App\Http\Controllers\admin\UserCtrl::class, 'info']);
    Route::get('admin/users/check_username/{string}', [App\Http\Controllers\admin\UserCtrl::class, 'check']);
    Route::post('admin/users/store', [App\Http\Controllers\admin\UserCtrl::class, 'store']);
    Route::get('admin/login', [App\Http\Controllers\admin\UserCtrl::class, 'loginAs']);
    Route::post('admin/login', [App\Http\Controllers\admin\UserCtrl::class, 'assignLogin']);
    

    /**
     * ParamCtrl
     */
    Route::get('admin/account/return', [App\Http\Controllers\ParamCtrl::class, 'returnToAdmin']);
    Route::get('list/doctor/{facility_id}/{department_id}', [App\Http\Controllers\ParamCtrl::class, 'getDoctorList']);
    Route::get('doctor/verify/{code}', [App\Http\Controllers\ParamCtrl::class, 'verifyCode']);
    
    /**
     * Doctor\PrintCtrl
     */
    Route::get('doctor/print/consent', [App\Http\Controllers\doctor\PrintCtrl::class, 'patientConsent']);
    Route::get('doctor/print/form/{track_id}', [App\Http\Controllers\doctor\PrintCtrl::class, 'printReferral']);

    /**
     * Doctor\PregnantCtrl
     */
    Route::post('doctor/pregnant/add/info', [App\Http\Controllers\doctor\PregnantCtrl::class, 'addInfo']);
    Route::post('doctor/patient/return/pregnant', [App\Http\Controllers\doctor\PregnantCtrl::class, 'returnPregnant']);

    /**
     * Admin\PregnantCtrl
     */
    //34 weeks
    Route::get('admin/aog/weeks/report', [App\Http\Controllers\admin\PregnantCtrl::class, 'index']);
    Route::post('admin/aog/weeks/report', [App\Http\Controllers\admin\PregnantCtrl::class, 'index']);

    /**
     * Doctor\ReferralCtrl
     */
    Route::get('doctor/referral', [App\Http\Controllers\doctor\ReferralCtrl::class, 'index']);
    Route::post('doctor/referral/discharge/{track_id}/{unique_id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'discharge2']);
    Route::get('doctor/referred', [App\Http\Controllers\doctor\ReferralCtrl::class, 'referred']);
    Route::get('doctor/referred2','doctor\ReferralCtrl@referred2');
    Route::post('doctor/referred/cancel/{id}','doctor\ReferralCtrl@cancelReferral');
    Route::post('doctor/referred/transfer/{id}','doctor\ReferralCtrl@transferReferral');
    Route::post('doctor/referred/search','doctor\ReferralCtrl@searchReferred');
    Route::match(['get','post'], 'doctor/referred/track', [App\Http\Controllers\doctor\ReferralCtrl::class, 'trackReferral']);

    // Form is seen
    Route::get('doctor/referral/seenBy/{track_id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'seenBy']);
    Route::get('doctor/referral/seenBy/list/{track_id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'seenByList']); // List of users who seen the form

    // Get data for the form
    Route::get('doctor/referral/data/pregnantv2/{id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'pregnantFormv2']);

    // Request contact button is clicked
    Route::get('doctor/referral/calling/{track_id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'calling']);

    // Get list of user who requested the call
    Route::get('doctor/referral/callerBy/list/{track_id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'callerByList']);

    /**
     * Doctor/PatientCtrl
     */
    Route::post('doctor/patient/refer/{type}', [App\Http\Controllers\doctor\PatientCtrl::class, 'referPatient']);

    //AOG 
    Route::get('doctor/aog/weeks/{notif_id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'week34']);
    Route::post('doctor/aog/weeks/{notif_id}', [App\Http\Controllers\doctor\ReferralCtrl::class, 'week34']);

    /**
     * Doctor\UploadCtrl
     */
    Route::post('doctor/upload_body', [App\Http\Controllers\doctor\UploadCtrl::class, 'uploadBody']);
    Route::post('doctor/uploadfile', [App\Http\Controllers\doctor\UploadCtrl::class, 'uploadFile']);
    Route::get('doctor/fileView/{id}', [App\Http\Controllers\doctor\UploadCtrl::class, 'fileView']);
    Route::get('doctor/fileDelete/{id}', [App\Http\Controllers\doctor\UploadCtrl::class, 'fileDelete']);
    // Route::post('doctor/view_upload_body','doctor\UploadCtrl@ViewuploadBody');
    // Route::post('doctor/uploadview','doctor\UploadCtrl@uploadFView');
    
    /**
     * Admin\FiletypeCtrl
     */
    Route::get('admin/filetypes', [App\Http\Controllers\admin\FiletypeCtrl::class, 'index']);
    Route::post('admin/filetype/delete', [App\Http\Controllers\admin\FiletypeCtrl::class, 'delete']);
    Route::post('admin/filetypes_body', [App\Http\Controllers\admin\FiletypeCtrl::class, 'filetypesBody']);
    Route::post('admin/filetypes_options', [App\Http\Controllers\admin\FiletypeCtrl::class, 'filetypeOptions']);

    /**
     * Admin\FacilityCtrl
     */
    // PROVINCE
    Route::match(['GET','POST'], 'admin/province', [App\Http\Controllers\admin\FacilityCtrl::class, 'provinceView']);
    Route::post('admin/province/body', [App\Http\Controllers\admin\FacilityCtrl::class, 'provinceBody']);
    Route::post('admin/province/add', [App\Http\Controllers\admin\FacilityCtrl::class, 'provinceAdd']);
    Route::post('admin/province/delete', [App\Http\Controllers\admin\FacilityCtrl::class, 'provinceDelete']);

    // INCIDENT TYPE
    Route::match(['GET','POST'], 'admin/incident_type', [App\Http\Controllers\admin\FacilityCtrl::class, 'incidentTab']);
    Route::post('admin/incident_type/body', [App\Http\Controllers\admin\FacilityCtrl::class, 'IncidentBody']);
    Route::post('admin/incident_type/add', [App\Http\Controllers\admin\FacilityCtrl::class, 'incidentAdd']);
    Route::post('admin/incident/body','admin\FacilityCtrl@Incident');
    Route::post('admin/incident/addIncident','admin\FacilityCtrl@addIncident'); 
    Route::get('doctor/referral/accept/incident/{track_id}','Monitoring\MonitoringCtrl@IncidentLog');
    Route::get('doctor/report/incidentIndex','Monitoring\MonitoringCtrl@incidentIndex');
    Route::post('doctor/report/incidentIndex','Monitoring\MonitoringCtrl@incidentIndex');

    // MUNICIPALITY/CITY
    Route::match(['GET','POST'], 'admin/municipality/{province_id}', [App\Http\Controllers\admin\FacilityCtrl::class, 'municipalityView']);
    Route::post('admin/municipality/crud/add', [App\Http\Controllers\admin\FacilityCtrl::class, 'municipalityAdd']);
    Route::post('admin/municipality/crud/body', [App\Http\Controllers\admin\FacilityCtrl::class, 'municipalityBody']);
    Route::post('admin/municipality/crud/delete', [App\Http\Controllers\admin\FacilityCtrl::class, 'municipalityDelete']);

    // BARANGAY
    Route::match(['GET','POST'], 'admin/barangay/{province_id}/{muncity_id}', [App\Http\Controllers\admin\FacilityCtrl::class, 'barangayView']);
    Route::post('admin/barangay/data/crud/body', [App\Http\Controllers\admin\FacilityCtrl::class, 'barangayBody']);
    Route::post('admin/barangay/data/crud/add', [App\Http\Controllers\admin\FacilityCtrl::class, 'barangayAdd']);
    Route::post('admin/barangay/data/crud/delete', [App\Http\Controllers\admin\FacilityCtrl::class, 'barangayDelete']);

    // FACILITY
    Route::match(['GET','POST'], 'admin/facility', [App\Http\Controllers\admin\FacilityCtrl::class, 'index']);
    Route::post('admin/facility/body', [App\Http\Controllers\admin\FacilityCtrl::class, 'facilityBody']);
    Route::post('admin/facility/add', [App\Http\Controllers\admin\FacilityCtrl::class, 'facilityAdd']);
    Route::post('admin/facility/delete', [App\Http\Controllers\admin\FacilityCtrl::class, 'facilityDelete']);

    /**
     * Admin\HomeCtrl
     */
    Route::match(['GET','POST'],'admin/maincat', [App\Http\Controllers\admin\HomeCtrl::class, 'mainCat']);
    Route::post('admin/maincat/body', [App\Http\Controllers\admin\HomeCtrl::class, 'maincatBody']);
    Route::post('admin/maincat/add', [App\Http\Controllers\admin\HomeCtrl::class, 'maincatAdd']);
    Route::post('admin/maincat/delete', [App\Http\Controllers\admin\HomeCtrl::class, 'maincatDelete']);

    Route::match(['GET','POST'],'admin/subcat', [App\Http\Controllers\admin\HomeCtrl::class, 'subCat']);
    Route::post('admin/subcat/body', [App\Http\Controllers\admin\HomeCtrl::class, 'subcatBody']);
    Route::post('admin/subcat/add', [App\Http\Controllers\admin\HomeCtrl::class, 'subcatAdd']);
    Route::post('admin/subcat/delete', [App\Http\Controllers\admin\HomeCtrl::class, 'subcatDelete']);

    Route::match(['GET','POST'],'admin/diagnosis', [App\Http\Controllers\admin\HomeCtrl::class, 'diag']);
    Route::post('admin/diagnosis/body', [App\Http\Controllers\admin\HomeCtrl::class, 'diagBody']);
    Route::get('admin/getmaincat/{miancat_id}', [App\Http\Controllers\admin\HomeCtrl::class, 'getMaincat']);
    Route::post('admin/diagnosis/add', [App\Http\Controllers\admin\HomeCtrl::class, 'diagnosisAdd']); 
    Route::post('admin/diagnosis/delete', [App\Http\Controllers\admin\HomeCtrl::class, 'diagnosisDelete']);

    /**
     * Opcen\OpcenController
     */
    Route::get('opcen', [App\Http\Controllers\Opcen\OpcenController::class, 'opcenDashboard']);
    Route::get('opcen/client', [App\Http\Controllers\Opcen\OpcenController::class, 'opcenClient']);
    Route::get('opcen/client/addendum/body','Opcen\OpcenController@addendumBody');
    Route::post('opcen/client/addendum/post','Opcen\OpcenController@addendumPost');
    Route::get('opcen/client/form/{client_id}','Opcen\OpcenController@clientInfo');
    Route::get('opcen/bed/available','Opcen\OpcenController@bedAvailable');
    Route::get('opcen/new_call', [App\Http\Controllers\Opcen\OpcenController::class, 'newCall']);
    Route::get('opcen/repeat_call/{client_id}','Opcen\OpcenController@repeatCall');
    Route::get('opcen/reason_calling/{reason}', [App\Http\Controllers\Opcen\OpcenController::class, 'reasonCalling']);
    Route::get('opcen/availability/service','Opcen\OpcenController@availabilityAndService');
    Route::get('opcen/sms','Opcen\OpcenController@sendSMS');
    Route::get('opcen/transaction/complete','Opcen\OpcenController@transactionComplete');
    Route::get('opcen/transaction/incomplete', [App\Http\Controllers\Opcen\OpcenController::class, 'transactionInComplete']);
    Route::get('opcen/onchange/province/{province_id}', [App\Http\Controllers\Opcen\OpcenController::class, 'onChangeProvince']);
    Route::get('opcen/onchange/municipality/{municipality_id}', [App\Http\Controllers\Opcen\OpcenController::class, 'onChangeMunicipality']);
    Route::post('opcen/transaction/end','Opcen\OpcenController@transactionEnd');
    Route::get('export/client/call', [App\Http\Controllers\Opcen\OpcenController::class, 'exportClientCall']);

    //IT CLIENT
    Route::get('it/client', [App\Http\Controllers\Opcen\OpcenController::class, 'itClient']);
    Route::get('it/new_call', [App\Http\Controllers\Opcen\OpcenController::class, 'itNewCall']);
    Route::get('it/reason_calling/{reason}', [App\Http\Controllers\Opcen\OpcenController::class, 'itReasonCalling']);
    Route::get('it/transaction/incomplete', [App\Http\Controllers\Opcen\OpcenController::class, 'itTransactionInComplete']);
    Route::get('it/search/{patient_code}/{reason}','Opcen\OpcenController@itCallReasonSearch');
    Route::post('it/call/saved','Opcen\OpcenController@itCallSaved');
    Route::get('it/client/form/{client_id}','Opcen\OpcenController@itCallInfo');
    Route::post('it/client/addendum/post','Opcen\OpcenController@itAddendum');
    Route::get('it/repeat_call/{client_id}','Opcen\OpcenController@itRepeatCall');
    Route::get('it/client/call','Opcen\OpcenController@exportItCall');
    Route::get('export/it/call', [App\Http\Controllers\Opcen\OpcenController::class, 'exportItCall']);

    /**
     * LocationCtrl
     */
    Route::get('location/muncity/{province_id}', [App\Http\Controllers\LocationCtrl::class, 'getMuncity']);
    Route::get('location/barangay/{muncity_id}', [App\Http\Controllers\LocationCtrl::class, 'getBarangay']);
    Route::get('location/barangay/{province_id}/{muncity_id}', [App\Http\Controllers\LocationCtrl::class, 'getBarangay1']);
    Route::get('location/facility/{facility_id}', [App\Http\Controllers\LocationCtrl::class, 'facilityAddress']);

    /**
     * Monitoring\MonitoringCtrl
     */
    // Monitoring
    Route::match(['GET','POST'],'monitoring', [App\Http\Controllers\Monitoring\MonitoringCtrl::class, 'monitoring']);
    Route::post('monitoring/remark','Monitoring\MonitoringCtrl@bodyRemark');
    Route::post('monitoring/add/remark','Monitoring\MonitoringCtrl@addRemark');
    Route::get('monitoring/feedback/{code}','Monitoring\MonitoringCtrl@feedbackDOH');
    Route::get('doctor/referral/accept/incident/{track_id}','Monitoring\MonitoringCtrl@IncidentLog');
    Route::get('doctor/report/incidentIndex', [App\Http\Controllers\Monitoring\MonitoringCtrl::class, 'incidentIndex']);
    Route::post('doctor/report/incidentIndex','Monitoring\MonitoringCtrl@incidentIndex');

    // reco to red monitoring
    Route::get('doctor/recotored', [App\Http\Controllers\Monitoring\MonitoringCtrl::class, 'recotoRed']);
    Route::post('doctor/recotored', [App\Http\Controllers\Monitoring\MonitoringCtrl::class, 'recotoRed']);

    /**
     * ChatCtrl
     */
    Route::get('support/chat', [App\Http\Controllers\support\ChatCtrl::class, 'index']);
    Route::post('support/chat','support\ChatCtrl@send');
    Route::get('support/chat/messages','support\ChatCtrl@messages');
    Route::get('support/chat/messages/load','support\ChatCtrl@loadMessages');
    Route::get('support/chat/messages/reply/{id}','support\ChatCtrl@reply');
    Route::get('support/chat/sample','support\ChatCtrl@sample');

    /**
     * 
     */
    //chat
    Route::get('/chat', [App\Http\Controllers\ContactsController::class, 'index'])->name('home');
    Route::get('/contacts', [App\Http\Controllers\ContactsController::class, 'get']);
    Route::get('/conversation/{id}', [App\Http\Controllers\ContactsController::class, 'getMessagesFor']);
    Route::post('/conversation/send', [App\Http\Controllers\ContactsController::class, 'send']);

    /**
     * Support Routes
     */
    Route::get('support', [App\Http\Controllers\doctor\HomeCtrl::class, 'index']);
    Route::get('support/dashboard/count','support\HomeCtrl@count');
    Route::post('support/license_no','support\HospitalCtrl@license_no');
    Route::get('support/users', [App\Http\Controllers\support\UserCtrl::class, 'index']);
    Route::get('support/uers/add','support\UserCtrl@create');
    Route::post('support/uers/add','support\UserCtrl@add');
    Route::post('support/users/store', [App\Http\Controllers\support\UserCtrl::class, 'store']);
    Route::post('support/users/update', [App\Http\Controllers\support\UserCtrl::class, 'update']);
    Route::get('support/users/check_username/{string}', [App\Http\Controllers\support\UserCtrl::class, 'check']);
    Route::get('support/users/check_username/update/{string}/{user_id}', [App\Http\Controllers\support\UserCtrl::class, 'checkUpdate']);
    Route::get('support/users/info/{user_id}', [App\Http\Controllers\support\UserCtrl::class, 'info']);
    Route::get('support/hospital', [App\Http\Controllers\support\HospitalCtrl::class, 'index']);
    Route::post('support/hospital/update', [App\Http\Controllers\support\HospitalCtrl::class, 'update']);

    /**
     * Admin\ReportCtrl
     */

    // Graph
    Route::get("admin/report/graph/incoming", [App\Http\Controllers\admin\ReportCtrl::class, 'graph']);
    Route::get("admin/report/graph/bar_chart", [App\Http\Controllers\admin\ReportCtrl::class, 'bar_chart']);

    // Online users
    Route::get('admin/report/online', [App\Http\Controllers\admin\ReportCtrl::class, 'online1']);
    Route::post('admin/report/online', [App\Http\Controllers\admin\ReportCtrl::class, 'filterOnline1']);

    // Online facility
    Route::match(['GET','POST'], 'online/facility', [App\Http\Controllers\admin\ReportCtrl::class, 'onlineFacility']);

    // Offline facility
    Route::match(['GET','POST'], 'offline/facility', [App\Http\Controllers\admin\ReportCtrl::class, 'offlineFacility']);
    Route::match(['GET','POST'], 'weekly/report', [App\Http\Controllers\admin\ReportCtrl::class, 'weeklyReport']);
    Route::post('offline/facility/remark', [App\Http\Controllers\Monitoring\MonitoringCtrl::class, 'offlineRemarkBody']);
    Route::post('offline/facility/remark/add', [App\Http\Controllers\Monitoring\MonitoringCtrl::class, 'offlineRemarkAdd']);

    // Onboard facility
    Route::get('onboard/facility', [App\Http\Controllers\admin\ReportCtrl::class, 'onboardFacility']);
    Route::get('onboard/users', [App\Http\Controllers\admin\ReportCtrl::class, 'onboardUsers']);
    
    // Rererral
    Route::get('admin/report/referral', [App\Http\Controllers\admin\ReportCtrl::class, 'referral']);
    Route::post('admin/report/referral', [App\Http\Controllers\admin\ReportCtrl::class, 'filterReferral']);

    // Statistics
    Route::match(['GET','POST'],'admin/statistics/incoming', [App\Http\Controllers\admin\ReportCtrl::class, 'statisticsReportIncoming']);
    Route::match(['GET','POST'],'admin/statistics/outgoing', [App\Http\Controllers\admin\ReportCtrl::class, 'statisticsReportOutgoing']);
    
    // ER OB
    Route::match(['GET','POST'],'admin/er_ob', [App\Http\Controllers\admin\ReportCtrl::class, 'erobReport']);

    // User online
    Route::match(['GET','POST'],'admin/average/user_online', [App\Http\Controllers\admin\ReportCtrl::class, 'averageUsersOnline']);

    /**
     * Doctor\AffiliatedCtrl
     */
    Route::get('doctor/affiliated', [App\Http\Controllers\doctor\AffiliatedCtrl::class, 'index']);
    Route::post('doctor/affiliated', [App\Http\Controllers\doctor\AffiliatedCtrl::class, 'index']);
    Route::post('doctor/affiliated_body', [App\Http\Controllers\doctor\AffiliatedCtrl::class, 'AfiiliatedBody']);
    Route::post('doctor/affiliated/add', [App\Http\Controllers\doctor\AffiliatedCtrl::class, 'AffiliatedOptions']);
    Route::post('doctor/affiliated/delete', [App\Http\Controllers\doctor\AffiliatedCtrl::class, 'AffiliatedOptions']); 
    Route::get('doctor/affiliated/referral', [App\Http\Controllers\doctor\AffiliatedCtrl::class, 'AffiReferral']);
    Route::get('doctor/affiliated/accepted','doctor\AffiliatedCtrl@AffiPatient');
   
    /**
     * Admin\PatientCtrl
     */
    Route::match(['GET','POST'], 'admin/report/consolidated/incomingv2', [App\Http\Controllers\admin\PatientCtrl::class, 'consolidatedIncomingv2']);

    //EXCEL
    Route::get('excel/incoming', [App\Http\Controllers\ExcelCtrl::class, 'ExportExcelIncoming']);
    Route::get('excel/outgoing','ExcelCtrl@ExportExcelOutgoing');
    Route::get('excel/all','ExcelCtrl@ExportExcelAll');
    Route::match(['GET','POST'],'excel/import', [App\Http\Controllers\ExcelCtrl::class, 'importExcel']);

    /**
     * admin/DailyCtrl
     */
    // Daily users
    Route::get('admin/daily/users', [App\Http\Controllers\admin\DailyCtrl::class, 'users']);
    Route::post('admin/daily/users', [App\Http\Controllers\admin\DailyCtrl::class, 'usersFilter']);

    // Daily referral
    Route::get('admin/daily/referral', [App\Http\Controllers\admin\DailyCtrl::class, 'referral']);
    Route::get('admin/daily/referral/incoming/', [App\Http\Controllers\admin\DailyCtrl::class, 'incoming']);
    Route::get('admin/daily/referral/outgoing', [App\Http\Controllers\admin\DailyCtrl::class, 'outgoing']);
    Route::post('admin/daily/referral', [App\Http\Controllers\admin\DailyCtrl::class, 'referralFilter']);

    /**
     * admin/ExportCtrl
     */
    Route::get('admin/daily/users/export', [App\Http\Controllers\admin\ExportCtrl::class, 'dailyUsers']);
    Route::get('admin/daily/referral/export', [App\Http\Controllers\admin\ExportCtrl::class, 'dailyReferral']);

});

