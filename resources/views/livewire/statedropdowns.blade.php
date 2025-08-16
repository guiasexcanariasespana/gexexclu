<div>
    <div class="row">
        <!-- Clase y Categoría -->
        <div class=" form-group col-md-4">
            <label for="clase_id" class="form-label">Clase</label>
            <select id="clase_id" name="clase_id"   class="form-control" wire:model="selectedClase" 
                    class="form-select @error('clase_id') is-invalid @enderror">
                @foreach($clases as $id => $nombre)
                    <option value="{{ $id }}" @selected(old('clase_id') == $id)>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
            @error('clase_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-md-4">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select id="categoria_id"   class="form-control" name="categoria_id" wire:model="selectedCategoria"
                    class="form-select @error('categoria_id') is-invalid @enderror">
                @foreach($categorias as $id => $nombre)
                    <option value="{{ $id }}" @selected($selectedCategoria == $id)>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Provincia, Municipio y Localidad -->
    <div class="row g-3 mt-2">
        <div class=" form-group col-md-4">
            <label for="provincia_id" class="form-label">Provincia</label>
            <select id="provincia_id" name="provincia_id"   wire:model="selectedProvincia"
                    class="form-control @error('provincia_id') is-invalid @enderror">
                <option value="">Seleccione...</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}" @selected(old('provincia_id') == $provincia->id)>
                        {{ $provincia->nombre }}
                    </option>
                @endforeach
            </select>
            @error('provincia_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class=" form-group col-md-4">
            <label for="municipio_id" class="form-label">Municipio</label>
            <select id="municipio_id" name="municipio_id" wire:model="selectedMuni"
                    class="form-control @error('municipio_id') is-invalid @enderror">
                <option value="">Seleccione...</option>
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}">
                        {{ $municipio->nombre }}
                    </option>
                @endforeach
            </select>
            @error('municipio_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class=" form-group col-md-4">
            <label for="localidad" class="form-label">Localidad</label>
            <input type="text" id="localidad" name="localidad" wire:model="localidad"
                   class="form-control @error('localidad') is-invalid @enderror" 
                   placeholder="Localidad">
            @error('localidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Plan, Precio y Días -->

    <div class="row g-3 mt-2">
        <div class="form-group col-md-4">
            <label for="plane_id" class="form-label">Plan</label>
            <select id="plane_id" name="plane_id" wire:model="selectedPlane"
                    class="form-control @error('plane_id') is-invalid @enderror">
                @foreach($planes as $id => $nombre)
                    <option value="{{ $id }}" @selected($selectedPlane == $id)>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
            @error('plane_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" id="precio" name="precio" wire:model="precio"
                   class="form-control @error('precio') is-invalid @enderror" 
                   placeholder="Precio">
            @error('precio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="dias" class="form-label">Días</label>
            <input type="number" id="dias" name="dias" wire:model="dias"
                   class="form-control @error('dias') is-invalid @enderror" 
                   placeholder="Días">
            @error('dias')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>