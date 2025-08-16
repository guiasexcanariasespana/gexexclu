<div class="w-full mx-auto">



    <div class=" w-full my-5 p-5 mx-auto">

        <span class="text-3xl text-pink-600 sm:block ">
            {{ __('Formulario de compra de anuncio') }}
        </span>
    <div class="my-4 bg-white rounded overflow-hidden p-4 ">


            {!! Form::label('categoria_id', 'Categoria') !!}
            {!! Form::select('categoria_id', $categorias, $selectedCategoria, [
                'wire:model' => 'selectedCategoria',
                'class' => 'form-control',
                'required',
            ]) !!}


        @error('categoria_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <p class="font-bold">Seleccione Categoría que será visible en el anuncio</p>
    </div>
    <div class="my-4 bg-white rounded overflow-hidden p-4 ">

                {!! Form::label('provincia_id', 'Provincia') !!}
                <select name='provincia_id' id='provincia_id' required wire:model='selectedProvincia'
                    class='form-control'>
                    <option value=""></option>

            @foreach ($provincias as $provincia)
                <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
            @endforeach
            </select>

            @error('provincia_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <p class="font-bold">Seleccione una Provincia que será visible en el anuncio</p>
    </div>

    <div class="my-4 bg-white rounded overflow-hidden p-4 ">

            {!! Form::label('municipio_id', 'Municipio') !!}
            <select name='municipio_id' required id='municipio_id' wire:model='selectedMuni'
                class='form-control'>
                <option value=""></option>
                @foreach ($municipios as $municipio)
                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                @endforeach
            </select>

        @error('municipio_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <p class="font-bold">Seleccione un Municipio que será visible en el anuncio</p>

    </div>


    <div class="my-4 bg-white rounded overflow-hidden p-4 ">
        <label class="mr-2">
            {{ Form::label('localidad') }}
            {{ Form::text('localidad', null, ['wire:model' => 'localidad', 'required', 'class' => 'form-control' . ($errors->has('localidad') ? ' is-invalid' : ''), 'placeholder' => 'Localidad']) }}
            {!! $errors->first('localidad', '<div class="invalid-feedback">:message</div>') !!}
            <p class="font-bold">Seleccione una Zona que será visible en el anuncio</p>

    </div>





            <div class="my-4 bg-white rounded-xl overflow-hidden p-4">
                <div class="font-bold text-3xl inline ">
                    {{ Form::label('Plan') }}
                    {{-- {{ $plan_nombre }} --}}
                    {{-- {{ Form::hidden('plane_id', $selectedPlane, ['wire:model' => 'selectedPlane', 'class' => 'form-control' . ($errors->has('selectedPlane') ? ' is-invalid' : ''), 'placeholder' => 'selectedPlane']) }} --}}
                    {{ Form::select('plane_id', $planes, $selectedPlane, ['wire:model' => 'selectedPlane', 'class' => 'form-control' . ($errors->has('plane_id') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('plane_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="font-bold text-3xl inline text-red-700">
                    {{ Form::label('Precio', 'Precio €: ' . $precio) }}
                    {{ Form::hidden('precio', $precio, ['wire:model' => 'precio', 'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                    {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="font-bold text-3xl inline">
                    {{ Form::label('Días', 'Días: ' . $dias) }}
                    {{ Form::hidden('dias', $dias, ['wire:model' => 'dias', 'class' => 'form-control' . ($errors->has('dias') ? ' is-invalid' : ''), 'placeholder' => 'dias']) }}
                    {!! $errors->first('dias', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>



    </div>


    {!! Form::textarea('presentacion_aux', old('presentacion_aux'), [
        'class' => 'textarea textarea-bordered w-full',
        'id' => 'presentacion_aux',
        'onChange' => 'recordar_cambios();',
        'maxlength' => 2500,
        'minlength' => 250,
        'placeholder' => 'Escribe una pequeña reseña sobre ti',
        'wire:model' => 'presentacion_aux',
    ]) !!}

    <p class="font-bold my-2 ml-10"> Mín 250 - Max 2500. Tiene:
        <span id='long_desc'>
            {{ strlen($presentacion_aux) }}
        </span> Restan:
        <span id='long_rest_desc'>
            {{ 2500 - strlen($presentacion_aux) }}
        </span>
        caract.
    <p class="text-[#bb1a19] px-6 py-2 my-2 ml-9" id='malaspalabras'> </p>
    @error('presentacion_aux')
        <span class="text-red-700">{{ $message }}</span>
    @enderror
    </p>

    <p class="my-4">
        <strong> {!! Form::label('Título del anuncio') !!}</strong>
        {!! Form::text('titulo', old('titulo', $titulo), [
            'required',
            'maxlength' => '75',
            'onChange' => 'recordar_cambios();',
            'class' => 'input w-full  input-bordered' . ($errors->has('titulo') ? ' is-invalid' : ''),
            'wire:model' => 'titulo',
        ]) !!}
        @error('titulo')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
    </p>

    <p class="my-4">
        <strong> {!! Form::label('Nombre') !!}</strong>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre a publicar"
            wire:model='nombre' onChange='recordar_cambios();' class="input w-full input-bordered" required
            value="{{ old('nombre', $nombre) }}" />
        @error('nombre')
            <span class="text-red-700">{{ $message }}</span>
        @enderror

    </p>
    <p class="my-4">
        <strong> {!! Form::label('Edad') !!} </strong>
        {{ Form::selectRange('edad', 18, 99, $edad, ['required', 'wire:model' => 'edad', 'onChange' => 'recordar_cambios();', 'class' => 'input w-full  input-bordered    ' . ($errors->has('edad') ? ' is-invalid' : '')]) }}
        @error('edad')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
    </p>

    <p class="my-4">


        <strong><label>Teléfono Publicación Max 9 caracteres
            </label></strong>
        <br>
        {{ Form::tel('telefono_publicacion', $telefono_publicacion, ['pattern' => '[6|7][0-9]{8}', 'wire:model' => 'telefono_publicacion', 'onChange' => 'recordar_cambios();', 'required', 'minlength' => '9', 'maxlength' => '9', 'class' => 'input w-44 input-bordered' . ($errors->has('telefono_publicacion') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Publicación']) }}
        <small class="text-gray-500">9 Nros. Debe iniciar con 6 o 7. No acepta letras, parentesis, guiones, ni espacios
            en blanco.</small><br>
        @error('telefono_publicacion')
            <span class="text-red-700">{{ $message }}</span>
        @enderror

    </p>
    <p class="my-4">
        <strong> <label>Admites contactos por Whatsapp </label></strong>

        {!! Form::radio('whatsapp', 'No', $whatsapp == '' ? true : $whatsapp == 'No', [
            'wire:model' => 'whatsapp',
            'onChange' => 'recordar_cambios();',
        ]) !!}
        No

        <label>
            {!! Form::radio('whatsapp', 'Si', $whatsapp == 'Si', [
                'wire:model' => 'whatsapp',
                'onChange' => 'recordar_cambios();',
            ]) !!}
            Si

            @error('whatsapp')
                <span class="text-red-700">{{ $message }}</span>
            @enderror

    </p>


    <div class="h-1 w-full mx-auto border-b my-2"></div>
    <p class="my-4">
        <strong> <label>Selecciona que actividades te gustan</label></strong>

    <div class="grid grid-cols-2 mt-3">
        @if ($tags_etc != '[]')
            <div>
                <p class=" font-bold">En tu casa</p>
                @foreach ($tags_etc as $tag)
                    <label>
                        En tu casa
                        {!! Form::checkbox('tags[]', $tag->id, null, ['wire:model' => 'tags', 'onChange' => 'recordar_cambios();']) !!}
                        {{ $tag->nombre }}<br>
                    </label>
                @endforeach

            </div>
        @endif
        @if ($tags_ec != '[]')
            <div>
                <p class=" font-bold">En la mía</p>
                @foreach ($tags_ec as $tag)
                    <label>
                        {!! Form::checkbox('tags[]', $tag->id, null, [
                            'wire:model' => 'tags',
                            'onChange' => 'recordar_cambios();',
                        ]) !!}
                        {{ $tag->nombre }}<br>
                    </label>
                @endforeach
            </div>
        @endif

        @if ($tags_al != '[]')
            <div>
                <p class=" font-bold">Al aire libre</p>
                @foreach ($tags_al as $tag)
                    <label>

                        {!! Form::checkbox('tags[]', $tag->id, null, ['wire:model' => 'tags',  'id' => 'tags', 'onChange' => 'recordar_cambios();']) !!}
                        {{ $tag->nombre }}<br>
                    </label>
                @endforeach

            </div>
        @endif
        @if ($tags_in != '[]')
            <div>

                <p class=" font-bold">Encerraditos</p>
                @foreach ($tags_in as $tag)
                    <label>

                        {!! Form::checkbox('tags[]', $tag->id, null, [
                            'wire:model' => 'tags',
                            'id' => 'tags',
                            'onChange' => 'recordar_cambios();',
                        ]) !!}
                        {{ $tag->nombre }}<br>
                    </label>
                @endforeach
            </div>
        @endif
    </div>
    </p>


    <div>

        <button type="submit" id='submit_guardar' onclick="validar_check()"
            class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-red-600 border border-red-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-red-700 focus:outline-none focus:ring"
            href="">
            {{ __($mensaje_boton) }}
        </button>
    </div>
    <div class="inline-block text-center my-2">
        <a href="{{ route('dashboard') }}"
        class="underline text-xl  hover:text-red-700  ">Volver al Panel</a>

        </div>
</div>

<script>

    document.getElementById("submit_guardar").addEventListener("click", function(event) {


       const accesorios = document.querySelectorAll('input[type=checkbox]:checked');
        if (accesorios.length <= 1) {
            event.preventDefault();
            //alert('Debes seleccionar al menos dos actividades que te gusten.');
            Swal.fire({
            // position: 'top-end',
            icon: 'error',
            title: 'No seleccionaste actividades. ',
            text: "Debes seleccionar al menos dos actividades que te gusten.!",
            showConfirmButton: true,
        })
        }
    });

</script>
