<div class="post">
    <a class="post-img" href="{{ route('web.post', $blog->slug) }}">
        <img src="{{ $blog->featured_image }}" alt="{{ $blog->alt_text }}" style="height: {{ $height ?? 220 }}px;">
    </a>
    <div class="post-body">
        <div class="post-category">
            @if($blog->categories->first())
                <a class="post-category" href="{{ route('web.category', $blog->categories->first()?->slug) }}">
                    {{ $blog->categories->first()?->name }}
                </a>
            @else
                <a class="post-category" href="{{ route('web.category', 'uncategorized') }}">
                    Uncategorized
                </a>
            @endif
        </div>
        <h3 class="post-title">
            <a href="{{ route('web.post', $blog->slug) }}">{{ $blog->title }}</a>
        </h3>
        <ul class="post-meta">
            <li>{{ $blog->created_at->format('M d, Y') }}</li>
        </ul>
    </div>
</div>
