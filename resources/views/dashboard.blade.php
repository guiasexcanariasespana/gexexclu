@extends('layouts.portal')
@section('title', 'Portal')


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
<link rel="stylesheet" href="sweetalert2.min.css">
@section('content')


    <section>
        <div class="container mx-auto">

            <div class="hero my-4 ">
                <div class="hero-content text-center">
                    <div class="max-w-md">


                        <button class="bg-red-700 my-2 p-4 rounded-md hover:bg-gray-700  ">
                            <a class="animate-pulse  text-white font-bold"
                                href="{{ route('comprar_anuncio_inicio') }}">{{ __('CREAR ANUNCIO') }}</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

            {{-- @if ($user->puede_comprar()) --}}

            {{-- @else
                    <button disabled="true" class="btn btn-md  hover:bg-pink-500">
                        Ya tienes un anuncio activo
                    </button>
                @endif --}}
     </section>



    <section>

        <div class="container mx-auto my-2">


            @if ($anuncio)
                @include('partial.formulario_anuncio')
            @endif


        </div>

    </section>



    <div class="container mx-auto p-5  my-2  rounded-xl">
        <h3 class="font-bold text-center text-xl my-2">Listado de mis anuncios</h3>
        <div class="bg-white max-w-5xl mx-auto sm:p-1 md:p-2 lg:p-8 border border-gray-200 shadow-sm">

            {{-- @include('partial.dash_lista_anuncios_user') --}}
             @livewire('list-anuncios-user', ['user'=>$user])
        </div>
    </div>
@endsection


<!-- JS de mensaje  -->
<script>
    $(mensaje).slideDown(function() {
        setTimeout(function() {
            $(mensaje).slideUp();
        }, 5000);
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>





<script>
    const MAXIMO_TAMANIO_BYTES = 2000000;

    function previewImage() {
        var reader = new FileReader();
        reader.readAsDataURL(document.getElementById('uploadImage').files[0]);
        const archivo = document.getElementById('uploadImage').files[0];
        if (archivo.size > MAXIMO_TAMANIO_BYTES) {
            const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
            Swal.fire({
                // position: 'top-end',
                icon: 'error',
                title: 'Hay errores en la Imagen.',
                text: 'El tamaño máximo es ${tamanioEnMb} MB',
                showConfirmButton: true,
            });
            document.getElementById('uploadImage').value = '';
            document.getElementById("mensaje_cambio_verificacion").innerHTML = '';
            document.getElementById('uploadPreview').src = e.target.result;
        } else {
            var fileInput = document.getElementById('uploadImage');
            var filePath = fileInput.value;
            var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                Swal.fire({
                    // position: 'top-end',
                    icon: 'error',
                    title: 'Hay errores en la Imagen.',
                    text: 'Solo se admiten archivos con extensión .jpeg/.jpg/.png .',
                    showConfirmButton: true,
                });
                fileInput.value = '';
                document.getElementById("mensaje_cambio_verificacion").innerHTML = '';
                return false;
            } else {
                reader.onload = function(e) {
                    document.getElementById('uploadPreview').src = e.target.result;
                    document.getElementById('btnrm').style.display = 'block';
                    document.getElementById("mensaje_cambio_verificacion").innerHTML =
                        ' Haz seleccionado una Imagen, debes presionar "SUBIR" para guardarla, sino se perdera.'
                    // document.getElementById('lblportada' + nb).style.display = 'inline';

                };
            };
        }

    }

    function validarExtension(datos) {

        var ruta = datos.value;
        var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
        var extensionValida = extensionesValidas.indexOf(extension);

        if (extensionValida < 0) {
            $('#texto').text('La extensión no es válida Su fichero tiene de extensión: .' + extension);
            return false;
        } else {
            return true;
        }
    }
</script>
<script>
    function limpiar() {
        document.getElementById('uploadImage').value = null;
        document.getElementById('uploadPreview').src = "{{ config('app.url') }}/img/logo.png";
        document.getElementById('btnrm').style.display = 'none';
        //document.getElementById('lblportada' + nb).style.display = 'none';

        document.getElementById("mensaje_cambio_verificacion").innerHTML = '';
        document.getElementById('portada').checked = false;
        document.getElementById('porta').style.display = 'none';

    }
</script>

<script>
    $('#anuncios').DataTable({
        order: [
            [0, 'desc']
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json',
            buttons: {
                copyTitle: 'Copiado al Portapales',
                copySuccess: {
                    _: '%d Lineas copiadas',
                    1: '1 linea copiada'
                }
            },

        },
        responsive: true,
        autoWidth: false,
        dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-4'p>>",
        buttons: [{
                extend: 'colvis',
                text: 'Columnas Visibles'
            },
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [{
                        extend: 'pdfHtml5',
                        title: 'Listado de Anuncios de ({{ $user->id }}) {{ $user->name }}',
                        exportOptions: {
                            columns: ':visible'
                        }

                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Anuncios de ({{ $user->id }}) {{ $user->name }}',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        text: 'Copiar',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'csv',
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        title: 'Listado de Anuncios de ({{ $user->id }}) {{ $user->name }}',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                ]
            }
        ],



    });
</script>
<script>
    $('#notas').DataTable({
        order: [
            [0, 'desc']
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json',
            buttons: {
                copyTitle: 'Copiado al Portapales',
                copySuccess: {
                    _: '%d Lineas copiadas',
                    1: '1 linea copiada'
                }
            },

        },
        responsive: true,
        autoWidth: false,
        dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-4'p>>",
        buttons: [{
                extend: 'colvis',
                text: 'Columnas Visibles'
            },
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [{
                        extend: 'pdfHtml5',
                        title: 'Listado de Notas de ({{ $user->id }}) {{ $user->name }}',
                        exportOptions: {
                            columns: ':visible'
                        }

                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Notas de ({{ $user->id }}) {{ $user->name }}',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        text: 'Copiar',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'csv',
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        title: 'Listado de Notas de ({{ $user->id }}) {{ $user->name }}',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                ]
            }
        ],



    });
</script>

<script>
    function emito_mensaje() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Aguarda. Estamos guardando tu anuncio.',
            showConfirmButton: false,
        })
        return;

    }
