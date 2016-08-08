<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Motivapp | Perfil</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 50%;
            margin-top: 7px;
            width: 250px;
            height: 250px;
        }
        .cropit-preview img{
            border-radius: 50%;
        }
        .cropit-preview-image-container {
            cursor: move;
            border-radius:50%;
        }
        .image-size-label {
            margin-top: 10px;
        }
        input {
            display: block;
        }
        button[type="submit"] {
            margin-top: 10px;
        }
        .thumb{
            display: none;
        }

    </style>
</head>
<body>
<header>
    @include('layouts.partials._nav',['modal' => 'true'])
</header>

<main>
    <div id="profile" class="container">
        <div class="row">
            <div class="col s12 m6" style="margin-top:40px;">
                <div class="row">
                    <div class="col s12">
                        <div class="circle valign-wrapper centering outer-profile">
                            <div class="circle valing centering inner-profile" >
                                {!! $user->getProfileDisplay() !!}
                            </div>

                            <a href="#modal1" class="camera-icon modal-trigger"></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <p class="profile-name center-align" style="position: relative">
                            <span>
                                {!! $user->first_name ." ". $user->last_name !!}
                            </span>
                            <a id="password" href="#" style="position: absolute; padding-left: 10px">
                                <i class="material-icons" style="color:rgb(163,163,163);font-size: 25px;">mode_edit</i>
                            </a>
                        </p>

                        <p class="center-align email-display" style="clear: both">{!! $user->email !!}</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6" style="margin-top: 40px;">
                <div class="row">
                    <div class="col s6">
                        <h2 class="center-align flow-text">Intereses</h2>
                    </div>
                    <div class="col s6">
                        <div class="circle valign-wrapper outer-small">
                            <a id="show-tags" class="btn-floating valing centering  btn-large waves-effect waves-light blue-button">
                                <i class="fa fa-cog" style="line-height: 50px !important;" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @if(count($user->tags) > 0)
                    @foreach($user->tags as $tag)
                        <div data-id="{{$tag->id}}" class="saved chip profile-chip">
                            {{ $tag->display_name }}
                        </div>
                    @endforeach
                @else
                    <p class="no-tags-text left-align">
                        Selecciona tus intereses y <br/> personaliza tu experiencia.<br/>
                        Los contenidos de <br/>Motivapp serán filtrados<br/> de acuerdo los temas que <br/> decidas agregar.
                    </p>
                @endif


            </div>
        </div>
        <hr>
        <div id="password-form" class="row" style="display: none">
            <div class="col m1 s3">
                <div class="circle valign-wrapper outer-small">
                    <a id="show-tags" class="btn-floating valing centering  btn-large waves-effect waves-light blue-button">
                        <i class="icon-key-main" style="line-height: 50px !important;"></i>

                    </a>
                </div>
            </div>
            <div class="col s7 m11">
                <h2 style="color: #565656; font-size: 14pt">Cambiar contraseña</h2>

            </div>
            <div class="col s12">
                <form id="change-password" role="form" action="#">
                    <div class="row">

                        <div class="input-field col m4 s12">
                            <label for="old_password">Contraseña anterior</label>
                            <input class="validate {{ $errors->has('old_password') ? ' has-error' : '' }}"
                                   id="old_password" type="password"
                                   name="old_password">
                            @if ($errors->has('password'))
                                <span class="has-error">{{ $errors->first('old_password') }}</span>
                            @endif
                        </div>

                        <div class="input-field col m4 s12">
                            <label for="password">Contraseña</label>
                            <input class="validate {{ $errors->has('password') ? ' has-error' : '' }}"
                                   id="password" type="password"
                                   name="password">
                            @if ($errors->has('password'))
                                <span class="has-error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="input-field col m4 s12 login-text">
                            <label for="password_confirmation">Confirmar contraseña</label>
                            <input class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}"
                                   id="password_confirmation"
                                   type="password"
                                   name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                                <span class="has-error">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s4">
                            <p id="form-response"></p>
                        </div>
                        <div class="input-field col s8 right-align">
                            <button type="submit" class="btn waves-effect waves-light" style="text-transform: none">
                               Restablecer Contraseña
                            </button>
                        </div>
                    </div>

                </form>{{-- End form--}}
                <hr>

            </div>
        </div>
        <!-- --->
        <div class="row" style="margin-bottom: 35px">
            <div class="col s6 m3">
                <!-- Promo Content 1 goes here -->
                <div style="display: inline-block" id="health-percentage"></div>​
                <p class="title-percentage text-motivapp-green center-align" style="margin: 0">SALUD</p>
            </div>
            <div class="col s6 m3">
                <!-- Promo Content 2 goes here -->
                <div style="display: inline-block" id="nutrition-percentage"></div>​
                <p class="title-percentage text-motivapp-red center-align" style="margin: 0">NUTRICIÓN</p>

            </div>
            <div class="col s6 m3">
                <!-- Promo Content 3 goes here -->
                <div style="display: inline-block" id="pg-percentage"></div>​
                <p class="title-percentage text-motivapp-purple center-align" style="margin: 0">CRECIMIENTO PERSONAL</p>

            </div>
            <div class="col s6 m3">
                <!-- Promo Content 1 goes here -->
                <div style="display: inline-block" id="activity-percentage"></div>​
                <p class="title-percentage text-motivapp-blue center-align" style="margin: 0">ACTIVIDAD FÍSICA</p>
            </div>

        </div>
        <div id="tags" class="row">
            <br>
            <div class="col s10 offset-s1 center-align">
                <div class="col s10 offset-s1">
                    @foreach($tags as $tag)
                        <div data-id="{{$tag->id}}" class="all chip profile-chip">
                            {{ $tag->display_name }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col s12 valign-wrapper" style="min-height: 300px" >
                <div class="circle valing valign-wrapper centering outer-medium" >
                    <a id="done" class="btn-floating valing centering  btn-large waves-effect waves-light blue-button-2">
                        LISTO
                    </a>

                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    @include('layouts.partials._footer',['footerClass' => 'footer'])
</footer>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <div class="row">
            <form id="profilePicture" action="#">
                {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

                <div class="image-editor">

                    <div class="col m6 s12">
                        <input type="file" name="file" class="cropit-image-input">
                        <div class="cropit-preview centering"></div>
                    </div>

                    <div class="col m6 s12">
                        <div class="image-size-label">
                            Ajustar tamaño
                        </div>
                        <input type="range" class="cropit-image-zoom-input">
                        <input type="hidden" name="image-data" class="hidden-image-data" />
                        <button type="submit" class="btn">Subir Imagen</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
    <hr>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>
<!-- Modal Structure -->
<div id="login-modal" class="modal">
    <div class="modal-header right-align">
        <a href="#!" class="modal-action modal-close btn-floating waves-effect waves-light"
           style="margin: 10px 10px 0 0">
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="col s8 offset-m2">
                <a href="{{ url('/login/facebook') }}" class="btn waves-effect waves-light col s12 facebook-button">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    Ingresa con tu cuenta de Facebook
                </a>
            </div>
        </div>
        <div class="row" style="margin-bottom: 0">
            <div class="col s12 m12">
                <form class="card-panel hoverable" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    @include('auth.partials._login')
                </form>
            </div>
        </div>
    </div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="{{asset('js/profile.js')}}"></script>
<script src="{{asset('js/jquery.cropit.js')}}"></script>
<script>
    $( document ).ready(function() {

        $("#health-percentage").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 8,
            backgroundBorderWidth: 15,
            foregroundColor: 'rgba(138,207,5,0.4)',
            fontColor: '#fff',
            fillColor: '#8acf05',
            percent: "{{ $healthTotal }}",
            text: 'S'
        });

        $("#nutrition-percentage").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 8,
            backgroundBorderWidth: 15,
            foregroundColor: 'rgba(229, 64, 40, 0.7)',
            fontColor: '#fff',
            fillColor: '#e54028',
            percent:"{{ $nutritionTotal }}",
            text: 'N'
        });

        $("#pg-percentage").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 8,
            backgroundBorderWidth: 15,
            foregroundColor: 'rgba(86, 75, 152, 0.8)',
            fontColor: '#fff',
            fillColor: '#564b98',
            percent: "{{$pgTotal}}",
            text: 'CP'
        });

        $("#activity-percentage").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 8,
            backgroundBorderWidth: 15,
            foregroundColor: 'rgba(0, 174, 239, 0.8)',
            fontColor: '#fff',
            fillColor: '#00aeef',
            percent: "{{$activityTotal}}",
            text: 'AF'
        });
    });

    // Load profile image

    $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                }
            });
    $(function() {
        $('.image-editor').cropit();
        $('#profilePicture').submit(function(e) {
            e.preventDefault();
            // Move cropped image data to hidden input
            var imageData = $('.image-editor').cropit('export');
            $('.hidden-image-data').val(imageData);
            var formData = new FormData($('#profilePicture')[0]);
            console.log(formData);
            $.ajax({
                url: "{{ route('addAvatar') }}",
                type: "POST",
                data:formData,
                processData: false,
                contentType: false,
                success: function(data){
                    location.reload();
//                    console.log(data);
                }
            });
            // Prevent the form from actually submitting
            return false;
        });
    });


    $('.all').click(function(){
        var $this = $(this);
        console.log($this.data('id'));
        $.ajax({
            url: "{{ route('add.tags') }}",
            type: "POST",
            data:{id: $this.data('id')},
            success: function(data){
                location.reload();
            }
        });
    });

    $('.saved').click(function(){
        var $this = $(this);
        console.log($this.data('id'));
        $.ajax({
            url: "{{ route('remove.tags') }}",
            type: "POST",
            data:{id: $this.data('id')},
            success: function(data){
                location.reload();
            }
        });
    });

    $("#show-tags").click(function(e){
        e.preventDefault();
        $("#tags").show(function(){
            $("html, body").animate({ scrollTop: $('#tags').offset().top - 100 }, 2000);
        });
    });

    $("#done").click(function(e){
        e.preventDefault();
        $("#tags").hide(function(){
            $("html, body").animate({ scrollTop: 0 }, 2000);
        });
        return false;
    });

    $("#password").click(function(e){
        e.preventDefault();
        $("#password-form").slideToggle( "slow");
    });

    $('#change-password').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('change.password') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(data){
                console.log(data);
                $('#form-response').removeClass('has-error').addClass('success');
                $('#form-response').text(data);
            },
            error: function(data){
                var errors = data.responseJSON;
                var $message = '';

                if(errors !== undefined)
                {
                    $.each(errors.errors, function(k, v) {
                        console.log(k + ' ' + v);
                        $message = $message + ' ' + v;
                    });
                }

                $('#form-response').removeClass('success').addClass('has-error');
                $('#form-response').text($message);
            }
        });
        // Prevent the form from actually submitting
        return false;
    });
</script>

</body>
</html>
