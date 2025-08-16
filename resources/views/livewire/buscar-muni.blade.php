<div>
     <div class='py-0  mt-5 text-center '>
        {{-- <select name='categoria_id' id='categoria_id' wire:model='categoriaSeleted' class='mb-2 input input-bordered'>                
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select> --}}
     
        {{-- @foreach ($municipios as $municipio)  
        <div class="mb-1  inline-block bg-red-300 px-3 text-base  text-gray-800 hover:bg-slate-800 hover:text-white @if($municipio->id == $muniSeleted ) bg-gray-500 @endif">               
                <button wire:click="change_muni({{ $municipio->id }})" 
                    class="">{{ $municipio->nombre }}</button>
        </div>
        @endforeach
        --}}
    </div>
</div>
