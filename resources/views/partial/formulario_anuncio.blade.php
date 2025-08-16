<div class="contanier grid place-items-center rounded-xl">
    <div class="my-8 mx-auto rounded border">
        <div class="bg-white max-w-5xl sm:p-1 md:p-5 lg:p-10 shadow-sm">
            <p class="font-bold text-lg">
                Antes de continuar con la carga de tu anuncio, has click en el boton "cargar imágenes de tu anuncio"
                para cargar las mismas.
            </p>
            <div class="flex space-x-5 px-5 items-center ">



                <a class="btn text-xl h-20 btn-warning animate-pulse my-6 "
                    href="{{ route('subir_imagenes', $anuncio) }}"><i class="fa fa-fw  fa-eye mr-5"></i>
                    {{ __('Cargar Imágenes a tu  anuncio') }}
                </a>
            </div>
            <div class="h-1 w-full mx-auto border-b my-2"></div>
            <div class="transition hover:bg-gray-200 rounded-lg">
                <!-- header -->
                <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                    <i class="fas fa-plus"></i>
                    <h1 class="text-3xl font-bold"> {{ __('Bienvenido/a') }} {{ $user->name }}</h1>
                </div>
                <!-- Content -->
                <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                    <p class="text-base font-light text-gray-600 my-3">
                        Has adquirido el siguiente plan:
                        <span>{{ $anuncio->plane->nombre }} - {{ $anuncio->clase->nombre }} - Precio:
                            €{{ $anuncio->precio }} // Días: {{ $anuncio->dias }}</span>
                    </p>
                    <p class="text-md font-light text-gray-600 my-3">
                        Categoría actual seleccionada: <span class="font-bold"> {{ $anuncio->categoria->nombre }}
                        </span>
                    </p>
                    <p class="text-sm font-light text-gray-600 my-3">

                        <span class="text-base font-extrabold">Fecha de Creación:</span>
                        {{ $anuncio->created_at ? \Carbon\Carbon::parse($anuncio->created_at)->format('d/m/Y') : $anuncio->created_at }}
                        -
                        <span class="text-base font-extrabold">Fecha de Publicacion:</span>
                        {{ $anuncio->fecha_de_publicacion ? \Carbon\Carbon::parse($anuncio->fecha_de_publicacion)->format('d/m/Y') : $anuncio->fecha_de_publicacion }}
                        </br>
                        <span class="text-base font-extrabold ">Fecha de Caducidad:</span>
                        {{ $anuncio->fecha_caducidad ? \Carbon\Carbon::parse($anuncio->fecha_caducidad)->format('d/m/Y') : $anuncio->fecha_caducidad }}
                        -
                        <span class="text-base font-extrabold">Fecha de Pausa:</span>
                        {{ $anuncio->fecha_pausa ? \Carbon\Carbon::parse($anuncio->fecha_pausa)->format('d/m/Y') : $anuncio->fecha_pausa }}
                        </br>
                        <span class="text-base font-extrabold ">Días Contratados:</span>
                        {{ $anuncio->dias }} (Restantes: {{ $anuncio->dias_restantes() }})  @if($anuncio->estado == 'Publicado')Hoy Incl.@endif
                        (Transcurridos:{{ $anuncio->dias_transcurridos() }})


                    </p>

                </div>


            </div>



            <div class="h-1 w-full mx-auto border-b my-2"></div>

            <!-- What is term -->
            <div class="transition hover:bg-gray-200 rounded-lg">
                <!-- header -->
                <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                    <i class="fas fa-plus"></i>
                    <h3 class="font-bold uppercase"> {{ __('  Hola ! Queremos saber acerca de ti.. ') }}</h3>
                </div>
                <!-- Content -->
                <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                    @livewire('anuncio-edi-form', ['anuncio' => $anuncio])
                </div>


            </div>

            <!-- When to use Accordion Components -->


            <div class="transition hover:bg-gray-200 rounded-lg">
                <!-- header -->
                <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                    <i class="fas fa-plus"></i>
                    <h3 class="font-bold uppercase">Subir imagen para verificar tu identidad</h3>
                </div>
                <!-- Content -->
                <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                    @livewire('anuncio-foto-perfilform', ['anuncio' => $anuncio])


                </div>


            </div>



            <!-- Accordion Wrapper -->
            <div class="transition hover:bg-gray-200 rounded-lg">
                <!-- header -->
                <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                    <i class="fas fa-plus"></i>
                    <h3 class="font-bold uppercase">Carga un video a mi anuncio </h3>

                </div>
                <!-- Content -->
                <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">
                    <p class="my-2">
                        <strong> Selcciona un archivo de video </strong> Luego dale click a subir y Listo ! .
                    </p>
                    <p class="my-10">





                    </p>

                    @livewire('anuncio-videoform', ['anuncio' => $anuncio])


                </div>
            </div>

            <div class="transition hover:bg-gray-200 rounded-lg">
                <!-- header -->
                <div class="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16">
                    <i class="fas fa-plus"></i>
                    <h3 class="font-bold uppercase">Reglas de Imágenes y Vídeos </h3>
                </div>
                <!-- Content -->
                <div class="accordion-content px-5 pt-0 overflow-hidden max-h-0">


                    <p class="py-6 font-black">Para que podamos publicar tu perfil, ha de tener un mínimo de 2 fotos que
                        cumplan
                        las
                        siguientes reglas:</p>

                    <p class="p-1 md:p-3 ">
                        <strong> Inapropiadas > </strong> No se admiten fotos en las que aparezcan personas desnudas o
                        en ropa
                        interior.
                    </p>
                    <p class="p-1 md:p-3 ">
                        <strong> Buena calidad > </strong> Las fotos no pueden ser borrosas o demasiado oscuras.
                    </p>
                    <p class="p-1 md:p-3 ">
                        <strong> Textos y adornos > </strong> No puedes retocar tus fotos o añadir textos o adornos de
                        ningún
                        tipo. Tampoco está permitido mostrar en las fotos tu nombre o teléfono.
                        Si quieres ocultar tu cara has de difuminarla o pixelarla. No la puedes ocultar colocando encima
                        un emoji un
                        corazón o cualquier tipo de dibujo.
                    </p>


                    <p class="p-1 md:p-3 ">
                        <strong> Entorno infantil > </strong> No se admiten fotos en las que aparezcan elementos que se
                        consideran
                        infantiles, tales
                        como: osos de peluche, juguetes, uniformes de colegiala, pupitres, sábanas o cortinas con
                        motivos
                        infantiles, etc.
                    </p>
                    <p class="p-1 md:p-3 ">
                        <strong> Fotomontaje > </strong> No se admiten fotos creadas a base de recortar y pegar otras
                        fotos más
                        pequeñas.
                        Sube esas
                        mismas fotos de una en una.
                    </p>
                    <p class="p-1 md:p-3 ">
                        <strong> Fotos de catálogo > </strong> Si necesitas subir fotos de velas, toallas, etc. han de
                        ser fotos
                        originales
                        hechas por
                        ti. Por lo tanto, no se admiten fotos que han sido extraídas de un catálogo de fotos hechas por
                        terceras
                        personas.
                    </p>

                    <p class="p-1 md:p-3 ">
                        <strong> Partes del cuerpo > </strong> Un perfil no puede tener únicamente fotos que son un
                        primer plano
                        de partes
                        de tu
                        cuerpo.
                    </p>
                    <p class="p-1 md:p-3 ">
                        <strong> Fotos repetidas > </strong> Si dos fotos se parecen tanto que parece que son casi la
                        misma, una
                        de ellas
                        se
                        considerará repetida.
                    </p>
                    <p class="p-1 md:p-3 ">
                        <strong> Dibujos > </strong> En las fotos han de aparecer personas de carne y hueso. No se
                        admiten fotos
                        que son
                        dibujos.
                    </p>
                    <p class="p-1 md:p-3 ">
                        <strong> Otras webs > </strong> No se admiten fotos en las que aparecen logos o nombres de otras
                        webs.
                    </p>






                </div>


            </div>


            <div class="h-1 w-full mx-auto border-b my-4"></div>
            <div class="my-4">
                <a class="btn btn-sm btn-secundary "
                    href="{{ route('portal.show', [$anuncio->provincia, $anuncio->municipio, $anuncio->categoria, $anuncio->user_id, $anuncio]) }}"><i
                        class="fa fa-fw fa-eye mr-2"></i> {{ __('Previsualizar mi anuncio') }}</a>
            </div>
            <div class="my-4 p-1 ">
                @livewire('anuncio-a-publicar', ['anuncio' => $anuncio])

            </div>





        </div>
    </div>



