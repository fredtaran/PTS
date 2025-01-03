<hr>
<?php
    //ELIGIBLE POP SINOVAC
    $total_e_pop_a1_grand = \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'','')")[0]->a1; //TOTAL ELIPOP A1
    $total_e_pop_a2_grand  = \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'','')")[0]->a2; ///TOTAL ELIPOP A2
    $total_e_pop_a3_grand  = \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'','')")[0]->a3; //TOTAL ELIPOP A3
    $total_e_pop_a4_grand  = \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'','')")[0]->a4; //TOTAL ELIPOP A4
    $total_e_pop_grand = $total_e_pop_a1_grand + $total_e_pop_a2_grand + $total_e_pop_a3_grand + $total_e_pop_a4_grand ; //TOTAL ELI POP


    //VACCINE_ALLOCATED
    $total_vallocated_svac_frst_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->sinovac_allocated_first : 0; //VACCINE ALLOCATED (FD) SINOVAC_FIRST
    $total_vallocated_svac_scnd_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->sinovac_allocated_second : 0; //VACCINE ALLOCATED (SD) SINOVAC_FIRST
    $total_vallocated_astra_frst_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->astrazeneca_allocated_first : 0; //VACCINE_ALLOCATED (FD) ASTRA_FIRST
    $total_vallocated_astra_scnd_grand= $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->astrazeneca_allocated_second : 0; //VACCINE ALLOCATED (SD) ASTRA_FIRST
    $total_vallocated_sputnikv_frst_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->sputnikv_allocated_first : 0; //VACCINE ALLOCATED (FD) SPUTNIKV_FIRST
    $total_vallocated_sputnikv_scnd_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->sputnikv_allocated_second : 0; //VACCINE ALLOCATED (SD) SPUTNIKV_FIRST
    $total_vallocated_pfizer_frst_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->pfizer_allocated_first : 0; //VACCINE ALLOCATED (FD) PFIZER_FIRST
    $total_vallocated_pfizer_scnd_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->pfizer_allocated_second : 0; //VACCINE ALLOCATED (SD) PFIZER_FIRST

    //SINOVAC

    $total_svac_a1_frst_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a1')")[0]->vaccinated_first_a : 0; //VACCINATED (A1) SINOVAC_FIRST
    $total_svac_a2_frst_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a2')")[0]->vaccinated_first_a : 0; //VACCINATED (A2) SINOVAC_FIRST
    $total_svac_a3_frst_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a3')")[0]->vaccinated_first_a : 0; //VACCINATED (A3) SINOVAC_FIRST
    $total_svac_a4_frst_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a4')")[0]->vaccinated_first_a : 0; //VACCINATED (A4) SINOVAC_FIRST
    $total_svac_a1_scnd_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a1')")[0]->vaccinated_second_a : 0; //VACCINATED (A1) SINOVAC_SECOND
    $total_svac_a2_scnd_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a2')")[0]->vaccinated_second_a : 0; //VACCINATED (A2) SINOVAC_SECOND
    $total_svac_a3_scnd_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a3')")[0]->vaccinated_second_a : 0; //VACCINATED (A3) SINOVAC_SECOND
    $total_svac_a4_scnd_grand = $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','a4')")[0]->vaccinated_second_a : 0; //VACCINATED (A4) SINOVAC_SECOND

    //ASTRAZENECA
    $total_astra_a1_frst_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a1')")[0]->vaccinated_first_a : 0;
    $total_astra_a2_frst_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a2')")[0]->vaccinated_first_a : 0;
    $total_astra_a3_frst_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a3')")[0]->vaccinated_first_a : 0;
    $total_astra_a4_frst_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a4')")[0]->vaccinated_first_a : 0;
    $total_astra_a1_scnd_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a1')")[0]->vaccinated_second_a : 0;
    $total_astra_a2_scnd_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a2')")[0]->vaccinated_second_a : 0;
    $total_astra_a3_scnd_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a3')")[0]->vaccinated_second_a : 0;
    $total_astra_a4_scnd_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','a4')")[0]->vaccinated_second_a : 0;


    //SPUTNIKV
    $total_sputnikv_a1_frst_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a1')")[0]->vaccinated_first_a : 0;
    $total_sputnikv_a2_frst_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a2')")[0]->vaccinated_first_a : 0;
    $total_sputnikv_a3_frst_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a3')")[0]->vaccinated_first_a : 0;
    $total_sputnikv_a4_frst_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a4')")[0]->vaccinated_first_a : 0;
    $total_sputnikv_a1_scnd_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a1')")[0]->vaccinated_second_a : 0;
    $total_sputnikv_a2_scnd_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a2')")[0]->vaccinated_second_a : 0;
    $total_sputnikv_a3_scnd_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a3')")[0]->vaccinated_second_a : 0;
    $total_sputnikv_a4_scnd_grand = $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','a4')")[0]->vaccinated_second_a : 0;

    //PFIZER
    $total_pfizer_a1_frst_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a1')")[0]->vaccinated_first_a : 0;
    $total_pfizer_a2_frst_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a2')")[0]->vaccinated_first_a : 0;
    $total_pfizer_a3_frst_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a3')")[0]->vaccinated_first_a : 0;
    $total_pfizer_a4_frst_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a4')")[0]->vaccinated_first_a : 0;
    $total_pfizer_a1_scnd_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a1')")[0]->vaccinated_second_a : 0;
    $total_pfizer_a2_scnd_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a2')")[0]->vaccinated_second_a : 0;
    $total_pfizer_a3_scnd_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a3')")[0]->vaccinated_second_a : 0;
    $total_pfizer_a4_scnd_grand = $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','a4')")[0]->vaccinated_second_a : 0;

    $total_vcted_astra_scnd_grand = $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->vaccinated_second : 0; //TOTAL VACCINATED ASTRA_SECOND

    $total_mild_svac_frst_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->mild_first : 0; //MILD SINOVAC_FIRST
    $total_mild_astra_frst_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->mild_first : 0; //MILD ASTRA_FIRST
    $total_mild_sputnikv_frst_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->mild_first : 0; //MILD SPUTNIKV_FIRST
    $total_mild_pfizer_frst_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->mild_first : 0; //MILD PFIZER_FIRST

    $total_mild_svac_scnd_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->mild_second : 0; //MILD SINOVAC_SECOND
    $total_mild_astra_scnd_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->mild_second : 0; //MILD ASTRA_SECOND
    $total_mild_sputnikv_scnd_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->mild_second : 0; //MILD SPUTNIKV_SECOND
    $total_mild_pfizer_scnd_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->mild_second : 0; //MILD PFIZER_SECOND

    $total_srs_svac_frst_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->serious_first : 0; //SERIOUS SINOVAC_FIRST
    $total_srs_astra_frst_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->serious_first : 0; //SERIOUS ASTRA_FIRST
    $total_srs_sputnikv_frst_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->serious_first : 0; //SERIOUS SPUTNIKV_FIRST
    $total_srs_pfizer_frst_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->serious_first : 0; //SERIOUS PFIZER_FIRST

    $total_srs_svac_scnd_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->serious_second : 0; //SERIOUS  SINOVAC_SECOND
    $total_srs_astra_scnd_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->serious_second : 0; //SERIOUS ASTRA_SECOND
    $total_srs_sputnikv_scnd_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->serious_second : 0; //SERIOUS SPUTNIKV_SECOND
    $total_srs_pfizer_scnd_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->serious_second : 0; //SERIOUS PFIZER_SECOND

    $total_dfrd_svac_frst_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->deferred_first : 0; //DEFERRED SINOVAC_FIRST
    $total_dfrd_astra_frst_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->deferred_first : 0; //DEFERRED ASTRA_FIRS
    $total_dfrd_sputnikv_frst_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->deferred_first : 0; //DEFERRED SPUTNIKV_FIRS
    $total_dfrd_pfizer_frst_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->deferred_first : 0; //DEFERRED PFIZER_FIRS

    $total_dfrd_svac_scnd_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->deferred_second : 0; //DEFERRED  SINOVAC_SECOND
    $total_dfrd_astra_scnd_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->deferred_second : 0; //DEFERRED ASTRA_SECOND
    $total_dfrd_sputnikv_scnd_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->deferred_second : 0; //DEFERRED SPUTNIKV_SECOND
    $total_dfrd_pfizer_scnd_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->deferred_second : 0; //DEFERRED PFIZER_SECOND

    $total_rfsd_svac_frst_grand =   $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->refused_first : 0; //REFUSED SINOVAC_FIRST
    $total_rfsd_astra_frst_grand =   $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->refused_first : 0; //REFUSED ASTRA_FIRST
    $total_rfsd_sputnikv_frst_grand =   $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->refused_first : 0; //REFUSED SPUTNIKV_FIRST
    $total_rfsd_pfizer_frst_grand =   $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->refused_first : 0; //REFUSED PFIZER_FIRST

    $total_rfsd_svac_scnd_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->refused_second : 0; //REFUSED  SINOVAC_SECOND
    $total_rfsd_astra_scnd_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->refused_second : 0; //REFUSED ASTRA_SECOND
    $total_rfsd_sputnikv_scnd_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->refused_second : 0; //REFUSED SPUTNIKV_SECOND
    $total_rfsd_pfizer_scnd_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->refused_second : 0; //REFUSED PFIZER_SECOND

    $total_wstge_svac_frst_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->wastage_first : 0; //WASTAGE SINOVAC_FIRST
    $total_wstge_astra_frst_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->wastage_first : 0; //WASTAGE ASTRA_FIRST
    $total_wstge_sputnikv_frst_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->wastage_first : 0; //WASTAGE SPUTNIKV
    $total_wstge_pfizer_frst_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->wastage_first : 0; //WASTAGE PFIZER_FIRST

    $total_wstge_svac_scnd_grand =  $typeof_vaccine_filter == "Sinovac" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Sinovac','')")[0]->wastage_second : 0; //WASTAGE SINOVAC_SECOND
    $total_wstge_astra_scnd_grand =  $typeof_vaccine_filter == "Astrazeneca" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Astrazeneca','')")[0]->wastage_second : 0; //WASTAGE ASTRA_SECOND
    $total_wstge_sputnikv_scnd_grand =  $typeof_vaccine_filter == "SputnikV" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'SputnikV','')")[0]->wastage_second : 0; //WASTAGE SPUTNIKV_SECOND
    $total_wstge_pfizer_scnd_grand =  $typeof_vaccine_filter == "Pfizer" || empty($typeof_vaccine_filter) ? \DB::connection('mysql')->select("call vaccine_facility_overall($province_id,'Pfizer','')")[0]->wastage_second : 0; //WASTAGE PFIZER_SECOND

    $total_vallocated_frst_svac = $total_vallocated_svac_frst_grand + $total_vallocated_svac_scnd_grand; //TOTAL VACCINE ALLOCATED SINOVAC_FIRST
    $total_vallocated_frst_astra = $total_vallocated_astra_frst_grand + $total_vallocated_astra_scnd_grand; //TOTAL VACCINE ALLOCATED ASTRA_FIRS
    $total_vallocated_frst_sputnikv = $total_vallocated_sputnikv_frst_grand + $total_vallocated_sputnikv_scnd_grand; //TOTAL VACCINE ALLOCATED SPUTNIKV_FIRS
    $total_vallocated_frst_pfizer = $total_vallocated_pfizer_frst_grand + $total_vallocated_pfizer_scnd_grand; //TOTAL VACCINE ALLOCATED PFIZER_FIRS
    $total_vallocated = $total_vallocated_frst_svac + $total_vallocated_frst_astra + $total_vallocated_frst_sputnikv + $total_vallocated_frst_pfizer;

    $total_vallocated_frst_grand = $total_vallocated_svac_frst_grand + $total_vallocated_astra_frst_grand + $total_vallocated_sputnikv_frst_grand + $total_vallocated_pfizer_frst_grand; //TOTAL VACCINE ALLOCATED FIRST
    $total_vallocated_scnd_grand = $total_vallocated_svac_scnd_grand + $total_vallocated_astra_scnd_grand + $total_vallocated_sputnikv_scnd_grand + $total_vallocated_pfizer_scnd_grand; //TOTAL VACCINE ALLOCATED SECOND
    $total_vallocated = $total_vallocated_frst_grand + $total_vallocated_scnd_grand;

    $total_mild_overall_frst = $total_mild_svac_frst_grand + $total_mild_astra_frst_grand + $total_mild_sputnikv_frst_grand + $total_mild_pfizer_frst_grand; // TOTAL MILD OVERALL FIRST
    $total_mild_overall_scnd = $total_mild_svac_scnd_grand + $total_mild_astra_scnd_grand + $total_mild_sputnikv_scnd_grand + $total_mild_pfizer_scnd_grand; // TOTAL MILD OVERALL SECOND

    $total_srs_overall_frst = $total_srs_svac_frst_grand + $total_srs_astra_frst_grand + $total_srs_sputnikv_frst_grand + $total_srs_pfizer_frst_grand; // TOTAL SERIOUS FIRST
    $total_srs_overall_scnd = $total_srs_svac_scnd_grand + $total_srs_astra_scnd_grand + $total_srs_sputnikv_scnd_grand + $total_srs_pfizer_scnd_grand; // TOTAL SERIOUS SECOND

    $total_dfrd_overall_frst = $total_dfrd_svac_frst_grand + $total_dfrd_astra_frst_grand + $total_dfrd_sputnikv_frst_grand + $total_dfrd_pfizer_frst_grand; // TOTAL DEFERRED FIRST
    $total_dfrd_overall_scnd = $total_dfrd_svac_scnd_grand + $total_dfrd_astra_scnd_grand + $total_dfrd_sputnikv_scnd_grand + $total_dfrd_pfizer_scnd_grand; // TOTAL DEFERRED SECOND

    $total_rfsd_overall_frst = $total_rfsd_svac_frst_grand + $total_rfsd_astra_frst_grand + $total_rfsd_sputnikv_frst_grand + $total_rfsd_pfizer_frst_grand; // TOTAL REFUSED FIRST
    $total_rfsd_overall_scnd = $total_rfsd_svac_scnd_grand + $total_rfsd_astra_scnd_grand + $total_rfsd_sputnikv_scnd_grand + $total_rfsd_pfizer_scnd_grand; // TOTAL REFUSED SECOND

    $total_wstge_overall_first = $total_wstge_svac_frst_grand + $total_wstge_astra_frst_grand + $total_wstge_sputnikv_frst_grand + $total_wstge_pfizer_frst_grand; // TOTAL WASTAGE FIRST
    $total_wstge_overall_scnd = $total_wstge_svac_scnd_grand + $total_wstge_astra_scnd_grand + $total_wstge_sputnikv_scnd_grand + $total_wstge_pfizer_scnd_grand; // TOTAL WASTAGE SECOND


    $total_vcted_svac_frst_grand = $total_svac_a1_frst_grand + $total_svac_a2_frst_grand + $total_svac_a3_frst_grand + $total_svac_a4_frst_grand; //TOTAL VACCINATED SINOVAC_FIRST
    $total_vcted_svac_scnd_grand = $total_svac_a1_scnd_grand + $total_svac_a2_scnd_grand + $total_svac_a3_scnd_grand + $total_svac_a4_scnd_grand; //TOTAL VACCINATED SINOVAC_SECOND
    $total_vcted_astra_frst_grand = $total_astra_a1_frst_grand + $total_astra_a2_frst_grand + $total_astra_a3_frst_grand + $total_astra_a4_frst_grand; // TOTAL VACCINATED ASTRA_FIRST
    $total_vcted_astra_scnd_grand = $total_astra_a1_scnd_grand + $total_astra_a2_scnd_grand + $total_astra_a3_scnd_grand + $total_astra_a4_scnd_grand; //TOTAL VACCINATED ASTRA_SECOND
    $total_vcted_sputnikv_frst_grand = $total_sputnikv_a1_frst_grand + $total_sputnikv_a2_frst_grand + $total_sputnikv_a3_frst_grand + $total_sputnikv_a4_frst_grand; //TOTAL VACCINATED SPUTNIKV_FIRST
    $total_vcted_sputnikv_scnd_grand = $total_sputnikv_a1_scnd_grand + $total_sputnikv_a2_scnd_grand + $total_sputnikv_a3_scnd_grand + $total_sputnikv_a4_scnd_grand; //TOTAL VACCINATED SPUTNIKV_SECOND
    $total_vcted_pfizer_frst_grand = $total_pfizer_a1_frst_grand + $total_pfizer_a2_frst_grand + $total_pfizer_a3_frst_grand + $total_pfizer_a4_frst_grand; //TOTAL VACCINATED PFIZER_FIRST
    $total_vcted_pfizer_scnd_grand = $total_pfizer_a1_scnd_grand + $total_pfizer_a2_scnd_grand + $total_pfizer_a3_scnd_grand + $total_pfizer_a4_scnd_grand; //TOTAL VACCINATED PFIZER_SECOND

    $total_vcted_a1_first_grand = $total_svac_a1_frst_grand + $total_astra_a1_frst_grand + $total_sputnikv_a1_frst_grand + $total_pfizer_a1_frst_grand; //TOTAL VACCINATED (A1)
    $total_vcted_a2_first_grand = $total_svac_a2_frst_grand + $total_astra_a2_frst_grand + $total_sputnikv_a2_frst_grand + $total_pfizer_a2_frst_grand; //TOTAL VACCINATED (A2)
    $total_vcted_a3_first_grand = $total_svac_a3_frst_grand + $total_astra_a3_frst_grand + $total_sputnikv_a3_frst_grand + $total_pfizer_a3_frst_grand; //TOTAL VACCINATED (A3)
    $total_vcted_a4_first_grand = $total_svac_a4_frst_grand + $total_astra_a4_frst_grand + $total_sputnikv_a4_frst_grand + $total_pfizer_a4_frst_grand; //TOTAL VACCINATED (A4)

    $total_vcted_first_overall =  $total_vcted_a1_first_grand + $total_vcted_a2_first_grand + $total_vcted_a3_first_grand + $total_vcted_a4_first_grand; //TOTAL VACCINATED FIRST DOSE OVERALL

    $total_vcted_scnd_a1_grand = $total_svac_a1_scnd_grand + $total_astra_a1_scnd_grand + $total_sputnikv_a1_scnd_grand + $total_pfizer_a1_scnd_grand; //TOTAL VACCINATED SECOND DOSE A1
    $total_vcted_scnd_a2_grand = $total_svac_a2_scnd_grand + $total_astra_a2_scnd_grand + $total_sputnikv_a2_scnd_grand + $total_pfizer_a2_scnd_grand; //TOTAL VACCINATED SECOND DOSE A2
    $total_vcted_scnd_a3_grand = $total_svac_a3_scnd_grand + $total_astra_a3_scnd_grand + $total_sputnikv_a3_scnd_grand + $total_pfizer_a3_scnd_grand; //TOTAL VACCINATED SECOND DOSE A3
    $total_vcted_scnd_a4_grand = $total_svac_a4_scnd_grand + $total_astra_a4_scnd_grand + $total_sputnikv_a4_scnd_grand + $total_pfizer_a4_scnd_grand; //TOTAL VACCINATED SECOND DOSE A4

    $total_vcted_scnd_overall =  $total_vcted_scnd_a1_grand + $total_vcted_scnd_a2_grand + $total_vcted_scnd_a3_grand + $total_vcted_scnd_a4_grand; //TOTAL VACCINATED SECOND DOSE OVERALL

    $total_rfsd_frst_grand = $total_rfsd_svac_frst_grand + $total_rfsd_astra_frst_grand + $total_rfsd_sputnikv_frst_grand + $total_rfsd_pfizer_frst_grand; //TOTAL REFUSED
    $total_rfsd_scnd_grand = $total_rfsd_svac_scnd_grand + $total_rfsd_astra_scnd_grand + $total_rfsd_sputnikv_scnd_grand + $total_rfsd_pfizer_scnd_grand; //TOTAL REFUSED  2

    //PERCENT COVERAGE
    $total_p_cvrge_svac_frst_grand = $total_vcted_svac_frst_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE SINOVAC_FIRST //DARA
    $total_p_cvrge_svac_scnd_grand = $total_vcted_svac_scnd_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE SINOVAC_SECOND
    $total_p_cvrge_astra_frst_grand = $total_vcted_astra_frst_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE ASTRA_FIRST
    $total_p_cvrge_astra_scnd_grand = $total_vcted_astra_scnd_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE ASTRA_SECOND
    $total_p_cvrge_sputnikv_frst_grand = $total_vcted_sputnikv_frst_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE SPUTNIKV_FIRST
    $total_p_cvrge_sputnikv_scnd_grand = $total_vcted_sputnikv_scnd_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE SPUTNIKV_SECOND
    $total_p_cvrge_pfizer_frst_grand = $total_vcted_pfizer_frst_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE PFIZER_FIRST
    $total_p_cvrge_pfizer_scnd_grand = $total_vcted_pfizer_scnd_grand / $total_e_pop_grand * 100; //PERCENT COVERAGE PFIZER_SECOND
    $total_p_cvrge_overall_frst = $total_vcted_first_overall / $total_e_pop_grand * 100; //PERCENT_COVERAGE_OVERALL_FIRST
    $total_p_cvrge_overall_scnd = $total_vcted_scnd_overall / $total_e_pop_grand * 100; //PERCENT_COVERAGE_OVERALL_FIRST

    //CONSUMPTTION RATE
    $total_c_rate_svac_frst_grand = $total_vcted_svac_frst_grand / $total_vallocated_svac_frst_grand * 100; //CONSUMPTION RATE SINOVAC_FIRST goods
    $total_c_rate_astra_frst_grand = $total_vcted_astra_frst_grand / $total_vallocated_astra_frst_grand * 100; //CONSUMPTION RATE ASTRA_FIRST goods
    $total_c_rate_sputnikv_frst_grand = $total_vcted_sputnikv_frst_grand / $total_vallocated_sputnikv_frst_grand * 100; //CONSUMPTION RATE SPUTNIKV_FIRST goods
    $total_c_rate_pfizer_frst_grand = $total_vcted_pfizer_frst_grand / $total_vallocated_pfizer_frst_grand * 100; //CONSUMPTION RATE PFIZER_FIRST goods
    $total_c_rate_svac_scnd_grand = $total_vcted_svac_scnd_grand / $total_vallocated_svac_scnd_grand * 100; //CONSUMPTION RATE SINOVAC_SECOND goods
    $total_c_rate_astra_scnd_grand = $total_vcted_astra_scnd_grand / $total_vallocated_astra_scnd_grand * 100; //CONSUMPTION RATE ASTRA_SECOND goods
    $total_c_rate_sputnikv_scnd_grand = $total_vcted_sputnikv_scnd_grand / $total_vallocated_sputnikv_scnd_grand * 100; //CONSUMPTION RATE SPUTNIKV_SECOND goods
    $total_c_rate_pfizer_scnd_grand = $total_vcted_pfizer_scnd_grand / $total_vallocated_pfizer_scnd_grand * 100; //CONSUMPTION RATE PFIZER SECOND goods


    //REMAINING UNVACCINATED
    $total_r_unvcted_frst_svac_grand = $total_e_pop_grand - $total_vcted_svac_frst_grand - $total_rfsd_svac_frst_grand; //REMAINING UNVACCINATED SINOVAC_FIRST goods
    $total_r_unvcted_frst_astra_grand = $total_e_pop_grand - $total_vcted_astra_frst_grand - $total_rfsd_astra_frst_grand; //REMAINUNG UNVACCINATED ASTRA_FIRST goods
    $total_r_unvcted_frst_sputnikv_grand = $total_e_pop_grand - $total_vcted_sputnikv_frst_grand - $total_rfsd_sputnikv_frst_grand; //REMAINUNG UNVACCINATED SPUTNIKV_FIRST goods
    $total_r_unvcted_frst_pfizer_grand = $total_e_pop_grand - $total_vcted_pfizer_frst_grand - $total_rfsd_pfizer_frst_grand; //REMAINUNG UNVACCINATED PFIZER_FIRST goods
    $total_r_unvcted_scnd_svac_grand = $total_e_pop_grand - $total_vcted_svac_scnd_grand - $total_rfsd_svac_scnd_grand; //REMAINING UNVACCINATED  SINOVAC_SECOND goods
    $total_r_unvcted_scnd_astra_grand = $total_e_pop_grand - $total_vcted_astra_scnd_grand - $total_rfsd_astra_scnd_grand;  //REMAINING UNVACCINATED ASTRA_SECOND goods
    $total_r_unvcted_scnd_sputnikv_grand = $total_e_pop_grand - $total_vcted_sputnikv_scnd_grand - $total_rfsd_sputnikv_scnd_grand;  //REMAINING UNVACCINATED SPUTNIKV_SECOND goods
    $total_r_unvcted_scnd_pfizer_grand = $total_e_pop_grand - $total_vcted_pfizer_scnd_grand - $total_rfsd_pfizer_scnd_grand;  //REMAINING UNVACCINATED PFIZER_SECOND goods

    $total_r_unvcted_all_frst_grand = $total_e_pop_grand - $total_vcted_first_overall - $total_rfsd_frst_grand; //TOTAL REMAINUNG UNVACCINATED goods //
    $total_r_unvcted_all_scnd_grand = $total_e_pop_grand - $total_vcted_scnd_overall - $total_rfsd_scnd_grand; //TOTAL REMAINING UNVACCIANTED  2 goods


    $sinovac_dashboard = $total_vcted_svac_frst_grand + $total_vcted_svac_scnd_grand;
    $astra_dashboard = $total_vcted_astra_frst_grand + $total_vcted_astra_scnd_grand;
    $sputnikv_dashboard = $total_vcted_sputnikv_frst_grand + $total_vcted_sputnikv_scnd_grand;
    $pfizer_dashboard = $total_vcted_pfizer_frst_grand + $total_vcted_pfizer_scnd_grand;



    $a1_dashboard = $total_vcted_a1_first_grand + $total_vcted_scnd_a1_grand;
    $a2_dashboard = $total_vcted_a2_first_grand + $total_vcted_scnd_a2_grand;
    $a3_dashboard = $total_vcted_a3_first_grand + $total_vcted_scnd_a3_grand;
    $a4_dashboard = $total_vcted_a4_first_grand + $total_vcted_scnd_a4_grand;
    $percent_coverage_dashboard_first =  number_format($total_p_cvrge_overall_frst,2);
    $percent_coverage_dashboard_second = number_format($total_p_cvrge_overall_scnd,2);


    $total_c_rate_frst_grand = $total_vcted_first_overall / $total_vallocated_frst_grand * 100; //TOTAL CONSUMPTION RATE goods
    $total_c_rate_scnd_grand = $total_vcted_scnd_overall / $total_vallocated_scnd_grand * 100; //TOTAL CONSUMPTION RATE  2 goods

    $consumption_rate_dashboard_first = number_format($total_c_rate_frst_grand,2);
    $consumption_rate_dashboard_second = number_format($total_c_rate_scnd_grand,2);


    Session::put("sinovac_dashboard",$sinovac_dashboard);
    Session::put("astra_dashboard",$astra_dashboard);
    Session::put("sputnikv_dashboard",$sputnikv_dashboard);
    Session::put("pfizer_dashboard",$pfizer_dashboard);
    Session::put("a1_dashboard",$a1_dashboard);
    Session::put("a2_dashboard",$a2_dashboard);
    Session::put("a3_dashboard",$a3_dashboard);
    Session::put("a4_dashboard",$a4_dashboard);
    Session::put("percent_coverage_dashboard_first",$percent_coverage_dashboard_first);
    Session::put("percent_coverage_dashboard_second",$percent_coverage_dashboard_second);
    Session::put("consumption_rate_dashboard_first",$consumption_rate_dashboard_first);
    Session::put("consumption_rate_dashboard_second",$consumption_rate_dashboard_second);
    ?>

