@extends('layouts.frontend')
@section('title', $portfolio->title)
@section('content')
    <div id="main">
        <div id="hero" class="has-image autoscroll">
            <div id="hero-styles">
                <div id="hero-caption" class="reverse-parallax-onscroll">
                    <div class="inner">
                        <div class="hero-title"><span>{{ $portfolio->title }}</span></div>
                        <div class="hero-subtitle"><span>{{ $portfolio->category?->name }}</span></div>
                    </div>
                </div>
                <div id="hero-footer">
                    <div class="hero-footer-left">
                        <div class="button-wrap left disable-drag scroll-down">
                            <div class="icon-wrap parallax-wrap">
                                <div class="button-icon parallax-element">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="button-text sticky left">
                                <span data-hover="Scroll or drag to navigate">Scroll or drag to navigate</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero-footer-right">
                        <div id="share" class="page-action-content disable-drag" data-text="Share:"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="hero-image-wrapper">
            <div id="hero-background-layer" class="parallax-scroll-effect">
                <div id="hero-bg-image" style="background-image:url({{ asset("uploads/portfolio/$portfolio->image") }})"></div>
            </div>
        </div>
        <div id="main-content">
            <div id="main-page-content">
                <div class="vc_row row_padding_top row_padding_bottom small">
                    <h2 class="has-mask">{!! $portfolio->description !!}</h2>
                </div>
                <div class="vc_row row_padding_bottom dark-section" data-bgcolor="#141414">
                    <div class="swiper-container content-looped-carousel disable-drag">
                        <div class="swiper-wrapper">
                            @foreach ($portfolio->photos as $item)
                                <div class="swiper-slide">
                                    <img src="{{ asset("uploads/portfolio/$item->image") }}" alt="Image Title">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="vc_row full">
                    <figure class="has-animation has-parallax has-scale" data-delay="100">
                        <img src="{{ asset("uploads/portfolio/$nextPortfolio->image") }}" alt="Image Title">
                    </figure>
                </div>
                <div class="vc_row row_padding_top row_padding_bottom small">
                    <h2 class="has-mask">{!! $nextPortfolio->description !!}</h2>
                </div>
            </div>
            <div id="project-nav" class="light-content">
                <div class="next-project-wrap">
                    <div class="next-project-caption">
                        <div class="next-caption-wrapper disable-drag">
                            <a href="{{ route('frontend.portfolio.show', $nextPortfolio) }}" class="next-ajax-link-project" data-type="page-transition" data-firstline="Next" data-secondline="Project"></a>
                            <div class="next-caption">
                                <div class="next-hero-title"><span>{{ $nextPortfolio->title }}</span></div>
                                <div class="next-hero-subtitle"><span>{{ $nextPortfolio->category?->name }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
