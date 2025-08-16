<div class="box box-info padding-1">
    <div class="box-body">
        {{ Form::hidden('verificacion', 'Si', null) }}
        <div class="form-group col-lg-6">
            {{ Form::hidden('user_id', $anuncio->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="row">

            <div class="form-group col-lg-6">
                {{ Form::label('titulo') }}
                {{ Form::text('titulo', $anuncio->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Título']) }}
                {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group col-lg-6">
                {{ Form::label('nombre') }}
                {{ Form::text('nombre', $anuncio->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>





        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $anuncio->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group ">
            {{ Form::label('presentacion', 'Presentación que se Muestra en el Anuncio') }}
            {!!  $anuncio->presentacion !!}            
        </div>
        <div class="form-group @if($anuncio->presentacion_aux != $anuncio->presentacion) text-red @endif">
            {!! Form::label('presentacion_aux', 'Presentación ') !!}  @if($anuncio->presentacion_aux != $anuncio->presentacion) Existen modificaciones @endif
            {!! Form::textarea('presentacion_aux', $anuncio->presentacion_aux, [
                'class' => 'form-control highlighter-rouge',
                'rows' => '2',
                'maxlength' => '20',
                'placeholder' => 'Ingrese la presentación del anuncio.',
            ]) !!}

            @error('presentacion_aux')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="form-group">
            {!! Form::label('horario') !!}
            {!! Form::textarea('horario', $anuncio->horario, [
                'class' => 'form-control',
                'rows' => '2',
                'maxlength' => '20',
                'placeholder' => 'Ingrese su horarios disponibles.',
            ]) !!}

            @error('horario')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        {{-- <h4></h4> --}}
        <label for="">Tarifas €</label>
        <div class="row bg-gray mb-3">
            
            <div class="form-group col-lg-2">
                {{ Form::label('treinta_minutos', '30 Min.:') }}
                {{ Form::number('treinta_minutos', $anuncio->treinta_minutos, ['class' => 'form-control' . ($errors->has('treinta_minutos') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('treinta_minutos', '<div class="invalid-feedback">:message</div>') !!}
            </div>

             <div class="form-group col-lg-2">
                {{ Form::label('cuarenta_y_cinco_minutos', '45 Min.:') }}
                {{ Form::number('cuarenta_y_cinco_minutos', $anuncio->cuarenta_y_cinco_minutos, ['class' => 'form-control' . ($errors->has('cuarenta_y_cinco_minutos') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('cuarenta_y_cinco_minutos', '<div class="invalid-feedback">:message</div>') !!}
            </div>

             <div class="form-group col-lg-2">
                {{ Form::label('una_hora', '1 Hora:') }}
                {{ Form::number('una_hora', $anuncio->una_hora, ['class' => 'form-control' . ($errors->has('una_hora') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('una_hora', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group col-lg-2">
                {{ Form::label('medio_dia', 'Medio día:') }}
                {{ Form::number('medio_dia', $anuncio->medio_dia, ['class' => 'form-control' . ($errors->has('medio_dia') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('medio_dia', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group col-lg-2">
                {{ Form::label('todo_el_dia', 'El día:') }}
                {{ Form::number('todo_el_dia', $anuncio->todo_el_dia, ['class' => 'form-control' . ($errors->has('todo_el_dia') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('todo_el_dia', '<div class="invalid-feedback">:message</div>') !!}
            </div>


            <div class="form-group col-lg-2">
                {{ Form::label('fin_de_semana', 'Fin de sem.:') }}
                {{ Form::number('fin_de_semana', $anuncio->fin_de_semana, ['class' => ' form-control' . ($errors->has('fin_de_semana') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('fin_de_semana', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group col-lg-2">
                {{ Form::label('hora_desplazamiento', 'Hora Despl.:') }}
                {{ Form::number('hora_desplazamiento', $anuncio->hora_desplazamiento, ['class' => 'form-control' . ($errors->has('hora_desplazamiento') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('hora_desplazamiento', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            
        </div>

        <div class="row">
            {{-- <div class="form-group col-lg-6">
                {{ Form::label('tarifa') }}
                {!! Form::text('tarifa', $anuncio->tarifa, [
                    'class' => 'form-control' . ($errors->has('tarifa') ? ' is-invalid' : ''),
                    'placeholder' => 'tarifa',
                ]) !!}
                {!! $errors->first('tarifa', '<div class="invalid-feedback">:message</div>') !!}
            </div> --}}          

            <div class="form-group col-lg-6">
                @if ($anuncio->orientacion != '')
                    @php
                        $orientacion = $anuncio->orientacion;
                    @endphp
                @else
                    @php
                        $orientacion = 'Heterosexual';
                    @endphp
                @endif
                <div class="form-group">
                    <p class="font-weight-bold">Orientacion</p>
                    <label class="mr-2">
                        {!! Form::radio(
                            'orientacion',
                            'Heterosexual',
                            $anuncio->orientacion == '' ? true : $anuncio->orientacion == 'Heterosexual',
                        ) !!}
                        Heterosexual
                    </label>
                    <label class="mr-2">
                        {!! Form::radio('orientacion', 'Bisexual', $anuncio->orientacion == 'Bisexual') !!}
                        Bisexual
                    </label>
                    <label class="mr-2">
                        {!! Form::radio('orientacion', 'Homosexual', $anuncio->orientacion == 'Homosexual') !!}
                        Homosexual
                    </label>
                    <label class="mr-2">
                        {!! Form::radio('orientacion', 'Otra', $anuncio->orientacion == 'Otra') !!}
                        Otra
                    </label>
                    @error('orientacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>


        <div class="row">

            <div class="form-group col-lg-3">
                {{ Form::label('telefono', 'Telefono') }}
                {{ Form::text('telefono', $anuncio->telefono, ['required', 'minlength' => '9', 'maxlength' => '9', 'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Publicación']) }}
                {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group col-lg-3">
                {{ Form::label('telefono_publicacion', 'Telefono Publicación') }}
                {{ Form::text('telefono_publicacion', $anuncio->telefono_publicacion, ['maxlength' => '9', 'class' => 'form-control' . ($errors->has('telefono_publicacion') ? ' is-invalid' : ''), 'placeholder' => 'Telefono Publicación']) }}
                {!! $errors->first('telefono_publicacion', '<div class="invalid-feedback">:message</div>') !!}
            </div>

           

            <div class="form-group col-lg-3">
                <p class="font-weight-bold">Whatsapp</p>
                <label class="mr-2">
                    {!! Form::radio('whatsapp', 'No', $anuncio->whatsapp == 'No') !!}
                    No
                </label>
                <label class="mr-2">
                    {!! Form::radio('whatsapp', 'Si', $anuncio->whatsapp == '' ? true : $anuncio->whatsapp == 'Si') !!}
                    Si
                </label>
                @error('whatsapp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- 
        <div class="form-group">
            {{ Form::label('clase_id') }}
            {{ Form::select('clase_id', $clases, $anuncio->clase_id, ['class' => 'form-control' . ($errors->has('clase_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('clase_id', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}

        <div class="row">
            {{-- <div class="form-group col-lg-6">
                {{ Form::label('tarifa') }}
                {!! Form::text('tarifa', $anuncio->tarifa, [
                    'class' => 'form-control' . ($errors->has('tarifa') ? ' is-invalid' : ''),
                    'placeholder' => 'tarifa',
                ]) !!}
                {!! $errors->first('tarifa', '<div class="invalid-feedback">:message</div>') !!}
            </div> --}}
            <div class="form-group col-lg-2">
            <p class="font-weight-bold">Tipo</p>
                <label class="mr-2">
                    {!! Form::radio('tipo', 'Normal', $anuncio->tipo == '' ? true : $anuncio->tipo == 'Normal') !!}
                    Normal
                </label>
                <label class="mr-2">
                    {!! Form::radio('tipo', 'Doble', $anuncio->tipo == 'Doble') !!}
                    Doble
                </label>
                @error('tipo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror 
            </div>           
        </div>

        @livewire('statedropdowns', [
            'selectedMuni' => old('municipio_id', $anuncio->municipio_id),
            'selectedClase' => old('clase_id', $anuncio->clase_id),
            'selectedPlane' => old('plane_id', $anuncio->plane_id),
            'selectedCategoria' => old('categoria_id', $anuncio->categoria_id),
            'precio' => old('precio', $anuncio->precio),
            'dias' => old('dias', $anuncio->dias),
            'localidad' => old('localidad', $anuncio->localidad),
        ])

        {{-- <div class="form-group">
            {{ Form::label('fecha_nacimiento') }}
            {{ Form::date('fecha_nacimiento', $anuncio->fecha_nacimiento, ['class' => 'form-control' . ($errors->has('fecha_nacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Nacimiento']) }}
            {!! $errors->first('fecha_nacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}


        <div class="row">
            <div class="form-group col-lg-4">
                {{ Form::label('edad') }}
                {{-- {{ Form::number('edad', old('edad', $anuncio->edad), ['class' => 'form-control' . ($errors->has('edad') ? ' is-invalid' : ''), 'placeholder' => 'Edad']) }} --}}
                <div class="form-group">
                    {{ Form::selectRange('edad', 18, 99, $anuncio->edad, ['class' => 'form-control' . ($errors->has('edad') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('edad', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="form-group col-lg-4">
                {{ Form::label('Nacionalidad') }}
                {{-- {{ Form::select('nacionalidad', $user->paises, $anuncio->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : '')]) }} --}}
                <select name='nacionalidad' id='nacionalidad' class='form-control'>
                    @foreach ($user->paises as $pais)
                        <option value="{{ $pais }}" @if (old('nacionalidad') == $pais or $pais == $anuncio->nacionalidad) Selected @endif>
                            {{ $pais }}</option>
                    @endforeach
                </select>
                {!! $errors->first('nacionalidad', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-4">
                {{ Form::label('profesion') }}
                {{ Form::text('profesion', old('profesion', $anuncio->profesion), ['class' => 'form-control' . ($errors->has('profesion') ? ' is-invalid' : ''), 'placeholder' => 'Profesion']) }}
                {!! $errors->first('profesion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                {{ Form::label('fecha_de_publicacion') }}
                {{ Form::date('fecha_de_publicacion', $anuncio->fecha_de_publicacion ? \Carbon\Carbon::parse($anuncio->fecha_de_publicacion)->format('Y-m-d') : $anuncio->fecha_de_publicacion, ['class' => 'form-control' . ($errors->has('fecha_de_publicacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Publicación']) }}
                {!! $errors->first('fecha_de_publicacion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-3">
                {{ Form::label('fecha_caducidad') }}
                {{ Form::date('fecha_caducidad', $anuncio->fecha_caducidad ? \Carbon\Carbon::parse($anuncio->fecha_caducidad)->format('Y-m-d') : $anuncio->fecha_caducidad, ['class' => 'form-control' . ($errors->has('fecha_caducidad') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Caducidad']) }}
                {!! $errors->first('fecha_caducidad', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-3">
                {{ Form::label('fecha_pausa') }}
                {{ Form::date('fecha_pausa', $anuncio->fecha_pausa ? \Carbon\Carbon::parse($anuncio->fecha_pausa)->format('Y-m-d') : $anuncio->fecha_pausa, ['class' => 'form-control' . ($errors->has('fecha_pausa') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Pausa']) }}
                {!! $errors->first('fecha_pausa', '<div class="invalid-feedback">:message</div>') !!}
            </div>
               <div class="form-group col-lg-3">
                {{ Form::label('días Restantes') }}
                <br>
                {{$anuncio->dias_restantes() }}
                
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-4">
                {{ Form::label('gps') }}
                {{ Form::text('gps', old('gps', $anuncio->gps), ['class' => 'form-control' . ($errors->has('gps') ? ' is-invalid' : ''), 'placeholder' => 'Gps']) }}
                {!! $errors->first('gps', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-4">
                {{ Form::label('ip_address') }}
                {{ Form::text('ip_address', old('ip_address', $anuncio->ip_address), ['class' => 'form-control' . ($errors->has('ip_address') ? ' is-invalid' : ''), 'placeholder' => 'Ip Address']) }}
                {!! $errors->first('ip_address', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-4">
                {{ Form::label('port') }}
                {{ Form::text('port', old('port', $anuncio->port), ['class' => 'form-control' . ($errors->has('port') ? ' is-invalid' : ''), 'placeholder' => 'Port']) }}
                {!! $errors->first('port', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-2">
                <p class="font-weight-bold">Exterior</p>

                @foreach ($tag_al as $tag)
                    <p class="mr-1 text-sm">
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{ $tag->nombre }}
                    </p>
                @endforeach

                @error('tag')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-2">
                <p class="font-weight-bold">Interior</p>

                @foreach ($tag_in as $tag)
                    <p class="mr-2 text-sm">
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{ $tag->nombre }}
                    </p>
                @endforeach

                @error('tag')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group col-lg-2">
                <p class="font-weight-bold">En Casa</p>

                @foreach ($tag_ec as $tag)
                    <p class="mr-2 text-sm ">
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{ $tag->nombre }}
                    </p>
                @endforeach

                @error('tag')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group col-lg-2">
                <p class="font-weight-bold">En tu casa</p>

                @foreach ($tag_etc as $tag)
                    <p class="mr-2 text-sm ">
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{ $tag->nombre }}
                    </p>
                @endforeach

                @error('tag')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-2">
                <p class="font-weight-bold">Estado Pago</p>
                <label class="mr-2">
                    {!! Form::radio('estado_pago', 'No', $anuncio->estado_pago == '' ? true : $anuncio->estado_pago == 'No') !!}
                    No
                </label>
                <label class="mr-2">
                    {!! Form::radio('estado_pago', 'Si', $anuncio->estado_pago == 'Si') !!}
                    Si
                </label>
                @error('estado_pago')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-lg-2">
                <p class="font-weight-bold">Estado</p>
                <label class="mr-2">
                    {!! Form::radio('estado', 'Borrador', $anuncio->estado == '' ? true : $anuncio->estado == 'Borrador', [
                        'disabled' => 'true',
                    ]) !!}
                    Borrador
                </label>
                <label class="mr-2">
                    {!! Form::radio('estado', 'A_Publicar', $anuncio->estado == 'A_Publicar', ['disabled' => 'true']) !!}
                    A_Publicar
                </label>
                <label class="mr-2">
                    {!! Form::radio('estado', 'Publicado', $anuncio->estado == 'Publicado', ['disabled' => 'true']) !!}
                    Publicado
                </label>
                <label class="mr-2">
                    {!! Form::radio('estado', 'Pausado', $anuncio->estado == 'Pausado', ['disabled' => 'true']) !!}
                    Pausado
                </label>
                <label class="mr-2">
                    {!! Form::radio('estado', 'Finalizado', $anuncio->estado == 'Finalizado', ['disabled' => 'true']) !!}
                    Finalizado
                </label>
                <label class="mr-2">
                    {!! Form::radio('estado', 'Suspendido', $anuncio->estado == 'Suspendido', ['disabled' => 'true']) !!}
                    Suspendido
                </label>
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
       

    </div>
    <p class="text-sm">Autorizas mostrarte en las redes?</p>
            <label>
                {!! Form::radio('mostrar_en_redes', 'No', $anuncio->mostrar_en_redes == '' ? true : $anuncio->mostrar_en_redes == 'No') !!}
                No
            </label>
            <label>
                {!! Form::radio('mostrar_en_redes', 'Si', $anuncio->mostrar_en_redes == 'Si') !!}
                Si
            </label>
            @error('mostrar_en_redes')
                <span class="text-danger">{{ $message }}</span>
            @enderror

    <div class="box-footer mb-4">
        <button type="submit" class="btn btn-primary bg-blue-600">{{ __('Submit') }}</button>
    </div>
</div>
