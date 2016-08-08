@extends('layouts.app')

@section('head')
        <!-- Icons -->
<link media="screen" href="{{ asset('youtube-video-player/packages/icons/css/icons.min.css') }}"  rel="stylesheet" type="text/css" >
<!-- Main Stylesheet -->
<link media="screen" href="{{ asset('youtube-video-player/css/youtube-video-player.css') }}"  rel="stylesheet" type="text/css" >
<!-- Perfect Scrollbar -->
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('youtube-video-player/packages/perfect-scrollbar/perfect-scrollbar.css')}}" />

@endsection

@section('title', $category->display_name)

@section('nav')
    @include('layouts.partials._nav',[
    'modal' => 'true',
    'title' => $category->display_name,
    'titleStyle' => $category->style
    ])
@endsection

@section('content')
    <div class="container" style="margin-top: 35px">
        <div class="row">
            <div class="col s12">
                @if(!empty($slider))
                    @include('layouts.partials._sliderArticle',[ 'slider' => $slider ])
                @endif
            </div>
        </div>
        @if($posts->currentPage() == 1)
            @include('layouts.partials._home',['posts' => $posts, 'top' => $topRated, 'moreViews' => $moreViews])
        @else
            @include('layouts.partials._posts',['posts' => $posts])
        @endif

        {{ $posts->links() }}

    </div>

@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection

@section('after-script-end')
    <script type="text/javascript" src="{{ asset('youtube-video-player/js/youtube-video-player.jquery.js') }}"></script>
    <!-- Perfect Scrollbar -->
    <script type="text/javascript" src="{{ asset('youtube-video-player/packages/perfect-scrollbar/jquery.mousewheel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('youtube-video-player/packages/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    @if(!empty($youtube))
        @include('pages._player',['option' => $youtube->choices.": '".$youtube->youtube_id."'"])
    @endif

@endsection
