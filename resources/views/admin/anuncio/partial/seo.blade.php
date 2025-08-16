<div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            {{ __('SEO') }}
        </h3>
    </div>
    
    <div class="p-6 space-y-4">
        <!-- Title Field -->
        <div class="space-y-2">
            <label for="title" class="block text-sm font-medium text-gray-700">
                Title
            </label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $provincia->title) }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                   placeholder="Ingresa title para seo">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Keywords Field -->
        <div class="space-y-2">
            <label for="keywords" class="block text-sm font-medium text-gray-700">
                Keywords (separadas por comas ',')
            </label>
            <input type="text" 
                   id="keywords" 
                   name="keywords" 
                   value="{{ old('keywords', $provincia->keywords) }}"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('keywords') border-red-500 @enderror"
                   placeholder="keywords">
            @error('keywords')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="space-y-2">
            <label for="description" class="block text-sm font-medium text-gray-700">
                Description
            </label>
            <textarea id="description" 
                      name="description" 
                      rows="3"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                      placeholder="Description SEO">{{ old('description', $provincia->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>