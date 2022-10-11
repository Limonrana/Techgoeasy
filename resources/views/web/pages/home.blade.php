@extends('web.layouts.app')

@section('title', 'HomePage')

@section('content')
    <div class="section">
        @php
            $ads = customize('home');
        @endphp
        <div class="container">
            <!-- blog-layout-1 banner-section Start -->
            <section class="blog-banner-section">
                <div class="row hot-post px-1 mb-5">
                    @foreach($featuredRecentPosts as $featuredRecentPost)
                        @include('components.web.blog-overlay-grid', ['col' => '6', 'blog' => $featuredRecentPost])
                    @endforeach
                </div>
            </section>
            <!-- blog-layout-1 banner-section  End  -->


            <!-- recent-post-section start -->
            <section class="recent-post-section">
                <div class="row">
                    <div class="col-md-8">
                        @if (count($recentPosts) > 0)
                            <div class="row">
                                <div class="col-12">
                                    <div class="blog-layout-heading">
                                        <h2>Recent Posts</h2>
                                    </div>
                                </div>
                                @foreach($recentPosts as $key => $recentPost)
                                    <div class="col-md-6">
                                        @include('components.web.blog-post-grid', ['blog' => $recentPost])
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if ($ads && $ads->has('banner_script_1'))
                            <div class="mb-5" data-custom-ads>
                                {!! $ads['banner_script_1'] !!}
                            </div>
                        @endif
                        @foreach($categoriesPost as $categoryPost)
                            <div class="row">
                                @if (count($categoryPost['items']) > 0)
                                    <div class="col-12">
                                        <div class="blog-layout-heading">
                                            <h2>{{ $categoryPost['category'] }}</h2>
                                        </div>
                                    </div>
                                @endif
                                @foreach($categoryPost['items'] as $item)
                                    <div class="col-md-4">
                                        @include('components.web.blog-primary-grid', [
                                            'blog' => $item, 'category' => $categoryPost['category'],
                                            'slug' => $categoryPost['slug'], 'height' => 150
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        @if ($ads && $ads->has('sidebar_script_1'))
                            <div class="aside-widget text-center" data-custom-ads>
                                {!! $ads['sidebar_script_1'] !!}
                            </div>
                        @endif
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

                        @if ($ads && $ads->has('sidebar_script_2'))
                            <div class="aside-widget text-center" data-custom-ads>
                                {!! $ads['sidebar_script_2'] !!}
                            </div>
                        @endif

                        @if (count($featuredPosts) > 0)
                            <div class="aside-widget">
                                <div class="blog-layout-heading">
                                    <h2>Featured Posts</h2>
                                </div>
                                @foreach($featuredPosts as $key => $featuredPost)
                                    @include('components.web.blog-post-widget', ['blog' => $featuredPost])
                                @endforeach
                            </div>
                        @endif
                        @if ($ads && $ads->has('sidebar_script_3'))
                            <div class="aside-widget text-center" data-custom-ads>
                                {!! $ads['sidebar_script_3'] !!}
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <!-- recent-post-section End  -->

            <!--blog-ads-section start-->
            @if ($ads && $ads->has('banner_script_2'))
                <section class="blog-ads-section py-2" data-custom-ads>
                    {!! $ads['banner_script_2'] !!}
                </section>
            @endif
            <!--blog-ads-section End -->

            <!-- most-popular-post-section-with-sidebar start-->
            @if(count($popularPosts) > 0)
                <section class="most-read-section-with-sidebar pt-3 pb-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="blog-layout-heading mb-4">
                                <h2>Most Popular Posts</h2>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            @foreach($popularPosts as $key => $popularPost)
                                @include('components.web.blog-post-row', ['blog' => $popularPost])
                            @endforeach

                            @if ($ads && $ads->has('banner_script_3'))
                                <div class="pt-5" data-custom-ads>
                                    {!! $ads['banner_script_3'] !!}
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <div class="aside-widget">
                                <div class="sidebar-tags-layout">
                                    <ul class="list-unstyled">
                                        @foreach($tags as $tag)
                                            <li><a href="{{ route('web.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            @if ($ads && $ads->has('sidebar_script_4'))
                                <div class="aside-widget text-center" data-custom-ads>
                                    {!! $ads['sidebar_script_4'] !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
            <!-- most-popular-post-section-with-sidebar End -->
        </div>
    </div>
@endsection
