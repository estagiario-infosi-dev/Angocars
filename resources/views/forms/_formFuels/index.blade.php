@include('extra._ckeditor.index')
<div class="row">
    <!-- Nome do Combustível -->
    <div class="col-lg-4 mb-4">
        <label class="form-label">Combustível <span class="text-danger">*</span></label>
        <input type="text" 
               name="name" 
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $fuel->name ?? '') }}" 
               placeholder=""
               required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Data de Cadastro -->
    <div class="col-lg-4 mb-4">
        <label class="form-label">Data de Cadastro</label>
        <input type="date" 
               name="date" 
               class="form-control @error('date') is-invalid @enderror"
               value="{{ old('date', $fuel->date ?? now()->format('Y-m-d')) }}"
               min="1900-01-01">
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Descrição -->
    <div class="col-lg-12 mb-4">
        <label class="form-label">Descrição</label>
        <textarea name="description" 
                  class="form-control @error('description') is-invalid @enderror" 
                  rows="4" 
                  placeholder="" id="editor">{{ old('description', $fuel->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Botões -->
    <div class="col-12">
        
        <button type="submit" class="btn btn-primary">
            {{ $buttonText ?? 'Salvar Combustível' }}
        </button>
    </div>
</div>