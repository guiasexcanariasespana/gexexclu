<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="space-y-4">
        
        <!-- Nombre Field -->
        <div class="space-y-2">
            <label for="nombre" class="block text-sm font-medium text-gray-700">
                Nombre
            </label>
            <input type="text"
                   id="nombre"
                   name="nombre"
                   value="{{ old('nombre', $formapago->nombre) }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nombre') border-red-500 @enderror"
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
                   value="{{ old('slug', $formapago->slug) }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('slug') border-red-500 @enderror"
                   placeholder="Slug"
                   required>
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <!-- Submit Button -->
    <div class="mt-4 flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            {{ __('Submit') }}
        </button>
    </div>
</div>
