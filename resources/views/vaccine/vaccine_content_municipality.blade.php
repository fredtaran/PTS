<style>
    input[type=radio] {
        width: 20%;
        height: 2em;
    }
</style>
<div class="modal-header">
    <h3 id="myModalLabel"><i class="fa fa-location-arrow" style="color:green"></i> {{ \App\Muncity::find($muncity_id)->description }}</h3>
</div>
 <form action="{{ asset('vaccine/saved') }}" method="POST" id="form_submit" autocomplete="off">
     {{ csrf_field() }}
     <input type="hidden" name="vaccine_id" value="{{ $vaccine->id }}">
     <br>
     <div id="table_data">
     @include('vaccine.vaccine_table')
     </div>
     <button class="btn btn-link collapsed" style="color:red" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <b>Sinovac</b>
     </button>
     <button class="btn btn-link collapsed" style="color:darkgoldenrod;" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
        <b>Astrazeneca</b>
     </button>
     <button class="btn btn-link collapsed" style="color:#00a65a" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         <b>SputnikV</b>
     </button>
     <button class="btn btn-link collapsed" style="color:#00c0ef;" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
         <b>Pfizer</b>
     </button>
</form>
@if(count($vaccine_accomplishment) > 0)
<table style="font-size: 10pt;" class="table table-striped" border="2">
    <tr>
        <th>Type of Vaccine</th> <!-- Type of Vaccine 1-1 -->
        <th colspan="5"><center>Eligible Population</center></th>
        <th colspan="3">Vaccine Allocated</th>
        <th colspan="5"><center>Total Vaccinated</center></th>
        <th>Mild</th>
        <th>Serious</th>
        <th>Deferred</th>
        <th>Refused</th>
        <th>Wastage</th>
        <th>Percent Coverage</th>
        <th>Consumption Rate</th>
        <th>Remaining Unvacinated</th>
    </tr>
    <tr>
        <td></td> <!-- 1-2 -->
        <th>A1</th>
        <th>A2</th>
        <th>A3</th>
        <th>A4</th>
        <th>Total</th>
        <th>1st</th>
        <th>2nd</th>
        <th>Total</th>
        <th>A1</th>
        <th>A2</th>
        <th>A3</th>
        <th>A4</th>
        <th>Total</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    </tr>

    <!-- SINOVAC -->
    <tbody id="collapseTwo" class="collapse bg-danger" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #ffd8d6">
        <td rowspan="2">

        </td> <!-- 1-3 -->
        <td rowspan="2">{{ $total_epop_svac_a1 }}</td> <!-- A1 SINOVAC FIRST -->
        <td rowspan="2">{{$total_epop_svac_a2 }}</td> <!-- A2 SINOVAC FIRST -->
        <td rowspan="2">{{ $total_epop_svac_a3 }}</td> <!-- A3 SINOVAC FIRST -->
        <td rowspan="2">{{ $total_epop_svac_a4 }}</td> <!-- A4 SINOVAC FIRST -->
        <td rowspan="2">{{ $total_epop_svac }}</td> <!-- ELIPOP TOTAL SINOVAC FIRST  -->
        <td rowspan="2">{{ $total_vallocated_svac_frst }}</td>  <!-- VACCINE ALLOCATED(FD) SINOVAC FIRST -->
        <td rowspan="2">{{ $total_vallocated_svac_scnd }}</td> <!-- VACCINE ALLOCATED(SD) SINOVAC FIRST -->
        <td rowspan="2">{{ $total_vallocated_svac }}</td><!-- VACCINE ALLOCATED TOTAL SINOVAC -->
        <td>
            <span class="label label-success">{{ $total_svac_a1_frst }}</span> <!-- VACCINATED (A1) SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_svac_a2_frst }}</span> <!-- VACCINATED (A2) SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_svac_a3_frst }}</span> <!-- VACCINATED (A3) SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success"> {{ $total_svac_a4_frst }}</span> <!-- VACCINATED (A4) SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_vcted_svac_frst }}</span>  <!-- TOTAL VACCINATED SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_mild_svac_frst }}</span>   <!-- MILD SINOVAC  FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_srs_svac_frst }}</span>  <!-- SERIOUS SINOVAC FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_dfrd_svac_frst }}</span> <!-- DEFERRED SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_rfsd_svac_frst }}</span> <!-- REFUSED SINOVAC  FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_wstge_svac_frst }}</span> <!-- WASTAGE SINOVAC  FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ number_format($p_cvrge_svac_frst,2) }}%</span> <!-- PERCENT COVERAGE SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ number_format($total_c_rate_svac_frst,2) }}%</span> <!-- CONSUMPTION RATE SINOVAC FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_r_unvcted_frst_svac }}</span> <!-- REMAINING UNVACCINATED SINOVAC FIRST -->
        </td>
    </tr>
    <tr style="background-color: #ffd8d6">
        <td>
            <span class="label label-warning">{{ $total_svac_a1_scnd }} </span> <!-- VACCINATED (A1) SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_svac_a2_scnd }} </span> <!-- VACCINATED (A2) SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_svac_a3_scnd }} </span> <!-- VACCINATED (A3) SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_svac_a4_scnd }} </span> <!-- VACCINATED (A4) SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_vcted_svac_scnd }}</span> <!-- TOTAL VACCINATED SINOVAC SECOND -->
        </td> <!-- 1-4 -->
        <td>
            <span class="label label-warning">{{ $total_mild_svac_scnd }}</span> <!-- MILD SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_srs_svac_scnd }}</span> <!-- SERIOUS SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_dfrd_svac_scnd }}</span> <!-- DEFERRED SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_rfsd_svac_scnd }}</span> <!-- REFUSED SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_wstge_svac_scnd }}</span> <!-- WASTAGE SINOVAC SECOND -->
        </td>
        <td>

            <span class="label label-warning">{{ number_format($p_cvrge_svac_scnd,2) }}%</span> <!-- PERCENT COVERAGE SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ number_format($total_c_rate_svac_scnd,2)}}%</span> <!-- CONSUMPTION RATE SINOVAC SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_r_unvcted_scnd_svac }} </span> <!-- REMAINING UNVACCINATED SINOVAC SECOND -->
        </td>
    </tr>
    </tbody>
    <tr>
    </tr>

    <!-- ASTRAZENECA -->
    <tbody id="collapse2" class="collapse bg-primary" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <tr style="background-color: #f2fcac">
            <td rowspan="2"></td> <!-- 1-5 -->
            <td rowspan="2" style="color:black;">{{ $total_epop_astra_a1 }}</td>  <!-- Frontline(A1) ASTRA -->
            <td rowspan="2" style="color:black;">{{ $total_epop_astra_a2 }}</td>  <!-- SENIOR(A2) ASTRA -->
            <td rowspan="2" style="color:black;">{{ $total_epop_astra_a3 }}</td>
            <td rowspan="2" style="color:black;">{{ $total_epop_astra_a4 }}</td>
            <td rowspan="2" style="color:black;">{{ $total_epop_astra }}</td>  <!-- ELIPOP TOTAL ASTRA FIRST  -->
            <td rowspan="2" style="color:black;">{{ $total_vallocated_astra_frst }}</td>  <!-- VACCINE ALLOCATED(FD) ASTRA FIRST -->
            <td rowspan="2" style="color: black;">{{ $total_vallocated_astra_scnd }}</td>  <!-- VACCINE ALLOCATED(SD) ASTRA FIRST -->
            <td rowspan="2" style="color:black;">{{ $total_vallocated_astra }}</td>  <!-- TOTAL VACCINE ALLOCATED ASTRA FIRST -->
            <td style="color:black;">
                <span class="label label-success">{{ $total_astra_a1_frst }}</span>  <!-- VACCINATED (A1) ASTRA FIRST -->
            </td>
            <td  style="color:black;">
                <span class="label label-success">{{ $total_astra_a2_frst }} </span> <!-- VACCINATED (A2) ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_astra_a3_frst }} </span> <!-- VACCINATED (A3) ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_astra_a4_frst }} </span> <!-- VACCINATED (A4) ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_vcted_astra_frst }}</span> <!-- TOTAL VACCINATED  ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_mild_astra_frst }}</span> <!-- MILD ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_srs_astra_frst }}</span>  <!-- SERIOUS ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_dfrd_astra_frst }}</span>  <!-- DEFERRED ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_rfsd_astra_frst }}</span>  <!-- REFUSED ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_wstge_astra_frst }}</span>  <!-- WASTAGE ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ number_format($p_cvrge_astra_frst,2) }}%</span>  <!-- PERCENT COVERAGE ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ number_format($total_c_rate_astra_frst,2) }}%</span>  <!-- CONSUMPTION RATE ASTRA FIRST -->
            </td>
            <td>
                <span class="label label-success">{{ $total_r_unvcted_frst_astra }} </span>  <!-- REMAINING UNVACCINATED ASTRA FIRST -->
            </td>
        </tr>
        <tr style="background-color: #f2fcac">
            <td style="color:black;">
                <span class="label label-warning">{{ $total_astra_a1_scnd }}</span> <!-- VACCINATED (A1) ASTRA SECOND -->
            </td>
            <td style="color:black;">
                <span class="label label-warning">{{ $total_astra_a2_scnd }} </span>  <!-- VACCINATED (A2) ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_astra_a3_scnd }}</span> <!-- VACCINATED (A3) ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_astra_a4_scnd }}</span> <!-- VACCINATED (A4) ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_vcted_astra_scnd }}</span> <!-- TOTAL VACCINATED ASTRA SECOND -->
            </td> <!-- 1-6 -->
            <td>
                <span class="label label-warning">{{ $total_mild_astra_scnd }}</span> <!-- MILD ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_srs_astra_scnd }}</span> <!-- SERIOUS ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_dfrd_astra_scnd }}</span> <!-- DEFERRED ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_rfsd_astra_scnd }}</span> <!-- REFUSED ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_wstge_astra_scnd }}</span> <!-- WASTAGE ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ number_format($p_cvrge_astra_scnd,2) }}%</span> <!-- PERCENT COVERAGE ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ number_format($total_c_rate_astra_scnd,2) }}%</span> <!-- CONSUMPTION RATE ASTRA SECOND -->
            </td>
            <td>
                <span class="label label-warning">{{ $total_r_unvcted_scnd_astra }}</span> <!-- REMAINING UNVACCINATED ASTRA SECOND -->
            </td>
        </tr>
    </tbody>

    <!-- SPUTNIK V-->
    <tbody id="collapseThree" class="collapse bg-danger" aria-labelledby="headingThree" data-parent="#accordionExample">
    <tr style="background-color: #b1ffdb">
        <td rowspan="2">
        </td>
        <td rowspan="2">{{ $total_epop_sputnikv_a1 }}</td> <!-- A1 SPUTNIKV FIRST -->
        <td rowspan="2">{{ $total_epop_sputnikv_a2 }}</td> <!-- A2 SPUTNIKV  FIRST -->
        <td rowspan="2">{{ $total_epop_sputnikv_a3 }}</td> <!-- A3 SPUTNIKV  FIRST -->
        <td rowspan="2">{{ $total_epop_sputnikv_a4 }}</td> <!-- A4 SPUTNIKV FIRST -->
        <td rowspan="2">{{ $total_epop_sputnikv }}</td> <!-- ELIPOP TOTAL SPUTNIKV  FIRST  -->
        <td rowspan="2">{{ $total_vallocated_sputnikv_frst }}</td>  <!-- VACCINE ALLOCATED(FD) SPUTNIKV  FIRST -->
        <td rowspan="2">{{ $total_vallocated_sputnikv_scnd }}</td> <!-- VACCINE ALLOCATED(SD) SPUTNIKV  FIRST -->
        <td rowspan="2">{{ $total_vallocated_sputnikv }}</td><!-- VACCINE ALLOCATED TOTAL SPUTNIKV  -->
        <td>
            <span class="label label-success">{{ $total_sputnikv_a1_frst }}</span> <!-- VACCINATED (A1) SPUTNIKV  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_sputnikv_a2_frst }}</span> <!-- VACCINATED (A2) SPUTNIKV  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_sputnikv_a3_frst }}</span> <!-- VACCINATED (A3) SPUTNIKV FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_sputnikv_a4_frst }}</span> <!-- VACCINATED (A4) SPUTNIKV  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_vcted_sputnikv_frst }}</span>  <!-- TOTAL VACCINATED SPUTNIKV  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_mild_sputnikv_frst }}</span>   <!-- MILD SPUTNIKV   FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_srs_sputnikv_frst }}</span>  <!-- SERIOUS SPUTNIKV  FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_dfrd_sputnikv_frst }}</span> <!-- DEFERRED SPUTNIKV  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_rfsd_sputnikv_frst }}</span> <!-- REFUSED SPUTNIKV   FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_wstge_sputnikv_frst }}</span> <!-- WASTAGE SPUTNIKV   FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ number_format($p_cvrge_sputnikv_frst,2) }}%</span> <!-- PERCENT COVERAGE SPUTNIKV  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ number_format($total_c_rate_sputnikv_frst,2) }}%</span> <!-- CONSUMPTION RATE SPUTNIKV  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_r_unvcted_frst_sputnikv }}</span> <!-- REMAINING UNVACCINATED SPUTNIKV  FIRST -->
        </td>
    </tr>
    <tr style="background-color: #b1ffdb">
        <td style="color:black;">
            <span class="label label-warning">{{ $total_sputnikv_a1_scnd }}</span> <!-- VACCINATED (A1) SPUTNIKV SECOND -->
        </td>
        <td style="color:black;">
            <span class="label label-warning">{{ $total_sputnikv_a2_scnd }} </span>  <!-- VACCINATED (A2) SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_sputnikv_a3_scnd }}</span> <!-- VACCINATED (A3) SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_sputnikv_a4_scnd }}</span> <!-- VACCINATED (A4) SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_vcted_sputnikv_scnd }}</span> <!-- TOTAL VACCINATED SPUTNIKV SECOND -->
        </td> <!-- 1-6 -->
        <td>
            <span class="label label-warning">{{ $total_mild_sputnikv_scnd }}</span> <!-- MILD SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_srs_sputnikv_scnd }}</span> <!-- SERIOUS SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_dfrd_sputnikv_scnd }}</span> <!-- DEFERRED SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_rfsd_sputnikv_scnd }}</span> <!-- REFUSED SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_wstge_sputnikv_scnd }}</span> <!-- WASTAGE SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ number_format($p_cvrge_sputnikv_scnd,2) }}%</span> <!-- PERCENT COVERAGE SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ number_format($total_c_rate_sputnikv_scnd,2) }}%</span> <!-- CONSUMPTION RATE SPUTNIKV SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_r_unvcted_scnd_sputnikv }}</span> <!-- REMAINING UNVACCINATED SPUTNIKV SECOND -->
        </td>
    </tr>
    </tbody>

    <!-- PFIZER -->
    <tbody id="collapse3" class="collapse bg-danger" aria-labelledby="heading3" data-parent="#accordionExample">
    <tr style="background-color: #8fe7fd">
        <td rowspan="2">
        <td rowspan="2">{{ $total_epop_pfizer_a1 }}</td> <!-- A1 PFIZER FIRST -->
        <td rowspan="2">{{ $total_epop_pfizer_a2 }}</td> <!-- A2 PFIZER  FIRST -->
        <td rowspan="2">{{ $total_epop_pfizer_a3 }}</td> <!-- A3 PFIZER FIRST -->
        <td rowspan="2">{{ $total_epop_pfizer_a4 }}</td> <!-- A4 PFIZER FIRST -->
        <td rowspan="2">{{ $total_epop_pfizer }}</td> <!-- ELIPOP TOTAL PFIZER  FIRST  -->
        <td rowspan="2">{{ $total_vallocated_pfizer_frst }}</td>  <!-- VACCINE ALLOCATED(FD) PFIZER  FIRST -->
        <td rowspan="2">{{ $total_vallocated_pfizer_scnd }}</td> <!-- VACCINE ALLOCATED(SD) PFIZER  FIRST -->
        <td rowspan="2">{{ $total_vallocated_pfizer }}</td><!-- VACCINE ALLOCATED TOTAL PFIZER  -->
        <td>
            <span class="label label-success">{{ $total_pfizer_a1_frst }}</span> <!-- VACCINATED (A1) PFIZER  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_pfizer_a2_frst }}</span> <!-- VACCINATED (A2) PFIZER  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_pfizer_a3_frst }}</span> <!-- VACCINATED (A3) PFIZER FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_pfizer_a4_frst }}</span> <!-- VACCINATED (A4) PFIZER  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_vcted_pfizer_frst }}</span>  <!-- TOTAL VACCINATED PFIZER  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_mild_pfizer_frst }}</span>   <!-- MILD PFIZER   FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_srs_pfizer_frst }}</span>  <!-- SERIOUS PFIZER  FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_dfrd_pfizer_frst }}</span> <!-- DEFERRED PFIZER  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_rfsd_pfizer_frst }}</span> <!-- REFUSED PFIZER   FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ $total_wstge_pfizer_frst }}</span> <!-- WASTAGE PFIZER   FIRST-->
        </td>
        <td>
            <span class="label label-success">{{ number_format($p_cvrge_pfizer_frst,2) }}%</span> <!-- PERCENT COVERAGE PFIZER  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ number_format($total_c_rate_pfizer_frst,2) }}%</span> <!-- CONSUMPTION RATE PFIZER  FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ $total_r_unvcted_frst_pfizer }}</span> <!-- REMAINING UNVACCINATED PFIZER  FIRST -->
        </td>
    </tr>
    <tr style="background-color: #8fe7fd">
        <td style="color:black;">
            <span class="label label-warning">{{ $total_pfizer_a1_scnd }}</span> <!-- VACCINATED (A1) PFIZER SECOND -->
        </td>
        <td style="color:black;">
            <span class="label label-warning">{{ $total_pfizer_a2_scnd }} </span>  <!-- VACCINATED (A2) PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_pfizer_a3_scnd }}</span> <!-- VACCINATED (A3) PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_pfizer_a4_scnd }}</span> <!-- VACCINATED (A4) PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_vcted_pfizer_scnd }}</span> <!-- TOTAL VACCINATED PFIZER SECOND -->
        </td> <!-- 1-6 -->
        <td>
            <span class="label label-warning">{{ $total_mild_pfizer_scnd }}</span> <!-- MILD PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_srs_pfizer_scnd }}</span> <!-- SERIOUS PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_dfrd_pfizer_scnd }}</span> <!-- DEFERRED PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_rfsd_pfizer_scnd }}</span> <!-- REFUSED PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_wstge_pfizer_scnd }}</span> <!-- WASTAGE PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ number_format($p_cvrge_pfizer_scnd,2) }}%</span> <!-- PERCENT COVERAGE PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ number_format($total_c_rate_pfizer_scnd,2) }}%</span> <!-- CONSUMPTION RATE PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ $total_r_unvcted_scnd_pfizer }}</span> <!-- REMAINING UNVACCINATED PFIZER SECOND -->
        </td>
    </tr>
    </tbody>

    <tr>
        <td>Total</td> <!-- 1-7 -->
        <td>
           <b></b>  <!-- TOTAL A1 FIRST -->
        </td>
        <td>
            <b></b>  <!-- TOTAL A2 FIRST -->
        </td>
        <td>
            <b></b>  <!-- TOTAL A3 FIRST -->
        </td>
        <td>
            <b></b>  <!-- TOTAL A4 FIRST -->
        </td>
        <td>
           <b></b>  <!-- TOTAL_ELI_POP  -->
        </td>
        <td >
           <b>{{ $total_vallocated_frst }}</b>  <!-- TOTAL ALLOCATED_FIRST -->
        </td>
        <td >
            <b>{{ $total_vallocated_scnd }}</b>  <!-- TOTAL ALLOCATED_SECOND -->
        </td>
        <td>
            <b>{{ $total_vallocated}}</b>  <!-- TOTAL_ALLOCATED-->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{$total_a1}}</b>  <!-- TOTAL_A1   -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_a2 }}</b>  <!-- TOTAL_A2   -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_a3 }}</b>  <!-- TOTAL_A3   -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_a4 }}</b>  <!-- TOTAL_A4   -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_vcted_frst }}</b>  <!-- TOTAL_VACCINATED  -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_mild }}</b>  <!-- TOTAL_MILD  -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_serious }}</b>  <!-- TOTAL_SERIOUS   -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_deferred }}</b>  <!-- TOTAL_DEFERRED  -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_refused }}</b>  <!-- TOTAL_REFUSED  -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_wastage }}</b>  <!-- TOTAL_WASTAGE -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ number_format($total_p_cvrge_frst,2) }}%</b>  <!-- TOTAL_PERCENT_COVERAGE -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_c_rate_frst }}</b>  <!-- TOTAL_CONSUMPTION_RATE-->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ $total_r_unvcted_frst }}</b>  <!-- TOTAL_REMAINING_UNVACCINATED -->
        </td>
    </tr>
    <tr>
        <td></td> <!-- 1-7 -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{$total_overall_a1}}</b> <!-- TOTAL_A1   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{$total_overall_a2}}</b> <!-- TOTAL_A2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{$total_overall_a3}}</b> <!-- TOTAL_A3   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{$total_overall_a4}}</b> <!-- TOTAL_A4   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_vcted_scnd }}</b> <!-- TOTAL_VACCINATED 2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_overall_mild }}</b> <!-- TOTAL_MILD 2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_overall_serious}}</b> <!-- TOTAL_SERIOUS 2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_overall_deferred }}</b> <!-- TOTAL_DEFERRED 2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_overall_refused }}</b> <!-- TOTAL_REFUSED 2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_overall_wastage }}</b> <!-- TOTAL_WASTAGE 2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ number_format($total_overall_p_coverage,2) }}%</b> <!-- TOTAL_PERCENT_COVERAGE_2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_overall_c_rate }}</b> <!-- TOTAL_CONSUMPTION_RATE 2   -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ $total_overall_r_unvcted }}</b> <!-- TOTAL_REMAINING_UNVACCINATED 2   -->
        </td>
    </tr>
