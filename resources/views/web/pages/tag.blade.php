@extends('web.layouts.app')

@section('title', $tag->name)

@section('content')
    <div class="section">
        @php
            $ads = customize('taxonomy');
        @endphp
        <div class="page-header">
            <div class="page-header-bg"></div>
            <div class="container" style="position: inherit;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="post-title text-center">{{ $tag->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @if ($ads && $ads->has('banner_script_1'))
                <!--blog-ads-section start-->
                <section class="blog-ads-section py-2" data-custom-ads>
                    {!! $ads['banner_script_1'] !!}
                </section>
                <!--blog-ads-section End -->
            @endif

            <!-- most-read-section-with-sidebar start-->
            <section class="section-with-sidebar pt-3 pb-5">
                <div class="row">
                    @if (count($posts) > 0)
                        <div class="col-12">
                            <div class="blog-layout-heading mb-4">
                                <h2>Tag Related Posts</h2>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            @foreach($posts as $key => $post)
                                @include('components.web.blog-post-row', ['blog' => $post])
                            @endforeach

                            <div class="d-flex justify-content-center pt-5">
                                {!! $posts->links() !!}
                            </div>

                            @if ($ads && $ads->has('banner_script_2'))
                                <!--blog-ads-section start-->
                                <div class="pt-5" data-custom-ads>
                                    {!! $ads['banner_script_2'] !!}
                                </div>
                                <!--blog-ads-section End -->
                            @endif
                        </div>
                    @else
                        <div class="col-md-8">
                            <div class="empty-state">
                                <h2>Post is empty</h2>
                            </div>
                        </div>
                    @endif

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

                        @if ($ads && $ads->has('sidebar_script_3'))
                            <div class="aside-widget text-center" data-custom-ads>
                                {!! $ads['sidebar_script_3'] !!}
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <!-- most-read-section-with-sidebar End -->
        </div>
    </div>
@endsection
