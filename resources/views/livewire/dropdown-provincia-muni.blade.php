<div>
    <div class="form-group">
        {!! Form::label('provincia_id', 'Provincia') !!}
        <select wire:model='selectedProvincia' class='form-control'>
            <option value=""></option>
            @foreach ($provincias as $provincia)
                <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
            @endforeach
        </select>

        @error('provincia_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('municipio_id', 'Municipio') !!}
        <select name='municipio_id' id='municipio_id' wire:model='selectedMuni' class='form-control'>
            <option value=""></option>
            @foreach ($municipios as $municipio)
                <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
            @endforeach
        </select>

        @error('municipio_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    
</div>
