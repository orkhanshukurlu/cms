<header class="fullscreen-menu">
    <div id="header-container">
        <div id="logo" class="hide-ball disable-drag">
            <a href="{{ route('frontend.home') }}" class="ajax-link" data-type="page-transition">
                <img class="black-logo" src="{{ asset('frontend/img/logo-dark.png') }}" alt="ClaPat Logo">
                <img class="white-logo" src="{{ asset('frontend/img/logo-white.png') }}" alt="ClaPat Logo">
            </a>
        </div>
        <nav>
            <div class="nav-height">
                <div class="outer">
                    <div class="inner">
                        <ul data-breakpoint="10025" class="flexnav">
                            <li class="link menu-timeline">
                                <a href="{{ route('frontend.about') }}" class="ajax-link @if(menu('about')) active @endif" data-type="page-transition">
                                    <div class="before-span"><span data-hover="About">About</span></div>
                                </a>
                            </li>
                            <li class="link menu-timeline">
                                <a href="{{ route('frontend.portfolio') }}" class="ajax-link @if(menu('portfolio')) active @endif" data-type="page-transition">
                                    <div class="before-span"><span data-hover="Portfolio">Portfolio</span></div>
                                </a>
                            </li>
                            <li class="link menu-timeline">
                                <a href="{{ route('frontend.contact') }}" class="ajax-link @if(menu('contact')) active @endif" data-type="page-transition">
                                    <div class="before-span"><span data-hover="Contact">Contact</span></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="button-wrap right menu disable-drag">
            <div class="icon-wrap parallax-wrap">
                <div class="button-icon parallax-element">
                    <div id="burger-wrapper">
                        <div id="menu-burger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-text sticky right">
                <a href="{{ route('frontend.about') }}" class="ajax-link" data-type="page-transition">About</a>
                <a href="{{ route('frontend.portfolio') }}" class="ajax-link" data-type="page-transition">Portfolio</a>
                <a href="{{ route('frontend.contact') }}" class="ajax-link" data-type="page-transition">Contact</a>
            </div>
        </div>
    </div>
</header>
