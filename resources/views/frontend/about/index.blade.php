@extends('layouts.frontend')
@section('title', 'About')
@section('content')
    <div id="main">
        <div id="hero">
            <div id="hero-styles">
                <div id="hero-caption" class="parallax-onscroll">
                    <div class="inner">
                        <h5 class="hero-subtitle"><span>{!! setting('creative_studio') !!}</span></h5>
                        <h1 class="hero-title"><span>{!! setting('about_us') !!}</span></h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="main-content">
            <div id="main-page-content">
                <div class="vc_row full change-header-color">
                    <figure class="has-parallax has-animation has-scale-vertical" data-delay="100">
                        <img src="{{ asset('frontend/img/about.jpg') }}" alt="Image Title">
                    </figure>
                </div>
                <div class="vc_row row_padding_top row_padding_bottom small">
                    <h1 class="has-mask">{!! setting('about_description_1') !!}</h1>
                    <hr>
                    <p class="has-animation bigger">{!! setting('about_description_2') !!}</p>
                </div>
                <div class="vc_row row_padding_top dark-section small change-header-color light-content" data-bgcolor="#171717"></div>
                <div class="vc_row row_padding_bottom dark-section full change-header-color light-content two-halfs-right" data-bgcolor="#171717">
                    <h5 class="has-mask no-margins">{!! setting('team_members') !!}</h5>
                    <h1 class="has-mask big-title" data-delay="150">{!! setting('creative_profiles') !!}</h1>
                    <hr><hr class="white-line has-animation"><hr>
                    <ul id="team-members-list" data-fx="1">
                        @foreach ($members as $item)
                            <li class="hide-ball" data-img="{{ asset("uploads/members/$item->image") }}">
                                <div class="team-member has-animation">
                                    {{ $item->name }}<span>{{ $item->position?->name }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <hr><hr class="white-line has-animation"><hr>
                    <div class="button-wrap right disable-drag has-animation large-btn" data-delay="350">
                        <div class="icon-wrap parallax-wrap">
                            <div class="button-icon parallax-element">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </div>
                        <a href="javascript:;" target="_blank">
                            <div class="button-text sticky right">
                                <span data-hover="Join Our Team">{!! setting('join_our_team') !!}</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="vc_row row_padding_top small">
                    <h5 class="has-mask primary-color secondary-font">{!! setting('our_clients') !!}</h5>
                    <h1 class="has-mask">{!! setting('about_description_3') !!}</h1>
                    <hr><hr>
                </div>
                <div class="vc_row full two-halfs-right">
                    <hr><hr class="white-line has-animation"><hr>
                    <ul class="clients-table has-animation no-borders" data-delay="10">
                        @foreach ($brands as $item)
                            <li class="link has-animation">
                                <img src="{{ asset("uploads/brands/$item->image") }}" alt="client">
                                <p>{{ $item->name }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <hr><hr class="white-line has-animation">
                </div>
            </div>
            <div id="page-nav">
                <div class="next-page-wrap">
                    <div class="next-page-title">
                        <div class="inner">
                            <div class="page-title-wrapper has-animation">
                                <a href="{{ route('frontend.contact') }}" class="page-title next-ajax-link-page disable-drag" data-type="page-transition" data-firstline="Next" data-secondline="Page">
                                    <div class="next-hero-subtitle"><span>{!! setting('lets_work_together') !!}</span></div>
                                    <div class="next-hero-title"><span>{!! setting('contact_us') !!}</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