</script>


<script>
    // var malasPalabras = ['nalgas', 'basura', 'trasero'];

    // const checkMalasPalabras = (palabra) => {
    //     var rgx = new RegExp(malasPalabras.join("|") + "|" + "/gi");
    //     return (rgx.test(palabra));
    // }
    prevent

    function verificar() {
        const regexe = /[^\u0000-\u007F]+/g;
        const textarea = document.getElementById('presentacion_aux');
        if (regexe.test(textarea.value)) {
            alert('Por favor, no ingrese emojis');
            return false;
        }
        var regex =
            /\[?\b(?:nalgas|amigas|amiga|besos|relaciones sexuales|sin penetración|culo|69|4 patas|abortivo|aborto|abstinencia|abuso sexual|acosar|acoso|activo|adicción al sexo|adolescencia|adrenarquia|afrodisíaco|agencia|agencias|agresión|amiguitas|anal|anestesia|anilingus|anorgasmia|ansiedad por el desempeño sexual|anticonceptivo|anticonceptivos|apretadito|arnes|arnés sexual|asfixia|atencion a parejas|bdsm|beso negro|besucona|blue balls|bolas|bolas anales|cachonda|caliente en la cama|capado|capuchón|castración|chochito|chocho|clítoris|coerción|coito|coitus|collar de perlas|condón|consolador|copago|copulación|cunnilingus|de venta libre|deadnaming|dmpa|duchas vaginales|embarazada|embarazo|erección|erección espontánea|escroto|espermatozoide|xcitación sexual|exhibicionismo|exhibicionista|eyaculación|eyaculatoria|fálico|fellatio|final feliz|fisting|fluidos|fornicación|fornicar|genitales|griego|hacer un calvo|hipersexual|impulso sexual|incesto|incircunciso|infantil|inseminación|labios externos|labios vaginales|leche|lactancia|libido|lingam|lubricante|lujuria|masturbación|menstruación|menstruo|misionero|misógino|necrofilia|neonatal|novia|obscenidades|oral|órganos|orgasmo|orgía|ovarios|óvulo|pap|parafilia|pene|penetración|pezón|polla|porno|pornografía|posturitas|prepucio|preseminal|progesterona|próstata|prostatico|prostitución|prostituta|prostituto|punto g|punto sin retorno|puta|puto|queer|recto|relación abierta|relaciones sexuales|relaciones sexuales sin penetración|revolución sexual|rimming|sadomasoquismo|semen|sesenta y nueve|sexo|sexo anal|sexo casual|sexo de una noche|sexo en seco|sexo extramarital|sexo más seguro|sexo oral|sexo premarital|sexo procreador|sexo vaginal|sexteo|sexualidad|sm|sodomía|squirting|strap|strap-on|sueños húmedos|tampón|terminacion|terminacion manual|testículo|testículos|testosterona|útero|vagina|vejiga|vello púbico|vibrador|violación|virginidad|voyerismo|vulva|yoni|zona erogena|zona erógena|zorra|)\b\]?/gi;
        var palabras = ["Palabras", "69", "4 patas", "abortivo", "aborto", "abstinencia", "abuso sexual", "acosar",
            "acoso", "activo", "adicción al sexo", "adolescencia", "adrenarquia", "afrodisíaco", "agencia",
            "agencias", "agresión", "amiga", "amigas", "amiguitas", "anal", "anestesia", "anilingus", "anorgasmia",
            "ansiedad por el desempeño sexual", "anticonceptivo", "anticonceptivos", "apretadito", "arnes",
            "arnés sexual", "asfixia", "atencion a parejas", "bdsm", "besitos", "beso negro", "besos", "besucona",
            "blue balls", "bolas", "bolas anales", "cachonda", "caliente en la cama", "capado", "capuchón",
            "castración", "chochito", "chocho", "clítoris", "coerción", "coito", "coitus", "collar de perlas",
            "condón", "consolador", "copago", "copulación", "cunnilingus", "dar pecho", "de venta libre",
            "deadnaming", "dmpa", "duchas vaginales", "embarazada", "embarazo", "erección", "erección espontánea",
            "escroto", "espermatozoide", "estigma", "excitación sexual", "exhibicionismo", "exhibicionista",
            "eyaculación", "eyaculatoria", "fálico", "fellatio", "fertilidad", "final feliz", "fisting", "fluidos",
            "fornicación", "fornicar", "frances", "genitales", "gestación", "griego", "hacer un calvo",
            "hipersexual", "impulso sexual", "incesto", "incircunciso", "infantil", "inseminación",
            "labios externos", "labios vaginales", "lactancia", "leche", "* ", "libido", "lingam", "lubricante",
            "lujuria", "masturbación", "menstruación", "menstruo", "* ", "misionero", "misógino", "necrofilia",
            "neonatal", "novia", "obscenidades", "oral", "órganos", "orgasmo", "orgía", "ovarios", "óvulo", "pap",
            "parafilia", "pene", "penetración", "pezón", "polla", "porno", "pornografía", "posturitas", "prepucio",
            "preseminal", "progesterona", "próstata", "prostatico", "prostitución", "prostituta", "prostituto",
            "punto g", "punto sin retorno", "puta", "puto", "queer", "recto", "relación abierta",
            "relaciones sexuales", "relaciones sexuales sin penetración", "revolución sexual", "rimming",
            "sadomasoquismo", "semen", "sesenta y nueve", "sexo", "sexo anal", "sexo casual", "sexo de una noche",
            "sexo en seco", "sexo extramarital", "sexo más seguro", "sexo oral", "sexo premarital",
            "sexo procreador", "sexo vaginal", "sexteo", "sexualidad", " sm ", "sodomía", "squirting", "strap",
            "strap-on", "sueños húmedos", "tampón", "terminacion", "terminacion manual", "testículo", "testículos",
            "testosterona", "útero", "vagina", "vejiga", "vello púbico", "vibrador", "violación", "virginidad",
            "voyerismo", "vulva", "yoni", "zona erogena", "zona erógena", "zorra"
        ];
        var resultado;
       var texto = textarea.value.toLowerCase();
        palabras_encontradas = '';
        for (i = 0; i < palabras.length; i++) {
            if (texto.includes(palabras[i])) {
                palabras_encontradas += " " + palabras[i];
            }

        }
        //console.log(palabras_encontradas);
        // //Reemplazar
        // resultado = texto.replace(regex, '');

        // document.getElementById("presentacion_aux").value = resultado;
        //document.getElementById("presentacion_aux").setAttribute('value', resultado);


        if (palabras_encontradas != '') {
            //console.log(palabras_encontradas);
            document.getElementById("malaspalabras").innerHTML = "Palabras no permitidas encontradas: " +
                palabras_encontradas;
            alert(
                'Se detectaron alguna/s palabras no permitidas por favor revise el texto en "Hola ! Queremos saber acerca de ti..".'
            );
            return false;
        } else {
            document.getElementById("malaspalabras").innerHTML = palabras_encontradas;
            return true;
        }

        //Mostrar el resultado

    }
</script>


<script>
    function confirmation(e) {
        ev.preventDefault();
        alert('anda');
        //    var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        //    console.log(urlToRedirect); // verify if this is the right URL

    }
</script>