</div>



<style>
    .accordion-content {
        transition: max-height 0.3s ease-out, padding 0.3s ease;
    }
</style>











<script>
    function yesnoCheck() {

        if (document.getElementById('otra').checked) {
            document.getElementById('orientacion_otra').style = 'display:block';
        } else document.getElementById('orientacion_otra').style = 'display:none';

    }
</script>

<script>
    function contar_caracteres() {
        texto = document.getElementById("presentacion_aux").value;
        numeroCaracteres = texto.length;
        restan = 2500 - numeroCaracteres;
        document.getElementById("long_rest_desc").innerHTML = restan;
        document.getElementById("long_desc").innerHTML = numeroCaracteres;

    }
</script>

<script>
    function recordar_cambios() {
        document.getElementById("mensaje_cambios").innerHTML =
            ' Haz realizados cambios debes presionar "Guardar Anuncio", sino se perderan'

    }
</script>
<script src="sweetalert2.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("anuncioform").addEventListener('submit', verificarform);
    });

    function verificarform(evento) {
        evento.preventDefault();
        verificar();
        // alert(arreglo);
        // if (!arreglo.every(esPrimero)) {
        //     alert('Hay Imágenes ocupando una misma posición.');
        //     return;
        // }
        emito_mensaje();
        this.submit();
    }
