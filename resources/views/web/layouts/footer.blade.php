@php
    $footer = customize('footer');
@endphp

<footer class="blog-footer-section pt-5">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-4">
                <div class="footer-logo">
                    @if ($footer && $footer->has('logo') && $footer['logo'])
                        <img src="{{ $footer['logo'] }}"
                             @if($footer->has('logo_width')) width="{{ $footer['logo_width'] }}px" @endif
                             @if($footer->has('logo_height')) height="{{ $footer['logo_height'] }}px" @endif
                             alt="{{ $footer->has('alt_text') ? $footer['alt_text'] : config('app.name') }}"
                        >
                    @else
                        <h2 class="text-white text-uppercase">{{ config('app.name') }}</h2>
                    @endif
                </div>
                <div class="footer-para">
                    @if ($footer && $footer->has('about_company'))
                        <p>{{ $footer['about_company'] }}</p>
                    @else
                        <p>Nec feugiat nisl pretium fusce id velit ut tortor pretium. Nisl purus in mollis nunc sed. Nunc non blandit massa enim nec.</p>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <h2 class="footer-link-heading">Categories</h2>
                <div class="footer-category-menu sidebar-category-menu">
                    <ul>
                        @foreach($getTopCategories as $category)
                            <li>
                                <a class="d-flex justify-content-between" href="{{ route('web.category', $category->slug) }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="totall-number">{{ $category->posts_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <h2 class=" footer-link-heading">Tags</h2>
                <div class="footer-tags-layout sidebar-tags-layout">
                    <ul class="list-unstyled">
                        @foreach($getTopTags as $tag)
                            <li><a href="{{ route('web.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3">
            <div class="footer-copyright text-center">
                <p>@if ($footer && $footer->has('copy_right_text')) {{ $footer['copy_right_text'] }} @else &copy;Copyright ©{{ date('Y') }} All rights reserved @endif | This website made & maintenance by <a href="https://websoftking.com" target="_blank">Web Soft King LTD</a></p>
            </div>
        </div>
    </div>
</footer>
