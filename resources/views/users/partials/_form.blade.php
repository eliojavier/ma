<div class="row">
    <div class="input-field col m6 s12">
        <label for="first_name">Nombre</label>
        <input class="validate {{ $errors->has('first_name') ? ' has-error' : '' }}"
               id="first_name" type="text"
               name="first_name"
               value="{{ !empty($user) ?  $user->first_name : old('first_name') }}">
        @if ($errors->has('first_name'))
            <span class="has-error">{{ $errors->first('first_name') }}</span>
        @endif
    </div>
    <div class="input-field col m6 s12">
        <label for="last_name">Apellido</label>
        <input class="validate {{ $errors->has('last_name') ? ' has-error' : '' }}"
               id="last_name" type="text"
               name="last_name"
               value="{{ !empty($user) ?  $user->last_name : old('last_name') }}">
        @if ($errors->has('last_name'))
            <span class="has-error">{{ $errors->first('last_name') }}</span>
        @endif
    </div>

    <div class="input-field col m6 s12">
        <label for="email">Email</label>
        <input class="validate {{ $errors->has('email') ? ' has-error' : '' }}"
               id="email" type="email"
               name="email"
               value="{{ !empty($user) ?  $user->email : old('email') }}">
        @if ($errors->has('email'))
            <span class="has-error">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <div class="input-field col m6 s12">
        <label for="password">Contraseña</label>
        <input class="validate {{ $errors->has('password') ? ' has-error' : '' }}"
               id="password" type="password"
               name="password">
        @if ($errors->has('password'))
            <span class="has-error">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div class="input-field col m6 s12">
        <select id="roles" name="roles[]" multiple="multiple">
            <option value="" disabled selected>Roles</option>
            @foreach($roles as $rol)
                <option {{ !empty($user) && in_array($rol->id, $user->roles->lists('id')->toArray()) ? 'selected' : ''}} value="{{$rol->id}}">{{$rol->display_name}}</option>
            @endforeach
        </select>
        @if ($errors->has('roles'))
            <span class="has-error">{{ $errors->first('roles') }}</span>
        @endif
        <label class="hide">Seleccionar etiquetas</label>
    </div>
</div>
<div class="row">
    <div class="input-field col s12 center-align">
        <button type="submit" class="btn waves-effect waves-light">
            <i class="fa {{ !empty($icon) ? $icon : 'fa-plus' }}"></i> {{ $submitButtonText }}
        </button>
    </div>
</div>
