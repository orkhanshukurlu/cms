<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.includes.meta')
    @include('frontend.includes.styles')
    @yield('styles')
</head>
<body class="hidden hidden-ball smooth-scroll" data-primary-color="#ff0000">
    <main>
        @include('frontend.includes.loader')
        <div class="cd-index cd-main-content">
            <div id="page-content" class="" data-bgcolor="#878787">
                @include('frontend.includes.header')
                <div id="content-scroll">
                    @yield('content')
                    @include('frontend.includes.footer')
                </div>
                @include('frontend.includes.project')
            </div>
        </div>
    </main>
    @include('frontend.includes.bottom')
    @include('frontend.includes.scripts')
    @yield('scripts')
</body>
</html>
