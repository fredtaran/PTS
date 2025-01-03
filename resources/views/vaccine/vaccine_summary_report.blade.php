<center>
    <b style="font-size:20pt">
        CENTRAL VISAYAS COVID-19 VACCINATION SUMMARY REPORT
    </b><br>
    <b style="font-size:17pt">
        Data via SMS from Implementing Units as of
    </b><br>
    <b style="font-size:17pt" class="text-blue">
        {{ date('F d, Y')  }}
    </b><br><br>
</center>

<style>
    td,th {
        text-align: center;
    }
</style>
<div class="table-responsive">
    <table style="font-size: 8pt;" class="table" border="2">
        <thead>
        <tr style="background-color: #fbe4d5">
            <th><b style="font-size: 10pt">Province</b></th>
            <th colspan="5"><b style="font-size: 10pt">Vaccine Allocation</b></th>
            <th colspan="1"><b style="font-size: 10pt">Eligible Population {{ $priority_set }}</b></th>
            <th colspan="10"><b style="font-size: 10pt">Vaccinated</b></th>
            <th colspan="2"><b style="font-size: 10pt">Total Refusal</b></th>
            <th colspan="2"><b style="font-size: 10pt">Total Deferral</b></th>
            <th colspan="5"><b style="font-size: 10pt">Wastage</b></th>
            <th colspan="5"><b style="font-size: 10pt">1st dose % Coverage(Total 1st dose Vaccinated / Total Eligible {{ $priority_set }})</b></th>
            <th colspan="5"><b style="font-size: 10pt">2nd dose % Coverage(Total 1st dose Vaccinated / Total Eligible {{ $priority_set }})</b></th>
            <th colspan="5"><b style="font-size: 10pt">1st dose Consumption Rate</b></th>
            <th colspan="5"><b style="font-size: 10pt">2nd dose Consumption Rate</b></th>
        </tr>
        <tr style="background-color: #fbe4d5;">
            <td></td>
            <td>Sinovac</td>
            <td>Astra</td>
            <td>Sputnikv</td>
            <td>Pfizer</td>
            <td><b>Total</b></td>
            <td></td>
            <td>1st Dose Sinovac</td>
            <td>2nd Dose Sinovac</td>
            <td>1st Dose AZ</td>
            <td>2nd Dose AZ</td>
            <td>1st Dose Sputnikv</td>
            <td>2nd Dose Sputnikv</td>
            <td>1st Dose Pfizer</td>
            <td>2nd Dose Pfizer</td>
            <td><b>(1st Dose Total)</b></td>
            <td><b>(2nd Dose Total)</b></td>
            <td>1st Dose</td>
            <td>2nd Dose</td>
            <td>1st Dose</td>
            <td>2nd Dose</td>
            <td>Sinovac</td>
            <td>Astra</td>
            <td>Sputnikv</td>
            <td>Pfizer</td>
            <td><b>(Total Wastage)</b></td>
            <td>Sinovac</td>
            <td>Astra</td>
            <td>Sputnikv</td>
            <td>Pfizer</td>
            <td><b>(Total Percent Coverage)</b></td>
            <td>Sinovac</td>
            <td>Astra</td>
            <td>Sputnikv</td>
            <td>Pfizer</td>
            <td><b>(Total Percent Coverage)</b></td>
            <td>Sinovac</td>
            <td>AZ</td>
            <td>Sputnikv</td>
            <td>Pfizer</td>
            <td><b>(Total Consumption Rate)</b></td>
            <td>Sinovac</td>
            <td>AZ</td>
            <td>Sputnikv</td>
            <td>Pfizer</td>
            <td><b>(Total Consumption Rate)</b></td>
        </tr>
        <tr style="background-color: #e2efd9">
            <td>Region 7</td>
            <td>{{ $sinovac_region }}</td> <!-- VACCINE ALLOCATED SINOVAC REGION -->
            <td>{{ $astra_region }}</td> <!-- VACCINE ALLOCATED ASTRA REGION -->
            <td>{{ $sputnikv_region }}</td> <!-- VACCINE ALLOCATED SPUTNIKV REGION -->
            <td>{{ $pfizer_region }}</td> <!-- VACCINE ALLOCATED PFIZER REGION -->
            <td>{{ $total_region }}</td> <!-- VACCINE ALLOCATED TOTAL REGION -->
            <td>{{ $total_elipop_region }}</td> <!-- TOTAL ELIGBLE_POP REGION -->
            <td>{{ $region_sinovac_first_dose }}</td> <!-- VACCINATED SINOVAC_FIRST REGION -->
            <td>{{ $region_sinovac_second_dose }}</td>  <!-- VACCINATED SINOVAC_SECOND REGION -->
            <td>{{ $region_astra_first_dose }}</td> <!-- VACCINATED ASTRA_FIRST REGION -->
            <td>{{ $region_astra_second_dose }}</td>  <!-- VACCINATED ASTRA_SECOND REGION -->
            <td>{{ $region_sputnikv_first_dose }}</td> <!-- VACCINATED SPUTNIKV_FIRST REGION -->
            <td>{{ $region_sputnikv_second_dose }}</td> <!-- VACCINATED SPUTNIKV_SECOND REGION -->
            <td>{{ $region_pfizer_first_dose }}</td> <!-- VACCINATED PFIZER_FIRST REGION -->
            <td>{{ $region_pfizer_second_dose }}</td> <!-- VACCINATED PFIZER_SECOND REGION -->
            <td>{{ $first_dose_total }}</td> <!-- TOTAL VACCINATED FIRST REGION -->
            <td>{{ $second_dose_total }}</td> <!-- TOTAL VACCINATED SECOND REGION -->
            <td>{{ $total_refusal_first }}</td> <!--  REFUSED FIRST REGION -->
            <td>{{$total_refusal_second}}</td> <!--  REFUSED SECOND REGION -->
            <td>{{$total_deferred_first}}</td> <!--  DEFERRED FIRST REGION -->
            <td>{{$total_deferred_second}}</td> <!--  DEFERRED SECOND REGION -->
            <td>{{$wastage_sinovac_first}}</td> <!--  WASTAGE SINOVAC REGION -->
            <td>{{$wastage_astra_first}}</td> <!--  WASTAGE ASTRA  REGION -->
            <td>{{$wastage_sputnikv_first}}</td> <!--  WASTAGE SPUTNIKV  REGION -->
            <td>{{$wastage_pfizer_first}}</td> <!--  WASTAGE PFIZER REGION -->
            <td>{{$wastage_region}}</td>   <!-- TOTAL WASTAGE REGION -->
            <td>{{ $total_p_cvrge_sinovac_region_first }}%</td> <!-- TOTAL PERCENT COVERAGE SINOVAC FIRST REGION -->
            <td>{{$total_p_cvrge_astra_region_first}}%</td> <!-- TOTAL PERCENT COVERAGE ASTRA FIRST REGION -->
            <td>{{$total_p_cvrge_sputnikv_region_first}}%</td> <!-- TOTAL PERCENT COVERAGE SPUTNIKV FIRST REGION -->
            <td>{{$total_p_cvrge_pfizer_region_first}}%</td> <!-- TOTAL PERCENT COVERAGE PFIZER FIRST REGION -->
            <td>{{ $total_p_cvrge_region_first }}%</td> <!-- TOTAL PERCENT COVERAGE FIRST REGION -->
            <td>{{ $total_p_cvrge_sinovac_region_second }}%</td> <!-- TOTAL PERCENT COVERAGE SINOVAC SECOND REGION -->
            <td>{{$total_p_cvrge_astra_region_second}}%</td> <!-- TOTAL PERCENT COVERAGE ASTRA SECOND REGION -->
            <td>{{$total_p_cvrge_sputnikv_region_second}}%</td> <!-- TOTAL PERCENT COVERAGE SPUTNIKV SECOND REGION -->
            <td>{{$total_p_cvrge_pfizer_region_second}}%</td> <!-- TOTAL PERCENT COVERAGE PFIZER SECOND REGION -->
            <td>{{ $total_p_cvrge_region_second }}%</td> <!-- TOTAL PERCENT COVERAGE SECOND REGION -->
            <td>{{ $c_rate_region_sinovac_first }}%</td>  <!-- CONSUMPTION RATE SINOVAC FIRST REGION -->
            <td>{{ $c_rate_region_astra_first }}%</td> <!-- CONSUMPTION RATE ASTRA FIRST REGION -->
            <td>{{ $c_rate_region_sputnikv_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST REGION -->
            <td>{{ $c_rate_region_pfizer_first }}%</td> <!-- CONSUMPTION RATE PFIZER FIRST REGION -->
            <td>{{ $total_c_rate_region_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST REGION -->
            <td>{{ $c_rate_region_sinovac_second }}%</td>  <!-- CONSUMPTION RATE SINOVAC SECOND REGION -->
            <td>{{ $c_rate_region_astra_second }}%</td>  <!-- CONSUMPTION RATE ASTRA SECOND REGION -->
            <td>{{ $c_rate_region_sputnikv_second }}%</td>  <!-- CONSUMPTION RATE SPUTNIKV SECOND REGION -->
            <td>{{ $c_rate_region_pfizer_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND REGION -->
            <td>{{ $total_c_rate_region_second }}%</td> <!-- TOTAL CONSUMPTION RATE SECOND REGION -->
        </tr>
        <tr>
            <td>Bohol</td>
            <td>{{ $sinovac_bohol }}</td> <!-- VACCINE ALLOCATED SINOVAC BOHOL -->
            <td>{{ $astra_bohol }}</td>  <!-- VACCINE ALLOCATED ASTRA BOHOL -->
            <td>{{ $sputnikv_bohol }}</td> <!-- VACCINE ALLOCATED SPUTNIKV BOHOL -->
            <td>{{ $pfizer_bohol }}</td>  <!-- VACCINE ALLOCATED PFIZER BOHOL -->
            <td>{{ $total_bohol }}</td>  <!-- TOTAL VACCINE ALLOCATED BOHOL -->
            <td>{{ $eli_pop_bohol }}</td> <!-- TOTAL ELIGIBLE POP BOHOL -->
            <td>{{ $vcted_sinovac_bohol_first }}</td> <!-- VACCINATED SINOVAC_FIRST BOHOL -->
            <td>{{ $vcted_sinovac_bohol_second }}</td> <!-- VACCINATED SINOVAC_SECOND BOHOL -->
            <td>{{ $vcted_astra_bohol_first }}</td>  <!-- VACCINATED ASTRA_FIRST BOHOL -->
            <td>{{ $vcted_astra_bohol_second }}</td> <!-- VACCINATED ASTRA_SECOND BOHOL -->
            <td>{{ $vcted_sputnikv_bohol_first }}</td> <!-- VACCINATED SPUTNIKV_FIRST BOHOL -->
            <td>{{ $vcted_sputnikv_bohol_second }}</td> <!-- VACCINATED SPUTNIKV_SECOND BOHOL -->
            <td>{{ $vcted_pfizer_bohol_first }}</td> <!-- VACCINATED PFIZER_FIRST BOHOL -->
            <td>{{ $vcted_pfizer_bohol_second }}</td> <!-- VACCINATED PFIZER_SECOND BOHOL -->
            <td>{{ $total_vcted_first_bohol}}</td> <!-- TOTAL VACCINATED FIRST BOHOL -->
            <td>{{ $total_vcted_second_bohol }}</td> <!-- TOTAL VACCINATED SECOND BOHOL -->
            <td>{{ $refused_first_bohol }}</td> <!--  REFUSED FIRST BOHOL -->
            <td>{{ $refused_second_bohol }}</td> <!--  REFUSED SECOND BOHOL -->
            <td>{{ $deferred_first_bohol }}</td> <!--  DEFERRED FIRST BOHOL -->
            <td>{{ $deferred_second_bohol }}</td> <!--  DEFERRED SECOND BOHOL -->
            <td>{{ $wastage_sinovac_bohol_first }}</td> <!-- WASTAGE SINOVAC FIRST BOHOL -->
            <td>{{ $wastage_astra_bohol_first }}</td> <!--  WASTAGE ASTRA FIRST BOHOL -->
            <td>{{ $wastage_sputnikv_bohol_first }}</td> <!--  WASTAGE SPUTNIKV FIRST BOHOL -->
            <td>{{ $wastage_pfizer_bohol_first }}</td> <!--  WASTAGE PFIZER FIRST BOHOL -->
            <td>{{$total_wastage_bohol}}</td> <!--  TOTAL WASTAGE FIRST BOHOL -->
            <td>{{ $p_cvrge_sinovac_bohol_first }}%</td> <!--  PERCENT COVERAGE SINOVAC FIRST BOHOL -->
            <td>{{ $p_cvrge_astra_bohol_first }}%</td> <!--  PERCENT COVERAGE ASTRA FIRST BOHOL -->
            <td>{{ $p_cvrge_sputnikv_bohol_first }}%</td> <!--  PERCENT COVERAGE SPUTNIKV FIRST BOHOL -->
            <td>{{ $p_cvrge_pfizer_bohol_first }}%</td> <!--  PERCENT COVERAGE PFIZER FIRST BOHOL -->
            <td>{{ $total_p_cvrge_bohol_first }}%</td> <!--  TOTAL PERCENT COVERAGE FIRST BOHOL -->
            <td>{{ $p_cvrge_sinovac_bohol_second }}%</td> <!--  PERCENT COVERAGE SINOVAC SECOND BOHOL -->
            <td>{{ $p_cvrge_astra_bohol_second }}%</td> <!--  PERCENT COVERAGE ASTRA SECOND BOHOL -->
            <td>{{ $p_cvrge_sputnikv_bohol_second }}%</td> <!--  PERCENT COVERAGE SPUTNIKV SECOND BOHOL -->
            <td>{{ $p_cvrge_pfizer_bohol_second }}%</td> <!--  PERCENT COVERAGE PFIZER SECOND BOHOL -->
            <td>{{ $total_p_cvrge_bohol_second }}%</td> <!--  TOTAL PERCENT COVERAGE SECOND BOHOL -->
            <td>{{ $c_rate_sinovac_bohol_first }}%</td> <!-- CONSUMPTION RATE SINOVAC FIRST BOHOL -->
            <td>{{ $c_rate_astra_bohol_first }}%</td> <!-- CONSUMPTION RATE ASTRA FIRST BOHOL -->
            <td>{{ $c_rate_sputnikv_bohol_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST BOHOL -->
            <td>{{ $c_rate_pfizer_bohol_first }}%</td> <!-- CONSUMPTION RATE PFIZER FIRST BOHOL -->
            <td>{{ $total_c_rate_bohol_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST BOHOL -->
            <td>{{ $c_rate_sinovac_bohol_second }}%</td> <!-- CONSUMPTION RATE SINOVAC SECOND BOHOL -->
            <td>{{ $c_rate_astra_bohol_second }}%</td> <!-- CONSUMPTION RATE ASTRA SECOND BOHOL -->
            <td>{{ $c_rate_sputnikv_bohol_second }}%</td> <!-- CONSUMPTION RATE SPUTNIKV SECOND BOHOL -->
            <td>{{ $c_rate_pfizer_bohol_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND BOHOL -->
            <td>{{ $total_c_rate_bohol_second }}%</td>  <!-- TOTAL CONSUMPTION RATE SECOND BOHOL -->
        </tr>
        <tr>
            <td>Cebu</td>
            <td>{{ $sinovac_cebu }}</td> <!-- VACCINE ALLOCATED SINOVAC CEBU -->
            <td>{{ $astra_cebu }}</td> <!-- VACCINE ALLOCATED ASTRA CEBU -->
            <td>{{ $sputnikv_cebu }}</td> <!-- VACCINE ALLOCATED SPUTNIKV CEBU -->
            <td>{{ $pfizer_cebu }}</td> <!-- VACCINE ALLOCATED PFIZER CEBU -->
            <td>{{ $total_cebu }}</td> <!-- TOTAL VACCINE ALLOCATED CEBU -->
            <td>{{ $eli_pop_cebu }}</td> <!-- ELIGIBLE POP CEBU -->
            <td>{{ $vcted_sinovac_cebu_first }}</td> <!-- VACCINATED SINOVAC_FIRST CEBU -->
            <td>{{ $vcted_sinovac_cebu_second }}</td> <!-- VACCINATED SINOVAC_SECOND CEBU -->
            <td>{{ $vcted_astra_cebu_first }}</td>  <!-- VACCINATED ASTRA_FIRST CEBU -->
            <td>{{ $vcted_astra_cebu_second }}</td> <!-- VACCINATED ASTRA_SECOND CEBU -->
            <td>{{ $vcted_sputnikv_cebu_first }}</td> <!-- VACCINATED SPUNTIKV_FIRST CEBU -->
            <td>{{ $vcted_sputnikv_cebu_second }}</td> <!-- VACCINATED SPUTNIKV_SECOND CEBU -->
            <td>{{ $vcted_pfizer_cebu_first }}</td> <!-- VACCINATED PFIZER_FIRST CEBU -->
            <td>{{ $vcted_pfizer_cebu_second }}</td> <!-- VACCINATED PFIZER_SECOND CEBU -->
            <td>{{ $total_vcted_first_cebu}}</td> <!-- TOTAL VACCINATED FIRST CEBU -->
            <td>{{ $total_vcted_second_cebu }}</td> <!-- TOTAL VACCINATED SECOND CEBU -->
            <td>{{ $refused_first_cebu }}</td> <!--  REFUSED FIRST CEBU -->
            <td>{{ $refused_second_cebu }}</td> <!--  REFUSED SECOND CEBU -->
            <td>{{ $deferred_first_cebu }}</td> <!--  DEFERRED FIRST CEBU -->
            <td>{{ $deferred_second_cebu }}</td> <!-- DEFERRED SECOND CEBU -->
            <td>{{ $wastage_sinovac_cebu_first }}</td> <!-- WASTAGE SINOVAC CEBU -->
            <td>{{ $wastage_astra_cebu_first }}</td> <!-- WASTAGE ASTRA CEBU -->
            <td>{{ $wastage_sputnikv_cebu_first }}</td> <!-- WASTAGE SPUTNIKV CEBU -->
            <td>{{ $wastage_pfizer_cebu_first }}</td> <!-- WASTAGE PFIZER CEBU -->
            <td>{{$total_wastage_cebu}}</td> <!-- TOTAL WASTAGE CEBU -->
            <td>{{ $p_cvrge_sinovac_cebu_first }}%</td> <!-- PERCENT COVERAGE SINOVAC FIRST CEBU -->
            <td>{{ $p_cvrge_astra_cebu_first }}%</td> <!-- PERCENT COVERAGE ASTRA FIRST CEBU -->
            <td>{{ $p_cvrge_sputnikv_cebu_first }}%</td> <!-- PERCENT COVERAGE SPUTNIKV FIRST CEBU -->
            <td>{{ $p_cvrge_pfizer_cebu_first }}%</td> <!-- PERCENT COVERAGE PFIZER FIRST CEBU -->
            <td>{{ $total_p_cvrge_cebu_first }}%</td> <!-- TOTAL PERCENT COVERAGE FIRST CEBU -->
            <td>{{ $p_cvrge_sinovac_cebu_second }}%</td> <!-- PERCENT COVERAGE SINOVAC SECOND CEBU -->
            <td>{{ $p_cvrge_astra_cebu_second }}%</td>  <!-- PERCENT COVERAGE ASTRA SECOND CEBU -->
            <td>{{ $p_cvrge_sputnikv_cebu_second }}%</td> <!-- PERCENT COVERAGE SPUTNIKV SECOND CEBU -->
            <td>{{ $p_cvrge_pfizer_cebu_second }}%</td> <!-- PERCENT COVERAGE PFIZER SECOND CEBU -->
            <td>{{ $total_p_cvrge_cebu_second }}%</td> <!-- TOTAL PERCENT COVERAGE SECOND CEBU -->
            <td>{{ $c_rate_sinovac_cebu_first }}%</td> <!-- CONSUMPTION RATE SINOVAC FIRST CEBU -->
            <td>{{ $c_rate_astra_cebu_first }}%</td> <!-- CONSUMPTION RATE ASTRA FIRST CEBU -->
            <td>{{ $c_rate_sputnikv_cebu_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST CEBU -->
            <td>{{ $c_rate_pfizer_cebu_first }}%</td> <!-- CONSUMPTION RATE PFIZER FIRST CEBU -->
            <td>{{ $total_c_rate_cebu_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST CEBU -->
            <td>{{ $c_rate_sinovac_cebu_second }}%</td> <!-- CONSUMPTION RATE SINOVAC SECOND CEBU -->
            <td>{{ $c_rate_astra_cebu_second }}%</td> <!-- CONSUMPTION RATE ASTRA SECOND CEBU -->
            <td>{{ $c_rate_sputnikv_cebu_second }}%</td> <!-- CONSUMPTION RATE SPUTNIKV SECOND CEBU -->
            <td>{{ $c_rate_pfizer_cebu_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND CEBU -->
            <td>{{ $total_c_rate_cebu_second }}%</td> <!-- TOTAL CONSUMPTION RATE SECOND CEBU -->
        </tr>
        <tr>
            <td>Negros Or.</td>
            <td>{{ $sinovac_negros }}</td> <!-- VACCINE ALLOCATED SINOVAC NEGROS -->
            <td>{{ $astra_negros }}</td>  <!-- VACCINE ALLOCATED ASTRA NEGROS -->
            <td>{{ $sputnikv_negros }}</td> <!-- VACCINE ALLOCATED SPUTNIKV NEGROS -->
            <td>{{ $pfizer_negros }}</td> <!-- VACCINE ALLOCATED PFIZER NEGROS -->
            <td>{{ $total_negros }}</td> <!-- TOTAL VACCINE ALLOCATED NEGROS -->
            <td>{{ $eli_pop_negros }}</td> <!-- ELIGIBLE POP NEGROS -->
            <td>{{ $vcted_sinovac_negros_first }}</td> <!-- VACCINATED SINOVAC_FIRST NEGROS -->
            <td>{{ $vcted_sinovac_negros_second }}</td> <!-- VACCINATED SINOVAC_SECOND NEGROS -->
            <td>{{ $vcted_astra_negros_first }}</td> <!-- VACCINATED ASTRA_FIRST NEGROS -->
            <td>{{ $vcted_astra_negros_second }}</td> <!-- VACCINATED ASTRA_SECOND NEGROS -->
            <td>{{ $vcted_sputnikv_negros_first }}</td> <!-- VACCINATED SPUNTIKV_FIRST NEGROS -->
            <td>{{ $vcted_sputnikv_negros_second }}</td> <!-- VACCINATED SPUTNIKV_SECOND NEGROS -->
            <td>{{ $vcted_pfizer_negros_first }}</td> <!-- VACCINATED PFIZER_FIRST NEGROS -->
            <td>{{ $vcted_pfizer_negros_second }}</td> <!-- VACCINATED PFIZER_SECOND NEGROS -->
            <td>{{ $total_vcted_first_negros}}</td> <!-- TOTAL VACCINATED FIRST NEGROS -->
            <td>{{ $total_vcted_second_negros }}</td> <!-- TOTAL VACCINATED SECOND NEGROS -->
            <td>{{ $refused_first_negros }}</td>  <!-- REFUSED FIRST NEGROS -->
            <td>{{ $refused_second_negros }}</td> <!-- REFUSED SECOND NEGROS -->
            <td>{{ $deferred_first_negros }}</td> <!-- DEFERRED FIRST NEGROS -->
            <td>{{ $deferred_second_negros }}</td> <!-- DEFERRED SECOND NEGROS -->
            <td>{{ $wastage_sinovac_negros_first }}</td> <!-- WASTAGE SINOVAC NEGROS -->
            <td>{{ $wastage_astra_negros_first }}</td>  <!-- WASTAGE ASTRA NEGROS -->
            <td>{{ $wastage_sputnikv_negros_first }}</td> <!-- WASTAGE SPUTNIKV NEGROS -->
            <td>{{ $wastage_pfizer_negros_first }}</td> <!-- WASTAGE PFIZER NEGROS -->
            <td>{{$total_wastage_negros}}</td> <!-- TOTAL WASTAGE NEGROS -->
            <td>{{ $p_cvrge_sinovac_negros_first }}%</td> <!-- PERCENT COVERAGE SINOVAC FIRST NEGROS -->
            <td>{{ $p_cvrge_astra_negros_first }}%</td> <!-- PERCENT COVERAGE ASTRA FIRST NEGROS -->
            <td>{{ $p_cvrge_sputnikv_negros_first }}%</td> <!-- PERCENT COVERAGE SPUTNIKV FIRST NEGROS -->
            <td>{{ $p_cvrge_pfizer_negros_first }}%</td> <!-- PERCENT COVERAGE PFIZER FIRST NEGROS -->
            <td>{{ $total_p_cvrge_negros_first }}%</td>  <!-- TOTAL PERCENT COVERAGE FIRST NEGROS -->
            <td>{{ $p_cvrge_sinovac_negros_second }}%</td> <!-- PERCENT COVERAGE SINOVAC SECOND NEGROS -->
            <td>{{ $p_cvrge_astra_negros_second }}%</td>  <!-- PERCENT COVERAGE ASTRA SECOND NEGROS -->
            <td>{{ $p_cvrge_sputnikv_negros_second }}%</td> <!-- PERCENT COVERAGE SPUTNIKV SECOND NEGROS -->
            <td>{{ $p_cvrge_pfizer_negros_second }}%</td>  <!-- PERCENT COVERAGE PFIZER SECOND NEGROS -->
            <td>{{ $total_p_cvrge_negros_second }}%</td> <!-- TOTAL PERCENT COVERAGE SECOND NEGROS -->
            <td>{{ $c_rate_sinovac_negros_first }}%</td> <!-- CONSUMPTION RATE SINOVAC FIRST NEGROS -->
            <td>{{ $c_rate_astra_negros_first }}%</td> <!-- CONSUMPTION RATE ASTRA FIRST NEGROS -->
            <td>{{ $c_rate_sputnikv_negros_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST NEGROS -->
            <td>{{ $c_rate_pfizer_negros_first }}%</td> <!-- CONSUMPTION RATE PFIZER FIRST NEGROS -->
            <td>{{ $total_c_rate_negros_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST NEGROS -->
            <td>{{ $c_rate_sinovac_negros_second }}%</td> <!-- CONSUMPTION RATE SINOVAC SECOND NEGROS -->
            <td>{{ $c_rate_astra_negros_second }}%</td> <!-- CONSUMPTION RATE ASTRA SECOND NEGROS -->
            <td>{{ $c_rate_sputnikv_negros_second }}%</td> <!-- CONSUMPTION RATE SPUTNIKV SECOND NEGROS -->
            <td>{{ $c_rate_pfizer_negros_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND NEGROS -->
            <td>{{ $total_c_rate_negros_second }}%</td> <!-- TOTAL CONSUMPTION RATE SECOND NEGROS -->
        </tr>
        <tr>
            <td>Siquijor</td>
            <td>{{ $sinovac_siquijor }}</td> <!-- VACCINE ALLOCATED SINOVAC SIQUIJOR -->
            <td>{{ $astra_siquijor }}</td> <!-- VACCINE ALLOCATED ASTRA SIQUIJOR -->
            <td>{{ $sputnikv_siquijor }}</td> <!-- VACCINE ALLOCATED SPUTNIKV SIQUIJOR -->
            <td>{{ $pfizer_siquijor }}</td> <!-- VACCINE ALLOCATED PFIZER SIQUIJOR -->
            <td>{{ $total_siquijor }}</td> <!-- TOTAL VACCINE ALLOCATED SIQUIJOR-->
            <td>{{ $eli_pop_siquijor }}</td> <!-- ELIGIBLE POP SIQUIJOR  -->
            <td>{{ $vcted_sinovac_siquijor_first }}</td> <!-- VACCINATED SINOVAC_FIRST SIQUIJOR -->
            <td>{{ $vcted_sinovac_siquijor_second }}</td> <!-- VACCINATED SINOVAC_SECOND SIQUIJOR -->
            <td>{{ $vcted_astra_siquijor_first }}</td> <!-- VACCINATED ASTRA_FIRST SIQUIJOR -->
            <td>{{ $vcted_astra_siquijor_second }}</td> <!-- VACCINATED ASTRA_SECOND SIQUIJOR -->
            <td>{{ $vcted_sputnikv_siquijor_first }}</td> <!-- VACCINATED SPUTNIKV_FIRST SIQUIJOR -->
            <td>{{ $vcted_sputnikv_siquijor_second }}</td> <!-- VACCINATED SPUTNIKV_SECOND SIQUIJOR -->
            <td>{{ $vcted_pfizer_siquijor_first }}</td> <!-- VACCINATED PFIZER_FIRST SIQUIJOR -->
            <td>{{ $vcted_pfizer_siquijor_second }}</td> <!-- VACCINATED PFIZER_SECOND SIQUIJOR -->
            <td>{{ $total_vcted_first_siquijor}}</td> <!-- TOTAL VACCINATED FIRST SIQUIJOR -->
            <td>{{ $total_vcted_second_siquijor }}</td> <!-- TOTAL VACCINATED SECOND SIQUIJOR -->
            <td>{{ $refused_first_siquijor }}</td> <!-- REFUSED FIRST SIQUIJOR -->
            <td>{{ $refused_second_siquijor }}</td> <!-- REFUSED SECOND SIQUIJOR -->
            <td>{{ $deferred_first_siquijor }}</td> <!-- DEFERRED FIRST SIQUIJOR -->
            <td>{{ $deferred_second_siquijor }}</td> <!-- DEFERRED SECOND SIQUIJOR -->
            <td>{{ $wastage_sinovac_siquijor_first }}</td> <!-- WASTAGE SINOVAC SIQUIJOR -->
            <td>{{ $wastage_astra_siquijor_first }}</td> <!-- WASTAGE ASTRA SIQUIJOR -->
            <td>{{ $wastage_sputnikv_siquijor_first }}</td> <!-- WASTAGE SPUTNIKV SIQUIJOR -->
            <td>{{ $wastage_pfizer_siquijor_first }}</td> <!-- WASTAGE PFIZER SIQUIJOR -->
            <td>{{$total_wastage_siquijor}}</td> <!-- TOTAL WASTAGE SIQUIJOR -->
            <td>{{ $p_cvrge_sinovac_siquijor_first }}%</td> <!-- PERCENT COVERAGE SINOVAC FIRST SIQUIJOR -->
            <td>{{ $p_cvrge_astra_siquijor_first }}%</td> <!-- PERCENT COVERAGE ASTRA FIRST SIQUIJOR -->
            <td>{{ $p_cvrge_sputnikv_siquijor_first }}%</td> <!-- PERCENT COVERAGE SPUTNIKV FIRST SIQUIJOR -->
            <td>{{ $p_cvrge_pfizer_siquijor_first }}%</td> <!-- PERCENT COVERAGE PFIZER FIRST SIQUIJOR -->
            <td>{{ $total_p_cvrge_siquijor_first }}%</td> <!-- TOTAL PERCENT COVERAGE FIRST SIQUIJOR -->
            <td>{{ $p_cvrge_sinovac_siquijor_second }}%</td> <!-- PERCENT COVERAGE SINOVAC SECOND SIQUIJOR -->
            <td>{{ $p_cvrge_astra_siquijor_second }}%</td>  <!-- PERCENT COVERAGE ASTRA SECOND SIQUIJOR -->
            <td>{{ $p_cvrge_sputnikv_siquijor_second }}%</td>  <!-- PERCENT COVERAGE SPUTNIKV SECOND SIQUIJOR -->
            <td>{{ $p_cvrge_pfizer_siquijor_second }}%</td> <!-- PERCENT COVERAGE PFIZER SECOND SIQUIJOR -->
            <td>{{ $total_p_cvrge_siquijor_second }}%</td> <!-- TOTAL PERCENT COVERAGE SECOND SIQUIJOR -->
            <td>{{ $c_rate_sinovac_siquijor_first }}%</td> <!-- CONSUMPTION RATE SINOVAC FIRST SIQUIJOR -->
            <td>{{ $c_rate_astra_siquijor_first }}%</td> <!-- CONSUMPTION RATE ASTRA FIRST SIQUIJOR -->
            <td>{{ $c_rate_sputnikv_siquijor_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST SIQUIJOR -->
            <td>{{ $c_rate_pfizer_siquijor_first }}%</td> <!-- CONSUMPTION RATE PFIZER FIRST SIQUIJOR -->
            <td>{{ $total_c_rate_siquijor_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST SIQUIJOR -->
            <td>{{ $c_rate_sinovac_siquijor_second }}%</td> <!-- CONSUMPTION RATE SINOVAC SECOND SIQUIJOR -->
            <td>{{ $c_rate_astra_siquijor_second }}%</td> <!-- CONSUMPTION RATE ASTRA SECOND SIQUIJOR -->
            <td>{{ $c_rate_sputnikv_siquijor_second }}%</td> <!-- CONSUMPTION RATE SPUTNIKV SECOND SIQUIJOR -->
            <td>{{ $c_rate_pfizer_siquijor_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND SIQUIJOR -->
            <td>{{ $total_c_rate_siquijor_second }}%</td> <!-- TOTAL CONSUMPTION RATE SECOND SIQUIJOR -->
        </tr>
        <tr>
            <td>Cebu City</td>
            <td>{{ $sinovac_cebu_facility }}</td> <!-- VACCINE ALLOCATED SINOVAC CEBU FACILITY -->
            <td>{{ $astra_cebu_facility }}</td> <!-- VACCINE ALLOCATED ASTRA CEBU FACILITY -->
            <td>{{ $sputnikv_cebu_facility }}</td> <!-- VACCINE ALLOCATED SPUTNIKV CEBU FACILITY -->
            <td>{{ $pfizer_cebu_facility }}</td> <!-- VACCINE ALLOCATED PFIZER CEBU FACILITY -->
            <td>{{ $total_cebu_facility }}</td> <!-- TOTAL VACCINE ALLOCATED CEBU FACILITY -->
            <td>{{ $eli_pop_cebu_facility }}</td> <!-- ELIGIBLE POP CEBU FACILITY  -->
            <td>{{ $vcted_sinovac_cebu_facility_first }}</td> <!-- VACCINATED SINOVAC_FIRST CEBU FACILITY -->
            <td>{{ $vcted_sinovac_cebu_facility_second }}</td> <!-- VACCINATED SINOVAC_SECOND CEBU FACILITY -->
            <td>{{ $vcted_astra_cebu_facility_first }}</td> <!-- VACCINATED ASTRA_FIRST CEBU FACILITY -->
            <td>{{ $vcted_astra_cebu_facility_second }}</td> <!-- VACCINATED ASTRA_SECOND CEBU FACILITY -->
            <td>{{ $vcted_sputnikv_cebu_facility_first }}</td> <!-- VACCINATED SPUTNIKV_FIRST CEBU FACILITY -->
            <td>{{ $vcted_sputnikv_cebu_facility_second }}</td> <!-- VACCINATED SPUTNIKV_SECOND CEBU FACILITY -->
            <td>{{ $vcted_pfizer_cebu_facility_first }}</td> <!-- VACCINATED PFIZER_FIRST CEBU FACILITY -->
            <td>{{ $vcted_pfizer_cebu_facility_second }}</td> <!-- VACCINATED PFIZER_SECOND CEBU FACILITY -->
            <td>{{ $total_vcted_cebu_facility_first }}</td>  <!-- TOTAL VACCINATED FIRST CEBU FACILITY -->
            <td>{{ $total_vcted_cebu_facility_second }}</td> <!-- TOTAL VACCINATED SECOND CEBU FACILITY -->
            <td>{{ $refused_cebu_facility_first }}</td> <!-- REFUSED FIRST CEBU FACILITY -->
            <td>{{ $refused_cebu_facility_second }}</td> <!-- REFUSED SECOND CEBU FACILITY -->
            <td>{{ $deferred_cebu_facility_first }}</td> <!-- DEFERRED FIRST CEBU FACILITY -->
            <td>{{ $deferred_cebu_facility_second }}</td> <!-- DEFERRED SECOND CEBU FACILITY -->
            <td>{{ $wastage_sinovac_cebu_facility_first }}</td> <!-- WASTAGE SINOVAC CEBU FACILITY -->
            <td>{{ $wastage_astra_cebu_facility_first }}</td> <!-- WASTAGE ASTRA CEBU FACILITY -->
            <td>{{ $wastage_sputnikv_cebu_facility_first }}</td>  <!-- WASTAGE SPUTNIKV CEBU FACILITY -->
            <td>{{ $wastage_pfizer_cebu_facility_first }}</td> <!-- WASTAGE PFIZER CEBU FACILITY -->
            <td>{{ $total_wastage_cebu_facility }}</td> <!-- TOTAL WASTAGE CEBU FACILITY -->
            <td>{{ $p_cvrge_sinovac_cebu_facility_first }}%</td> <!-- PERCENT COVERAGE SINOVAC FIRST CEBU FACILITY -->
            <td>{{ $p_cvrge_astra_cebu_facility_first }}%</td> <!-- PERCENT COVERAGE ASTRA FIRST CEBU FACILITY -->
            <td>{{ $p_cvrge_sputnikv_cebu_facility_first }}%</td> <!-- PERCENT COVERAGE SPUTNIKV FIRST CEBU FACILITY -->
            <td>{{ $p_cvrge_pfizer_cebu_facility_first }}%</td> <!-- PERCENT COVERAGE PFIZER FIRST CEBU FACILITY -->
            <td>{{ $total_p_cvrge_cebu_facility_first }}%</td> <!-- TOTAL PERCENT COVERAGE FIRST CEBU FACILITY -->
            <td>{{ $p_cvrge_sinovac_cebu_facility_second }}%</td> <!-- PERCENT COVERAGE SINOVAC SECOND CEBU FACILITY -->
            <td>{{ $p_cvrge_astra_cebu_facility_second }}%</td> <!-- PERCENT COVERAGE ASTRA SECOND CEBU FACILITY -->
            <td>{{ $p_cvrge_sputnikv_cebu_facility_second }}%</td> <!-- PERCENT COVERAGE SPUTNIKV SECOND CEBU FACILITY -->
            <td>{{ $p_cvrge_pfizer_cebu_facility_second }}%</td> <!-- PERCENT COVERAGE PFIZER SECOND CEBU FACILITY -->
            <td>{{ $total_p_cvrge_cebu_facility_second }}%</td> <!-- TOTAL PERCENT COVERAGE SECOND CEBU FACILITY -->
            <td>{{ $c_rate_sinovac_cebu_facility_first }}%</td> <!-- CONSUMPTION RATE SINOVAC FIRST CEBU FACILITY -->
            <td>{{ $c_rate_astra_cebu_facility_first }}%</td> <!-- CONSUMPTION RATE ASTRA FIRST CEBU FACILITY -->
            <td>{{ $c_rate_sputnikv_cebu_facility_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST CEBU FACILITY -->
            <td>{{ $c_rate_pfizer_cebu_facility_first }}%</td> <!-- CONSUMPTION RATE PFIZER FIRST CEBU FACILITY -->
            <td>{{ $total_c_rate_cebu_facility_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST CEBU FACILITY -->
            <td>{{ $c_rate_sinovac_cebu_facility_second }}%</td>  <!-- CONSUMPTION RATE SINOVAC SECOND CEBU FACILITY -->
            <td>{{ $c_rate_astra_cebu_facility_second }}%</td>  <!-- CONSUMPTION RATE ASTRA SECOND CEBU FACILITY -->
            <td>{{ $c_rate_sputnikv_cebu_facility_second }}%</td> <!-- CONSUMPTION RATE SPUTNIKV SECOND CEBU FACILITY -->
            <td>{{ $c_rate_pfizer_cebu_facility_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND CEBU FACILITY -->
            <td>{{ $total_c_rate_cebu_facility_second }}%</td> <!-- TOTAL CONSUMPTION RATE SECOND CEBU FACILITY -->
        </tr>
        <tr>
            <td>Mandaue City</td>
            <td>{{ $sinovac_mandaue_facility }}</td> <!-- VACCINE ALLOCATED SINOVAC MANDAUE FACILITY -->
            <td>{{ $astra_mandaue_facility }}</td>   <!-- VACCINE ALLOCATED ASTRA MANDAUE FACILITY -->
            <td>{{ $sputnikv_mandaue_facility }}</td>  <!-- VACCINE ALLOCATED SPUTNIKV MANDAUE FACILITY -->
            <td>{{ $pfizer_mandaue_facility }}</td>  <!-- VACCINE ALLOCATED PFIZER MANDAUE FACILITY -->
            <td>{{ $total_mandaue_facility }}</td>  <!-- TOTAL VACCINE ALLOCATED MANDAUE FACILITY -->
            <td><center>{{ $eli_pop_mandaue_facility }}</center></td>  <!-- ELIGIBLE POP MANDAUE FACILITY -->
            <td>{{ $vcted_sinovac_mandaue_facility_first }}</td> <!-- VACCINATED SINOVAC_FIRST MANDAUE FACILITY -->
            <td>{{ $vcted_sinovac_mandaue_facility_second }}</td> <!-- VACCINATED SINOVAC_SECOND MANDAUE FACILITY -->
            <td>{{ $vcted_astra_mandaue_facility_first }}</td>  <!-- VACCINATED ASTRA_FIRST MANDAUE FACILITY -->
            <td>{{ $vcted_astra_mandaue_facility_second }}</td> <!-- VACCINATED ASTRA_SECOND MANDAUE FACILITY -->
            <td>{{ $vcted_sputnikv_mandaue_facility_first }}</td>  <!-- VACCINATED SPUTNIKV_FIRST MANDAUE FACILITY -->
            <td>{{ $vcted_sputnikv_mandaue_facility_second }}</td> <!-- VACCINATED SPUTNIKV_SECOND MANDAUE FACILITY -->
            <td>{{ $vcted_pfizer_mandaue_facility_first }}</td> <!-- VACCINATED PFIZER_FIRST MANDAUE FACILITY -->
            <td>{{ $vcted_pfizer_mandaue_facility_second }}</td> <!-- VACCINATED PFIZER_SECOND MANDAUE FACILITY -->
            <td>{{ $total_vcted_mandaue_facility_first }}</td> <!-- TOTAL VACCINATED FIRST MANDAUE FACILITY -->
            <td>{{ $total_vcted_mandaue_facility_second }}</td>  <!-- TOTAL VACCINATED SECOND MANDAUE FACILITY -->
            <td>{{ $refused_mandaue_facility_first }}</td> <!-- REFUSED FIRST MANDAUE FACILITY -->
            <td>{{ $refused_mandaue_facility_second }}</td> <!-- REFUSED SECOND MANDAUE FACILITY -->
            <td>{{ $deferred_mandaue_facility_first }}</td> <!-- DEFERRED FIRST MANDAUE FACILITY -->
            <td>{{ $deferred_mandaue_facility_second }}</td> <!-- DEFERRED SECOND MANDAUE FACILITY -->
            <td>{{ $wastage_sinovac_mandaue_facility_first }}</td> <!-- WASTAGE SINOVAC MANDAUE FACILITY -->
            <td>{{ $wastage_astra_mandaue_facility_first }}</td> <!-- WASTAGE ASTRA MANDAUE FACILITY -->
            <td>{{ $wastage_sputnikv_mandaue_facility_first }}</td> <!-- WASTAGE SPUTNIKV MANDAUE FACILITY -->
            <td>{{ $wastage_pfizer_mandaue_facility_first }}</td> <!-- WASTAGE PFIZER MANDAUE FACILITY -->
            <td>{{ $total_wastage_mandaue_facility }}</td> <!-- TOTAL WASTAGE MANDAUE FACILITY -->
            <td>{{ $p_cvrge_sinovac_mandaue_facility_first }}%</td> <!-- PERCENT COVERAGE SINOVAC FIRST MANDAUE FACILITY -->
            <td>{{ $p_cvrge_astra_mandaue_facility_first }}%</td> <!-- PERCENT COVERAGE ASTRA FIRST MANDAUE FACILITY -->
            <td>{{ $p_cvrge_sputnikv_mandaue_facility_first }}%</td> <!-- PERCENT COVERAGE SPUTNIKV FIRST MANDAUE FACILITY -->
            <td>{{ $p_cvrge_pfizer_mandaue_facility_first }}%</td> <!-- PERCENT COVERAGE SPUTNIKV FIRST MANDAUE FACILITY -->
            <td>{{ $total_p_cvrge_mandaue_facility_first }}%</td>  <!-- TOTAL PERCENT COVERAGE FIRST MANDAUE FACILITY -->
            <td>{{ $p_cvrge_sinovac_mandaue_facility_second }}%</td> <!-- PERCENT COVERAGE SINOVAC SECOND MANDAUE FACILITY -->
            <td>{{ $p_cvrge_astra_mandaue_facility_second }}%</td> <!-- PERCENT COVERAGE ASTRA SECOND MANDAUE FACILITY -->
            <td>{{ $p_cvrge_sputnikv_mandaue_facility_second }}%</td> <!-- PERCENT COVERAGE SPUTNIKV SECOND MANDAUE FACILITY -->
            <td>{{ $p_cvrge_pfizer_mandaue_facility_second }}%</td> <!-- PERCENT COVERAGE PFIZER SECOND MANDAUE FACILITY -->
            <td>{{ $total_p_cvrge_mandaue_facility_second }}%</td> <!-- TOTAL PERCENT COVERAGE SECOND MANDAUE FACILITY -->
            <td>{{ $c_rate_sinovac_mandaue_facility_first }}%</td> <!-- CONSUMPTION RATE SINOVAC FIRST MANDAUE FACILITY -->
            <td>{{ $c_rate_astra_mandaue_facility_first }}%</td> <!-- CONSUMPTION RATE ASTRA FIRST MANDAUE FACILITY -->
            <td>{{ $c_rate_sputnikv_mandaue_facility_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST MANDAUE FACILITY -->
            <td>{{ $c_rate_pfizer_mandaue_facility_first }}%</td> <!-- CONSUMPTION RATE PFIZER FIRST MANDAUE FACILITY -->
            <td>{{ $total_c_rate_mandaue_facility_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST MANDAUE FACILITY -->
            <td>{{ $c_rate_sinovac_mandaue_facility_second }}%</td> <!-- CONSUMPTION RATE SINOVAC SECOND MANDAUE FACILITY -->
            <td>{{ $c_rate_astra_mandaue_facility_second }}%</td> <!-- CONSUMPTION RATE ASTRA SECOND MANDAUE FACILITY -->
            <td>{{ $c_rate_sputnikv_mandaue_facility_second }}%</td> <!-- CONSUMPTION RATE SPUTNIKV SECOND MANDAUE FACILITY -->
            <td>{{ $c_rate_pfizer_mandaue_facility_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND MANDAUE FACILITY -->
            <td>{{ $total_c_rate_mandaue_facility_second }}%</td> <!-- TOTAL CONSUMPTION RATE SECOND MANDAUE FACILITY -->
        </tr>
        <tr>
            <td>Lapu-lapu City</td>
            <td>{{ $sinovac_lapu_facility }}</td> <!-- VACCINE ALLOCATED SINOVAC LAPU-LAPU FACILITY -->
            <td>{{ $astra_lapu_facility }}</td> <!-- VACCINE ALLOCATED ASTRA LAPU-LAPU FACILITY -->
            <td>{{ $sputnikv_lapu_facility }}</td> <!-- VACCINE ALLOCATED SPUTNIKV LAPU-LAPU FACILITY -->
            <td>{{ $pfizer_lapu_facility }}</td> <!-- VACCINE ALLOCATED PFIZER LAPU-LAPU FACILITY -->
            <td>{{ $total_lapu_facility }}</td> <!-- TOTAL VACCINE ALLOCATED LAPU-LAPU FACILITY -->
            <td>{{ $eli_pop_lapu_facility }}</td> <!-- ELIGBILE POP LAPU-LAPU FACILITY -->
            <td>{{ $vcted_sinovac_lapu_facility_first }}</td> <!-- VACCINATED SINOVAC_FIRST LAPU-LAPU FACILITY -->
            <td>{{ $vcted_sinovac_lapu_facility_second }}</td> <!-- VACCINATED SINOVAC_SECOND LAPU-LAPU FACILITY -->
            <td>{{ $vcted_astra_lapu_facility_first }}</td> <!-- VACCINATED ASTRA_FIRST LAPU-LAPU FACILITY -->
            <td>{{ $vcted_astra_lapu_facility_second }}</td> <!-- VACCINATED ASTRA_SECOND LAPU-LAPU FACILITY -->
            <td>{{ $vcted_sputnikv_lapu_facility_first }}</td> <!-- VACCINATED SPUTNIKV_FIRST LAPU-LAPU FACILITY -->
            <td>{{ $vcted_sputnikv_lapu_facility_second }}</td> <!-- VACCINATED SPUTNIKV_SECOND LAPU-LAPU FACILITY -->
            <td>{{ $vcted_pfizer_lapu_facility_first }}</td> <!-- VACCINATED PFIZER_FIRST LAPU-LAPU FACILITY -->
            <td>{{ $vcted_pfizer_lapu_facility_second }}</td> <!-- VACCINATED PFIZER_SECOND LAPU-LAPU FACILITY -->
            <td>{{ $total_vcted_lapu_facility_first }}</td>  <!-- TOTAL VACCINATED FIRST LAPU-LAPU FACILITY -->
            <td>{{ $total_vcted_lapu_facility_second }}</td>  <!-- TOTAL VACCINATED SECOND LAPU-LAPU FACILITY -->
            <td>{{ $refused_lapu_facility_first }}</td> <!-- REFUSED FIRST LAPU-LAPU FACILITY -->
            <td>{{ $refused_lapu_facility_second }}</td> <!-- REFUSED SECOND LAPU-LAPU FACILITY -->
            <td>{{ $deferred_lapu_facility_first }}</td> <!-- DEFERRED FIRST LAPU-LAPU FACILITY -->
            <td>{{ $deferred_lapu_facility_second }}</td>  <!-- DEFERRED SECOND LAPU-LAPU FACILITY -->
            <td>{{ $wastage_sinovac_lapu_facility_first }}</td>  <!-- WASTAGE SINOVAC LAPU-LAPU FACILITY -->
            <td>{{ $wastage_astra_lapu_facility_first }}</td> <!-- WASTAGE ASTRA LAPU-LAPU FACILITY -->
            <td>{{ $wastage_sputnikv_lapu_facility_first }}</td> <!-- WASTAGE SPUTNIKV LAPU-LAPU FACILITY -->
            <td>{{ $wastage_pfizer_lapu_facility_first }}</td> <!-- WASTAGE PFIZER LAPU-LAPU FACILITY -->
            <td>{{ $total_wastage_lapu_facility }}</td> <!-- TOTAL WASTAGE LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_sinovac_lapu_facility_first }}%</td> <!-- PERCENT COVERAGE SINOVAC FIRST LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_astra_lapu_facility_first }}%</td> <!-- PERCENT COVERAGE ASTRA  FIRST LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_sputnikv_lapu_facility_first }}%</td> <!-- PERCENT COVERAGE SPUTNIKV FIRST LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_pfizer_lapu_facility_first }}%</td> <!-- PERCENT COVERAGE PFIZER FIRST LAPU-LAPU FACILITY -->
            <td>{{ $total_p_cvrge_lapu_facility_first }}%</td> <!-- TOTAL PERCENT COVERAGE  FIRST LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_sinovac_lapu_facility_second }}%</td>  <!-- PERCENT COVERAGE SINOVAC SECOND LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_astra_lapu_facility_second }}%</td>  <!-- PERCENT COVERAGE ASTRA SECOND LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_sputnikv_lapu_facility_second }}%</td>  <!-- PERCENT COVERAGE SPUTNIKV SECOND LAPU-LAPU FACILITY -->
            <td>{{ $p_cvrge_pfizer_lapu_facility_second }}%</td>  <!-- PERCENT COVERAGE PFIZER SECOND LAPU-LAPU FACILITY -->
            <td>{{ $total_p_cvrge_lapu_facility_second }}%</td>   <!-- TOTAL PERCENT COVERAGE SECOND LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_sinovac_lapu_facility_first }}%</td>  <!-- CONSUMPTION RATE SINOVAC FIRST LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_astra_lapu_facility_first }}%</td>   <!-- CONSUMPTION RATE ASTRA FIRST LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_sputnikv_lapu_facility_first }}%</td> <!-- CONSUMPTION RATE SPUTNIKV FIRST LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_pfizer_lapu_facility_first }}%</td>   <!-- CONSUMPTION RATE PFIZER FIRST LAPU-LAPU FACILITY -->
            <td>{{ $total_c_rate_lapu_facility_first }}%</td> <!-- TOTAL CONSUMPTION RATE FIRST LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_sinovac_lapu_facility_second }}%</td> <!-- CONSUMPTION RATE SINOVAC SECOND LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_astra_lapu_facility_second }}%</td> <!-- CONSUMPTION RATE ASTRA SECOND LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_sputnikv_lapu_facility_second }}%</td> <!-- CONSUMPTION RATE SPUTNIKV SECOND LAPU-LAPU FACILITY -->
            <td>{{ $c_rate_pfizer_lapu_facility_second }}%</td> <!-- CONSUMPTION RATE PFIZER SECOND LAPU-LAPU FACILITY -->
            <td>{{ $total_c_rate_lapu_facility_second }}%</td> <!-- TOTAL CONSUMPTION RATE SECOND LAPU-LAPU FACILITY -->
        </tr>
        </thead>
    </table>
</div>


