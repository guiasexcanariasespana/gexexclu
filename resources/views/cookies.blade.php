<x-registro-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div id="logo" class="w-38 md:w-96 lg:w-1/3 mx-auto">
                <a href="{{ url('/') }}"><img src="{{config('app.url')}}/img/logo.png" class="img"/></a>
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-base-300 shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $cookies !!}
            </div>
        </div>
    </div>
</x-registro-layout>
