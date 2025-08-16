<x-registro-layout>

 


    <section>

    <div class="container mx-auto mt-10">
        <div class="grid grid-cols-1 md:grid md:grid-cols-4 md:gap-6 lg:grid-cols-4">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
             

              <label class=" text-pink-700 font-black">
                {{ __('Categoria de Anuncio seleccionada ') }}
                
            </label>
            <div class="badge badge-secondary text-lg">{{ $anuncio->categoria->nombre }}</div>
            

            </div>
          </div>
          <div class="mt-5 md:col-span-3 md:mt-0">
            {!! Form::model($anuncio,['route' => ['guarda_actualizacion_inicio',$anuncio],'class'=>"mx-auto",'autocomplete' =>'off', 'files'=> true, 'method'=>'post']) !!}   
            @csrf
              <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                  <div class="">
                    <p class="text-pink-700 font-extrabold text-3xl">
                        {{ __('  Hola ! Queremos saber acerca de ti.. ') }}
                    </p>
                
                     <p>
                    {!! Form::label('presentacion') !!}
                    {!! Form::textarea('presentacion', old('presentacion', $anuncio->presentacion), [
                        'class' => 'textarea textarea-secondary w-full',
                    
                        'placeholder' => 'Escribe una pequeña reseña sobre ti',
                    ]) !!}

                    @error('presentacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                       </p>
                  </div>
      
                  
                  <label class=" text-pink-700 font-black">
                    {{ __('Datos Generales') }}
                    <div class="badge badge-secondary">Anuncio</div>
                </label>

                <div class="mt-1">
                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre a publicar"
                            class="input w-24 mx-2 my-2 input-bordered" value="{{ old('nombre', $anuncio->nombre) }}" />
                        {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
                        {!! Form::text('titulo', $anuncio->titulo, [
                            'class' => 'input w-96 mx-2 my-2 input-bordered' . ($errors->has('titulo') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese Título del Anuncio',
                        ]) !!}    
                        {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
                        {!! Form::text('tarifa', $anuncio->tarifa, [
                            'class' => 'input w-24 mx-2 my-2  input-bordered' . ($errors->has('tarifa') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese su Tarifa',
                        ]) !!}
                        {!! $errors->first('edad', '<div class="invalid-feedback">:message</div>') !!}
                        {!! Form::number('edad', $anuncio->edad, [
                            'class' => 'input w-20 mx-2 my-2 input-bordered' . ($errors->has('edad') ? ' is-invalid' : ''),
                            'placeholder' => 'Edad',
                        ]) !!}
                        {!! $errors->first('tarifa', '<div class="invalid-feedback">:message</div>') !!}

                        <input type="hidden" id="slug" name="slug" placeholder="slug"
                            class="input input-bordered input-pink-500 " />
                    </div>
                    <hr>
                        <div class="mt-1">
                            <label class=" text-pink-700 font-black">
                                {{ __('Mostrar Teléfono') }}
                                <div class="badge badge-secondary">Contacto</div>
                            </label>
                            <p>Permites mostrar tu número de teléfono en el anuncio?</p>
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
                            <div class="mt-1">
                                
                                <label class="mr-2">
                               
                                    {{ Form::text('telefono_publicacion', $anuncio->telefono_publicacion, [ 'class' => 'input w-44 mx-2 my-2  input-bordered' . ($errors->has('telefono_publicacion') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono a publicar']) }}
                                    {!! $errors->first('telefono_publicacion', '<div class="invalid-feedback">:message</div>') !!}
                                    <p>Indica el teléfono a publicar <strong>Max 9 caracteres</strong></p>
                                </label>   
                            </div>
                           
                            <p>Admites contactos por Whatsapp</p>
                            <label class="mr-2">
                                {!! Form::radio('whatsapp', 'No', $anuncio->whatsapp == '' ? true : $anuncio->whatsapp == 'No') !!}
                                No
                            </label>
                            <label class="mr-2">
                                {!! Form::radio('whatsapp', 'Si', $anuncio->whatsapp == 'Si') !!}
                                Si
                            </label>
                            @error('whatsapp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                           
                        </div>
                        <hr>
                     <div class="mt-1">
                            <label class="text-pink-700 font-black">
                                {{ __('¿ Tu eres ?') }}
                                <div class="badge badge-secondary">Género/Identidad</div>
                            </label>
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
                           
                            </div>
                            <hr>
                            <div class="mt-1">
                                <label class=" text-pink-700 font-black">
                                    {{ __('Al aire libre , en tu casa o en la mia...') }}
                                    <div class="badge badge-secondary">Gustos y Actividades</div>
                                </label>
                                <p>Selecciona que actividades te gustan</p>
                                @foreach ($tag_etc as $tag)
                                <label class="mr-2">
                                    {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                    {{ $tag->nombre }}<br>
                                </label>
                                 @endforeach
                                 @foreach ($tag_ec as $tag)
                                 <label class="mr-2">
                                     {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                     {{ $tag->nombre }}<br>
                                 </label>
                             @endforeach
                                @foreach ($tag_al as $tag)
                                    <label class="mr-2">
                                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                        {{ $tag->nombre }}<br>
                                    </label>
                                @endforeach
                                @error('tag')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @foreach ($tag_in as $tag)
                                <label class="mr-2">
                                    {!! Form::checkbox('tags[]', $tag->id, null) !!}
                                    {{ $tag->nombre }}<br>
                                </label>
                                 @endforeach

                           

                            </div>
                            <hr>
                            <div class="mt-1">
                                <label class=" text-pink-700 font-black">
                                    {!! Form::label('provincia_id', 'Provincia') !!}
                                    {{ $anuncio->provincia->nombre }}
                                    {!! Form::label('municipio_id', 'Municipio') !!}
                                    {{ $anuncio->municipio->nombre }}
                                    <div class="badge badge-secondary">Lugar</div>
                                </label>
                                <label class="mr-2">
                                </br>
                                    {{ Form::text('localidad', $anuncio->localidad, [ 'class' => 'input w-24 mx-2 my-2  input-bordered' . ($errors->has('localidad') ? ' is-invalid' : ''), 'placeholder' => 'Localidad']) }}
                                    {!! $errors->first('localidad', '<div class="invalid-feedback">:message</div>') !!}
                                    <p>Indica la localidad o Zona</p>
                                </label>   
                            </div>
                            <hr>
                            <div class="mt-1">
                            <div class="stats stats-vertical lg:stats-horizontal shadow mt-5 mx-auto">

                                <div class="stat place-items-center">
            
                                    <div class="stat-value">
                                        {{ Form::label('Plan') }}
                                        {{ $anuncio->plane->nombre }}
                                        {{ $anuncio->clase->nombre }}
                                    </div>
            
                                </div>
            
                                <div class="stat place-items-center">
            
                                    <div class="stat-value text-secondary">
                                        {{ Form::label('Precio', 'Precio €: ' . $anuncio->precio) }}
                                    </div>
            
                                </div>
            
                                <div class="stat place-items-center">
            
                                    <div class="stat-value">
                                        {{ Form::label('Días', 'Días: ' . $anuncio->dias) }}
            
                                    </div>
            
                                </div>
                             </div>
                            </div>
      
               
                </div>
                <div>

                    <button type="submit"
                        class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                        href="">
                        {{ __('Guardar') }}
                    </button>
                    <a                         class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-blue-600 border border-blue-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                        href="{{ route('dashboard') }}">
                        {{ __('Cancelar') }}
                    </a>
                </div>
              </div>
            </form>
          </div>
        </div>
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
