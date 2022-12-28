@extends('layouts.frontend')
@section('title', 'Contact')
@section('content')
    <div id="main">
        <div id="hero">
            <div id="hero-styles">
                <div id="hero-caption" class="parallax-onscroll">
                    <div class="inner">
                        <h5 class="hero-subtitle"><span>{!! setting('lets_work_together') !!}</span></h5>
                        <h1 class="hero-title"><span>{!! setting('contact_us') !!}</span></h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="main-content">
            <div id="main-page-content">
{{--                <div><div class="vc_row">{!! setting('map') !!}</div></div>--}}
                <div class="vc_row row_padding_top row_padding_bottom light-content dark-section small change-header-color" data-bgcolor="#171717">
                    <h5 class="has-mask no-margins">{!! setting('get_in_touch') !!}</h5>
                    <h1 class="has-mask big-title" data-delay="150">{!! setting('hello_stranger') !!}</h1>
                    <hr>
                    <div id="contact-formular">
                        <form action="{{ route('frontend.contact') }}" method="post" id="contactForm">
                            @csrf
                            <div class="name-box has-animation" data-delay="100">
                                <input type="text" name="name" placeholder="What's Your Name">
                            </div>
                            <div class="email-box has-animation" data-delay="150">
                                <input type="email" name="email" placeholder="Your Email">
                            </div>
                            <div class="message-box has-animation" data-delay="100">
                                <textarea name="content" cols="40" rows="4" placeholder="Tell Us About Your Project"></textarea>
                            </div>
                            <div class="button-box has-animation" data-delay="100">
                                <div class="clapat-button-wrap circle parallax-wrap bigger">
                                    <div class="clapat-button parallax-element">
                                        <div class="button-border outline parallax-element-second">
                                            <input type="submit" class="send_message" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="vc_row row_padding_top small">
                    <h1 class="has-animation" data-delay="0">{!! setting('contact_description') !!}</h1>
                </div>
                <div class="vc_row full two-halfs-right">
                    <hr><hr class="white-line has-animation"><hr><hr>
                    <div class="one_third has-animation" data-delay="100">
                        <div class="clapat-icon">
                            <i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i>
                        </div>
                        <h5 class="no-margins">
                            <a href="mailto:{!! setting('email') !!}" class="link"><span>{!! setting('email') !!}</span></a>
                        </h5>
                        <p>Email</p>
                    </div>
                    <div class="one_third has-animation" data-delay="200">
                        <div class="clapat-icon">
                            <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                        </div>
                        <h5 class="no-margins">{!! setting('address') !!}</h5>
                        <p>Address</p>
                    </div>
                    <div class="one_third last has-animation" data-delay="300">
                        <div class="clapat-icon">
                            <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                        </div>
                        <h5 class="no-margins">
                            <a href="mailto:{!! setting('phone') !!}" class="link"><span>{!! setting('phone') !!}</span></a>
                        </h5>
                        <p>Phone</p>
                    </div>
                    <hr><hr><hr class="white-line has-animation"><hr>
                </div>
            </div>
            <div id="page-nav">
                <div class="next-page-wrap">
                    <div class="next-page-title">
                        <div class="inner">
                            <div class="page-title-wrapper has-animation">
                                <a href="{{ route('frontend.portfolio') }}" class="page-title next-ajax-link-page disable-drag" data-type="page-transition" data-firstline="Next" data-secondline="Page">
                                    <div class="next-hero-subtitle"><span>{!! setting('selected_works') !!}</span></div>
                                    <div class="next-hero-title">{!! setting('visual_communication') !!}</div>
                                </a>
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
