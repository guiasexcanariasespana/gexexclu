<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $anuncio->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
               <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $anuncio->nombre, [ 'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('titulo') }}
            {{ Form::text('titulo', $anuncio->titulo, [ 'class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Título']) }}
            {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Slug') }}
            {{ Form::text('Slug', $anuncio->Slug, ['class' => 'form-control' . ($errors->has('Slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('Slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('presentacion', 'Descripción corta:') !!}
            {!! Form::textarea('presentacion', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese una Descripción corta del Producto',
            ]) !!}

            @error('presentacion')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>


        {{-- <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $anuncio->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}
        <div class="form-group">
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
                {!! Form::radio('orientacion', 'Otra', $anuncio->orientacion == 'Otra') !!}
                Otra
            </label>
            @error('orientacion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $anuncio->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
         <div class="form-group">
            <p class="font-weight-bold">Mostrar Teléfono</p>
            <label class="mr-2">
                {!! Form::radio(
                    'mostrar_telefono',
                    'No',
                    $anuncio->mostrar_telefono == '' ? true : $anuncio->mostrar_telefono == 'No',
                ) !!}
                No
            </label>
            <label class="mr-2">
                {!! Form::radio(
                    'mostrar_telefono',
                    'Si',
                   $anuncio->mostrar_telefono == 'Si',
                ) !!}
                Si
            </label>
            @error('mostrar_telefono')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
         <div class="form-group">
            {{ Form::label('mostrar_telefono') }}
            {{ Form::text('mostrar_telefono', $anuncio->mostrar_telefono, ['class' => 'form-control' . ($errors->has('mostrar_telefono') ? ' is-invalid' : ''), 'placeholder' => 'Mostar Telefono']) }}
            {!! $errors->first('mostrar_telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('whatsapp') }}
            {{ Form::text('whatsapp', $anuncio->whatsapp, ['class' => 'form-control' . ($errors->has('whatsapp') ? ' is-invalid' : ''), 'placeholder' => 'Whatsapp']) }}
            {!! $errors->first('whatsapp', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('clase_id') }}
            {{ Form::select('clase_id', $clases, $anuncio->clase_id, ['class' => 'form-control' . ($errors->has('clase_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('clase_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        @livewire('statedropdowns', ['selectedState' => $anuncio->state, 'selectedZone' => $anuncio->zone, 'selectedPlane' => $anuncio->plane, 'selectedCategoria' => $anuncio->categoria_id])
        <div class="form-group">
            {{ Form::label('localidad') }}
            {{ Form::text('localidad', $anuncio->localidad, ['class' => 'form-control' . ($errors->has('localidad') ? ' is-invalid' : ''), 'placeholder' => 'Localidad']) }}
            {!! $errors->first('localidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_nacimiento') }}
            {{ Form::text('fecha_nacimiento', $anuncio->fecha_nacimiento, ['class' => 'form-control' . ($errors->has('fecha_nacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Nacimiento']) }}
            {!! $errors->first('fecha_nacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('edad') }}
            {{ Form::text('edad', $anuncio->edad, ['class' => 'form-control' . ($errors->has('edad') ? ' is-invalid' : ''), 'placeholder' => 'Edad']) }}
            {!! $errors->first('edad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       <div class="form-group">
            {{ Form::label('Nacionalidad') }}
            {{ Form::select('nacionalidad', $amnuncio->user->paises, $anuncio->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : '')]) }}
            {!! $errors->first('nacionalidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('profesion') }}
            {{ Form::text('profesion', $anuncio->profesion, ['class' => 'form-control' . ($errors->has('profesion') ? ' is-invalid' : ''), 'placeholder' => 'Profesion']) }}
            {!! $errors->first('profesion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('gps') }}
            {{ Form::text('gps', $anuncio->gps, ['class' => 'form-control' . ($errors->has('gps') ? ' is-invalid' : ''), 'placeholder' => 'Gps']) }}
            {!! $errors->first('gps', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ip_address') }}
            {{ Form::text('ip_address', $anuncio->ip_address, ['class' => 'form-control' . ($errors->has('ip_address') ? ' is-invalid' : ''), 'placeholder' => 'Ip Address']) }}
            {!! $errors->first('ip_address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('port') }}
            {{ Form::text('port', $anuncio->port, ['class' => 'form-control' . ($errors->has('port') ? ' is-invalid' : ''), 'placeholder' => 'Port']) }}
            {!! $errors->first('port', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado') }}
            {{ Form::text('estado', $anuncio->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('destacado') }}
            {{ Form::text('destacado', $anuncio->destacado, ['class' => 'form-control' . ($errors->has('destacado') ? ' is-invalid' : ''), 'placeholder' => 'Destacado']) }}
            {!! $errors->first('destacado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('verificacion') }}
            {{ Form::text('verificacion', $anuncio->verificacion, ['class' => 'form-control' . ($errors->has('verificacion') ? ' is-invalid' : ''), 'placeholder' => 'Verificacion']) }}
            {!! $errors->first('verificacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </div>
</div>
