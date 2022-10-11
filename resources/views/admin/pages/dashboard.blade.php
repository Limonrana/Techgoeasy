@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="d-flex flex-column flex-md-row">
                    <p class="lead">
                        <span class="font-weight-bold">Hi, {{ Auth::user()->name }}.</span> <span class="d-block text-muted">Here’s what’s happening with your blog site today.</span>
                    </p>
                </div>
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                    <!-- metric row -->
                    <div class="metric-row">
                        <div class="col-lg-9">
                            <div class="metric-row metric-flush">
                                <!-- metric column -->
                                <div class="col">
                                    <!-- .metric -->
                                    <a href="{{ route('admin.categories.index') }}" class="metric metric-bordered align-items-center">
                                        <h2 class="metric-label"> Total Categories </h2>
                                        <p class="metric-value h3">
                                            <sub><i class="oi oi-timer"></i></sub> <span class="value">{{ $category }}</span>
                                        </p>
                                    </a> <!-- /.metric -->
                                </div>
                                <div class="col">
                                    <!-- .metric -->
                                    <a href="{{ route('admin.tags.index') }}" class="metric metric-bordered align-items-center">
                                        <h2 class="metric-label"> Total Tags </h2>
                                        <p class="metric-value h3">
                                            <sub><i class="oi oi-fork"></i></sub> <span class="value">{{ $tag }}</span>
                                        </p>
                                    </a> <!-- /.metric -->
                                </div>
                                <div class="col">
                                    <!-- .metric -->
                                    <a href="{{ route('admin.blogs.index') }}" class="metric metric-bordered align-items-center">
                                        <h2 class="metric-label"> Total Blog </h2>
                                        <p class="metric-value h3">
                                            <sub><i class="fa fa-tasks"></i></sub> <span class="value">{{ $blog }}</span>
                                        </p>
                                    </a> <!-- /.metric -->
                                </div>
                                <!-- /metric column -->
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- .metric -->
                            <a href="#" class="metric metric-bordered">
                                <div class="metric-badge">
                                    <span class="badge badge-lg badge-success">
                                        <span class="oi oi-media-record pulse mr-1"></span> ACTIVE USERS
                                    </span>
                                </div>
                                <p class="metric-value h3">
                                    <sub><i class="oi oi-people"></i></sub> <span class="value">1</span>
                                </p>
                            </a>
                            <!-- /.metric -->
                        </div>
                    </div>
                    <!-- /metric row -->
                </div>
                <!-- /.section-block -->
                <!-- grid row -->
                <div class="row">
                    <!-- grid column -->
                    <div class="col-12">
                        <!-- .card -->
                        <div class="card card-fluid">
                            <!-- .card-body -->
                            <div class="card-body">
                                <h3 class="card-title mb-4"> Publish Blogs </h3>
                                <div class="chartjs" style="height: 292px">
                                    <canvas id="completion-tasks"></canvas>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                    <!-- /grid column -->
                </div>
                <!-- /grid row -->
                <!-- card-deck-xl -->
                <div class="card-deck-xl">
                    <!-- .card -->
                    <div class="card card-fluid pb-3">
                        <div class="card-header">Recent 5 Blog Posts</div>
                        <div class="list-group list-group-flush list-group-divider">
                            @foreach($recentPosts as $recentPost)
                                <!-- .list-group-item -->
                                <div class="list-group-item">
                                    <div class="list-group-item-figure">
                                        <a href="{{ route('admin.blogs.edit', $recentPost->slug) }}" class="user-avatar user-avatar-md">
                                            <img src="{{ $recentPost->featured_image ? $recentPost->featured_image : asset('admin/images/avatars/team4.jpg') }}" alt="{{ $recentPost->title }}">
                                        </a>
                                    </div>
                                    <div class="list-group-item-body">
                                        <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                                            <div class="team">
                                                <h4 class="list-group-item-title">
                                                    <a href="{{ route('admin.blogs.edit', $recentPost->slug) }}">{{ $recentPost->title }}</a>
                                                </h4>
                                                <p class="list-group-item-text">
                                                    @if ($recentPost->updated_at)
                                                        {{ $recentPost->updated_at->diffForHumans() }}
                                                    @else
                                                        {{ $recentPost->created_at->diffForHumans() }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item-figure">
                                        <a href="{{ route('admin.blogs.edit', $recentPost->slug) }}" class="btn btn-sm btn-icon btn-secondary stop-propagation">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.list-group-item -->
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /card-deck-xl -->
            </div>
            <!-- /.page-section -->
        </div>
        <!-- /.page-inner -->
    </div>
    <!-- /.page -->
@endsection

@push('plugin_scripts')
    <script src="{{ asset('admin/vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
@endpush

@push('scripts')
    <script src="{{ asset('admin/javascript/pages/dashboard-demo.js') }}"></script>
@endpush
