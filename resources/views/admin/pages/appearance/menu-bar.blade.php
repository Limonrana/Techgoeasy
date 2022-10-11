<nav class="nav nav-tabs flex-column border-0">
    <a href="{{ route('admin.customize.index', 'header') }}" class="nav-link @if($active === 'header') active @endif">Header Section</a>
    <a href="{{ route('admin.customize.index', 'home') }}" class="nav-link @if($active === 'home') active @endif">Home Page</a>
    <a href="{{ route('admin.customize.index', 'post') }}" class="nav-link @if($active === 'post') active @endif">Post Page</a>
    <a href="{{ route('admin.customize.index', 'taxonomy') }}" class="nav-link @if($active === 'taxonomy') active @endif">Taxonomy Page</a>
    <a href="{{ route('admin.customize.index', 'continue') }}" class="nav-link @if($active === 'continue') active @endif">Blank Ads</a>
    <a href="{{ route('admin.customize.index', 'hcaptcha') }}" class="nav-link @if($active === 'hcaptcha') active @endif">hCaptcha Ads</a>
    <a href="{{ route('admin.customize.index', 'footer') }}" class="nav-link @if($active === 'footer') active @endif">Footer Section</a>
</nav>
