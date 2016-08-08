@extends('layouts.app')

@section('title', 'Términos y condiciones ')

@section('nav')
    @include('layouts.partials._nav',[
    'modal' => 'true'
    ])
@endsection

@section('content')
<div class="container" style="margin-top: 35px">
    <div class="row">
        <div class="col s12">
            <h1 class="center-align home-title text-motivapp-blue">TÉRMINOS Y CONDICIONES</h1>



            DESCRIPCIÓN DEL SERVICIO
            <p class="post-content text-justify">
                Este Sitio Web www.motiv-app.com (el “Sitio Web”) es
                operado por BEAR CREW, C.A. una compañía constituida
                de conformidad con las leyes de la República Bolivariana
                de Venezuela, debidamente registrada ante el Registro
                Mercantil Segundo de la Circunscripción Judicial del
                Distrito Federal y Estado Miranda; quedando anotada
                bajo el No 37, Tomo 354-A SDO con número de Registro
                de Información Fiscal R.I.F. J-406872091 (“LA EMPRESA”) y
                se encuentra a su disposición para fines informativos en
                el área de salud, bienestar, nutrición y crecimiento
                personal. Al acceder o utilizar este Sitio Web, usted
                acepta estos Términos y Condiciones de Uso.
            </p>

            DERECHOS DE PROPIEDAD INTELECTUAL
            <p class="post-content text-justify">
                Este Sitio Web (incluyendo todo su contenido) es
                propiedad de LA EMPRESA o de sus licenciantes y está
                protegido por leyes de derecho de autor, de propiedad
                industrial y otras leyes de la República Bolivariana de
                Venezuela. En este sentido, MOTIVAPP, www.motiv-
                app.com y todos y cada uno de los nombres en general
                que incluyan la palabra MOTIVAPP en su denominación,
                son marcas registradas propiedad de LA
                EMPRESA. Igualmente, el logotipo de MOTIVAPP está
                registrado y es propiedad de LA EMPRESA.
                Está estrictamente prohibido copiar, reproducir, publicar,
                transmitir o hacer llegar al público por cualquier otro
                medio los contenidos de este Sitio Web, excepto para uso
                personal. De la misma manera, no está permitido
                modificar, adaptar o crear un trabajo derivado de
                cualquier contenido encontrado en el Sitio Web.
            </p>

            EXCLUSIÓN DE GARANTÍAS Y RESPONSABILIDAD
            <p class="post-content text-justify">
                Todo el contenido del Sitio Web es a título de información
                general, y no debe ser considerado como un sustituto a la
                consulta médica brindada por los profesionales de la
                salud. En consecuencia, el Sitio Web no puede ser
                considerado responsable por diagnósticos elaborados a
                partir del contenido de este site. LA EMPRESA
                recomienda a los usuarios del Sitio Web, antes de iniciar
                algún cambio en la rutina diaria, asistir a una consulta
                médica. Asimismo, LA EMPRESA no garantiza que la
                información contenida en su web (textos, diseños,
                gráficos, etc.) sea en todo momento exacta o completa y
                no asume responsabilidad alguna derivada de los
                contenidos del Sitio Web ni de los servicios de cualquier
                índole de webs que se puedan enlazar electrónicamente
                a través de esta red. Asimismo, los usuarios del Sitio Web
                declaran ser mayores de edad (es decir, mayor de 18
                años) y que disponen de capacidad legal necesaria para
                utilizar los servicios ofrecidos a través del Sitio Web de
                conformidad con los presentes términos y condiciones,
                que comprenden y entienden en su totalidad.
            </p>


            POLÍTICAS DE USO DE LOS SERVICIOS
            <p class="post-content text-justify">
                LA EMPRESA se reserva del derecho de modificar el
                contenido de este Sitio Web en cualquier ocasión sin
                previo aviso. Asimismo, LA EMPRESA puede establecer en
                cualquier momento prácticas y políticas generales así
                como limitaciones concernientes a los SERVICIOS
                brindados por este Sitio Web.
            </p>

            PRIVACIDAD Y SEGURIDAD EN EL USO DEL SITIO WEB
            <p class="post-content text-justify">
                Las clases de datos personales que este Sitio Web puede
                recoger incluyen el nombre completo de la persona,
                domicilio, número de teléfono, y dirección de correo
                electrónico, así como otros datos no sensibles. LA
                EMPRESA no solicita información de tipo financiera ni
                bancaria.
                <br/>
                El ingreso de los datos personales implica el
                consentimiento de los usuarios a ceder sus datos y ser
                parte de la base de datos del Sitio Web. En consecuencia,
                quien provee los datos reconoce que proporciona sus
                datos en forma voluntaria y que los mismos son ciertos.
            </p>
            JURISDICCIÓN

            <p class="post-content text-justify">
                LA EMPRESA tiene sede en la República Bolivariana de
                Venezuela y este Sitio Web es operado en el país, por lo
                tanto será regido e interpretado de acuerdo con las leyes
                de la República Bolivariana de Venezuela, siendo la
                jurisdicción para ejercer cualquier acción para la
                ejecución de estos términos y condiciones los tribunales
                de la Ciudad de Caracas.
            </p>

        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection
