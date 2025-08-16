<div class="form-group">
    {!! Form::label('name','Nombre') !!}
    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Ingrese el nombre de la categoría']) !!}
    
   @error('name')
       <span class="text-danger">{{$message}}</span>
   @enderror            
   </div>  
   
   <h2 class='h3'> Lista de Permisos </h2>
   
   @foreach ($permisos as $permiso)
       <div>
           <label for="">
               {!! Form::checkbox('permissions[]', $permiso->id, null, ['class'=>'mr-1']) !!}
               {{$permiso->description}}
           </label>
       </div>
       
   @endforeach