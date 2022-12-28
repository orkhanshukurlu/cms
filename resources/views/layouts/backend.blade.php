<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('backend.includes.meta')
    @include('backend.includes.styles')
    @yield('styles')
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    @includeWhen(auth()->check(), 'backend.includes.mobile')
    <div class="d-flex flex-column flex-root">
        @auth
            <div class="d-flex flex-row flex-column-fluid page">
                @include('backend.includes.sidebar')
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    @include('backend.includes.header')
                    @yield('content')
                    @include('backend.includes.footer')
                </div>
            </div>
        @else
            @yield('content')
        @endauth
    </div>
    @includeWhen(auth()->check(), 'backend.includes.user')
    @include('backend.includes.scripts')
    @yield('scripts')
    @include('backend.includes.notification')
</body>
</html>
