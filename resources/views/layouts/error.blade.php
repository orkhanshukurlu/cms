<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('backend.includes.meta')
    @include('backend.includes.styles')
    @yield('styles')
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="error error-4 d-flex flex-row-fluid bgi-size-cover bgi-position-center">
                <div class="d-flex flex-column flex-row-fluid align-items-center justify-content-md-center text-center px-10 px-md-30 py-10 py-md-20 line-height-xs">
                    <h1 class="error-title text-danger font-weight-boldest line-height-sm">@yield('code')</h1>
                    <p class="display-4 font-weight-boldest mt-md-0 line-height-md">@yield('message')</p>
                </div>
            </div>
        </div>
    </div>
    @include('backend.includes.scripts')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/error.css') }}">
</body>
</html>

