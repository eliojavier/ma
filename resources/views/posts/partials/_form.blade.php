{{ csrf_field() }}
<div class="row">
    <div class="col s8">
        <div class="input-field col s9">
            <select  id="slider" name="slider"><option value="" disabled selected>Asignar Slider</option>
                @foreach($slider as $slide)
                    <option {{ !empty($post->slider) && $slide->id == $post->slider->id ? 'selected' : '' }} value="{{$slide->id}}">{{$slide->name}}</option>
                @endforeach
                <option value="dettach">[Quitar Slider]</option>
            </select>
        </div>
        <div class="input-field col s3 center-align">
            <a href="{{url('admin/slider')}}" target="_blank">
                <i class="fa fa-plus"></i>
                Nuevo Slider
            </a>
        </div>
        <div class="input-field col s12">
            <label for="title">Titulo</label>
            <input class="validate {{ $errors->has('title') ? ' has-error' : '' }}"
                   id="title" type="text"
                   name="title"
                   value="{{  !empty($post) ?  $post->title : old('title') }}">
            @if ($errors->has('title'))
                <span class="has-error">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="input-field col s12">
            <label for="body" class="hide">Contenido</label>
            <textarea id="body" class="validate materialize-textarea {{ $errors->has('body') ? ' has-error' : '' }}"  name="body">{{!empty($post) ? $post->body : old('body')}}</textarea>

            @if ($errors->has('body'))
                <span class="has-error">{{ $errors->first('body') }}</span>
            @endif
        </div>
        <div class="input-field col s12">
            <label for="slug">Slug</label>
            <input class="validate {{ $errors->has('slug') ? ' has-error' : '' }}"
                   id="slug" type="text"
                   name="slug"
                   placeholder="(por defecto es igual que el titulo)"
                   value="{{ !empty($post) ?  $post->slug :old('slug') }}">
            @if ($errors->has('slug'))
                <span class="has-error">{{ $errors->first('slug') }}</span>
            @endif
        </div>
        <div class="input-field col s12">
            <label for="author">Autor</label>
            <input class="validate {{ $errors->has('author') ? ' has-error' : '' }}"
                   id="author" type="text"
                   name="author"
                   value="{{ !empty($post) ? $post->author : old('author') }}">
            @if ($errors->has('author'))
                <span class="has-error">{{ $errors->first('author') }}</span>
            @endif
        </div>
        <div class="file-field input-field col s12">
            <div class="row center-align">
                <img class="responsive-img" src="/{{ !empty($post) && !empty($post->media->thumbnail_path)? $post->media->thumbnail_path : '' }}" alt="">
            </div>
            <div class="btn">
                <span>Imagen destacada</span>

                <input type="file" name="picture" id="picture" >
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
            <p>Tamaño recomendado (1000px x 500px) </p>

        </div>
    </div>
    <div class="col s4">
        <div class="input-field col s12">
            Visibilidad:
            <p>
                <input class="with-gap" id="public" name="visibility" type="radio" value="1" checked/>
                <label for="public">Público</label>
            </p>
            <p>
                <input class="with-gap" id="private" name="visibility" type="radio" value="0"
                    {{ !empty($post) && $post->visibility == 0 ? 'checked' : '' }}/>
                <label for="private">Ocultar</label>
            </p>

        </div>
        <div class="input-field col s12" style="margin-top: 40px;">
            <label for="published_date">Publicar</label>
            <br/>
            <input type="date"
                   id="published_date"
                   name="published_date"
                   value="{{ !empty($post) ? $post->published_date->format('d-m-Y') : Carbon\Carbon::now()->format('d-m-Y') }}">
        </div>
        <div class="input-field col s12">
            <select  id="category" name="category"><option value="" disabled selected>Categorías</option>
                @foreach($categories as $category)
                    <option {{ !empty($post) && $category->id == $post->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->display_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('category'))
                <span class="has-error">{{ $errors->first('category') }}</span>
            @endif
            <label class="hide">Categoría</label>
        </div>
        <div class="input-field col s12">
            <select id="tags" name="tags[]" multiple="multiple">
                <option value="" disabled selected>Etiquetas</option>
                @foreach($tags as $tag)
                    <option {{ !empty($post) && in_array($tag->id, $post->getTagListAttribute()->toArray()) ? 'selected' : ''}} value="{{$tag->id}}">{{$tag->display_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('tags'))
                <span class="has-error">{{ $errors->first('tags') }}</span>
            @endif
            <label class="hide">Seleccionar etiquetas</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="input-field col s12 center-align">
        <button type="submit" class="btn waves-effect waves-light">
            <i class="fa {{ !empty($icon) ? $icon : 'fa-plus' }}"></i> {{ $submitButtonText }}
        </button>
    </div>
</div>