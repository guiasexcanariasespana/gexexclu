<div class="mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
    <input type="text" 
           id="name" 
           name="name" 
           value="{{ old('name') }}"
           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
           placeholder="Ingrese el nombre de la categoría">
    
    @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<h2 class="text-lg font-semibold text-gray-800 mb-3">Lista de Permisos</h2>

<div class="space-y-2">
    @foreach ($permisos as $permiso)
        <div class="flex items-center">
            <input type="checkbox" 
                   id="permission-{{ $permiso->id }}" 
                   name="permissions[]" 
                   value="{{ $permiso->id }}"
                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                   @checked(in_array($permiso->id, old('permissions', [])))>
            <label for="permission-{{ $permiso->id }}" class="ml-2 block text-sm text-gray-700">
                {{ $permiso->description }}
            </label>
        </div>
    @endforeach
</div>