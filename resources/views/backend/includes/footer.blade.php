<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-end">
        <div class="text-dark">
            <span class="text-muted font-weight-bold">{{ now()->year }} &copy;</span>
            <a href="{{ config('author.url') }}" class="text-dark-75 text-hover-primary" target="_blank">
                {{ config('author.name') }}
            </a>
        </div>
    </div>
</div>
