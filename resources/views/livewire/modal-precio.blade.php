<div>
    <x-jet-danger-button class="bg-black py-1 px-2 rounded" wire:click="$set('open', true)">
        Ver Precios
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <span class="text-red-700 font-extrabold">Lista de Precios</span>
            <span class="font-bold"> por cada uno de las categoría</span>
        </x-slot>

        <x-slot name="content">
            

            {{-- @foreach ($categorias as $categoria)
                <div
                    class="mb-5 inline-block bg-gray-300 py-1 px-3 text-base  text-gray-800 hover:bg-slate-800 hover:text-white @if ($categoria->id == $categoriaSeleted) bg-gray-500 @endif">

                    <button wire:click="change_categoria({{ $categoria->id }})"
                        class="">{{ $categoria->nombre }}</button>
                </div>
            @endforeach --}}

            <label class="">
                {!! Form::select('categoria_id', [null=>'Categoría'] + $categorias->toArray(),  $selectedCategoria, [
                    'wire:model' => 'selectedCategoria',
                    'class' => 'form-control',
                ]) !!}
            </label>
            <table class="table table-compact w-full">
                <thead>
                    <th>Plan</th>
                    <th>Clase</th>
                    <th>Días</th>
                    <th>Precio €</th>
                </thead>
                <tbody>
                    @if (!is_null($planes_diamante))
                        @foreach ($planes_diamante as $plan)
                            <tr>
                                <td>{{$plan->nombre}}</td>
                                <td>Diamante</td>
                                <td>{{$plan->dias}}</td>
                                <td>{{$plan->precio}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if (!is_null($planes_oro))
                        @foreach ($planes_oro as $plan)
                            <tr>
                                <td>{{$plan->nombre}}</td>
                                <td>Oro</td>
                                <td >{{$plan->dias}}</td>
                                <td>{{$plan->precio}}</td>
                            </tr>
                        @endforeach
                    @endif
                     @if (!is_null($planes_plata))
                        @foreach ($planes_plata as $plan)
                            <tr>
                                <td>{{$plan->nombre}}</td>
                                <td>Plata</td>
                                <td>{{$plan->dias}}</td>
                                <td>{{$plan->precio}}</td>
                            </tr>
                        @endforeach
                    @endif
                     @if (!is_null($planes_bronce))
                        @foreach ($planes_bronce as $plan)
                            <tr>
                                <td>{{$plan->nombre}}</td>
                                <td>Bronce</td>
                                <td>{{$plan->dias}}</td>
                                <td style="text-align: right">{{$plan->precio}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if (!is_null($planes_normal))
                        @foreach ($planes_normal as $plan)
                            <tr>
                                <td>{{$plan->nombre}}</td>
                                <td>Normal</td>
                                <td>{{$plan->dias}}</td>
                                <td>{{$plan->precio}}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>    



        </x-slot>

        <x-slot name="footer"></x-slot>
    </x-jet-dialog-modal>

</div>
