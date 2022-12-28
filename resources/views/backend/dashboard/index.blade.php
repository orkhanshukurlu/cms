@extends('layouts.backend')
@section('title', 'Əsas Səhifə')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-body d-flex p-0">
                                <div class="flex-grow-1 px-20 py-15 card-rounded flex-grow-1 bgi-no-repeat">
                                    <h2 class="text-dark font-weight-bolder mb-0">İdarəetmə panelinə xoş gəlmisiniz...</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-custom bg-primary card-stretch gutter-b">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                        </g>
                                    </svg>
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">{{ $portfolioCount }}</div>
                                <div class="font-weight-bold text-inverse-primary font-size-lg">Portfolio sayı</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-custom bg-danger card-stretch gutter-b">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                        </g>
                                    </svg>
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">{{ $memberCount }}</div>
                                <div class="font-weight-bold text-inverse-primary font-size-lg">Komanda üzvü sayı</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-custom bg-success card-stretch gutter-b">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                        </g>
                                    </svg>
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">{{ $brandCount }}</div>
                                <div class="font-weight-bold text-inverse-primary font-size-lg">Brend sayı</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-custom bg-warning card-stretch gutter-b">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                        </g>
                                    </svg>
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">{{ $socialCount }}</div>
                                <div class="font-weight-bold text-inverse-primary font-size-lg">Sosial link sayı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/sweetalert.min.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
@endsection
