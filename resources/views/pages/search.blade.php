@extends('layouts.app')

@section('title', 'Buscar')

@section('nav')
    @include('layouts.partials._nav',['modal' => 'true'])
@endsection

@section('content')
    <div class="container">
        <form  class="center-align">
            <div class="input-field">
                <input id="search" name="q" type="search" placeholder="Buscar..." style=" padding: 0;display: inline-block;width: 50%">

                <button type="button" id="bsearch" style="background: transparent;display: inline;border: none;padding: 0;margin-top: 0;">
                    <i class="material-icons" style="color:#646464;font-size: 20px;">search</i>
                </button>
            </div>
        </form>
    </div>
    <div class="container" style="margin-top: 60px;">
        <div class="row">
            <div id="result">

            </div>
        </div>
        {{--@if($posts->count())--}}
            {{--@include('layouts.partials._posts',['posts' => $posts])--}}
        {{--@else--}}
            {{--<h1 class="left-align">No se encontraron resultados.</h1>--}}
        {{--@endif--}}
        {{--{{ $posts->appends(Input::except('page'))->links() }}--}}
    </div>

@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection

@section('after-script-end')
    <script>
        $(document).ready(function () {
            $('#search').keyup(function () {
                $('#result').empty();
                $.ajax({
                    url:'searchText',
                    type: 'GET',
                    data: {val: $('#search').val()},
                    success: function (result) {
                        console.log(result);
                        console.log(result.posts);
                        console.log(result.tags);

                        $.each(result.posts.data, function(key, value){
                            console.log(value.media.thumbnail_path);
                            console.log(value.media.display_name);
                            console.log(value.category.style);
                            console.log(value.category.display_name);
                            console.log(value.title);
                            console.log(value.published_date);

                            var slug = value.slug;
                            var thumbnail_path = value.media.thumbnail_path;
                            var m_display_name = value.media.display_name;
                            var category_style = value.category.style;
                            var c_display_name = value.category.display_name;
                            var title = value.title;
                            var published_date = value.published_date.date.toString();



                            $('#result').append('<article>' +
                                    '<div>' +
                                    '<a href="/posts/' + slug + '">' +
                                    '<img class="responsive-img-result" src="/' + thumbnail_path + '" alt="' + m_display_name +'">' +
                                    '</a>' +
                                    '</div>' +
                                    '<p class="category-' + category_style + '">' + c_display_name + '</p>' +
                                    '<a href="/posts/' + slug + '">' +
                                    '<h3 class="post-title left-align">' + title + '</h3>' +
                                    '</a>' +
                                    '<p class="left-align  post-date">' + published_date + '</p>' +
                                    '</article>');

                            {{--<article class="col s12 m4">--}}
                            {{--<div>--}}
                            {{--<a  href="{{ route('posts.show',$post) }}">--}}
                            {{--<img class="responsive-img" src="/{{$post->media->thumbnail_path}}" alt=" {{ $post->media->display_name }}">--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--<p class="category-{{$post->category->style}}">{{$post->category->display_name}}</p>--}}
                            {{--<a  href="{{ route('posts.show',$post) }}">--}}
                            {{--<h3 class="post-title left-align">--}}
                            {{--{{ $post->title }}--}}
                            {{--</h3>--}}
                            {{--</a>--}}
                            {{--<p class="left-align  post-date"> {{ $post->published_date->toFormattedDateString() }}</p>--}}
                            {{--</article>--}}








                        });
                    },
//                    complete: function(){
//                        $('#loading-image').hide();
//                    }
                });
            });
        });
    </script>
@endsection


