<!-- SEO Section -->
<section class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <!-- Card Header -->
    <header class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">
            {{ __('SEO') }}
        </h2>
    </header>
    
    <!-- Card Body -->
    <div class="p-6 space-y-6">
        <!-- Title Field -->
        <div class="space-y-2">
            <label for="title" class="block text-sm font-medium text-gray-700">
                {{ __('Titlesss') }}
            </label>
            <input type="text"
                   id="title"
                   name="title"
                   value="{{ old('title', $municipio->title ?? '') }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                   placeholder="{{ __('Ingresa title para seo') }}"
                   aria-describedby="@error('title') title-error @enderror">
            @error('title')
                <p id="title-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Keywords Field -->
        <div class="space-y-2">
            <label for="keywords" class="block text-sm font-medium text-gray-700">
                {{ __('Keywordssss') }} <span class="text-gray-500 text-xs">({{ __('separadas por comas') }})</span>
            </label>
            <input type="text"
                   id="keywords"
                   name="keywords"
                   value="{{ old('keywords', $municipio->keywords ?? '') }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('keywords') border-red-500 @enderror"
                   placeholder="{{ __('Palabras clave para SEO') }}"
                   aria-describedby="@error('keywords') keywords-error @enderror">
            @error('keywords')
                <p id="keywords-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="space-y-2">
            <label for="description" class="block text-sm font-medium text-gray-700">
                {{ __('Description') }}
            </label>
            <textarea id="description"
                      name="description"
                      rows="4"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                      placeholder="{{ __('Descripción para motores de búsqueda') }}"
                      aria-describedby="@error('description') description-error @enderror">{{ old('description', $municipio->description ?? '') }}</textarea>
            @error('description')
                <p id="description-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</section>