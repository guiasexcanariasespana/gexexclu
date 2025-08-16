@extends('adminlte::page')

@section('template_title')
    Update Precio
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Precio</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('states.show', $state) }}"> {{__('Back')}}</a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="get" action="{{ route('state.update_precio', $precio) }}"  role="form">
                            
                            @csrf

                            @include('admin.state.formprecio')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

   <script>  
    $(document).ready( function() {
        $("#name").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#slug',
        space: '-'
        });
    });
    </script>

@endsection
