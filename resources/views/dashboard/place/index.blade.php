@extends('layouts.dashboard')
@section('content')
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
                            <li class="breadcrumb-item active" aria-current="page">Place</li>
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
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                Data Place
                            </div>
                            <div class="col-12 col-md-6 order-md-1 order-first">
                                <a href="{{ route('dashboard.place.create') }}" class="btn btn-primary float-start float-lg-end">
                                    <i class="bi bi-plus"></i> Create Place
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.alert')
                        <table class="table table-striped" id="placeTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Telephone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($places as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>{{ empty($item->telephone) ? '-' : $item->telephone }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.place.detail', $item->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('dashboard.place.destroy', $item->id) }}" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('footer-script')
    <script>
        // Simple Datatable
        let placeTable = document.querySelector('#placeTable');
        let dataTable = new simpleDatatables.DataTable(placeTable);
    </script>
@endsection
