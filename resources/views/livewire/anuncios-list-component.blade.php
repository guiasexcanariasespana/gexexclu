<div>

    <div class="row">
        <div class="form-group px-3 col-lg-1">
            <select name='mostrar_cantidad' id='mostrar_cantidad' wire:model='mostrar_cantidad' class='form-control'>
                @foreach ([10, 25, 50, 100] as $cantidad)
                    <option value="{{ $cantidad }}">{{ $cantidad }}</option>
                @endforeach
            </select>
        </div>
        <div class='form-group col-lg-11 w-100'>
            <input type='text' class='form-control' placeholder='Buscar por términos---> Edad, Provincia, Nombre, etc'
                wire:model='search' />
        </div>
       
    </div>
     <div class='form-group '> {{ $anuncios->links() }}</div>
    <div class="table-responsive">


        <table id='listanuncios' class="table ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>User</th>
                    <th wire:click="order('fecha_de_publicacion')" style='	cursor: pointer;'>Publ.</th>
                    <th wire:click="order('fecha_caducidad')" style='	cursor: pointer;'>Vence</th>
                    <th>Clase</th>
                    <th>Categoria</th>
                    <th>Zona</th>
                    <th>Plan</th>
                    <th wire:click="order('estado')" style='	cursor: pointer;'>Estado</th>
                    {{-- <th>Destacado</th> --}}
                    {{-- <th wire:click="order('verificacion')" style='	cursor: pointer;'>Verificado </th> --}}
                    <th> Ver</th>
                    <th> Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @php
                    
                    $today = \Carbon\Carbon::now();
                    $hoy = $today->toDateString();
                    $tres_dias = $today->addDays(3);
                @endphp
                @foreach ($anuncios as $anuncio)
                    @php
                        $color = null;
                        if ($anuncio->estado == 'Finalizado') {
                            $color = '#FABFBD'; //FBD3B6 FABFBD
                        } else {
                            //verifico si está a menos de 3 días para vencer
                            if (!is_null($anuncio->fecha_caducidad)) {
                                if ($anuncio->fecha_caducidad < $hoy) {
                                    $color = '#FE362F';
                                } else {
                                    if ($anuncio->fecha_caducidad <= $tres_dias) {
                                        $color = '#FBD3B6';
                                    }
                                }
                            }
                        }
                    @endphp
                    <tr bgcolor='{{ $color }}'>
                        <td>{{ $anuncio->id }}</td>
                        <td @if ($anuncio->user) title="{{ $anuncio->user->name }} - {{ $anuncio->user->email }}" @endif>
                            {{ $anuncio->nombre }}</td>
                        {{-- <td @if ($anuncio->user) title="{{ $anuncio->user->email }}" @endif>
                            @if ($anuncio->user)
                                {{ $anuncio->user->name }}
                            @else
                                N/D
                            @endif --}}
                        </td>
                        <td>{{ $anuncio->fecha_de_publicacion ? date('d-m-Y', strtotime($anuncio->fecha_de_publicacion)) : '' }}
                        </td>
                        <td>{{ $anuncio->fecha_caducidad ? date('d-m-Y', strtotime($anuncio->fecha_caducidad)) : '' }}
                        </td>
                        <td>{{ $anuncio->clase ? $anuncio->clase->nombre : 'N/D' }}</td>
                        <td>{{ $anuncio->categoria ? $anuncio->categoria->nombre : 'N/D' }}</td>
                        <td>
                            {{ $anuncio->localidad }}</td>
                        <td
                            title="{{ $anuncio->categoria ? $anuncio->categoria->nombre : 'N/D'  }} {{ $anuncio->clase ? $anuncio->clase->nombre : 'N/D' }} Días: {{ $anuncio->dias }}  €:{{ $anuncio->precio }}">
                            {{ $anuncio->plane ? $anuncio->plane->nombre : 'N/D' }}</td>
                        <td>
                            {{-- @livewire('anuncio-estado-component', ['anuncio' => $anuncio], key($anuncio->id)) --}}
                            {{ $anuncio->estado }}
                        </td>

                        <td>
                            <a class="btn btn-info btn-sm ml-4"
                                href="{{ route('admin.users.edit_anuncio', $anuncio) }}">
                                Ver
                            </a>
                        </td>
                        <td>
                            @livewire('anuncio-quitar-component', compact('anuncio'), key($anuncio->id . time()))

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



        <div> {{ $anuncios->links() }}</div>
    </div>

</div>
