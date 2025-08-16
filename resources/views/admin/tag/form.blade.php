<section class="card p-4 shadow-sm">
    <div class="card-body space-y-4">

        <!-- Campo Nombre -->
        <div class="form-group">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $tag->nombre) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nombre') border-red-500 @enderror"
                   placeholder="Nombre">
            @error('nombre')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Slug -->
        <div class="form-group">
            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $tag->slug) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('slug') border-red-500 @enderror"
                   placeholder="Slug">
            @error('slug')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Color -->
        <div class="form-group">
            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
            <input type="color" name="color" id="color" value="{{ old('color', $tag->color) }}"
                   class="mt-1 h-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('color') border-red-500 @enderror">
            @error('color')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Rubro -->
        <div class="form-group">
            <label for="rubro" class="block text-sm font-medium text-gray-700">Rubro</label>
            <select name="rubro" id="rubro"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 @error('rubro') border-red-500 @enderror">
                @foreach($tag->rubros as $value => $label)
                    <option value="{{ $value }}" @selected(old('rubro', $tag->rubro) == $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('rubro')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Visible -->
        <fieldset class="form-group">
            <legend class="text-sm font-medium text-gray-700">Visible</legend>
            <div class="mt-2 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="visible" value="Si" 
                           @checked(old('visible', $tag->visible ?: 'Si') === 'Si')
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Visible</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="visible" value="No" 
                           @checked(old('visible', $tag->visible) === 'No')
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Oculto</span>
                </label>
            </div>
            @error('visible')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </fieldset>

        <!-- Campo Menú -->
        <fieldset class="form-group">
            <legend class="text-sm font-medium text-gray-700">Menú</legend>
            <div class="mt-2 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="menu" value="No" 
                           @checked(old('menu', $tag->menu ?: 'No') === 'No')
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">No</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="menu" value="Si" 
                           @checked(old('menu', $tag->menu) === 'Si')
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Sí</span>
                </label>
            </div>
            @error('menu')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </fieldset>

    </div>
    <div class="card-footer mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ __('Submit') }}
        </button>
    </div>
</section>