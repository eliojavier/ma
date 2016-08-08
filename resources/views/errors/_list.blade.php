@if (count($errors) > 0)
    <div class="red-text">
        <p/><strong>Ups!</strong> Hubo un problema con tus datos.</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif