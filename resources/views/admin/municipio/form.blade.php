<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $municipio->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $municipio->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('provincia_id', 'Provincia') !!}
            {!! Form::select('provincia_id', $provincias, $municipio->provincia_id, ['class' => 'form-control']) !!}

            @error('provincia_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('isla_id', 'Isla') !!}
            {!! Form::select('isla_id', [null => ''] + $islas->toArray(), $municipio->isla_id, ['class' => 'form-control']) !!}

            @error('isla_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
                 <div class="form-group">
            {!! Form::label('texto_seo', 'Texto SEO:') !!}
            {!! Form::textarea('texto_seo', $municipio->texto_seo, [
                'class' => 'form-control',
                'placeholder' => 'Texto SEO',
            ]) !!}

            @error('texto_seo')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
