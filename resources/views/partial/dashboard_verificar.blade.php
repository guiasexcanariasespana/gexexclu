               @if (is_null($user->imagen_verificacion)) 
               <h2>Por favor debes subir una foto de verificación</h2>
               @else
               <h2>Ya has subido la foto de verificación, aguarda el mensaje de confirmación</h2>
               @endif
                <button class="btn btn-primary mt-8 mx-auto hover:bg-pink-500">
                <a  class="animate-pulse  text-white" href="{{route('subir_foto_valida', $user )}}">{{__('Subir imagen de verificación')}}</a>
                </button>

          


    
