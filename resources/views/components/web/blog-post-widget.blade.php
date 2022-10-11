<div class="post post-widget">
    <a class="post-img" href="{{ route('web.post', $blog->slug) }}">
        <img src="{{ $blog->featured_image }}" style="min-height: 80px;" alt="{{ $blog->alt_text }}">
    </a>
    <div class="post-body">
        <div class="post-category-transparent">
            @if($blog->categories->first())
                <a href="{{ route('web.category', $blog->categories->first()?->slug) }}">
                    {{ $blog->categories->first()?->name }}
                </a>
            @else
                <a href="{{ route('web.category', 'uncategorized') }}">
                    Uncategorized
                </a>
            @endif
        </div>
        <h3 class="post-title">
            <a href="{{ route('web.post', $blog->slug) }}">{{ $blog->title }}</a>
        </h3>
    </div>
</div>
