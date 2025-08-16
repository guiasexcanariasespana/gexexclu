<div>
    <div class="row">
        <div class="form-group col-lg-4">
            {{ Form::label('fecha_de_publicacion') }}
            {{ Form::date('fecha_de_publicacion', $anuncio->fecha_de_publicacion ? \Carbon\Carbon::parse($anuncio->fecha_de_publicacion)->format('Y-m-d') : $anuncio->fecha_de_publicacion, ['wire:model' => 'fechaPublicacion', 'class' => 'form-control' . ($errors->has('fecha_de_publicacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Publicación']) }}
            {!! $errors->first('fecha_de_publicacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4">
            {{ Form::label('fecha_caducidad') }}
            {{ Form::date('fecha_caducidad', $anuncio->fecha_caducidad ? \Carbon\Carbon::parse($anuncio->fecha_caducidad)->format('Y-m-d') : $anuncio->fecha_caducidad, ['class' => 'form-control' . ($errors->has('fecha_caducidad') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Caducidad']) }}
            {!! $errors->first('fecha_caducidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4">
            {{ Form::label('fecha_pausa') }}
            {{ Form::date('fecha_pausa', $anuncio->fecha_pausa ? \Carbon\Carbon::parse($anuncio->fecha_pausa)->format('Y-m-d') : $anuncio->fecha_pausa, ['class' => 'form-control' . ($errors->has('fecha_pausa') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Pausa']) }}
            {!! $errors->first('fecha_pausa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