<h4>Grand Total</h4>
    <button class="btn btn-link collapsed" style="color: red;" type="button" data-toggle="collapse" data-target="#collapse_sinovac_grand" aria-expanded="false" aria-controls="collapse_sinovac_grandtotal">
        <b>Sinovac</b>
    </button>
    <button class="btn btn-link collapsed" style="color: darkgoldenrod;" type="button" data-toggle="collapse" data-target="#collapse_astra_grand" aria-expanded="false" aria-controls="collapse_astra_grandtotal">
        <b>Astrazeneca</b>
    </button>
    <button class="btn btn-link collapsed" style="color:#00a65a;" type="button" data-toggle="collapse" data-target="#collapse_sputnikv_grand" aria-expanded="false" aria-controls="collapse_sputnikv_grandtotal">
        <b>SputnikV</b>
    </button>
    <button class="btn btn-link collapsed" style="color:#00c0ef;" type="button" data-toggle="collapse" data-target="#collapse_pfizer_grand" aria-expanded="false" aria-controls="collapse_pfizer_grandtotal">
        <b>Pfizer</b>
    </button>
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
    <!-- SINOVAC -->
    <tbody id="collapse_sinovac_grand" class="collapse bg-danger" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #ffd8d6">
        <td rowspan="2">
        </td> <!-- 1-3 -->
        <td rowspan="2">
            {{ $total_e_pop_a1_grand }}
            <?php Session::put('total_e_pop_svac_a1_excel',$total_e_pop_a1_grand);?>
        </td> <!--TOTAL ELIPOP A1-->
        <td rowspan="2">
            {{ $total_e_pop_a2_grand }}
            <?php  Session::put('total_e_pop_svac_a2_excel',$total_e_pop_a2_grand);?>
        </td> <!--TOTAL ELIPOP A2-->
        <td rowspan="2">
            {{ $total_e_pop_a3_grand }}
            <?php  Session::put('total_e_pop_svac_a3_excel',$total_e_pop_a3_grand);?>
        </td> <!--TOTAL ELIPOP A3-->
        <td rowspan="2">
            {{ $total_e_pop_a4_grand }}
            <?php  Session::put('total_e_pop_svac_a4_excel',$total_e_pop_a4_grand);?>
        </td> <!--TOTAL ELIPOP A2-->
        <td rowspan="2">
            {{ $total_e_pop_grand}}
            <?php  Session::put('total_e_pop_svac_excel',$total_e_pop_grand);?>
        </td> <!--TOTAL ELI POP-->
        <td rowspan="2">
            {{ $total_vallocated_svac_frst_grand }}
            <?php  Session::put('total_vallocated_svac_frst_excel',$total_vallocated_svac_frst_grand);?>
        </td> <!-- VACCINE ALLOCATED (FD) SINOVAC_FIRST -->
        <td rowspan="2">
            {{ $total_vallocated_svac_scnd_grand }}
            <?php  Session::put('total_vallocated_svac_scnd_excel',$total_vallocated_svac_scnd_grand);?>
        </td>  <!-- VACCINE ALLOCATED (SD) SINOVAC_FIRST -->
        <td rowspan="2">
            {{ $total_vallocated_frst_svac }}
            <?php  Session::put('total_vallocated_frst_svac_excel',$total_vallocated_frst_svac);?>
        </td> <!-- TOTAL VACCINE ALLOCATED SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_svac_a1_frst_grand }}
                <?php Session::put('total_svac_a1_frst_excel',$total_svac_a1_frst_grand);?>



                <!--diri lng sa taman diri lng sa kutob





            </span>
        </td> <!-- VACCINATED (A1) SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                 {{ $total_svac_a2_frst_grand }}
                <?php Session::put('total_svac_a2_frst_excel',$total_svac_a2_frst_grand);?>
            </span>
        </td> <!-- VACCINATED (A2) SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_svac_a3_frst_grand }}
                <?php Session::put('total_svac_a3_frst_excel',$total_svac_a3_frst_grand);?>
            </span>
        </td>  <!-- VACCINATED (A3) SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_svac_a4_frst_grand }}
                <?php Session::put('total_svac_a4_frst_excel',$total_svac_a4_frst_grand);?>
            </span>
        </td>  <!-- VACCINATED (A4) SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_vcted_svac_frst_grand }}
                <?php Session::put('total_vcted_svac_frst_excel',$total_vcted_svac_frst_grand);?>
            </span>
        </td> <!-- TOTAL VACCINATED SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_mild_svac_frst_grand }}
                <?php Session::put('total_mild_svac_frst_excel',$total_mild_svac_frst_grand);?>
            </span>
        </td> <!-- MILD SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_srs_svac_frst_grand }}
                <?php Session::put('total_srs_svac_frst_excel',$total_srs_svac_frst_grand);?>
            </span>
        </td> <!-- SERIOUS SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_dfrd_svac_frst_grand }}
                <?php Session::put('total_dfrd_svac_frst_excel',$total_dfrd_svac_frst_grand);?>
            </span>
        </td> <!-- DEFERRED SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_rfsd_svac_frst_grand }}
                <?php Session::put('total_rfsd_svac_frst_excel',$total_rfsd_svac_frst_grand);?>
            </span>
        </td>  <!-- REFUSED SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_wstge_svac_frst_grand }}
                <?php Session::put('total_wstge_svac_frst_excel',$total_wstge_svac_frst_grand);?>
            </span>
        </td>  <!-- WASTAGE SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ number_format($total_p_cvrge_svac_frst_grand,2) }}%
                <?php Session::put('total_p_cvrge_svac_frst_excel',$total_p_cvrge_svac_frst_grand);?>
            </span>
        </td>  <!-- PERCENT COVERAGE SINOVAC_FIRST -->
        <td>
            <span class="label label-success">
                {{ number_format($total_c_rate_svac_frst_grand,2) }}%
                <?php Session::put('total_c_rate_svac_frst_excel',$total_c_rate_svac_frst_grand);?>
            </span> <!-- CONSUMPTION RATE SINOVAC_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_r_unvcted_frst_svac_grand }}
                <?php Session::put('total_r_unvcted_frst_svac_excel',$total_r_unvcted_frst_svac_grand);?>
            </span>
        </td>  <!-- REMAINING UNVACCINATED SINOVAC_FIRST -->
    </tr>

    <tr style="background-color: #ffd8d6">
        <td>
            <span class="label label-warning">
                {{ $total_svac_a1_scnd_grand }}
                <?php Session::put('total_svac_a1_scnd_excel',$total_svac_a1_scnd_grand);?>
            </span>
        </td>  <!-- VACCINATED (A1) SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_svac_a2_scnd_grand }}
                <?php Session::put('total_svac_a2_scnd_excel',$total_svac_a2_scnd_grand);?>
            </span>
        </td> <!-- VACCINATED (A2) SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_svac_a3_scnd_grand }}
                <?php Session::put('total_svac_a3_scnd_excel',$total_svac_a3_scnd_grand);?>
            </span>
        </td> <!-- VACCINATED (A3) SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_svac_a4_scnd_grand }}
                <?php Session::put('total_svac_a4_scnd_excel',$total_svac_a4_scnd_grand);?>
            </span> <!-- VACCINATED (A4) SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_vcted_svac_scnd_grand }}
                <?php Session::put('total_vcted_svac_scnd_excel',$total_vcted_svac_scnd_grand);?>
            </span>
        </td> <!-- TOTAL VACCINATED SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_mild_svac_scnd_grand }}
                <?php Session::put('total_mild_svac_scnd_excel',$total_mild_svac_scnd_grand);?>
            </span>
        </td>  <!-- MILD SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_srs_svac_scnd_grand }}
                <?php Session::put('total_srs_svac_scnd_excel',$total_srs_svac_scnd_grand);?>
            </span>
        </td> <!-- SERIOUS  SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_dfrd_svac_scnd_grand }}
                <?php Session::put('total_dfrd_svac_scnd_excel',$total_dfrd_svac_scnd_grand);?>
            </span>
        </td>  <!-- DEFERRED  SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_rfsd_svac_scnd_grand }}
                <?php Session::put('total_rfsd_svac_scnd_excel',$total_rfsd_svac_scnd_grand);?>
            </span>
        </td> <!-- REFUSED  SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_wstge_svac_scnd_grand }}
                <?php Session::put('total_wstge_svac_scnd_excel',$total_wstge_svac_scnd_grand);?>
            </span> <!-- WASTAGE SINOVAC_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ number_format($total_p_cvrge_svac_scnd_grand,2) }}%
                <?php Session::put('total_p_cvrge_svac_scnd_excel',$total_p_cvrge_svac_scnd_grand);?>
            </span>
        </td>  <!-- PERCENT COVERAGE  SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ number_format($total_c_rate_svac_scnd_grand,2) }}%
                <?php Session::put('total_c_rate_svac_scnd_excel',$total_c_rate_svac_scnd_grand);?>
            </span>
        </td> <!-- CONSUMPTION RATE SINOVAC_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_r_unvcted_scnd_svac_grand }}
                <?php Session::put('total_r_unvcted_scnd_svac_excel',$total_r_unvcted_scnd_svac_grand);?>
            </span>
        </td> <!-- REMAINING UNVACCINATED  SINOVAC_SECOND -->
    </tr>
    </tbody>
    <!-- ASTRAZENECA -->
    <tbody id="collapse_astra_grand" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #f2fcac">
        <td rowspan="2">

        </td> <!-- 1-5 -->
        <td rowspan="2">
            {{ $total_e_pop_a1_grand }}
            <?php Session::put('total_e_pop_a1_excel',$total_e_pop_a1_grand);?>
        </td>  <!--TOTAL ELIPOP ASTRA A1-->
        <td rowspan="2">
            {{ $total_e_pop_a2_grand }}
            <?php Session::put('total_e_pop_a2_excel',$total_e_pop_a2_grand);?>
        </td>   <!--TOTAL ELIPOP ASTRA A2-->
        <td rowspan="2">
            {{ $total_e_pop_a3_grand }}
            <?php Session::put('total_e_pop_a3_excel',$total_e_pop_a3_grand);?>
        </td>  <!--TOTAL ELIPOP ASTRA A3-->
        <td rowspan="2">
            {{ $total_e_pop_a4_grand }}
            <?php Session::put('total_e_pop_a4_excel',$total_e_pop_a4_grand);?>
        </td>  <!--TOTAL ELIPOP ASTRA A4-->
        <td rowspan="2">
            {{ $total_e_pop_grand }}
            <?php Session::put('total_e_pop_excel',$total_e_pop_grand);?>
        </td> <!--TOTAL ELI POP ASTRA-->
        <td rowspan="2" style="color:black">
            {{ $total_vallocated_astra_frst_grand }}
            <?php Session::put('total_vallocated_astra_frst_excel',$total_vallocated_astra_frst_grand);?>
        </td> <!-- VACCINE_ALLOCATED (FD) ASTRA_FIRST-->
        <td rowspan="2" style="color:black">
            {{ $total_vallocated_astra_scnd_grand }}
            <?php Session::put('total_vallocated_astra_scnd_excel',$total_vallocated_astra_scnd_grand);?>
        </td>  <!-- VACCINE ALLOCATED (SD) ASTRA_FIRST -->
        <td rowspan="2" style="color:black;">
            {{ $total_vallocated_frst_astra }}
            <?php Session::put('total_vallocated_frst_astra_excel',$total_vallocated_frst_astra);?>
        </td>  <!-- TOTAL VACCINE ALLOCATED ASTRA_FIRST -->
        <td style="color:black;">
            <span class="label label-success">
                {{ $total_astra_a1_frst_grand }}
                <?php Session::put('total_astra_a1_frst_excel',$total_astra_a1_frst_grand);?>
            </span>
        </td>  <!-- VACCINATED (A1) ASTRA_FIRST -->
        <td style="color:black">
            <span class="label label-success">
                {{ $total_astra_a2_frst_grand }}
                <?php Session::put('total_astra_a2_frst_excel',$total_astra_a2_frst_grand);?>
            </span>
        </td>  <!-- VACCINATED (A2) ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_astra_a3_frst_grand }}
                <?php Session::put('total_astra_a3_frst_excel',$total_astra_a3_frst_grand);?>
            </span>
        </td> <!-- VACCINATED (A3) ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_astra_a4_frst_grand }}
                <?php Session::put('total_astra_a4_frst_excel',$total_astra_a4_frst_grand);?>
            </span>
        </td> <!-- VACCINATED (A4) ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_vcted_astra_frst_grand }}
                <?php Session::put('total_vcted_astra_frst_excel',$total_vcted_astra_frst_grand);?>
            </span>
        </td> <!-- TOTAL VACCINATED ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_mild_astra_frst_grand }}
                <?php Session::put('total_mild_astra_frst_excel',$total_mild_astra_frst_grand);?>
            </span> <!-- MILD ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_srs_astra_frst_grand }}
                <?php Session::put('total_srs_astra_frst_excel',$total_srs_astra_frst_grand);?>
            </span>
        </td> <!-- SERIOUS ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_dfrd_astra_frst_grand }}
                <?php Session::put('total_dfrd_astra_frst_excel',$total_dfrd_astra_frst_grand);?>
            </span>
        </td>  <!-- DEFERRED ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_rfsd_astra_frst_grand }}
                <?php Session::put('total_rfsd_astra_frst_excel',$total_rfsd_astra_frst_grand);?>
            </span>
        </td>  <!-- REFUSED ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_wstge_astra_frst_grand }}
                <?php Session::put('total_wstge_astra_frst_excel',$total_wstge_astra_frst_grand);?>
            </span> <!-- WASTAGE ASTRA_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ number_format($total_p_cvrge_astra_frst_grand,2) }}%
                <?php Session::put('total_p_cvrge_astra_frst_excel',$total_p_cvrge_astra_frst_grand);?>
            </span>
        </td> <!-- PERCENT_COVERAGE ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ number_format($total_c_rate_astra_frst_grand,2) }}%
                <?php Session::put('total_c_rate_astra_frst_excel',$total_c_rate_astra_frst_grand);?>
            </span>
        </td>  <!-- CONSUMPTION RATE ASTRA_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_r_unvcted_frst_astra_grand }}
                <?php Session::put('total_r_unvcted_frst_astra_excel',$total_r_unvcted_frst_astra_grand);?>
            </span>
        </td> <!-- REMAINUNG UNVACCINATED ASTRA_FIRST -->
    </tr>
    <tr style="background-color: #f2fcac">
        <td style="color: black;">
            <span class="label label-warning">
                {{ $total_astra_a1_scnd_grand }}
                <?php Session::put('total_astra_a1_scnd_excel',$total_astra_a1_scnd_grand);?>
            </span>
        </td>  <!-- VACCINATED (A1) ASTRA_SECOND -->
        <td style="color:black;">
            <span class="label label-warning">
                {{ $total_astra_a2_scnd_grand }}
                <?php Session::put('total_astra_a2_scnd_excel',$total_astra_a2_scnd_grand);?>
            </span>
        </td> <!-- VACCINATED (A2) ASTRA_SECOND -->
        <td style="color:black;">
            <span class="label label-warning">
                {{ $total_astra_a3_scnd_grand }}
                <?php Session::put('total_astra_a3_scnd_excel',$total_astra_a3_scnd_grand);?>
            </span>
        </td> <!-- VACCINATED (A3) ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_astra_a4_scnd_grand }}
                <?php Session::put('total_astra_a4_scnd_excel',$total_astra_a4_scnd_grand);?>
            </span>
        </td>  <!-- VACCINATED (A4) ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_vcted_astra_scnd_grand }}
                <?php Session::put('total_vcted_astra_scnd_excel',$total_vcted_astra_scnd_grand);?>
            </span>
        </td>  <!-- TOTAL VACCINATED ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_mild_astra_scnd_grand }}
                <?php Session::put('total_mild_astra_scnd_excel',$total_mild_astra_scnd_grand);?>
            </span>
        </td>  <!-- MILD ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_srs_astra_scnd_grand }}
                <?php Session::put('total_srs_astra_scnd_excel',$total_srs_astra_scnd_grand);?>
            </span>
        </td> <!-- SERIOUS ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_dfrd_astra_scnd_grand }}
                <?php Session::put('total_dfrd_astra_scnd_excel',$total_dfrd_astra_scnd_grand);?>
            </span>
        </td>  <!-- DEFERRED ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_rfsd_astra_scnd_grand }}
                <?php Session::put('total_rfsd_astra_scnd_excel',$total_rfsd_astra_scnd_grand);?>
            </span>
        </td>  <!-- REFUSED ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_wstge_astra_scnd_grand }}
                <?php Session::put('total_wstge_astra_scnd_excel',$total_wstge_astra_scnd_grand);?>
            </span> <!-- WASTAGE ASTRA_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ number_format($total_p_cvrge_astra_scnd_grand,2) }}%
                <?php Session::put('total_p_cvrge_astra_scnd_excel',$total_p_cvrge_astra_scnd_grand);?>
            </span>
        </td> <!-- PERCENT COVERAGE ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ number_format($total_c_rate_astra_scnd_grand,2) }}%
                <?php Session::put('total_c_rate_astra_scnd_excel',$total_c_rate_astra_scnd_grand);?>
            </span>
        </td> <!-- CONSUMPTION RATE ASTRA_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_r_unvcted_scnd_astra_grand }}
                <?php Session::put('total_r_unvcted_scnd_astra_excel',$total_r_unvcted_scnd_astra_grand);?>
            </span>
        </td> <!-- REMAINING UNVACCINATED ASTRA_SECOND -->
    </tr>
    </tbody>
    <!-- SPUTNIKV -->
    <tbody id="collapse_sputnikv_grand" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #b1ffdb">
        <td rowspan="2">

        </td> <!-- 1-5 -->
        <td rowspan="2">
            {{ $total_e_pop_a1_grand }}
            <?php Session::put('total_e_pop_a1_excel',$total_e_pop_a1_grand);?>
        </td>  <!--TOTAL ELIPOP A1 SPUTNIKV-->
        <td rowspan="2">
            {{ $total_e_pop_a2_grand }}
            <?php Session::put('total_e_pop_a2_excel',$total_e_pop_a2_grand);?>
        </td>   <!--TOTAL ELIPOP A2 SPUTNIKV-->
        <td rowspan="2">
            {{ $total_e_pop_a3_grand }}
            <?php Session::put('total_e_pop_a3_excel',$total_e_pop_a3_grand);?>
        </td>  <!--TOTAL ELIPOP A3 SPUTNIKV-->
        <td rowspan="2">
            {{ $total_e_pop_a4_grand }}
            <?php Session::put('total_e_pop_a4_excel',$total_e_pop_a4_grand);?>
        </td>  <!--TOTAL ELIPOP A4  SPUTNIKV-->
        <td rowspan="2">
            {{ $total_e_pop_grand }}
            <?php Session::put('total_e_pop_excel',$total_e_pop_grand);?>
        </td> <!--TOTAL ELI POP  SPUTNIKV-->
        <td rowspan="2" style="color:black">
            {{ $total_vallocated_sputnikv_frst_grand }}
            <?php Session::put('total_vallocated_sputnikv_frst_excel',$total_vallocated_sputnikv_frst_grand);?>
        </td> <!-- VACCINE_ALLOCATED (FD) SPUTNIKV_FIRST-->
        <td rowspan="2" style="color:black">
            {{ $total_vallocated_sputnikv_scnd_grand }}
            <?php Session::put('total_vallocated_sputnikv_scnd_excel',$total_vallocated_sputnikv_scnd_grand);?>
        </td>  <!-- VACCINE ALLOCATED (SD) SPUTNIKV_FIRST -->
        <td rowspan="2" style="color:black;">
            {{ $total_vallocated_frst_sputnikv }}
            <?php Session::put('total_vallocated_frst_sputnikv_excel',$total_vallocated_frst_sputnikv);?>
        </td>  <!-- TOTAL VACCINE ALLOCATED SPUTNIKV_FIRST -->
        <td style="color:black;">
            <span class="label label-success">
                {{ $total_sputnikv_a1_frst_grand }}
                <?php Session::put('total_sputnikv_a1_frst_excel',$total_sputnikv_a1_frst_grand);?>
            </span>
        </td>  <!-- VACCINATED (A1) SPUTNIKV_FIRST -->
        <td style="color:black">
            <span class="label label-success">
                {{ $total_sputnikv_a2_frst_grand }}
                <?php Session::put('total_sputnikv_a2_frst_excel',$total_sputnikv_a2_frst_grand);?>
            </span>
        </td>  <!-- VACCINATED (A2) SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_sputnikv_a3_frst_grand }}
                <?php Session::put('total_sputnikv_a3_frst_excel',$total_sputnikv_a3_frst_grand);?>
            </span>
        </td>  <!-- VACCINATED (A3) SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_sputnikv_a4_frst_grand }}
                <?php Session::put('total_sputnikv_a4_frst_excel',$total_sputnikv_a4_frst_grand);?>
            </span>
        </td> <!-- VACCINATED (A4) SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_vcted_sputnikv_frst_grand }}
                <?php Session::put('total_vcted_sputnikv_frst_excel',$total_vcted_sputnikv_frst_grand);?>
            </span>
        </td> <!-- TOTAL VACCINATED SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_mild_sputnikv_frst_grand }}
                <?php Session::put('total_mild_sputnikv_frst_excel',$total_mild_sputnikv_frst_grand);?>
            </span>
        </td> <!-- MILD SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_srs_sputnikv_frst_grand }}
                <?php Session::put('total_srs_sputnikv_frst_excel',$total_srs_sputnikv_frst_grand);?>
            </span> <!-- SERIOUS SPUTNIKV_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_dfrd_sputnikv_frst_grand }}
                <?php Session::put('total_dfrd_sputnikv_frst_excel',$total_dfrd_sputnikv_frst_grand);?>
            </span>
        </td>  <!-- DEFERRED SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_rfsd_sputnikv_frst_grand }}
                <?php Session::put('total_rfsd_sputnikv_frst_excel',$total_rfsd_sputnikv_frst_grand);?>
            </span>
        </td>  <!-- REFUSED SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_wstge_sputnikv_frst_grand }}
                <?php Session::put('total_wstge_sputnikv_frst_excel',$total_wstge_sputnikv_frst_grand);?>
            </span>
        </td>  <!-- WASTAGE SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ number_format($total_p_cvrge_sputnikv_frst_grand,2) }}%
                <?php Session::put('total_p_cvrge_sputnikv_frst_excel',$total_p_cvrge_sputnikv_frst_grand);?>
            </span>
        </td>  <!-- PERCENT_COVERAGE SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ number_format($total_c_rate_sputnikv_frst_grand,2) }}%
                <?php Session::put('total_c_rate_sputnikv_frst_excel',$total_c_rate_sputnikv_frst_grand);?>
            </span>
        </td>  <!-- CONSUMPTION RATE SPUTNIKV_FIRST -->
        <td>
            <span class="label label-success">
                {{ $total_r_unvcted_frst_sputnikv_grand }}
                <?php Session::put('total_r_unvcted_frst_sputnikv_excel',$total_r_unvcted_frst_sputnikv_grand);?>
            </span> <!-- REMAINUNG UNVACCINATED SPUTNIKV_FIRST -->
        </td>
    </tr>
    <tr style="background-color: #b1ffdb">
        <td style="color: black;">
            <span class="label label-warning">
                {{ $total_sputnikv_a1_scnd_grand }}
                <?php Session::put('total_sputnikv_a1_scnd_excel',$total_sputnikv_a1_scnd_grand);?>
            </span>
        </td>  <!-- VACCINATED (A1) SPUTNIKV_SECOND -->
        <td style="color:black;">
            <span class="label label-warning">
                {{ $total_sputnikv_a2_scnd_grand }}
                <?php Session::put('total_sputnikv_a2_scnd_excel',$total_sputnikv_a2_scnd_grand);?>
            </span>
        </td> <!-- VACCINATED (A2) SPUTNIKV_SECOND -->
        <td style="color:black;">
            <span class="label label-warning">
                {{ $total_sputnikv_a3_scnd_grand }}
                <?php Session::put('total_sputnikv_a3_scnd_excel',$total_sputnikv_a3_scnd_grand);?>
            </span>
        </td>  <!-- VACCINATED (A3) SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_sputnikv_a4_scnd_grand }}
                <?php Session::put('total_sputnikv_a4_scnd_excel',$total_sputnikv_a4_scnd_grand);?>
            </span>
        </td>  <!-- VACCINATED (A4) SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_vcted_sputnikv_scnd_grand }}
                <?php Session::put('total_vcted_sputnikv_scnd_excel',$total_vcted_sputnikv_scnd_grand);?>
            </span>
        </td>  <!-- TOTAL VACCINATED SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_mild_sputnikv_scnd_grand }}
                <?php Session::put('total_mild_sputnikv_scnd_excel',$total_mild_sputnikv_scnd_grand);?>
            </span>
        </td> <!-- MILD SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_srs_sputnikv_scnd_grand }}
                <?php Session::put('total_srs_sputnikv_scnd_excel',$total_srs_sputnikv_scnd_grand);?>
            </span>
        </td> <!-- SERIOUS SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_dfrd_sputnikv_scnd_grand }}
                <?php Session::put('total_dfrd_sputnikv_scnd_excel',$total_dfrd_sputnikv_scnd_grand);?>
            </span>
        </td>  <!-- DEFERRED SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_rfsd_sputnikv_scnd_grand }}
                <?php Session::put('total_rfsd_sputnikv_scnd_excel',$total_rfsd_sputnikv_scnd_grand);?>
            </span>
        </td> <!-- REFUSED SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_wstge_sputnikv_scnd_grand }}
                <?php Session::put('total_wstge_sputnikv_scnd_excel',$total_wstge_sputnikv_scnd_grand);?>
            </span>
        </td>  <!-- WASTAGE SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ number_format($total_p_cvrge_sputnikv_scnd_grand,2) }}%
                <?php Session::put('total_p_cvrge_sputnikv_scnd_excel',$total_p_cvrge_sputnikv_scnd_grand);?>
            </span>
        </td>  <!-- PERCENT COVERAGE SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ number_format($total_c_rate_sputnikv_scnd_grand,2) }}%
                <?php Session::put('total_c_rate_sputnikv_scnd_excel',$total_c_rate_sputnikv_scnd_grand);?>
            </span>
        </td> <!-- CONSUMPTION RATE SPUTNIKV_SECOND -->
        <td>
            <span class="label label-warning">
                {{ $total_r_unvcted_scnd_sputnikv_grand }}
                <?php Session::put('total_r_unvcted_scnd_sputnikv_excel',$total_r_unvcted_scnd_sputnikv_grand);?>
            </span>
        </td>  <!-- REMAINING UNVACCINATED SPUTNIKV_SECOND -->
    </tr>
    </tbody>
    <!-- PFIZER -->
    <tbody id="collapse_pfizer_grand" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <tr style="background-color: #8fe7fd">
        <td rowspan="2">

        </td> <!-- 1-5 -->
        <td rowspan="2">
            {{ $total_e_pop_a1_grand }}
            <?php Session::put('total_e_pop_a1_excel',$total_e_pop_a1_grand );?>
        </td>  <!--TOTAL ELIPOP A1-->
        <td rowspan="2">
            {{ $total_e_pop_a2_grand }}
            <?php Session::put('total_e_pop_a2_excel',$total_e_pop_a2_grand );?>
        </td>   <!--TOTAL ELIPOP A1-->
        <td rowspan="2">
            {{ $total_e_pop_a3_grand }}
            <?php Session::put('total_e_pop_a3_excel',$total_e_pop_a3_grand );?>
        </td>  <!--TOTAL ELIPOP A1-->
        <td rowspan="2">
            {{ $total_e_pop_a4_grand }}
            <?php Session::put('total_e_pop_a4_excel',$total_e_pop_a4_grand );?>
        </td><!--TOTAL ELIPOP A1-->
        <td rowspan="2">
            {{ $total_e_pop_grand }}</td>
             <?php Session::put('total_e_pop_excel',$total_e_pop_grand );?>
        <!--//TOTAL ELI POP-->
        <td rowspan="2" style="color:black">
            {{ $total_vallocated_pfizer_frst_grand }}
            <?php Session::put('total_vallocated_pfizer_frst_excel',$total_vallocated_pfizer_frst_grand );?>
        </td> <!-- VACCINE_ALLOCATED (FD) PFIZER_FIRST-->
        <td rowspan="2" style="color:black">
            {{ $total_vallocated_pfizer_scnd_grand }}
            <?php Session::put('total_vallocated_pfizer_scnd_excel',$total_vallocated_pfizer_scnd_grand );?>
        </td>  <!-- VACCINE ALLOCATED (SD) PFIZER_FIRST -->
        <td rowspan="2" style="color:black;">
            {{ $total_vallocated_frst_pfizer }}
            <?php Session::put('total_vallocated_frst_excel',$total_vallocated_frst_pfizer );?>
        </td>  <!-- TOTAL VACCINE ALLOCATED PFIZER_FIRST -->
        <td style="color:black;">
            <span class="label label-success">
                {{ $total_pfizer_a1_frst_grand }}
                <?php Session::put('total_pfizer_a1_frst_excel',$total_pfizer_a1_frst_grand );?>
            </span>  <!-- VACCINATED (A1) PFIZER_FIRST -->
        </td>
        <td style="color:black">
            <span class="label label-success">
                {{ $total_pfizer_a2_frst_grand }}
                <?php Session::put('total_pfizer_a2_frst_excel',$total_pfizer_a2_frst_grand );?>
            </span> <!-- VACCINATED (A2) PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_pfizer_a3_frst_grand }}
                <?php Session::put('total_pfizer_a3_frst_excel',$total_pfizer_a3_frst_grand );?>
            </span> <!-- VACCINATED (A3) PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_pfizer_a4_frst_grand }}
                <?php Session::put('total_pfizer_a4_frst_excel',$total_pfizer_a4_frst_grand );?>
            </span> <!-- VACCINATED (A4) PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_vcted_pfizer_frst_grand }}
                <?php Session::put('total_vcted_pfizer_frst_excel',$total_vcted_pfizer_frst_grand );?>
            </span> <!-- TOTAL VACCINATED PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_mild_pfizer_frst_grand }}
                <?php Session::put('total_mild_pfizer_frst_excel',$total_mild_pfizer_frst_grand );?>
            </span> <!-- MILD PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_srs_pfizer_frst_grand }}
                <?php Session::put('total_srs_pfizer_frst_excel',$total_srs_pfizer_frst_grand );?>
            </span> <!-- SERIOUS PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_dfrd_pfizer_frst_grand }}
                <?php Session::put('total_dfrd_pfizer_frst_excel',$total_dfrd_pfizer_frst_grand );?>
            </span> <!-- DEFERRED PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_rfsd_pfizer_frst_grand }}
                <?php Session::put('total_rfsd_pfizer_frst_excel',$total_rfsd_pfizer_frst_grand );?>
            </span> <!-- REFUSED PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_wstge_pfizer_frst_grand }}
                <?php Session::put('total_wstge_pfizer_frst_excel',$total_wstge_pfizer_frst_grand );?>
            </span> <!-- WASTAGE PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ number_format($total_p_cvrge_pfizer_frst_grand,2) }}%
                <?php Session::put('total_p_cvrge_pfizer_frst_excel',number_format($total_p_cvrge_pfizer_frst_grand,2));?>
            </span> <!-- PERCENT_COVERAGE PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ number_format($total_c_rate_pfizer_frst_grand,2) }}%
                <?php Session::put('total_c_rate_pfizer_frst_excel',number_format($total_c_rate_pfizer_frst_grand,2));?>
            </span> <!-- CONSUMPTION RATE PFIZER_FIRST -->
        </td>
        <td>
            <span class="label label-success">
                {{ $total_r_unvcted_frst_pfizer_grand }}
                <?php Session::put('total_r_unvcted_frst_pfizer_excel',$total_r_unvcted_frst_pfizer_grand );?>
            </span> <!-- REMAINUNG UNVACCINATED PFIZER_FIRST -->
        </td>
    </tr>
    <tr style="background-color: #8fe7fd">
        <td style="color: black;">
            <span class="label label-warning">
                {{ $total_pfizer_a1_scnd_grand }}
                <?php Session::put('total_pfizer_a1_scnd_excel',$total_pfizer_a1_scnd_grand );?>
            </span>  <!-- VACCINATED (A1) PFIZER_SECOND -->
        </td>
        <td style="color:black;">
            <span class="label label-warning">
                {{ $total_pfizer_a2_scnd_grand }}
                <?php Session::put('total_pfizer_a2_scnd_excel',$total_pfizer_a2_scnd_grand );?>
            </span>  <!-- VACCINATED (A2) PFIZER_SECOND -->
        </td>
        <td style="color:black;">
            <span class="label label-warning">
                {{ $total_pfizer_a3_scnd_grand }}
                <?php Session::put('total_pfizer_a3_scnd_excel',$total_pfizer_a3_scnd_grand );?>
            </span>  <!-- VACCINATED (A3) PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_pfizer_a4_scnd_grand }}
                <?php Session::put('total_pfizer_a4_scnd_excel',$total_pfizer_a4_scnd_grand );?>
            </span>  <!-- VACCINATED (A4) PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_vcted_pfizer_scnd_grand }}
                <?php Session::put('total_vcted_pfizer_scnd_excel',$total_vcted_pfizer_scnd_grand );?>
            </span>  <!-- TOTAL VACCINATED PFIZER_SECOND -->
        </td> <!-- 1-6 -->
        <td>
            <span class="label label-warning">
                {{ $total_mild_pfizer_scnd_grand }}
                <?php Session::put('total_mild_pfizer_scnd_excel',$total_mild_pfizer_scnd_grand );?>
            </span>  <!-- MILD PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_srs_pfizer_scnd_grand }}
                <?php Session::put('total_srs_pfizer_scnd_excel',$total_srs_pfizer_scnd_grand );?>
            </span> <!-- SERIOUS PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_dfrd_pfizer_scnd_grand }}
                <?php Session::put('total_dfrd_pfizer_scnd_excel',$total_dfrd_pfizer_scnd_grand );?>
            </span> <!-- DEFERRED PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_rfsd_pfizer_scnd_grand }}
                <?php Session::put('total_rfsd_pfizer_scnd_excel',$total_rfsd_pfizer_scnd_grand );?>
            </span> <!-- REFUSED PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_wstge_pfizer_scnd_grand }}
                <?php Session::put('total_wstge_pfizer_scnd_excel',$total_wstge_pfizer_scnd_grand );?>
            </span> <!-- WASTAGE PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ number_format($total_p_cvrge_pfizer_scnd_grand,2) }}%
                <?php Session::put('total_p_cvrge_pfizer_scnd_excel',number_format($total_p_cvrge_pfizer_scnd_grand,2) );?>
            </span> <!-- PERCENT COVERAGE PFIZER_SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ number_format($total_c_rate_pfizer_scnd_grand,2) }}%
                <?php Session::put('total_c_rate_pfizer_scnd_excel',number_format($total_c_rate_pfizer_scnd_grand,2) );?>
            </span> <!-- CONSUMPTION RATE PFIZER SECOND -->
        </td>
        <td>
            <span class="label label-warning">
                {{ $total_r_unvcted_scnd_pfizer_grand }}
                <?php Session::put('total_r_unvcted_scnd_pfizer_excel',$total_r_unvcted_scnd_pfizer_grand );?>
            </span> <!-- REMAINING UNVACCINATED PFIZER_SECOND -->
        </td>
    </tr>
    </tbody>


    <tbody>
    <tr>
        <td>Total</td> <!-- 1-7 -->
        <td></td> <!-- TOTAL A1 -->
        <td></td> <!-- TOTAL A2 -->
        <td></td> <!-- TOTAL A3 -->
        <td></td> <!-- TOTAL A4 -->
        <td></td> <!-- TOTAL E POP  -->
        <td>
            {{ $total_vallocated_frst_grand }}
            <?php Session::put('total_vallocated_frst_excel',$total_vallocated_frst_grand );?>
        </td> <!-- TOTAL VACCINE ALLOCATED FIRST -->
        <td>
            {{ $total_vallocated_scnd_grand }}
            <?php Session::put('total_vallocated_scnd_excel',$total_vallocated_scnd_grand );?>
        </td> <!-- TOTAL VACCINE ALLOCATED SECOND -->
        <td><b>
            {{ $total_vallocated }}
            <?php Session::put('total_vallocated_excel',$total_vallocated );?>
            </b></td>  <!-- TOTAL VACCINE ALLOCATED  -->
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{$total_vcted_a1_first_grand }}
            <?php Session::put('total_vcted_a1_first_excel',$total_vcted_a1_first_grand );?>
            </b> <!-- TOTAL VACCINATED (A1) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_vcted_a2_first_grand }}
             <?php Session::put('total_vcted_a2_first_excel',$total_vcted_a2_first_grand );?>
            </b>  <!-- TOTAL VACCINATED (A2) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{$total_vcted_a3_first_grand }}
                <?php Session::put('total_vcted_a3_first_excel',$total_vcted_a3_first_grand );?>
            </b> <!-- TOTAL VACCINATED (A3) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{$total_vcted_a4_first_grand }}
                <?php Session::put('total_vcted_a4_first_excel',$total_vcted_a4_first_grand );?>
            </b> <!-- TOTAL VACCINATED (A4) -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_vcted_first_overall }}
                <?php Session::put('total_vcted_first_overall_excel',$total_vcted_first_overall );?>
            </b>  <!-- TOTAL VACCINATED FIRST DOSE OVERALL-->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_mild_overall_frst }}
                <?php Session::put('total_mild_overall_frst_excel',$total_mild_overall_frst );?>
            </b>  <!--  TOTAL MILD-->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_srs_overall_frst }}
                <?php Session::put('total_srs_overall_frst_excel ',$total_srs_overall_frst );?>
            </b>  <!-- TOTAL SERIOUS -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_dfrd_overall_frst }}
                <?php Session::put('total_dfrd_overall_frst_excel',$total_dfrd_overall_frst );?>
            </b>  <!-- TOTAL DEFERRED -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_rfsd_overall_frst }}
                <?php Session::put('total_rfsd_overall_frst_excel',$total_rfsd_overall_frst );?>
            </b>  <!-- TOTAL REFUSED -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_wstge_overall_first }}
                <?php Session::put('total_wstge_overall_first_excel',$total_wstge_overall_first );?>
            </b>  <!-- TOTAL WASTAGE -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ number_format($total_p_cvrge_overall_frst,2) }}%
                <?php Session::put('total_p_cvrge_overall_frst_excel',number_format($total_p_cvrge_overall_frst,2) );?>
            </b>  <!-- PERCENT_COVERAGE_OVERALL_FIRST -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ number_format($total_c_rate_frst_grand,2) }}%
                <?php Session::put('total_c_rate_frst_excel',$total_c_rate_frst_grand );?>
            </b>  <!-- TOTAL CONSUMPTION RATE -->
        </td>
        <td>
            <b class="label label-success" style="margin-right: 5%">
                {{ $total_r_unvcted_all_frst_grand }}
                <?php Session::put('total_r_unvcted_all_frst_excel',$total_r_unvcted_all_frst_grand );?>
            </b>  <!-- TOTAL REMAINUNG UNVACCINATED  -->
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
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_vcted_scnd_a1_grand }}
                <?php Session::put('total_vcted_scnd_a1_excel',$total_vcted_scnd_a1_grand );?>
            </b> <!-- TOTAL VACCINATED SECOND DOSE A1 -->
        </td>
        <td>

            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_vcted_scnd_a2_grand }}
                <?php Session::put('total_vcted_scnd_a2_excel',$total_vcted_scnd_a2_grand );?>
            </b> <!-- TOTAL VACCINATED SECOND DOSE A2 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_vcted_scnd_a3_grand }}
                <?php Session::put('total_vcted_scnd_a3_excel',$total_vcted_scnd_a3_grand );?>
            </b> <!-- TOTAL VACCINATED SECOND DOSE A3 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_vcted_scnd_a4_grand }}
                <?php Session::put('total_vcted_scnd_a4_excel',$total_vcted_scnd_a4_grand );?>
            </b> <!-- TOTAL VACCINATED SECOND DOSE A4-->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_vcted_scnd_overall }}</b>
                 <?php Session::put('total_vcted_scnd_excel',$total_vcted_scnd_overall );?>
            <!-- //TOTAL VACCINATED SECOND DOSE OVERALL -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_mild_overall_scnd }}
                <?php Session::put('total_mild_overall_scnd_excel',$total_mild_overall_scnd );?>
            </b> <!-- TOTAL MILD 2 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_srs_overall_scnd }}
                <?php Session::put('total_srs_overall_scnd_excel',$total_srs_overall_scnd );?>
            </b> <!-- TOTAL SERIOUS  2 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_dfrd_overall_scnd }}
                <?php Session::put('total_dfrd_overall_scnd_excel',$total_dfrd_overall_scnd );?>
            </b> <!-- TOTAL DEFERRED  2 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_rfsd_overall_scnd }}
                <?php Session::put('total_rfsd_overall_scnd_excel',$total_rfsd_overall_scnd );?>
            </b> <!-- TOTAL REFUSED  2 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_wstge_overall_scnd }}
                <?php Session::put('total_wstge_overall_scnd_excel',$total_wstge_overall_scnd );?>
            </b> <!-- TOTAL WASTAGE  2 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ number_format($total_p_cvrge_overall_scnd,2) }}%
                <?php Session::put('total_p_cvrge_overall_scnd_excel',number_format($total_p_cvrge_overall_scnd,2) );?>
            </b> <!-- PERCENT_COVERAGE_OVERALL_FIRST -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ number_format($total_c_rate_scnd_grand,2) }}%
                <?php Session::put('total_c_rate_scnd_excel',number_format($total_c_rate_scnd_grand,2) );?>
            </b> <!-- TOTAL CONSUMPTION RATE  2 -->
        </td>
        <td>
            <b class="label label-warning" style="margin-right: 5%">
                {{ $total_r_unvcted_all_scnd_grand }}
                <?php Session::put('total_r_unvcted_all_scnd_excel',$total_r_unvcted_all_scnd_grand );?>
            </b> <!-- TOTAL REMAINING UNVACCIANTED  2 -->
        </td>
    </tr>
    </tbody>
</table>