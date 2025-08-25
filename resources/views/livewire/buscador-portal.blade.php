<div class="mx-auto p-2">
    <div class="flex flex-nowrap justify-center items-center m-0 md:m-2 bg-gray-100 gap-4">
        <span class="invisible md:visible lg:visible ml-0 lg:ml-5 p-0 md:p-3 md:h-[3.1rem] md:my-2 rounded-none inline-flex items-center text-base text-white bg-gray-700 border">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>{{__('Buscador') }}
        </span>

        <div class="flex-shrink-0">
            <input 
                type="text" 
                class="input w-full rounded-none md:w-56 lg:w-96" 
                placeholder="Buscar..."
                wire:model.debounce.500ms="search"
                wire:keydown.enter="realizarBusqueda"
            />
            @if($search)
                <p class="text-sm mt-1">Buscando: {{ $search }}</p>
            @endif
        </div>

        <!-- Selector de categoría -->
        {{-- <div class="flex-shrink-0">
            <select wire:model="categoriaSeleted" class="input rounded-none">
                <option value="0">Todas las categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selector de provincia -->
        <div class="flex-shrink-0">
            <select wire:model="selectedProvincia" class="input rounded-none">
                <option value="">Todas las provincias</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selector de municipio (solo visible si hay provincia seleccionada) -->
        @if($selectedProvincia)
        <div class="flex-shrink-0">
            <select wire:model="selectedMuni" class="input rounded-none">
                <option value="">Todos los municipios</option>
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                @endforeach
            </select>
        </div>
        @endif --}}

        <div class="flex-shrink-0">
            <a class="font-bold p-1 md:p-4 text-gray-600 text-sm md:text-sm hover:bg-transparent whitespace-nowrap">
                {{ __('Acompañantes para compartir actividades') }} 
            </a>
        </div>

        <button class="btn-hover">
        <span class="btn-content btn-text">
            <svg class="btn-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{__('Publica tu perfil') }}
        </span>
        <span class="btn-content btn-whatsapp">
            <a class="btn btn-whatsapp flex items-center gap-2" href="https://wa.me/{{ env('PHONE_PREFIX') }}{{ env('PHONE_NUMBER') }}/?text=Chatea%20con%20este%20perfil%20de%20canariasexclusiva.com" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="icon whatsapp-icon">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
            </svg>
            {{ env('PHONE_NUMBER') }}
            </a>
        </span>
        </button>

    </div>
</div>