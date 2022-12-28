@extends('layouts.backend')
@section('title', 'Daxil ol')
@section('content')
    <div class="login d-flex flex-row-fluid">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <div class="d-flex flex-center mb-20">
                    <img src="{{ asset('backend/img/logo.png') }}">
                </div>
                <div class="login-signin">
                    <form action="{{ route('backend.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Emailinizi daxil edin">
                            @error('email')
                                <span class="form-text text-danger pt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8 @error('password') is-invalid @enderror" name="password" placeholder="Şifrənizi daxil edin">
                            @error('password')
                                <span class="form-text text-danger pt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                            <div class="my-3 mr-2">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                        <input type="checkbox" name="remember">
                                        <span></span> Məni xatırla
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-pill btn-primary opacity-90 px-15 py-3">Daxil ol</button>
                        </div>
                    </form>
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
