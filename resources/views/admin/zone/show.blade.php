@extends('adminlte::page')

@section('template_title')
    {{ $zone->name ?? 'Show Zone' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{__('Show')}} {{__('Zone')}}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('zones.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>

                    <div class="card-body">
                         <div class="form-group">
                            <strong>Provincia:</strong>
                            {{ $zone->municipio ? $zone->municipio->provincia->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Municipio:</strong>
                            {{ $zone->municipio ? $zone->municipio->nombre : 'N/D' }}
                        </div>

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $zone->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $zone->slug }}
                        </div>

                    </div>
                </div>
            </div>
        </div>



<div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Precios') }}
                    </span>

                    <div class="float-right">
                        <a href="{{ route('zone.create_precio', $zone) }}" class="btn btn-primary btn-sm float-right"
                            data-placement="left">
                            {{ __('Create New') }}
                        </a>
                    </div>

                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card-body">
                <div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Plan</th>

                                    <th>Dias</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($zone->precios as $precio)
                                    <tr>
                                        <td>{{ $precio->plane->nombre }}</td>
                                        <td>{{ $precio->plane->dias }}</td>
                                        <td>{{ $precio->precio }}</td>
                                        
                                        <td> @can('admin.zones.precio')
                                            <form action="{{ route('zone.delete_precio',$precio) }}" method="post">                                                    
                                                    <a class="btn btn-sm btn-success" href="{{ route('zone.edit_precio',$precio) }}"><i class="fa fa-fw fa-edit"></i> {{__('Edit')}} </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm show-alert"><i class="fa fa-fw fa-trash"></i> {{__('Delete')}} </button>
                                                </form>
                                            @endcan
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/sw2alert.js') }}"></script>
@endsection