<h4>Grand Total</h4>

<table style="font-size: 8pt;" class="table" border="2">
    <tbody>
    <tr>
        <th>Type of Vaccine</th> <!-- Type of Vaccine 1-1 -->
        <th colspan="5">
            <center>
                <a style="color:black"> Eligible Population</a>
            </center>
        </th>
        <th colspan="3">
            <center>
                <a style="color:black"> Vaccine Allocated</a>
            </center>
        </th>
        <th colspan="5"><center>Total Vaccinated </center></th>
        <th>Mild</th>
        <th>Serious</th>
        <th>Deferred</th>
        <th>Refused</th>
        <th>Wastage</th>
        <th>Percent Coverage</th>
        <th>Consumption Rate</th>
        <th>Remaining Unvaccinated</th>
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
    </tbody>
    <tbody id="collapse_sinovac_grand" class="collapse bg-danger" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #ffd8d6">
        <td rowspan="2">

        </td> <!--SINOVAC -->
        <td rowspan="2">{{ Session::get('total_e_pop_svac_a1_prov') }}</td><!-- A1 SINOVAC_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_svac_a2_prov') }}</td><!-- A2 SINOVAC_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_svac_a3_prov') }}</td><!-- A3 SINOVAC_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_svac_a4_prov') }}</td><!-- A4 SINOVAC_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_svac_prov') }} <!-- TOTAL ELI POP SINOVAC_FIRST -->
        </td>
        <td rowspan="2">{{ Session::get('total_vallocated_svac_frst_prov') }} </td> <!-- VACCINE ALLOCATED (FD) SINOVAC_FIRST -->
        <td rowspan="2">{{ Session::get('total_vallocated_svac_scnd_prov') }} </td>  <!-- VACCINE ALLOCATED (SD) SINOVAC_FIRST -->
        <td rowspan="2"> {{ Session::get('total_vallocated_frst_svac') }}</td>  <!-- TOTAL VACCINE ALLOCATED SINOVAC_FIRST -->
        <td>
            <span class="label label-success">{{ Session::get('total_svac_a1_frst_prov') }}</span>   <!-- VACCINATED (A1) SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_svac_a2_frst_prov') }}</span>  <!-- VACCINATED (A2) SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_svac_a3_frst_prov') }}</span>  <!-- VACCINATED (A3) SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_svac_a4_frst_prov') }}</span>  <!-- VACCINATED (A4) SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success"> {{ Session::get('total_vcted_svac_frst') }}</span>  <!-- TOTAL VACCINATED SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_mild_svac_frst_prov') }}</span>  <!-- MILD SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_srs_svac_frst_prov') }}</span> <!-- SERIOUS SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_dfrd_svac_frst_prov') }}</span> <!-- DEFERRED SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_rfsd_svac_frst_prov') }}</span> <!-- REFUSED SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_wstge_svac_frst_prov') }}</span> <!-- WASTAGE SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_p_cvrge_svac_frst_prov') }}%</span> <!-- PERCENT COVERAGE SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_c_rate_svac_frst_prov') }}%</span> <!-- CONSUMPTION RATE SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_r_unvcted_frst_svac_prov') }}</span> <!-- REMAINING UNVACCINATED SINOVAC_FIRST -->
        </td>
    </tr>
    <tr style="background-color: #ffd8d6">
        <td>
            <span class="label label-warning">{{ Session::get('total_svac_a1_scnd_prov') }}</span>   <!-- VACCINATED (A1) SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_svac_a2_scnd_prov') }}</span> <!-- VACCINATED (A2) SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_svac_a3_scnd_prov') }}</span> <!-- VACCINATED (A3) SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_svac_a4_scnd_prov') }}</span> <!-- VACCINATED (A4) SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_vcted_svac_second') }}</span> <!-- TOTAL VACCINATED SINOVAC_SECOND -->
        </td> <!-- 1-4 -->
        <td>
            <span class="label label-warning">{{ Session::get('total_mild_svac_scnd_prov') }}</span> <!-- MILD SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_srs_svac_scnd_prov') }}</span> <!-- SERIOUS  SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_dfrd_svac_scnd_prov') }}</span> <!-- DEFERRED  SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_rfsd_svac_scnd_prov') }}</span> <!-- REFUSED  SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_wstge_svac_scnd_prov') }}</span> <!-- WASTAGE SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_p_cvrge_svac_scnd_prov')}}%</span> <!-- PERCENT COVERAGE  SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_c_rate_svac_scnd_prov') }}%</span> <!-- CONSUMPTION RATE SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_r_unvcted_scnd_svac_prov') }} </span> <!-- REMAINING UNVACCINATED  SINOVAC_SECOND -->
        </td>
    </tr>
    </tbody>
    <tbody id="collapse_astra_grand" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #f2fcac">
        <td rowspan="2">

        </td> <!-- 1-5 -->
        <td rowspan="2" style="color:black;">{{ Session::get('total_e_pop_astra_a1_prov') }}</td>  <!-- A1 ASTRA_FIRST -->
        <td rowspan="2" style="color:black;">{{ Session::get('total_e_pop_astra_a2_prov') }}</td>  <!-- A2 ASTRA_FIRST-->
        <td rowspan="2">{{ Session::get('total_e_pop_astra_a2_prov') }}</td>  <!-- A3 ASTRA_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_astra_a4_prov') }}</td>  <!-- A4 ASTRA_FIRST -->
        <td rowspan="2" style="color:black;">{{ Session::get('total_e_pop_astra_prov') }} <!-- TOTAL E POP ASTRA_FIRST --></td>
        <td rowspan="2" style="color:black">{{ Session::get('total_vallocated_astra_frst_prov') }}</td> <!-- VACCINE_ALLOCATED (FD) ASTRA_FIRST-->
        <td rowspan="2" style="color:black">{{ Session::get('total_vallocated_astra_scnd_prov') }}</td>  <!-- VACCINE ALLOCATED (SD) ASTRA_FIRST -->
        <td rowspan="2" style="color:black;">{{ Session::get('total_vallocated_frst_astra') }}</td>  <!-- TOTAL VACCINE ALLOCATED ASTRA_FIRST -->
        <td style="color:black;">
            <span class="label label-success">{{ Session::get('total_astra_a1_frst_prov') }}</span>  <!-- VACCINATED (A1) ASTRA_FIRST -->
        </td>
        <td style="color:black">
            <span class="label label-success">{{ Session::get('total_astra_a2_frst_prov') }}</span> <!-- VACCINATED (A2) ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_astra_a3_frst_prov') }}</span> <!-- VACCINATED (A3) ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_astra_a4_frst_prov') }}</span> <!-- VACCINATED (A4) ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_vcted_astra_frst') }}</span> <!-- TOTAL VACCINATED ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_mild_astra_frst_prov') }}</span> <!-- MILD ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_srs_astra_frst_prov') }}</span> <!-- SERIOUS ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_dfrd_astra_frst_prov') }}</span> <!-- DEFERRED ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_rfsd_astra_frst_prov') }}</span> <!-- REFUSED ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_wstge_astra_frst_prov') }}</span> <!-- WASTAGE ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_p_cvrge_astra_frst_prov') }}%</span> <!-- PERCENT_COVERAGE ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_c_rate_astra_frst_prov') }}%</span> <!-- CONSUMPTION RATE ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_r_unvcted_frst_astra_prov') }}</span> <!-- REMAINUNG UNVACCINATED ASTRA_FIRST -->
        </td>
    </tr>
    <tr style="background-color: #f2fcac">
        <td style="color: black;">
            <span class="label label-warning">{{ Session::get('total_astra_a1_scnd_prov') }}</span>  <!-- VACCINATED (A1) ASTRA_SECOND -->
        </td>
        <td style="color:black;">
            <span class="label label-warning">{{ Session::get('total_astra_a2_scnd_prov') }}</span>  <!-- VACCINATED (A2) ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_astra_a3_scnd_prov') }}</span>  <!-- VACCINATED (A3) ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_astra_a4_scnd_prov') }}</span>  <!-- VACCINATED (A4) ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_vcted_astra_second') }}</span>  <!-- TOTAL VACCINATED ASTRA_SECOND -->
        </td> <!-- 1-6 -->
        <td>
            <span class="label label-warning">{{ Session::get('total_mild_astra_scnd_prov') }}</span>  <!-- MILD ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_srs_astra_scnd_prov') }}</span> <!-- SERIOUS ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_dfrd_astra_scnd_prov') }}</span> <!-- DEFERRED ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_rfsd_astra_scnd_prov') }}</span> <!-- REFUSED ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_wstge_astra_scnd_prov') }}</span> <!-- WASTAGE ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_p_cvrge_astra_scnd_prov') }}%</span> <!-- PERCENT_COVERAGE_ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_c_rate_astra_scnd_prov') }}%</span> <!-- CONSUMPTION RATE ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_r_unvcted_scnd_astra_prov') }}</span> <!-- REMAINING UNVACCINATED ASTRA_SECOND -->
        </td>
    </tr>
    </tbody>
    <!-- SPUTNIKV -->
    <tbody id="collapse_sputnikv_grand" class="collapse bg-danger" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #b1ffdb">
        <td rowspan="2">

        </td> <!-- 1-3 -->
        <td rowspan="2">{{ Session::get('total_e_pop_sputnikv_a1_prov') }}</td><!-- A1 SPUTNIKV_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_sputnikv_a2_prov') }}</td><!-- A2 SPUTNIKV_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_sputnikv_a3_prov') }}</td><!-- A3 SPUTNIKV_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_sputnikv_a4_prov') }}</td><!-- A4 SPUTNIKV_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_sputnikv_prov') }} <!-- TOTAL ELI POP SPUTNIKV_FIRST -->
        </td>
        <td rowspan="2">{{ Session::get('total_vallocated_sputnikv_frst_prov') }} </td> <!-- VACCINE ALLOCATED (FD) SPUTNIKV_FIRST -->
        <td rowspan="2">{{ Session::get('total_vallocated_sputnikv_scnd_prov') }} </td>  <!-- VACCINE ALLOCATED (SD) SPUTNIKV_FIRST -->
        <td rowspan="2"> {{ Session::get('total_vallocated_frst_sputnikv') }}</td>  <!-- TOTAL VACCINE ALLOCATED SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">{{ Session::get('total_sputnikv_a1_frst_prov') }}</span>   <!-- VACCINATED (A1) SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_sputnikv_a2_frst_prov') }}</span>  <!-- VACCINATED (A2) SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_sputnikv_a3_frst_prov') }}</span>  <!-- VACCINATED (A3) SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_sputnikv_a4_frst_prov') }}</span>  <!-- VACCINATED (A4) SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_vcted_sputnikv_frst') }}</span> <!-- TOTAL VACCINATED SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_mild_sputnikv_frst_prov') }}</span> <!-- MILD SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_srs_sputnikv_frst_prov') }}</span> <!-- SERIOUS SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_dfrd_sputnikv_frst_prov') }}</span> <!-- DEFERRED SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_rfsd_sputnikv_frst_prov') }}</span> <!-- REFUSED SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_wstge_sputnikv_frst_prov') }}</span> <!-- WASTAGE SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_p_cvrge_sputnikv_frst_prov') }}%</span> <!-- PERCENT_COVERAGE SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_c_rate_sputnikv_frst_prov') }}%</span> <!-- CONSUMPTION RATE SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_r_unvcted_frst_sputnikv_prov') }}</span> <!-- REMAINUNG UNVACCINATED SPUTNIKV_FIRST -->
        </td>
    </tr>
    <tr style="background-color: #b1ffdb">
        <td style="color: black;">
            <span class="label label-warning">{{ Session::get('total_sputnikv_a1_scnd_prov') }}</span>  <!-- VACCINATED (A1) SPUTNIKV_SECOND -->
        </td>
        <td style="color:black;">
            <span class="label label-warning">{{ Session::get('total_sputnikv_a2_scnd_prov') }}</span>  <!-- VACCINATED (A2) SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_sputnikv_a3_scnd_prov') }}</span>  <!-- VACCINATED (A3) SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_sputnikv_a4_scnd_prov') }}</span>  <!-- VACCINATED (A4) SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_vcted_sputnikv_second') }}</span>  <!-- TOTAL VACCINATED SPUTNIKV_SECOND -->
        </td> <!-- 1-6 -->
        <td>
            <span class="label label-warning">{{ Session::get('total_mild_sputnikv_scnd_prov') }}</span>  <!-- MILD SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_srs_sputnikv_scnd_prov') }}</span> <!-- SERIOUS SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_dfrd_sputnikv_scnd_prov') }}</span> <!-- DEFERRED SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_rfsd_sputnikv_scnd_prov') }}</span> <!-- REFUSED SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_wstge_sputnikv_scnd_prov') }}</span> <!-- WASTAGE SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_p_cvrge_sputnikv_scnd_prov') }}%</span> <!-- PERCENT_COVERAGE_SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_c_rate_sputnikv_scnd_prov') }}%</span> <!-- CONSUMPTION RATE SPUTNIKV_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_r_unvcted_scnd_sputnikv_prov') }}</span> <!-- REMAINING UNVACCINATED SPUTNIKV_SECOND -->
        </td>
    </tr>
    </tbody>

    <!-- PFIZER -->
    <tbody id="collapse_pfizer_grand" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #8fe7fd">
        <td rowspan="2">

        </td> <!-- 1-5 -->
        <td rowspan="2">{{ Session::get('total_e_pop_pfizer_a1_prov') }}</td><!-- A1 PFIZER_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_pfizer_a2_prov') }}</td><!-- A2 PFIZER_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_pfizer_a3_prov') }}</td><!-- A3 PFIZER_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_pfizer_a4_prov') }}</td><!-- A4 PFIZER_FIRST -->
        <td rowspan="2">{{ Session::get('total_e_pop_pfizer_prov') }} <!-- TOTAL ELI POP PFIZER_FIRST -->
        </td>
        <td rowspan="2">{{ Session::get('total_vallocated_pfizer_frst_prov') }} </td> <!-- VACCINE ALLOCATED (FD) PFIZER_FIRST -->
        <td rowspan="2">{{ Session::get('total_vallocated_pfizer_scnd_prov') }} </td>  <!-- VACCINE ALLOCATED (SD) PFIZER_FIRST -->
        <td rowspan="2"> {{ Session::get('total_vallocated_pfizer') }}</td>  <!-- TOTAL VACCINE ALLOCATED PFIZER_FIRST -->
        <td>
            <span class="label label-success">{{ Session::get('total_pfizer_a1_frst_prov') }}</span>   <!-- VACCINATED (A1) PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_pfizer_a2_frst_prov') }}</span>  <!-- VACCINATED (A2) PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_pfizer_a3_frst_prov') }}</span>  <!-- VACCINATED (A3) PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_pfizer_a4_frst_prov') }}</span>  <!-- VACCINATED (A4) PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_vcted_pfizer_frst') }}</span> <!-- TOTAL VACCINATED PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_mild_pfizer_frst_prov') }}</span> <!-- MILD PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_srs_pfizer_frst_prov') }}</span> <!-- SERIOUS PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_dfrd_pfizer_frst_prov') }}</span> <!-- DEFERRED PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_rfsd_pfizer_frst_prov') }}</span> <!-- REFUSED PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_wstge_pfizer_frst_prov') }}</span> <!-- WASTAGE PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_p_cvrge_pfizer_frst_prov') }}%</span> <!-- PERCENT_COVERAGE PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_c_rate_pfizer_frst_prov') }}%</span> <!-- CONSUMPTION RATE PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">{{ Session::get('total_r_unvcted_frst_pfizer_prov') }}</span> <!-- REMAINUNG UNVACCINATED PFIZER_FIRST -->
        </td>
    </tr>
    <tr style="background-color: #8fe7fd">
        <td>
            <span class="label label-warning">{{ Session::get('total_pfizer_a1_scnd_prov') }}</span>   <!-- VACCINATED (A1) PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_pfizer_a2_scnd_prov') }}</span> <!-- VACCINATED (A2) PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_pfizer_a3_scnd_prov') }}</span> <!-- VACCINATED (A3) PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_pfizer_a4_scnd_prov') }}</span> <!-- VACCINATED (A4) PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_vcted_pfizer_second') }}</span> <!-- TOTAL VACCINATED PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_mild_pfizer_scnd_prov') }}</span> <!-- MILD PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_srs_pfizer_scnd_prov') }}</span> <!-- SERIOUS  PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_dfrd_pfizer_scnd_prov') }}</span> <!-- DEFERRED  PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_rfsd_pfizer_scnd_prov') }}</span> <!-- REFUSED  PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_wstge_pfizer_scnd_prov') }}</span> <!-- WASTAGE PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_p_cvrge_pfizer_scnd_prov') }}%</span> <!-- PERCENT COVERAGE  PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_c_rate_pfizer_scnd_prov') }}%</span> <!-- CONSUMPTION RATE PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">{{ Session::get('total_r_unvcted_scnd_pfizer_prov') }} </span> <!-- REMAINING UNVACCINATED  PFIZER_SECOND -->
        </td>
    </tr>
    </tbody>


    <tbody>
    <tr>
        <td>Total</td> <!-- 1-7 -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ Session::get('total_vallocated_frst_prov') }}</td>  <!-- TOTAL VACCINE ALLOCATED FIRST -->
        <td>{{ Session::get('total_vallocated_scnd_prov') }} </td> <!-- TOTAL VACCINE ALLOCATED SECOND -->
        <td>
            <b>{{ Session::get('total_vallocated') }} </b>  <!-- TOTAL VACCINE ALLOCATED  -->
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a1_first') }}</b> <!-- TOTAL VACCINATED (A1) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a2_first') }}</b>  <!-- TOTAL VACCINATED (A2) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a3_first') }}</b>  <!-- TOTAL VACCINATED (A3) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a4_first') }}</b>  <!-- TOTAL VACCINATED (A4) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_vcted_overall_frst') }}</b>  <!-- TOTAL VACCINATED OVERALL FIRST -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_mild_overall_frst') }}</b>  <!-- TOTAL MILD OVERALL FIRST-->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_srs_overall_frst') }}</b>  <!-- TOTAL SERIOUS OVERALL FIRST -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_dfrd_overall_frst') }}</b>  <!-- TOTAL DEFERRED OVERALL FIRST -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_rfsd_overall_frst') }}</b>  <!-- TOTAL REFUSED OVERALL FIRST-->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_wstge_overall_frst') }}</b>  <!-- TOTAL WASTAGE OVREALL FIRST-->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_p_cvrge_frst_prov') }}%</b>  <!-- TOTAL PERCENT_COVERAGE -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_c_rate_frst_prov') }}% </b>  <!-- TOTAL CONSUMPTION RATE -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">{{ Session::get('total_r_unvcted_all_frst_prov') }}</b>  <!-- TOTAL REMAINUNG UNVACCINATED  -->
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
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a1_second') }}</b> <!-- TOTAL VACCINATED GRAND A1 SECOND DOSE -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a2_second') }}</b><!-- TOTAL VACCINATED GRAND A2 SECOND DOSE -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a3_second') }}</b>  <!-- TOTAL VACCINATED GRAND A3 SECOND DOSE  -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_vcted_grand_a4_second') }}</b>  <!-- TOTAL VACCINATED GRAND A4 SECOND DOSE  -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_vcted_overall_second') }}</b> <!-- TOTAL VACCINATED OVERALL SECOND -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_mild_overall_scnd') }}</b> <!-- TOTAL MILD OVERALL SECOND-->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_srs_overall_scnd') }}</b> <!-- TOTAL SERIOUS OVERALL SECOND -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_dfrd_overall_scnd') }}</b> <!-- TOTAL DEFERRED OVERALL SECOND -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_rfsd_overall_frst') }}</b> <!-- TOTAL REFUSED OVERALL SECOND-->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_wstge_overall_scnd') }}</b> <!-- TOTAL WASTAGE OVERALL SECOND-->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_p_cvrge_scnd_prov') }}%</b> <!-- TOTAL PERCENT_COVERAGE OVERALL SECOND -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%"> {{ Session::get('total_c_rate_scnd_prov') }}%</b> <!-- TOTAL CONSUMPTION RATE OVERALL SECOND -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">{{ Session::get('total_r_unvcted_all_scnd_prov') }}</b> <!-- TOTAL REMAINING UNVACCIANTED  OVERALL SECOND  -->
        </td>
    </tr>
    </tbody>
</table>