{{ csrf_field() }}
<div class="row">
    <div class="input-field col s12">
        <select  id="category" name="category">
            <option value="" disabled selected>Categorías</option>
            @foreach($categories as $category)
                <option {{ !empty($tag) && $category->id == $tag->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->display_name}}</option>
            @endforeach
        </select>
        <label>Categoría</label>
        @if ($errors->has('category'))
            <span class="has-error">{{ $errors->first('category') }}</span>
        @endif
    </div>

    <div class="input-field col s12">
        <label for="display_name">Nombre</label>
        <input class="validate {{ $errors->has('display_name') ? ' has-error' : '' }}"
               id="title"
               type="text"
               name="display_name"
               value="{{  !empty($tag) ?  $tag->display_name : old('display_name') }}">
        @if ($errors->has('display_name'))
            <span class="has-error">{{ $errors->first('display_name') }}</span>
        @endif
    </div>
    <div class="input-field col s12">
        <label for="slug">Slug</label>
        <input class="validate {{ $errors->has('slug') ? ' has-error' : '' }}"
               id="slug" type="text"
               name="slug"
               placeholder="(por defecto es igual que el Nombre)"
               value="{{ !empty($tag) ?  $tag->slug :old('slug') }}">
        @if ($errors->has('slug'))
            <span class="has-error">{{ $errors->first('slug') }}</span>
        @endif
    </div>

</div>
<div class="row">
    <div class="input-field col s12 center-align">
        <button type="submit" class="btn waves-effect waves-light">
            <i class="fa {{ !empty($icon) ? $icon : 'fa-plus' }}"></i> {{ $submitButtonText }}
        </button>
    </div>
</div>