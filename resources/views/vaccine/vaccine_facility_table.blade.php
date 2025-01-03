<form action="{{ asset('vaccine_facility/saved') }}" method="POST" id="form_submit" autocomplete="off">
    {{ csrf_field() }}
    <br>
    <table class="table" style="font-size: 8pt">
        <thead class="bg-gray">
        <tr>
            <th>Dose Date</th>
            <th width="15%">Type Of Vaccine</th>
            <th>Priority</th>
            <th>Vaccinated</th>
            <th>Mild</th>
            <th>Serious</th>
            <th>Refused</th>
            <th>Deferred</th>
            <th>Wastage</th>

        </tr>
        </thead>
        <?php
        //TOTAL PERCENT COVERAGE
        $total_p_cvrge_frst = 0;
        $total_p_cvrge_scnd = 0;

        //TOTAL_VACCINATED_SINOVAC
        $total_e_pop_svac_a1 = 0;
        $total_e_pop_svac_a1_flag = true;
        $total_e_pop_svac_a2 = 0;
        $total_e_pop_svac_a2_flag = true;
        $total_e_pop_svac_a3 = 0;
        $total_e_pop_svac_a3_flag = true;
        $total_e_pop_svac_a4 = 0;
        $total_e_pop_svac_a4_flag = true;

        $total_vallocated_svac = 0;
        $total_vallocated_svac_flag = true;
        $total_vallocated_svac_frst = 0;
        $total_vallocated_svac_scnd = 0;


        $total_vcted_svac_frst = 0;
        $total_vcted_svac_scnd = 0;
        $total_mild_svac_frst = 0;
        $total_mild_svac_scnd = 0;
        $total_srs_svac_frst = 0;
        $total_srs_svac_scnd = 0;
        $total_dfrd_svac_frst = 0;
        $total_dfrd_svac_scnd = 0;
        $total_rfsd_svac_frst = 0;
        $total_rfsd_svac_scnd = 0;
        $total_wstge_svac_frst = 0;
        $total_wstge_svac_scnd = 0;


        //TOTAL_VACCINATED_ASTRAZENECA
        $total_e_pop_astra_a1 = 0;
        $total_e_pop_astra_a1_flag = true;
        $total_e_pop_astra_a2 = 0;
        $total_e_pop_astra_a2_flag = true;
        $total_e_pop_astra_a3 = 0;
        $total_e_pop_astra_a3_flag = true;
        $total_e_pop_astra_a4 = 0;
        $total_e_pop_astra_a4_flag = true;


        $total_vallocated_astra = 0;
        $total_vallocated_astra_flag = true;
        $total_vallocated_astra_frst = 0;
        $total_vallocated_astra_scnd = 0;
        $total_vcted_astra_frst = 0;
        $total_vcted_astra_scnd = 0;
        $total_mild_astra_frst = 0;
        $total_mild_astra_scnd = 0;
        $total_srs_astra_frst = 0;
        $total_srs_astra_scnd = 0;
        $total_dfrd_astra_frst = 0;
        $total_dfrd_astra_scnd = 0;
        $total_rfsd_astra_frst = 0;
        $total_rfsd_astra_scnd = 0;
        $total_wstge_astra_frst = 0;
        $total_wstge_astra_scnd = 0;

        //TOTAL_VACCINATED_SPUTNIKV
        $total_e_pop_sputnikv_a1 = 0;
        $total_e_pop_sputnikv_a1_flag = true;
        $total_e_pop_sputnikv_a2 = 0;
        $total_e_pop_sputnikv_a2_flag = true;
        $total_e_pop_sputnikv_a3 = 0;
        $total_e_pop_sputnikv_a3_flag = true;
        $total_e_pop_sputnikv_a4 = 0;
        $total_e_pop_sputnikv_a4_flag = true;


        $total_vallocated_sputnikv = 0;
        $total_vallocated_sputnikv_flag = true;
        $total_vallocated_sputnikv_frst = 0;
        $total_vallocated_sputnikv_scnd = 0;
        $total_vcted_sputnikv_frst = 0;
        $total_vcted_sputnikv_scnd = 0;
        $total_mild_sputnikv_frst = 0;
        $total_mild_sputnikv_scnd = 0;
        $total_srs_sputnikv_frst = 0;
        $total_srs_sputnikv_scnd = 0;
        $total_dfrd_sputnikv_frst = 0;
        $total_dfrd_sputnikv_scnd = 0;
        $total_rfsd_sputnikv_frst = 0;
        $total_rfsd_sputnikv_scnd = 0;
        $total_wstge_sputnikv_frst = 0;
        $total_wstge_sputnikv_scnd = 0;

        //TOTAL_VACCINATED_PFIZER
        $total_e_pop_pfizer_a1 = 0;
        $total_e_pop_pfizer_a1_flag = true;
        $total_e_pop_pfizer_a2 = 0;
        $total_e_pop_pfizer_a2_flag = true;
        $total_e_pop_pfizer_a3 = 0;
        $total_e_pop_pfizer_a3_flag = true;
        $total_e_pop_pfizer_a4 = 0;
        $total_e_pop_pfizer_a4_flag = true;

        $total_vallocated_pfizer = 0;
        $total_vallocated_pfizer_flag = true;
        $total_vallocated_pfizer_frst = 0;
        $total_vallocated_pfizer_scnd = 0;
        $total_vcted_pfizer_frst = 0;
        $total_vcted_pfizer_scnd = 0;
        $total_mild_pfizer_frst = 0;
        $total_mild_pfizer_scnd = 0;
        $total_srs_pfizer_frst = 0;
        $total_srs_pfizer_scnd = 0;
        $total_dfrd_pfizer_frst = 0;
        $total_dfrd_pfizer_scnd = 0;
        $total_rfsd_pfizer_frst = 0;
        $total_rfsd_pfizer_scnd = 0;
        $total_wstge_pfizer_frst = 0;
        $total_wstge_pfizer_scnd = 0;

        //SINOVAC
        $total_svac_a1_frst = 0;
        $total_svac_a2_frst = 0;
        $total_svac_a3_frst = 0;
        $total_svac_a4_frst = 0;
        $total_svac_a1_scnd = 0;
        $total_svac_a2_scnd = 0;
        $total_svac_a3_scnd = 0;
        $total_svac_a4_scnd = 0;

        //ASTRAZENECA
        $total_astra_a1_frst = 0;
        $total_astra_a2_frst = 0;
        $total_astra_a3_frst = 0;
        $total_astra_a4_frst = 0;
        $total_astra_a1_scnd = 0;
        $total_astra_a2_scnd = 0;
        $total_astra_a3_scnd = 0;
        $total_astra_a4_scnd = 0;

        //ASTRAZENECA
        $total_sputnikv_a1_frst = 0;
        $total_sputnikv_a2_frst = 0;
        $total_sputnikv_a3_frst = 0;
        $total_sputnikv_a4_frst = 0;
        $total_sputnikv_a1_scnd = 0;
        $total_sputnikv_a2_scnd = 0;
        $total_sputnikv_a3_scnd = 0;
        $total_sputnikv_a4_scnd = 0;

        //ASTRAZENECA
        $total_pfizer_a1_frst = 0;
        $total_pfizer_a2_frst = 0;
        $total_pfizer_a3_frst = 0;
        $total_pfizer_a4_frst = 0;
        $total_pfizer_a1_scnd = 0;
        $total_pfizer_a2_scnd = 0;
        $total_pfizer_a3_scnd = 0;
        $total_pfizer_a4_scnd = 0;

        ?>
        @if(count($vaccine_accomplishment)>0)
            @foreach($vaccine_accomplishment as $vaccine)
                <?php
                //modified vaccine accomplishment table
                if($vaccine->priority == 'a1'){
                    $facility = \App\Facility::find($vaccine->facility_id);
                    $vaccine->no_eli_pop = $facility->a1;
                }
                elseif($vaccine->priority == 'a2'){
                    $facility = \App\Facility::find($vaccine->facility_id);
                    $vaccine->no_eli_pop = $facility->a2;
                }
                elseif($vaccine->priority == 'a3'){
                    $facility = \App\Facility::find($vaccine->facility_id);
                    $vaccine->no_eli_pop = $facility->a3;
                }
                elseif($vaccine->priority == 'a4'){
                    $facility = \App\Facility::find($vaccine->facility_id);
                    $vaccine->no_eli_pop = $facility->a4;
                }

                if($vaccine->typeof_vaccine == 'Sinovac'){
                    $facility = \App\Facility::find($vaccine->facility_id);
                    $vaccine->vaccine_allocated_first = $facility->sinovac_allocated_first;
                    $vaccine->vaccine_allocated_second = $facility->sinovac_allocated_second;
                    $total_vallocated_svac_frst += $facility->sinovac_allocated_first; //VACCINE ALLOCATED(FD) SINOVAC FIRST
                    $total_vallocated_svac_scnd += $facility->sinovac_allocated_second; //VACCINE ALLOCATED(SD) SINOVAC FIRST
                }
                elseif($vaccine->typeof_vaccine == 'Astrazeneca'){
                    $facility = \App\Facility::find($vaccine->facility_id);
                    $vaccine->vaccine_allocated_first = $facility->astrazeneca_allocated_first;
                    $vaccine->vaccine_allocated_second = $facility->astrazeneca_allocated_second;
                    $total_vallocated_astra_frst += $facility->astrazeneca_allocated_first; //VACCINE ALLOCATED(FD) ASTRA FIRST
                    $total_vallocated_astra_scnd += $facility->astrazeneca_allocated_second; //VACCINE ALLOCATED(SD) ASTRA FIRST
                }


                if($vaccine->typeof_vaccine == "Sinovac"){
                    $total_e_pop_svac_a1 = $facility->a1; //A1 SINOVAC
                    $total_e_pop_svac_a2 = $facility->a2; //A2 SINOVAC
                    $total_e_pop_svac_a3 = $facility->a3; //A3 SINOVAC
                    $total_e_pop_svac_a4 = $facility->a4; //A4 SINOVAC
                    if($vaccine->priority == "a1"){
                        $total_svac_a1_frst += $vaccine->vaccinated_first; //VACCINATED (A1) SINOVAC FIRST
                        $total_svac_a1_scnd += $vaccine->vaccinated_second; //VACCINATED (A1) SINOVAC SECOND
                    }
                    elseif($vaccine->priority == "a2"){
                        $total_svac_a2_frst += $vaccine->vaccinated_first; //VACCINATED (A2) SINOVAC FIRST
                        $total_svac_a2_scnd += $vaccine->vaccinated_second; //VACCINATED (A2) SINOVAC SECOND

                    }
                    elseif($vaccine->priority == "a3"){
                        $total_svac_a3_frst += $vaccine->vaccinated_first; //VACCINATED (A3) SINOVAC FIRST
                        $total_svac_a3_scnd += $vaccine->vaccinated_second; //VACCINATED (A3) SINOVAC SECOND

                    }
                    elseif($vaccine->priority == "a4"){
                        $total_svac_a4_frst += $vaccine->vaccinated_first; //VACCINATED (A4) SINOVAC FIRST
                        $total_svac_a4_scnd += $vaccine->vaccinated_second; //VACCINATED (A4) SINOVAC SECOND

                    }
                    if($total_vallocated_svac_flag){
                        $total_vallocated_svac += $vaccine->vaccine_allocated;
                        $total_vallocated_svac_flag = false;
                    }
                    $total_vcted_svac_frst += $vaccine->vaccinated_first; //TOTAL VACCINATED SINOVAC FIRST
                    $total_vcted_svac_scnd += $vaccine->vaccinated_second; //TOTAL VACCINATED SINOVAC SECOND
                    $total_mild_svac_frst += $vaccine->mild_first; //MILD SINOVAC  FIRST
                    $total_mild_svac_scnd += $vaccine->mild_second; //MILD SINOVAC SECOND
                    $total_srs_svac_frst += $vaccine->serious_first; //SERIOUS SINOVAC FIRST
                    $total_srs_svac_scnd += $vaccine->serious_second; //SERIOUS SINOVAC SECOND
                    $total_dfrd_svac_frst += $vaccine->deferred_first; //DEFERRED SINOVAC FIRST
                    $total_dfrd_svac_scnd += $vaccine->deferred_second; //DEFERRED SINOVAC SECOND
                    $total_rfsd_svac_frst += $vaccine->refused_first; //REFUSED SINOVAC  FIRST
                    $total_rfsd_svac_scnd += $vaccine->refused_second; //REFUSED SINOVAC SECOND
                    $total_wstge_svac_frst += $vaccine->wastage_first; //WASTAGE SINOVAC  FIRST
                    $total_wstge_svac_scnd += $vaccine->wastage_second; //WASTAGE SINOVAC SECOND
                }

                if($vaccine->typeof_vaccine == "Astrazeneca"){
                    $total_e_pop_astra_a1 = $facility->a1;
                    $total_e_pop_astra_a2 = $facility->a2;
                    $total_e_pop_astra_a3 = $facility->a3;
                    $total_e_pop_astra_a4 = $facility->a4;
                    if($vaccine->priority == "a1"){
                        $total_astra_a1_frst += $vaccine->vaccinated_first; // VACCINATED (A1) ASTRA FIRST
                        $total_astra_a1_scnd += $vaccine->vaccinated_second; //VACCINATED (A1) ASTRA SECOND
                    }
                    elseif($vaccine->priority == "a2" ){
                        $total_astra_a2_frst += $vaccine->vaccinated_first; //VACCINATED (A2) ASTRA FIRST
                        $total_astra_a2_scnd += $vaccine->vaccinated_second; //VACCINATED (A2) ASTRA SECOND
                    }
                    elseif($vaccine->priority == "a3" ){
                        $total_astra_a3_frst += $vaccine->vaccinated_first; //VACCINATED (A3) ASTRA FIRST
                        $total_astra_a3_scnd += $vaccine->vaccinated_second; //VACCINATED (A3) ASTRA SECOND
                    }
                    elseif($vaccine->priority == "a4" ){
                        $total_astra_a4_frst += $vaccine->vaccinated_first; //VACCINATED (A4) ASTRA FIRST
                        $total_astra_a4_scnd += $vaccine->vaccinated_second; //VACCINATED (A4) ASTRA SECOND
                    }
                    if($total_vallocated_astra_flag){
                        $total_vallocated_astra += $vaccine->vaccine_allocated;
                        $total_vallocated_astra_flag = false;
                    }

                    $total_vcted_astra_frst += $vaccine->vaccinated_first; //TOTAL VACCINATED  ASTRA FIRST
                    $total_vcted_astra_scnd += $vaccine->vaccinated_second; //TOTAL VACCINATED ASTRA SECOND
                    $total_mild_astra_frst += $vaccine->mild_first; //MILD ASTRA FIRST
                    $total_mild_astra_scnd += $vaccine->mild_second; //MILD ASTRA SECOND
                    $total_srs_astra_frst += $vaccine->serious_first; //SERIOUS ASTRA FIRST
                    $total_srs_astra_scnd += $vaccine->serious_second; //SERIOUS ASTRA SECOND
                    $total_dfrd_astra_frst += $vaccine->deferred_first; //DEFERRED ASTRA FIRST
                    $total_dfrd_astra_scnd += $vaccine->deferred_second; //DEFERRED ASTRA SECOND
                    $total_rfsd_astra_frst += $vaccine->refused_first; //REFUSED ASTRA FIRST
                    $total_rfsd_astra_scnd += $vaccine->refused_second; //REFUSED ASTRA SECOND
                    $total_wstge_astra_frst += $vaccine->wastage_first; //WASTAGE ASTRA FIRST
                    $total_wstge_astra_scnd += $vaccine->wastage_second; //WASTAGE ASTRA SECOND

                }



                $total_allocated_overall_svac_frst = $total_vallocated_svac_frst + $total_vallocated_svac_scnd; //VACCINE ALLOCATED TOTAL SINOVAC
                $total_allocated_overall_astra_frst = $total_vallocated_astra_frst + $total_vallocated_astra_scnd; //TOTAL VACCINE ALLOCATED ASTRA FIRST




                $total_e_pop_svac = $total_e_pop_svac_a1 + $total_e_pop_svac_a2 + $total_e_pop_svac_a3 + $total_e_pop_svac_a4 ;  //ELIPOP TOTAL SINOVAC FIRST
                $total_e_pop_astra = $total_e_pop_astra_a1 + $total_e_pop_astra_a2 + $total_e_pop_astra_a3 + $total_e_pop_astra_a4;  //ELIPOP TOTAL ASTRA FIRST
                $total_e_pop = $facility->a1 + $facility->a2 + $facility->a3 + $facility->a4; //TOTAL_ELI_POP

                $p_cvrge_astra_frst = ($total_vcted_astra_frst / $total_e_pop_astra) * 100; //PERCENT COVERAGE ASTRA FIRST
                $p_cvrge_astra_scnd = ($total_vcted_astra_scnd / $total_e_pop_astra) * 100; //PERCENT COVERAGE ASTRA SECOND
                $p_cvrge_svac_frst = ($total_vcted_svac_frst / $total_e_pop_svac) * 100; //PERCENT COVERAGE SINOVAC FIRST
                $p_cvrge_svac_scnd = ($total_vcted_svac_scnd / $total_e_pop_svac) * 100; //PERCENT COVERAGE SINOVAC SECOND


                $total_allocated_frst = $total_vallocated_svac_frst + $total_vallocated_astra_frst; //TOTAL ALLOCATED_FIRST
                $total_allocated_scnd = $total_vallocated_svac_scnd + $total_vallocated_astra_scnd; //TOTAL ALLOCATED_SECOND
                $total_allocated = $total_allocated_frst + $total_allocated_scnd; //TOTAL_ALLOCATED

                $total_vcted_frst = $total_vcted_svac_frst + $total_vcted_astra_frst; //TOTAL_VACCINATED
                $total_vcted_scnd = $total_vcted_svac_scnd + $total_vcted_astra_scnd; //TOTAL_VACCINATED 2


                $total_mild_frst = $total_mild_svac_frst + $total_mild_astra_frst; //TOTAL_MILD
                $total_mild_scnd = $total_mild_svac_scnd + $total_mild_astra_scnd; //TOTAL_MILD 2

                $total_srs_frst = $total_srs_svac_frst + $total_srs_astra_frst; //TOTAL_SERIOUS
                $total_srs_scnd = $total_srs_svac_scnd + $total_srs_astra_scnd; //TOTAL_SERIOUS 2

                $total_dfrd_frst = $total_dfrd_svac_frst + $total_dfrd_astra_frst; //TOTAL_DEFERRED
                $total_dfrd_scnd = $total_dfrd_svac_scnd + $total_dfrd_astra_scnd; //TOTAL_DEFERRED 2

                $total_rfsd_frst = $total_rfsd_svac_frst + $total_rfsd_astra_frst; //TOTAL_REFUSED
                $total_rfsd_scnd = $total_rfsd_svac_scnd + $total_rfsd_astra_scnd; //TOTAL_REFUSED 2

                $total_wstge_frst = $total_wstge_svac_frst + $total_wstge_astra_frst; //TOTAL_WASTAGE
                $total_wstge_scnd = $total_wstge_svac_scnd + $total_wstge_astra_scnd; //TOTAL_WASTAGE 2

                $total_p_cvrge_frst = $total_vcted_frst / $total_e_pop * 100; //TOTAL_PERCENT_COVERAGE
                $total_p_cvrge_scnd = $total_vcted_scnd / $total_e_pop * 100; //TOTAL_PERCENT_COVERAGE_2



                $total_remaining = $total_e_pop - $total_vcted_frst - $total_rfsd_frst; //TOTAL_REMAINING_UNVACCINATED
                $total_remaining_scnd = $total_e_pop - $total_vcted_scnd - $total_rfsd_scnd; //TOTAL_REMAINING_UNVACCINATED 2


                $total_c_rate_svac_frst =  $total_vcted_svac_frst / $total_vallocated_svac_frst * 100; //CONSUMPTION RATE SINOVAC FIRST
                $total_c_rate_svac_scnd = $total_vcted_svac_scnd / $total_vallocated_svac_scnd * 100; //CONSUMPTION RATE SINOVAC SECOND
                $total_c_rate_astra_frst =  $total_vcted_astra_frst / $total_vallocated_astra_frst * 100; //CONSUMPTION RATE ASTRA FIRST
                $total_c_rate_astra_scnd =  $total_vcted_astra_scnd / $total_vallocated_astra_scnd * 100; //CONSUMPTION RATE ASTRA SECOND

                $total_c_rate_frst = number_format($total_vcted_frst / $total_allocated_frst * 100,2); //TOTAL_CONSUMPTION_RATE //DARAAAA
                $total_c_rate_scnd = number_format($total_vcted_scnd / $total_allocated_scnd * 100,2); //TOTAL_CONSUMPTION_RATE 2



                ?>
                <tr style="background-color: #59ab91">
                    <input type="hidden" name="province_id" value="{{ $province_id }}">
                    <input type="hidden" name="facility_id" value="{{ $facility_id }}">
                    <input type="hidden" name="vaccine_id[]" value="{{ $vaccine->id }}">
                    <td style="width: 15%">
                        <input type="text" id="date_picker{{ $vaccine->id.$vaccine->encoded_by }}" name="date_first[]" value="<?php if(isset($vaccine->date_first)) echo date('m/d/Y',strtotime($vaccine->date_first)) ?>" class="form-control" required>
                    </td>
                    <td rowspan="2">
                        <select name="typeof_vaccine[]" id="typeof_vaccine" class="select2" required>
                            <option value="">Select Option</option>
                            <option value="Sinovac" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'Sinovac')echo 'selected';} ?>>Sinovac</option>
                            <option value="Astrazeneca" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'Astrazeneca')echo 'selected';} ?>>Astrazeneca</option>
                            <option value="Sputnikv" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'Sputnikv')echo 'selected';} ?>>Sputnikv</option>
                            <option value="Pfizer" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'Pfizer')echo 'selected';} ?>>Pfizer</option>
                        </select>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6" style="padding: 2%;">
                                <input type="text" name="vaccine_allocated_first[]" value="<?php if(isset($vaccine->vaccine_allocated_first)) echo $vaccine->vaccine_allocated_first; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-6" style="background-color: #f39c12;padding: 2%">
                                <input type="text" name="vaccine_allocated_second[]" value="<?php if(isset($vaccine->vaccine_allocated_second)) echo $vaccine->vaccine_allocated_second; ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </td>
                    <td style="width: 15%" rowspan="2">
                        <select name="priority[]" id="priority{{ $vaccine->id.$vaccine->encoded_by }}" class="select2" onchange="getEliPop('<?php echo $facility_id; ?>','<?php echo $vaccine->id.$vaccine->encoded_by; ?>')">
                            <option value="">Select Priority</option>
                            <option value="a1" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'a1')echo 'selected';} ?>>A1</option>
                            <option value="a2" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'a2')echo 'selected';} ?>>A2</option>
                            <option value="a3" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'a3')echo 'selected';} ?> >A3</option>
                            <option value="a4" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'a4')echo 'selected';} ?> >A4</option>
                            <option value="a5" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'a5')echo 'selected';} ?> disabled>A5</option>
                            <option value="b1" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'b1')echo 'selected';} ?> disabled>B1</option>
                            <option value="b2" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'b2')echo 'selected';} ?> disabled>B2</option>
                            <option value="b3" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'b3')echo 'selected';} ?> disabled>B3</option>
                            <option value="b4" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'b4')echo 'selected';} ?> disabled >B4</option>
                            <option value="b5" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'b5')echo 'selected';} ?> disabled>B5</option>
                            <option value="b6" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'b6')echo 'selected';} ?> disabled>B6</option>
                            <option value="c" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'C')echo 'selected';} ?> disabled >C</option>
                        </select>
                        <br><br>
                        <input type="text" name="no_eli_pop[]" id="no_eli_pop{{ $vaccine->id.$vaccine->encoded_by }}" value="{{ $vaccine->no_eli_pop }}" class="form-control" readonly>
                    </td>
                    <td style="width: 5%">
                        <input type="text" name="vaccinated_first[]"  value="<?php if(isset($vaccine->vaccinated_first)) echo $vaccine->vaccinated_first ?>" class="form-control">
                    </td>
                    <td style="width: 5%">
                        <input type="text" name="mild_first[]" value="<?php if(isset($vaccine->mild_first)) echo $vaccine->mild_first ?>" class="form-control">
                    </td>
                    <td style="width: 5%">
                        <input type="text" name="serious_first[]" value="<?php if(isset($vaccine->serious_first)) echo $vaccine->serious_first ?>" class="form-control">
                    </td>
                    <td style="width: 10%">
                        <input type="text" name="refused_first[]" value="<?php if(isset($vaccine->refused_first)) echo $vaccine->refused_first ?>" class="form-control">
                    </td>
                    <td style="width: 10%">
                        <input type="text" name="deferred_first[]" value="<?php if(isset($vaccine->deferred_first)) echo $vaccine->deferred_first ?>" class="form-control">
                    </td>
                    <td style="width: 10%">
                        <input type="text" name="wastage_first[]" value="<?php if(isset($vaccine->wastage_first)) echo $vaccine->wastage_first?>" class="form-control">
                    </td>
                </tr>
                <tr style="background-color: #f39c12">
                    <td>
                        <input type="text" id="date_picker2{{ $vaccine->id.$vaccine->encoded_by }}" name="date_second[]" value="<?php if(isset($vaccine->date_second)) echo date('m/d/Y',strtotime($vaccine->date_second)) ?>" class="form-control">
                    </td>

                    <td>
                        <input type="text" name="vaccinated_second[]" value="<?php if(isset($vaccine->vaccinated_second)) echo $vaccine->vaccinated_second ?>" class="form-control">
                    </td>
                    <td style="width: 5%">
                        <input type="text" name="mild_second[]" value="<?php if(isset($vaccine->mild_second)) echo $vaccine->mild_second ?>" class="form-control">
                    </td>
                    <td style="width: 5%">
                        <input type="text" name="serious_second[]" value="<?php if(isset($vaccine->serious_first)) echo $vaccine->serious_second ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="refused_second[]" value="<?php if(isset($vaccine->refused_second)) echo $vaccine->refused_second ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="deferred_second[]" value="<?php if(isset($vaccine->deferred_second)) echo $vaccine->deferred_second ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="wastage_second[]" value="<?php if(isset($vaccine->wastage_second)) echo $vaccine->wastage_second?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td colspan="9"><hr></td>
                </tr>
                <script>
                    $("#date_picker"+"{{ $vaccine->id.$vaccine->encoded_by }}").daterangepicker({
                        "singleDatePicker":true
                    });
                    $("#date_picker2"+"{{ $vaccine->id.$vaccine->encoded_by }}").daterangepicker({
                        "singleDatePicker":true
                    });
                </script>
            @endforeach
        @endif
        <script>
            $("#date_picker").daterangepicker({
                "singleDatePicker":true
            });
            $("#date_picker2").daterangepicker({
                "singleDatePicker":true
            });
        </script>
        <tbody id="tbody_content_vaccine">

        </tbody>
        <tr>
            <td colspan="9">
                <a href="#" onclick="addTbodyContent('<?php echo $province_id; ?>','<?php echo $facility_id; ?>')" class="pull-right red" id="workAdd"><i class="fa fa-user-plus"></i> Add Daily Accomplishment</a>
            </td>
        </tr>
    </table>
    <div class="row">
        <div class="col-md-6">
            {{ $vaccine_accomplishment->links() }}
        </div>
        <div class="col-md-6">
            <br>
            <div class="pull-right">
                <button type="button" class="btn btn-default btn-md" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-success btn-md" onclick="javascript=this.disabled = true; form.submit();"><i class="fa fa-send"></i> Submit</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(".select2").select2({ width: '100%' });
</script>