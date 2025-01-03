<script> 
    $(".td1").inputmask("mm/dd/yyyy");  
    $(".td2").inputmask("mm/dd/yyyy");  
    $(".td3").inputmask("mm/dd/yyyy");  
    $(".td4").inputmask("mm/dd/yyyy");  
    $(".td5").inputmask("mm/dd/yyyy");  

    $(".date_of_lab").inputmask("mm/dd/yyyy");  
     
    //  $('.new_trimester').change(function() 
    // {
    //     alert($('.code').val())
    //     $.ajax({
    //         url: "{{ url('doctor/patient/info/') }}/",
    //         type: "POST",
    //         success: function(data){

            
    //         },
    //         error: function(){
    //             $('#serverModal').modal();
    //         }
    //     });
    // });

    $('.add_lmp_date').change(function() {
        var date = $(this).val();
        var newdate = new Date(date);

        var cur_mon = newdate.getMonth() + 1;

        if(cur_mon == 1 || cur_mon == 2 || cur_mon == 3) {
            newdate.setDate(newdate.getDate() + 7);
            newdate.setMonth(newdate.getMonth() + 9)
            newdate.setFullYear(newdate.getFullYear())
        } else {
            newdate.setDate(newdate.getDate() + 7);
            newdate.setMonth(newdate.getMonth() -3)
            newdate.setFullYear(newdate.getFullYear() + 1)
        }

        var now = new Date(newdate);
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var edc_edd = (month) + "/" + (day) + "/" + now.getFullYear();

        $('.edc_edd').val(edc_edd);

        var start = new Date($(this).val()),
        end   = new Date($('.add_date_of_visit').val()),
        diff  = new Date(end - start),
        days  = diff/1000/60/60/24;
        weeks = days / 7;

        n = weeks.toFixed(3);
        whole = Math.floor(n); // 1
        fraction = n - whole; // .25

        var gcd = function(a, b) {
            if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
            return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
        };

        var fraction = fraction.toFixed(7);
        var len = fraction.toString().length - 8;

        var denominator = Math.pow(7, len);
        var numerator = fraction * denominator;

        $('.new_aog').val(whole + ' ' + Math.floor(numerator.toFixed()) + '/' + Math.floor(denominator.toFixed()));
        $('.new_aog').change();

        if( whole <= '12' ) {
            $(".new_trimester").val('1st');
        } else if( whole <= '28' ) {
            $(".new_trimester").val('2nd');
        } else if( whole <= '40' ) {
            $(".new_trimester").val('3rd');
        } else {
            $(".new_trimester").val('3rd');
        }
    });

    $('.lmp_date_return').change(function() {
        var date = $(this).val();
        var newdate = new Date(date);

        var cur_mon = newdate.getMonth()+1;

        if(cur_mon == 1 || cur_mon == 2 || cur_mon == 3) {
            newdate.setDate(newdate.getDate() + 7);
            newdate.setMonth(newdate.getMonth() + 9)
            newdate.setFullYear(newdate.getFullYear())
        } else {
            newdate.setDate(newdate.getDate() + 7);
            newdate.setMonth(newdate.getMonth() -3)
            newdate.setFullYear(newdate.getFullYear() + 1)
        }

        var now = new Date(newdate);
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var edc_edd = (month)+"/"+(day)+"/"+now.getFullYear() ;

        $('.edc_edd').val(edc_edd);

        var start = new Date($(this).val() ),
        end   = new Date($('.return_date_of_visit').val()),
        diff  = new Date(end - start),
        days  = diff/1000/60/60/24;
        weeks = days / 7;

        n = weeks.toFixed(3);
        whole = Math.floor(n); // 1
        fraction = n - whole; // .25

        var gcd = function(a, b) {
            if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
            return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
        };

        var fraction = fraction.toFixed(1);
        var len = fraction.toString().length - 2;

        var denominator = Math.pow(7, len);
        var numerator = fraction * denominator;

        var divisor = gcd(numerator, denominator); // Should be 5

        $('.new_aog').val(whole + ' ' + Math.floor(numerator.toFixed()) + '/' + Math.floor(denominator.toFixed()));
        $('.new_aog').change();

        if( whole <= '12' ) {
            $(".new_trimester").val('1st');
        } else if( whole <= '28' ) {
            $(".new_trimester").val('2nd');
        } else if( whole <= '40' ) {
            $(".new_trimester").val('3rd');
        } else {
            $(".new_trimester").val('3rd');
        }
    });

    $('.new_refer_lmp_date').change(function() {
        var date = $(this).val();
        var newdate = new Date(date);

        var cur_mon = newdate.getMonth()+1;

        if(cur_mon == 1 || cur_mon == 2 || cur_mon == 3) {
            newdate.setDate(newdate.getDate() + 7);
            newdate.setMonth(newdate.getMonth() + 9)
            newdate.setFullYear(newdate.getFullYear())
        } else {
            newdate.setDate(newdate.getDate() + 7);
            newdate.setMonth(newdate.getMonth() -3)
            newdate.setFullYear(newdate.getFullYear() + 1)
        }

        var now = new Date(newdate);
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var edc_edd = (month) + "/" + (day) + "/" + now.getFullYear() ;

        $('.edc_edd').val(edc_edd);

        var start = new Date($(this).val()),
        end   = new Date($('.new_refer_date_of_visit').val()),
        diff  = new Date(end - start),
        days  = diff/1000/60/60/24;
        weeks = days / 7;

        n = weeks.toFixed(3);
        whole = Math.floor(n); // 1
        fraction = n - whole; // .25

        var gcd = function(a, b) {
            if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
            return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
        };

        var fraction = fraction.toFixed(1);
        var len = fraction.toString().length - 2;

        var denominator = Math.pow(7, len);
        var numerator = fraction * denominator;

        $('.new_aog').val(whole + ' ' + Math.floor(numerator.toFixed()) + '/' + Math.floor(denominator.toFixed()));
        $('.new_aog').change();

        if( whole <= '12' ) {
            $(".new_trimester").val('1st');
        } else if( whole <= '28' ) {
            $(".new_trimester").val('2nd');
        } else if( whole <= '40' ) {
            $(".new_trimester").val('3rd');
        } else {
            $(".new_trimester").val('3rd');
        }
    });

    $('.new_date_of_visit').change(function() {
        var start = new Date($('.lmp_date').val()),
        end   = new Date($(this).val()),
        diff  = new Date(end - start),
        days  = diff/1000/60/60/24;
        weeks = days / 7;

        n = weeks.toFixed(1);
        whole = Math.floor(n);      // 1
        fraction = n - whole; // .25

        if(weeks.toFixed(1) > 1) {
            var gcd = function(a, b) {
                if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
            };

            var fraction = fraction.toFixed(1);
            var len = fraction.toString().length - 2;

            var denominator = Math.pow(10, len);
            var numerator = fraction * denominator;

            var divisor = gcd(numerator, denominator);    // Should be 5

            numerator /= divisor;                         // Should be 687
            denominator /= divisor;                       // Should be 2000

            $('.new_aog').val(whole + ' ' + Math.floor(numerator) + '/' + Math.floor(denominator) + " " + "weeks");
            $('.new_aog').change();
        } else {
            var gcd = function(a, b) {
                if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
            };

            var fraction = fraction.toFixed(1);
            var len = fraction.toString().length - 2;

            var denominator = Math.pow(10, len);
            var numerator = fraction * denominator;

            var divisor = gcd(numerator, denominator);    // Should be 5

            numerator /= divisor;                         // Should be 687
            denominator /= divisor;                       // Should be 2000

            $('.new_aog').val(whole + ' ' + Math.floor(numerator) + '/' + Math.floor(denominator) + " " + "week");
            $('.new_aog').change();
        }
    });

    function dateRange(startDate, endDate) {
        var start      = startDate.split('-');
        var end        = endDate.split('-');
        var startYear  = parseInt(start[0]);
        var endYear    = parseInt(end[0]);
        var dates      = [];

        for(var i = startYear; i <= endYear; i++) {
            var endMonth = i != endYear ? 11 : parseInt(end[1]) - 1;
            var startMon = i === startYear ? parseInt(start[1])-1 : 0;
            for(var j = startMon; j <= endMonth; j = j > 12 ? j % 12 || 11 : j+1) {
                var month = j+1;
                // var displayMonth = month < 10 ? '0'+month : month;
                // dates.push([i, displayMonth, '01'].join('-'));
                var displayMonth = month < 10 ? month : month;
                dates.push(displayMonth);
            }
        }

        return dates;
    }

    $('input.vaginal_spotting').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Vaginal spotting or bleeding" );
            } else {
                $(".sign_assessment_diagnosis").val("Vaginal spotting or bleeding");
            }
        }
        
        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Vaginal spotting or bleeding, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Vaginal spotting or bleeding',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Vaginal spotting or bleeding',  '' ) );
        }
    });

    $('input.severe_nausea').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Severe nausea and vomiting" );
            } else {
                $(".sign_assessment_diagnosis").val("Severe nausea and vomiting");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Severe nausea and vomiting, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Severe nausea and vomiting',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Severe nausea and vomiting',  '' ) );
        }
    });

    $('input.significant_decline').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Significant decline fetal movement (less than 10 in 12 hrs during 2 ½ of pregnancy)" );
            } else {
                $(".sign_assessment_diagnosis").val("Significant decline fetal movement (less than 10 in 12 hrs during 2 ½ of pregnancy)");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Significant decline fetal movement (less than 10 in 12 hrs during 2 ½ of pregnancy), ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Significant decline fetal movement (less than 10 in 12 hrs during 2 ½ of pregnancy)',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Significant decline fetal movement (less than 10 in 12 hrs during 2 ½ of pregnancy)',  '' ) );
        }
    });

    $('input.persistent_contractions').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Persistent contractions" );
            } else {
                $(".sign_assessment_diagnosis").val("Persistent contractions");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Persistent contractions, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Persistent contractions',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Persistent contractions',  '' ) );
        }
    });

    $('input.premature_rupture').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Premature rupture of the bag of membrane" );
            } else {
                $(".sign_assessment_diagnosis").val("Premature rupture of the bag of membrane");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Premature rupture of the bag of membrane, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Premature rupture of the bag of membrane',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Premature rupture of the bag of membrane',  '' ) );
        }
    });

    $('input.fetal_pregnancy').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Multi fetal pregnancy" );
            } else {
                $(".sign_assessment_diagnosis").val("Multi fetal pregnancy");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Multi fetal pregnancy, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Multi fetal pregnancy',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Multi fetal pregnancy',  '' ) );
        }
    });

    $('input.severe_headache').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Persistent severe headache, dizziness, or blurring of vision" );
            } else {
                $(".sign_assessment_diagnosis").val("Persistent severe headache, dizziness, or blurring of vision");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Persistent severe headache, dizziness, or blurring of vision, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Persistent severe headache, dizziness, or blurring of vision',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Persistent severe headache, dizziness, or blurring of vision',  '' ) );
        }
    });

    $('input.abdominal_pain').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Abdominal pain or epigastric pain" );
            } else {
                $(".sign_assessment_diagnosis").val("Abdominal pain or epigastric pain");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Abdominal pain or epigastric pain, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Abdominal pain or epigastric pain',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Abdominal pain or epigastric pain',  '' ) );
        }
    });

    $('input.edema_hands').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Edema of the hands, feet or face" );
            } else {
                $(".sign_assessment_diagnosis").val("Edema of the hands, feet or face");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Edema of the hands, feet or face, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Edema of the hands, feet or face',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Edema of the hands, feet or face',  '' ) );
        }
    });

    $('input.fever_pallor').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Fever or pallor" );
            } else {
                $(".sign_assessment_diagnosis").val("Fever or pallor");
            }
        }
        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Fever or pallor, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Fever or pallor',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Fever or pallor',  '' ) );
        }
    });

    $('input.seizure_consciousness').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Seizure or loss of consciousness" );
            } else {
                $(".sign_assessment_diagnosis").val("Seizure or loss of consciousness");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Seizure or loss of consciousness, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Seizure or loss of consciousness',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Seizure or loss of consciousness',  '' ) );
        }
    });

    $('input.difficulty_breathing').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Difficulty of breathing" );
            } else {
                $(".sign_assessment_diagnosis").val("Difficulty of breathing");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Difficulty of breathing, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Difficulty of breathing',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Difficulty of breathing',  '' ) );
        }
    });

    $('input.painful_urination').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Painful urination" );
            } else {
                $(".sign_assessment_diagnosis").val("Painful urination");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Painful urination, ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Painful urination',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Painful urination',  '' ) );
        }
    });

    $('input.elevated_bp').click(function() {
        if($(this).prop('checked') == true) {
            if($(".sign_assessment_diagnosis").val().length > 0) {
                $(".sign_assessment_diagnosis").val( $(".sign_assessment_diagnosis").val() + ", Elevated blood pressure (>120/90)" );
            } else {
                $(".sign_assessment_diagnosis").val("Elevated blood pressure (>120/90)");
            }
        }

        if($(this).prop('checked') == false) {
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Elevated blood pressure (>120/90), ',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( ', Elevated blood pressure (>120/90)',  '' ) );
            $( '.sign_assessment_diagnosis' ).val( $('.sign_assessment_diagnosis').val().replace( 'Elevated blood pressure (>120/90)',  '' ) );
        }
    });

    $( ".new_visit_no" ).on( "change", function() {
        if( this.value== '1st' ) {
            $(".bp_personnal").keyup(function() {
                $(".bp_antepartum").val(this.value);
            });

            $(".temp_personnal").keyup(function() {
                $(".temp_antepartum").val(this.value);
            });

            $(".hr_personnal").keyup(function() {
                $(".hr_antepartum").val(this.value);
            });

            $(".rr_personnal").keyup(function() {
                $(".rr_antepartum").val(this.value);
            });

            $(".fh_personnal").keyup(function() {
                $(".fh_antepartum").val(this.value);
            });

            //3rd tab
            $(".bp_personnal").keyup(function() {
                $(".bp_signsymptoms").val(this.value);
            });

            $(".temp_personnal").keyup(function() {
                $(".temp_signsymptoms").val(this.value);
            });

            $(".hr_personnal").keyup(function() {
                $(".hr_signsymptoms").val(this.value);
            });

            $(".rr_personnal").keyup(function() {
                $(".rr_signsymptoms").val(this.value);
            });

            $(".fh_personnal").keyup(function() {
                $(".fh_signsymptoms").val(this.value);
            });
        } else {
            $(".bp_personnal").unbind("keyup");
            $(".temp_personnal").unbind("keyup");
            $(".hr_personnal").unbind("keyup");
            $(".rr_personnal").unbind("keyup");
            $(".fh_personnal").unbind("keyup");
        }
    });

    $( "#new_refer_weigth" ).on( "keyup", function() {
        var hg = $(".height").val();
        var wg = this.value;
        var hgres = hg * hg;
        var result = wg / hgres;
        
        $("#new_refer_bmi").val(result.toFixed(1));

    });

    $( "#add_refer_weigth" ).on( "keyup", function() {
        var hg = $("#add_refer_height").val();
        var wg = this.value;
        var hgres = hg * hg;
        var result = wg / hgres;
        
        $("#add_new_bmi").val(result.toFixed(1));
    });
</script>