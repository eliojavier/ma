<ul class="slick-carousel" style="margin-top: 0;position: relative">

    {{--@foreach($slider as $slide)--}}
        {{--<li>--}}
            {{--<img  src="/{{$slide->media->path}}" alt="" width="100%">--}}
            {{--<a href="{{ route('posts.show',$slide) }}">--}}
                {{--<div class="slide-caption">--}}
                    {{--<p class="category-{{$slide->category->style}}" style="font-size: 12px!important;">{{$slide->category->display_name}}</p>--}}

                    {{--<h1>{{ $slide->title }}</h1>--}}
                    {{--<p class="post-date">{{ $slide->published_date->toFormattedDateString() }}</p>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</li>--}}
    {{--@endforeach--}}

</ul>