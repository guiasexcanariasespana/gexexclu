<x-registro-layout>

    <section>

        <div class="px-4 py-48 mx-auto max-w-screen-5xl xs:h-screen lg:items-center lg:flex bg-violet-400 ">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-8xl tracking-tight font-black text-transparent  text-pink-700">
                    {{ __('Empieza a crear tu Anuncio') }} </h2>

                <span class="text-3xl text-pink-600 sm:block ">
                    {{ __('Complete todos los pasos') }}
                </span>


                <p class="max-w-xl mx-auto mt-4 lg:text-xs sm:leading-relaxed sm:text-xs">
                    La ley APROBADA del 'Sí es Sí' el 25/08/2022 entrará en vigor a los 30 días de su publicación en el
                    BOE, prohíbe la publicidad de prostitución y la promoción de esta, también la que denigre a la
                    mujer. Cumpliendo la ley, NO se pueden publicar perfiles nuevos con textos que ofrezcan servicios
                    sexuales por dinero o sin dinero, tampoco perfiles que desprendan carácter sexual en fotos, es decir
                    nada de fotos con desnudos ni ropa interior, ni en camas ni habitaciones. Los perfiles ya publicados
                    deberán adaptarse a la nueva normativa al vencimiento o antes del 01 de Octubre. A partir de hoy
                    guiasexcanarias.com es una web para conocer gente y tener amigos de forma remunerada. Se pueden
                    publicar perfiles personales para conocer gente, en ellos puedes explicar: cómo eres físicamente,
                    cómo es tu carácter, lo que gusta hacer, tus aficiones y gustos etc. Podrás publicar tus tarifas
                    porque tu amistad es remunerada. No dejes todo para último momento, en guiasexcanarias.com nos
                    adaptamos a la nueva normativa y ofrecemos tu compañía ideal para vivir momentos de la vida
                    compartidos.</p>

            </div>
        </div>

        <div
            class="px-4 py-6 mx-auto max-w-screen-xl xs:h-screen lg:items-center lg:flex bg-gray-100 opacity-90 z-0 rounded-lg -mt-20">



            <!-- Guardar en Anuncio   -->
            <form class="mx-auto" method="POST" action="{{ route('guardar_anuncio') }}" role="form"
                enctype="multipart/form-data">
                @csrf
                <div class="card w-full bg-base-100 shadow-xl mb-5">
                    <div class="card-body">
                        <div class="card-actions justify-start">
                            <p class="text-pink-700 font-extrabold text-3xl">
                                {{ __('  Hola ! Queremos saber acerca de ti.. ') }}
                            </p>
                        </div>
                        <p>
                            <textarea name="presentacion" value="presentacion" class="textarea textarea-secondary w-full"
                                placeholder="Escribe una pequeña reseña sobre ti"></textarea>
                        </p>
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-5">



                    <div class="card w-96  bg-white shadow-xl">
                        <figure><img src="img/card-titulo.jpeg" alt="bg_titulo" /></figure>
                        <div class="card-body">
                            <h2 class="card-title text-pink-700 font-black">
                                {{ __('Nombre, Título y Tarifa') }}
                                <div class="badge badge-secondary">Anuncio</div>
                            </h2>
                            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                            <input type="text" id="nombre" name="nombre" placeholder="nombre de anuncio"
                                class="input input-bordered" value="{{ old('nombre', $anuncio->nombre) }}" />
                           {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
                                <input type="text" id="titulo" name="titulo" placeholder="Titulo de anuncio"
                                class="input input-bordered" />
                            {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
                            {!! Form::text('tarifa', $anuncio->tarifa, [
                                'class' => 'input input-bordered' . ($errors->has('tarifa') ? ' is-invalid' : ''),
                                'placeholder' => 'tarifa',
                            ]) !!}
                            {!! $errors->first('edad', '<div class="invalid-feedback">:message</div>') !!}
                            {!! Form::number('edad', $anuncio->edad, [
                                'class' => 'input input-bordered' . ($errors->has('edad') ? ' is-invalid' : ''),
                                'placeholder' => 'edad',
                            ]) !!}
                            {!! $errors->first('tarifa', '<div class="invalid-feedback">:message</div>') !!}

                            <input type="hidden" id="slug" name="slug" placeholder="slug"
                                class="input input-bordered input-pink-500 " />
                            <p>Ingrese el nombre, el título <strong>(Max 25 caract)</strong> de anuncio que será
                                publicado </p>

                            <div class="card-actions justify-end">
                                <div class="badge badge-outline">{{ __('Paso 1') }}</div>

                            </div>
                        </div>
                    </div>

                    <div class="card w-96 bg-white shadow-xl">
                        <img src="img/card-eres.jpeg" alt="bg_titulo" />
                        <div class="card-body">
                            <h2 class="card-title  text-pink-700 font-black">
                                {{ __('¿ Tu eres ?') }}
                                <div class="badge badge-secondary">Género/Identidad</div>
                            </h2>
                            <label class="mr-2">
                                {!! Form::radio(
                                    'orientacion',
                                    'Heterosexual',
                                    $anuncio->orientacion == '' ? true : $anuncio->orientacion == 'Heterosexual',
                                    ['onclick' => 'yesnoCheck()'],
                                ) !!}
                                Heterosexual
                            </label>
                            <label class="mr-2">
                                {!! Form::radio('orientacion', 'Bisexual', $anuncio->orientacion == 'Bisexual', ['onclick' => 'yesnoCheck()']) !!}
                                Bisexual
                            </label>
                            <label class="mr-2">
                                {!! Form::radio('orientacion', 'Homosexual', $anuncio->orientacion == 'Homosexual', [
                                    'onclick' => 'yesnoCheck()',
                                ]) !!}
                                Homosexual
                            </label>

                            <label class="mr-2">
                                {!! Form::radio(
                                    'orientacion',
                                    'Otra',
                                
                                    $anuncio->orientacion == 'Otra',
                                    ['id' => 'otra', 'onclick' => 'yesnoCheck()'],
                                ) !!}
                                Otra

                            </label>
                            <input style="visibility:hidden;" type="text" id="orientacion_otra"
                                name="orientacion_otra" placeholder="aclaranos tu orientación sexual"
                                class="input input-bordered" />
                            <p>Seleccione el género/indentidad que será visible en el anuncio</p>
                            <div class="card-actions justify-end">
                                <div class="badge badge-outline">{{ __('Paso 2') }}</div>

                            </div>
                        </div>
                    </div>



                </div>
                @php
                    $muni = null;
                    if (!is_null($anuncio->zone_id)) {
                        $muni = $anuncio->zone->municipio_id;
                    }
                @endphp
                @livewire('planes-component', [
                    'selectedMuni' => $muni,
                    'selectedZone' => $anuncio->zone_id,
                    'selectedPlane' => $anuncio->plane_id,
                    'selectedCategoria' => $anuncio->categoria_id,
                    'precio' => $anuncio->precio,
                    'dias' => $anuncio->dias,
                    'tipo' => 'Normal',
                ])

                <div class="grid lg:grid-cols-2 gap-5 mt-5">
                    <div class="card w-96  bg-white shadow-xl">
                        <figure><img src="img/card-titulo.jpeg" alt="bg_titulo" /></figure>
                        <div class="card-body">
                            <h2 class="card-title text-pink-700 font-black">
                                {{ __('Exterior') }}
                                <div class="badge badge-secondary">Gustos</div>
                            </h2>
                            <p>Selecciona que actividades te gustan</p>

                            @foreach ($tag_al as $tag)
                                <label class="mr-2">
                                    {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                    {{ $tag->nombre }}<br>
                                </label>
                            @endforeach
                            @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card w-96 bg-white shadow-xl ">
                        <img src="img/card-eres.jpeg" alt="bg_titulo" />
                        <div class="card-body">
                            <h2 class="card-title text-pink-700 font-black">
                                {{ __('Interior') }}
                                <div class="badge badge-secondary">Gustos</div>
                            </h2>
                            <p>Selecciona que actividades te gustan</p>

                            @foreach ($tag_in as $tag)
                                <label class="mr-2">
                                    {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                    {{ $tag->nombre }}<br>
                                </label>
                            @endforeach

                            @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 gap-5 mt-5">
                    <div class="card w-96  bg-white shadow-xl">
                        <figure><img src="img/card-titulo.jpeg" alt="bg_titulo" /></figure>
                        <div class="card-body">
                            <h2 class="card-title text-pink-700 font-black">
                                {{ __('En Casa') }}
                                <div class="badge badge-secondary">Gustos</div>
                            </h2>
                            <p>Selecciona que actividades te gustan</p>

                            @foreach ($tag_ec as $tag)
                                <label class="mr-2">
                                    {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                    {{ $tag->nombre }}<br>
                                </label>
                            @endforeach
                            @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card w-96 bg-white shadow-xl">
                        <img src="img/card-eres.jpeg" alt="bg_titulo" />
                        <div class="card-body">
                            <h2 class="card-title text-pink-700 font-black">
                                {{ __('En Tu Casa') }}
                                <div class="badge badge-secondary">Gustos</div>
                            </h2>
                            <p>Selecciona que actividades te gustan</p>

                            @foreach ($tag_etc as $tag)
                                <label class="mr-2">
                                    {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                    {{ $tag->nombre }}<br>
                                </label>
                            @endforeach

                            @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="grid lg:grid-cols-2 gap-5 mt-5">



                    <div class="card w-96  bg-white shadow-xl">

                        <div class="card-body">
                            <h2 class="card-title text-pink-700 font-black">
                                {{ __('Mostrar Teléfono') }}
                                <div class="badge badge-secondary">Anuncio</div>
                            </h2>
                            <label class="mr-2">
                                {!! Form::radio(
                                    'mostrar_telefono',
                                    'No',
                                    $anuncio->mostrar_telefono == '' ? true : $anuncio->mostrar_telefono == 'No',
                                ) !!}
                                No
                            </label>
                            <label class="mr-2">
                                {!! Form::radio('mostrar_telefono', 'Si', $anuncio->mostrar_telefono == 'Si') !!}
                                Si
                            </label>
                            @error('mostrar_telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <p>Permites mostrar tu número de teléfono en el anuncio?</p>

                            <div class="card-actions justify-end">


                            </div>
                        </div>
                    </div>

                    <div class="card w-96 bg-white shadow-xl">

                        <div class="card-body">
                            <h2 class="card-title  text-pink-700 font-black">
                                {{ __('¿ Whatsapp ?') }}
                                <div class="badge badge-secondary">Whatsapp</div>
                            </h2>
                            <label class="mr-2">
                {!! Form::radio(
                    'whatsapp',
                    'No',
                    $anuncio->whatsapp == '' ? true : $anuncio->whatsapp == 'No',
                ) !!}
                No
            </label>
            <label class="mr-2">
                {!! Form::radio(
                    'whatsapp',
                    'Si',
                   $anuncio->whatsapp == 'Si',
                ) !!}
                Si
            </label>
            @error('whatsapp')
                <span class="text-danger">{{ $message }}</span>
            @enderror

                            <p>Admites contactos por Whatsapp</p>
                            <div class="card-actions justify-end">

                            </div>
                        </div>
                    </div>



                </div>


                <div>

                    <button type="submit"
                        class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                        href="">
                        {{ __('Continuar y Pagar Anuncio') }}
                    </button>
                </div>

            </form>






        </div>


    </section>




</x-registro-layout>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $("#nombre").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });
    });
</script>

<script>
    function yesnoCheck() {

        if (document.getElementById('otra').checked) {
            document.getElementById('orientacion_otra').style = 'display:block';
        } else document.getElementById('orientacion_otra').style = 'display:none';

    }
</script>