</script>
<script>
    $("#form_edit_anun").submit(function(event) {
        resultado = verificar();
        if (!resultado == true) {
            event.preventDefault();
            event.stopImmediatePropagation();
        }
    });
</script>
<script>
    const accordionHeader = document.querySelectorAll(".accordion-header");
    accordionHeader.forEach((header) => {
        header.addEventListener("click", function() {
            const accordionContent = header.parentElement.querySelector(".accordion-content");
            let accordionMaxHeight = accordionContent.style.maxHeight;

            // Condition handling
            if (accordionMaxHeight == "0px" || accordionMaxHeight.length == 0) {
                accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
                header.querySelector(".fas").classList.remove("fa-plus");
                header.querySelector(".fas").classList.add("fa-minus");
                header.parentElement.classList.add("bg-indigo-50");
            } else {
                accordionContent.style.maxHeight = `0px`;
                header.querySelector(".fas").classList.add("fa-plus");
                header.querySelector(".fas").classList.remove("fa-minus");
                header.parentElement.classList.remove("bg-indigo-50");
            }
        });
    });
</script>

<script>
    function confirmar_pusar(id) {
        Swal.fire({
            title: 'Seguro quieres Pausar tu anuncio?',
            text: "Si continua no estará visible. Los días que no este visible no se descontaran de tus días restantes de publicación. El día de en que se pausó se considera como utilizado. Podrás Reactivar tu anuncio cuando gustes.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, hagamos una Pausa!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ route('pausar_anuncio', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
               // window.location.href = "{{ route('pausar_anuncio', ' + id + ') }}";
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Aguarda. Estamos Poniendo en pausa tu anuncio.',
                    showConfirmButton: false,

                })
            }
        })
    }
</script>
<script>
    function confirmar_reactivar(id) {
        Swal.fire({
            title: 'Seguro quieres Rectivar tu anuncio?',
            text: "Si continua se publicará tu anuncio y volverá a estar visible. Recuerde que el día de en que se pausó se considera como utilizado ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Reactivemos el anuncio!'
        }).then((result) => {
            if (result.isConfirmed) {                
                var url = "{{ route('reactivar_anuncio', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Aguarda. Estamos Reactivando tu anuncio.',
                    showConfirmButton: false,

                })
            }
        })
    }
</script>

<script src="//unpkg.com/alpinejs" defer></script>
