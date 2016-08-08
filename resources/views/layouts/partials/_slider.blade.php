<ul class="slick-carousel" style="margin-top: 0;position: relative">
    @foreach($slider->images as $slide)
        <li>
            <img  src="/{{$slide->path}}" alt="" width="100%">
            @if(!empty($slide->caption))
                <div class="slide-caption">
                    {!! html_entity_decode($slide->caption) !!}
                </div>
            @endif
        </li>
    @endforeach
</ul>