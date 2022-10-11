<!-- Header for desktop -->
<header class=" d-none d-lg-block">
    <div class="top-header">
        <div class="container">
            <div class="top-header-content d-flex justify-content-between align-items-center">
                <div class="header-social-btn">
                    <ul>
                        <li>
                            <a class="header-social-btn-img" href="@if($header && $header->has('facebook')){{ $header['facebook'] }}@endif" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a class="header-social-btn-img" href="@if($header && $header->has('twitter')){{ $header['twitter'] }}@endif" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a class="header-social-btn-img" href="@if($header && $header->has('linkedin')){{ $header['linkedin'] }}@endif" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li>
                            <a class="header-social-btn-img" href="@if($header && $header->has('instagram')){{ $header['instagram'] }}@endif" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="header-site-logo text-center">
                    <a href="{{ route('web.home') }}">
                        @if($header && $header->has('logo') && $header['logo'])
                            <img src="{{ $header['logo'] }}"
                                 @if($header->has('logo_width')) width="{{ $header['logo_width'] }}px" @endif
                                 @if($header->has('logo_height')) height="{{ $header['logo_height'] }}px" @endif
                                 alt="{{ $header->has('alt_text') ? $header['alt_text'] : config('app.name') }}"
                            >
                        @else
                            <h2 class="text-uppercase text-black">{{ config('app.name') }}</h2>
                        @endif
                    </a>
                </div>
                <div class="header-search-btn text-end">
                    <span>
                        <a href="javascript:;">
                            <i class="fas fa-search"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-header">
        <div class="container">
            <div class="header-menu">
                <ul >
                    <li><a href="{{ route('web.home') }}">Home</a></li>
                    @foreach($getTopCategories as $menu)
                        <li><a href="{{ route('web.category', $menu->slug) }}">{{ $menu->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- End Header for desktop -->
