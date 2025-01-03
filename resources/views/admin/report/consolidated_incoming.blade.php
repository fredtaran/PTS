@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}
                    <small class="pull-right text-success">
                        <?php //echo date('F d, Y').' - '.date('F d, Y'); ?>
                    </small>
                </h3>
            </div>
            <div class="box-body">
                @if(count($data)>0)
                    <div class="table-responsive">
                        <div class="alert alert-info">
                            <p style="color: #3c8dbc !important">
                                <i class="fa fa-info"></i> Legend:
                            </p>
                            <span class="badge bg-red">Incoming</span> <span class="badge bg-green">Accepted</span> <span class="badge bg-yellow">Viewed Only</span>
                        </div>
                        <table class="table table-striped table-hover table-bordered" style="font-size: 8pt">
                            <tr class="bg-black">
                                <td>Facility Name</td>
                                <td>Common Sources(Facility)</td>
                                <td>Common Referring(Doctor)</td>

                                <td>Reasons by<br>(ranked)</td>
                                <td>Top diagnoses</td>
                                <td>Common Transportation</td>
                                <td>Department</td>
                                <td>Issues &<br>Concerns</td>
                            </tr>
                            @foreach($data as $row)
                                <?php
                                    $incoming = \App\Tracking::where("referred_to","=",$row->id)->count();
                                    $accepted = \App\Activity::where("referred_to","=",$row->id)->where("status","=","accepted")->count();
                                    $facility_id = $row->id;
                                    $seenzoned = \DB::connection('mysql')->select("call getViewedOnly('$facility_id')")[0]->viewed_only;
                                ?>
                                <tr>
                                    <td >
                                        <?php
                                            echo '<span class="label label-primary">'.$row->name.'</span>';
                                            echo '<br><br>';
                                            echo '<span class="badge bg-red">'.$incoming.'</span><span class="badge bg-green">'.$accepted.'</span><span class="badge bg-yellow">'.$seenzoned.'</span>';
                                        ?>
                                    </td>
                                    <td >
                                        <?php
                                                $facility = \App\Tracking::select("facility.name",\DB::raw("count(facility.id) as count"))
                                                            ->leftJoin("facility","facility.id","=","tracking.referred_from")
                                                            ->where("tracking.referred_to","=",$row->id)
                                                            ->groupBy('facility.id')
                                                            ->orderBy("count","desc")
                                                            ->get();
                                                foreach($facility as $fac){
                                                    echo '<span class="label label-primary">'.$fac->name.'<span class="badge bg-maroon">'.$fac->count.'</span></span>';
                                                }
                                         ?>
                                    </td>
                                    <td >
                                        <?php
                                            $referring = \App\Tracking::select(\DB::raw("concat('DR. ',users.fname,' ',users.mname,' ',users.lname) as fullname"),\DB::raw("count(tracking.referring_md) as count"))
                                                                        ->leftJoin("users","users.id","=","tracking.referring_md")
                                                                        ->where("tracking.referred_to","=",$row->id)
                                                                        ->where(\DB::raw("concat('DR. ',users.fname,' ',users.mname,' ',users.lname)"),"!=","")
                                                                        ->groupBy("tracking.referring_md")
                                                                        ->orderBy("count","desc")
                                                                        ->limit(3)
                                                                        ->get();
                                        foreach($referring as $ref){
                                            echo '<span class="label label-primary">'.$ref->fullname.'<span class="badge bg-maroon">'.$ref->count.'</span></span>';
                                        }
                                        ?>
                                    </td>

                                    <td >
                                        <?php
                                            $reason = \App\PatientForm::select("patient_form.reason",\DB::raw("count(patient_form.reason) as count"))
                                                ->where("patient_form.referred_to","=",$row->id)
                                                ->where("patient_form.reason","!=","")
                                                ->groupBy('patient_form.reason')
                                                ->orderBy("count","desc")
                                                ->limit(3)
                                                ->get();
                                            foreach($reason as $rea){
                                                echo '<span class="label label-primary">'.$rea->reason.'<span class="badge bg-maroon">'.$rea->count.'</span></span>';
                                                echo '<br><br>';
                                            }
                                        ?>
                                    </td>
                                    <td >
                                        <?php
                                            $diagnosis = \App\PatientForm::select("patient_form.diagnosis",\DB::raw("count(patient_form.diagnosis) as count"))
                                                ->where("patient_form.referred_to","=",$row->id)
                                                ->where("patient_form.diagnosis","!=","")
                                                ->groupBy('patient_form.diagnosis')
                                                ->orderBy("count","desc")
                                                ->limit(3)
                                                ->get();
                                            foreach($diagnosis as $dia){
                                                echo '<span class="label label-primary">'.$dia->diagnosis.'<span class="badge bg-maroon">'.$dia->count.'</span></span>';
                                                echo '<br><br>';
                                            }
                                        ?>
                                    </td>
                                    <td >
                                        <?php
                                        $transportation = \App\Tracking::select("mode_transportation.transportation",\DB::raw("count(mode_transportation.id) as count"))
                                            ->leftJoin("mode_transportation","mode_transportation.id","=","tracking.mode_transportation")
                                            ->where("tracking.referred_to","=",$row->id)
                                            ->where("mode_transportation.transportation","!=","")
                                            ->groupBy('mode_transportation.id')
                                            ->orderBy("count","desc")
                                            ->get();
                                        foreach($transportation as $trans){
                                            echo '<span class="label label-primary">'.$trans->transportation.'<span class="badge bg-maroon">'.$trans->count.'</span></span>';
                                        }
                                        ?>
                                    </td>
                                    <td >
                                        <?php
                                        $department = \App\Tracking::select("department.description",\DB::raw("count(department.id) as count"))
                                            ->leftJoin("department","department.id","=","tracking.department_id")
                                            ->where("tracking.referred_to","=",$row->id)
                                            ->where("tracking.department_id","!=","")
                                            ->groupBy('department.id')
                                            ->orderBy("count","desc")
                                            ->get();
                                        foreach($department as $dep){
                                            echo '<span class="label label-primary">'.$dep->description.'<span class="badge bg-maroon">'.$dep->count.'</span></span>';
                                            echo '<br><br>';
                                        }
                                        ?>
                                    </td>
                                    <td >
                                        <?php
                                            $issue = \App\Tracking::select("issue.issue")
                                                ->leftJoin("issue","issue.tracking_id","=","tracking.id")
                                                ->where("tracking.referred_to","=",$row->id)
                                                ->where("issue.issue","!=","")
                                                ->get();
                                            foreach($issue as $iss){
                                                echo '<span class="label label-primary">'.$iss->issue.'</span>';
                                                echo '<br><br>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    <hr />
                @else
                    <div class="alert alert-warning">
                        <span class="text-warning">
                            <i class="fa fa-warning"></i> No data found!
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ url('plugin/daterange/daterangepicker.css') }}" />
@endsection

@section('js')
    <script src="{{ url('plugin/daterange/moment.min.js') }}"></script>
    <script src="{{ url('plugin/daterange/daterangepicker.js') }}"></script>

@endsection