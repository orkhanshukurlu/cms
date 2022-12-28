@extends('layouts.backend')
@section('title', 'Tənzimləmələr')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Tənzimləmələr</h3>
                        </div>
                        @can('settings-create')
                            <div class="card-toolbar">
                                <a href="{{ route('backend.settings.create') }}" class="btn btn-primary font-weight-bolder">
                                    <i class="la la-plus"></i> Yeni tənzimləmə
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Açar söz</th>
                                    <th>Tənzimləmələr</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/datatables.bundle.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables.bundle.js') }}"></script>
    @include('backend.datatables.setting')
@endsection
