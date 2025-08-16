<div>

    {!! Form::model($anuncio, [
        'wire:submit.prevent' => 'submit',
        'class' => 'mx-auto',
        'autocomplete' => 'off',
        'files' => true,
        'method' => 'post',
        'id'=>'form_edit_anun'
    ]) !!}
    @csrf

    

        {!! Form::textarea('presentacion_aux', old('presentacion_aux', $anuncio->presentacion_aux), [
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
        {!! Form::text('titulo', $anuncio->titulo, [
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
            wire:model='nombre' onChange='recordar_cambios();' class="input w-full input-bordered"
            value="{{ old('nombre', $anuncio->nombre) }}" />
        @error('nombre')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
   
    </p>
    <p class="my-4">
        <strong> {!! Form::label('Edad') !!} </strong>
        {{ Form::selectRange('edad', 18, 99, $anuncio->edad, ['wire:model' => 'edad', 'onChange' => 'recordar_cambios();', 'class' => 'input w-full  input-bordered    ' . ($errors->has('edad') ? ' is-invalid' : '')]) }}
        @error('edad')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
    </p>

    <p class="my-4">
        <strong> <span class="">Seleccione el género/indentidad que será visible en el anuncio: </span></strong>
        <label>
            {!! Form::radio(
                'orientacion',
                'Heterosexual',
                $anuncio->orientacion == '' ? true : $anuncio->orientacion == 'Heterosexual',
                ['wire:model' => 'orientacion', 'onclick' => 'yesnoCheck()', 'onChange' => 'recordar_cambios();'],
            ) !!}
            Heterosexual
        </label>
        <label>
            {!! Form::radio('orientacion', 'Bisexual', $anuncio->orientacion == 'Bisexual', [
                'wire:model' => 'orientacion',
                'onChange' => 'recordar_cambios();',
                'onclick' => 'yesnoCheck()',
            ]) !!}
            Bisexual
        </label>
        <label>
            {!! Form::radio('orientacion', 'Homosexual', $anuncio->orientacion == 'Homosexual', [
                'wire:model' => 'orientacion',
                'onclick' => 'yesnoCheck()',
                'onChange' => 'recordar_cambios();',
            ]) !!}
            Homosexual
        </label>

        <label>
            {!! Form::radio('orientacion', 'Otra', $anuncio->orientacion == 'Otra', [
                'wire:model' => 'orientacion',
                'id' => 'otra',
                'onclick' => 'yesnoCheck()',
                'onChange' => 'recordar_cambios();',
            ]) !!}
            Otra
        </label>

        <input style="visibility:hidden;" type="text" id="orientacion_otra" name="orientacion_otra"
            placeholder="aclaranos tu orientación sexual" class="input input-bordered" />
    
        </p>
        <p class="my-4">
            <strong>{!! Form::label('profesion', 'Profesión') !!}</strong>
        <input type="text" id="profesion" name="profesion" placeholder="Ingrese profesion a publicar"
            wire:model='profesion' onChange='recordar_cambios();' class="input w-full  input-bordered"
            value="{{ old('profesion', $anuncio->profesion) }}" />
        @error('profesion')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
        </p>
        <p class="my-4">
            <strong> {{ Form::label('Nacionalidad') }}</strong>
        {{-- {{ Form::select('nacionalidad', $user->paises, $anuncio->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : '')]) }} --}}
        <select name='nacionalidad' id='nacionalidad' class="input w-full input-bordered" wire:model='nacionalidad'
            onChange='recordar_cambios();'>
            @foreach ($user->paises as $pais)
                <option value="{{ $pais }}" @if (old('nacionalidad') == $pais or $pais == $nacionalidad) Selected @endif>
                    {{ $pais }}</option>
            @endforeach
        </select>
        @error('nacionalidad')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
        </p>
        <p class="my-4">
       
            {!! Form::label('provincia_id', 'Provincia') !!}
            {{ $anuncio->provincia->nombre }} :: 
            {!! Form::label('municipio_id', 'Municipio') !!}
            {{ $anuncio->municipio->nombre }}
          
        </p>
        <strong> <label> Confirma o cambia la localidad: </label> </strong>
        <p class="my-4">

        {{ Form::text('localidad', $anuncio->localidad, ['wire:model' => 'localidad', 'onChange' => 'recordar_cambios();', 'class' => 'input w-full  input-bordered' . ($errors->has('localidad') ? ' is-invalid' : ''), 'placeholder' => 'Localidad']) }}
        @error('localidad')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
        </p>
    
     
   

        <p class="my-4">
    
            <strong> <label>Completar la Tarifa correspondiente:</label></strong>
    <div class="grid grid-cols-2 gap-4">
       
            <div class="mt-2">

                {!! Form::label('30 Minutos') !!}
                {!! Form::text('treinta_minutos', $anuncio->treinta_minutos, [
                    'class' => 'input w-full  input-bordered' . ($errors->has('treinta_minutos') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese su Tarifa para 30 minutos',
                    'onChange' => 'recordar_cambios();',
                    'wire:model' => 'treinta_minutos',
                ]) !!}
                @error('treinta_minutos')
                    <span class="text-red-700">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-2">

                {!! Form::label('1 Hora') !!}
                {!! Form::text('una_hora', $anuncio->una_hora, [
                    'class' => 'input w-full  input-bordered' . ($errors->has('una_hora') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese su Tarifa para 1 Hs',
                    'onChange' => 'recordar_cambios();',
                    'wire:model' => 'una_hora',
                ]) !!}
                @error('una_hora')
                    <span class="text-red-700">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">

                {!! Form::label('Todo el  día') !!}
                {!! Form::text('todo_el_dia', $anuncio->todo_el_dia, [
                    'class' => 'input w-full  input-bordered' . ($errors->has('todo_el_dia') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese su Tarifa para todo el día',
                    'onChange' => 'recordar_cambios();',
                    'wire:model' => 'todo_el_dia',
                ]) !!}
                @error('todo_el_dia')
                    <span class="text-red-700">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">

                {!! Form::label('45 Minutos') !!}
                 {!! Form::text('cuarenta_y_cinco_minutos', $anuncio->cuarenta_y_cinco_minutos, [
                     'class' => 'input w-full  input-bordered' . ($errors->has('cuarenta_y_cinco_minutos') ? ' is-invalid' : ''),
                     'placeholder' => 'Ingrese su Tarifa para 45 minutos',
                     'onChange' => 'recordar_cambios();',
                     'wire:model' => 'cuarenta_y_cinco_minutos',
                 ]) !!}
                 @error('cuarenta_y_cinco_minutos')
                     <span class="text-red-700">{{ $message }}</span>
                 @enderror
             </div>
             <div class="mt-2">

                {!! Form::label('Medio día') !!}
                 {!! Form::text('medio_dia', $anuncio->medio_dia, [
                     'class' => 'input w-full  input-bordered' . ($errors->has('medio_dia') ? ' is-invalid' : ''),
                     'placeholder' => 'Ingrese su Tarifa para medio día',
                     'onChange' => 'recordar_cambios();',
                     'wire:model' => 'medio_dia',
                 ]) !!}
                 @error('medio_dia')
                     <span class="text-red-700">{{ $message }}</span>
                 @enderror
             </div>


        <div>
      
            
            <div class="mt-2">

                {!! Form::label('Fin de semana') !!}
                {!! Form::text('fin_de_semana', $anuncio->fin_de_semana, [
                    'class' => 'input w-full  input-bordered' . ($errors->has('fin_de_semana') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese su Tarifa para el fin de semana',
                    'onChange' => 'recordar_cambios();',
                    'wire:model' => 'fin_de_semana',
                ]) !!}
                @error('fin_de_semana')
                    <span class="text-red-700">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">

                {!! Form::label('Hora de desplazamiento') !!}
                {!! Form::text('hora_desplazamiento', $anuncio->hora_desplazamiento, [
                    'class' => 'input w-full  input-bordered' . ($errors->has('hora_desplazamiento') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese su Tarifa para hora de desplazamiento',
                    'onChange' => 'recordar_cambios();',
                    'wire:model' => 'hora_desplazamiento',
                ]) !!}
                @error('hora_desplazamiento')
                    <span class="text-red-700">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>
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
                        {!! Form::checkbox('tags[]', $tag->id, null, ['wire:model' => 'tags', 'onChange' => 'recordar_cambios();']) !!}
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

                        {!! Form::checkbox('tags[]', $tag->id, null, ['wire:model' => 'tags', 'onChange' => 'recordar_cambios();']) !!}
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

                        {!! Form::checkbox('tags[]', $tag->id, null, ['wire:model' => 'tags', 'onChange' => 'recordar_cambios();']) !!}
                        {{ $tag->nombre }}<br>
                    </label>
                @endforeach
            </div>
        @endif
    </div>
    </p>
    <p class="my-4">

        <strong>{!! Form::label('Horario') !!}</strong>
        {!! Form::text('horario', $anuncio->horario, [
            'class' => 'input w-full  input-bordered' . ($errors->has('horario') ? ' is-invalid' : ''),
            'placeholder' => 'Ingrese su Horario de atención',
            'onChange' => 'recordar_cambios();', 'wire:model' => 'horario',
        ]) !!}
        @error('horario')
            <span class="text-red-700">{{ $message }}</span>
        @enderror

    </p>
    <p class="my-4">

   
        <strong><label>Teléfono Publicación Max 9 caracteres
        </label></strong>
        <br>
            {{ Form::tel('telefono_publicacion', $anuncio->telefono_publicacion, ['pattern' => "[6|7][0-9]{8}", 'wire:model' => 'telefono_publicacion','onChange' => 'recordar_cambios();', 'required', 'minlength' => '9', 'maxlength' => '9', 'class' => 'input w-44 input-bordered' . ($errors->has('telefono_publicacion') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Publicación']) }}
            <small class="text-gray-500">9 Nros. Debe iniciar con 6 o 7. No acepta letras, parentesis, guiones, ni espacios en blanco.</small><br>
            @error('telefono_publicacion')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
            
    </p>
    <p class="my-4">
        <strong> <label>Admites contactos por Whatsapp </label></strong>
       
            {!! Form::radio('whatsapp', 'No', $anuncio->whatsapp == '' ? true : $anuncio->whatsapp == 'No', [
                'wire:model' => 'whatsapp', 'onChange' => 'recordar_cambios();',
            ]) !!}
            No
        
        <label>
            {!! Form::radio('whatsapp', 'Si', $anuncio->whatsapp == 'Si', ['wire:model' => 'whatsapp', 'onChange' => 'recordar_cambios();']) !!}
            Si
       
        @error('whatsapp')
            <span class="text-red-700">{{ $message }}</span>
        @enderror

    </p>
    <p class="my-4">
        <strong> <label class="mt-2 ">Autorizas mostrarte en las redes? </label></strong>
       
            {!! Form::radio(
                'mostrar_en_redes',
                'No',
                $anuncio->mostrar_en_redes == '' ? true : $anuncio->mostrar_en_redes == 'No',
                ['wire:model' => 'mostrar_en_redes', 'onChange' => 'recordar_cambios();'],
            ) !!}
            No
        
        
            {!! Form::radio('mostrar_en_redes', 'Si', $anuncio->mostrar_en_redes == 'Si', [
                'wire:model' => 'mostrar_en_redes', 'onChange' => 'recordar_cambios();',
            ]) !!}
            Si
       
        @error('mostrar_en_redes')
            <span class="text-red-700">{{ $message }}</span>
        @enderror

    </p>

       
            <button type="submit" wire:loading.remove wire:target="submit, video" id='guardar_anuncio'
                class="text-base btn  text-white bg-[#bb1a19] border border-[#bb1a19] rounded sm:w-auto active:text-opacity-75 hover:bg-base-300 hover:text-black"
                href="">
                {{ __('Guardar') }} Anuncio
            </button>
            <span wire:loading wire:target="submit"  class="animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]">{{ $mensaje }}
            </span>
             <h2 id='mensaje_cambios' class=" animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]">
                    </h2>
        <div class="my-8">
            <span class="text-base font-extrabold inline-block animate animate__shakeX"> Estado
                del Anuncio:
            </span> <span class="animate animate__shakeX text-red-700">{{ $anuncio->estado }}</span>
        </div>
        </p>

        </form>
        
</div>       
