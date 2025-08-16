<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <div class="space-y-4">
        
        <!-- Nombre Field -->
        <div class="space-y-2">
            <label for="nombre" class="block text-sm font-medium text-gray-700">
                Nombre
            </label>
            <input type="text"
                   id="nombre"
                   name="nombre"
                   value="{{ old('nombre', $clase->nombre) }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nombre') border-red-500 @enderror"
                   placeholder="Nombre"
                   required>
            @error('nombre')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Slug Field -->
        <div class="space-y-2">
            <label for="slug" class="block text-sm font-medium text-gray-700">
                Slug
            </label>
            <input type="text"
                   id="slug"
                   name="slug"
                   value="{{ old('slug', $clase->slug) }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('slug') border-red-500 @enderror"
                   placeholder="Slug"
                   required>
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color Field -->
        <div class="space-y-2">
            <label for="color" class="block text-sm font-medium text-gray-700">
                Color
            </label>
            <div class="relative">
                <input type="color"
                       id="color"
                       name="color"
                       value="{{ old('color', $clase->color) }}"
                       class="block h-11 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('color') border-red-500 @enderror"
                       placeholder="Color">
                @error('color')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>

    <!-- Submit Button -->
    <div class="mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            {{ __('Submit') }}
        </button>
    </div>
</div>