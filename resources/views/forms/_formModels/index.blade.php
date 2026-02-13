@include('extra._ckeditor.index')
<div class="row">
   
 <!-- Marca -->
    <div class="col-lg-4 mb-4">
        <label class="form-label">Marca <span class="text-danger">*</span></label>
        <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
            <option value="">Selecione uma marca</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" 
                    {{ old('brand_id', $model->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
        @error('brand_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Nome do Modelo -->
    <div class="col-lg-4 mb-4">
        <label class="form-label">Modelo <span class="text-danger">*</span></label>
        <input type="text" 
               name="name" 
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $model->name ?? '') }}" 
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
               value="{{ old('date', $model->date ?? now()->format('Y-m-d')) }}">
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
                  placeholder="" id="editor">{{ old('description', $model->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Botões -->
    <div class="col-12">
       
        <button type="submit" class="btn btn-primary">
            {{ $buttonText ?? 'Salvar Modelo' }}
        </button>
    </div>
</div>