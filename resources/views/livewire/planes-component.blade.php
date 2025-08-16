<div>
    <div class="grid lg:grid-cols-2 gap-5 mt-5">
        <div class="card w-96 bg-white shadow-xl">
            <img src="{{ config('app.url') }}/img/card-categoria.jpeg" alt="bg_titulo" />
            <div class="card-body">
                <h2 class="card-title  text-red-700  font-black">
                    {{ __('Categoria') }}
                    <div class="badge badge-neutro">Anuncio</div>
                </h2>
                <label class="mr-2">
                    {!! Form::label('categoria_id', 'Categoria') !!}
                    {!! Form::select('categoria_id', $categorias, $selectedCategoria, [
                        'wire:model' => 'selectedCategoria',
                        'class' => 'form-control',
                        'required',
                    ]) !!}
                </label>

                @error('categoria_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p>Seleccione Categoría que será visible en el anuncio</p>
                <div class="card-actions justify-end">
                    <div class="badge badge-outline">{{ __('Paso 1') }}</div>

                </div>
            </div>
        </div>



        <div class="card w-96 bg-white shadow-xl">
            <img src="{{ config('app.url') }}/img/card-provincia.jpeg" alt="bg_titulo" />
            <div class="card-body">
                <h2 class="card-title  text-red-700  font-black">
                    {{ __('Provincia') }}
                    <div class="badge badge-neutro">Lugar</div>
                </h2>
                <label class="mr-2">
                    {!! Form::label('provincia_id', 'Provincia') !!}
                    <select name='provincia_id' id='provincia_id' required wire:model='selectedProvincia'
                        class='form-control'>
                        <option value=""></option>
                </label>
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                @endforeach
                </select>

                @error('provincia_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p>Seleccione una Provincia que será visible en el anuncio</p>
                <div class="card-actions justify-end">
                    <div class="badge badge-outline">{{ __('Paso 2') }}</div>

                </div>
            </div>
        </div>


        <div class="card w-96 bg-white shadow-xl">
            <img src="{{ config('app.url') }}/img/card-genero.jpeg" alt="bg_titulo" />
            <div class="card-body">
                <h2 class="card-title  text-red-700  font-black">
                    {{ __('Municipio') }}
                    <div class="badge badge-neutro">Lugar</div>
                </h2>
                <label class="mr-2">
                    {!! Form::label('municipio_id', 'Municipio') !!}
                    <select name='municipio_id' required id='municipio_id' wire:model='selectedMuni'
                        class='form-control'>
                        <option value=""></option>
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                </label>
                @error('municipio_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p>Seleccione un Municipio que será visible en el anuncio</p>
                <div class="card-actions justify-end">
                    <div class="badge badge-outline">{{ __('Paso 3') }}</div>

                </div>
            </div>
        </div>

        <div class="card w-96 bg-white shadow-xl">
            <img src="{{ config('app.url') }}/img/card-zone.jpeg" alt="bg_titulo" />
            <div class="card-body">
                <h2 class="card-title  text-red-700 font-black">
                    {{ __('Localidad') }}
                    <div class="badge badge-neutro">Lugar</div>
                </h2>
                <label class="mr-2">
                    {{ Form::label('localidad') }}
                    {{ Form::text('localidad', null, ['wire:model' => 'localidad', 'required', 'class' => 'form-control' . ($errors->has('localidad') ? ' is-invalid' : ''), 'placeholder' => 'Localidad']) }}
                    {!! $errors->first('localidad', '<div class="invalid-feedback">:message</div>') !!}
                    <p>Seleccione una Zona que será visible en el anuncio</p>
                    <div class="card-actions justify-end">
                        <div class="badge badge-outline">{{ __('Paso 4') }}</div>

                    </div>
            </div>
        </div>




    </div>



    <div class="stats stats-vertical lg:stats-horizontal shadow mt-5 mx-auto">

        <div class="stat place-items-center">

            <div class="stat-value">
                {{ Form::label('Plan') }}
                {{ $plan_nombre }}
                {{ Form::hidden('plane_id', $selectedPlane, ['wire:model' => 'selectedPlane', 'class' => 'form-control' . ($errors->has('selectedPlane') ? ' is-invalid' : ''), 'placeholder' => 'selectedPlane']) }}
                {{-- {{ Form::select('plane_id', $planes, $selectedPlane, ['wire:model' => 'selectedPlane', 'class' => 'form-control' . ($errors->has('plane_id') ? ' is-invalid' : '')]) }} --}}
                {!! $errors->first('plane_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

        <div class="stat place-items-center">

            <div class="stat-value text-secondary">
                {{ Form::label('Precio', 'Precio €: ' . $precio) }}
                {{ Form::hidden('precio', $precio, ['wire:model' => 'precio', 'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

        <div class="stat place-items-center">

            <div class="stat-value">
                {{ Form::label('Días', 'Días: ' . $dias) }}
                {{ Form::hidden('dias', $dias, ['wire:model' => 'dias', 'class' => 'form-control' . ($errors->has('dias') ? ' is-invalid' : ''), 'placeholder' => 'dias']) }}
                {!! $errors->first('dias', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

    </div>

 
    <div>

        <button type="submit"
            class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
            href="">
            {{ __($mensaje_boton) }}
        </button>
    </div>

</div>
