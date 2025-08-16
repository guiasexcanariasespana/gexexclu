<x-registro-layout>

    <section>

        <div class="px-4 py-48 mx-auto max-w-screen-5xl xs:h-screen lg:items-center lg:flex bg-violet-400 ">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-8xl tracking-tight font-black text-transparent  text-pink-700">
                    {{ __('Republica tu Anuncio') }} </h2>

                <span class="text-3xl text-pink-600 sm:block ">
                    {{ __('Verifica y complete todos los pasos') }}
                </span>


               

            </div>
        </div>

        <div
            class="px-4 py-6 mx-auto max-w-screen-xl xs:h-screen lg:items-center lg:flex bg-gray-100 opacity-90 z-0 rounded-lg -mt-20">



            <!-- Guardar en Anuncio   -->
            <form class="mx-auto" method="POST" action="{{ route('pagar_republicar', $anuncio) }}" role="form"
                enctype="multipart/form-data">
                @csrf
              
                @include('anuncios.partial.form_ext_republic')

                <div>
                    <button type="submit"
                        class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                        href="">
                        {{ __('Continuar y Pagar Anuncio') }}
                    </button>
                                        <a class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-blue-600 border border-blue-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                        href="{{ route('dashboard', $anuncio) }}">
                        {{ __('Cancelar') }}
                    </a>
                </div>

            </form>

        </div>


    </section>




</x-registro-layout>
