<x-guest-layout>





    <div class="hero min-h-screen bg-base-200">

        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="-ml-10">
                <img class="w-full  rounded-lg shadow-lg" src="img/loginyeah.jpeg" />

            </div>


            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif


            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">

                <div class="card-body">

                    <form method="POST" action="{{ request()->is('bielsa22admin/*') ? url('bielsa22admin/login') : url('login') }}">
                        @csrf
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-xl">{{ __('Email') }}</span>
                            </label>
                            <input id="email" type="email" name="email" placeholder="info@site.com"
                                class="input input-bordered focus:bg-base-200 focus:border-purple-700"
                                :value="old('email')" required autofocus />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text text-xl">{{ __('Password') }}</span>

                            </label>
                            <input id="password" class="input input-bordered focus:bg-base-200 focus:border-purple-700"
                                type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" class="checkbox checkbox-secondary" />
                                <span class="ml-2 text-base">{{ __('Recordarme') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-base  hover:text-pink-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-jet-button class="ml-4 bg-pink-600">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
                <div class="inline-block text-center my-2">

                    <a href="{{ route('register') }}" class=" text-red-700 ">
                        Si aún no tienes cuenta, click aquí para registrarte y comenzar a anunciar!
                    </a>
                </div>
                <div class="inline-block text-center my-2">
                    <a href="{{ url('/') }}"
                    class="underline text-sm  hover:text-red-700  ">Volver al Portal</a>

                    </div>

            </div>
        </div>
    </div>
</x-guest-layout>
