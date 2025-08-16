<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $tag->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $tag->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('color') }}
            {{ Form::text('color', $tag->color, ['class' => 'form-control' . ($errors->has('color') ? ' is-invalid' : ''), 'placeholder' => 'Color']) }}
            {!! $errors->first('color', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            {{ Form::label('Rubro') }}
            {{ Form::select('rubro',  $tag->rubros, $tag->rubro, ['class' => 'form-control' . ($errors->has('rubro') ? ' is-invalid' : '')]) }}
            {!! $errors->first('rubro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
            <div class="form-group">
            <p class="font-weight-bold">Visible</p>

            <label class="mr-2">
                {!! Form::radio('visible', 'Si', $tag->visible == '' ? true : $tag->visible == 'Si') !!}
                Visible
            </label>
            <label class="mr-2">
                {!! Form::radio('visible', 'No', $tag->visible == 'No') !!}
                Oculto
            </label>

            @error('visible')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <p class="font-weight-bold">Menú</p>

            <label class="mr-2">
                {!! Form::radio('menu', 'No', $tag->menu == '' ? true : $tag->menu == 'No') !!}
                No
            </label>
            <label class="mr-2">
                {!! Form::radio('menu', 'Si', $tag->menu == 'Si') !!}
                Si
            </label>

            @error('menu')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
