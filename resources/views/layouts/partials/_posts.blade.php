@foreach ($posts->chunk(3) as $set)
    <div class="row">
        @foreach ($set as $post)
            <article class="col s12 m4">
                <div>
                    <a  href="{{ route('posts.show',$post) }}">
                        <img class="responsive-img" src="/{{$post->media->thumbnail_path}}" alt=" {{ $post->media->display_name }}">
                    </a>
                </div>
                <p class="category-{{$post->category->style}}">{{$post->category->display_name}}</p>
                <a  href="{{ route('posts.show',$post) }}">
                    <h3 class="post-title left-align">
                        {{ $post->title }}
                    </h3>
                </a>
                <p class="left-align  post-date"> {{ $post->published_date->toFormattedDateString() }}</p>
            </article>
        @endforeach
    </div>
@endforeach



