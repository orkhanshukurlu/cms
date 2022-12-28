<footer class="hidden">
    <div id="footer-container">
        <div id="backtotop" class="button-wrap left disable-drag">
            <div class="icon-wrap parallax-wrap">
                <div class="button-icon parallax-element">
                    <i class="fa fa-angle-up"></i>
                </div>
            </div>
            <div class="button-text sticky left"><span data-hover="Back Top">Back Top</span></div>
        </div>
        <div class="footer-middle">
            <div class="copyright">
                {{ now()->year }} &copy;
                <a href="{{ config('author.url') }}" class="link" target="_blank">{{ config('author.name') }}</a>
                . All rights reserved.
            </div>
        </div>
        <div class="socials-wrap disable-drag">
            <div class="socials-icon"><i class="fa fa-share-alt" aria-hidden="true"></i></div>
            <div class="socials-text">Follow Us</div>
            <ul class="socials">
                @foreach ($socials as $item)
                    <li>
                        <span class="parallax-wrap">
                            <a href="{{ $item->link }}" class="parallax-element" target="_blank">{{ $item->name }}</a>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
