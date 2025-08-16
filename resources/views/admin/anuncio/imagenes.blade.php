@extends('adminlte::page')

@section('template_title')
    {{ $anuncio->name ?? 'Gest. Imágenes' }}
@endsection

@section('content')
 <link href = 
"https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
            rel = "stylesheet">
      
    <script src = 
"https://code.jquery.com/jquery-1.10.2.js">
    </script>
      
    <script src = 
"https://code.jquery.com/ui/1.10.4/jquery-ui.js">
    </script>
          
    <style>
  
        /* text align for the body */
        body {
            text-align: center;
        }
  
        /* image dimension */
        img{
            height: 200px;
            width: 350px;
        }
  
        /* imagelistId styling */
        #imageListId
        { 
        margin: 0; 
        padding: 0;
        list-style-type: none;
        }
        #imageListId div
        { 
            margin: 0 4px 4px 4px;
            padding: 0.4em;             
            display: inline-block;
        }
  
        /* Output order styling */
        #outputvalues{
        margin: 0 2px 2px 2px;
        padding: 0.4em; 
        padding-left: 1.5em;
        width: 250px;
        border: 2px solid dark-green; 
        background : gray;
        }
        .listitemClass 
        {
            border: 1px solid #006400; 
            width: 350px;     
        }
        .height{ 
            height: 10px;
        }
    </style>
          
    <script>
        $(function() {
            $( "#imageListId" ).sortable({
            update: function(event, ui) {
                getIdsOfImages();
            }//end update         
            });
        });
          
        function getIdsOfImages() {
            var values = [];
            $('.listitemClass').each(function (index) {
                values.push($(this).attr("id")
                        .replace("imageNo", ""));
            });
              
            $('#outputvalues').val(values);
        }
    </script>
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <span class="card-title">Imágenes</span>
            </div>
            <div class="float-right">

                <a class="btn btn-primary" href="{{ route('admin.anuncios.show', $anuncio) }}">
                    {{ __('Back') }}</a>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <strong>Imagenes a Cargar:</strong>
                {{ $anuncio->imagenes_pendientes() }}
            </div>
            <div class="form-group">
                <strong>Imágenes a Verificar:</strong>
                {{ $anuncio->cantidad_img_verificar() }}

            </div>

            <div class="form-group">
                <strong>Usuario:</strong>
                {{ $anuncio->user ? '(' . $anuncio->user->id . ') ' . $anuncio->user->name : 'N/D' }}
            </div>
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $anuncio->nombre }}
            </div>

            <div class="row">
                @foreach ($anuncio->imagenes_ordenadas as $img)
                    <div class="col-sm-3">
                        @php
                            $portada = false;
                            if (!is_null($img) and !is_null($anuncio->portada_id)) {
                                if ($img->id == $anuncio->portada_id) {
                                    $portada = true;
                                }
                            }
                            
                        @endphp

                        <div
                            class="card card-outline @if ($portada) card-danger @else card-success @endif">

                            <div class="card-header">
                                <div class="float-left">
                                    <span class="card-title">Imágen {{ $img->position }}</span>
                                </div>
                                <div class="float-right">
                                    @if (!is_null($img) and !is_null($anuncio->portada_id))
                                        @if ($img->id == $anuncio->portada_id)
                                            Portada
                                        @endif
                                    @endif

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <div class="image-wrapper">
                                        <a href="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                            data-toggle="lightbox" data-gallery="gallery">
                                            <img src="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                class="img-fluid mb-2">
                                        </a>
                                    </div>
                                    <b>Nombre:</b> {{ $img->nombre }} <br />
                                    <b>Ubicación:</b> {{ $img->position }} <br />
                                    <b>Estado:</b> {{ $img->estado }} <br />

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


    <h1 style="color:green">GeeksforGeeks</h1>
      
    <b>Drag and drop using jQuery UI Sortable</b>
      
    <div class="height"></div><br>
      
    <div id = "imageListId">
        @foreach ($anuncio->imagenes_ordenadas as $img)
        <div id="imageNo1" class = "listitemClass">
            <img src="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}" alt="">
        </div>
         @endforeach 
       
    </div>
          
    <div id="outputDiv">
        <b>Output of ID's of images : </b>
        <input id="outputvalues" type="text" value="" />
    </div>



    @endsection
