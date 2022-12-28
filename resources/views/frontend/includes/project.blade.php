<div id="app"></div>
<div id="project-holder">
    <div id="project-data"></div>
</div>
@if (Route::currentRouteName() == 'frontend.portfolio.show')
    <div class="next-project-image-wrapper">
        <div class="next-project-image">
            <div class="next-project-image-bg" style="background-image:url({{ asset("uploads/portfolio/$nextPortfolio->image") }})"></div>
        </div>
    </div>
@endif
