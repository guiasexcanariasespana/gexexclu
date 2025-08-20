<div>
    <!-- Primera fila: Clase y Categoría -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <!-- Campo Clase -->
        <div class="space-y-2">
            <label for="clase_id" class="block text-sm font-medium text-gray-700">Clase</label>
            <select id="clase_id" name="clase_id" wire:model="selectedClase"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('clase_id') border-red-500 @enderror">
                @foreach($clases as $id => $nombre)
                    <option value="{{ $id }}" @if(old('clase_id') == $id || $selectedClase == $id) selected @endif>{{ $nombre }}</option>
                @endforeach
            </select>
            @error('clase_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Categoría -->
         {{-- {{$selectedCategoria}} --}}
        <div class="space-y-2">
            <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
            <select id="categoria_id" name="categoria_id" wire:model="selectedCategoria"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('categoria_id') border-red-500 @enderror">
                @foreach($categorias as $id => $nombre)
                    <option value="{{ $id }}" @if($selectedCategoria == $id) selected @endif>{{ $nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <!-- Segunda fila: Ubicación -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <!-- Campo Provincia -->
        {{-- {{$selectedMuni}} --}}
        <div class="space-y-2">
            <label for="provincia_id" class="block text-sm font-medium text-gray-700">Provincia</label>
            <select id="provincia_id" name="provincia_id" wire:model="selectedProvincia"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('provincia_id') border-red-500 @enderror">
                <option value=""></option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}" @if(old('provincia_id') == $provincia->id ||$selectedProvincia==$provincia->id ) selected @endif>
                        {{ $provincia->nombre }}
                    </option>
                @endforeach
            </select>
            @error('provincia_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Municipio -->
        <div class="space-y-2">
            <label for="municipio_id" class="block text-sm font-medium text-gray-700">Municipio</label>
            <select id="municipio_id" name="municipio_id" wire:model="selectedMuni"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('municipio_id') border-red-500 @enderror">
                <option value=""></option>
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}" @if (old('municipio_id') == $municipio->id || $selectedMuni == $municipio->id) selected @endif>
                        {{ $municipio->nombre }}
                    </option>
                @endforeach
            </select>
            @error('municipio_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
 {{-- {{$this->localidad}} --}}
        <!-- Campo Localidad -->
        <div class="space-y-2">
            <label for="localidad" class="block text-sm font-medium text-gray-700">Localidad</label>
            <input type="text" id="localidad" name="localidad" wire:model="localidad" placeholder="Localidad" value= "{{ $localidad }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('localidad') border-red-500 @enderror">
            @error('localidad')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Tercera fila: Planes y precios -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Campo Plan -->
         {{-- {{$selectedPlane}} --}}
        <div class="space-y-2">
            <label for="plane_id" class="block text-sm font-medium text-gray-700">Plan</label>
            <select id="plane_id" name="plane_id" wire:model="selectedPlane"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500
                @error('plane_id') border-red-500 @enderror">
                @foreach($planes as $id => $nombre)
                    <option value="{{ $id }}" @if($selectedPlane == $id) selected @endif>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
            @error('plane_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Precio -->
        {{-- {{$this->precio}} --}}
        <div class="space-y-2">
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" id="precio" name="precio" wire:model="precio" placeholder="Precio" value= "{{ $precio }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('precio') border-red-500 @enderror">
            @error('precio')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Días -->
        <div class="space-y-2">
            <label for="dias" class="block text-sm font-medium text-gray-700">Días</label>
            <input type="number" id="dias" name="dias" wire:model="dias" placeholder="Días" value= "{{ $dias }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('dias') border-red-500 @enderror">
            @error('dias')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
