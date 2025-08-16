<div>
     <div class='py-0  mt-5 text-center '>
        {{-- <select name='categoria_id' id='categoria_id' wire:model='categoriaSeleted' class='mb-2 input input-bordered'>                
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select> --}}
     
        @foreach ($islas as $isla)
         @php
                $pinto = false;
                if(!is_null($isla->state)){
                    if($isla->state_id  == 2)
                        $pinto = true;
                }               
               @endphp    
        <div class="mb-1  inline-block  @if(!$pinto) bg-gray-300 @else bg-red-300 @endif px-3 text-base  text-gray-800 hover:bg-slate-800 hover:text-white @if($isla->id == $islaSeleted ) bg-gray-500 @endif">               
                <button wire:click="change_isla({{ $isla->id }})" 
                    class="">{{ $isla->nombre }}</button>
            </div>
        @endforeach
       
    </div>
</div>
