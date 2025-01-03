@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <style>
        #mapid { height: 700px; }
        td,th{
            padding: 1%;
        }
    </style>
</head>
<div class="jim-content">
    <div id="mapid"></div>
</div>
@endsection
@section('js')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

<script type="">

    mymap = L.map('mapid').setView([10.3080552, 123.892631], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicnVzZWx0YXlvbmdza2kiLCJhIjoiY2twZHIydTBoMDI3ZzJwcXJvOTlvM3NzbCJ9.oRV4AbBdREjCwD7KaD-IHQ', {
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    var marker = [];
    var facility_name = [];
    var vacant = [];
    var available = [];

    @foreach($facility as $row)
    var id = "{{ $row->id }}";
    marker[id] = L.marker([{{ $row->latitude }}, {{ $row->longitude }}]).addTo(mymap);
    facility_name[id] = "{{ $row->name }}";
    vacant[id] = "{{ $row->emergency_room_covid_vacant ? $row->emergency_room_covid_vacant : 0 }}";
    available[id] = "{{ $row->emergency_room_covid_occupied ? $row->emergency_room_covid_occupied : 0 }}";
    marker[id].bindPopup("<b class='text-blue'>"+facility_name[id]+"</b><table class='table table-striped'>" +
        "<tr>" +
            "<th>Type</th>" +
            "<th>Beds</th>" +
            "<th>Vacant</th>" +
            "<th>Available</th>" +
        "</tr>" +
        "<tr>" +
            "<td>COVID BEDS</td>" +
            "<td>Emergency Room (ER)</td>" +
            "<td class='text-green'>"+vacant[id]+"</td>" +
            "<td class='text-red'>"+available[id]+"</td>" +
        "</tr>" +
        "</table>")
        .openPopup();
    @endforeach
</script>
@endsection