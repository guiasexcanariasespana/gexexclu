@extends('adminlte::page')

@section('template_title')
    {{ $tag->name ?? 'Show Tag' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{__('Show')}} {{__('Tag')}}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tags.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $tag->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $tag->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Color:</strong>
                            {{ $tag->color }}
                        </div>
                        
                         <div class="form-group">
                            <strong>Rubro:</strong>
                            {{ $tag->rubros[$tag->rubro] }}
                        </div>
                        <div class="form-group">
                            <strong>Visible:</strong>
                            {{ $tag->visible }}
                        </div>
                        <div class="form-group">
                            <strong>Menu:</strong>
                            {{ $tag->menu }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
