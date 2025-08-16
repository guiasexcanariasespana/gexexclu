<x-registro-layout>

    <section>

        <div class="px-4 py-48 mx-auto max-w-screen-5xl xs:h-screen lg:items-center lg:flex bg-violet-400 ">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-8xl tracking-tight font-black text-transparent  text-pink-700">
                    {{ __('Hemos recibido tu pago') }} </h2>

                <span class="text-3xl text-pink-600 sm:block ">
                    {{ __('Continua con tu anuncio') }}
                </span>

            </div>
        </div>

        <div
            class="px-4 py-6 mx-auto max-w-screen-xl xs:h-screen lg:items-center lg:flex bg-gray-100 opacity-90 z-0 rounded-lg -mt-20">



            <!-- Guardar en Anuncio   -->
           
        <a class="block w-full px-12 py-3 text-lg font-medium  border border-pink-600 rounded sm:w-auto hover:bg-pink-700 active:bg-pink-500 focus:outline-none focus:ring" href="{{ route('edit_anuncio', $anuncio) }}">
        {{__('Continuar')}}
        </a>

        </div>


    </section>




</x-registro-layout>
