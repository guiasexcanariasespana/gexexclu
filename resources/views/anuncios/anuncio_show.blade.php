<x-registro-layout>

<div class="text-center my-8 ">
    
         @if (!is_null($anuncio->fecha_de_publicacion))
		<p class="text-sm md:text-base text-[#bb1a19] font-bold">{{$anuncio->fecha_de_publicacion}} <span class="text-[#bb1a19]">/</span> Fecha de Publicación</p>
		@else
        <p class="text-sm md:text-base text-[#bb1a19] font-bold"> {{ $anuncio->created_at ? date('d-m-Y', strtotime($anuncio->created_at)) : 'N/D' }} <span class="text-[#bb1a19]">/</span> Fecha de Alta/Creacíon</p>
        @endif
        <h2 class="font-bold break-normal text-3xl md:text-5xl">{{$anuncio->titulo}}</h2>
        <h3 class="font-bold break-normal text-2xl md:text-2xl">{{$anuncio->nombre}}</h3>
        <h4 class="font-bold break-normal text-xl md:text-xl">Tipo de anuncio: {{$anuncio->tipo}}</h4>
        <h4 class="font-bold break-normal text-xl md:text-xl">Categoría de anuncio:  {{ $anuncio->categoria ? $anuncio->categoria->nombre : 'N/D' }}</h4>
        <h4 class="font-bold break-normal text-xl md:text-xl">Provincia:  {{ $anuncio->provincia ? $anuncio->provincia->nombre : 'N/D' }}</h4>
        <h4 class="font-bold break-normal text-xl md:text-xl">Municipio:  {{ $anuncio->municipio ? $anuncio->municipio->nombre : 'N/D' }}</h4>
        <h4 class="font-bold break-normal text-xl md:text-xl">Zona:   {{ $anuncio->zone ? $anuncio->zone->nombre : 'N/D' }}</h4>
        <h4 class="font-bold break-normal text-xl md:text-xl">Localidad:    {{ $anuncio->localidad }}</h4>
</div>
                                  
@if (!is_null($anuncio->portada))                                              
<div class="container w-full max-w-6xl mx-auto bg-cover mt-8 rounded" style="background-image:url('{{ '/images/anuncio/' . $anuncio->id . '/' . $anuncio->portada->nombre }}'); height: 75vh;">
</div>
@else
<div class="container w-full max-w-6xl mx-auto bg-cover mt-8 rounded" style="background-image:url('{{config('app.url')}}/img/logo.png'); height: 75vh;">
</div>
@endif  

	<div class="container max-w-5xl mx-auto -mt-32">
		
		<div class="mx-0 sm:mx-6">
			
			<div class="bg-base-300 w-full p-8 md:p-24  text-gray-800 leading-normal" style="font-family:Georgia,serif;">
				
				<!--Post Content-->
				

				<!--Lead Para-->
				<p class="text-2xl md:text-3xl mb-5">
                <strong class="text-text-[#bb1a19]">Acerca de Mi: </strong>
                {!! $anuncio->presentacion !!}</p>

				<p class="py-3">
                <strong class="text-text-[#bb1a19]">Me llamo: </strong>
                    {{ $anuncio->user ? '(' . $anuncio->user->id . ') ' . $anuncio->user->name : 'N/D' }}</p>				
			
				<ol>
					
					<li class="py-1"> <strong class="text-text-[#bb1a19]">Orientación: </strong> {{ $anuncio->orientacion }}</li>
				 <li class="py-1"><strong class="text-text-[#bb1a19]">Fecha de Nacimiento: </strong>   {{ $anuncio->fecha_nacimiento ? date('d-m-Y', strtotime($anuncio->fecha_nacimiento)) : 'N/D' }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19]">Edad: </strong>    {{ $anuncio->edad }}</li>
                	<li class="py-1"><strong class="text-text-[#bb1a19]">telefono: </strong> {{ $anuncio->telefono }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19]">whatsapp: </strong> {{ $anuncio->whatsapp }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19]">Nacionalidad: </strong> {{ $anuncio->nacionalidad }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19]">Profesión: </strong>  {{ $anuncio->profesion }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19]">Tarifa: </strong>  {{ $anuncio->tarifa }}</li>
				</ol>
                <blockquote class="border-l-4 border-text-[#bb1a19] italic my-8 pl-8 md:pl-12">Datos de Plan anuncio</blockquote>
                <ol>
					
					<li class="py-1"> <strong class="text-text-[#bb1a19] ">Fecha de Alta: </strong>  {{ $anuncio->created_at ? date('d-m-Y', strtotime($anuncio->created_at)) : 'N/D' }}</li>
					<li class="py-1"><strong class="text-text-[#bb1a19] text-sm">Fecha de Publicación: </strong>   {{ $anuncio->fecha_de_publicacion ? date('d-m-Y', strtotime($anuncio->fecha_de_publicacion)) : 'N/D' }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19] text-sm">Fecha de Pausado: </strong>   {{ $anuncio->fecha_pausa ? date('d-m-Y', strtotime($anuncio->fecha_pausa)) : 'N/D' }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19] text-sm">Fecha de Caducidad: </strong>  {{ $anuncio->fecha_caducidad ? date('d-m-Y', strtotime($anuncio->fecha_caducidad)) : 'N/D' }}</li>
                    <li class="py-1"><strong class="text-text-[#bb1a19] text-sm">Estado de Verificación: </strong>   {{ $anuncio->verificacion }}</li>
				</ol>
              
				<blockquote class="border-l-4 border-text-[#bb1a19] italic my-8 pl-8 md:pl-12">Vista Previa del anuncio</blockquote>

                <div class="w-full md:w-1/2 px-2 pb-12 mx-auto">
					<div class="h-full bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth">
						<a href="#" class="no-underline hover:no-underline">
								<img src="https://source.unsplash.com/_AjqGGafofE/400x200" class="h-48 w-full rounded-t shadow">
								<div class="p-6 h-auto md:h-48">	
									<p class="text-gray-600 text-xs md:text-sm">{{$anuncio->titulo}}</p>
                                    <p class="text-gray-600 text-xs md:text-sm">{{$anuncio->nombre}}</p>
									<div class="font-bold text-xl text-text-[#bb1a19]">Acerca de Mi:</div>
									<p class="text-gray-800 font-serif text-base mb-5">
                                    {!! $anuncio->presentacion !!} 
									</p>
                                    <div class="badge badge-secondary badge-outline">{{ $anuncio->orientacion }}</div>
                                    <div class="badge badge-secondary badge-outline">{{ $anuncio->edad }}</div>
                                    <div class="badge badge-secondary badge-outline">{{ $anuncio->telefono }}</div>
                                    <div class="badge badge-secondary badge-outline">{{ $anuncio->whatsapp }}</div>
                                    <div class="badge badge-secondary badge-outline"> {{ $anuncio->profesion }}</div>
                                    <div class="badge badge-secondary badge-outline">{{ $anuncio->nacionalidad }}</div>
								</div>
                           
								<div class="flex items-center justify-between inset-x-0 bottom-0 p-6">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
									<p class="text-gray-600 text-xs md:text-sm">{{ $anuncio->user->name}} </p>
								</div>
						</a>
					</div>
				</div>

												
				<!--/ Post Content-->
						
			</div>
            <h4 class="text-base my-5">
            <a href="{{ route('dashboard', $anuncio) }}" class="text-sm text-gray-700 dark:text-gray-500 ">
  <span class="badge badge-sm">REGRESAR AL PANEL</span></a>
</h4>
          
</x-registro-layout>   