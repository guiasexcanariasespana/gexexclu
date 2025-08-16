<div class="card">
    <div class="card-header">
        <div class="float-left">
            <span class="card-title">
                <b>{{ __('SEO')}}</b>
            </span>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="title">
                Title
            </label>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            {{ Form::text('title', $provincia->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Ingresa title para seo']) }}
        </div>
        <div class="form-group">
            <label for="keywords">
                Keywords (separala por comas ',')
            </label>
            @error('keywords')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            
            {{ Form::text('keywords', $provincia->keywords, ['class' => 'form-control' . ($errors->has('keywords') ? ' is-invalid' : ''), 'placeholder' => 'keywords']) }}

        
        </div>
        <div class="form-group">
            <label for="content">
                Description
            </label>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            {!! Form::textarea('description', $provincia->description, [
                'class' => 'form-control',
                'placeholder' => 'Description SEO',
            ]) !!}
        </div>
        
    </div>
</div>