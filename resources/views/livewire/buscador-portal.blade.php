<div class="mx-auto p-2">
    <div class="py-0 md:py-4 text-center mx-auto">
        <!-- Contenido comentado eliminado para mejor lectura -->
    </div>

    <div class="flex flex-wrap justify-center items-center m-0 md:m-2 bg-gray-100">
        <span
            class="invisible md:visible lg:visible ml-0 lg:ml-5 p-0 md:p-3 md:h-[3.1rem] md:my-2 rounded-none inline-block text-base text-white bg-gray-700 border">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>Buscador
        </span>

        <x-input type='text' class='input w-full rounded-none md:w-56 lg:w-96' placeholder='Ingrese su búsqueda'
            wire:model='search' />

        <div>
            <a class="font-bold p-1 md:p-4 text-gray-600 text-sm md:text-xl hover:bg-transparent">
                {{ __('Acompañantes para compartir actividades') }} 
            </a>
        </div>

        <div class="m-2 md:m-5 lg:h-[3rem]">
            <a class="btn p-3 rounded-none inline-block text-sm w-full md:w-52 text-white bg-[#bb1a19] border border-[#bb1a19] active:text-opacity-75 hover:bg-transparent hover:text-[#bb1a19] focus:outline-none focus:ring"
                href="{{ url('/dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 inline-block">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg> {{ __('Publicar Tu Perfil') }}
            </a>
        </div>
    </div>
</div>
