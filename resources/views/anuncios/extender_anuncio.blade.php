<x-registro-layout>

    <section>

        <div class="px-4 py-48 mx-auto max-w-screen-5xl xs:h-screen lg:items-center lg:flex bg-violet-400 ">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-8xl tracking-tight font-black text-transparent  text-pink-700">
                    {{ __('Extiende tu Anuncio') }} </h2>

                <span class="text-3xl text-pink-600 sm:block ">
                    {{ __('Complete todos los pasos') }}
                </span>

            </div>
        </div>

        <div
        class="px-4 py-6 mx-auto max-w-screen-xl xs:h-screen lg:items-center lg:flex bg-gray-100  z-0 rounded-lg -mt-20">




            <!-- Guardar en Anuncio   -->
            <form class="mx-auto" method="POST" action="{{ route('pagar_extension_anuncio', $anuncio) }}" role="form"
                enctype="multipart/form-data">
                @csrf
               @include('anuncios.partial.form_ext_republic')

                <div>
                    <button type="submit"
                        class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-red-600 border border-red-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-block focus:outline-none focus:ring"
                        href="">
                        {{ __('Continuar y Pagar Anuncio') }}
                    </button>
                </div>
                <div class="inline-block text-center my-2">
                    <a href="{{ route('dashboard', $anuncio) }}"
                    class="underline text-xl  hover:text-red-700  ">Volver al Panel</a>

                    </div>
            </form>






        </div>


    </section>




</x-registro-layout>
