<x-registro-layout>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="hero min-h-screen bg-base-200 ">

        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="-ml-10">
                <img class="w-full  rounded-lg shadow-lg" src="img/loginyeah.jpeg" />

            </div>
            <div
                class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100 hover:shadow-xl hover:border-2 hover:border-purple-700">
                <div class="card-body">
                    {{-- @livewire('modal-precio') --}}
                    <x-jet-validation-errors class="mb-4" />

                    <form
                        onsubmit="Swal.fire({
                                            title: 'Aguarda!',
                                            text: 'Estamos creando la cuenta, enviandote un mail y preparando todo para tu anuncio. Te damos la Bienvenida y Gracias por sumarte a CANARIAS EXCLUSIVA',  
                                            showConfirmButton: false,   
                                            icon: 'info',                       });"
                        method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ __('Nombre') }}</span>

                            </label>
                            {{ Form::text('name', old('name'), ['required', 'autocomplete' => 'name', 'class' => 'input input-bordered' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ __('Email') }}</span>

                            </label>
                            {{ Form::email('email', old('email'), ['required', 'autocomplete' => 'email', 'class' => 'input input-bordered' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}

                            <small class="text-gray-500">Te enviaremos un email para validar</small>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ __('Password') }}</span>
                            </label>
                            <input id="password" class="input input-bordered " type="password" name="password" required
                                minlength=8, autocomplete="new-password" />
                            <small class="text-gray-500">Debe contener al menos 8 caracteres</small>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ __('Confirm Password') }}</span>
                            </label>
                            <input id="password_confirmation" class="input input-bordered " type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ __('Teléfono') }}</span>

                            </label>
                            {{ Form::text('telefono', old('telefono'), ['required', 'pattern' => "[6|7][0-9]{8}", 'minlength' => '9', 'maxlength' => '9', 'autocomplete' => 'telefono', 'class' => 'input input-bordered' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono']) }}
                            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}

                            <small class="text-gray-500">9 Nros. Debe iniciar con 6 o 7. No acepta letras, parentesis, guiones, ni espacios en blanco.<br> Te enviaremos un SMS para validar</small>
                        </div>
                        <div class="form-group mt-4">
                            @php
                                $nac = [
                                    '',
                                    'España',
                                    'Latina',
                                    'Afganistán',
                                    'Albania',
                                    'Alemania',
                                    'Andorra',
                                    'Angola',
                                    'Antigua y Barbuda',
                                    'Arabia Saudita',
                                    'Argelia',
                                    'Argentina',
                                    'Armenia',
                                    'Australia',
                                    'Austria',
                                    'Azerbaiyán',
                                    'Bahamas',
                                    'Bangladés',
                                    'Barbados',
                                    'Baréin',
                                    'Bélgica',
                                    'Belice',
                                    'Benín',
                                    'Bielorrusia',
                                    'Birmania',
                                    'Bolivia',
                                    'Bosnia y Herzegovina',
                                    'Botsuana',
                                    'Brasil',
                                    'Brunéi',
                                    'Bulgaria',
                                    'Burkina Faso',
                                    'Burundi',
                                    'Bután',
                                    'Cabo Verde',
                                    'Camboya',
                                    'Camerún',
                                    'Canadá',
                                    'Catar',
                                    'Chad',
                                    'Chile',
                                    'China',
                                    'Chipre',
                                    'Ciudad del Vaticano',
                                    'Colombia',
                                    'Comoras',
                                    'Corea del Norte',
                                    'Corea del Sur',
                                    'Costa de Marfil',
                                    'Costa Rica',
                                    'Croacia',
                                    'Cuba',
                                    'Dinamarca',
                                    'Dominica',
                                    'Ecuador',
                                    'Egipto',
                                    'El Salvador',
                                    'Emiratos Árabes Unidos',
                                    'Eritrea',
                                    'Eslovaquia',
                                    'Eslovenia',
                                    'Estados Unidos',
                                    'Estonia',
                                    'Etiopía',
                                    'Filipinas',
                                    'Finlandia',
                                    'Fiyi',
                                    'Francia',
                                    'Gabón',
                                    'Gambia',
                                    'Georgia',
                                    'Ghana',
                                    'Granada',
                                    'Grecia',
                                    'Guatemala',
                                    'Guyana',
                                    'Guinea',
                                    'Guinea ecuatorial',
                                    'Guinea-Bisáu',
                                    'Haití',
                                    'Honduras',
                                    'Hungría',
                                    'India',
                                    'Indonesia',
                                    'Irak',
                                    'Irán',
                                    'Irlanda',
                                    'Islandia',
                                    'Islas Marshall',
                                    'Islas Salomón',
                                    'Israel',
                                    'Italia',
                                    'Jamaica',
                                    'Japón',
                                    'Jordania',
                                    'Kazajistán',
                                    'Kenia',
                                    'Kirguistán',
                                    'Kiribati',
                                    'Kuwait',
                                    'Laos',
                                    'Lesoto',
                                    'Letonia',
                                    'Líbano',
                                    'Liberia',
                                    'Libia',
                                    'Liechtenstein',
                                    'Lituania',
                                    'Luxemburgo',
                                    'Madagascar',
                                    'Malasia',
                                    'Malaui',
                                    'Maldivas',
                                    'Malí',
                                    'Malta',
                                    'Marruecos',
                                    'Mauricio',
                                    'Mauritania',
                                    'México',
                                    'Micronesia',
                                    'Moldavia',
                                    'Mónaco',
                                    'Mongolia',
                                    'Montenegro',
                                    'Mozambique',
                                    'Namibia',
                                    'Nauru',
                                    'Nepal',
                                    'Nicaragua',
                                    'Níger',
                                    'Nigeria',
                                    'Noruega',
                                    'Nueva Zelanda',
                                    'Omán',
                                    'Países Bajos',
                                    'Pakistán',
                                    'Palaos',
                                    'Palestina',
                                    'Panamá',
                                    'Papúa Nueva Guinea',
                                    'Paraguay',
                                    'Perú',
                                    'Polonia',
                                    'Portugal',
                                    'Reino Unido',
                                    'República Centroafricana',
                                    'República Checa',
                                    'República de Macedonia',
                                    'República del Congo',
                                    'República Democrática del Congo',
                                    'República Dominicana',
                                    'República Sudafricana',
                                    'Ruanda',
                                    'Rumanía',
                                    'Rusia',
                                    'Samoa',
                                    'San Cristóbal y Nieves',
                                    'San Marino',
                                    'San Vicente y las Granadinas',
                                    'Santa Lucía',
                                    'Santo Tomé y Príncipe',
                                    'Senegal',
                                    'Serbia',
                                    'Seychelles',
                                    'Sierra Leona',
                                    'Singapur',
                                    'Siria',
                                    'Somalia',
                                    'Sri Lanka',
                                    'Suazilandia',
                                    'Sudán',
                                    'Sudán del Sur',
                                    'Suecia',
                                    'Suiza',
                                    'Surinam',
                                    'Tailandia',
                                    'Tanzania',
                                    'Tayikistán',
                                    'Timor Oriental',
                                    'Togo',
                                    'Tonga',
                                    'Trinidad y Tobago',
                                    'Túnez',
                                    'Turkmenistán',
                                    'Turquía',
                                    'Tuvalu',
                                    'Ucrania',
                                    'Uganda',
                                    'Uruguay',
                                    'Uzbekistán',
                                    'Vanuatu',
                                    'Venezuela',
                                    'Vietnam',
                                    'Yemen',
                                    'Yibuti',
                                    'Zambia',
                                    'Zimbabue',
                                ];
                            @endphp
                            <label class="label">
                                <span class="label-text">{{ __('Nacionalidad') }}</span>
                            </label>
                            {{-- {{ Form::select('nacionalidad', $user->paises, $anuncio->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : '')]) }} --}}
                            <select name='nacionalidad' id='nacionalidad' class='input input-bordered w-full'>
                                @foreach ($nac as $pais)
                                    <option value="{{ $pais }}"
                                        @if (old('nacionalidad') == $pais) selected @endif>
                                        {{ $pais }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('nacionalidad', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group mt-4">
                            <label class="label">
                                <span class="label-text">{{ __('Edad') }}</span>
                            </label>
                            {{ Form::selectRange('edad', 18, 99, old('edad'), ['class' => 'input input-bordered w-full' . ($errors->has('edad') ? ' is-invalid' : '')]) }}

                            {!! $errors->first('edad', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group mt-4">
                            <label for="captcha">Captcha</label>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @error('g-recaptcha-response')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-jet-label for="terms" class="">
                                    <div class="flex items-center">
                                        <x-jet-checkbox name="terms" id="terms" />

                                        <div class="ml-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="underline text-sm  hover:text-pink-700">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="underline text-sm  hover:text-pink-700">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}

                                        </div>

                                    </div>
                                </x-jet-label>

                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                          
                            <a class="underline text-sm  hover:text-pink-700" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-jet-button class="ml-4">
                                {{ __('Register') }}
                            </x-jet-button>
                        </div>
                       
                    </form>
                </div>

                <div class="inline-block text-center my-2">
                <a href="{{ url('/') }}"
                class="underline text-sm  hover:text-pink-700  ">Volver al Portal</a>
                
                </div>
            </div>


        </div>



    </div>

    <div class="container max-w-xl mx-auto">
    <div class="w-full my-8 p-5 ">
        <h3 class="font-bold text-center my-5"> INFORMACIÓN BÁSICA SOBRE PROTECCIÓN DE DATOS</h3>
     <h4 class="font-bold">Responsable</h4> 
     <h4 class="font-bold mt-5">Finalidades</h4>
<p>Gestionar la contratación de los servicios (creación de Perfil) y las tareas administrativas derivadas de los mismos. Validación de identidad y edad, en su caso.
Derechos</p>
<p>Puedes acceder, rectificar y suprimir tus datos personales, así
como ejercer otros derechos dirigiéndote a info@canariasexclusiva.com. </p>
<h4 class="font-bold mt-5">Info. Adicional</h4>
<p>Puede consultar nuestra Política de Privacidad completa <a target="_blank" href="{{route('policy.show')}}" class="underline text-sm  hover:text-pink-700">{{__('aquí')}} </a>
</p>
    </div>
</div>

    </div>
    

            </x-registro-layout>
