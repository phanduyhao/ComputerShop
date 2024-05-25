@extends('layouts.layout')
@section('content')

    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-nav text-start">
                <li><a href="/">Trang chủ</a></li>
                <li>Danh sách bài viết</li>
            </ul>
        </div>
    </div>
    <!-- Start Blog Singel Area -->
    <section class="section latest-news-area blog-list">
        <div class="container">
            <div class="breadcrumbs-content mb-4">
                <h1 class="page-title">Tất cả bài viết</h1>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-lg-6 col-12">
                                <!-- Single News -->A
                                <div class="single-news wow fadeInUp" data-wow-delay=".2s">
                                    <div class="image">
                                        <a href="{{ route('posts.details', ['slug' =>$post->slug]) }}"><img class="thumb" src="/temp/images/post/{{$post->thumb}}" alt="#"></a>
                                    </div>
                                    <div class="content-body">
                                        <h4 class="title">
                                            <a href="{{ route('posts.details', ['slug' =>$post->slug]) }}">
                                                {{$post->Title}}
                                            </a>
                                        </h4>
                                        <div class="dynamic-height mt-3">
                                            {!! $post->description !!}
                                        </div>
                                        <div class="meta-details">
                                            <ul>
                                                <li><a href="{{ route('posts.details', ['slug' =>$post->slug]) }}">{{$post->updated_at}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single News -->
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="pagination mt-4 pb-4">
                        {{ $posts->links() }}
                    </div>
                    <!--/ End Pagination -->
                </div>
                <aside class="col-lg-4 col-md-5 col-12">
                    <div class="sidebar blog-grid-page">
                        <!-- Start Single Widget -->
                        <div class="widget search-widget">
                            <h5 class="widget-title"><span>Tìm kiếm</span></h5>
                            <form action="#">
                                <input type="text" placeholder="Tìm kiếm ngay...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget popular-feeds">
                            <h5 class="widget-title"><span>Bài viết mới nhất</span></h5>
                            <div class="popular-feed-loop">
                                @foreach($post_news as $post_new)
                                    <div class="single-popular-feed d-flex flex-column align-items-start">
                                        <a href="{{ route('posts.details', ['slug' =>$post_new->slug]) }}" class="img">
                                            <img width="150" src="/temp/images/post/{{$post_new->thumb}}" alt="{{ $post_new->title }}'s Avatar">
                                        </a>
                                        <div class="feed-desc mt-2">
                                            <h6 class="post-title">
                                                <a href="{{ route('posts.details', ['slug' =>$post_new->slug]) }}">
                                                    {{$post_new->Title}}
                                                </a>
                                            </h6>
                                            <span class="time"><i class="lni lni-calendar"></i> {{$post_new->updated_at}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget sidebar-as">
                            <h5 class="widget-title"><span>Advertisement</span></h5>
                            <a href="javascript:void(0)">
                                <img src="assets/images/banner/banner.jpg" alt="#">
                            </a>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget popular-feeds">
                            <h5 class="widget-title"><span>Bài viết Hot</span></h5>
                            <div class="popular-feed-loop">
                                @foreach($post_hots as $post_hot)
                                    <div class="single-popular-feed d-flex flex-column align-items-start">
                                        <a href="{{ route('posts.details', ['slug' =>$post_hot->slug]) }}" class="img">
                                            <img width="150" src="/temp/images/post/{{$post_hot->thumb}}" alt="{{ $post_hot->title }}'s Avatar">
                                        </a>
                                        <div class="feed-desc mt-2">
                                            <h6 class="post-title">
                                                <a href="{{ route('posts.details', ['slug' =>$post_hot->slug]) }}">
                                                    {{$post_hot->Title}}
                                                </a>
                                            </h6>
                                            <span class="time"><i class="lni lni-calendar"></i> {{$post_hot->updated_at}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
