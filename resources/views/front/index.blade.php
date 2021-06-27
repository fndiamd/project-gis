@extends('layouts.front')

@section('content')
    <div class="card">
        <div class="card-body" id="mapid"></div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

    <style>
        #mapid {
            min-height: 500px;
        }

    </style>

@endsection
@push('scripts')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

    <script>
        var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }},
            {{ config('leaflet.map_center_longitude') }}
        ], {{ config('leaflet.zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var markers = L.markerClusterGroup();

        axios.get('{{ route('place.map') }}')
            .then(function(response) {
                let location = '';
                for (let i = 0; i < response.data.length; i++) {
                    location = "http://maps.google.com/maps?q=loc:" + response.data[i].latitude + "," + response.data[i].longitude
                    markers.addLayer(L.marker(
                        [response.data[i].latitude, response.data[i].longitude], {
                            title: response.data[i].name
                        }).bindPopup(`<span>Nama : ${response.data[i].name }</span><br>
                        <span>Harga : Rp ${response.data[i].price}</span><br>
                        <span>Alamat : ${response.data[i].address} <br><br> <a href="${location}" class="btn btn-success" target="_blank" style="color: #FFF">Rute</a></span>`))
                }

            })
            .catch(function(error) {
                console.log(error);
            });

        map.addLayer(markers);
    </script>
@endpush
