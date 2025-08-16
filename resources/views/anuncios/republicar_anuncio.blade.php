<x-registro-layout>

    <section>

        <div class="px-4 py-48 mx-auto max-w-screen-5xl xs:h-screen lg:items-center lg:flex bg-violet-400 ">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-8xl tracking-tight font-black text-transparent  text-pink-700">
                    {{ __('Republica tu Anuncio') }} </h2>

                <span class="text-3xl text-pink-600 sm:block ">
                    {{ __('Complete todos los pasos') }}
                </span>               
            </div>
        </div>

        <div
            class="px-4 py-6 mx-auto max-w-screen-xl xs:h-screen lg:items-center lg:flex bg-gray-100 opacity-97 z-0 rounded-lg -mt-20">

           <!-- Guardar en Anuncio   -->
            <form class="mx-auto" method="POST" action="{{ route('pagar_republicar', $anuncio) }}" role="form"
                enctype="multipart/form-data">
                @csrf


                
                @php
                    $muni = null;
                    if (!is_null($anuncio->zone_id)) {
                        $muni = $anuncio->zone->municipio_id;
                    }
                @endphp
                @livewire('planes-component', [
                    'selectedMuni' => $anuncio->municipio_id,
                    'selectedZone' => $anuncio->zone_id,
                    'selectedPlane' => $anuncio->plane_id,
                    'selectedCategoria' => $anuncio->categoria_id,
                    'precio' => $anuncio->precio,
                    'dias' => $anuncio->dias,
                    'localidad' => $anuncio->localidad,
                    'tipo' => 'Normal',
                ])
     <div>

            <button type="submit"
                class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                href="">
                {{ __('Continuar y Pagar Anuncio') }}
            </button>
        </div>

        </form>






        </div>


    </section>




</x-registro-layout>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $("#nombre").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });
    });
</script>

<script>
    function yesnoCheck() {

        if (document.getElementById('otra').checked) {
            document.getElementById('orientacion_otra').style = 'display:block';
        } else document.getElementById('orientacion_otra').style = 'display:none';

    }
</script>
