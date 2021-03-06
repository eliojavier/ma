<div class="row">
    <div class="col m6 offset-m3 s10 offset-s1">
        <div class="row">
            <div class="col s12 center-align">
                <h2 style="font-size: 24px">Servicio Empresarial MOTIVAPP</h2>
                <h2>¡Sí te puedes SENTIR BIEN!</h2>
            </div>
        </div>
        {{-- Register form --}}
        <form class="login-form card-panel hoverable" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col m6 s12">
                    <label for="first_name_en">Nombre</label>
                    <input class="validate {{ $errors->has('first_name') ? ' has-error' : '' }}"
                           id="first_name_en" type="text"
                           name="first_name"
                           value="{{ old('first_name') }}">
                    @if ($errors->has('first_name'))
                        <span class="has-error">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="input-field col m6 s12">
                    <label for="last_name_en">Apellido</label>
                    <input class="validate {{ $errors->has('last_name') ? ' has-error' : '' }}"
                           id="last_name_en" type="text"
                           name="last_name"
                           value="{{ old('last_name') }}">
                    @if ($errors->has('last_name'))
                        <span class="has-error">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>

                <div class="input-field col m6 s12">
                    <label for="email_en">Email</label>
                    <input class="validate {{ $errors->has('email') ? ' has-error' : '' }}"
                           id="email_en" type="email"
                           name="email"
                           value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="has-error">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="input-field col m6 s12">
                    <label for="document_en">Cedula</label>
                    <input class="validate {{ $errors->has('document') || $errors->has('invalid_document') ? ' has-error' : '' }}"
                           id="document_en" type="text"
                           name="document"
                           value="{{ old('document') }}">
                    @if ($errors->has('document') || $errors->has('invalid_document') )
                        <span class="has-error">{{ $errors->first('document') }}</span>
                        <span class="has-error">{{ $errors->first('invalid_document') }}</span>

                    @endif
                </div>

                <div class="input-field col m6 s12">
                    <label for="password_en">Contraseña</label>
                    <input class="validate {{ $errors->has('password') ? ' has-error' : '' }}"
                           id="password_en" type="password"
                           name="password">
                    @if ($errors->has('password'))
                        <span class="has-error">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="input-field col m6 s12 login-text">
                    <label for="password_confirmation_en">Confirmar</label>
                     <input class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}"
                           id="password_confirmation_en"
                           type="password"
                           name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="has-error">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="input-field col s12">
                    <input type="checkbox" id="newsletter_en" name="newsletter"/>
                    <label for="newsletter_en">Si, agrégame a tu lista de correos.</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 center-align">
                    <button type="submit" class="btn waves-effect waves-light width-100p">
                        <i class="fa fa-btn fa-user"></i> Registrarse
                    </button>
                </div>
            </div>
        </form>{{-- End form--}}
    </div>
</div>
<div class="row">
    <div class="col s12">
        <p class="center-align">
            Al continuar, estás aceptando los
            <a class="terms-and-policy-link" target="_blank" href="{{route('terms-and-conditions')}}">Términos y condiciones</a> y las
            <span class="terms-and-policy-link"> Políticas de Privacidad</span>
        </p>
    </div>
</div>