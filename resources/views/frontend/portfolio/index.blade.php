@extends('layouts.frontend')
@section('title', 'Portfolio')
@section('content')
    <div id="main">
        <div id="hero">
            <div id="hero-styles">
                <div id="hero-caption" class="parallax-onscroll text-align-center1">
                    <div class="inner">
                        <h5 class="hero-subtitle"><span>{!! setting('selected_works') !!}</span></h5>
                        <h1 class="hero-title">{!! setting('visual_communication') !!}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="main-content">
            <div id="main-page-content">
                <div id="itemsWrapperLinks" class="portfolio-wrap metro-grid fade-scaleout-effect">
                    <div id="itemsWrapper" class="portfolio">
                        @foreach ($portfolio as $item)
                            <div class="item disable-drag change-header">
                                <div class="item-parallax">
                                    <div class="item-appear">
                                        <div class="item-content">
                                            <a href="{{ route('frontend.portfolio.show', $item) }}" class="item-wrap ajax-link-project" data-type="page-transition"></a>
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
                </div>
            </div>
            <div id="page-nav">
                <div class="next-page-wrap">
                    <div class="next-page-title">
                        <div class="inner">
                            <div class="page-title-wrapper has-animation">
                                <a href="{{ route('frontend.about') }}" class="page-title next-ajax-link-page disable-drag" data-type="page-transition" data-firstline="Next" data-secondline="Page">
                                    <div class="next-hero-subtitle"><span>{!! setting('creative_studio') !!}</span></div>
                                    <div class="next-hero-title"><span>{!! setting('about_us') !!}</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
