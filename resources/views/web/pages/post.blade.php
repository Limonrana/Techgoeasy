@extends('web.layouts.app')

@section('title', $post->title)

@section('content')
    <div class="single-blog-post">
        @php
            $ads = customize('post');
        @endphp
        <!--Single blog featured section start============ -->
        <div id="post-header" class="page-header">
            <div class="page-header-bg" style="background-image:  url({{ $post->featured_image }});"></div>
            <div class="container" style="position: inherit;">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="post-category">
                            @if($post->categories->first())
                                <a class="post-category" href="{{ route('web.category', $post->categories->first()?->slug) }}">
                                    {{ $post->categories->first()?->name }}
                                </a>
                            @else
                                <a class="post-category" href="{{ route('web.category', 'uncategorized') }}">
                                    Uncategorized
                                </a>
                            @endif
                        </div>
                        <h1 class="post-title">{{ $post->title }}</h1>
                        <div class="post-meta">
                            <ul>
                                <li class="author-name"><a href="#">Author: {{ $post->createdBy?->name }}</a></li>
                                @if ($post->updated_at)
                                    <li class="post-date">Last Updated: {{ $post->updated_at->format('M d, Y') }}</li>
                                @else
                                    <li class="post-date">Created At: {{ $post->created_at->format('M d, Y') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Single blog featured section End============== -->


        <!--Single blog Content section start============ -->
        <section class="single-blog-content py-5">
            <div class="container">
                <div class="row">
                    <!-- Single blog body -->
                    <div class="col-lg-8">
                        @if ($ads && $ads->has('banner_script_1'))
                            <div class="section-row" data-custom-ads>
                                {!! $ads['banner_script_1'] !!}
                            </div>
                        @endif
                        <div class="section-row">
                            <div class="post-share">
                                <a href="https://www.facebook.com/sharer.php?u={{ route('web.post', $post->slug) }}" class="social-facebook"><i class="fab fa-facebook-f"></i> <span>Share</span></a>
                                <a href="https://twitter.com/share?url={{ route('web.post', $post->slug) }}" class="social-twitter"><i class="fab fa-twitter"></i> <span>TWEET</span></a>
                                <a href="http://pinterest.com/pin/create/bookmarklet/?url={{ route('web.post', $post->slug) }}" class="social-pinterest"><i class="fab fa-pinterest"></i> <span>PIN</span></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('web.post', $post->slug) }}"><i class="fab fa-linkedin-in"></i> <span>LINKEDIN</span></a>
                            </div>
                        </div>
                        <div class="section-row">
                            <div class="blog-description">
                                {!! $post->description !!}
                            </div>
                        </div>
                        <div class="section-row">
                            <div class="post-tag">
                                <span>Tag:</span>
                                @foreach($post->tags as $tag)
                                    <a href="#">{{ $tag->name }}@if (!$loop->last), @endif</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="section-row">
                            <div class="next-previous-post d-flex justify-content-between">
                                <a @if (isset($post->previous)) href="{{ route('web.post', $post->previous->slug) }}" @endif class="btn previous-post-btn @if (!isset($post->previous)) disabled @endif">
                                    Previous Post
                                </a>
                                <a @if (isset($post->next)) href="{{ route('web.post', $post->next->slug) }}" @endif class="btn next-post-btn @if (!isset($post->next)) disabled @endif">
                                    Next Post
                                </a>
                            </div>
                        </div>

                        @if ($ads && $ads->has('banner_script_2'))
                            <div class="section-row" data-custom-ads>
                                {!! $ads['banner_script_2'] !!}
                            </div>
                        @endif

                        <!-- single-blog-related-post -->
                        @if(count($relatedPosts) > 0)
                            <div class="section-row">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="blog-layout-heading">
                                            <h2>Related Post</h2>
                                        </div>
                                    </div>
                                    @foreach($relatedPosts as $item)
                                        <div class="col-md-4">
                                            @include('components.web.blog-primary-grid', ['blog' => $item, 'height' => 150])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (count($relatedPosts) > 0 && $ads && $ads->has('banner_script_3'))
                            <div class="section-row" data-custom-ads>
                                {!! $ads['banner_script_3'] !!}
                            </div>
                        @endif
                    </div>

                    <!-- Single blog sidebar ----->
                    <div class="col-lg-4">
                        @if ($ads && $ads->has('sidebar_script_1'))
                            <div class="aside-widget text-center" data-custom-ads>
                                {!! $ads['sidebar_script_1'] !!}
                            </div>
                        @endif
                        @if(count($categories) > 0)
                            <div class="aside-widget">
                                <div class="blog-layout-heading ">
                                    <h2>Categories</h2>
                                </div>
                                <div class="category-widget">
                                    <ul>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ route('web.category', $category->slug) }}">
                                                    {{ $category->name }} <span>{{ $category->posts_count }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if ($ads && $ads->has('sidebar_script_2'))
                            <div class="aside-widget text-center" data-custom-ads>
                                {!! $ads['sidebar_script_2'] !!}
                            </div>
                        @endif
                        @if(count($popularPosts) > 0)
                            <div class="aside-widget">
                                <div class="blog-layout-heading">
                                    <h2>Popular Posts</h2>
                                </div>
                                @foreach($popularPosts as $key => $popularPost)
                                    @include('components.web.blog-post-widget', ['blog' => $popularPost])
                                @endforeach
                            </div>
                        @endif
                        @if (count($popularPosts) > 0 && $ads && $ads->has('sidebar_ads_image_3'))
                            <div class="aside-widget text-center" data-custom-ads>
                                {!! $ads['sidebar_script_3'] !!}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>
        <!--Single blog Content section End============ --->
    </div>
@endsection
