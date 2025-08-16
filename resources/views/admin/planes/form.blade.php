<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $plane->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $plane->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('clase_id', 'Clase') !!}
            {!! Form::select('clase_id', $clases, $plane->clase_id, ['class' => 'form-control']) !!}

            @error('clase_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('categoria_id', 'Categoria') !!}
            {!! Form::select('categoria_id', $categorias, $plane->categoria_id, ['class' => 'form-control']) !!}

            @error('categoria_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('dias') }}
            {{ Form::number('dias', $plane->dias, ['class' => 'form-control' . ($errors->has('dias') ? ' is-invalid' : ''), 'placeholder' => 'Dias']) }}
            {!! $errors->first('dias', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio') }}
            {{ Form::text('precio', $plane->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-3">
            <p class="font-weight-bold">Interno</p>
            <label class="mr-2">
                {!! Form::radio('interno', 'No', $plane->interno == '' ? true :  $plane->interno == 'No') !!}
                No
            </label>
            <label class="mr-2">
                {!! Form::radio('interno', 'Si', $plane->interno == 'Si') !!}
                Si
            </label>
            @error('interno')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
