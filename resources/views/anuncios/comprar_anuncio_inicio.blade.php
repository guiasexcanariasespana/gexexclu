<x-registro-layout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <section>

        <div class="px-4 py-48 mx-auto max-w-screen-5xl xs:h-screen lg:items-center lg:flex bg-violet-400 ">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-8xl tracking-tight font-black text-transparent  text-red-700">
                    {{ __('Empieza a crear tu Anuncio') }} </h2>

                <span class="text-3xl text-red-600 sm:block ">
                    {{ __('Complete todos los pasos') }}
                </span>
            </div>
        </div>

        <div
            class="px-4 py-6 mx-auto max-w-5xl xs:h-screen lg:items-center lg:flex bg-gray-100 opacity-97 z-0 rounded-lg -mt-20">
           <!-- Guardar en Anuncio   -->
           {{-- {{Form::open(['route' => 'guardar_anuncio_inicio'])}}  --}}
           <form class="max-w-5xl mx-auto" method="POST" action="{{ route('guardar_anuncio_inicio') }}" role="form"
                enctype="multipart/form-data">
                @csrf



                @php
                    $muni = null;
                    if (!is_null($anuncio->zone_id)) {
                        $muni = $anuncio->zone->municipio_id;
                    }
                @endphp
                @livewire('planes-component-inicio', [
                    'selectedMuni' => $anuncio->municipio_id,
                    'selectedZone' => $anuncio->zone_id,
                    'selectedPlane' => $anuncio->plane_id,
                    'selectedCategoria' => $anuncio->categoria_id,
                    'precio' => $anuncio->precio,
                    'dias' => $anuncio->dias,
                    'localidad' => $anuncio->localidad,
                    'nombre' => $anuncio->nombre,
                    'edad' => $anuncio->edad,
                    'tipo' => 'Normal',
                    'telefono_publicacion' => $anuncio->telefono_publicacion,
                    'whatsapp' => $anuncio->whatsapp,

                ])


        </form>






        </div>


    </section>




</x-registro-layout>

{{-- <script>
    $('form').submit(function(e){
    // si la cantidad de checkboxes "chequeados" es cero,
    // entonces se evita que se envíe el formulario y se
    // muestra una alerta al usuario
    alert('aca ta');
    if ($('input[type=checkbox]:checked').length === 0) {
            e.preventDefault();

        }
});

</script>
 --}}


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
            /\[?\b(?:nalgas|amigas|amiga|besos|relaciones sexuales|sin penetración|culo|69|4 patas|abortivo|aborto|abstinencia|abuso sexual|acosar|acoso|activo|adicción al sexo|adolescencia|adrenarquia|afrodisíaco|agencia|agencias|agresión|amiguitas|anal|anestesia|anilingus|anorgasmia|ansiedad por el desempeño sexual|anticonceptivo|anticonceptivos|apretadito|arnes|arnés sexual|asfixia|atencion a parejas|bdsm|beso negro|besucona|blue balls|bolas|bolas anales|cachonda|caliente en la cama|capado|capuchón|castración|chochito|chocho|clítoris|coerción|coito|coitus|collar de perlas|condón|consolador|copago|copulación|cunnilingus|de venta libre|deadnaming|dmpa|duchas vaginales|embarazada|embarazo|erección|erección espontánea|escroto|espermatozoide|xcitación sexual|exhibicionismo|exhibicionista|eyaculación|eyaculatoria|fálico|fellatio|final feliz|fisting|fluidos|fornicación|fornicar|genitales|griego|hacer un calvo|hipersexual|impulso sexual|incesto|incircunciso|infantil|inseminación|labios externos|labios vaginales|leche|lactancia|libido|lingam|lubricante|lujuria|masturbación|menstruación|menstruo|misionero|misógino|necrofilia|neonatal|novia|obscenidades|oral|órganos|orgasmo|orgía|ovarios|óvulo|pap|parafilia|pene|penetración|pezón|polla|porno|pornografía|posturitas|prepucio|preseminal|progesterona|próstata|prostatico|prostitución|prostituta|prostituto|punto g|punto sin retorno|puta|puto|queer|recto|relación abierta|relaciones sexuales|relaciones sexuales sin penetración|revolución sexual|rimming|sadomasoquismo|semen|sesenta y nueve|sexo|sexo anal|sexo casual|sexo de una noche|sexo en seco|sexo extramarital|sexo más seguro|sexo oral|sexo premarital|sexo procreador|sexo vaginal|sexteo|sexualidad| sm |sodomía|squirting|strap|strap-on|sueños húmedos|tampón|terminacion|terminacion manual|testículo|testículos|testosterona|útero|vagina|vejiga|vello púbico|vibrador|violación|virginidad|voyerismo|vulva|yoni|zona erogena|zona erógena|zorra|)\b\]?/gi;
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
        var texto = $("#presentacion_aux").val().toLowerCase();
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
            return;
        } else {
            document.getElementById("malaspalabras").innerHTML = palabras_encontradas;
        }

        //Mostrar el resultado

    }
</script>
