<div class="bg-white rounded-lg shadow-md p-6">
    <div class="space-y-4">
        <!-- Campo Precio -->
        <div class="form-group">
            <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">$</span>
                </div>
                <input type="number" 
                       name="precio" 
                       id="precio" 
                       value="{{ old('precio', $precio->precio) }}"
                       class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md @error('precio') border-red-500 @enderror"
                       placeholder="0.00"
                       step="0.01">
            </div>
            @error('precio')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Plan ID -->
        <div class="form-group">
            <label for="plan_id" class="block text-sm font-medium text-gray-700 mb-1">Plan ID</label>
            <input type="text" 
                   name="plan_id" 
                   id="plan_id" 
                   value="{{ old('plan_id', $precio->plan_id) }}"
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('plan_id') border-red-500 @enderror"
                   placeholder="Plan Id">
            @error('plan_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo State ID -->
        <div class="form-group">
            <label for="state_id" class="block text-sm font-medium text-gray-700 mb-1">State ID</label>
            <select name="state_id" 
                    id="state_id"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('state_id') border-red-500 @enderror">
                @foreach($states as $state)
                    <option value="{{ $state->id }}" @selected(old('state_id', $precio->state_id) == $state->id)>{{ $state->name }}</option>
                @endforeach
            </select>
            @error('state_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Zone ID -->
        <div class="form-group">
            <label for="zone_id" class="block text-sm font-medium text-gray-700 mb-1">Zone ID</label>
            <select name="zone_id" 
                    id="zone_id"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('zone_id') border-red-500 @enderror">
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}" @selected(old('zone_id', $precio->zone_id) == $zone->id)>{{ $zone->name }}</option>
                @endforeach
            </select>
            @error('zone_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Guardar Cambios
        </button>
    </div>
</div>