@extends('layouts.app')

@section('title', 'Colaborador')

@section('nav')
    @include('layouts.partials._nav',['modal' => 'true'])
@endsection

@section('content')
    <div class="container" style="margin-top: 35px">
        <div class="row">
            <div class="col s12" >
                <h1 class="home-title no-margin-bottom">{{ $collaborator->complete_name }}</h1>
                <p class="text-motivapp-blue no-margin-top">Colaborador Motivapp</p>
            </div>
        </div>
    </div>
    <img style="width: 100%" src="{{asset('img/line.jpg')}}" alt="________________">
    @if($posts->count())
        <div class="container">
            <div class="row">
                <div class="col m6 s12 border-article-right" >
                    <div class="row">
                        <div class="col s12 m12">
                            <h1 class="home-title">Bio</h1>
                            <p class="text-justify">
                                {{ $collaborator->bio }}
                            </p>
                            <hr>
                        </div>

                        <article class="col s12 m12">
                            <div>
                                <a href="{{ route('posts.show',$posts[0]) }}">
                                    <img class="responsive-img" src="/{{$posts[0]->media->thumbnail_path}}" alt=" {{ $posts[0]->media->display_name }}">
                                </a>
                            </div>
                            <p class="category-{{$posts[0]->category->style}}">{{$posts[0]->category->display_name}}</p>
                            <a href="{{ route('posts.show',$posts[0]) }}">
                                <h3 class="post-title left-align" style="font-size: 19pt">
                                    {{ $posts[0]->title }}
                                </h3>
                            </a>

                            <p class="left-align post-date"> {{ $posts[0]->published_date->toFormattedDateString() }}</p>
                        </article>
                    </div>
                    <hr>
                    <div class="row">
                        @for($i = 1; $i < 3; $i++)
                            @if(!empty($posts[$i]))
                                <article class="col s12 m6 {{ $i == 1 ? 'border-article-right' : '' }}">
                                    <div>
                                        <a  href="{{ route('posts.show',$posts[$i]) }}">
                                            <img class="responsive-img" src="/{{$posts[$i]->media->thumbnail_path}}" alt=" {{ $posts[$i]->media->display_name }}">
                                        </a>
                                    </div>
                                    <p class="category-{{$posts[$i]->category->style}}">{{$posts[$i]->category->display_name}}</p>
                                    <a  href="{{ route('posts.show',$posts[$i]) }}">
                                        <h3 class="post-title left-align">
                                            {{ $posts[$i]->title }}
                                        </h3>
                                    </a>
                                    <p class="left-align  post-date"> {{ $posts[$i]->published_date->toFormattedDateString() }}</p>

                                </article>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="col s12 m6 " style="margin-top: 2.1rem">
                    @for($i = 3; $i < 8; $i++)
                        @if(!empty($posts[$i]))
                            <div class="row">
                                <div class="photo-{{$posts[$i]->category->style}} col m5 offset-m1 no-padding fix-border-top" style="margin: 0  0 0 0.75rem">
                                    <a  href="{{ route('posts.show',$posts[$i]) }}">
                                        <img class="responsive-img" src="/{{$posts[$i]->media->thumbnail_path}}" alt=" {{ $posts[$i]->media->display_name }}">
                                    </a>
                                </div>
                                <article id="more-reads" class="texto col m6 no-padding no-padding-fix">
                                    <p class="category-{{$posts[$i]->category->style}}">{{$posts[$i]->category->display_name}}</p>
                                    <a  href="{{ route('posts.show',$posts[$i]) }}">
                                        <h3 class="flow-text post-title tit-ultimo" style="font-size: 16px">
                                            {{ $posts[$i]->title }}
                                        </h3>
                                    </a>
                                    <p class="left-align  post-date date"> {{ $posts[$i]->published_date->toFormattedDateString() }}</p>

                                </article>
                            </div>
                            <div class="row">
                                {!!  $i != 7 ? '<hr style="margin-bottom:10px;margin-left:15px" >' : '' !!}
                            </div>
                        @endif
                    @endfor
                </div>
            </div>

        </div>
    @endif

@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection

