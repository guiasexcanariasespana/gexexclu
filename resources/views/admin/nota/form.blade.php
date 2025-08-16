<div class="card bg-light p-3 mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" 
                   class="form-control @error('titulo') is-invalid @enderror" 
                   value="{{ old('titulo', $nota->titulo) }}" 
                   placeholder="Nota">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nota" class="form-label">Nota</label>
            <textarea name="nota" id="nota" 
                      class="form-control @error('nota') is-invalid @enderror" 
                      placeholder="Contenido de la nota">{{ old('nota', $nota->nota) }}</textarea>
            @error('nota')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer text-end mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Submit') }}
        </button>
    </div>
</div>