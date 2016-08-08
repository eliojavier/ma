{{ csrf_field() }}
<div class="row">
    <div class="input-field col s12">
        <label for="display_name">Nombre</label>
        <input class="validate {{ $errors->has('display_name') ? ' has-error' : '' }}"
               id="title"
               type="text"
               name="display_name"
               value="{{  !empty($category) ?  $category->display_name : old('display_name') }}">
        @if ($errors->has('display_name'))
            <span class="has-error">{{ $errors->first('display_name') }}</span>
        @endif
    </div>
    <div class="input-field col s12">
        <label for="slug">Slug</label>
        <input class="validate {{ $errors->has('slug') ? ' has-error' : '' }}"
               id="slug" type="text"
               name="slug"
               placeholder="(por defecto es igual que el nombre)"
               value="{{ !empty($category) ?  $category->slug :old('slug') }}">
        @if ($errors->has('slug'))
            <span class="has-error">{{ $errors->first('slug') }}</span>
        @endif
    </div>
    <div class="input-field col s12">
        <label for="description">Description</label>
        <textarea class="validate materialize-textarea {{ $errors->has('description') ? ' has-error' : '' }}"  id="body" name="description">{{!empty($category) ? $category->description : old('description')}}</textarea>

        @if ($errors->has('description'))
            <span class="has-error">{{ $errors->first('description') }}</span>
        @endif
    </div>

    <div class="input-field col s12">
        <label for="style">Style</label>
        <input id="style" type="text"
               name="style"
               value="{{ !empty($category) ?  $category->style :old('slug') }}">
    </div>
</div>
<div class="row">
    <div class="input-field col s12 center-align">
        <button type="submit" class="btn waves-effect waves-light">
            <i class="fa {{ !empty($icon) ? $icon : 'fa-plus' }}"></i> {{ $submitButtonText }}
        </button>
    </div>
</div>