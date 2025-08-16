<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="space-y-6">
        <div class="row">
            <!-- Nombre Field -->
            <div class=" form-group col-md-6 space-y-2">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" 
                       id="nombre"
                       name="nombre"
                       value="{{ old('nombre', $plane->nombre) }}"
                       class=" form-control block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nombre') border-red-500 @enderror"
                       placeholder="Nombre"
                       required>
                @error('nombre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Slug Field -->
            <div class=" form-group col-md-6 space-y-2">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text"
                       id="slug"
                       name="slug"
                       value="{{ old('slug', $plane->slug) }}"
                       class=" form-control block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('slug') border-red-500 @enderror"
                       placeholder="Slug"
                       required>
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Clase Field -->
            <div class=" form-group col-md-6 space-y-2">
                <label for="clase_id" class="block text-sm font-medium text-gray-700">Clase</label>
                <select id="clase_id"
                        name="clase_id"
                        class=" form-control block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('clase_id') border-red-500 @enderror">
                    @foreach($clases as $id => $clase)
                        <option value="{{ $id }}" @selected(old('clase_id', $plane->clase_id) == $id)>
                            {{ $clase }}
                        </option>
                    @endforeach
                </select>
                @error('clase_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Categoria Field -->
            <div class="form-group col-md-6 space-y-2">
                <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                <select id="categoria_id"
                        name="categoria_id"
                        class=" form-control block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('categoria_id') border-red-500 @enderror">
                    @foreach($categorias as $id => $categoria)
                        <option value="{{ $id }}" @selected(old('categoria_id', $plane->categoria_id) == $id)>
                            {{ $categoria }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class=" form-group col-md-6 space-y-2">
                <label for="dias" class="block text-sm font-medium text-gray-700">Días</label>
                <input type="number"
                       id="dias"
                       name="dias"
                       value="{{ old('dias', $plane->dias) }}"
                       class=" form-control block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('dias') border-red-500 @enderror"
                       placeholder="Días"
                       min="1">
                @error('dias')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Dias Field -->
        <div class="row">
            <!-- Precio Field -->
            <div class="form-group col-md-6 space-y-2">
                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="text"
                    id="precio"
                    name="precio"
                    value="{{ old('precio', $plane->precio) }}"
                    class=" form-control block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('precio') border-red-500 @enderror"
                    placeholder="Precio">
                @error('precio')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <!-- Interno Radio Buttons -->
            <div class=" from-group col-md-6 space-y-2">
                <p class="text-sm font-medium text-gray-700">Interno</p>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" 
                               name="interno" 
                               value="No" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                               @checked(old('interno', $plane->interno ?: 'No') === 'No')>
                        <span class="ml-2 text-sm text-gray-700">No</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" 
                               name="interno" 
                               value="Si" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                               @checked(old('interno', $plane->interno) === 'Si')>
                        <span class="ml-2 text-sm text-gray-700">Sí</span>
                    </label>
                </div>
                @error('interno')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>

    <!-- Submit Button -->
    <div class="mt-6 flex justify-end">
        <button type="submit" class=" btn btn-primary inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            {{ __('Submit') }}
        </button>
    </div>
</div>