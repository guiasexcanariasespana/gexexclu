<div>
    <div class="row">
        <div class="form-group  col-lg-6">
            {{ Form::label('clase_id', 'Clase') }}
            {{ Form::select('clase_id', $clases, old('clase_id'), ['wire:model' => 'selectedClase', 'class' => 'form-control' . ($errors->has('clase_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('clase_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group  col-lg-6">
            {!! Form::label('categoria_id', 'Categoria') !!}
            {!! Form::select('categoria_id', $categorias, $selectedCategoria, [
                'wire:model' => 'selectedCategoria',
                'class' => 'form-control',
            ]) !!}

            @error('categoria_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group  col-lg-4">
            {!! Form::label('provincia_id', 'Provincia') !!}
            <select name='provincia_id' id='provincia_id' wire:model='selectedProvincia' class='form-control'>
                <option value=""></option>
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->id }}" @if (old('provincia_id') == $provincia->id) Selected @endif>
                        {{ $provincia->nombre }}</option>
                @endforeach
            </select>

            @error('provincia_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group  col-lg-4">
            {!! Form::label('municipio_id', 'Municipio') !!}
            <select name='municipio_id' id='municipio_id' wire:model='selectedMuni' class='form-control'>
                <option value=""></option>
                @foreach ($municipios as $municipio)
                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                @endforeach
            </select>

            @error('municipio_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group  col-lg-4">
            {{ Form::label('localidad') }}
            {{ Form::text('localidad', $this->localidad, ['class' => 'form-control' . ($errors->has('localidad') ? ' is-invalid' : ''), 'placeholder' => 'Localidad']) }}
            {!! $errors->first('localidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-4">
            {{ Form::label('plane_id', 'Plan') }}
            {{ Form::select('plane_id', $planes, $selectedPlane, ['wire:model' => 'selectedPlane', 'class' => 'form-control' . ($errors->has('plane_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('plane_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4">
            {{ Form::label('precio') }}
            {{ Form::number('precio', $precio, ['wire:model' => 'precio', 'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4">
            {{ Form::label('dias') }}
            {{ Form::number('dias', $dias, ['wire:model' => 'dias', 'class' => 'form-control' . ($errors->has('dias') ? ' is-invalid' : ''), 'placeholder' => 'dias']) }}
            {!! $errors->first('dias', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
