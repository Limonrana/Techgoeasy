<div class="{{ 'col-lg-'.$col ?? 'col' }}">
    <div class="post post-thumb">
        <a class="post-img" href="{{ route('web.post', $blog->slug) }}">
            <img src="{{ $blog->featured_image }}" alt="{{ $blog->alt_text }}" style="height: 380px;">
        </a>
        <div class="post-body">
            <div class="post-meta-1">
                @if($blog->categories->first())
                    <a class="post-category post-category-anchor" href="{{ route('web.category', $blog->categories->first()?->slug) }}">
                        {{ $blog->categories->first()?->name }}
                    </a>
                @endif
                <span class="post-date">{{ $blog->created_at->format('M d, Y') }}</span>
            </div>
            <h3 class="post-title">
                <a href="{{ route('web.post', $blog->slug) }}">{{ $blog->title }}</a>
            </h3>
        </div>
    </div>
</div>
