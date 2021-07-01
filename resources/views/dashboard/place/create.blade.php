@extends('layouts.dashboard')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

    <style>
        #mapid {
            min-height: 300px;
        }

    </style>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.place.index') }}">Place</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content" style="min-height: 450px">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Create New Place
                    </div>
                    <div class="card-body">
                        @include('layouts.alert')
                        <form action="{{ route('dashboard.place.store') }}" method="POST">
                            @csrf
                            <div class="form-group @error('category') has-danger @enderror">
                                <label for="category">Category</label>
                                <select name="category" class="form-select" required>
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('name') has-danger @enderror">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Place name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('price') has-danger @enderror">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Place price">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('address') has-danger @enderror">
                                <label for="address">Address</label>
                                <textarea name="address" rows="5" class="form-control"></textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('telephone') has-danger @enderror">
                                <label for="">Telephone</label>
                                <input type="text" class="form-control" name="telephone" placeholder="Place telephone">
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Location</label>
                                <div id="mapid"></div>
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label for="">Latitude</label>
                                        <input type="text" class="form-control" id="lat" name="latitude" required>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="">Longitude</label>
                                        <input type="text" class="form-control" id="long" name="longitude" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Operational Time</label>
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label for="">Start</label>
                                        <input type="time" class="form-control" name="operational_start">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="">End</label>
                                        <input type="time" class="form-control" name="operational_end">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('footer-script')
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

        var marker;

        map.on('click', function(e) {
            if(marker){
                marker.setLatLng([e.latlng.lat, e.latlng.lng]);
            }else{
                marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)
            }
            
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('long').value = e.latlng.lng;
        });
    </script>
@endsection
