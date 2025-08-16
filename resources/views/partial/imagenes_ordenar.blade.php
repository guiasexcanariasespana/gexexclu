<x-registro-layout>
    <link rel="stylesheet" href="{{ url('public/cssjs/bootstrap.min.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        .thumb {
            margin: 10px 5px 0 0;
            width: 300px;
        }
    </style>
    <section>
        <div class="px-4 py-48 mx-auto max-w-screen-5xl xs:h-screen lg:items-center lg:flex bg-violet-400 ">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-6xl tracking-tight font-black text-transparent  text-pink-700">
                    {{ __('Cambia el Orden de las imágenes de tu anuncio.') }} </h2>

                <span class="text-xl text-pink-600 sm:block ">
                    {{ __(' Cada imágen tiene un orden, el mismo orden que tendrán en tu anuncio') }}
                </span>




            </div>
        </div>

        <div class="max-w-9xl  mx-auto text-center px-5 py-5 bg-base-300">

                    <form method="POST" action="{{ route('imagenes_guardar_orden', $anuncio) }}" role="form" enctype="multipart/form-data" class="w-100" id="formulario">
                        <div class="container mx-auto">
                            <div class="grid grid-cols-1 gap-1 md:grid-cols-2 ">
                        
                                        @csrf
                                        @foreach ($anuncio->imagens->sortBy('position') as $img)
                                            <div class="">

                                                <a href="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                    data-toggle="lightbox" data-gallery="gallery">
                                                    <img src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                        class="mx-auto d-block w-auto" style="height: 400px; ">
                                                </a>

                                                <p class='text-sm mt-2'>
                                                    <input type="hidden" name='imagen[{{ $img->id }}][id]' id='imagen{{ $img->id }}'
                                                        value={{ $img->id }} class=''>
                                                    <b>Nro:</b> <input type="number" name='imagen[{{ $img->id }}][posicion]' min=1 required
                                                        max='10' id='imagen{{ $img->position }}' value={{ $img->position }}
                                                        class=''><br>
                                                </p>

                                            </div>
                                        @endforeach

                                  
                                    

                                    </div>
                                    @if (count($anuncio->imagens) > 0)
                                    <div class="mt-4 mb-4 w-96 mx-auto">
                                        <button type="submit" class="btn text-md border-none bg-red-600 hover:bg-gray-800">{{ __('Submit') }}</button>
                                @endif
                                </div>
                            </div>

                    </form>
                </div>
    </section>
</x-registro-layout>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("formulario").addEventListener('submit', validarFormulario);
    });


    function validarFormulario(evento) {
        evento.preventDefault();
        var imagen_pos = document.getElementsByName("imagen[]");
        //Creo el arreglo donde almaceno sus valores
        var arreglo = [];
        //Recorro todos los nodos que encontré que coinciden con ese nombre
        for (var i = 1; i < 10; i++) {
            //Añado el valor que contienen los campos
            campo = document.getElementById("imagen" + i);
            if (campo != null) {
                arreglo.push(campo.value);
            }

        }
        // alert(arreglo);
        if (!arreglo.every(esPrimero)) {
            alert('Hay Imágenes ocupando una misma posición.');
            return;
        }
        this.submit();
    }

    function esPrimero(valor, indice, lista) {
        return (lista.indexOf(valor) === indice);
    }

    function noEsPrimero(valor, indice, lista) {
    return !(lista.indexOf(valor) === indice);
}
    // var cantidad = document.getElementsByName("imagen[]");
    // //Creo el arreglo donde almaceno sus valores
    // var arreglo = [];
    // //Recorro todos los nodos que encontré que coinciden con ese nombre
    // for (var i = 0; i < cantidad.length; i++) {
    //     //Añado el valor que contienen los campos
    //     arreglo.push(cantidad[i].value);
    // }
    // console.log(arreglo);
</script>
