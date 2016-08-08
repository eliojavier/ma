<div class="row">
    <div class="input-field col s12">
        <label for="email">Email</label>
        <input class="validate {{ $errors->has('email') ? ' has-error' : '' }}"
               id="login_email" type="email"
               name="email"
               value="{{ old('email') }}">
        @if ($errors->has('email'))
            <span class="has-error">{{ $errors->first('email') }}</span>
        @endif

    </div>

    <div class="input-field col s12">
        <label for="password">Contraseña</label>
        <input class="validate {{ $errors->has('password') ? ' has-error' : '' }}"
               id="login_password" type="password"
               name="password">
        @if ($errors->has('password'))
            <span class="has-error">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div class="input-field col s12">
        <input type="checkbox" id="remember" name="remember"/>
        <label for="remember">Recordarme</label>
    </div>
</div>
<div class="row">
    <div class="input-field col s12 center-align">
        <button type="submit" class="btn waves-effect waves-light">
            <i class="fa fa-btn fa-sign-in"></i> Ingresa
        </button>

        <a href="{{ url('/password/reset') }}" style="color: #646464; padding: 5px">
            ¿Olvidaste tu contraseña?
        </a>
    </div>
</div>

