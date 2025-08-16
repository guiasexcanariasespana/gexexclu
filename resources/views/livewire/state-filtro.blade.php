<div>
        <div class='py-0  mt-1 text-center '>
        {{-- <select name='categoria_id' id='categoria_id' wire:model='categoriaSeleted' class='mb-2 input input-bordered'>                
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select> --}}
     
        @foreach ($states as $state)
            <div class="mb-2 md:mb-1 inline-block bg-gray-300 py-1 px-3 text-base  text-gray-800 hover:bg-slate-800 hover:text-white @if($state->id == $stateSeleted ) bg-gray-500 @endif">
               
                <button wire:click="change_state({{ $state->id }})" 
                    class="">{{ $state->name }}</button>
            </div>
        @endforeach
       
    </div>
</div>
