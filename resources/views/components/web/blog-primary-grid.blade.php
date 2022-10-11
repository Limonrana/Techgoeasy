<div class="post post-sm">
    <a class="post-img" href="{{ route('web.post', $blog->slug) }}">
        <img src="{{ $blog->featured_image }}" alt="{{ $blog->alt_text }}" style="height: {{ $height }}px;">
    </a>
    <div class="post-body">
        <ul class="post-meta">
            <li>
                @if (isset($category) && $category)
                    <a class="post-category post-category-anchor" href="{{ route('web.category', $slug) }}">
                        {{ $category }}
                    </a>
                @elseif($blog->categories->first())
                    <a class="post-category post-category-anchor" href="{{ route('web.category', $blog->categories->first()?->slug) }}">
                        {{ $blog->categories->first()?->name }}
                    </a>
                @else
                    <a class="post-category post-category-anchor" href="{{ route('web.category', 'uncategorized') }}">
                        Uncategorized
                    </a>
                @endif
            </li>
            <li>
                <span class="post-date">{{ $blog->created_at->format('M d, Y') }}</span>
            </li>
        </ul>
        <h3 class="post-title">
            <a href="{{ route('web.post', $blog->slug) }}">{{ $blog->title }}</a>
        </h3>
    </div>
</div>
