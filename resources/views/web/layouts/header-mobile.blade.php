<!-- Header for mobile -->
<header class="mobile-header d-block d-lg-none">
    <div class="container">
        <div class="mobile-header-content d-flex justify-content-between align-items-center">
            <div class="mobile-header-logo">
                @if($header && $header->has('logo') && $header['logo'])
                    <img src="{{ $header['logo'] }}"
                         @if($header->has('logo_width')) width="{{ $header['logo_width'] }}px" @endif
                         @if($header->has('logo_height')) height="{{ $header['logo_height'] }}px" @endif
                         alt="{{ $header->has('alt_text') ? $header['alt_text'] : config('app.name') }}"
                    >
                @else
                    <h2 class="text-uppercase text-black">{{ config('app.name') }}</h2>
                @endif
            </div>
            <div class="mobile-header-menu d-flex ">
                <div class="mobile-menu-canvas">
                    <a class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuCanvas" ><svg width="20px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></a>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenuCanvas" >
                        <div class="offcanvas-header d-block text-end">
                            <a type="button" class="" data-bs-dismiss="offcanvas">
                                <svg width="20px" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
                            </a>
                        </div>
                        <div class="offcanvas-body">
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
                </div>
                <div class="header-search-btn">
                    <span><a href="javascript:;"><i class="fas fa-search"></i></a></span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header for mobile -->
