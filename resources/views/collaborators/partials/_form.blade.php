<div class="row">
    <div class="input-field col s12">
        <label for="complete_name">Nombre</label>
        <input class="validate {{ $errors->has('complete_name') ? ' has-error' : '' }}"
               id="complete_name" type="text"
               name="complete_name"
               value="{{ !empty($collaborator) ?  $collaborator->complete_name : old('complete_name') }}">
        @if ($errors->has('complete_name'))
            <span class="has-error">{{ $errors->first('complete_name') }}</span>
        @endif
    </div>


    <div class="input-field col s12">
        <label for="bio">Biografía</label>
        <textarea id="bio" class="validate materialize-textarea {{ $errors->has('bio') ? ' has-error' : '' }}"  name="bio">{{!empty($collaborator) ? $collaborator->bio : old('bio')}}</textarea>

        @if ($errors->has('bio'))
            <span class="has-error">{{ $errors->first('bio') }}</span>
        @endif
    </div>

    <div class="input-field col s12">
        <select  id="category" name="category"><option value="" disabled selected>Categorías</option>
            @foreach($categories as $category)
                <option {{ !empty($collaborator) && $category->id == $collaborator->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->display_name}}</option>
            @endforeach
        </select>
        @if ($errors->has('category'))
            <span class="has-error">{{ $errors->first('category') }}</span>
        @endif
        <label class="hide">Categoría</label>
    </div>
    
</div>
<div class="row">
    <div class="input-field col s12 center-align">
        <button type="submit" class="btn waves-effect waves-light">
            <i class="fa {{ !empty($icon) ? $icon : 'fa-plus' }}"></i> {{ $submitButtonText }}
        </button>
    </div>
</div>
