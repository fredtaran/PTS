@extends('layouts.app')

@section('content')

    <div class="box box-success">
        <div class="box-body no-padding">
            <div class="box-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
        </div>

    </div>

@endsection
@section('css')


@endsection

@section('js')

    <script>
        window.onload = function () {

            var options = {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light2",
                title:{
                    text: "Consolidated Incoming Report"
                },
                axisX:{
                    valueFormatString: "MMM"
                },
                axisY: {
                    title: "Number of Incoming",
                    suffix: "",
                    minimum: 0
                },
                toolTip:{
                    shared:true
                },
                legend:{
                    fontSize: 13
                },
                data: [
                    {
                    type: "line",
                    showInLegend: true,
                    name: "Vicente Sotto Memorial Medical Center",
                    xValueFormatString: "MMM, YYYY",
                    yValueFormatString: "#,##0",
                    dataPoints: [
                        { label: "January", y: 60 },
                        { label: "February", y: 61 },
                        { label: "March", y: 62 },
                        { label: "April", y: 63 },
                        { label: "May", y: 64 },
                        { label: "June", y: 65 },
                        { label: "July", y: 66 },
                        { label: "August", y: 67 },
                        { label: "September", y: 68 },
                        { label: "October", y: 69 },
                        { label: "November", y: 70 },
                        { label: "December", y: 71 }
                    ]
                },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Eversley Childs Sanitarium",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 72 },
                            { label: "February", y: 73 },
                            { label: "March", y: 74 },
                            { label: "April", y: 75 },
                            { label: "May", y: 76 },
                            { label: "June", y: 77 },
                            { label: "July", y: 78 },
                            { label: "August", y: 79 },
                            { label: "September", y: 80 },
                            { label: "October", y: 81 },
                            { label: "November", y: 82 },
                            { label: "December", y: 83 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Talisay District Hospital",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 84 },
                            { label: "February", y: 85 },
                            { label: "March", y: 86 },
                            { label: "April", y: 87 },
                            { label: "May", y: 88 },
                            { label: "June", y: 89 },
                            { label: "July", y: 90 },
                            { label: "August", y: 91 },
                            { label: "September", y: 92 },
                            { label: "October", y: 93 },
                            { label: "November", y: 94 },
                            { label: "December", y: 95 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Saint Anthony Mother And Child Hospital",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 96 },
                            { label: "February", y: 97 },
                            { label: "March", y: 98 },
                            { label: "April", y: 99 },
                            { label: "May", y: 100 },
                            { label: "June", y: 101 },
                            { label: "July", y: 102 },
                            { label: "August", y: 103 },
                            { label: "September", y: 104 },
                            { label: "October", y: 105 },
                            { label: "November", y: 106 },
                            { label: "December", y: 107 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cebu Provincial Hospital (Danao City)",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 108 },
                            { label: "February", y: 109 },
                            { label: "March", y: 110 },
                            { label: "April", y: 111 },
                            { label: "May", y: 112 },
                            { label: "June", y: 113 },
                            { label: "July", y: 114 },
                            { label: "August", y: 115 },
                            { label: "September", y: 116 },
                            { label: "October", y: 117 },
                            { label: "November", y: 118 },
                            { label: "December", y: 119 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cebu Provincial Hospital - Bogo City",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 120 },
                            { label: "February", y: 121 },
                            { label: "March", y: 122 },
                            { label: "April", y: 123 },
                            { label: "May", y: 124 },
                            { label: "June", y: 125 },
                            { label: "July", y: 126 },
                            { label: "August", y: 127 },
                            { label: "September", y: 128 },
                            { label: "October", y: 129 },
                            { label: "November", y: 130 },
                            { label: "December", y: 131 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cebu Provincial Hospital (Carcar City)",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 132 },
                            { label: "February", y: 133 },
                            { label: "March", y: 134 },
                            { label: "April", y: 135 },
                            { label: "May", y: 136 },
                            { label: "June", y: 137 },
                            { label: "July", y: 138 },
                            { label: "August", y: 139 },
                            { label: "September", y: 140 },
                            { label: "October", y: 141 },
                            { label: "November", y: 142 },
                            { label: "December", y: 143 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Cebu Provincial Hospital (Balamban)",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 144 },
                            { label: "February", y: 145 },
                            { label: "March", y: 146 },
                            { label: "April", y: 147 },
                            { label: "May", y: 148 },
                            { label: "June", y: 149 },
                            { label: "July", y: 150 },
                            { label: "August", y: 151 },
                            { label: "September", y: 152 },
                            { label: "October", y: 153 },
                            { label: "November", y: 154 },
                            { label: "December", y: 155 }
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Toledo City General Hospital",
                        yValueFormatString: "#,##0",
                        dataPoints: [
                            { label: "January", y: 156 },
                            { label: "February", y: 157 },
                            { label: "March", y: 158 },
                            { label: "April", y: 159 },
                            { label: "May", y: 160 },
                            { label: "June", y: 161 },
                            { label: "July", y: 162 },
                            { label: "August", y: 163 },
                            { label: "September", y: 164 },
                            { label: "October", y: 165 },
                            { label: "November", y: 166 },
                            { label: "December", y: 167 }
                        ]
                    }

                ]
            };
            $("#chartContainer").CanvasJSChart(options);

            function toogleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else{
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }

        }
    </script>
@endsection

