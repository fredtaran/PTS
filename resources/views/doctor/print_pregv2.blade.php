<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            .page {
                background-color: white;
                position: relative;
                z-index: 0;
            }

            .vector {
                position: absolute;
                z-index: 1;
            }

            .image {
                position: absolute;
                z-index: 2;
            }

            .text {
                position: absolute;
                z-index: 3;
                opacity: inherit;
                white-space: nowrap;
            }
        </style>
    </head>

    <body style="background-color:#999999;color:#000000;" data-new-gr-c-s-check-loaded="14.1100.0" data-gr-ext-installed="">
        <div id="canvas" align="center">

            <!-- page 1 begin -->
            <div class="page" style="width:1024.0px;height:1686.6px;">

                <span style="font-size:18px;font-family:&#39;Arial&#39;;">
                    <span class="text" style="left:418.5px;top:27.3px;">Republic of the Philippines&nbsp;</span>
                    <span class="text" style="left:439.6px;top:48.4px;">Department of Health&nbsp;</span>
                </span>
                <span style="font-size:18px;font-family:&#39;Arial&#39;;font-weight:bold;">
                    <span class="text" style="left:354.7px;top:69.5px;">CENTER FOR HEALTH DEVELOPMENT&nbsp;</span>
                </span>
                <span style="font-size:18px;font-family:&#39;Arial&#39;;">
                    <span class="text" style="left:417.7px;top:90.8px;">Northern Mindanao Region</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:226.7px;top:134.6px;">RISK ASSESSMENT CHECK LIST FOR HIGH-RISK PREGNANT
                        WOMEN&nbsp;</span>
                    <span class="text" style="left:90.4px;top:153.8px;">A.</span>
                    <span class="text" style="left:120.5px;top:153.8px;">Personal Data&nbsp;</span>
                    <span class="text" style="left:615.1px;top:153.8px;">Date:</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:662.5px;top:153.8px;">{{ @$data['form']->referred_date_name }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:69.7px;top:177.7px;">Name of Facility:
                        {{ @$data['form']->referring_facility_name }} &nbsp;</span>
                    <span class="text" style="left:626.8px;top:177.7px;">Address of Facility:
                        {{ @$facility_address }}&nbsp;</span>
                    <span class="text" style="left:69.7px;top:196.0px;">Name of Patient:
                        {{ @$data['form']->woman_name }}&nbsp;</span>
                    <span class="text" style="left:626.8px;top:196.0px;">Age/Sex: {{ @$data['form']->woman_age }} /
                        {{ @$data['form']->sex }} &nbsp;</span>
                    <span class="text" style="left:69.7px;top:214.1px;">
                        Address of Patient: <span class="text"
                            style="font-size:12px; margin-top:3px">{{ @$data['form']->patient_brgy }}
                            {{ @$data['form']->patient_muncity }} {{ @$data['form']->patient_province }}&nbsp;</span>
                    </span>
                    <span class="text" style="left:626.8px;top:214.1px;">Birthday</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:684.6px;top:214.1px;">: {{ @$data['form']->bday }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:69.7px;top:232.1px;">Contact No. of Patient:
                        {{ @$data['form']->contact }}&nbsp;</span>
                    <span class="text" style="left:626.8px;top:232.1px;">Religion</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:680.6px;top:232.1px;">: {{ @$data['form']->religion }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:69.7px;top:250.4px;">Philhealth Number:
                        {{ @$data['form']->phic_id }}&nbsp;</span>
                    <span class="text" style="left:626.8px;top:250.4px;">Ethnicity</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:686.4px;top:250.4px;">: {{ @$data['form']->ethnicity }}&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:69.7px;top:268.5px;">Family Monthly Income:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:252.6px;top:270.1px;">Rich(&gt;219,140)</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:348.6px;top:270.1px;">
                        @if (@$data['form']->family_income == 'rich')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:380.2px;top:270.1px;">High(131,484-219,140)</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:523.1px;top:270.1px;">
                        @if (@$data['form']->family_income == 'high')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:69.7px;top:287.8px;">Upper-Middle(76,670-131,483)</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:261.3px;top:287.8px;">
                        @if (@$data['form']->family_income == 'upper_middle')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:277.7px;top:287.8px;">&nbsp;&nbsp;Middle(43,829-76,669)</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:427.0px;top:287.8px;">
                        @if (@$data['form']->family_income == 'middle')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:69.7px;top:305.0px;">Lowe</span>
                    <span class="text" style="left:104.0px;top:305.0px;">r-Middle(21,915-43,828)</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:255.6px;top:305.0px;">
                        @if (@$data['form']->family_income == 'lower_middle')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:287.2px;top:305.0px;">Low(10,958-21,914)</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:412.7px;top:305.0px;">
                        @if (@$data['form']->family_income == 'low')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:444.2px;top:305.0px;">Poor(&lt; 10,957)</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:536.4px;top:305.0px;">
                        @if (@$data['form']->family_income == 'poor')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:626.8px;top:268.5px;">Marital Status:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:741.0px;top:270.1px;">Single</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:779.8px;top:270.1px;">
                        @if (@$data['form']->woman_status == 'Single')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:800.9px;top:270.1px;">Married</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:850.3px;top:270.1px;">
                        @if (@$data['form']->woman_status == 'Married')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:877.8px;top:270.1px;">&nbsp;Divorced</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:938.2px;top:270.1px;">
                        @if (@$data['form']->woman_status == 'Divorced')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:626.8px;top:287.8px;">Widowed</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:685.6px;top:287.8px;">
                        @if (@$data['form']->woman_status == 'Widowed')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:713.3px;top:287.8px;">Legally Separated</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:822.4px;top:287.8px;">
                        @if (@$data['form']->woman_status == 'Separated')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:69.7px;top:323.3px;">Educational Attainment:</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:256.2px;top:323.3px;">Elementary</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:333.4px;top:323.3px;">
                        @if (@$data['form']->educ_attainment == 'elementary')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:368.5px;top:323.3px;">Highschool</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:445.6px;top:323.3px;">
                        @if (@$data['form']->educ_attainment == 'highschool')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:489.0px;top:323.3px;">College</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:541.0px;top:323.3px;">
                        @if (@$data['form']->educ_attainment == 'college')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:626.8px;top:323.3px;">Sibling Rank:</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:726.0px;top:323.3px;">&nbsp;
                        {{ @$data['form']->sibling_rank }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:750.6px;top:324.9px;">out of</span>
                    <span class="text" style="left:790.1px;top:324.9px;"> &nbsp;{{ @$data['form']->out_of }}</span>
                </span>
                <span style="left:210.3px;font-size:13px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:210.3px;top:345.4px;">Gravidity:</span>
                    <span class="text"
                        style="left:265.6px;top:345.4px;">&nbsp;{{ @$data['form']->gravidity }}&nbsp;</span>
                    <span class="text" style="left:300.6px;top:345.4px;">Parity:</span>
                    <span class="text" style="left:335.4px;top:345.4px;">&nbsp;{{ @$data['form']->parity }}&nbsp;</span>
                    <span class="text" style="left:370.9px;top:345.4px;">FTPAL: {{ @$data['form']->ftpal }}</span>
                    <span class="text" style="left:450.6px;top:345.4px;">LMP:</span>
                    <span class="text" style="left:485.4px;top:345.4px;">{{ @$data['form']->patient_lmp }}</span>
                    <span class="text" style="left:610.9px;top:345.4px;">EDC/EDD:</span>
                    <span class="text"
                        style="left:681.8px;top:345.4px;">{{ @$data['form']->patient_edc_edd }}&nbsp;</span>
                    <span class="text" style="left:215.3px;top:363.1px;">Height:</span>
                    <span class="text" style="left:255.9px;top:363.1px;">{{ @$data['form']->height }}&nbsp;</span>
                    <span class="text" style="left:290.9px;top:363.1px;">Weight:</span>
                    <span class="text" style="left:335.3px;top:363.1px;">{{ @$data['form']->weigth }}&nbsp;</span>
                    <span class="text" style="left:365.0px;top:363.1px;">BMI:</span>
                    <span class="text" style="left:390.0px;top:363.1px;">&nbsp;{{ @$data['form']->bmi }}&nbsp;</span>
                    <span class="text" style="left:430.7px;top:363.1px;">Fundic Height:</span>
                    <span class="text"
                        style="left:510.8px;top:363.1px;">{{ @$data['form']->fundic_height }}&nbsp;</span>
                    <span class="text" style="left:550.7px;top:363.1px;">BP:</span>
                    <span class="text" style="left:570.2px;top:363.1px;">{{ @$data['form']->bp }}&nbsp;</span>
                    <span class="text" style="left:615.0px;top:363.1px;">HR:</span>
                    <span class="text" style="left:640.5px;top:363.1px;">{{ @$data['form']->hr }}&nbsp;</span>
                    <span class="text" style="left:670.2px;top:363.1px;">RR:</span>
                    <span class="text" style="left:695.1px;top:363.1px;">{{ @$data['form']->rr }}&nbsp;</span>
                    <span class="text" style="left:724.3px;top:363.1px;">Temp.:</span>
                    <span class="text" style="left:762.7px;top:363.1px;">&nbsp;{{ @$data['form']->temp }}&nbsp;</span>
                    <span class="text" style="left:160.6px;top:380.9px;">Td1:</span>
                    <span class="text"
                        style="left:182.1px;top:380.9px;">&nbsp;{{ @$data['form']->patient_td1 }}&nbsp;</span>
                    <span class="text" style="left:295.8px;top:380.9px;">Td2:</span>
                    <span class="text" style="left:320.1px;top:380.9px;">&nbsp;{{ @$data['form']->patient_td2 }}</span>
                    <span class="text" style="left:440.2px;top:380.9px;">Td3:</span>
                    <span class="text" style="left:465.7px;top:380.9px;">&nbsp;{{ @$data['form']->patient_td3 }}</span>
                    <span class="text" style="left:570.2px;top:380.9px;">Td4:</span>
                    <span class="text" style="left:595.7px;top:380.9px;">&nbsp;{{ @$data['form']->patient_td4 }}</span>
                    <span class="text" style="left:700.6px;top:380.9px;">Td5:</span>
                    <span class="text"
                        style="left:720.1px;top:380.9px;">&nbsp;{{ @$data['form']->patient_td5 }}&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:90.4px;top:398.4px;">B</span>
                    <span class="text" style="left:101.4px;top:398.4px;">.</span>
                    <span class="text" style="left:120.5px;top:398.4px;">Antepartum Conditions (Medical/Obstetrical
                        History)&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:511.1px;top:398.4px;">Place a</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:565.9px;top:398.4px;"></span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:581.0px;top:398.4px;">&nbsp;if Yes,</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:632.0px;top:398.4px;"></span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:647.0px;top:398.4px;">&nbsp;if No</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:369.5px;top:418.5px;">Risk Factors&nbsp;</span>
                    <span class="text" style="left:788.2px;top:418.5px;">Remarks/Management&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:436.6px;">
                        @if (@$data['antepartum']->hypertension == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:436.6px;">Hypertension&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:211.5px;top:436.6px;">
                        @if (@$data['antepartum']->anemia == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:228.1px;top:436.6px;">Anemia&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:329.6px;top:436.6px;">
                        @if (@$data['antepartum']->malaria == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:346.2px;top:436.6px;">Malaria&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:459.9px;top:436.6px;">
                        @if (@$data['antepartum']->cancer == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:476.5px;top:436.6px;">Cancer&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:609.7px;top:436.6px;">
                        @if (@$data['antepartum']->allergies == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:626.4px;top:436.6px;">Allergies&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:769.2px;top:436.6px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:777.6px;top:443.2px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:808.3px;top:436.6px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:817.2px;top:443.2px; white-space:normal; width: 145px; word-wrap:break-word">{{ @$data['antepartum']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:769.2px;top:471.3px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:780.8px;top:478.0px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:807.5px;top:471.3px;">:</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:769.2px;top:488.8px;">BP: {{ @$data['antepartum']->bp }}</span>
                    <span class="text" style="left:843.8px;top:488.8px;">Temp:
                        {{ @$data['antepartum']->temp }}&nbsp;</span>
                    <span class="text" style="left:769.2px;top:502.2px;">HR: {{ @$data['antepartum']->hr }}</span>
                    <span class="text" style="left:843.8px;top:502.2px;">RR: {{ @$data['antepartum']->rr }}&nbsp;</span>
                    <span class="text" style="left:769.2px;top:515.7px;">FH: {{ @$data['antepartum']->fh }}</span>
                    <span class="text" style="left:842.4px;top:515.7px;">&nbsp;FHT:
                        {{ @$data['antepartum']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:769.2px;top:542.6px;white-space:normal; width: 195px; word-wrap:break-word">Other
                        Physical Examination: {{ @$data['antepartum']->other_physical_exam }} &nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:769.2px;top:571.3px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:780.0px;top:577.9px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:851.5px;top:571.3px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:770.3px;top:585.9px;white-space:normal; width: 192px; word-wrap:break-word">{{ @$data['antepartum']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:769.2px;top:605.8px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:778.4px;top:612.5px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:832.0px;top:605.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:770.9px;top:620.5px;white-space:normal; width: 192px; word-wrap:break-word">{{ @$data['antepartum']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:454.9px;">
                        @if (@$data['antepartum']->renal_disease == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:454.9px;">Re</span>
                    <span class="text" style="left:103.0px;top:454.9px;">nal Disease&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:211.5px;top:454.9px;">
                        @if (@$data['antepartum']->typhoid_disorders == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:228.1px;top:454.9px;">Typhoid</span>
                    <span class="text" style="left:211.5px;top:472.1px;">disorders&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:329.6px;top:454.9px;">
                        @if (@$data['antepartum']->hypo_hyper == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:346.2px;top:454.9px;">Hypo/Hyper</span>
                    <span class="text" style="left:329.6px;top:472.1px;">thyroidism&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:459.9px;top:454.9px;">
                        @if (@$data['antepartum']->tuberculosis == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:476.5px;top:454.9px;">Tuberculosis&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:609.7px;top:454.9px;">
                        @if (@$data['antepartum']->diabetes_mellitus == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:626.4px;top:454.9px;">Diabetes Mellitus&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:490.2px;">
                        @if (@$data['antepartum']->hepatatis_b == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:490.2px;">He</span>
                    <span class="text" style="left:103.8px;top:490.2px;">patitis B</span>
                    <span class="text" style="left:69.7px;top:507.5px;">infect</span>
                    <span class="text" style="left:104.0px;top:507.5px;">ion&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:211.5px;top:490.2px;">
                        @if (@$data['antepartum']->hiv_sti == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:228.1px;top:490.2px;">HIV-AIDs/</span>
                    <span class="text" style="left:211.5px;top:507.5px;">STI&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:329.6px;top:490.2px;">
                        @if (@$data['antepartum']->seizure_disorder == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:346.2px;top:490.2px;">Seizure</span>
                    <span class="text" style="left:329.6px;top:507.5px;">Disorder&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:459.9px;top:490.2px;">
                        @if (@$data['antepartum']->cardiovascular_disease == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:476.5px;top:490.2px;">Cardiovascular</span>
                    <span class="text" style="left:459.9px;top:507.5px;">disease (CHD/IHD)&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:609.7px;top:490.2px;">
                        @if (@$data['antepartum']->malnutrition == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:626.4px;top:490.2px;">Malnutrition &lt;18.5</span>
                    <span class="text" style="left:609.7px;top:507.5px;">BMI&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:525.7px;">
                        @if (@$data['antepartum']->hemotilgic_disorder == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:525.7px;">He</span>
                    <span class="text" style="left:103.8px;top:525.7px;">matologic/</span>
                    <span class="text" style="left:69.7px;top:543.0px;">Bleed</span>
                    <span class="text" style="left:104.8px;top:543.0px;">ing disorders&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:211.5px;top:525.7px;">
                        @if (@$data['antepartum']->substance_abuse == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:228.1px;top:525.7px;">Alcohol/</span>
                    <span class="text" style="left:211.5px;top:543.0px;">Substance</span>
                    <span class="text" style="left:211.5px;top:560.3px;">Abuse&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:329.6px;top:525.7px;">
                        @if (@$data['antepartum']->anti_phospholipid == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:346.2px;top:525.7px;">Patient w/ anti-</span>
                    <span class="text" style="left:329.6px;top:543.0px;">phospholipid</span>
                    <span class="text" style="left:329.6px;top:560.3px;">syndrome&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:459.9px;top:525.7px;">
                        @if (@$data['antepartum']->restrictive_pulmonary == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:476.5px;top:525.7px;">Obstructive or</span>
                    <span class="text" style="left:459.9px;top:543.0px;">restrictive pulmonary</span>
                    <span class="text" style="left:459.9px;top:560.3px;">disease (Asthma)&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:609.7px;top:525.7px;">
                        @if (@$data['antepartum']->mental_retardation == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:626.4px;top:525.7px;">Patients w/</span>
                    <span class="text" style="left:609.7px;top:543.0px;">psychiatric conditions</span>
                    <span class="text" style="left:609.7px;top:560.3px;">/mental retardation&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:578.5px;">
                        @if (@$data['antepartum']->habitual_abortion == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:578.5px;">Habitual abortion</span>
                    <span class="text" style="left:69.7px;top:595.8px;">(2 consecutive</span>
                    <span class="text" style="left:69.7px;top:613.1px;">abortions and</span>
                    <span class="text" style="left:69.7px;top:630.3px;">3/more repeated</span>
                    <span class="text" style="left:69.7px;top:647.8px;">abortion)&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:211.5px;top:578.5px;">
                        @if (@$data['antepartum']->fetus_congenital == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:228.1px;top:578.5px;">Birth of fetus</span>
                    <span class="text" style="left:211.5px;top:595.8px;">with congenital</span>
                    <span class="text" style="left:211.5px;top:613.1px;">anomaly&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:329.6px;top:578.5px;">
                        @if (@$data['antepartum']->previous_caesarean == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:346.2px;top:578.5px;">Previous</span>
                    <span class="text" style="left:329.6px;top:595.8px;">caesarean section&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:459.9px;top:578.5px;">
                        @if (@$data['antepartum']->preterm_delivery == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:476.5px;top:578.5px;">Preterm Delivery</span>
                    <span class="text" style="left:459.9px;top:595.8px;">resulting to still birth</span>
                    <span class="text" style="left:459.9px;top:613.1px;">or neonatal death&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:609.7px;top:578.5px;">
                        @if (@$data['antepartum']->others == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:630.2px;top:578.5px;">Others</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:670.3px;top:578.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:679.0px;top:578.5px;">others&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:90.4px;top:673.1px;">C.</span>
                    <span class="text" style="left:120.5px;top:673.1px;">Laboratory Results&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:84.5px;top:693.2px;">Date of</span>
                    <span class="text" style="left:93.0px;top:710.5px;">L</span>
                    <span class="text" style="left:103.0px;top:710.5px;">ab</span>
                    <span class="text" style="left:119.0px;top:710.5px;">.&nbsp;</span>
                    <span class="text" style="left:208.0px;top:693.2px;">CBC result&nbsp;</span>
                    <span class="text" style="left:388.8px;top:693.2px;">UA Result&nbsp;</span>
                    <span class="text" style="left:543.0px;top:693.2px;">UTZ&nbsp;&nbsp;</span>
                    <span class="text" style="left:622.5px;top:693.2px;">Blood</span>
                    <span class="text" style="left:625.2px;top:710.5px;">Type&nbsp;</span>
                    <span class="text" style="left:687.4px;top:693.2px;">HBsA</span>
                    <span class="text" style="left:702.9px;top:710.5px;">g</span>
                    <span class="text" style="left:686.2px;top:727.7px;">Result&nbsp;</span>
                    <span class="text" style="left:749.6px;top:693.2px;">VDR</span>
                    <span class="text" style="left:761.1px;top:710.5px;">L</span>
                    <span class="text" style="left:745.6px;top:727.7px;">Result&nbsp;</span>
                    <span class="text" style="left:804.9px;top:693.2px;">Management/Intervent</span>
                    <span class="text" style="left:869.4px;top:710.5px;">ion&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:63.7px;top:748.0px;white-space:normal; width: 90px; word-wrap:break-word">{{ @$data['lab_result'][0]->date_of_lab_name }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:757.5px;">Hgb</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:179.7px;top:757.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:183.8px;top:755.9px;">{{ @$data['lab_result'][0]->cbc_hgb }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:215.7px;top:757.5px;">WBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:235.6px;top:757.5px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:239.6px;top:755.9px;">{{ @$data['lab_result'][0]->cbc_wbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:273.3px;top:757.5px;">RBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:290.8px;top:757.5px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:296.4px;top:755.9px;">{{ @$data['lab_result'][0]->cbc_rbc }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:768.9px;">Platelet</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:191.4px;top:768.9px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:195.8px;top:767.3px;">{{ @$data['lab_result'][0]->cbc_platelet }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:250.4px;top:768.9px;">Hct</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:263.5px;top:768.9px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:267.9px;top:767.3px;">{{ @$data['lab_result'][0]->cbc_hct }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:748.0px;">Pus:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:360.3px;top:746.4px;">{{ @$data['lab_result'][0]->ua_pus }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:388.0px;top:748.0px;">RBC:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:410.5px;top:746.4px;">{{ @$data['lab_result'][0]->ua_rbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:437.4px;top:748.0px;">Sugar:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:463.7px;top:746.4px;">{{ @$data['lab_result'][0]->ua_sugar }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:761.3px;">Specific gravity: </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:400.9px;top:759.7px;">{{ @$data['lab_result'][0]->ua_gravity }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:430.0px;top:761.3px;">Albumin:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:466.5px;top:759.7px;">{{ @$data['lab_result'][0]->ua_albumin }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:515.1px;top:746.0px;white-space:normal; width: 85px; word-wrap:break-word">{{ @$data['lab_result'][0]->utz }}&nbsp;</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:609.3px;top:812.1px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'a+')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:624.2px;top:815.5px;">A+</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:639.4px;top:812.1px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'a-')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:654.5px;top:815.5px;">A-</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:609.7px;top:826.1px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'b+')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:624.8px;top:829.6px;">B+</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:639.2px;top:826.1px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'b-')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:654.3px;top:829.6px;">B-&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:607.7px;top:840.8px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'ab+')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:620.7px;top:844.0px;">AB+</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:639.0px;top:840.8px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'ab-')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:652.1px;top:844.0px;">AB-</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:608.9px;top:852.6px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'o+')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:623.8px;top:856.1px;">O+</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:639.6px;top:852.6px;">
                        @if (@$data['lab_result_old'][0]->blood_type == 'o-')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:654.5px;top:856.1px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:662.3px;top:857.7px;">-</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:699.2px;top:814.7px;">
                        @if (@$data['lab_result_old'][0]->hbsag_result == 'reactive')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:688.2px;top:830.4px;">Reactive</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:688.8px;top:840.4px;">
                        @if (@$data['lab_result_old'][0]->hbsag_result == 'non_reactive')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:707.1px;top:845.4px;">Non-</span>
                    <span class="text" style="left:691.2px;top:856.1px;">Reactive</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:758.7px;top:814.7px;">
                        @if (@$data['lab_result_old'][0]->vdrl_result == 'reactive')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:747.6px;top:830.4px;">R</span>
                    <span class="text" style="left:754.9px;top:830.4px;">eactive</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:748.2px;top:840.4px;">
                        @if (@$data['lab_result_old'][0]->vdrl_result == 'non_reactive')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:766.6px;top:845.4px;">Non-</span>
                    <span class="text" style="left:750.6px;top:856.1px;">R</span>
                    <span class="text" style="left:756.7px;top:856.1px;">eactive</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:800.7px;top:746.0px;white-space:normal; width: 160px; word-wrap:break-word">{{ @$data['lab_result'][1]->lab_remarks }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:63.7px;top:782.6px;white-space:normal; width: 90px; word-wrap:break-word">{{ @$data['lab_result'][1]->date_of_lab_name }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:794.0px;">Hgb</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:179.7px;top:794.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:183.8px;top:792.4px;">{{ @$data['lab_result'][1]->cbc_hgb }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:215.7px;top:794.0px;">WBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:235.6px;top:794.0px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:239.6px;top:792.4px;">{{ @$data['lab_result'][1]->cbc_wbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:273.3px;top:794.0px;">RBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:290.8px;top:794.0px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:296.4px;top:792.4px;">{{ @$data['lab_result'][1]->cbc_rbc }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:805.5px;">Platelet</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:191.4px;top:805.5px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:195.8px;top:803.9px;">{{ @$data['lab_result'][1]->cbc_platelet }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:250.4px;top:805.5px;">Hct</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:263.5px;top:805.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:267.9px;top:803.9px;">{{ @$data['lab_result'][1]->cbc_hct }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:784.6px;">Pus:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:360.3px;top:783.0px;">{{ @$data['lab_result'][1]->ua_pus }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:388.0px;top:784.6px;">RBC:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:410.5px;top:783.0px;">{{ @$data['lab_result'][1]->ua_rbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:437.4px;top:784.6px;">Sugar:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:463.7px;top:783.0px;">{{ @$data['lab_result'][1]->ua_sugar }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:797.6px;">Specific gravity: </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:406.9px;top:796.0px;">{{ @$data['lab_result'][1]->ua_gravity }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:430.0px;top:797.6px;">Albumin:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:466.5px;top:796.0px;">{{ @$data['lab_result'][1]->ua_albumin }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:515.1px;top:782.6px;white-space:normal; width: 85px; word-wrap:break-word">{{ @$data['lab_result'][1]->utz }}</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:800.7px;top:782.6px;white-space:normal; width: 160px; word-wrap:break-word">{{ @$data['lab_result'][1]->lab_remarks }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:63.7px;top:818.5px;white-space:normal; width: 90px; word-wrap:break-word">{{ @$data['lab_result'][2]->date_of_lab_name }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:830.0px;">Hgb</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:179.7px;top:830.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:183.8px;top:828.4px;">{{ @$data['lab_result'][2]->cbc_hgb }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:215.7px;top:830.0px;">WBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:235.6px;top:830.0px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:239.6px;top:828.4px;">{{ @$data['lab_result'][2]->cbc_hgb }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:273.3px;top:830.0px;">RBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:290.8px;top:830.0px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:296.4px;top:828.4px;">{{ @$data['lab_result'][2]->cbc_hgb }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:841.4px;">Platelet</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:191.4px;top:841.4px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:195.8px;top:839.8px;">{{ @$data['lab_result'][2]->cbc_hgb }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:250.4px;top:841.4px;">Hct</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:263.5px;top:841.4px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:267.9px;top:839.8px;">{{ @$data['lab_result'][2]->cbc_hgb }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:820.5px;">Pus:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:360.3px;top:818.9px;">{{ @$data['lab_result'][2]->ua_pus }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:388.0px;top:820.5px;">RBC:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:410.5px;top:818.9px;">{{ @$data['lab_result'][2]->ua_rbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:437.4px;top:820.5px;">Sugar:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:463.7px;top:818.9px;">{{ @$data['lab_result'][2]->ua_sugar }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:833.6px;">Specific gravity: </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:406.9px;top:832.0px;">{{ @$data['lab_result'][2]->ua_gravity }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:430.0px;top:833.6px;">Albumin:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:466.5px;top:832.0px;">{{ @$data['lab_result'][2]->ua_albumin }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:515.1px;top:818.5px;white-space:normal; width: 85px; word-wrap:break-word">{{ @$data['lab_result'][2]->utz }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:800.7px;top:818.5px;white-space:normal; width: 160px; word-wrap:break-word">{{ @$data['lab_result'][2]->lab_remarks }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:63.7px;top:853.7px;white-space:normal; width: 90px; word-wrap:break-word">{{ @$data['lab_result'][3]->date_of_lab_name }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:865.1px;">Hgb</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:179.7px;top:865.1px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:183.8px;top:863.5px;">{{ @$data['lab_result'][3]->cbc_hgb }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:215.7px;top:865.1px;">WBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:235.6px;top:865.1px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:239.6px;top:863.5px;">{{ @$data['lab_result'][3]->cbc_wbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:273.3px;top:865.1px;">RBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:290.8px;top:865.1px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:296.4px;top:863.5px;">{{ @$data['lab_result'][3]->cbc_hgb }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:876.5px;">Platelet</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:191.4px;top:876.5px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:195.8px;top:874.9px;">{{ @$data['lab_result'][3]->cbc_platelet }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:250.4px;top:876.5px;">Hct</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:263.5px;top:876.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:267.9px;top:874.9px;">{{ @$data['lab_result'][3]->cbc_hct }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:855.7px;">Pus:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:360.3px;top:854.1px;">{{ @$data['lab_result'][3]->ua_pus }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:388.0px;top:855.7px;">RBC:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:410.5px;top:854.1px;">{{ @$data['lab_result'][3]->ua_rbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:437.4px;top:855.7px;">Sugar:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:463.7px;top:854.1px;">{{ @$data['lab_result'][3]->ua_sugar }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:868.9px;">Specific gravity: </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:406.9px;top:867.3px;">{{ @$data['lab_result'][3]->ua_gravity }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:430.0px;top:868.9px;">Albumin:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:466.5px;top:867.3px;">{{ @$data['lab_result'][3]->ua_albumin }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:515.1px;top:853.7px;white-space:normal; width: 85px; word-wrap:break-word">{{ @$data['lab_result'][3]->utz }}</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:800.7px;top:853.7px;white-space:normal; width: 160px; word-wrap:break-word">{{ @$data['lab_result'][3]->lab_remarks }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:63.7px;top:889.2px;white-space:normal; width: 90px; word-wrap:break-word">{{ @$data['lab_result'][4]->date_of_lab_name }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:900.6px;">Hgb</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:179.7px;top:900.6px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:183.8px;top:899.0px;">{{ @$data['lab_result'][4]->cbc_hgb }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:215.7px;top:900.6px;">WBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:235.6px;top:900.6px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:239.6px;top:899.0px;">{{ @$data['lab_result'][4]->cbc_wbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:273.3px;top:900.6px;">RBC</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:290.8px;top:900.6px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:296.4px;top:899.0px;">{{ @$data['lab_result'][4]->cbc_rbc }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:164.3px;top:912.1px;">Platelet</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:191.4px;top:912.1px;">:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:195.8px;top:910.5px;">{{ @$data['lab_result'][4]->cbc_platelet }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:250.4px;top:912.1px;">Hct</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:263.5px;top:912.1px;">:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:267.9px;top:910.5px;">{{ @$data['lab_result'][4]->cbc_hct }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:891.2px;">Pus:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:360.3px;top:889.6px;">{{ @$data['lab_result'][4]->ua_pus }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:388.0px;top:891.2px;">RBC:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:410.5px;top:889.6px;">{{ @$data['lab_result'][4]->ua_rbc }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:437.4px;top:891.2px;">Sugar:&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:463.7px;top:889.6px;">{{ @$data['lab_result'][4]->ua_sugar }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:342.2px;top:904.4px;">Specific gravity: </span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:406.9px;top:902.8px;">{{ @$data['lab_result'][4]->ua_gravity }}&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:430.0px;top:904.4px;">Albumin:</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text"
                        style="left:466.5px;top:902.8px;">{{ @$data['lab_result'][4]->ua_albumin }}</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:515.1px;top:889.2px;white-space:normal; width: 85px; word-wrap:break-word">{{ @$data['lab_result'][4]->utz }}</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:800.7px;top:889.2px;white-space:normal; width: 160px; word-wrap:break-word">{{ @$data['lab_result'][4]->lab_remarks }}&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:90.4px;top:928.3px;">D</span>
                    <span class="text" style="left:102.4px;top:928.3px;">.</span>
                    <span class="text" style="left:120.5px;top:928.3px;">Warning Signs and Symptoms</span>
                    <span class="text" style="left:341.8px;top:928.3px;">of Pregnancy.</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:444.8px;top:928.3px;">(Place a</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:505.1px;top:928.3px;"></span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:519.9px;top:928.3px;">&nbsp;if</span>
                    <span class="text" style="left:538.5px;top:928.3px;">Yes,</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:571.1px;top:928.3px;"></span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:586.2px;top:928.3px;">&nbsp;if No)</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:152.2px;top:948.4px;">RISK FACTORS&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:72.7px;top:967.7px;">&nbsp;(a</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:94.2px;top:967.7px;text-decoration:underline">YES</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:130.8px;top:967.7px;">to</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:148.0px;top:967.7px;text-decoration:underline">AT LEAST ONE</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:270.5px;top:967.7px;text-decoration:underline">&nbsp;of the
                        boxes&nbsp;</span>
                    <span class="text" style="left:70.5px;top:987.0px;">indic</span>
                    <span class="text" style="left:104.0px;top:987.0px;">ates</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:134.2px;top:987.0px;text-decoration:underline">REFERRAL</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:230.1px;top:987.0px;">to a higher facili</span>
                    <span class="text" style="left:340.6px;top:987.0px;">ty)&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:528.1px;top:948.4px;">1</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:536.6px;top:948.4px;">st</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:544.4px;top:948.4px;">&nbsp;Trimester (1-12 weeks or 0-8</span>
                    <span class="text" style="left:754.0px;top:948.4px;">4 days)&nbsp;</span>
                    <span class="text" style="left:402.7px;top:968.5px;">1</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:411.1px;top:968.5px;">st</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:421.7px;top:968.5px;">Visit&nbsp;</span>
                    <span class="text" style="left:519.7px;top:968.5px;">2</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:528.1px;top:968.5px;">nd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:543.0px;top:968.5px;">Visit&nbsp;</span>
                    <span class="text" style="left:639.0px;top:968.5px;">3</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:647.4px;top:968.5px;">rd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:661.1px;top:968.5px;">Visit&nbsp;</span>
                    <span class="text" style="left:758.1px;top:968.5px;">4</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:766.6px;top:968.5px;">th</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:779.0px;top:968.5px;">Visit&nbsp;</span>
                    <span class="text" style="left:877.0px;top:968.5px;">5</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:885.4px;top:968.5px;">th</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:897.9px;top:968.5px;">Visit&nbsp;</span>
                    <span class="text" style="left:370.2px;top:988.6px;">Date: &nbsp;</span>
                    <span class="text"
                        style="left:410.2px;top:994.6px;font-size:9.3px">{{ @$data['first_tri_visit']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:489.8px;top:988.6px;">Date:</span>
                    <span class="text"
                        style="left:529.0px;top:994.6px;font-size:9.3px">{{ @$data['second_tri_visit']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:608.5px;top:988.6px;">Date:</span>
                    <span class="text"
                        style="left:647.5px;top:994.6px;font-size:9.3px">{{ @$data['third_tri_visit']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:727.0px;top:988.6px;">Date:</span>
                    <span class="text"
                        style="left:765.5px;top:994.6px;font-size:9.3px">{{ @$data['fourth_tri_visit']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:845.7px;top:988.6px;">Date:&nbsp;</span>
                    <span class="text"
                        style="left:884.7px;top:994.6px;font-size:9.3px">{{ @$data['fifth_tri_visit']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:395.0px;top:1008.7px;">Remarks</span>
                    <span class="text" style="left:512.0px;top:1008.7px;">Remarks</span>
                    <span class="text" style="left:634.2px;top:1008.7px;">Remarks</span>
                    <span class="text" style="left:752.7px;top:1008.7px;">Remarks</span>
                    <span class="text" style="left:871.6px;top:1008.7px;">Remarks</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1028.9px;">
                        @if (@$data['first_tri']->vaginal_spotting == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1028.9px;">Va</span>
                    <span class="text" style="left:103.8px;top:1028.9px;">ginal spotting or bleeding&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:1028.9px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:386.6px;top:1035.6px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:417.3px;top:1028.9px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:370.1px;top:1043.6px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['first_tri_visit']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:1080.8px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:389.8px;top:1087.4px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:416.5px;top:1080.8px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:378.2px;top:1098.5px;">AOG:</span>
                    <span class="text"
                        style="left:406.7px;top:1098.5px;text-decoration:underline">&nbsp;{{ @$data['first_tri_visit']->aog }}</span>
                    <span class="text" style="left:378.2px;top:1111.9px;">BP:</span>
                    <span class="text"
                        style="left:396.2px;top:1113.9px;font-size:10px">{{ @$data['first_tri_visit']->bp }}</span>
                    <span class="text" style="left:430.1px;top:1111.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:460.1px;top:1112.9px;">{{ @$data['first_tri_visit']->temp }}&nbsp;</span>
                    <span class="text" style="left:378.2px;top:1125.4px;">HR:</span>
                    <span class="text" style="left:400.2px;top:1125.4px;">{{ @$data['first_tri_visit']->hr }}</span>
                    <span class="text" style="left:422.3px;top:1125.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:442.3px;top:1125.4px;">{{ @$data['first_tri_visit']->rr }}&nbsp;</span>
                    <span class="text" style="left:378.2px;top:1138.8px;">FH:</span>
                    <span class="text" style="left:398.2px;top:1138.8px;">{{ @$data['first_tri_visit']->fh }}</span>
                    <span class="text" style="left:420.9px;top:1138.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:446.9px;top:1138.8px;">{{ @$data['first_tri_visit']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:378.2px;top:1152.3px;">Other Physical</span>
                    <span class="text" style="left:378.2px;top:1163.7px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:378.2px;top:1175.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:1202.1px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:389.0px;top:1208.7px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:460.5px;top:1202.1px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:378.2px;top:1219.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:1246.2px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:387.4px;top:1252.9px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:441.0px;top:1246.2px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:378.2px;top:1264.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:1028.9px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:506.3px;top:1035.6px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:537.0px;top:1028.9px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:490.8px;top:1043.6px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['second_tri_visit']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:1080.8px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:509.5px;top:1087.4px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:536.2px;top:1080.8px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:497.8px;top:1098.5px;">AOG:</span>
                    <span class="text"
                        style="left:526.3px;top:1098.5px;text-decoration:underline">&nbsp;{{ @$data['second_tri_visit']->aog }}</span>
                    <span class="text" style="left:497.2px;top:1111.9px;">BP:</span>
                    <span class="text"
                        style="left:515.2px;top:1113.9px;font-size:10px;">{{ @$data['second_tri_visit']->bp }}</span>
                    <span class="text" style="left:550.1px;top:1111.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:580.1px;top:1112.9px;">{{ @$data['second_tri_visit']->temp }}&nbsp;</span>
                    <span class="text" style="left:497.2px;top:1125.4px;">HR:</span>
                    <span class="text" style="left:518.2px;top:1125.4px;">{{ @$data['second_tri_visit']->hr }}</span>
                    <span class="text" style="left:542.3px;top:1125.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:563.3px;top:1125.4px;">{{ @$data['second_tri_visit']->rr }}&nbsp;</span>
                    <span class="text" style="left:497.2px;top:1138.8px;">FH:</span>
                    <span class="text" style="left:516.2px;top:1138.8px;">{{ @$data['second_tri_visit']->fh }}</span>
                    <span class="text" style="left:540.9px;top:1138.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:565.9px;top:1138.8px;">{{ @$data['second_tri_visit']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:497.8px;top:1152.3px;">Other Physical</span>
                    <span class="text" style="left:497.8px;top:1163.7px;">Examinatio</span>
                    <span class="text" style="left:544.2px;top:1163.7px;">n:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:497.8px;top:1175.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:1202.1px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:508.7px;top:1208.7px;">ssessment /Dia</span>
                    <span class="text" style="left:558.9px;top:1208.7px;">gnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:580.2px;top:1202.1px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:497.8px;top:1219.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit']->assessment_diagnosis }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:1246.2px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:507.1px;top:1252.9px;">lan/I</span>
                    <span class="text" style="left:522.5px;top:1252.9px;">ntervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:560.7px;top:1246.2px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:497.8px;top:1264.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:1028.9px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:625.0px;top:1035.6px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:655.7px;top:1028.9px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:608.5px;top:1043.6px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['third_tri_visit']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:1080.8px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:628.2px;top:1087.4px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:654.9px;top:1080.8px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:616.5px;top:1098.5px;">AOG:</span>
                    <span class="text"
                        style="left:645.0px;top:1098.5px;text-decoration:underline">&nbsp;{{ @$data['third_tri_visit']->aog }}</span>
                    <span class="text" style="left:618.2px;top:1111.9px;">BP:</span>
                    <span class="text"
                        style="left:636.2px;top:1113.9px;font-size:10px;">{{ @$data['third_tri_visit']->bp }}</span>
                    <span class="text" style="left:670.1px;top:1111.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:700.1px;top:1111.9px;">{{ @$data['third_tri_visit']->temp }}&nbsp;</span>
                    <span class="text" style="left:616.2px;top:1125.4px;">HR:</span>
                    <span class="text" style="left:636.2px;top:1125.4px;">{{ @$data['third_tri_visit']->hr }}</span>
                    <span class="text" style="left:660.3px;top:1125.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:680.3px;top:1125.4px;">{{ @$data['third_tri_visit']->rr }}&nbsp;</span>
                    <span class="text" style="left:616.2px;top:1138.8px;">FH:</span>
                    <span class="text" style="left:636.2px;top:1138.8px;">{{ @$data['third_tri_visit']->fh }}</span>
                    <span class="text" style="left:659.9px;top:1138.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:684.9px;top:1138.8px;">{{ @$data['third_tri_visit']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:616.5px;top:1152.3px;">Other Physical</span>
                    <span class="text" style="left:616.5px;top:1163.7px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:616.5px;top:1175.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:1202.1px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:627.4px;top:1208.7px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:698.8px;top:1202.1px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:616.5px;top:1219.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:1246.2px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:625.8px;top:1252.9px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:679.4px;top:1246.2px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:616.5px;top:1264.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:1028.9px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:743.4px;top:1035.6px;">ubj e</span>
                    <span class="text" style="left:757.9px;top:1035.6px;">ctive</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:774.2px;top:1028.9px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:728.0px;top:1043.6px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['fourth_tri_visit']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:1080.8px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:746.6px;top:1087.4px;">bje</span>
                    <span class="text" style="left:757.1px;top:1087.4px;">ctive</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:773.4px;top:1080.8px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:735.0px;top:1098.5px;">AOG</span>
                    <span class="text" style="left:760.3px;top:1098.5px;">:</span>
                    <span class="text"
                        style="left:763.5px;top:1098.5px;text-decoration:underline">&nbsp;{{ @$data['fourth_tri_visit']->aog }}</span>
                    <span class="text" style="left:735.2px;top:1111.9px;">BP:</span>
                    <span class="text"
                        style="left:753.2px;top:1113.9px;font-size:10px;">{{ @$data['fourth_tri_visit']->bp }}</span>
                    <span class="text" style="left:787.1px;top:1111.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:817.1px;top:1111.9px;">{{ @$data['fourth_tri_visit']->temp }}&nbsp;</span>
                    <span class="text" style="left:735.2px;top:1125.4px;">HR:</span>
                    <span class="text" style="left:755.2px;top:1125.4px;">{{ @$data['fourth_tri_visit']->hr }}</span>
                    <span class="text" style="left:779.3px;top:1125.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:800.3px;top:1125.4px;">{{ @$data['fourth_tri_visit']->rr }}&nbsp;</span>
                    <span class="text" style="left:735.2px;top:1138.8px;">FH:</span>
                    <span class="text" style="left:755.2px;top:1138.8px;">{{ @$data['fourth_tri_visit']->fh }}</span>
                    <span class="text" style="left:777.9px;top:1138.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:803.9px;top:1138.8px;">{{ @$data['fourth_tri_visit']->fht }}&nbsp;</span>

                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:735.0px;top:1152.3px;">Other Physical</span>
                    <span class="text" style="left:735.0px;top:1163.7px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:735.0px;top:1175.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:1202.1px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:745.8px;top:1208.7px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:817.4px;top:1202.1px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:735.0px;top:1219.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:1246.2px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:744.2px;top:1252.9px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:797.9px;top:1246.2px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:735.0px;top:1264.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:1028.9px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:862.1px;top:1035.6px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:892.9px;top:1028.9px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:846.7px;top:1043.6px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['fifth_tri_visit']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:1080.8px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:865.3px;top:1087.4px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:892.1px;top:1080.8px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:853.7px;top:1098.5px;">AOG:</span>
                    <span class="text"
                        style="left:882.2px;top:1098.5px;text-decoration:underline">&nbsp;{{ @$data['fifth_tri_visit']->aog }}</span>
                    <span class="text" style="left:853.2px;top:1111.9px;">BP:</span>
                    <span class="text"
                        style="left:871.2px;top:1113.9px;font-size:10px;">{{ @$data['fifth_tri_visit']->bp }}</span>
                    <span class="text" style="left:905.1px;top:1111.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:935.1px;top:1111.9px;">{{ @$data['fifth_tri_visit']->temp }}&nbsp;</span>
                    <span class="text" style="left:853.2px;top:1125.4px;">HR:</span>
                    <span class="text" style="left:873.2px;top:1125.4px;">{{ @$data['fifth_tri_visit']->hr }}</span>
                    <span class="text" style="left:897.3px;top:1125.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:918.3px;top:1125.4px;">{{ @$data['fifth_tri_visit']->rr }}&nbsp;</span>
                    <span class="text" style="left:853.2px;top:1138.8px;">FH:</span>
                    <span class="text" style="left:872.2px;top:1138.8px;">{{ @$data['fifth_tri_visit']->fh }}</span>
                    <span class="text" style="left:896.9px;top:1138.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:922.9px;top:1138.8px;">{{ @$data['fifth_tri_visit']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:853.7px;top:1152.3px;">Other Physical</span>
                    <span class="text" style="left:853.7px;top:1163.7px;">Exa</span>
                    <span class="text" style="left:877.2px;top:1163.7px;">mination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:853.7px;top:1175.6px;normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:1202.1px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:864.5px;top:1208.7px;">ss</span>
                    <span class="text" style="left:871.0px;top:1208.7px;">essment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:936.0px;top:1202.1px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:853.7px;top:1219.7px;normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit']->assessment_diagnosis }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:1246.2px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:862.9px;top:1252.9px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:916.5px;top:1246.2px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:853.7px;top:1264.1px;normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1047.1px;">
                        @if (@$data['first_tri']->severe_nausea == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1047.1px;">Se</span>
                    <span class="text" style="left:101.4px;top:1047.1px;">vere nausea and vomiting&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1065.1px;">
                        @if (@$data['first_tri']->significant_decline == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1065.1px;">Sig</span>
                    <span class="text" style="left:106.4px;top:1065.1px;">nificant decline fetal movement (less
                        t</span>
                    <span class="text" style="left:338.3px;top:1065.1px;">han</span>
                    <span class="text" style="left:69.7px;top:1082.6px;">10 in</span>
                    <span class="text" style="left:104.0px;top:1082.6px;">12 hrs during 2 ½ of pregnancy)&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1100.7px;">
                        @if (@$data['first_tri']->persistent_contractions == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1100.7px;">Pe</span>
                    <span class="text" style="left:101.4px;top:1100.7px;">rsistent contractions&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1118.7px;">
                        @if (@$data['first_tri']->premature_rupture == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1118.7px;">Premature</span>
                    <span class="text" style="left:159.2px;top:1118.7px;">rupture</span>
                    <span class="text" style="left:213.5px;top:1118.7px;">of</span>
                    <span class="text" style="left:237.0px;top:1118.7px;">the</span>
                    <span class="text" style="left:266.3px;top:1118.7px;">bag</span>
                    <span class="text" style="left:299.0px;top:1118.7px;">of</span>
                    <span class="text" style="left:322.7px;top:1118.7px;">water/</span>
                    <span class="text" style="left:69.7px;top:1136.2px;">membrane&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1154.3px;">
                        @if (@$data['first_tri']->fetal_pregnancy == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1154.3px;">Multi fetal pregnancy&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1172.5px;">
                        @if (@$data['first_tri']->severe_headache == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1172.5px;">Pe</span>
                    <span class="text" style="left:101.4px;top:1172.5px;">rsi</span>
                    <span class="text" style="left:122.3px;top:1172.5px;">stent</span>
                    <span class="text" style="left:162.2px;top:1172.5px;">severe</span>
                    <span class="text" style="left:211.8px;top:1172.5px;">headache</span>
                    <span class="text" style="left:261.9px;top:1172.5px;">,</span>
                    <span class="text" style="left:277.2px;top:1172.5px;">dizziness,</span>
                    <span class="text" style="left:347.6px;top:1172.5px;">or</span>
                    <span class="text" style="left:69.7px;top:1189.8px;">blurri</span>
                    <span class="text" style="left:103.2px;top:1189.8px;">ng of vision</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1207.9px;">
                        @if (@$data['first_tri']->abdominal_pain == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1207.9px;">Ab</span>
                    <span class="text" style="left:104.6px;top:1207.9px;">dominal pain or epigastric</span>
                    <span class="text" style="left:265.9px;top:1207.9px;">pain&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1226.2px;">
                        @if (@$data['first_tri']->edema_hands == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1226.2px;">Ed</span>
                    <span class="text" style="left:103.2px;top:1226.2px;">ema of the hands, feet or f</span>
                    <span class="text" style="left:260.7px;top:1226.2px;">ace&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1244.2px;">
                        @if (@$data['first_tri']->fever_pallor == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1244.2px;">Fever or pallor&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1262.3px;">
                        @if (@$data['first_tri']->seizure_consciousness == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1262.3px;">Se</span>
                    <span class="text" style="left:101.4px;top:1262.3px;">izure or loss of consciousn</span>
                    <span class="text" style="left:261.9px;top:1262.3px;">ess&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1280.6px;">
                        @if (@$data['first_tri']->difficulty_breathing == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1280.6px;">Di</span>
                    <span class="text" style="left:101.4px;top:1280.6px;">fficulty of breathing&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1298.6px;">
                        @if (@$data['first_tri']->painful_urination == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1298.6px;">Painful urination&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:1316.9px;">
                        @if (@$data['first_tri']->elevated_bp == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:1316.9px;">Ele</span>
                    <span class="text" style="left:106.4px;top:1316.9px;">vated blood</span>
                    <span class="text" style="left:180.9px;top:1316.9px;">pressure (&gt;12</span>
                    <span class="text" style="left:263.2px;top:1316.9px;">0/90)&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:375.8px;top:1385.6px;">ACKNOWLEDGEMENT</span>
                    <span class="text" style="left:567.4px;top:1385.6px;">RECEIPT&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:208.8px;top:1409.7px;">(</span>
                </span>
                <span
                    style="color:#FF0000;font-size:15px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:213.9px;top:1409.7px;">for imm</span>
                    <span class="text" style="left:263.7px;top:1409.7px;">ediate return to hospital/clinic of Origin
                        by the</span>
                    <span class="text" style="left:564.0px;top:1409.7px;">accompanying hospital/clinic
                        personnel</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:812.7px;top:1409.7px;">)</span>
                    <span class="text"
                        style="left:662.3px;top:1431.8px;">Date/Time:&nbsp;{{ date('F j, Y, g:i a') }} </span>
                </span>
                <!-- <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
    <span class="text" style="left:735.2px;top:1431.8px;">&nbsp;________________</span>
    <span class="text" style="left:859.5px;top:1431.8px;">____________&nbsp;</span>
    </span> -->
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:67.7px;top:1453.9px;">Name</span>
                    <span class="text" style="left:109.2px;top:1453.9px;">of Patient:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:176.5px;top:1453.9px;">&nbsp;{{ @$data['form']->woman_name }}</span>
                    <span class="text" style="left:263.0px;top:1453.9px;"></span>
                    <span class="text" style="left:557.0px;top:1453.9px;">&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:572.2px;top:1453.9px;">Age</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:597.0px;top:1453.9px;">: {{ @$data['form']->woman_age }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:665.3px;top:1453.9px;">Contact No:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:743.4px;top:1453.9px;">&nbsp;{{ @$data['form']->contact }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:67.7px;top:1475.8px;">Address:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:125.3px;top:1475.8px;">&nbsp;{{ @$data['form']->patient_brgy }}
                        {{ @$data['form']->patient_muncity }} {{ @$data['form']->patient_province }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:67.7px;top:1497.9px;">Refer</span>
                    <span class="text" style="left:103.4px;top:1497.9px;">red to (Accepting Facilit</span>
                    <span class="text" style="left:259.4px;top:1497.9px;">y):</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:284.7px;top:1497.9px;">{{ @$data['activity']->name }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:748.0px;top:1497.9px;">Contact No:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:826.4px;top:1497.9px;">&nbsp;{{ @$data['activity']->contact }}</span>
                    <span class="text" style="left:67.7px;top:1519.7px;">S</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:76.1px;top:1519.7px;">tatu</span>
                    <span class="text" style="left:102.2px;top:1519.7px;">s/Condition upon Receip</span>
                    <span class="text" style="left:260.0px;top:1519.7px;">t at ER:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:318.7px;top:1519.7px;">{{ @$data['status_on_er']->status_on_er }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:67.7px;top:1541.8px;">Action Taken:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:198.0px;top:1541.8px;">Admitted</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:258.4px;top:1541.8px;">
                        @if (@$data['activity']->status == 'admitted')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:309.0px;top:1541.8px;">&nbsp;Referred to other facility</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:465.7px;top:1541.8px;">
                        @if (@$data['activity']->status == 'transferred')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:512.5px;top:1541.8px;">Treated/Managed as OPD</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:672.5px;top:1541.8px;">
                        @if (@$data['activity']->status == 'monitored')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:67.7px;top:1563.7px;">Remarks:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:131.4px;top:1563.7px;">&nbsp;{{ @$data['activity']->remarks }}&nbsp;</span>
                    <span class="text"
                        style="left:648.4px;top:1596.2px;">________________________________________&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:647.8px;top:1618.1px;">Staff Name and Signature of Receiving
                        Facility&nbsp;</span>
                </span>
                <!-- Page 1 DOH Logo -->
                <div class="image" style="left:130.7px;top:22.5px;"><img width="108" height="106"
                        src="data:image/webp;base64,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">
                </div>
                <!-- End page 1 DOH Logo -->
                
                <!-- Page 1 CHD Logo -->
                <div class="image" style="left:722.8px;top:28.9px;"><img width="92" height="94"
                        src="data:image/webp;base64,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">
                </div>
                <!-- End page 1 CHD Logo -->

                <!-- <div class="image" style="left:829.2px;top:28.9px;"><img width="94" height="94" src="data:image/webp;base64,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"></div> -->
                <div class="image" style="left:362.6px;top:1382.2px;"><img width="305" height="36"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:196.6px;top:1402.7px;"><img width="29" height="37"
                        src="data:image/webp;base64,UklGRlYBAABXRUJQVlA4WAoAAAAQAAAAMAAAPQAAQUxQSOwAAAABgGNr2xrl93FdgFYzuJTJHqgjHe7VyAJwJ/qtF+cNThMRagOgaUixOwFHsP+S4FJpJTkQotLuT/VbJY6r+pKzu7+90pK4Wl49vg+ut/sa9aKytHoaEwX7Uyjonnf8UHS/i2q8Zg0DIkrOvLbEQLa9s4SIgqFVAz0z03v3T0a/B1vbk4iIoold4+D14YxBve7v3hNhf53aD740ZHElg48+KGGYmTkMnlESfjC0mwJ14BzHj8PF+lKFo4S+fpEQUXzsoIQomvYwIKjUme65R2ECpQCvLLrDM6hdMVHpWR7WEBlXtWeWm4Gp/0MFA1ZQOCBEAAAA0AMAnQEqMQA+AD6RQpxIpaQjISwI0LASCWkAAFzH9/UvCvW5s7VAAP74z3mpef+7JmM0bUDoXbGQEO73A8gRAAVAAAA=">
                </div>
                <div class="image" style="left:201.6px;top:1402.9px;"><img width="614" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:791.3px;top:1402.7px;"><img width="29" height="37"
                        src="data:image/webp;base64,UklGRlgBAABXRUJQVlA4WAoAAAAQAAAAMAAAPQAAQUxQSPIAAAABgFrb1vIoH4axAFSo/sj8PQQcOR5maID5+/H1O3z/NSomIhS5bYOM8USPiG1BkAmplBQMyOlyo9VqVLIcBqLc3zk42BtbBRipxs6L45ibeRdGqnXgEJF/N7eyDCX2DH3QzbSuQOHK+Mb/IOeil8colrWWjwERBffTisAoXrIvnA9l9hoKVVyf3X8o56ijUSuTt689IvKu7TwDke4cOV8TuBX4JgEG56D1LyCCcARtEcwfu2Fmv61xO/yND7ySr2eFu8Ovhwu99OBxaWUZcvjB+7ld4shvZe7PRjUF/Yd7014tzaAft1HJSwb96Z9e+tYKY1ZQOCBAAAAA0AMAnQEqMQA+AD6RQpxIpaQjISwI0LASCWkAAFzH9/UvCvW5s7VAAP74z3mpef+7JlqwQVuFKBb9ewC8gAAAAA==">
                </div>
                <div class="image" style="left:796.1px;top:1403.1px;"><img width="31" height="37"
                        src="data:image/webp;base64,UklGRl4AAABXRUJQVlA4WAoAAAAQAAAAMwAAPQAAQUxQSAkAAAABBxAREYiI/gcAVlA4IC4AAACQAwCdASo0AD4APpFIoEwlpCMiIggAsBIJaQAAEDdTUAV4hbkAAP74zvV4AAAA">
                </div>
                <div class="image" style="left:649.9px;top:1424.8px;"><img width="97" height="37"
                        src="data:image/webp;base64,UklGRrwDAABXRUJQVlA4WAoAAAAQAAAAoQAAPQAAQUxQSAMDAAABkO0AgNo2NZabjjkez4ExMzOUmbmW64UGZQarEMkX5+LvjQ/ss5+3iHDgto0j2bPXi7I7nvKFin/FmRNESRQ4jzDhrJFgdoXx9YoaV5WILBEtRxCYej50R21UjROMFMbiMnH1t3t0Q+97lowTnXzWV4bpuV3PhUxCtEkzSNZ77jTyXk6dGq3lyLBKz6YFLHM2ZRCdmjXLMJs9ihAySap2AEi2tsbu0pp0oVkztKaoQJScmLEcx4F2ARBdsGEZxtJVKWyKG8AhurgzTmn84We5PDjQyOVykWeztuPZwIiHTqpuOdR277BMSN3hexO70AGpGzWkEEtKnwk9i4RIyz0niDgD7yKwHGwEQpUlWMLaxIskIXUvJnaKjmPPfbpBCvGRhG45OCtNNEQSamOjomIMF05dKCO4kfLXPPUUmN/KQ7TtkpKXmt0tulD7cylSiB89SQOHwEoWjki13vfyZZ+OMQw0DZQR0EgxspxMIWXay1PLNlacXSCmjo5ibWkDizbCkp+bXLZxLht6oCagmnNzpoUx7K7vlhGQSLH+IPjdkbUcNi7ubeYhcon1zq85gF2wzNw+dLwb2u55o/RIYMTZK/tlxIQ+G6U2uDv5InH5QQpgnf7Oxz/AYebAlHryZtZ2GNqefXFErk7g0Dcil/tNGHb9vHs/XWApayYhk6CNeCV9cPbV1Qroy2G/gWafIpAluVFn1Dfzy79zuVyqTRGZK/dt1IRMnz+LcBRJcYOR4NZUV3t7e8uz4wH80OQC04iBVFJGoIO9CWSmYCZsYYJCB/pyYLNtCZaYvYNCY6pW+gL4GsMVi5d5gNU7KDSmWreAcIqaK1hA5lJGv4pCE+T/k57mskBWzpb5u+/R45kD4MMFG+LPidAHmlrjLsF92st6IJDdh9739OLhC02aQbGHLQbI555GOCK01hStjJZxfdrLmiqQHZyqRETe3dNR7GGbZmjNFyQytBqtFVxcn/ayLg1kFywKHLovppi+1cXLQhBxXgTXp72v7UO5r0fL+u+ZKwAAVlA4IJIAAAAQCACdASqiAD4APo1CmUe/pKKhMLvIY/ARiWkAAF99u+c0ikdetRkkH3NBvWtY44SVZTQAisl4TMa510zXCgyxGKAXg07sS5wAAP75M6cP/lULP/1vAB3/w/6paerYC1hMAT3inTfgR6T7kt81zgJKb8qUvBO7kaoBM///8fBK+y+8BQoAp0/0ZR///HwAAAAAAA==">
                </div>
                <div class="image" style="left:722.8px;top:1425.2px;"><img width="240" height="37"
                        src="data:image/webp;base64,UklGRhABAABXRUJQVlA4WAoAAAAQAAAAjwEAPQAAQUxQSHkAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDWwi23by/wcBDFIYJGAgC6Cjz9QZlDBIwEFSkCSg41XvlS+i/4rctm2kpLvn9QTBKsj+Y1gOttomEDcfsLWMJIx42bB1TRSMdH+x9ap1GM39Y+s363QUdAzTsY2Mc4uh+rwUAFZQOCBwAAAAsAoAnQEqkAE+AD6ROppHpaOioS9IKLASCWlu4XHQCSIwLGVZ5JTSrBgdtrORgWMqzySmlWDA7bWci/wtNCaE0JoTQmhNCaE0JoTEUIIhgTAmBMCYEwJgTAmBLx/aAAD+/tIC8Hp4Ff/394LTAAAAAA==">
                </div>
                <div class="image" style="left:55.4px;top:1446.9px;"><img width="133" height="37"
                        src="data:image/webp;base64,UklGRgQFAABXRUJQVlA4WAoAAAAQAAAA3QAAPQAAQUxQSDAEAAABoPhsn9pGquM4JUXLfBcvr+X0lnmPmZmy3hwtWq7lLkRKjiFRU5Rm6kz898a/38+T3/SYIsJhALRtA9npANtRJJ8w8X9atOyy4zhl2+LUmavcrP5hCwANm8OcVd7ier7ve261RBjD7vRQqroeULn51tnayD9sgTLQ4NVmjS+l6uFrQRTHcdQ4U7WxMeyupPO7zpYzjQiotDbboLJr74RxDFrg7K5DuYbwnZptuqOqZ663+kJKKboNdxIbw+62ljR+93A96Aqg0h6r8430t+OFazKn6N28cmV+pGEt9BzDsN1Gd0NlOUXkzWBj2N3ZqkWtW882ojj88NVEAJVjOHYOvRsa6W/Hj2UGOFgMm9+mWSZj3zQcLxIZpIz9WWwMues1XJtaz93sCbmWfPBQZuM5Lm1/8uE66G+DTTBY6a6rHPXpMhF8SnQscui4VxCd6Jg1czKRYyAT80/MIIGV7edvLQ5G6lqftGSGHdOkBN5eVplMTs7gmMg3fIO+yiCHapiNsHD5GI4/3qF9hzy/kJ67ZXKL6xHRiXhuEU++2kkh1HroFSPtvHoSCZx7+na+Zun3d79PCcc0aYGEZNaAa215sp1mBba/DT6PcPBpvtOM4kJGwZOnngyAHBhf8XOLmHRWFVxXW+/VpikgMZ0EC2wvD2Dj99YV4ZgmKZCSzBtwK3OJLIBa7y4LHHyWfx5pKKTotxfafSAHxVerevZmj9C3kSo8PF4+PDtZiEylG5RAYrBSjmlSAknJvAHXIV0THjU0FLdLqojHt17Jo3NvoKNPJienLeBrXBa45KGMfV6YZNp+cotVqc8LuvGp+w7wNVYr8rUm1vdrg+oHrlMcM6j7tj6I5xz/AY/H9e7KwARgr5miiLxpN+jTrULetwD0niUco/Ef8IzPb5vh4gCmG6yAvcEO8lXqRUL7/gQAvif67QffrqP+Q+9X/Ac8FheuXbu7MsyGS81DZU7kvREtK3ObWY1BTwxbBPQaiYKnrwVdpYGHHz1kQnLu+Ps/q0z9/M4+3h/aePDMiy1p7vK09mauQiL95o1TnrvjxOfLw4IT1k3aeePFEG9Ys4i0/fzZG72Bsa85+WXdKE6i8+yuil3BHUBkD6yX1eo3nWV8mTUDVP0bJy/eXGRYdEcGyLM0R5MNT7AMKnJT2QPr1zKVpgp/jTd7F1F997lb7AthUOs9i3qW/IiItN+63G8KVkDTUOfU1rwAMPJJB+ZIZBMR3hEIGbAUMkz2TbiGMsbS9idbEiWgLNTIb8mUmMhCYVlOyAAVtZBGSeS3jDMeONt3Dl/vijw5T2IWatQmZDlDVBBwSoWSYVXzmRujJGoTxtkqVKkhy1Hw5JzPQo26kixFyerPmq1RMlABapREXck+40lN+G2pOCzUmBMgpxFoTZaODKPUnBNgn6z9neP//uMvB0wAVlA4IK4AAACQCQCdASreAD4APok4lkelI6IhMkgAoBEJaQAW1wN9rl/MohcIp+73FuaDSMhT9YmLx9EHVxSr+BzkPSy5j5PDEbbVXX3cjZrIya4fA5sDKIY6eGAAAP7/TWFX/+Whb//loGb/QVQAF0N08ZHYP9OsgtVjg2uIVkAHqcFMJ/6Bp9Ie+4LpU5Fn0fowJcRt7zn//5VmGpaWRfFX3/7VyIZU3VO7wkwHfdlnAAAAAAA=">
                </div>
                <div class="image" style="left:164.2px;top:1447.3px;"><img width="420" height="37"
                        src="data:image/webp;base64,UklGRkQBAABXRUJQVlA4WAoAAAAQAAAAuQIAPQAAQUxQSH4AAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21aCBWARhUUECngAZsydsUMSFhFoYAksAj3e7DsR/Vfktm0jZXXd+wbp99/ffxCI339000Y9LQOCk/WoZxHKAKJ5RT2XWAGQbA/qeVYagPr6UM930hC3IO424j5D9f81D+nvPxJWUDggoAAAALAQAJ0BKroCPgA+kTybR6WjoqEvSBiwEglpbuF0oRtDndkmvKVWCorORfS3XZJrylVgqKzkX0t12Sa8pVYKis5F9LddkmvKVWCorORfS3XZDa3KpyNYUkQwJgTAmBMCYEwJgTAmBMCYEwJgTAa7QWkiGBMCYEwJgTAmBMCYEwJgTAmBMCYEwJgTAgM9aAAA/v9SZCgfkgKv/18IFKUAAAA=">
                </div>
                <div class="image" style="left:559.8px;top:1446.9px;"><img width="49" height="37"
                        src="data:image/webp;base64,UklGRkwCAABXRUJQVlA4WAoAAAAQAAAAUQAAPQAAQUxQSMIBAAABkHRte5pFVHHftzjBoVvcYeUO49opPeMz+MqdhBDe39uTfPI2SxYRwcBtI0Xt7eUYu/CGghdzNizbsS1Dq1LqkXbileo0OfXzYRzOeZZGrOz/fcduv3W4GrFh+0IA3x2oNDTiXwYgLrYbHF1k+VsJAdjf/kpDzlt2owfQ7dihACrMcp+052Dil5uo6wO7HECBXRVsRHEOjjb6yg3soxU01QYfTinLwfRks8HBPlrBcM/W6RNkt/pzkang7ex3CrlJXGz5VgoEoL9WkqfI0TQiTgoE4MdfjnmuYnG7kwIBxN3pnchHqHwWz5BYfoCUZdYMSBX/7uQ6Q7JSllEefLpKyA9fRVdCD1n+hpR69mNgYpfrIYdEVH7KvuA7y1c0Ijhqj5ms3t44Xz2dbvgWziy8ZYlvw+5u+QkeebZ7CP4otyenHwKcJsry5sI4cTjX0CA/wfe9G5G53Ox9V9q8oMpE63ulVtcrL5efoHtmj2cU35vpxm6XDctWegblCUq6s9yT7nSV5Nl3YGUENwZYGUkuIF8fJQZYGfm+e0EZvdj9jhEDtIx0DmxFcbQ10InQTeJlxK30STvxK13bMrQbIb4AdQFWUDggZAAAAFAGAJ0BKlIAPgA+jTqXR7+joiExSAPwEYlpABbaxBbmM5a7x9RVBjXQze6Xky68y1YAgbYkP6qzr3AAAP75NbP/6AA4/yo9dsIKM4qYevTxAAAfhN9VB//7wW9nzp/+AAAAAAA=">
                </div>
                <div class="image" style="left:584.7px;top:1447.3px;"><img width="93" height="37"
                        src="data:image/webp;base64,UklGRj4BAABXRUJQVlA4WAoAAAAQAAAAmQAAPQAAQUxQSM4AAAABcFtbe9MgfqnCeYCcyGESao1A2oI2VwwsV5K/48qOCEZu2ziyp7fbav0G66+BGXEhODFE1Tm6vu8eHUCFjnnRNEV+JDwSbtHNc1e4ApD8Zl6WufG/ME2VK0AtT608EahrlczWgB5iq2uUxo8Dt/DI3t7iNAlPDp6GrTNZgSI8nWQ7gSK8cKtpUTkKCaOqoDXQlhlxYaw5Ma3XlIRoqHXlTnt9ekusSkI01CoNNaZ8NSEaapWG2vFgpvV/2dAak5f1/3U/4JrGYj5Hf1XaAlZQOCBKAAAAEAYAnQEqmgA+AD6RPptHv6OioS5oY/ASCWkAAG8WBNDF08vtrpwsAr9s6csOmbYqAJ+5/HzqzXiAAP74z3jGhg/90WAAAAAAAAA=">
                </div>
                <div class="image" style="left:653.0px;top:1446.9px;"><img width="103" height="37"
                        src="data:image/webp;base64,UklGRm4FAABXRUJQVlA4WAoAAAAQAAAAqgAAPQAAQUxQSJ8EAAABGTFpgvf6NzZERP/TKoDatO1tWkl6bYrBOAafRuiQbG/5tL39/5ned09LrxCn2UmwX82g15IQmfNxN2ICJDiSpEhSFizfeWRVQn2BZf7jcHCA4xhBQMIb8DsOT8gDGJSKpQTypw/J7QxDhBCGhyAJ1LX4mgZCC4ttiyEGJaYSwnKyBQHZ4eJqIjVAGkrNpCokA5W02hUYe1vEF/IsvlhsiMkc+NG+nJkHirKJUBtcILJlnYvYzN92+T6yYKCSVrsmPjHmcwDp+ECXIDBzz9UAc0jXEx9rcxGhNrhAzboNJdKEay/9gekZKWGIpBWvLRMBRwFCev+eCywB2dAx0eGSQu1wAVdJGcEJbfjEtVCFS0pa6eLqxj5RWAgxoCithJggCBzHKSF9Y+96qgrcKysjYAU2xACO03M5kMCgYig5AmN3iNcExLhcnILXdoiDlreN0ZW7cY5pqnPQC5Mhhu7cqqoAOsg6oACjbIkYF/IALdfYpamEzGMBQKdPkN5AqSuuDhdQ8toNcYcv4qOf33juX8Im6S4Q2ZJA1C5dCgTU5mmpczAUrGiZYy9UTLQALdelPT/aJ/NYlyIhER1XYo+0hYCa12aIc54mupjMqT/9BY1s2eQDoKZDEIgJclN/wZGbScAUdmJXoMvHabnuLH6H5DH93anp8HFqXpshDkID1LsocWhfLPfSnz7VUQaAq4jVIHCcGa1LxYCeeFdFjUPPVSKvl4D0q2nDglHDazPEgSfkoRZ7bSojXNn3QkcgovIuZ0ovKD0HPC0GbkRoLqP+XQ2jGa+tCQhnoZZnTvwg0LWlY2lWdCvlqVrKjSgxdelAwmxyQMOw2iEk9lVsSKDlLXbsqSeW45r60Z5LU0h59MZ8SIaa0cEvgam4gZcEa468deWWYCiBA4BsB166g4Ti0ScWMWSKT8I9cyJlSa8i54LQUGRXxlEXCqyzkAi4qoYqzkzxraqQxyBeZrb5+gIOM0sdi+UYJnfKlilyLqhp6wjNtbQNNTVEljcQ6vMAM8VXGvoEhimWHnq2QmIHes+ED5gl6KfItsdj6/8s2/S9TRXEWdee+xfqaYt4HABY+FLgOCNbbB6OUZUektW4iroT26Y6yswuxRPk289ZM0fXVz4UAMWCvqbOYS8fGH+bU5UeWitA5H3bTh25EnKYlgWrrRMX+MAXesoKEhmwus/MSg8gG6hpeyzxt/dtCDgegJySns+8Z40DaPOH8oYZ/tt6GD2CgFCxVgAXSBz7iWxwFaewshPhfBve1RHxAOIXhHIpmj/0vYeeQwuj5RSuzKQQQJm5e4xM2HOXXviJ7GpQ4hxaU9SUusAQhrkMsvmie6xtKOTyhDyckIpdO7ftSsNACOg7Oj2HFkbLiWb+MoNQ4sBzroVlDiQyl2RX48oc+02qo6gptofpCgGCZXFyjrqQxyVjD8W2nbtGNqDvk/UcWhgtJ0rN3BDQ1I9qAK3vOdnVtLkyR/51zucpGNkAwUKWX98k9mQhypH8welfH3oOPYwaofCiEBL7ihCkqyHv0pSKETF7ln19WHitP6Qh5JQMiX0munLMG2oIOeb/wwYDAFZQOCCoAAAA8AkAnQEqqwA+AD6NQphHpSSioTI7iACgEYlpABbRaP9h5gtahM9Mc86uQJa7l8ho3yPQwiGS2yIGQ7+ruAzGcYcKRm956KhpQGpj/O0javhvRX43RMesAAD++TTX/+MAAZf6R13ovF4XeAFW07KON4lk/aFuY1KpRASmYCYCBBQTMYBb3/Jj9/jQAbjX6RY8VTyS9WOF82H/0MCVf1fC3zf/zlAAAAAA">
                </div>
                <div class="image" style="left:731.1px;top:1447.3px;"><img width="231" height="37"
                        src="data:image/webp;base64,UklGRg4BAABXRUJQVlA4WAoAAAAQAAAAfwEAPQAAQUxQSHcAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21byfwMBElgAMuiUCl6ARQLNQANrwKIAFVhUoIfeIT+i/4rctm2kpLvn9QTyK6z0H2Y7CNXpBcKyQ2iuXSAaFoT21gWK7UDo7F+g2k+ErgH+Av8w/m34zx3JzGcfAQBWUDggcAAAADAKAJ0BKoABPgA+kTyYR6WjoqEvCACwEglpbuFx0AkAeeo467kdyO5HcjuR3I7kdyO5HcjuR3I7kTfghkJWSslZKyVkrJWSq0vsYNIzJmTMmZMyZkzJmTIrAAD+/tIC8J4AJH/xfQY8P//EaAAAAAA=">
                </div>
                <div class="image" style="left:55.4px;top:1468.7px;"><img width="82" height="37"
                        src="data:image/webp;base64,UklGRhoDAABXRUJQVlA4WAoAAAAQAAAAiAAAPQAAQUxQSIcCAAABkHRre9M4xlhMeu+N9BA8cVulsMqq9x6PV6kE67iX9J6428gajX6vkUAITpZzIsKB27aRZM9u5h7NkaRvSKx/YEVNgZSq/A9+m48ZpnFssxL0SID3UIIoYi9w4p4N7XsnQNAjMZmHEkQR97j9SmOCJo0r2xVe6rG7NoTQvntMDaKIuVS92COU9FZO+gRg2GOE0Ng2QBBFzKWlyy6lFLX8AjAh8lCgCYIo4p1nynariyldhKKucreyKVPhtORLUclsAgJOqckFmrZdN0xD367xLJGkFTi5slhe2C2ntUQiuVU3zMy1D5jRhd1+FPjDtYwpYOPEwROGuWwVHegUrWUfFj6t5O7dQtQT7lrbleSOwnMHVj6MiKfqlYt+FGT0oQIF7JTulhZo3Z6L3F634sfCpVUUkdlZ21Z4+cdFc8yg4M8l24+CEjxHAnYHPwcMGgvmx8KlVQSR3Xn3ied/VilvMvk9XKWhvUbWBFm4tJIe+XA+X3aDbi7wViWaVySRUtS+eesDpsImkz8TEoGiiEwafPo0IuLCX99+xZT9BDEJIw6NWy01BnCHujPUetpC7GVrH0Yhp7XJ11aj0ag81FNSY+BHJ0H4w7XCtQ84ZPzz9umjR4/uW/tUSUruslpIICnDL8yruV2ZCorVn7K18HpAmDLlDIiPwu+Cu9beNESxWq3qbLFCVeuqdw1plYr0imcyEMXqMGA4LsuZM7wryrPrZDKOGy+ZELFK77W6WGpZypzxL/w04orOD7TYT2hL+v0YyfPYNnczrVDIUfQ4fujJNuclD0GOOU6NGRwIOYquzw/G2eGK6iFIMje8SW7VBUGjGgcpagqwAzgGQY55TnFQgZHh+vVOAABWUDggbAAAAFAGAJ0BKokAPgA+kT6ZR7+joqEvCAPwEglpAABqKp+7wJfUGEH+3EqRGi5U8gickp7u8ALpcbH3LfoAAP74zOd/4kAcYXgD/oaYse9TQSz7AQPitT/f/G4DpT//8VE2q///FRPMDQqAAAAAAA==">
                </div>
                <div class="image" style="left:113.0px;top:1469.1px;"><img width="849" height="37"
                        src="data:image/webp;base64,UklGRsABAABXRUJQVlA4WAoAAAAQAAAAgAUAPQAAQUxQSIYAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21aCBWARhUUECngAZsydsUMSFhFoYAksAj3+1LgR/VfYtm3DjO4HeoIE/wP+g//gP/iPzYD/dNOmoWEZJJysp6FRhDKBaF5paCyxQiDZHhoaZ6URqK+PhsY7aRS4UeBtCvyMZv8/w/+AseA/CVZQOCAUAQAAkB4AnQEqgQU+AD6ROphHpaOioS+IALASCWlu4XaxG0OuQI+MDtryyMCwiWeSU0qvgHbXlkYFhEs8kppVfAO2vLIwLCJZ5JTSq+AdteWRgWESzySmlV8A7a8sjAsIlnklNKr4B215ZGBYRLPJKaVXwDtryyMCwiWeSU0qvgHbXlkYFKf89hY83u53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5wp/PYWPN7udzhT+ewseb3c7nCn89hY4t1fMFZTXu53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5wp/PYWPN7udzhT+ewseb3c7nCn89hY83u53N/qIAD+/7wXUgAI8QAAgf/r4QAAAAAAAAAA">
                </div>
                <div class="image" style="left:55.4px;top:1490.8px;"><img width="234" height="37"
                        src="data:image/webp;base64,UklGRs4IAABXRUJQVlA4WAoAAAAQAAAAhAEAPQAAQUxQSIYHAAABoDjt/5u2QQiRQTno3nCQhbdN0unVvdvsgRV3ZRKZk1uOHGQP66LicSchhP9e6fv9/pa6V0RIEMA2bhtwiXoPgA7Kol6Q+nMQ//uPf/RC0zOGkdG131yvYquSpoKlSUCsws7FwUNeyxTKtfHxWrmQ0eTLQUKk+puYjkvnI69q5XxapuXIIyEVhSwgl436gbMbtFwJipXz4uOMg0NVOl+dN61WyzLnKzlNiZxaKaexBii/v4AiRUHpSM4+U29YLasxl9ekWj7OrVbLz8UqzIVJQG5ywbRgN6RZRuql481IbP0ZqbOEwRlHrKqaT9PCVzqu5/ue2z5R0pXIaR4HdEU7NV2MegtQRFY3T1QMhX93fHLpiuP53kajrEu0HHvExa7c2IhUuF0bkLO7bsyifbLyDMtIo9bc9j3nykJV6hdpzkR4bmclGri08EG4G0W406wZSuRsR3RZ/cv3OnrJ8SBFo7oSWb3Tni9Ibwhxcf/0h5FVnlUzJFqOPeJjZ3mx8cEAkBsEIeiGtXfeZhlpjLf83d1hH3ScPNCcqQgH8cBlCIfht8YN6XIwXVb/8r0uPxlCilphvhPxDd2LVekNIQ70D3ZKouWYKDc7jgjurDaRkcxBMthYqRqKAQduFifK/dO2j2FP7zdEIqNHSzPFIGZMAPcvJM9Ov1q+fukJnjFG9aIbxnQ7sNEIMRqTAk9knzkGxO2STrF9IUVjsIgStGLJ2Hs2QLOxyTJy36Hv+qNd6FnRyEBn1cFvTT1bRoly+rNegIdc77PpcZGoVV6u1CgGgDEG6l8WeWIDY1RNJ+YUumbZgC1qYG5BJItFFgV2gBQEX6RTLF9YuR+CSZTwxIgkU97zxCgcsbRNvG1uhNCzb6cP1pA4dVh/N15lYfbrbYV4yG317JZIWKvHVy2KAWBMQC83nCGbvNWoF6N/cOFDk84om3GLG5Bb0EZledlkUGAHSEHwRTrF8oWV+wF4iVqNY+VjDYvwngF+bet3dkbQs97KtxYSJxN8qyzKfkg3yogi4fUf9T2KAWCMAVIaB3nPuVTPayk97m8857ITa5iga5azILegjUqv5zIo0MEyiXaK5Qsr9zMxCkOCqOdcO3XN8Tjl8GnDBIklsu+hDYZMcK2yCmIUjpgMCHDn1KHTKOtgYOAppxcWunjJ8damno8XT8LkICQpqPJFzI5wx9kJKU82HykzH/0ltIeSCh6bkhHMN57wLDQNUAt/Gi8E3fdn4ySV1PAs9ltw79q9QLn5w80NPICUgB1JA1zqOAcGgaC7UNBBWkII3R+/XPd2kwdqkWV+2e+c7/jK1fSt1TtBEiG6CgchtTCJQYuXN1H49uQe0FKsbl+9FyQTaKhpTLTPtCWCd6b6nQ8W1n2UoRR8WdFrq/cT2q+EW7dvb4VCSGUnbV8YrfE9oGUlh8TCW5vIplSCyxy4ktdmgZLRzr1Ou922T5czSYd/89M6fga5+eVXvUAEQJwM5OIWjGkiJyb784QguH/jfkBN6+cnAELn2vkzZ86cXHhBlwMwOdRg1P/uUHF2fQApTNQ5ycPlLSsJ9szLix2fuSlM9ucJhLc28dS4mjeYJtQM4kfHX302ogwplKdavtCqLwVB78sPrvaj1u+ZN/ph0jFYn9mbwkC5Y9s+peqT7WBETOvcpK3ky3DDpASjX1YPHYwoQwpHpixPaP8jDpjPev0hOGuof9ANkv+29Ewagnjebp797Gdfif/BtrMT4qOqpxe6Sn4NPDoo2+FPTyPKnjV1yHRDkScBoE6IErmzC7qLL0zbftIR9q/U8xoCOnmqHXwzlqvqS+gBa3+8rVQBODeEErAAJ781O9vyEYWJ5+c7vsgzMZznmBTjSR0uAYzcFS/ofMIFPBB/guc+JMCAZ7CZfRMthYDr/dPFyH3uJ3UJBRXyVEf8RIo+9ZmejinDNXd/XAMSOR3SCvPtHYIUfWaFDg6JlBBrYNZ4CL4cFMgHpIHAWRZBkWvyE8ZhFtwhpAb/UW9tqnAwarnPrCSUFsnzTfGzWfr8s1pFlJvHS0ZcDRU5J00ZlRNNghTj9DYFHg2plHC8tIdZ7ST4clCwiQekni1wqktR5FgXSpRxOiyycoeYmmi6wc8nDn980+c/vZVQZCdP+sWrFHQlIJ8v1YiiQFxxEKgYwPsGBClGHQM0ZEoo5XRm3Z/gS1MgSgyYsEB9g6LIftNypHHwugF3yFDjd5anT3XAABs6F+XXMTQ9Q9a8xOp1BBWuGpsAf/ICDUGKJERUk3BKQLU0TuFsCqBsiAkLVPooihxPiQzjUkKsxdQQT+nTN3bA68mlegFX9H5Lb4jl65ecQYgTqLICugyKGETVVkpIUYOFwKf0cOBcOhot77/BkS7WzY7roYM2ZVdJpFCEfyAMBp7QHQD5wuGsc8wq2Md4bses/6a+OK62oTKksktVUiiiq0pdW+w+mnThJ9quBzeYRul4E90X+82+Z5spqLjvR2wzAGEpFNGlvYVJsUuS0oVXolELN5jx9Uuua6q/d1eHGdsMTQ5FfH01m9G1hI3aeDAR1v3RudhOdE9Ctfw5iP/9x7/1kAJWUDggIgEAANAQAJ0BKoUBPgA+iTyWR7+joiEy32jL8BEJaUv9khAG5O9APwA/SWn/Rb6zbvvO8inMPZmjazejKfu9xcuOEV8T2jEJLudoRAgL5jvBOZJGDSPzqSOCXQAePSPvBL/+PN49PvFAwHiYQIzIkyf8/LLGzsB4H7dsuYgUWoJkMDMiRei90lH/dnazcCE7XQ6AAP0HFlI///MXwFzfNJA///MYQ9A27/NVCjc4ADjr/QADRL0sDsoMt1jkzKT90no4UzBkL/aEeTkCGmsWGm9OIAhcq0YjY7ICPEcC/CAMsAch///yqkj+dIST51EgABRma3sgnKyPCk0W7v105oDJd/LMjW2/9kRXsSOdELxxyLGsO+FLsEAiPAGa2XdwAAAAAAAA">
                </div>
                <div class="image" style="left:264.8px;top:1491.2px;"><img width="495" height="37"
                        src="data:image/webp;base64,UklGRloBAABXRUJQVlA4WAoAAAAQAAAANgMAPQAAQUxQSHsAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDayqbU8yGvi9k8OlCIcokEALeABvAhGgx7jahkX0X2Hbto2U1XVAXwC///7+8wHI7z+S7aC6CgUPHcYJqhsJ8IjpNKO6pQ6PUW07qtv7FzAcJ6q7BnhT8GYbb57h3b/qa9rffwAAVlA4ILgAAABwEwCdASo3Az4APpE8mEelo6KhLygAsBIJaW7hdgEbQ5TTVWk1CqKVrpqrSahVFK101VpNQqila6aq0moVRStdNVaTUKopWumqtJqFUUrXTVWk1CqKVrpqqrSqYrtXau1dq7V2rtXau1dq7V2rtXau1dq7V2rtXau1dq7QtZ0Yx/vg27t3bu3du7d27t3bu3du7d27t3bu3du7d27t3bu3duZRQAD+/5rAoAhcAC+/6iCoSAAAAAAA">
                </div>
                <div class="image" style="left:735.7px;top:1490.8px;"><img width="103" height="37"
                        src="data:image/webp;base64,UklGRqoFAABXRUJQVlA4WAoAAAAQAAAAqgAAPQAAQUxQSNoEAAABGTFpivGeEf0PTPU4AoGk/b1niIjUcBvZttq8/34kpkhmdir3XwgzMzMIn1yCJ2IC1LZtw9hOWfsRtLZtTxtH+mSQ5TgeJ8NYGOgyHNFp///uIePwNORAIzkT67uuSHJspVdPNyIcuI2kSDWwu4eZ6sEvQPDnkAxiGOBBBABEhR+1VziBToCAq5ARo2o+mOOHY7sWokIjBB+C+UhikhmydCEmkzSly/uf78pmzUZU6IQLeIebkrkMNQNu3nykKqiyyHRRCbqC5z9j2sCBeDtuFm4aZxGgGAkkhHbOMrMBotcPjnUItPkbLkWOAhmHEACgjQBk4TcoxN/7+tBvEm6ID/c4Ufn1SK0UZbFRQRhMZwEDgivzN11qilRcfG0aQ7aPz4/9BuGGINuBZ8R5LlcilIIpvpPM+gIJ+pstjKTAETOXC1BT4PtQEzJ5/el+RBdhGAQrVQzVCiu2gmJaIAJBpZAoYop4rZ2glyvDZA/ABiaa1+UYR6aqAmpfV3ug09IIXvvEo/UhW5TQ+OhiaUmJoYy63MCkWau4Gy71b0fFSJRFwRg1Mw9FoeUliclI1DyHTDM4nOg4mUVG86uONs+ltosm535SV7yrPaTb386VreEfvd3LrimejwdS6X9LJ9ej5WS8lVr8AIiG+ZevuqaWT3+xc82wdDbGGYGBGvhYq2twvfr2MqG0+2nI6j6A0TNpfIxoCWfXvd2zxHyAiSiNf+swmctS6mqNxcl5cpKAqXc3qcHw7GyMI10WfWSum7mpg6+/f/nuOKRRF6AprV/FkF0IHnt2bJXJRQGVIoiEru+4zGZUe58aDMZE50gCnYDiYGDrwzO9++s43XbgLmKVh16CNQxVCoHSmh0XoJrB9W8hJnaWB3cesHz3U3ry7TFpKiUFjyocAFqHa1REmVev59I1DJtNOL9jF3PVXPnT/l4zrtH1JG1BndDXCToS8rxUruRyeX5s4InHmZFyKrFmC4BSo8qlBzZOIULu1cXPhSJk+U6go3J3cKdC5K5zLGMfXitLjxy8A1E7gnoNJlHKwPS9MvQ9tstpPYmnvCSk7DnTwdBBCnEiW5LurXv4stPebi6anXFar8GEpYZ3lJISCQEgiqDoi27HrzlB7xvVLXf1n+HV2/PQMGv25x/q9HCbe5Q6eESAOlpVxUTiqkQpjAVCxIpCQVD2iiT2akkbanVjNwrO314xYi/oW616K7nL0SYnhVbnhNyOFE23xhNF0/j6b3+nVStTe+/h6oPeyY9fZB6p3iYhAmxu5lKK6GoLJ1JRpivKwuFN3t5teZtuEiGQXH77Oq2MoSqF5Gv6idNuiAjWy9orStD4yXLam6b7nFbMQlURcX/2+PRom1NjflOqFIOn6d5ZAu6KdWQxERYFCzUCWK0wRfF9v9jp+HoWCrocLNwpaTMwGR2e6HYPX2Y+zzigyGejf5/kwWXXoc/WQdBEKBYhMxRnHlEyn6PF8H6KbQYo+tMgXCOTy+GbXivjvt4vqfy/0SyfI+9ypypkxCyxcFFYO2bQi2WuLIblqK8CABZM+sLiZW0yLSxGpz9BwdgvKZGLUqHmcPqACBYmerRYoOE6EGKcQm2G+cM7od2gM4mEWGhTaXDVL5s6rbs1rIpBVUGoeS4RPFgDprk+JmmdX/8XlgBWUDggqgAAADAJAJ0BKqsAPgA+jUKYR6UkoqEyPCgAoBGJaQYoAAB+hF9imtePqLcvkRX/1+t/mGFlKywH5Ryuq7xTeITMBPFoEMPAJnncr1XII79X0C0DjAAA/vkz4X/wmAALn9ZQYnPi8LvACradlHG8SyrAs4ERZqrA9vqmYx4zOBfghOS1wz7cM8AG4Eaaxf2a3CTL2DWDZdByY/9lbeFs0w0AChhyW/81AkAAAAAA">
                </div>
                <div class="image" style="left:814.0px;top:1491.2px;"><img width="148" height="37"
                        src="data:image/webp;base64,UklGRvIAAABXRUJQVlA4WAoAAAAQAAAA9QAAPQAAQUxQSHYAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDayybXvx/w0GEqwAMsxTFXYBlwQzgwargUsBFVwq6PHvMyL6r8ht20bK6rr2EUBmf//RHMgPBNeGFKTtJLi1RUG2HII7exQ01yO4e0xBd7+CeyZSF6m3pX4m93/y2SAAVlA4IFYAAADQBwCdASr2AD4APpE8m0glo6KhLgg4sBIJaW7hcdAIWqV0hGvjVK6QjXxqldIRr40a9w70zIFQ1RVSuACay4eP1XuFX207gAD+/tIC9ETGf/18IAAAAA==">
                </div>
                <div class="image" style="left:55.4px;top:1513.1px;"><img width="33" height="37"
                        src="data:image/webp;base64,UklGRjgBAABXRUJQVlA4WAoAAAAQAAAANgAAPQAAQUxQSNAAAAABcKpt25rM0UnFJm1IGpVzWMbSEl65iO4O/zhgZt+PQ4gIRW7bNlK6xynII4gfkyTNsA4ZmoSD4hU951CXYyRYk4xyq+OwYco01ClvWJPD0eGmobNA0Ep5crk6PXZyULB663DFQq5zfJY80BVGqy9sN3oFDipfEuYQuXDul0QSR4fmVYUG3bbR7dVDS2chn9m7+c52XAQFzQdz5OD+O3zbLl4mZYXGwGVmGTwJ9VFjc3R4mFhFiYLKTtlsdBy2ygZYI8iY7FYvFZ7CVp3/zSQAVlA4IEIAAADwBACdASo3AD4APpE8mUglo6KhLggAsBIJaQAW30NTtMrQ5t8KI/IA8r02DPMs1gAA/vjPVL//8aQKbkeRAqAAAAA=">
                </div>
                <div class="image" style="left:63.8px;top:1512.7px;"><img width="260" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:299.0px;top:1513.1px;"><img width="664" height="37"
                        src="data:image/webp;base64,UklGRo4BAABXRUJQVlA4WAoAAAAQAAAATgQAPQAAQUxQSIQAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21bykQAsorCIQAEPwIy5M3ZIwiICDSyBRaDHm357Ef1X2LZtI2V1PdATCPov+g/6D8IG+o9hObRA2wTi5gMtsIwUGPGy0QLXRIWR7i8t8Kp1GM390wK/WacnhZ5s05NndOjfBv2XawL9hwBWUDgg5AAAALAYAJ0BKk8EPgA+kTqYR6WjoqEvqACwEglpbuF2sRtDt0PK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrVzqmRlo4NKxpQ1xlo4NKxpQ1xlo4NKxpQ1xlo4NKxpQ1xlo4NKxpQ1xlo4NKxpPjWdGPiKZ+9M03u6GIa4y0cGlY0oa4y0cGlY0oa4y0cGlY0oa4y0cGlY0oa4y0cGlYxwgAP7/vBdSAJlgAGF/1EFQkAAAAAAAAA==">
                </div>
                <div class="image" style="left:55.4px;top:1534.8px;"><img width="117" height="37"
                        src="data:image/webp;base64,UklGRiYEAABXRUJQVlA4WAoAAAAQAAAAwgAAPQAAQUxQSIYDAAABkD79n9JGJYS6u4bzI2nP3eWVu2bqXo4ydIZ6e26pJB22dMvfC/v7LSy5u3d3EQFBkty4zSISKjoHpAiCfkLJv8JNkpNKUpaic/3ZtqqUltFSVVJoJWpUn0utSYjoAI4Fzc2jKuIOUA4+00392UEl7HOVujNZwzSyZ2okAR3AMaY7UCpAUpy+7ppdIAX7Wp0U8rmHevu/O8T5nlXlaJJTT3WTZ/rTlIxSAZKilKz256hHc/2qzN3qz2YNU391z3I8z3MMTYn4DWl6nvAsr2sKSgVIilKlvbNM08z2lnK3c+M/HJK3XtrEFzEzUZUxiYcaQMWoIHxx/n992fXlLl+vk9BsUNp4fuLXnueRhbcLrHorkjA9JOQkJ1uElnWyEqBV9JoEkIQA50QQT7pRDg3kqC+aGzikgHEXWN/NyWDz3I/TH91Ac5ePaiA9HOw4qPGyBV/7dN9HXrl3EqAdvTxHPJYEAQ9jmlpfr8J0I/ZqpnODbvYvZsddYNbyZrB5tPCjQIOo1/uHWSLTGHw6aPCyBRhluy71MFi6vWIB0uH+ddfzGBIEPIwZ/bdu9Rsg3Yj3wJXWng3GnW9BKyAdybbG902WiDibXzcdXrYAuc5a2WZo3Y9TKwWXUncXkn4vMEA+CQIexpzcykrOAelGuIeu6WD2x57HN+QtKAI3W4AZ5+S9FZdBsR++Mfxm5EJzMMIZdV0KQxHuoUufYbKiJyJMrkD+qTxpEUbWxSN9QTPGYlBiPQa8+PARJ1zksKA44cNB2gyaMdJ3FAEJKg7PDPK1tW2KC94WhzKKkjHDan8ntxPqDw50eFio5w4BXsOA+ajIRHOrSH+F6KeRiTnbtq2XalKojzzKiP3aJr/Pzl1/++TFq1evnl9vlQUp0Xh9gTBfzdYeolh2Vl8pLJL6LAJRfMVwmObXbFvoTqo5O7lJgyYfNDYpItGHYUmEFUkQpSyQWIPzldDDsspOPmTu+l20g8XfxhbXWLENUSp8Ff+DFM1wWM7TGvpG4fMRqP+RSBCUquJWmMmj5fqyK3rW4AeKRIKg/CbS9Dz44Kt733PWSdz6KTJSXkd2eh5BqQzWXrGY4MOppzqocMu4q1VuFRsNCa9nZQYfjyUe41bIYn4o0FJVMvc3A+5aIhoSvqqQGHw8lnhM7DpFkpNgtcf/5Ya7oouMlJQlPBI8lngMrBb/Bvbff4VSCVZQOCB6AAAA0AcAnQEqwwA+AD6NPJlHv6OioTCIA/ARiWkAAHX74zMfo8XhfU9vpHqDKmGapgNTCjdEo8woVrRPFDYGKRIEQUbR01TDM6AA/vkz4X/poAJP/0AAAHH+XdLh+pFTA8X/gMetqo6nrBLa7H//RFqibf//HwAAAAAAAAA=">
                </div>
                <div class="image" style="left:148.0px;top:1535.2px;"><img width="123" height="37"
                        src="data:image/webp;base64,UklGRvIDAABXRUJQVlA4WAoAAAAQAAAAywAAPQAAQUxQSCwDAAABkC0BYNo2NRY93qtdri9UfBozMwfG6Dq+chuPoeBCfGdFVfS/Fti5an3bIsKBJElts1tGwYgarshPaPsnuSVF1VRFSgHUKmxR48WpsaToBy07Y5vdEl+yEQNZhpyyIiqNLeCv27QzRI1ZINlTZddz7poKn9EYL7qeWxw3pHQV6TtJYYsnxbzreESNWSDTtSACdcfW+IxWcTUC0Wqxr51ovAnbsGLeW6CwxZOena4DUJ/O6pQ026lDhDHwMnxpththjKPq1GDceA3DZLdhFndIYYv3fPBUDWIMa6cOSpQyHsCYKw4SWLj5xPGcu4ND9xyiDSeBE1RafyVAGKOg0q+R33QVZkjNFLo0jtXODJHA7x/8ENSrJy4shKDu5mg8VZFIblriXU8ukRFbOhlfZMPKX/NhLOhfK2Q4tgdHX201MUbhWogw/Prc3UJsPNsyNJKbkqDX+FK2lDb50ESx6u+QJDv+jMexW7n5YjVmaiLi09XtXQ6eW5yypghuSoJeiYEkq0vGxNu1CCKSBMEG4DgKvnwPm5gw+SkPL1r7+OAjwS2mFKtMXsnMen95bRenMYIQ4VTe3f69HXMLKj1bjej4BJXB43HrSG92kgyFKSFLxpjMfHasEqCWhY0qPjEcJRFzMy5vbs5GVAtuSdjg94/fIasD8OBIiZibcfnyIQ5KM/z+tY5aETaw9JTTEzhwpES8csOFVl+XvsI0YUuvxnJpuUFKxCuCDYhYzbi5PfP6O+REhCPOQ6pkptApiVfy7lZt1t9B7BF9lducORDJs3B5oH+lf0/vnBKuttHWhzPj13yYbpTkhC1pQQmw0c7SfVMRSBkPYAxrZ4725KtRqtmLB9E6o9CxNdEEZnK6Siw79pqFyczc7AFi3ykdPLkQgtjE6MNaBiYyEw9BdknUjMhLhNyVa333HC/2TC2I6AVsbcZLZBZeFPg+qyQAaAKae+GeqYh4WkIixM6dKrvUxqF8KpdJZBaeWz57llWS59EENPfJvm5JwFMsCiF2fIpFb+gO6lois/Bs69AhVkmZDE3A4Falv8DpImOjnRKPfQBEwtIELO59xf/9136lNlZQOCCgAAAAEAoAnQEqzAA+AD6RRJ5JpaQjISzwyECwEglpL73BKZwiyAV6Na21T93bMxrXn2qLMPtFyN0dmvOJbzzhvGY+KKbRijcYjznaYXs2kPq21XNMM2n/GbPNjAAA/v9tQmv/2BuP/0Bdy/r5q/z//8sEP//LQC+/VxkKn3gPICwBECcSGvhrA8QRAF0gp///lW3gJLThO0RRX9mFDxAegAAAAA==">
                </div>
                <div class="image" style="left:246.8px;top:1536.2px;"><img width="40" height="35"
                        src="data:image/webp;base64,UklGRmQBAABXRUJQVlA4WAoAAAAQAAAAQQAAOgAAQUxQSOUAAAABcCNtm5pkx3Dvg1TOBaylJHUOgLtzA7fIzp447PyDQxERitw2UppZhtPAH5TfCggTKgHBCHBGQ/F0VoJ0PEQRVPMlS3qnL0FHLyV9QIZVbbq5GhJcN1NNxTBiue6JCyn4qZ2mMOtQZWUJwS3TcMS0uBBGPwsjHNc3XNi71bDvyHB94HCi6e5V8F2jWsg6UqzNT8YRakGzfUNYq2qMUUc8Ka3db9dVDCdjmGc3XUtNZ9OqDwGqn6Uy4UEwUoAlx8vQPVy5h4/uwZPvIJruIaLvIqvcQ2a7h+x6Dxn+DqrMHVS6P18UAFZQOCBYAAAAMAQAnQEqQgA7AD6RPppIJaOioS5oALASCWkAAGd3GRU8WgOUb2+SuAa4AP74z4Tf//xbTP2uBqsYVFjNGX/CikGXwom8TgHYIB5HAN///iqyVMTOEAAAAA==">
                </div>
                <div class="image" style="left:262.6px;top:1535.2px;"><img width="215" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:469.8px;top:1535.2px;"><img width="215" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:55.4px;top:1556.7px;"><img width="88" height="37"
                        src="data:image/webp;base64,UklGRkACAABXRUJQVlA4WAoAAAAQAAAAkgAAPQAAQUxQSMkBAAABkDz9n5o15N0Ed9dkuO3gcHK4vjfc4eSZTAZ393qbZdnk74XsL/Lbtrc2Ihy4jaRIyeJh9WLvF3L+CaVGdANSJxpqAVJy/LHIpG2Q1CrJYBdAzSL0gZjjtgvpLPaVZ5ALsMdNgo1B7e8M0nta6yvRcAv4blMDnTaXBaBvT4sWwS2AuW3KEXgOzSW6kUCdaMCZqJMMELGwayfMTldhOGdUNp1oeDC3s8qibQmkVnm5nIu2NrTKEbuyZ/wDfpbtCucEs0mnGx67Q/2LjptAZ3lsbNmRMqyOr8oRd86+iQ/Et7OdcE4wm3S6ocEvV+0njyXQ+3R29smTMny5/yJHfOXvY2jgr+GcYDbpdEND/Hj8+hYkUnAu5Ay+8IP4RmZjbhsCcHnKiUK0fwkEf385SSaEl5UYv53tnX2LO/g/ro8ODg52pi3994KfZfuyZzzuZnramp+ZmZkcriVpkduxowRsp6u8a4cpMtHKhk+5IudMUZvLFHmZWMufhEIo8jWDOl7wxwEqwBc+PsnvGil2jvB9Es3vNi0Ee1Dkeysxx224m0DTHjfzwE4duQPRisyIngtNahYR8HkGu0+L7EzR1IkGP/XF72b/z2IOAFZQOCBQAAAAkAUAnQEqkwA+AD6RPJlIJaOioS2IALASCWkAAGgDNucnmAYyC6d/KOKTtQHae2xm3OTzMYAA/vjPeMaGD/3ZJ2q3gPZOBDb//8VEAAAAAAA=">
                </div>
                <div class="image" style="left:119.1px;top:1557.1px;"><img width="841" height="37"
                        src="data:image/webp;base64,UklGRrwBAABXRUJQVlA4WAoAAAAQAAAAcwUAPQAAQUxQSIQAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21byaeAJLAAZdEoFL8AigWaggTVgUYAKLCrQ40/1RvRfYdu2DTO6H+gJBP4H/Af/wX/wH7sB/+lhxDbD1Sjk/cI2o3UoFNvFNmMNKHTPxzbjTCkM7882485YbmO52yz3GZP+R4b/gSfBfwRWUDggEgEAAFAeAJ0BKnQFPgA+kTqYR6WjoqEviACwEglpbuF2sRtDrkCPjA7a8sjAsIlnklNKr4B215ZGBYRLPJKaVXwDtryyMCwiWeSU0qvgHbXlkYFhEs8kppVfAO2vLIwLCJZ5JTSq+AdteWRgWESzySmlV8A7a8sjAsIlnklNKr4B215ZFaB3O5wp/PYWPN7udzhT+ewseb3c7nCn89hY83u53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5r1oZ7j8Jp/PYWPN7udzhT+ewseb3c7nCn89hY83u53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5wp/PYRsmAAP7/vBdSAAp1AAC7/+vhAAAAAAAAAAA=">
                </div>
                <div class="image" style="left:943.9px;top:1582.0px;"><img width="15" height="17"
                        src="data:image/webp;base64,UklGRlYAAABXRUJQVlA4WAoAAAAQAAAAGAAAHAAAQUxQSAkAAAABBxAREYiI/gcAVlA4ICYAAADQAgCdASoZAB0APpFEnUqlo6KhqAgAsBIJaQAAPaOgAP74zxrAAA==">
                </div>
                <div class="image" style="left:636.1px;top:1589.6px;"><img width="327" height="37"
                        src="data:image/webp;base64,UklGRioBAABXRUJQVlA4WAoAAAAQAAAAHwIAPQAAQUxQSH0AAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21aCBWARhUUECngAZsydsUMSFhFoYAksAjn+zP8nov+K3LZtpKyue98g/f7LkfD7j27aENcyQHCyHuIWoQxANK8Qd4kVAJLtgbhnpQFQXx/EfScNPQp6bKPHMwT695ADf/+RAABWUDgghgAAAJANAJ0BKiACPgA+kTqaR6WjoqEviCCwEglpbuFzQRtDrrpjLHWMsdYyx1jLHWMsdYyx1jLHWMsdYyx1jLHWMsdYyx1jLG4gnc4U/nsLHm93O5wp/PYWPN7udzhPNtJSdzhT+ewseb3c7nCn89hY83u53JT2gAD+/xoDsKhQMn/xfQY5wAAA">
                </div>
                <div class="image" style="left:635.5px;top:1611.1px;"><img width="328" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:58.0px;top:1634.6px;"><img width="24" height="29"
                        src="data:image/webp;base64,UklGRlwAAABXRUJQVlA4WAoAAAAQAAAAKAAAMAAAQUxQSAkAAAABBxAREYiI/gcAVlA4ICwAAABQAwCdASopADEAPpFIoEwlpCMiIqgAsBIJaQAAE/GOHwhFgAD++M79KAAAAA==">
                </div>
                <div class="image" style="left:30.1px;top:1352.9px;"><img width="52" height="33"
                        src="data:image/webp;base64,UklGRv4CAABXRUJQVlA4WAoAAAAQAAAAXwAAPAAAQUxQSOUBAAABgBqBbh3JlYSLq4JD4eJbxM7yo9eKuIswN08rb+b8k2zN4ohwIElq3AAVKGV1y4D0hLRmYkpxmZhFiwpH/evWgsa1FJWABkkG8GDgeMatAKq+e3qacceytVlCiVgAvLUCOZQIkIVmjZDkJqF0leVG/YtSJK2ULCKhtGWyNY7igsLGsyZhqP1YVRgCyLqcgYi/OZFGpyQA7E3FUfk+0hDxnD2LcOcm2zW1MDhhAJ9rp5BkrybRUjFlaeHWK5OhkWjFv/bhpyV1S6S9tR8fMw+DzvcufNUV3jHaIeqXftDP+xDeu5WYcL9Nx/DO/VytyUb8TvhqYciIr2Uj3r32v5cJbyo51HQtasTPSw7CS1eSWAAH/ix8dpblVT344z31X2Bx4o/3meUFtE2Kh5/yJAwEKLQc1L6zMQwYmznuPK4PsPymw+CFaZhshtUnxfF7Apz+AEnUN27qyNzTgbjz/FlWtYt5gLWnA3FTb/PeOXxspLgvWmw9bc1bXhVVvCfQ0NPevIu0V84CzPlzefPGIxczakbnSpz+Suqhi5nLFZq2IPi9o0oKToW/P5nvrd/z3h39Whb93SNJjf5uwwDy1C/Ge3didDwaJOHezWiIUKuoFi2LwyIqn0xvN4TCwYrI/DMyp2/JCQBWUDgg8gAAAJAHAJ0BKmAAPQA+kUacSaWkIyEpW2jwsBIJaQATk053PO0LfWYIUWmqWoG1zH53b0iQixCtOSb6h8lWsuTfSTtFnPJ2kAD+/EPSUQCzm7LxfP6+3UL//XIih1B8P9P6AhMh8dXvhqP/md46+JG+4bzNv0l2chs/XJZFP8jOJYYvU1ChXxZM9JxEgyay6YCtSRsClvLcD/3mxehCp3JVWdEfgFoSFYSoVlyW4/OqlNuvXN1t+5i4T2P8AF+TXBWqluyabS9YE8UIAsly747eAaCRJ1Enk4BetMs6CHGfmo6+YiV0vJdqMxPhmrr7P4JAAAAA">
                </div>
                <div class="vector" style="left:54.0px;top:178.0px;"><img width="914" height="1496"
                        src="data:image/webp;base64,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">
                </div>

            </div>
            <!-- page 1 end -->
            <p></p>

            <!-- page 2 begin -->
            <div class="page" style="width:1024.0px;height:1686.6px;">

                <span style="font-size:18px;font-family:&#39;Arial&#39;;">
                    <span class="text" style="left:418.5px;top:27.3px;">Republic of the Philippines&nbsp;</span>
                    <span class="text" style="left:439.6px;top:48.4px;">Department of Health&nbsp;</span>
                </span>
                <span style="font-size:18px;font-family:&#39;Arial&#39;;font-weight:bold;">
                    <span class="text" style="left:354.7px;top:69.5px;">CENTER FOR HEALTH DEVELOPMENT&nbsp;</span>
                </span>
                <span style="font-size:18px;font-family:&#39;Arial&#39;;">
                    <span class="text" style="left:417.7px;top:90.8px;">Northern Mindanao Region</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:152.2px;top:141.2px;">RISK FACTORS&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:72.7px;top:160.5px;">&nbsp;(a</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:94.2px;top:160.5px;text-decoration:underline">YES</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:130.8px;top:160.5px;">to</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:148.0px;top:160.5px;text-decoration:underline">AT LEAST ONE</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:270.5px;top:160.5px;text-decoration:underline">&nbsp;of the
                        boxes&nbsp;</span>
                    <span class="text" style="left:70.5px;top:179.7px;">indicates</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:134.2px;top:179.7px;text-decoration:underline">REFERRAL</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:230.1px;top:179.7px;">to a higher facility)&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:513.3px;top:141.2px;">2</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:521.7px;top:141.2px;">nd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:533.8px;top:141.2px;">&nbsp;Trimester (13-28 weeks or 85-189
                        days)&nbsp;</span>
                    <span class="text" style="left:402.7px;top:161.3px;">1</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:411.1px;top:161.3px;">st</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:421.7px;top:161.3px;">Visit&nbsp;</span>
                    <span class="text" style="left:519.7px;top:161.3px;">2</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:528.1px;top:161.3px;">nd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:543.0px;top:161.3px;">Visit&nbsp;</span>
                    <span class="text" style="left:639.0px;top:161.3px;">3</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:647.4px;top:161.3px;">rd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:661.1px;top:161.3px;">Visit&nbsp;</span>
                    <span class="text" style="left:758.1px;top:161.3px;">4</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:766.6px;top:161.3px;">th</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:779.0px;top:161.3px;">Visit&nbsp;</span>
                    <span class="text" style="left:877.0px;top:161.3px;">5</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:885.4px;top:161.3px;">th</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:897.9px;top:161.3px;">Visit&nbsp;</span>
                    <span class="text" style="left:370.2px;top:181.6px;">Date: &nbsp;</span>
                    <span class="text"
                        style="left:410.2px;top:187.6px;font-size:9.3px">{{ @$data['first_tri_visit_2nd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:489.8px;top:181.6px;">Date:</span>
                    <span class="text"
                        style="left:529.0px;top:187.6px;font-size:9.3px">{{ @$data['second_tri_visit_2nd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:608.5px;top:181.6px;">Date:</span>
                    <span class="text"
                        style="left:647.5px;top:187.6px;font-size:9.3px">{{ @$data['third_tri_visit_2nd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:727.0px;top:181.6px;">Date:</span>
                    <span class="text"
                        style="left:765.5px;top:187.6px;font-size:9.3px">{{ @$data['fourth_tri_visit_2nd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:845.7px;top:181.6px;">Date:&nbsp;</span>
                    <span class="text"
                        style="left:884.7px;top:187.6px;font-size:9.3px">{{ @$data['fifth_tri_visit_2nd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:381.8px;top:201.4px;">Management&nbsp;</span>
                    <span class="text" style="left:515.5px;top:201.4px;">Remarks&nbsp;</span>
                    <span class="text" style="left:634.2px;top:201.4px;">Remarks&nbsp;</span>
                    <span class="text" style="left:752.7px;top:201.4px;">Remarks&nbsp;</span>
                    <span class="text" style="left:871.6px;top:201.4px;">Remarks&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:221.5px;">
                        @if (@$data['second_tri']->vaginal_spotting == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:221.5px;">Vaginal spotting or
                        bleeding&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:221.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:386.6px;top:228.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:417.3px;top:221.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:371.1px;top:235.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['first_tri_visit_2nd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:273.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:389.8px;top:280.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:416.5px;top:273.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:378.2px;top:291.0px;">AOG:</span>
                    <span class="text"
                        style="left:406.7px;top:291.0px;text-decoration:underline">&nbsp;{{ @$data['first_tri_visit_2nd']->aog }}</span>
                    <span class="text" style="left:378.2px;top:305.9px;">BP:</span>
                    <span class="text"
                        style="left:395.2px;top:307.9px;font-size:10px;">{{ @$data['first_tri_visit_2nd']->bp }}</span>
                    <span class="text" style="left:429.1px;top:305.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:459.1px;top:306.9px;">{{ @$data['first_tri_visit_2nd']->temp }}&nbsp;</span>
                    <span class="text" style="left:378.2px;top:317.4px;">HR:</span>
                    <span class="text"
                        style="left:400.2px;top:317.4px;">{{ @$data['first_tri_visit_2nd']->hr }}</span>
                    <span class="text" style="left:422.3px;top:317.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:442.3px;top:317.4px;">{{ @$data['first_tri_visit_2nd']->rr }}&nbsp;</span>
                    <span class="text" style="left:378.2px;top:331.8px;">FH:</span>
                    <span class="text"
                        style="left:398.2px;top:331.8px;">{{ @$data['first_tri_visit_2nd']->fh }}</span>
                    <span class="text" style="left:420.9px;top:331.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:445.9px;top:331.8px;">{{ @$data['first_tri_visit_2nd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:378.2px;top:344.8px;">Other Physical</span>
                    <span class="text" style="left:378.2px;top:356.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:376.2px;top:368.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit_2nd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:394.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:389.0px;top:401.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:460.5px;top:394.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:376.2px;top:412.4px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit_2nd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:439.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:387.4px;top:445.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:441.0px;top:439.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:376.2px;top:456.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit_2nd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:221.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:506.3px;top:228.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:537.0px;top:221.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:489.8px;top:235.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['second_tri_visit_2nd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:273.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:509.5px;top:280.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:536.2px;top:273.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:497.8px;top:291.0px;">AOG:</span>
                    <span class="text"
                        style="left:526.3px;top:291.0px;text-decoration:underline">&nbsp;{{ @$data['second_tri_visit_2nd']->aog }}</span>
                    <span class="text" style="left:497.2px;top:304.9px;">BP:</span>
                    <span class="text"
                        style="left:515.2px;top:306.9px;font-size:10px;">{{ @$data['second_tri_visit_2nd']->bp }}</span>
                    <span class="text" style="left:550.1px;top:304.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:580.1px;top:304.9px;">{{ @$data['second_tri_visit_2nd']->temp }}&nbsp;</span>
                    <span class="text" style="left:497.2px;top:317.4px;">HR:</span>
                    <span class="text"
                        style="left:518.2px;top:317.4px;">{{ @$data['second_tri_visit_2nd']->hr }}</span>
                    <span class="text" style="left:542.3px;top:317.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:563.3px;top:317.4px;">{{ @$data['second_tri_visit_2nd']->rr }}&nbsp;</span>
                    <span class="text" style="left:497.2px;top:331.8px;">FH:</span>
                    <span class="text"
                        style="left:515.2px;top:331.8px;">{{ @$data['second_tri_visit_2nd']->fh }}</span>
                    <span class="text" style="left:540.9px;top:331.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:565.9px;top:331.8px;">{{ @$data['second_tri_visit_2nd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:497.8px;top:344.8px;">Other Physical</span>
                    <span class="text" style="left:497.8px;top:356.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:495.8px;top:368.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit_2nd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:394.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:508.7px;top:401.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:580.2px;top:394.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:495.8px;top:412.4px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit_2nd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:439.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:507.1px;top:445.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:560.7px;top:439.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:495.8px;top:456.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit_2nd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:221.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:625.0px;top:228.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:655.7px;top:221.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:608.5px;top:235.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['third_tri_visit_2nd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:273.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:628.2px;top:280.1px;">b jective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:654.9px;top:273.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:616.5px;top:291.0px;">AO</span>
                    <span class="text" style="left:633.4px;top:291.0px;">G:</span>
                    <span class="text"
                        style="left:645.0px;top:291.0px;text-decoration:underline">&nbsp;{{ @$data['third_tri_visit_2nd']->aog }}</span>
                    <span class="text" style="left:616.2px;top:304.9px;">BP:</span>
                    <span class="text"
                        style="left:634.2px;top:306.9px;font-size:10px;">{{ @$data['third_tri_visit_2nd']->bp }}</span>
                    <span class="text" style="left:670.1px;top:304.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:700.1px;top:304.9px;">{{ @$data['third_tri_visit_2nd']->temp }}&nbsp;</span>
                    <span class="text" style="left:616.2px;top:317.4px;">HR:</span>
                    <span class="text"
                        style="left:638.2px;top:317.4px;">{{ @$data['third_tri_visit_2nd']->hr }}</span>
                    <span class="text" style="left:660.3px;top:317.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:680.3px;top:317.4px;">{{ @$data['third_tri_visit_2nd']->rr }}&nbsp;</span>
                    <span class="text" style="left:616.2px;top:331.8px;">FH:</span>
                    <span class="text"
                        style="left:636.2px;top:331.8px;">{{ @$data['third_tri_visit_2nd']->fh }}</span>
                    <span class="text" style="left:659.9px;top:331.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:684.9px;top:331.8px;">{{ @$data['third_tri_visit_2nd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:616.5px;top:344.8px;">Othe</span>
                    <span class="text" style="left:636.0px;top:344.8px;">r Physical</span>
                    <span class="text" style="left:616.5px;top:356.4px;">Exa</span>
                    <span class="text" style="left:640.0px;top:356.4px;">mination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:614.5px;top:368.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit_2nd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:394.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:627.4px;top:401.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:698.8px;top:394.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:614.5px;top:412.4px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit_2nd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:439.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:625.8px;top:445.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:679.4px;top:439.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:614.7px;top:456.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit_2nd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:221.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:743.4px;top:228.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:774.2px;top:221.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:727.0px;top:235.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['fourth_tri_visit_2nd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:273.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:746.6px;top:280.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:773.4px;top:273.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:735.0px;top:291.0px;">AOG:</span>
                    <span class="text"
                        style="left:763.5px;top:291.0px;text-decoration:underline">&nbsp;{{ @$data['fourth_tri_visit_2nd']->aog }}</span>
                    <span class="text" style="left:735.2px;top:304.9px;">BP:</span>
                    <span class="text"
                        style="left:753.2px;top:306.9px;font-size:10px;">{{ @$data['fourth_tri_visit_2nd']->bp }}</span>
                    <span class="text" style="left:787.1px;top:304.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:817.1px;top:304.9px;">{{ @$data['fourth_tri_visit_2nd']->temp }}&nbsp;</span>
                    <span class="text" style="left:735.2px;top:317.4px;">HR:</span>
                    <span class="text"
                        style="left:755.2px;top:317.4px;">{{ @$data['fourth_tri_visit_2nd']->hr }}</span>
                    <span class="text" style="left:779.3px;top:317.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:800.3px;top:317.4px;">{{ @$data['fourth_tri_visit_2nd']->rr }}&nbsp;</span>
                    <span class="text" style="left:735.2px;top:331.8px;">FH:</span>
                    <span class="text"
                        style="left:755.2px;top:331.8px;">{{ @$data['fourth_tri_visit_2nd']->fh }}</span>
                    <span class="text" style="left:777.9px;top:331.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:803.9px;top:331.8px;">{{ @$data['fourth_tri_visit_2nd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:735.0px;top:344.8px;">Other Physical</span>
                    <span class="text" style="left:735.0px;top:356.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:733.0px;top:368.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit_2nd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:394.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:745.8px;top:401.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:817.4px;top:394.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:733.0px;top:412.4px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit_2nd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:439.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:744.2px;top:445.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:797.9px;top:439.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:733.0px;top:456.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit_2nd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:221.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:862.1px;top:228.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:892.9px;top:221.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:845.7px;top:235.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['fifth_tri_visit_2nd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:273.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:865.3px;top:280.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:892.1px;top:273.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:853.7px;top:291.0px;">AOG:</span>
                    <span class="text"
                        style="left:882.2px;top:291.0px;text-decoration:underline">&nbsp;{{ @$data['fifth_tri_visit_2nd']->aog }}</span>
                    <span class="text" style="left:853.2px;top:304.9px;">BP:</span>
                    <span class="text"
                        style="left:871.2px;top:306.9px;font-size:10px;">{{ @$data['fifth_tri_visit_2nd']->bp }}</span>
                    <span class="text" style="left:905.1px;top:304.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:935.1px;top:304.9px;">{{ @$data['fifth_tri_visit_2nd']->temp }}&nbsp;</span>
                    <span class="text" style="left:853.2px;top:317.4px;">HR:</span>
                    <span class="text"
                        style="left:873.2px;top:317.4px;">{{ @$data['fifth_tri_visit_2nd']->hr }}</span>
                    <span class="text" style="left:897.3px;top:317.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:918.3px;top:317.4px;">{{ @$data['fifth_tri_visit_2nd']->rr }}&nbsp;</span>
                    <span class="text" style="left:853.2px;top:331.8px;">FH:</span>
                    <span class="text"
                        style="left:872.2px;top:331.8px;">{{ @$data['fifth_tri_visit_2nd']->fh }}</span>
                    <span class="text" style="left:896.9px;top:331.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:922.9px;top:331.8px;">{{ @$data['fifth_tri_visit_2nd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:853.7px;top:344.8px;">Other Physical</span>
                    <span class="text" style="left:853.7px;top:356.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:851.7px;top:368.1px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit_2nd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:394.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:864.5px;top:401.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:936.0px;top:394.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:851.7px;top:412.4px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit_2nd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:439.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:862.9px;top:445.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:916.5px;top:439.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:851.7px;top:456.7px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit_2nd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:239.6px;">
                        @if (@$data['second_tri']->severe_nausea == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:239.6px;">Se</span>
                    <span class="text" style="left:101.4px;top:239.6px;">ve</span>
                    <span class="text" style="left:120.6px;top:239.6px;">re nausea and vomiting&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:257.8px;">
                        @if (@$data['second_tri']->significant_decline == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:257.8px;">Sig</span>
                    <span class="text" style="left:106.4px;top:257.8px;">nificant decline fetal movement (less
                        than</span>
                    <span class="text" style="left:69.7px;top:275.1px;">10 in</span>
                    <span class="text" style="left:104.0px;top:275.1px;">12</span>
                    <span class="text" style="left:122.8px;top:275.1px;">hrs during 2 ½ of pregnancy)&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:293.4px;">
                        @if (@$data['second_tri']->persistent_contractions == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:293.4px;">Per</span>
                    <span class="text" style="left:106.4px;top:293.4px;">sistent contractions&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:311.4px;">
                        @if (@$data['second_tri']->premature_rupture == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:311.4px;">Pre</span>
                    <span class="text" style="left:106.4px;top:311.4px;">m</span>
                    <span class="text" style="left:118.0px;top:311.4px;">ature</span>
                    <span class="text" style="left:159.2px;top:311.4px;">rupture</span>
                    <span class="text" style="left:213.5px;top:311.4px;">of</span>
                    <span class="text" style="left:237.0px;top:311.4px;">the</span>
                    <span class="text" style="left:266.3px;top:311.4px;">bag</span>
                    <span class="text" style="left:299.0px;top:311.4px;">of</span>
                    <span class="text" style="left:322.7px;top:311.4px;">water/</span>
                    <span class="text" style="left:69.7px;top:328.7px;">memb</span>
                    <span class="text" style="left:107.2px;top:328.7px;">rane&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:347.0px;">
                        @if (@$data['second_tri']->fetal_pregnancy == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:347.0px;">Mu</span>
                    <span class="text" style="left:107.2px;top:347.0px;">lti fetal pregnancy&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:365.1px;">
                        @if (@$data['second_tri']->severe_headache == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:365.1px;">Persistent</span>
                    <span class="text" style="left:156.4px;top:365.1px;">severe</span>
                    <span class="text" style="left:205.9px;top:365.1px;">headache,</span>
                    <span class="text" style="left:277.2px;top:365.1px;">dizziness,</span>
                    <span class="text" style="left:347.6px;top:365.1px;">or</span>
                    <span class="text" style="left:69.7px;top:382.3px;">blurri</span>
                    <span class="text" style="left:103.2px;top:382.3px;">ng of vision&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:400.6px;">
                        @if (@$data['second_tri']->abdominal_pain == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:400.6px;">Abdominal pain or epigastric pain&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:418.7px;">
                        @if (@$data['second_tri']->edema_hands == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:418.7px;">Edema of the hands, feet or face&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:436.8px;">
                        @if (@$data['second_tri']->fever_pallor == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:436.8px;">Fe</span>
                    <span class="text" style="left:101.4px;top:436.8px;">ver or pallor&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:455.1px;">
                        @if (@$data['second_tri']->seizure_consciousness == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:455.1px;">Se</span>
                    <span class="text" style="left:101.4px;top:455.1px;">izure or loss of
                        consciousness&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:473.1px;">
                        @if (@$data['second_tri']->difficulty_breathing == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:473.1px;">Di</span>
                    <span class="text" style="left:101.4px;top:473.1px;">fficulty of breathing&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:491.4px;">
                        @if (@$data['second_tri']->painful_urination == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:491.4px;">Painful urination</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:509.5px;">
                        @if (@$data['second_tri']->elevated_bp == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:509.5px;">Elevated blood pressure
                        (&gt;120/90)&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:152.2px;top:534.2px;">RISK FACTORS&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:72.7px;top:553.4px;">&nbsp;(a</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:94.2px;top:553.4px;text-decoration:underline">Y</span>
                    <span class="text" style="left:106.2px;top:553.4px;text-decoration:underline">ES</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:130.8px;top:553.4px;">to</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:148.0px;top:553.4px;text-decoration:underline">AT LEAST ONE</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:270.5px;top:553.4px;text-decoration:underline">&nbsp;of the
                        boxes&nbsp;</span>
                    <span class="text" style="left:70.5px;top:572.7px;">indicates</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:134.2px;top:572.7px;text-decoration:underline">REFERRAL</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:230.1px;top:572.7px;">to a higher facility)&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:494.4px;top:534.2px;">3</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:502.8px;top:534.2px;">rd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:513.7px;top:534.2px;">&nbsp;Trimester (29</span>
                    <span class="text" style="left:616.1px;top:534.2px;">-</span>
                    <span class="text" style="left:621.5px;top:534.2px;">40 weeks or 190 days or mo</span>
                    <span class="text" style="left:817.7px;top:534.2px;">re)&nbsp;</span>
                    <span class="text" style="left:402.7px;top:554.2px;">1</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:411.1px;top:554.2px;">st</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:421.7px;top:554.2px;">Visit&nbsp;</span>
                    <span class="text" style="left:519.7px;top:554.2px;">2</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:528.1px;top:554.2px;">nd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:543.0px;top:554.2px;">Visit&nbsp;</span>
                    <span class="text" style="left:639.0px;top:554.2px;">3</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:647.4px;top:554.2px;">rd</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:661.1px;top:554.2px;">Visit&nbsp;</span>
                    <span class="text" style="left:758.1px;top:554.2px;">4</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:766.6px;top:554.2px;">th</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:779.0px;top:554.2px;">Visit&nbsp;</span>
                    <span class="text" style="left:877.0px;top:554.2px;">5</span>
                </span>
                <span style="font-size:11px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:885.4px;top:554.2px;">th</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:897.9px;top:554.2px;">Visit&nbsp;</span>
                    <span class="text" style="left:370.2px;top:574.6px;">Date: &nbsp;</span>
                    <span class="text"
                        style="left:410.2px;top:580.6px;font-size:9.3px">{{ @$data['first_tri_visit_3rd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:489.8px;top:574.6px;">Date:</span>
                    <span class="text"
                        style="left:529.0px;top:580.6px;font-size:9.3px">{{ @$data['second_tri_visit_3rd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:608.5px;top:574.6px;">Date:</span>
                    <span class="text"
                        style="left:647.5px;top:580.6px;font-size:9.3px">{{ @$data['third_tri_visit_3rd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:727.0px;top:574.6px;">Date:</span>
                    <span class="text"
                        style="left:765.5px;top:580.6px;font-size:9.3px">{{ @$data['fourth_tri_visit_3rd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:845.7px;top:574.6px;">Date:&nbsp;</span>
                    <span class="text"
                        style="left:884.7px;top:580.6px;font-size:9.3px">{{ @$data['fifth_tri_visit_3rd']->date_of_visit }}&nbsp;</span>
                    <span class="text" style="left:381.8px;top:594.4px;">Management&nbsp;</span>
                    <span class="text" style="left:515.5px;top:594.4px;">Remarks&nbsp;</span>
                    <span class="text" style="left:634.2px;top:594.4px;">Remarks&nbsp;</span>
                    <span class="text" style="left:752.7px;top:594.4px;">Remarks</span>
                    <span class="text" style="left:871.6px;top:594.4px;">Remarks&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:614.5px;">
                        @if (@$data['third_tri']->vaginal_spotting == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:614.5px;">Va</span>
                    <span class="text" style="left:103.8px;top:614.5px;">ginal spotting or bleeding&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:614.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:386.6px;top:621.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:417.3px;top:614.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:371.1px;top:628.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['first_tri_visit_3rd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:666.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:389.8px;top:673.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:416.5px;top:666.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:378.2px;top:684.0px;">AOG:</span>
                    <span class="text"
                        style="left:406.7px;top:684.0px;text-decoration:underline">&nbsp;{{ @$data['first_tri_visit_3rd']->aog }}</span>
                    <span class="text" style="left:378.2px;top:697.9px;">BP:</span>
                    <span class="text"
                        style="left:395.2px;top:700.9px;font-size:10px;">{{ @$data['first_tri_visit_3rd']->bp }}</span>
                    <span class="text" style="left:429.1px;top:697.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:459.1px;top:697.9px;">{{ @$data['first_tri_visit_3rd']->temp }}&nbsp;</span>
                    <span class="text" style="left:378.2px;top:711.4px;">HR:</span>
                    <span class="text"
                        style="left:400.2px;top:711.4px;">{{ @$data['first_tri_visit_3rd']->hr }}</span>
                    <span class="text" style="left:422.3px;top:711.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:442.3px;top:711.4px;">{{ @$data['first_tri_visit_3rd']->rr }}&nbsp;</span>
                    <span class="text" style="left:378.2px;top:724.8px;">FH:</span>
                    <span class="text"
                        style="left:398.2px;top:724.8px;">{{ @$data['first_tri_visit_3rd']->fh }}</span>
                    <span class="text" style="left:420.9px;top:724.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:445.9px;top:724.8px;">{{ @$data['first_tri_visit_3rd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:378.2px;top:738.0px;">Other Physical</span>
                    <span class="text" style="left:378.2px;top:749.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:375.2px;top:761.3px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit_3rd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:787.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:389.0px;top:794.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:460.5px;top:787.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:375.2px;top:805.5px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit_3rd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:378.2px;top:832.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:387.4px;top:838.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:441.0px;top:832.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:375.2px;top:849.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['first_tri_visit_3rd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:614.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:506.3px;top:621.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:537.0px;top:614.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:490.8px;top:628.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['second_tri_visit_3rd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:666.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:509.5px;top:673.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:536.2px;top:666.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:497.8px;top:684.0px;">AOG:</span>
                    <span class="text"
                        style="left:526.3px;top:684.0px;text-decoration:underline">&nbsp;{{ @$data['second_tri_visit_3rd']->aog }}</span>
                    <span class="text" style="left:497.2px;top:697.9px;">BP:</span>
                    <span class="text"
                        style="left:515.2px;top:700.9px;font-size:10px;">{{ @$data['second_tri_visit_3rd']->bp }}</span>
                    <span class="text" style="left:550.1px;top:697.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:580.1px;top:697.9px;">{{ @$data['second_tri_visit_3rd']->temp }}&nbsp;</span>
                    <span class="text" style="left:497.2px;top:711.4px;">HR:</span>
                    <span class="text"
                        style="left:518.2px;top:711.4px;">{{ @$data['second_tri_visit_3rd']->hr }}</span>
                    <span class="text" style="left:542.3px;top:711.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:563.3px;top:711.4px;">{{ @$data['second_tri_visit_3rd']->rr }}&nbsp;</span>
                    <span class="text" style="left:497.2px;top:724.8px;">FH:</span>
                    <span class="text"
                        style="left:515.2px;top:724.8px;">{{ @$data['second_tri_visit_3rd']->fh }}</span>
                    <span class="text" style="left:540.9px;top:724.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:565.9px;top:724.8px;">{{ @$data['second_tri_visit_3rd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:497.8px;top:738.0px;">Other Physical</span>
                    <span class="text" style="left:497.8px;top:749.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:495.8px;top:761.3px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit_3rd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:787.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:508.7px;top:794.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:580.2px;top:787.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:495.8px;top:805.5px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit_3rd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:497.8px;top:832.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:507.1px;top:838.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:560.7px;top:832.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:495.8px;top:849.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['second_tri_visit_3rd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:614.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:625.0px;top:621.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:655.7px;top:614.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:608.5px;top:628.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['third_tri_visit_3rd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:666.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:628.2px;top:673.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:654.9px;top:666.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:616.5px;top:684.0px;">AOG:</span>
                    <span class="text"
                        style="left:645.0px;top:684.0px;text-decoration:underline">&nbsp;{{ @$data['third_tri_visit_3rd']->aog }}</span>
                    <span class="text" style="left:616.2px;top:697.9px;">BP:</span>
                    <span class="text"
                        style="left:634.2px;top:700.9px;font-size:10px;">{{ @$data['third_tri_visit_3rd']->bp }}</span>
                    <span class="text" style="left:670.1px;top:697.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:700.1px;top:697.9px;">{{ @$data['third_tri_visit_3rd']->temp }}&nbsp;</span>
                    <span class="text" style="left:616.2px;top:711.4px;">HR:</span>
                    <span class="text"
                        style="left:638.2px;top:711.4px;">{{ @$data['third_tri_visit_3rd']->hr }}</span>
                    <span class="text" style="left:660.3px;top:711.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:680.3px;top:711.4px;">{{ @$data['third_tri_visit_3rd']->rr }}&nbsp;</span>
                    <span class="text" style="left:616.2px;top:724.8px;">FH:</span>
                    <span class="text"
                        style="left:636.2px;top:724.8px;">{{ @$data['third_tri_visit_3rd']->fh }}</span>
                    <span class="text" style="left:659.9px;top:724.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:684.9px;top:724.8px;">{{ @$data['third_tri_visit_3rd']->fht }}&nbsp;</span>

                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:616.5px;top:738.0px;">Other Physical</span>
                    <span class="text" style="left:616.5px;top:749.4px;">E</span>
                    <span class="text" style="left:622.7px;top:749.4px;">xamination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:614.5px;top:761.3px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit_3rd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:787.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:627.4px;top:794.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:698.8px;top:787.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:614.5px;top:805.5px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit_3rd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:616.5px;top:832.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:625.8px;top:838.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:679.4px;top:832.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:614.5px;top:849.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['third_tri_visit_3rd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:614.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:743.4px;top:621.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:774.2px;top:614.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:727.0px;top:628.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['fourth_tri_visit_3rd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:666.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:746.6px;top:673.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:773.4px;top:666.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:735.0px;top:684.0px;">AOG:</span>
                    <span class="text"
                        style="left:763.5px;top:684.0px;text-decoration:underline">&nbsp;{{ @$data['fourth_tri_visit_3rd']->aog }}</span>
                    <span class="text" style="left:735.2px;top:697.9px;">BP:</span>
                    <span class="text"
                        style="left:752.2px;top:700.9px;font-size:10px;">{{ @$data['fourth_tri_visit_3rd']->bp }}</span>
                    <span class="text" style="left:787.1px;top:697.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:817.1px;top:697.9px;">{{ @$data['fourth_tri_visit_3rd']->temp }}&nbsp;</span>
                    <span class="text" style="left:735.2px;top:711.4px;">HR:</span>
                    <span class="text"
                        style="left:755.2px;top:711.4px;">{{ @$data['fourth_tri_visit_3rd']->hr }}</span>
                    <span class="text" style="left:779.3px;top:711.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:800.3px;top:711.4px;">{{ @$data['fourth_tri_visit_3rd']->rr }}&nbsp;</span>
                    <span class="text" style="left:735.2px;top:724.8px;">FH:</span>
                    <span class="text"
                        style="left:755.2px;top:724.8px;">{{ @$data['fourth_tri_visit_3rd']->fh }}</span>
                    <span class="text" style="left:777.9px;top:724.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:803.9px;top:724.8px;">{{ @$data['fourth_tri_visit_3rd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:735.0px;top:738.0px;">Other Physical</span>
                    <span class="text" style="left:735.0px;top:749.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:733.0px;top:761.3px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit_3rd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:745.8px;top:794.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:817.4px;top:787.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:733.0px;top:805.5px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit_3rd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:735.0px;top:832.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:744.2px;top:838.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:797.9px;top:832.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:733.0px;top:849.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fourth_tri_visit_3rd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:614.5px;">S</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:862.1px;top:621.1px;">ubjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:892.9px;top:614.5px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:845.7px;top:628.1px;white-space:normal; width: 117px; word-wrap:break-word">{{ @$data['fifth_tri_visit_3rd']->subjective }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:666.5px;">O</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:865.3px;top:673.1px;">bjective</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:892.1px;top:666.5px;">:&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:853.7px;top:684.0px;">AOG:</span>
                    <span class="text"
                        style="left:882.2px;top:684.0px;text-decoration:underline">&nbsp;{{ @$data['fifth_tri_visit_3rd']->aog }}</span>
                    <span class="text" style="left:853.2px;top:697.9px;">BP:</span>
                    <span class="text"
                        style="left:871.2px;top:700.9px;font-size:10px;">{{ @$data['fifth_tri_visit_3rd']->bp }}</span>
                    <span class="text" style="left:905.1px;top:697.9px;">Temp:&nbsp;</span>
                    <span class="text"
                        style="left:935.1px;top:697.9px;">{{ @$data['fifth_tri_visit_3rd']->temp }}&nbsp;</span>
                    <span class="text" style="left:853.2px;top:711.4px;">HR:</span>
                    <span class="text"
                        style="left:873.2px;top:711.4px;">{{ @$data['fifth_tri_visit_3rd']->hr }}</span>
                    <span class="text" style="left:897.3px;top:711.4px;">RR:&nbsp;</span>
                    <span class="text"
                        style="left:918.3px;top:711.4px;">{{ @$data['fifth_tri_visit_3rd']->rr }}&nbsp;</span>
                    <span class="text" style="left:853.2px;top:724.8px;">FH:</span>
                    <span class="text"
                        style="left:872.2px;top:724.8px;">{{ @$data['fifth_tri_visit_3rd']->fh }}</span>
                    <span class="text" style="left:896.9px;top:724.8px;">FHT:&nbsp;</span>
                    <span class="text"
                        style="left:922.9px;top:724.8px;">{{ @$data['fifth_tri_visit_3rd']->fht }}&nbsp;</span>
                </span>
                <span style="font-size:10px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:853.7px;top:738.0px;">Other Physical</span>
                    <span class="text" style="left:853.7px;top:749.4px;">Examination:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:851.7px;top:761.3px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit_3rd']->other_physical_exam }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:787.8px;">A</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:864.5px;top:794.4px;">ssessment /Diagnosis</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:936.0px;top:787.8px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:851.7px;top:805.5px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit_3rd']->assessment_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:853.7px;top:832.0px;">P</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:862.9px;top:838.6px;">lan/Intervention</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:916.5px;top:832.0px;">:&nbsp;</span>
                </span>
                <span style="font-size:8px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:851.7px;top:849.6px;white-space:normal; width: 110px; word-wrap:break-word">{{ @$data['fifth_tri_visit_3rd']->plan_intervention }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:632.8px;">
                        @if (@$data['third_tri']->severe_nausea == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:632.8px;">Se</span>
                    <span class="text" style="left:101.4px;top:632.8px;">vere nausea and vomiting&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:650.8px;">
                        @if (@$data['third_tri']->significant_decline == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:650.8px;">Sig</span>
                    <span class="text" style="left:106.4px;top:650.8px;">nificant decline fetal movement (less
                        than</span>
                    <span class="text" style="left:69.7px;top:668.1px;">10 in 12 hrs during 2 ½ of
                        pregnancy)&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:686.4px;">
                        @if (@$data['third_tri']->persistent_contractions == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:686.4px;">Persistent contractions</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:704.4px;">
                        @if (@$data['third_tri']->premature_rupture == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:704.4px;">Pre</span>
                    <span class="text" style="left:106.4px;top:704.4px;">mature</span>
                    <span class="text" style="left:159.2px;top:704.4px;">rupture</span>
                    <span class="text" style="left:213.5px;top:704.4px;">of</span>
                    <span class="text" style="left:237.0px;top:704.4px;">the</span>
                    <span class="text" style="left:266.3px;top:704.4px;">bag</span>
                    <span class="text" style="left:299.0px;top:704.4px;">of</span>
                    <span class="text" style="left:322.7px;top:704.4px;">water/</span>
                    <span class="text" style="left:69.7px;top:721.9px;">membrane&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:740.0px;">
                        @if (@$data['third_tri']->fetal_pregnancy == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:740.0px;">Mu</span>
                    <span class="text" style="left:107.2px;top:740.0px;">lti fetal pregnancy&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:758.1px;">
                        @if (@$data['third_tri']->severe_headache == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:758.1px;">Persistent</span>
                    <span class="text" style="left:156.4px;top:758.1px;">severe</span>
                    <span class="text" style="left:205.9px;top:758.1px;">headache,</span>
                    <span class="text" style="left:277.2px;top:758.1px;">dizziness,</span>
                    <span class="text" style="left:347.6px;top:758.1px;">or</span>
                    <span class="text" style="left:69.7px;top:775.5px;">blurri</span>
                    <span class="text" style="left:103.2px;top:775.5px;">ng of vision&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:793.6px;">
                        @if (@$data['third_tri']->abdominal_pain == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:793.6px;">Ab</span>
                    <span class="text" style="left:104.6px;top:793.6px;">dominal pain or epigastric pain&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:811.7px;">
                        @if (@$data['third_tri']->edema_hands == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:811.7px;">Edema of the hands, feet or face&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:830.0px;">
                        @if (@$data['third_tri']->fever_pallor == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:830.0px;">Fe</span>
                    <span class="text" style="left:101.4px;top:830.0px;">ver or pallor&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:848.0px;">
                        @if (@$data['third_tri']->seizure_consciousness == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:848.0px;">Seizure or loss of
                        consciousness&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:866.3px;">
                        @if (@$data['third_tri']->difficulty_breathing == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:866.3px;">Di</span>
                    <span class="text" style="left:101.4px;top:866.3px;">fficulty of breathing&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:884.4px;">
                        @if (@$data['third_tri']->painful_urination == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:884.4px;">Painful urination&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:69.7px;top:902.4px;">
                        @if (@$data['third_tri']->elevated_bp == 'yes')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:86.3px;top:902.4px;">Ele</span>
                    <span class="text" style="left:106.4px;top:902.4px;">va</span>
                    <span class="text" style="left:120.6px;top:902.4px;">ted blood pressure (&gt;120/90)&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:90.4px;top:928.3px;">A</span>
                    <span class="text" style="left:102.4px;top:928.3px;">.</span>
                    <span class="text" style="left:120.5px;top:928.3px;">Vital Signs Monitoring (</span>
                </span>
                <span style="color:#FF0000;font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:293.8px;top:928.3px;">Pls. Fill-out if the patient needs to be
                        transf</span>
                    <span class="text" style="left:609.3px;top:928.3px;">er</span>
                    <span class="text" style="left:616.8px;top:928.3px;">red or referred to higher</span>
                    <span class="text" style="left:797.9px;top:928.3px;">institution</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:871.2px;top:928.3px;">)&nbsp;</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:62.8px;top:949.6px;">Date/Ti</span>
                    <span class="text" style="left:103.8px;top:949.6px;">me: __________ AOG: ________Height:
                        _____Weight: _____ Fundic Height: ______ Fetal Pr</span>
                    <span class="text" style="left:617.0px;top:949.6px;">esentation: _________________ Cervical
                        Dilatation/IE: ______&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:95.6px;top:971.5px;">M</span>
                    <span class="text" style="left:109.8px;top:971.5px;">o</span>
                    <span class="text" style="left:117.4px;top:971.5px;">nitoring&nbsp;</span>
                    <span class="text" style="left:238.4px;top:971.5px;">15 min.&nbsp;</span>
                    <span class="text" style="left:354.3px;top:971.5px;">30 min.&nbsp;</span>
                    <span class="text" style="left:469.9px;top:971.5px;">45 min.&nbsp;</span>
                    <span class="text" style="left:585.6px;top:971.5px;">60 m</span>
                    <span class="text" style="left:617.1px;top:971.5px;">i n.</span>
                    <span class="text" style="left:730.8px;top:971.5px;">Management/</span>
                    <span class="text" style="left:819.6px;top:971.5px;">Intervention</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:69.7px;top:989.8px;">BP&nbsp;</span>
                    <span class="text" style="left:69.7px;top:1008.1px;">Temp</span>
                    <span class="text" style="left:69.7px;top:1026.1px;">HR&nbsp;</span>
                    <span class="text" style="left:69.7px;top:1044.2px;">RR&nbsp;</span>
                    <span class="text" style="left:69.7px;top:1062.5px;">O2Sa</span>
                    <span class="text" style="left:101.2px;top:1062.5px;">t&nbsp;</span>
                    <span class="text" style="left:69.7px;top:1080.6px;">FHT&nbsp;</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:90.4px;top:1104.5px;">B</span>
                    <span class="text" style="left:101.4px;top:1104.5px;">.</span>
                    <span class="text" style="left:120.5px;top:1104.5px;">Pregnancy Outcome&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:542.2px;top:1106.1px;">Date Terminated:</span>
                    <span class="text" style="left:664.7px;top:1106.1px;">_____________________</span>
                    <span class="text" style="left:69.7px;top:1124.6px;">Deliv</span>
                    <span class="text" style="left:103.2px;top:1124.6px;">ery Outcome:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:195.4px;top:1124.6px;">Fullterm</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:247.2px;top:1124.6px;">
                        @if (@$data['preg_outcome']->delivery_outcome == 'fullterm')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:263.7px;top:1124.6px;">&nbsp;Preterm</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:314.9px;top:1124.6px;">
                        @if (@$data['preg_outcome']->delivery_outcome == 'preterm')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:331.4px;top:1124.6px;">&nbsp;Stillbirth</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:389.0px;top:1124.6px;">
                        @if (@$data['preg_outcome']->delivery_outcome == 'stillbirth')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:405.5px;top:1124.6px;">&nbsp;Abortion</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:463.5px;top:1124.6px;">
                        @if (@$data['preg_outcome']->delivery_outcome == 'abortion')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:536.2px;top:1124.6px;">Birth Attend</span>
                    <span class="text" style="left:618.7px;top:1124.6px;">ant:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:648.4px;top:1124.6px;">MD</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:672.7px;top:1124.6px;">
                        @if (@$data['preg_outcome']->birth_attendant == 'md')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:689.2px;top:1124.6px;">&nbsp;RN</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:713.9px;top:1124.6px;">
                        @if (@$data['preg_outcome']->birth_attendant == 'rn')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:730.4px;top:1124.6px;">&nbsp;RM</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:757.5px;top:1124.6px;">
                        @if (@$data['preg_outcome']->birth_attendant == 'rm')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:69.7px;top:1142.6px;">Status on Discharge:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:206.6px;top:1142.6px;">Expired</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:254.4px;top:1142.6px;">
                        @if (@$data['preg_outcome']->status_on_discharge == 'expired')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:278.3px;top:1142.6px;">Improved</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:337.0px;top:1142.6px;">
                        @if (@$data['preg_outcome']->status_on_discharge == 'improved')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:353.5px;top:1142.6px;">&nbsp;HAMA</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:403.3px;top:1142.6px;">
                        @if (@$data['preg_outcome']->status_on_discharge == 'hama')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:536.2px;top:1142.6px;">Type of Delivery:</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:656.1px;top:1144.2px;">Normal Spontaneous Vaginal Delivery
                        NSVD</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:904.1px;top:1144.2px;">
                        @if (@$data['preg_outcome']->type_of_delivery == 'nsvd')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:536.2px;top:1160.1px;">Cesarean</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:585.2px;top:1160.1px;">
                        @if (@$data['preg_outcome']->type_of_delivery == 'caesarean')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:600.1px;top:1160.1px;">&nbsp;Vaginal Birth After Cesarean</span>

                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:760.5px;top:1160.1px;">
                        @if (@$data['preg_outcome']->type_of_delivery == 'vaginal_after_caesarean')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:775.4px;top:1160.1px;">&nbsp;&nbsp;Assiste</span>
                    <span class="text" style="left:820.6px;top:1160.1px;">d Vaginal Delivery</span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:923.2px;top:1160.1px;">
                        @if (@$data['preg_outcome']->type_of_delivery == 'assisted_vaginal_delivery')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:13px;font-family:&#39;Times New Roman&#39;">
                    <span class="text"
                        style="left:60.7px;top:1176.4px;white-space:normal; width: 900px; word-wrap:break-word">Final
                        Diagnosis with ICD 10 code: {{ @$data['preg_outcome']->final_diagnosis }}&nbsp;</span>
                </span>
                <span style="font-size:12px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:172.3px;top:1216.1px;">_____________________________________________________________________________</span>
                    <span class="text" style="left:617.3px;top:1216.1px;">_</span>
                </span>
                <span style="font-size:18px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:709.5px;top:1209.3px;">________________</span>
                </span>
                <span style="font-size:17px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:180.7px;top:1231.0px;">Name and Signature of Referring Health Care
                        Provider</span>
                    <span class="text" style="left:771.8px;top:1231.0px;">Date</span>
                    <span class="text" style="left:380.8px;top:1270.7px;">ACKNOWLEDGEMENT RECE</span>
                    <span class="text" style="left:619.0px;top:1270.7px;">IPT&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:210.9px;top:1294.8px;">(</span>
                </span>
                <span
                    style="color:#FF0000;font-size:15px;font-family:&#39;Times New Roman&#39;;font-style:italic;font-weight:bold;">
                    <span class="text" style="left:218.9px;top:1294.8px;">for immediate return to hospital/clinic of
                        Origin by the accompa</span>
                    <span class="text" style="left:625.0px;top:1294.8px;">nying hospital/clinic personnel</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:818.7px;top:1294.8px;">)&nbsp;</span>
                    <span class="text" style="left:667.3px;top:1316.9px;">Date/Time:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:740.2px;top:1316.9px;">&nbsp;{{ date('F j, Y, g:i a') }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:72.7px;top:1338.8px;">Nam</span>
                    <span class="text" style="left:103.8px;top:1338.8px;">e of Patient:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:181.5px;top:1338.8px;">&nbsp;{{ @$data['form']->woman_name }}&nbsp;&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:577.2px;top:1338.8px;">Age</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:602.1px;top:1338.8px;">: {{ @$data['form']->woman_age }} </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:670.3px;top:1338.8px;">Contact No:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:748.4px;top:1338.8px;">&nbsp;{{ @$data['form']->contact }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:72.7px;top:1360.9px;">Addr</span>
                    <span class="text" style="left:107.0px;top:1360.9px;">ess:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:130.3px;top:1360.9px;">&nbsp;{{ @$data['form']->patient_brgy }}
                        {{ @$data['form']->patient_muncity }} {{ @$data['form']->patient_province }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:72.7px;top:1383.0px;">Referred to (Accepting Facility):</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:289.8px;top:1383.0px;">{{ @$data['activity']->name }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:753.1px;top:1383.0px;">Contact No:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:831.4px;top:1383.0px;">&nbsp;{{ @$data['activity']->contact }}&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:72.1px;top:1404.9px;">Status/Condition upon Receipt at ER:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:323.7px;top:1404.9px;">{{ @$data['activity']->status_on_er }}</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:72.7px;top:1427.0px;">Actio</span>
                    <span class="text" style="left:107.0px;top:1427.0px;">n Taken:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:203.0px;top:1427.0px;">Admitted</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:263.5px;top:1427.0px;">
                        @if (@$data['activity']->status == 'admitted')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:314.1px;top:1427.0px;">&nbsp;Referred to other facility</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:470.7px;top:1427.0px;">
                        @if (@$data['activity']->status == 'transferred')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text" style="left:517.5px;top:1427.0px;">Treated/Managed</span>
                    <span class="text" style="left:635.5px;top:1427.0px;">as OPD</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times&#39;;">
                    <span class="text" style="left:685.6px;top:1427.0px;">
                        @if (@$data['activity']->status == 'monitored')
                            ☑
                        @else
                            ☐
                        @endif
                    </span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:72.7px;top:1448.9px;">Remarks:</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;">
                    <span class="text"
                        style="left:136.4px;top:1448.9px;">&nbsp;{{ @$data['activity']->remarks }}&nbsp;</span>
                    <span class="text" style="left:653.5px;top:1490.6px;">______________________</span>
                    <span class="text" style="left:819.3px;top:1490.6px;">__________________&nbsp;</span>
                </span>
                <span style="font-size:15px;font-family:&#39;Times New Roman&#39;;font-weight:bold;">
                    <span class="text" style="left:652.9px;top:1512.7px;">Staff Name and Signature</span>
                    <span class="text" style="left:823.5px;top:1512.7px;">of Receiving Facility&nbsp;</span>
                </span>
                <div class="image" style="left:130.7px;top:22.5px;"><img width="108" height="106"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:722.8px;top:28.9px;"><img width="92" height="94"
                        src="data:image/webp;base64,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">
                </div>
                <!-- <div class="image" style="left:829.2px;top:28.9px;"><img width="94" height="94" src="data:image/webp;base64,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"></div> -->
                <div class="image" style="left:367.6px;top:1267.4px;"><img width="305" height="36"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:201.6px;top:1287.8px;"><img width="29" height="37"
                        src="data:image/webp;base64,UklGRlYBAABXRUJQVlA4WAoAAAAQAAAAMAAAPQAAQUxQSOwAAAABgGNr2xrl93FdgFYzuJTJHqgjHe7VyAJwJ/qtF+cNThMRagOgaUixOwFHsP+S4FJpJTkQotLuT/VbJY6r+pKzu7+90pK4Wl49vg+ut/sa9aKytHoaEwX7Uyjonnf8UHS/i2q8Zg0DIkrOvLbEQLa9s4SIgqFVAz0z03v3T0a/B1vbk4iIoold4+D14YxBve7v3hNhf53aD740ZHElg48+KGGYmTkMnlESfjC0mwJ14BzHj8PF+lKFo4S+fpEQUXzsoIQomvYwIKjUme65R2ECpQCvLLrDM6hdMVHpWR7WEBlXtWeWm4Gp/0MFA1ZQOCBEAAAA0AMAnQEqMQA+AD6RQpxIpaQjISwI0LASCWkAAFzH9/UvCvW5s7VAAP74z3mpef+7JmM0bUDoXbGQEO73A8gRAAVAAAA=">
                </div>
                <div class="image" style="left:206.6px;top:1288.0px;"><img width="614" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:796.3px;top:1287.8px;"><img width="37" height="37"
                        src="data:image/webp;base64,UklGRlYBAABXRUJQVlA4WAoAAAAQAAAAPgAAPQAAQUxQSO8AAAABgGLb1vLm4zAOANVP6o/Mr2OzIsmljAoHwPz9+I03oG65FRGhyG0jZZh2TwN/IP8AkHIhpeAUxqWW5ThWu8JAwFuj/ePjw4lfB5G09p/DUF8v+iCSznFojEluF36FgsRLuqLrWU9iwuOzpxWFZ4MahTzrDa/iJaR3szYnCCp4R3oJRh+5CvNpe3a3cuPLAOISWgsuoS5R3mm45h5aEtlyJjx2vniAP/uA/SZ7c2i3s2ZwFgJnjVb87YcU6PP25DoxwD0jrUNtNrccrtnS6Bq4Y59DfXc28+sMd18OZ4NehQGvm9WuCQq8rWun9V8KEgBWUDggQAAAANADAJ0BKj8APgA+kUCcSKWkIyEsCNCwEglpAABcx/f1Lwr1ubO1QAD++M95qXn/uyYKe8gF6foFv07Y1gYgAAA=">
                </div>
                <div class="image" style="left:655.0px;top:1309.9px;"><img width="97" height="37"
                        src="data:image/webp;base64,UklGRrwDAABXRUJQVlA4WAoAAAAQAAAAoQAAPQAAQUxQSAMDAAABkO0AgNo2NZabjjkez4ExMzOUmbmW64UGZQarEMkX5+LvjQ/ss5+3iHDgto0j2bPXi7I7nvKFin/FmRNESRQ4jzDhrJFgdoXx9YoaV5WILBEtRxCYej50R21UjROMFMbiMnH1t3t0Q+97lowTnXzWV4bpuV3PhUxCtEkzSNZ77jTyXk6dGq3lyLBKz6YFLHM2ZRCdmjXLMJs9ihAySap2AEi2tsbu0pp0oVkztKaoQJScmLEcx4F2ARBdsGEZxtJVKWyKG8AhurgzTmn84We5PDjQyOVykWeztuPZwIiHTqpuOdR277BMSN3hexO70AGpGzWkEEtKnwk9i4RIyz0niDgD7yKwHGwEQpUlWMLaxIskIXUvJnaKjmPPfbpBCvGRhG45OCtNNEQSamOjomIMF05dKCO4kfLXPPUUmN/KQ7TtkpKXmt0tulD7cylSiB89SQOHwEoWjki13vfyZZ+OMQw0DZQR0EgxspxMIWXay1PLNlacXSCmjo5ibWkDizbCkp+bXLZxLht6oCagmnNzpoUx7K7vlhGQSLH+IPjdkbUcNi7ubeYhcon1zq85gF2wzNw+dLwb2u55o/RIYMTZK/tlxIQ+G6U2uDv5InH5QQpgnf7Oxz/AYebAlHryZtZ2GNqefXFErk7g0Dcil/tNGHb9vHs/XWApayYhk6CNeCV9cPbV1Qroy2G/gWafIpAluVFn1Dfzy79zuVyqTRGZK/dt1IRMnz+LcBRJcYOR4NZUV3t7e8uz4wH80OQC04iBVFJGoIO9CWSmYCZsYYJCB/pyYLNtCZaYvYNCY6pW+gL4GsMVi5d5gNU7KDSmWreAcIqaK1hA5lJGv4pCE+T/k57mskBWzpb5u+/R45kD4MMFG+LPidAHmlrjLsF92st6IJDdh9739OLhC02aQbGHLQbI555GOCK01hStjJZxfdrLmiqQHZyqRETe3dNR7GGbZmjNFyQytBqtFVxcn/ayLg1kFywKHLovppi+1cXLQhBxXgTXp72v7UO5r0fL+u+ZKwAAVlA4IJIAAAAQCACdASqiAD4APo1CmUe/pKKhMLvIY/ARiWkAAF99u+c0ikdetRkkH3NBvWtY44SVZTQAisl4TMa510zXCgyxGKAXg07sS5wAAP75M6cP/lULP/1vAB3/w/6paerYC1hMAT3inTfgR6T7kt81zgJKb8qUvBO7kaoBM///8fBK+y+8BQoAp0/0ZR///HwAAAAAAA==">
                </div>
                <div class="image" style="left:727.8px;top:1310.3px;"><img width="240" height="37"
                        src="data:image/webp;base64,UklGRhABAABXRUJQVlA4WAoAAAAQAAAAjwEAPQAAQUxQSHkAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDWwi23by/wcBDFIYJGAgC6Cjz9QZlDBIwEFSkCSg41XvlS+i/4rctm2kpLvn9QTBKsj+Y1gOttomEDcfsLWMJIx42bB1TRSMdH+x9ap1GM39Y+s363QUdAzTsY2Mc4uh+rwUAFZQOCBwAAAAsAoAnQEqkAE+AD6ROppHpaOioS9IKLASCWlu4XHQCSIwLGVZ5JTSrBgdtrORgWMqzySmlWDA7bWci/wtNCaE0JoTQmhNCaE0JoTEUIIhgTAmBMCYEwJgTAmBLx/aAAD+/tIC8Hp4Ff/394LTAAAAAA==">
                </div>
                <div class="image" style="left:60.4px;top:1331.8px;"><img width="133" height="37"
                        src="data:image/webp;base64,UklGRgQFAABXRUJQVlA4WAoAAAAQAAAA3QAAPQAAQUxQSDAEAAABoPhsn9pGquM4JUXLfBcvr+X0lnmPmZmy3hwtWq7lLkRKjiFRU5Rm6kz898a/38+T3/SYIsJhALRtA9npANtRJJ8w8X9atOyy4zhl2+LUmavcrP5hCwANm8OcVd7ier7ve261RBjD7vRQqroeULn51tnayD9sgTLQ4NVmjS+l6uFrQRTHcdQ4U7WxMeyupPO7zpYzjQiotDbboLJr74RxDFrg7K5DuYbwnZptuqOqZ663+kJKKboNdxIbw+62ljR+93A96Aqg0h6r8430t+OFazKn6N28cmV+pGEt9BzDsN1Gd0NlOUXkzWBj2N3ZqkWtW882ojj88NVEAJVjOHYOvRsa6W/Hj2UGOFgMm9+mWSZj3zQcLxIZpIz9WWwMues1XJtaz93sCbmWfPBQZuM5Lm1/8uE66G+DTTBY6a6rHPXpMhF8SnQscui4VxCd6Jg1czKRYyAT80/MIIGV7edvLQ5G6lqftGSGHdOkBN5eVplMTs7gmMg3fIO+yiCHapiNsHD5GI4/3qF9hzy/kJ67ZXKL6xHRiXhuEU++2kkh1HroFSPtvHoSCZx7+na+Zun3d79PCcc0aYGEZNaAa215sp1mBba/DT6PcPBpvtOM4kJGwZOnngyAHBhf8XOLmHRWFVxXW+/VpikgMZ0EC2wvD2Dj99YV4ZgmKZCSzBtwK3OJLIBa7y4LHHyWfx5pKKTotxfafSAHxVerevZmj9C3kSo8PF4+PDtZiEylG5RAYrBSjmlSAknJvAHXIV0THjU0FLdLqojHt17Jo3NvoKNPJienLeBrXBa45KGMfV6YZNp+cotVqc8LuvGp+w7wNVYr8rUm1vdrg+oHrlMcM6j7tj6I5xz/AY/H9e7KwARgr5miiLxpN+jTrULetwD0niUco/Ef8IzPb5vh4gCmG6yAvcEO8lXqRUL7/gQAvif67QffrqP+Q+9X/Ac8FheuXbu7MsyGS81DZU7kvREtK3ObWY1BTwxbBPQaiYKnrwVdpYGHHz1kQnLu+Ps/q0z9/M4+3h/aePDMiy1p7vK09mauQiL95o1TnrvjxOfLw4IT1k3aeePFEG9Ys4i0/fzZG72Bsa85+WXdKE6i8+yuil3BHUBkD6yX1eo3nWV8mTUDVP0bJy/eXGRYdEcGyLM0R5MNT7AMKnJT2QPr1zKVpgp/jTd7F1F997lb7AthUOs9i3qW/IiItN+63G8KVkDTUOfU1rwAMPJJB+ZIZBMR3hEIGbAUMkz2TbiGMsbS9idbEiWgLNTIb8mUmMhCYVlOyAAVtZBGSeS3jDMeONt3Dl/vijw5T2IWatQmZDlDVBBwSoWSYVXzmRujJGoTxtkqVKkhy1Hw5JzPQo26kixFyerPmq1RMlABapREXck+40lN+G2pOCzUmBMgpxFoTZaODKPUnBNgn6z9neP//uMvB0wAVlA4IK4AAACQCQCdASreAD4APok4lkelI6IhMkgAoBEJaQAW1wN9rl/MohcIp+73FuaDSMhT9YmLx9EHVxSr+BzkPSy5j5PDEbbVXX3cjZrIya4fA5sDKIY6eGAAAP7/TWFX/+Whb//loGb/QVQAF0N08ZHYP9OsgtVjg2uIVkAHqcFMJ/6Bp9Ie+4LpU5Fn0fowJcRt7zn//5VmGpaWRfFX3/7VyIZU3VO7wkwHfdlnAAAAAAA=">
                </div>
                <div class="image" style="left:169.3px;top:1332.2px;"><img width="420" height="37"
                        src="data:image/webp;base64,UklGRkQBAABXRUJQVlA4WAoAAAAQAAAAuQIAPQAAQUxQSH4AAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21aCBWARhUUECngAZsydsUMSFhFoYAksAj3e7DsR/Vfktm0jZXXd+wbp99/ffxCI339000Y9LQOCk/WoZxHKAKJ5RT2XWAGQbA/qeVYagPr6UM930hC3IO424j5D9f81D+nvPxJWUDggoAAAALAQAJ0BKroCPgA+kTybR6WjoqEvSBiwEglpbuF0oRtDndkmvKVWCorORfS3XZJrylVgqKzkX0t12Sa8pVYKis5F9LddkmvKVWCorORfS3XZDa3KpyNYUkQwJgTAmBMCYEwJgTAmBMCYEwJgTAa7QWkiGBMCYEwJgTAmBMCYEwJgTAmBMCYEwJgTAgM9aAAA/v9SZCgfkgKv/18IFKUAAAA=">
                </div>
                <div class="image" style="left:564.8px;top:1331.8px;"><img width="49" height="37"
                        src="data:image/webp;base64,UklGRkwCAABXRUJQVlA4WAoAAAAQAAAAUQAAPQAAQUxQSMIBAAABkHRte5pFVHHftzjBoVvcYeUO49opPeMz+MqdhBDe39uTfPI2SxYRwcBtI0Xt7eUYu/CGghdzNizbsS1Dq1LqkXbileo0OfXzYRzOeZZGrOz/fcduv3W4GrFh+0IA3x2oNDTiXwYgLrYbHF1k+VsJAdjf/kpDzlt2owfQ7dihACrMcp+052Dil5uo6wO7HECBXRVsRHEOjjb6yg3soxU01QYfTinLwfRks8HBPlrBcM/W6RNkt/pzkang7ex3CrlJXGz5VgoEoL9WkqfI0TQiTgoE4MdfjnmuYnG7kwIBxN3pnchHqHwWz5BYfoCUZdYMSBX/7uQ6Q7JSllEefLpKyA9fRVdCD1n+hpR69mNgYpfrIYdEVH7KvuA7y1c0Ijhqj5ms3t44Xz2dbvgWziy8ZYlvw+5u+QkeebZ7CP4otyenHwKcJsry5sI4cTjX0CA/wfe9G5G53Ox9V9q8oMpE63ulVtcrL5efoHtmj2cU35vpxm6XDctWegblCUq6s9yT7nSV5Nl3YGUENwZYGUkuIF8fJQZYGfm+e0EZvdj9jhEDtIx0DmxFcbQ10InQTeJlxK30STvxK13bMrQbIb4AdQFWUDggZAAAAFAGAJ0BKlIAPgA+jTqXR7+joiExSAPwEYlpABbaxBbmM5a7x9RVBjXQze6Xky68y1YAgbYkP6qzr3AAAP75NbP/6AA4/yo9dsIKM4qYevTxAAAfhN9VB//7wW9nzp/+AAAAAAA=">
                </div>
                <div class="image" style="left:589.7px;top:1332.2px;"><img width="93" height="37"
                        src="data:image/webp;base64,UklGRj4BAABXRUJQVlA4WAoAAAAQAAAAmQAAPQAAQUxQSM4AAAABcFtbe9MgfqnCeYCcyGESao1A2oI2VwwsV5K/48qOCEZu2ziyp7fbav0G66+BGXEhODFE1Tm6vu8eHUCFjnnRNEV+JDwSbtHNc1e4ApD8Zl6WufG/ME2VK0AtT608EahrlczWgB5iq2uUxo8Dt/DI3t7iNAlPDp6GrTNZgSI8nWQ7gSK8cKtpUTkKCaOqoDXQlhlxYaw5Ma3XlIRoqHXlTnt9ekusSkI01CoNNaZ8NSEaapWG2vFgpvV/2dAak5f1/3U/4JrGYj5Hf1XaAlZQOCBKAAAAEAYAnQEqmgA+AD6RPptHv6OioS5oY/ASCWkAAG8WBNDF08vtrpwsAr9s6csOmbYqAJ+5/HzqzXiAAP74z3jGhg/90WAAAAAAAAA=">
                </div>
                <div class="image" style="left:658.0px;top:1331.8px;"><img width="103" height="37"
                        src="data:image/webp;base64,UklGRm4FAABXRUJQVlA4WAoAAAAQAAAAqgAAPQAAQUxQSJ8EAAABGTFpgvf6NzZERP/TKoDatO1tWkl6bYrBOAafRuiQbG/5tL39/5ned09LrxCn2UmwX82g15IQmfNxN2ICJDiSpEhSFizfeWRVQn2BZf7jcHCA4xhBQMIb8DsOT8gDGJSKpQTypw/J7QxDhBCGhyAJ1LX4mgZCC4ttiyEGJaYSwnKyBQHZ4eJqIjVAGkrNpCokA5W02hUYe1vEF/IsvlhsiMkc+NG+nJkHirKJUBtcILJlnYvYzN92+T6yYKCSVrsmPjHmcwDp+ECXIDBzz9UAc0jXEx9rcxGhNrhAzboNJdKEay/9gekZKWGIpBWvLRMBRwFCev+eCywB2dAx0eGSQu1wAVdJGcEJbfjEtVCFS0pa6eLqxj5RWAgxoCithJggCBzHKSF9Y+96qgrcKysjYAU2xACO03M5kMCgYig5AmN3iNcExLhcnILXdoiDlreN0ZW7cY5pqnPQC5Mhhu7cqqoAOsg6oACjbIkYF/IALdfYpamEzGMBQKdPkN5AqSuuDhdQ8toNcYcv4qOf33juX8Im6S4Q2ZJA1C5dCgTU5mmpczAUrGiZYy9UTLQALdelPT/aJ/NYlyIhER1XYo+0hYCa12aIc54mupjMqT/9BY1s2eQDoKZDEIgJclN/wZGbScAUdmJXoMvHabnuLH6H5DH93anp8HFqXpshDkID1LsocWhfLPfSnz7VUQaAq4jVIHCcGa1LxYCeeFdFjUPPVSKvl4D0q2nDglHDazPEgSfkoRZ7bSojXNn3QkcgovIuZ0ovKD0HPC0GbkRoLqP+XQ2jGa+tCQhnoZZnTvwg0LWlY2lWdCvlqVrKjSgxdelAwmxyQMOw2iEk9lVsSKDlLXbsqSeW45r60Z5LU0h59MZ8SIaa0cEvgam4gZcEa468deWWYCiBA4BsB166g4Ti0ScWMWSKT8I9cyJlSa8i54LQUGRXxlEXCqyzkAi4qoYqzkzxraqQxyBeZrb5+gIOM0sdi+UYJnfKlilyLqhp6wjNtbQNNTVEljcQ6vMAM8VXGvoEhimWHnq2QmIHes+ED5gl6KfItsdj6/8s2/S9TRXEWdee+xfqaYt4HABY+FLgOCNbbB6OUZUektW4iroT26Y6yswuxRPk289ZM0fXVz4UAMWCvqbOYS8fGH+bU5UeWitA5H3bTh25EnKYlgWrrRMX+MAXesoKEhmwus/MSg8gG6hpeyzxt/dtCDgegJySns+8Z40DaPOH8oYZ/tt6GD2CgFCxVgAXSBz7iWxwFaewshPhfBve1RHxAOIXhHIpmj/0vYeeQwuj5RSuzKQQQJm5e4xM2HOXXviJ7GpQ4hxaU9SUusAQhrkMsvmie6xtKOTyhDyckIpdO7ftSsNACOg7Oj2HFkbLiWb+MoNQ4sBzroVlDiQyl2RX48oc+02qo6gptofpCgGCZXFyjrqQxyVjD8W2nbtGNqDvk/UcWhgtJ0rN3BDQ1I9qAK3vOdnVtLkyR/51zucpGNkAwUKWX98k9mQhypH8welfH3oOPYwaofCiEBL7ihCkqyHv0pSKETF7ln19WHitP6Qh5JQMiX0munLMG2oIOeb/wwYDAFZQOCCoAAAA8AkAnQEqqwA+AD6NQphHpSSioTI7iACgEYlpABbRaP9h5gtahM9Mc86uQJa7l8ho3yPQwiGS2yIGQ7+ruAzGcYcKRm956KhpQGpj/O0javhvRX43RMesAAD++TTX/+MAAZf6R13ovF4XeAFW07KON4lk/aFuY1KpRASmYCYCBBQTMYBb3/Jj9/jQAbjX6RY8VTyS9WOF82H/0MCVf1fC3zf/zlAAAAAA">
                </div>
                <div class="image" style="left:736.1px;top:1332.2px;"><img width="231" height="37"
                        src="data:image/webp;base64,UklGRg4BAABXRUJQVlA4WAoAAAAQAAAAfwEAPQAAQUxQSHcAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21byfwMBElgAMuiUCl6ARQLNQANrwKIAFVhUoIfeIT+i/4rctm2kpLvn9QTyK6z0H2Y7CNXpBcKyQ2iuXSAaFoT21gWK7UDo7F+g2k+ErgH+Av8w/m34zx3JzGcfAQBWUDggcAAAADAKAJ0BKoABPgA+kTyYR6WjoqEvCACwEglpbuFx0AkAeeo467kdyO5HcjuR3I7kdyO5HcjuR3I7kTfghkJWSslZKyVkrJWSq0vsYNIzJmTMmZMyZkzJmTIrAAD+/tIC8J4AJH/xfQY8P//EaAAAAAA=">
                </div>
                <div class="image" style="left:60.4px;top:1353.9px;"><img width="82" height="37"
                        src="data:image/webp;base64,UklGRhoDAABXRUJQVlA4WAoAAAAQAAAAiAAAPQAAQUxQSIcCAAABkHRre9M4xlhMeu+N9BA8cVulsMqq9x6PV6kE67iX9J6428gajX6vkUAITpZzIsKB27aRZM9u5h7NkaRvSKx/YEVNgZSq/A9+m48ZpnFssxL0SID3UIIoYi9w4p4N7XsnQNAjMZmHEkQR97j9SmOCJo0r2xVe6rG7NoTQvntMDaKIuVS92COU9FZO+gRg2GOE0Ng2QBBFzKWlyy6lFLX8AjAh8lCgCYIo4p1nynariyldhKKucreyKVPhtORLUclsAgJOqckFmrZdN0xD367xLJGkFTi5slhe2C2ntUQiuVU3zMy1D5jRhd1+FPjDtYwpYOPEwROGuWwVHegUrWUfFj6t5O7dQtQT7lrbleSOwnMHVj6MiKfqlYt+FGT0oQIF7JTulhZo3Z6L3F634sfCpVUUkdlZ21Z4+cdFc8yg4M8l24+CEjxHAnYHPwcMGgvmx8KlVQSR3Xn3ied/VilvMvk9XKWhvUbWBFm4tJIe+XA+X3aDbi7wViWaVySRUtS+eesDpsImkz8TEoGiiEwafPo0IuLCX99+xZT9BDEJIw6NWy01BnCHujPUetpC7GVrH0Yhp7XJ11aj0ag81FNSY+BHJ0H4w7XCtQ84ZPzz9umjR4/uW/tUSUruslpIICnDL8yruV2ZCorVn7K18HpAmDLlDIiPwu+Cu9beNESxWq3qbLFCVeuqdw1plYr0imcyEMXqMGA4LsuZM7wryrPrZDKOGy+ZELFK77W6WGpZypzxL/w04orOD7TYT2hL+v0YyfPYNnczrVDIUfQ4fujJNuclD0GOOU6NGRwIOYquzw/G2eGK6iFIMje8SW7VBUGjGgcpagqwAzgGQY55TnFQgZHh+vVOAABWUDggbAAAAFAGAJ0BKokAPgA+kT6ZR7+joqEvCAPwEglpAABqKp+7wJfUGEH+3EqRGi5U8gickp7u8ALpcbH3LfoAAP74zOd/4kAcYXgD/oaYse9TQSz7AQPitT/f/G4DpT//8VE2q///FRPMDQqAAAAAAA==">
                </div>
                <div class="image" style="left:118.1px;top:1354.3px;"><img width="849" height="37"
                        src="data:image/webp;base64,UklGRsABAABXRUJQVlA4WAoAAAAQAAAAgAUAPQAAQUxQSIYAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21aCBWARhUUECngAZsydsUMSFhFoYAksAj3+1LgR/VfYtm3DjO4HeoIE/wP+g//gP/iPzYD/dNOmoWEZJJysp6FRhDKBaF5paCyxQiDZHhoaZ6URqK+PhsY7aRS4UeBtCvyMZv8/w/+AseA/CVZQOCAUAQAAkB4AnQEqgQU+AD6ROphHpaOioS+IALASCWlu4XaxG0OuQI+MDtryyMCwiWeSU0qvgHbXlkYFhEs8kppVfAO2vLIwLCJZ5JTSq+AdteWRgWESzySmlV8A7a8sjAsIlnklNKr4B215ZGBYRLPJKaVXwDtryyMCwiWeSU0qvgHbXlkYFKf89hY83u53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5wp/PYWPN7udzhT+ewseb3c7nCn89hY4t1fMFZTXu53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5wp/PYWPN7udzhT+ewseb3c7nCn89hY83u53N/qIAD+/7wXUgAI8QAAgf/r4QAAAAAAAAAA">
                </div>
                <div class="image" style="left:60.4px;top:1376.0px;"><img width="234" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:269.9px;top:1376.4px;"><img width="495" height="37"
                        src="data:image/webp;base64,UklGRloBAABXRUJQVlA4WAoAAAAQAAAANgMAPQAAQUxQSHsAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDayqbU8yGvi9k8OlCIcokEALeABvAhGgx7jahkX0X2Hbto2U1XVAXwC///7+8wHI7z+S7aC6CgUPHcYJqhsJ8IjpNKO6pQ6PUW07qtv7FzAcJ6q7BnhT8GYbb57h3b/qa9rffwAAVlA4ILgAAABwEwCdASo3Az4APpE8mEelo6KhLygAsBIJaW7hdgEbQ5TTVWk1CqKVrpqrSahVFK101VpNQqila6aq0moVRStdNVaTUKopWumqtJqFUUrXTVWk1CqKVrpqqrSqYrtXau1dq7V2rtXau1dq7V2rtXau1dq7V2rtXau1dq7QtZ0Yx/vg27t3bu3du7d27t3bu3du7d27t3bu3du7d27t3bu3duZRQAD+/5rAoAhcAC+/6iCoSAAAAAAA">
                </div>
                <div class="image" style="left:740.7px;top:1376.0px;"><img width="103" height="37"
                        src="data:image/webp;base64,UklGRqoFAABXRUJQVlA4WAoAAAAQAAAAqgAAPQAAQUxQSNoEAAABGTFpivGeEf0PTPU4AoGk/b1niIjUcBvZttq8/34kpkhmdir3XwgzMzMIn1yCJ2IC1LZtw9hOWfsRtLZtTxtH+mSQ5TgeJ8NYGOgyHNFp///uIePwNORAIzkT67uuSHJspVdPNyIcuI2kSDWwu4eZ6sEvQPDnkAxiGOBBBABEhR+1VziBToCAq5ARo2o+mOOHY7sWokIjBB+C+UhikhmydCEmkzSly/uf78pmzUZU6IQLeIebkrkMNQNu3nykKqiyyHRRCbqC5z9j2sCBeDtuFm4aZxGgGAkkhHbOMrMBotcPjnUItPkbLkWOAhmHEACgjQBk4TcoxN/7+tBvEm6ID/c4Ufn1SK0UZbFRQRhMZwEDgivzN11qilRcfG0aQ7aPz4/9BuGGINuBZ8R5LlcilIIpvpPM+gIJ+pstjKTAETOXC1BT4PtQEzJ5/el+RBdhGAQrVQzVCiu2gmJaIAJBpZAoYop4rZ2glyvDZA/ABiaa1+UYR6aqAmpfV3ug09IIXvvEo/UhW5TQ+OhiaUmJoYy63MCkWau4Gy71b0fFSJRFwRg1Mw9FoeUliclI1DyHTDM4nOg4mUVG86uONs+ltosm535SV7yrPaTb386VreEfvd3LrimejwdS6X9LJ9ej5WS8lVr8AIiG+ZevuqaWT3+xc82wdDbGGYGBGvhYq2twvfr2MqG0+2nI6j6A0TNpfIxoCWfXvd2zxHyAiSiNf+swmctS6mqNxcl5cpKAqXc3qcHw7GyMI10WfWSum7mpg6+/f/nuOKRRF6AprV/FkF0IHnt2bJXJRQGVIoiEru+4zGZUe58aDMZE50gCnYDiYGDrwzO9++s43XbgLmKVh16CNQxVCoHSmh0XoJrB9W8hJnaWB3cesHz3U3ry7TFpKiUFjyocAFqHa1REmVev59I1DJtNOL9jF3PVXPnT/l4zrtH1JG1BndDXCToS8rxUruRyeX5s4InHmZFyKrFmC4BSo8qlBzZOIULu1cXPhSJk+U6go3J3cKdC5K5zLGMfXitLjxy8A1E7gnoNJlHKwPS9MvQ9tstpPYmnvCSk7DnTwdBBCnEiW5LurXv4stPebi6anXFar8GEpYZ3lJISCQEgiqDoi27HrzlB7xvVLXf1n+HV2/PQMGv25x/q9HCbe5Q6eESAOlpVxUTiqkQpjAVCxIpCQVD2iiT2akkbanVjNwrO314xYi/oW616K7nL0SYnhVbnhNyOFE23xhNF0/j6b3+nVStTe+/h6oPeyY9fZB6p3iYhAmxu5lKK6GoLJ1JRpivKwuFN3t5teZtuEiGQXH77Oq2MoSqF5Gv6idNuiAjWy9orStD4yXLam6b7nFbMQlURcX/2+PRom1NjflOqFIOn6d5ZAu6KdWQxERYFCzUCWK0wRfF9v9jp+HoWCrocLNwpaTMwGR2e6HYPX2Y+zzigyGejf5/kwWXXoc/WQdBEKBYhMxRnHlEyn6PF8H6KbQYo+tMgXCOTy+GbXivjvt4vqfy/0SyfI+9ypypkxCyxcFFYO2bQi2WuLIblqK8CABZM+sLiZW0yLSxGpz9BwdgvKZGLUqHmcPqACBYmerRYoOE6EGKcQm2G+cM7od2gM4mEWGhTaXDVL5s6rbs1rIpBVUGoeS4RPFgDprk+JmmdX/8XlgBWUDggqgAAADAJAJ0BKqsAPgA+jUKYR6UkoqEyPCgAoBGJaQYoAAB+hF9imtePqLcvkRX/1+t/mGFlKywH5Ryuq7xTeITMBPFoEMPAJnncr1XII79X0C0DjAAA/vkz4X/wmAALn9ZQYnPi8LvACradlHG8SyrAs4ERZqrA9vqmYx4zOBfghOS1wz7cM8AG4Eaaxf2a3CTL2DWDZdByY/9lbeFs0w0AChhyW/81AkAAAAAA">
                </div>
                <div class="image" style="left:819.0px;top:1376.4px;"><img width="148" height="37"
                        src="data:image/webp;base64,UklGRvIAAABXRUJQVlA4WAoAAAAQAAAA9QAAPQAAQUxQSHYAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDayybXvx/w0GEqwAMsxTFXYBlwQzgwargUsBFVwq6PHvMyL6r8ht20bK6rr2EUBmf//RHMgPBNeGFKTtJLi1RUG2HII7exQ01yO4e0xBd7+CeyZSF6m3pX4m93/y2SAAVlA4IFYAAADQBwCdASr2AD4APpE8m0glo6KhLgg4sBIJaW7hcdAIWqV0hGvjVK6QjXxqldIRr40a9w70zIFQ1RVSuACay4eP1XuFX207gAD+/tIC9ETGf/18IAAAAA==">
                </div>
                <div class="image" style="left:60.4px;top:1398.3px;"><img width="33" height="37"
                        src="data:image/webp;base64,UklGRjgBAABXRUJQVlA4WAoAAAAQAAAANgAAPQAAQUxQSNAAAAABcKpt25rM0UnFJm1IGpVzWMbSEl65iO4O/zhgZt+PQ4gIRW7bNlK6xynII4gfkyTNsA4ZmoSD4hU951CXYyRYk4xyq+OwYco01ClvWJPD0eGmobNA0Ep5crk6PXZyULB663DFQq5zfJY80BVGqy9sN3oFDipfEuYQuXDul0QSR4fmVYUG3bbR7dVDS2chn9m7+c52XAQFzQdz5OD+O3zbLl4mZYXGwGVmGTwJ9VFjc3R4mFhFiYLKTtlsdBy2ygZYI8iY7FYvFZ7CVp3/zSQAVlA4IEIAAADwBACdASo3AD4APpE8mUglo6KhLggAsBIJaQAW30NTtMrQ5t8KI/IA8r02DPMs1gAA/vjPVL//8aQKbkeRAqAAAAA=">
                </div>
                <div class="image" style="left:68.9px;top:1397.9px;"><img width="260" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:304.0px;top:1398.3px;"><img width="664" height="37"
                        src="data:image/webp;base64,UklGRo4BAABXRUJQVlA4WAoAAAAQAAAATgQAPQAAQUxQSIQAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21bykQAsorCIQAEPwIy5M3ZIwiICDSyBRaDHm357Ef1X2LZtI2V1PdATCPov+g/6D8IG+o9hObRA2wTi5gMtsIwUGPGy0QLXRIWR7i8t8Kp1GM390wK/WacnhZ5s05NndOjfBv2XawL9hwBWUDgg5AAAALAYAJ0BKk8EPgA+kTqYR6WjoqEvqACwEglpbuF2sRtDt0PK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrfK2t8ra3ytrVzqmRlo4NKxpQ1xlo4NKxpQ1xlo4NKxpQ1xlo4NKxpQ1xlo4NKxpQ1xlo4NKxpPjWdGPiKZ+9M03u6GIa4y0cGlY0oa4y0cGlY0oa4y0cGlY0oa4y0cGlY0oa4y0cGlYxwgAP7/vBdSAJlgAGF/1EFQkAAAAAAAAA==">
                </div>
                <div class="image" style="left:60.4px;top:1419.9px;"><img width="117" height="37"
                        src="data:image/webp;base64,UklGRiYEAABXRUJQVlA4WAoAAAAQAAAAwgAAPQAAQUxQSIYDAAABkD79n9JGJYS6u4bzI2nP3eWVu2bqXo4ydIZ6e26pJB22dMvfC/v7LSy5u3d3EQFBkty4zSISKjoHpAiCfkLJv8JNkpNKUpaic/3ZtqqUltFSVVJoJWpUn0utSYjoAI4Fzc2jKuIOUA4+00392UEl7HOVujNZwzSyZ2okAR3AMaY7UCpAUpy+7ppdIAX7Wp0U8rmHevu/O8T5nlXlaJJTT3WTZ/rTlIxSAZKilKz256hHc/2qzN3qz2YNU391z3I8z3MMTYn4DWl6nvAsr2sKSgVIilKlvbNM08z2lnK3c+M/HJK3XtrEFzEzUZUxiYcaQMWoIHxx/n992fXlLl+vk9BsUNp4fuLXnueRhbcLrHorkjA9JOQkJ1uElnWyEqBV9JoEkIQA50QQT7pRDg3kqC+aGzikgHEXWN/NyWDz3I/TH91Ac5ePaiA9HOw4qPGyBV/7dN9HXrl3EqAdvTxHPJYEAQ9jmlpfr8J0I/ZqpnODbvYvZsddYNbyZrB5tPCjQIOo1/uHWSLTGHw6aPCyBRhluy71MFi6vWIB0uH+ddfzGBIEPIwZ/bdu9Rsg3Yj3wJXWng3GnW9BKyAdybbG902WiDibXzcdXrYAuc5a2WZo3Y9TKwWXUncXkn4vMEA+CQIexpzcykrOAelGuIeu6WD2x57HN+QtKAI3W4AZ5+S9FZdBsR++Mfxm5EJzMMIZdV0KQxHuoUufYbKiJyJMrkD+qTxpEUbWxSN9QTPGYlBiPQa8+PARJ1zksKA44cNB2gyaMdJ3FAEJKg7PDPK1tW2KC94WhzKKkjHDan8ntxPqDw50eFio5w4BXsOA+ajIRHOrSH+F6KeRiTnbtq2XalKojzzKiP3aJr/Pzl1/++TFq1evnl9vlQUp0Xh9gTBfzdYeolh2Vl8pLJL6LAJRfMVwmObXbFvoTqo5O7lJgyYfNDYpItGHYUmEFUkQpSyQWIPzldDDsspOPmTu+l20g8XfxhbXWLENUSp8Ff+DFM1wWM7TGvpG4fMRqP+RSBCUquJWmMmj5fqyK3rW4AeKRIKg/CbS9Dz44Kt733PWSdz6KTJSXkd2eh5BqQzWXrGY4MOppzqocMu4q1VuFRsNCa9nZQYfjyUe41bIYn4o0FJVMvc3A+5aIhoSvqqQGHw8lnhM7DpFkpNgtcf/5Ya7oouMlJQlPBI8lngMrBb/Bvbff4VSCVZQOCB6AAAA0AcAnQEqwwA+AD6NPJlHv6OioTCIA/ARiWkAAHX74zMfo8XhfU9vpHqDKmGapgNTCjdEo8woVrRPFDYGKRIEQUbR01TDM6AA/vkz4X/poAJP/0AAAHH+XdLh+pFTA8X/gMetqo6nrBLa7H//RFqibf//HwAAAAAAAAA=">
                </div>
                <div class="image" style="left:153.0px;top:1420.3px;"><img width="123" height="37"
                        src="data:image/webp;base64,UklGRvIDAABXRUJQVlA4WAoAAAAQAAAAywAAPQAAQUxQSCwDAAABkC0BYNo2NRY93qtdri9UfBozMwfG6Dq+chuPoeBCfGdFVfS/Fti5an3bIsKBJElts1tGwYgarshPaPsnuSVF1VRFSgHUKmxR48WpsaToBy07Y5vdEl+yEQNZhpyyIiqNLeCv27QzRI1ZINlTZddz7poKn9EYL7qeWxw3pHQV6TtJYYsnxbzreESNWSDTtSACdcfW+IxWcTUC0Wqxr51ovAnbsGLeW6CwxZOena4DUJ/O6pQ026lDhDHwMnxpththjKPq1GDceA3DZLdhFndIYYv3fPBUDWIMa6cOSpQyHsCYKw4SWLj5xPGcu4ND9xyiDSeBE1RafyVAGKOg0q+R33QVZkjNFLo0jtXODJHA7x/8ENSrJy4shKDu5mg8VZFIblriXU8ukRFbOhlfZMPKX/NhLOhfK2Q4tgdHX201MUbhWogw/Prc3UJsPNsyNJKbkqDX+FK2lDb50ESx6u+QJDv+jMexW7n5YjVmaiLi09XtXQ6eW5yypghuSoJeiYEkq0vGxNu1CCKSBMEG4DgKvnwPm5gw+SkPL1r7+OAjwS2mFKtMXsnMen95bRenMYIQ4VTe3f69HXMLKj1bjej4BJXB43HrSG92kgyFKSFLxpjMfHasEqCWhY0qPjEcJRFzMy5vbs5GVAtuSdjg94/fIasD8OBIiZibcfnyIQ5KM/z+tY5aETaw9JTTEzhwpES8csOFVl+XvsI0YUuvxnJpuUFKxCuCDYhYzbi5PfP6O+REhCPOQ6pkptApiVfy7lZt1t9B7BF9lducORDJs3B5oH+lf0/vnBKuttHWhzPj13yYbpTkhC1pQQmw0c7SfVMRSBkPYAxrZ4725KtRqtmLB9E6o9CxNdEEZnK6Siw79pqFyczc7AFi3ykdPLkQgtjE6MNaBiYyEw9BdknUjMhLhNyVa333HC/2TC2I6AVsbcZLZBZeFPg+qyQAaAKae+GeqYh4WkIixM6dKrvUxqF8KpdJZBaeWz57llWS59EENPfJvm5JwFMsCiF2fIpFb+gO6lois/Bs69AhVkmZDE3A4Falv8DpImOjnRKPfQBEwtIELO59xf/9136lNlZQOCCgAAAAEAoAnQEqzAA+AD6RRJ5JpaQjISzwyECwEglpL73BKZwiyAV6Na21T93bMxrXn2qLMPtFyN0dmvOJbzzhvGY+KKbRijcYjznaYXs2kPq21XNMM2n/GbPNjAAA/v9tQmv/2BuP/0Bdy/r5q/z//8sEP//LQC+/VxkKn3gPICwBECcSGvhrA8QRAF0gp///lW3gJLThO0RRX9mFDxAegAAAAA==">
                </div>
                <div class="image" style="left:251.8px;top:1421.4px;"><img width="40" height="35"
                        src="data:image/webp;base64,UklGRmQBAABXRUJQVlA4WAoAAAAQAAAAQQAAOgAAQUxQSOUAAAABcCNtm5pkx3Dvg1TOBaylJHUOgLtzA7fIzp447PyDQxERitw2UppZhtPAH5TfCggTKgHBCHBGQ/F0VoJ0PEQRVPMlS3qnL0FHLyV9QIZVbbq5GhJcN1NNxTBiue6JCyn4qZ2mMOtQZWUJwS3TcMS0uBBGPwsjHNc3XNi71bDvyHB94HCi6e5V8F2jWsg6UqzNT8YRakGzfUNYq2qMUUc8Ka3db9dVDCdjmGc3XUtNZ9OqDwGqn6Uy4UEwUoAlx8vQPVy5h4/uwZPvIJruIaLvIqvcQ2a7h+x6Dxn+DqrMHVS6P18UAFZQOCBYAAAAMAQAnQEqQgA7AD6RPppIJaOioS5oALASCWkAAGd3GRU8WgOUb2+SuAa4AP74z4Tf//xbTP2uBqsYVFjNGX/CikGXwom8TgHYIB5HAN///iqyVMTOEAAAAA==">
                </div>
                <div class="image" style="left:267.6px;top:1420.3px;"><img width="215" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:474.9px;top:1420.3px;"><img width="215" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:681.7px;top:1420.3px;"><img width="31" height="37"
                        src="data:image/webp;base64,UklGRl4AAABXRUJQVlA4WAoAAAAQAAAAMwAAPQAAQUxQSAkAAAABBxAREYiI/gcAVlA4IC4AAACQAwCdASo0AD4APpFIoEwlpCMiIggAsBIJaQAAEDdTUAV4hbkAAP74zvV4AAAA">
                </div>
                <div class="image" style="left:60.4px;top:1441.8px;"><img width="88" height="37"
                        src="data:image/webp;base64,UklGRkACAABXRUJQVlA4WAoAAAAQAAAAkgAAPQAAQUxQSMkBAAABkDz9n5o15N0Ed9dkuO3gcHK4vjfc4eSZTAZ393qbZdnk74XsL/Lbtrc2Ihy4jaRIyeJh9WLvF3L+CaVGdANSJxpqAVJy/LHIpG2Q1CrJYBdAzSL0gZjjtgvpLPaVZ5ALsMdNgo1B7e8M0nta6yvRcAv4blMDnTaXBaBvT4sWwS2AuW3KEXgOzSW6kUCdaMCZqJMMELGwayfMTldhOGdUNp1oeDC3s8qibQmkVnm5nIu2NrTKEbuyZ/wDfpbtCucEs0mnGx67Q/2LjptAZ3lsbNmRMqyOr8oRd86+iQ/Et7OdcE4wm3S6ocEvV+0njyXQ+3R29smTMny5/yJHfOXvY2jgr+GcYDbpdEND/Hj8+hYkUnAu5Ay+8IP4RmZjbhsCcHnKiUK0fwkEf385SSaEl5UYv53tnX2LO/g/ro8ODg52pi3994KfZfuyZzzuZnramp+ZmZkcriVpkduxowRsp6u8a4cpMtHKhk+5IudMUZvLFHmZWMufhEIo8jWDOl7wxwEqwBc+PsnvGil2jvB9Es3vNi0Ee1Dkeysxx224m0DTHjfzwE4duQPRisyIngtNahYR8HkGu0+L7EzR1IkGP/XF72b/z2IOAFZQOCBQAAAAkAUAnQEqkwA+AD6RPJlIJaOioS2IALASCWkAAGgDNucnmAYyC6d/KOKTtQHae2xm3OTzMYAA/vjPeMaGD/3ZJ2q3gPZOBDb//8VEAAAAAAA=">
                </div>
                <div class="image" style="left:124.1px;top:1442.2px;"><img width="841" height="37"
                        src="data:image/webp;base64,UklGRrwBAABXRUJQVlA4WAoAAAAQAAAAcwUAPQAAQUxQSIQAAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21byaeAJLAAZdEoFL8AigWaggTVgUYAKLCrQ40/1RvRfYdu2DTO6H+gJBP4H/Af/wX/wH7sB/+lhxDbD1Sjk/cI2o3UoFNvFNmMNKHTPxzbjTCkM7882485YbmO52yz3GZP+R4b/gSfBfwRWUDggEgEAAFAeAJ0BKnQFPgA+kTqYR6WjoqEviACwEglpbuF2sRtDrkCPjA7a8sjAsIlnklNKr4B215ZGBYRLPJKaVXwDtryyMCwiWeSU0qvgHbXlkYFhEs8kppVfAO2vLIwLCJZ5JTSq+AdteWRgWESzySmlV8A7a8sjAsIlnklNKr4B215ZFaB3O5wp/PYWPN7udzhT+ewseb3c7nCn89hY83u53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5r1oZ7j8Jp/PYWPN7udzhT+ewseb3c7nCn89hY83u53OFP57Cx5vdzucKfz2Fjze7nc4U/nsLHm93O5wp/PYRsmAAP7/vBdSAAp1AAC7/+vhAAAAAAAAAAA=">
                </div>
                <div class="image" style="left:943.7px;top:1464.7px;"><img width="24" height="33"
                        src="data:image/webp;base64,UklGRlwAAABXRUJQVlA4WAoAAAAQAAAAKAAANwAAQUxQSAkAAAABBxAREYiI/gcAVlA4ICwAAABQAwCdASopADgAPpFIoEwlpCMiIqgAsBIJaQAAE/GOHwhFgAD++M79KAAAAA==">
                </div>
                <div class="image" style="left:641.1px;top:1484.0px;"><img width="327" height="37"
                        src="data:image/webp;base64,UklGRioBAABXRUJQVlA4WAoAAAAQAAAAHwIAPQAAQUxQSH0AAAABd6A0kiQ1eEz23KnHiAhAQrQu+iNLDYxq21aCBWARhUUECngAZsydsUMSFhFoYAksAjn+zP8nov+K3LZtpKyue98g/f7LkfD7j27aENcyQHCyHuIWoQxANK8Qd4kVAJLtgbhnpQFQXx/EfScNPQp6bKPHMwT695ADf/+RAABWUDgghgAAAJANAJ0BKiACPgA+kTqaR6WjoqEviCCwEglpbuFzQRtDrrpjLHWMsdYyx1jLHWMsdYyx1jLHWMsdYyx1jLHWMsdYyx1jLG4gnc4U/nsLHm93O5wp/PYWPN7udzhPNtJSdzhT+ewseb3c7nCn89hY83u53JT2gAD+/xoDsKhQMn/xfQY5wAAA">
                </div>
                <div class="image" style="left:640.5px;top:1505.7px;"><img width="328" height="37"
                        src="data:image/webp;base64,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">
                </div>
                <div class="image" style="left:63.0px;top:1529.0px;"><img width="24" height="16"
                        src="data:image/webp;base64,UklGRlgAAABXRUJQVlA4WAoAAAAQAAAAKAAAGgAAQUxQSAkAAAABBxAREYiI/gcAVlA4ICgAAADwAgCdASopABsAPpFGnkslo6KhpWgAsBIJaQAAKUNt8AD++M79KAAA">
                </div>
                <div class="image" style="left:35.1px;top:1240.3px;"><img width="52" height="33"
                        src="data:image/webp;base64,UklGRv4CAABXRUJQVlA4WAoAAAAQAAAAXwAAPAAAQUxQSOUBAAABgBqBbh3JlYSLq4JD4eJbxM7yo9eKuIswN08rb+b8k2zN4ohwIElq3AAVKGV1y4D0hLRmYkpxmZhFiwpH/evWgsa1FJWABkkG8GDgeMatAKq+e3qacceytVlCiVgAvLUCOZQIkIVmjZDkJqF0leVG/YtSJK2ULCKhtGWyNY7igsLGsyZhqP1YVRgCyLqcgYi/OZFGpyQA7E3FUfk+0hDxnD2LcOcm2zW1MDhhAJ9rp5BkrybRUjFlaeHWK5OhkWjFv/bhpyV1S6S9tR8fMw+DzvcufNUV3jHaIeqXftDP+xDeu5WYcL9Nx/DO/VytyUb8TvhqYciIr2Uj3r32v5cJbyo51HQtasTPSw7CS1eSWAAH/ix8dpblVT344z31X2Bx4o/3meUFtE2Kh5/yJAwEKLQc1L6zMQwYmznuPK4PsPymw+CFaZhshtUnxfF7Apz+AEnUN27qyNzTgbjz/FlWtYt5gLWnA3FTb/PeOXxspLgvWmw9bc1bXhVVvCfQ0NPevIu0V84CzPlzefPGIxczakbnSpz+Suqhi5nLFZq2IPi9o0oKToW/P5nvrd/z3h39Whb93SNJjf5uwwDy1C/Ge3didDwaJOHezWiIUKuoFi2LwyIqn0xvN4TCwYrI/DMyp2/JCQBWUDgg8gAAAJAHAJ0BKmAAPQA+kUacSaWkIyEpW2jwsBIJaQATk053PO0LfWYIUWmqWoG1zH53b0iQixCtOSb6h8lWsuTfSTtFnPJ2kAD+/EPSUQCzm7LxfP6+3UL//XIih1B8P9P6AhMh8dXvhqP/md46+JG+4bzNv0l2chs/XJZFP8jOJYYvU1ChXxZM9JxEgyay6YCtSRsClvLcD/3mxehCp3JVWdEfgFoSFYSoVlyW4/OqlNuvXN1t+5i4T2P8AF+TXBWqluyabS9YE8UIAsly747eAaCRJ1Enk4BetMs6CHGfmo6+YiV0vJdqMxPhmrr7P4JAAAAA">
                </div>
                <div class="vector" style="left:58.0px;top:141.0px;"><img width="911" height="1410"
                        src="data:image/webp;base64,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">
                </div>
            </div>
            <!-- page 2 end -->
        </div>
    </body>
</html>
