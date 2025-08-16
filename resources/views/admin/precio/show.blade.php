@extends('layouts.app')

@section('template_title')
    {{ $precio->name ?? 'Show Precio' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Precio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $precio->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Plan Id:</strong>
                            {{ $precio->plan_id }}
                        </div>
                        <div class="form-group">
                            <strong>Zone Id:</strong>
                            {{ $precio->zone_id }}
                        </div>
                        <div class="form-group">
                            <strong>State Id:</strong>
                            {{ $precio->state_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
