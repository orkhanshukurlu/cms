@extends('layouts.frontend')
@section('title', 'Home')
@section('content')
    <div id="main">
        <div id="hero">
            <div id="hero-styles">
                <div id="hero-caption" class="parallax-onscroll">
                    <div class="inner">
                        <h1 class="hero-title">{!! setting('visual_communication') !!}</h1>
                    </div>
                </div>
                <div id="hero-footer" class="landing">
                    <div class="hero-footer-left">
                        <div class="button-wrap left disable-drag scroll-down">
                            <div class="icon-wrap parallax-wrap">
                                <div class="button-icon parallax-element">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="button-text sticky left">
                                <span data-hover="Scroll Down">{!! setting('scroll_down') !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="main-content">
            <div id="main-page-content">
                <div id="itemsWrapperLinks" class="portfolio-wrap landing-grid fade-scaleout-effect">
                    <div id="itemsWrapper" class="portfolio">
                        @foreach ($portfolio as $item)
                            <div class="item disable-drag change-header">
                                <div class="item-parallax">
                                    <div class="item-appear">
                                        <div class="item-content">
                                            <a href="{{ route('frontend.portfolio.show', $item->slug) }}" class="item-wrap ajax-link-project" data-type="page-transition"></a>
                                            <div class="item-wrap-image">
                                                <img src="{{ asset("uploads/portfolio/$item->image") }}" class="item-image grid__item-img" alt="">
                                            </div>
                                            <img src="{{ asset("uploads/portfolio/$item->image") }}" class="grid__item-img grid__item-img--large" alt="">
                                        </div>
                                    </div>
                                    <div class="item-caption-wrapper">
                                        <div class="item-caption">
                                            <div class="item-title">{{ $item->title }}</div>
                                            <div class="item-cat">{{ $item->category?->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="see-all-works">
                        <div class="button-wrap right disable-drag has-animation large-btn show-works-btn" data-delay="350">
                            <div class="icon-wrap parallax-wrap">
                                <div class="button-icon parallax-element">
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </div>
                            <a href="{{ route('frontend.portfolio') }}" class="ajax-link" data-type="page-transition">
                                <div class="button-text sticky right">
                                    <span data-hover="See All Works">{!! setting('see_all_works') !!}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="vc_row row_padding_top white-section full" data-bgcolor="#eee">
                    <div class="content-marquee-wrapper">
                        <div class="content-marquee" data-text="We are trusted by over 28,000 clients across the world to power stunning websites.">
                            {!! setting('home_description') !!}
                        </div>
                    </div>
                </div>
                <div class="vc_row row_padding_top row_padding_bottom small white-section"  data-bgcolor="#fff">
                    <h5 class="has-mask no-margins">Get in Touch</h5>
                    <h1 class="has-mask big-title" data-delay="150">Hello Stranger</h1>
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