</table>
@else
    <div class="alert alert-warning">
        <div class="text-warning">No data!</div>
    </div>
@endif

<script>
    var count = 0;
    function addTbodyContent(province_id,muncity_id) {
        count++;
        $('#tbody_content_vaccine').append('<tr style="background-color: #59ab91">\n' +
            '    <input type="hidden" name="province_id" value="'+province_id+'" >\n' +
            '    <input type="hidden" name="muncity_id" value="'+muncity_id+'" >\n' +
            '    <td style="width: 15%">\n' +
            '        <input type="text" id="date_picker'+count+'" name="date_first[]" class="form-control" >\n' +
            '    </td>\n' +
            '    <td style="width: 15%" rowspan="2">\n' +
            '        <select name="typeof_vaccine[]" id="typeof_vaccine'+count+'" onchange="getVaccineAllocated('+muncity_id+','+count+')" class="select2" required>\n' +
            '            <option value="">Select Option</option>\n' +
            '            <option value="Sinovac">Sinovac</option>\n' +
            '            <option value="Astrazeneca">Astrazeneca</option>\n' +
            '            <option value="SputnikV">SputnikV</option>\n' +
            '            <option value="Pfizer">Pfizer</option>\n' +
            '        </select>\n' +
            '       <br><br>' +
            '<div class="row"><div class="col-md-6" style="padding:2%"><input type="text" id="vaccine_allocated_first'+count+'" name="vaccine_allocated_first[]" class="form-control" readonly></div><div class="col-md-6" style="background-color: #f39c12;padding: 2%"><input type="text" id="vaccine_allocated_second'+count+'" name="vaccine_allocated_second[]" class="form-control" readonly></div></div> \n' +
            '    </td>\n' +
            '    <td style="width: 15%" rowspan="2">\n' +
            '        <select name="priority[]" id="priority'+count+'" onchange="getEliPop('+muncity_id+','+count+')" class="select2" >\n' +
            '            <option value="">Select Priority</option>\n' +
            '            <option value="a1" >A1</option>\n' +
            '            <option value="a2" >A2</option>\n' +
            '            <option value="a3" >A3</option>\n' +
            '            <option value="a4" >A4</option>\n' +
            '            <option value="a5" disabled>A5</option>\n' +
            '            <option value="b1" disabled>B1</option>\n' +
            '            <option value="b2" disabled>B2</option>\n' +
            '            <option value="b3" disabled>B3</option>\n' +
            '            <option value="b4" disabled >B4</option>\n' +
            '            <option value="b5" disabled>B5</option>\n' +
            '            <option value="b6" disabled>B6</option>\n' +
            '            <option value="c"  disabled>C</option>\n' +
            '        </select>\n' +
            '       <br><br><input type="text" name="no_eli_pop[]" id="no_eli_pop'+count+'" class="form-control" readonly>\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="vaccinated_first[]" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="mild_first[]" value="" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="serious_first[]" value="" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="refused_first[]" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="deferred_first[]" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="wastage_first[]" class="form-control">\n' +
            '    </td>\n' +
            '</tr>\n' +
            '<tr style="background-color: #f39c12">\n' +
            '    <td>\n' +
            '        <input type="text" id="date_picker2'+count+'" name="date_second[]"  class="form-control">\n' +
            '    </td>\n' +
            '    <td>\n' +
            '        <input type="text" name="vaccinated_second[]" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="mild_second[]" value="" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="serious_second[]" value="" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="refused_second[]" class="form-control">\n' +
            '    </td>\n' +
            '    <td style="width: 5%">\n' +
            '        <input type="text" name="deferred_second[]" class="form-control">\n' +
            '    </td>\n' +
            '    <td>\n' +
            '        <input type="text" name="wastage_second[]"  class="form-control">\n' +
            '    </td>\n' +
            '\n' +
            '</tr>\n' +
            '<tr>\n' +
            '    <td colspan="9"><hr></td>\n' +
            '</tr>');

        $("#date_picker"+count).daterangepicker({
            "singleDatePicker":true
        });
        $("#date_picker2"+count).daterangepicker({
            "singleDatePicker":true
        });

        $(".select2").select2({ width: '100%' });
    }

    function getEliPop(muncity_id,count){
        var url = "<?php echo asset('vaccine/no_eli_pop').'/'; ?>"+muncity_id+"/"+$("#priority"+count).val();
        $.get(url,function(data){
            $("#no_eli_pop"+count).val(data);
        });
    }

    function getVaccineAllocated(muncity_id,count){
        //console.log(muncity_id);
        console.log(count);
        var url = "<?php echo asset('vaccine/allocated').'/'; ?>"+muncity_id+"/"+$("#typeof_vaccine"+count).val();
        $.get(url,function(data){
            $("#vaccine_allocated_first"+count).val(data[0]);
            $("#vaccine_allocated_second"+count).val(data[1]);
        });
    }

    $(document).ready(function(){

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page)
        {
            var province_id = "<?php echo $province_id ?>";
            var muncity_id = "<?php echo $muncity_id; ?>";
            var date_start = "<?php echo $date_start; ?>";
            var date_end = "<?php echo $date_end; ?>";
            var url = "<?php echo asset('vaccine/vaccinated/municipality/content'); ?>";
            url = url+"?page="+page;
            var json = {
                "_token" : "<?php echo csrf_token(); ?>",
                "province_id" : province_id,
                "muncity_id" : muncity_id,
                "date_start" : date_start,
                "date_end" : date_end,
                "pagination_table" : "true",
            };
            $.post(url,json,function(result){
                $('#table_data').html(result);
            });
        }

    });

</script>


