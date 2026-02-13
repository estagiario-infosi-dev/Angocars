@include('extra._ckeditor.index')
<div class="row">
  
   <!-- Marca -->
<div class="col-lg-4 mb-3">
    <label class="form-label">Marca <span class="text-danger">*</span></label>
    <select name="brand_id" id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
        <option value="">Selecione a Marca</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ old('brand_id', $car->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                {{ $brand->name }}
            </option>
        @endforeach
    </select>
    @error('brand_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Modelo -->
<div class="col-lg-4 mb-3">
    <label class="form-label">Modelo <span class="text-danger">*</span></label>
    <select name="models_id" id="models_id" class="form-select @error('models_id') is-invalid @enderror" required>
        <option value="">Selecione primeiro a Marca</option>
        <!-- As opções serão carregadas via AJAX -->
    </select>
    @error('models_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- *** CAMPO ADICIONADO - FOTO PRINCIPAL (este era o que faltava) *** -->
<div class="col-lg-4 mb-3">
    <label class="form-label">Foto Principal do Carro <span class="text-danger">*</span></label>
    @if(isset($car) && $car->image)
        <div class="mb-2">
            <img src="{{ url('uploads/car/car_images/' . $car->image) }}" width="150" class="rounded img-thumbnail">
        </div>
    @endif
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

    <!-- Cor -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Cor</label>
        <select name="color_id" class="form-select @error('color_id') is-invalid @enderror">
            <option value="">Selecione a Cor</option>
            @foreach($colors as $color)
                <option value="{{ $color->id }}" {{ old('color_id', $car->color_id ?? '') == $color->id ? 'selected' : '' }}>
                    {{ $color->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Combustível -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Combustível</label>
        <select name="fuel_id" class="form-select @error('fuel_id') is-invalid @enderror">
            <option value="">Selecione o Tipo</option>
            @foreach($fuels as $fuel)
                <option value="{{ $fuel->id }}" {{ old('fuel_id', $car->fuel_id ?? '') == $fuel->id ? 'selected' : '' }}>
                    {{ $fuel->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Fornecedor -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Fornecedor</label>
        <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
            <option value="">Selecione o Fornecedor</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id', $car->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Categoria -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Categoria</label>
        <select name="category" class="form-select @error('category') is-invalid @enderror">
            <option value="Luxury" {{ old('category', $car->category ?? '') == 'Luxury' ? 'selected' : '' }}>Luxo</option>
            <option value="Standard" {{ old('category', $car->category ?? '') == 'Standard' ? 'selected' : '' }}>Padrão / Intermediário</option>
            <option value="Economy" {{ old('category', $car->category ?? '') == 'Economy' ? 'selected' : '' }}>Econômico</option>
        </select>
    </div>

    <!-- Número de Chassi -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Número de Chassi</label>
        <input type="text" name="chassi" class="form-control @error('chassi') is-invalid @enderror"
               value="{{ old('chassi', $car->chassi ?? '') }}">
        @error('chassi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- Placa -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Placa ou Matrícula</label>
        <input type="text" name="license_plate" class="form-control @error('license_plate') is-invalid @enderror"
               value="{{ old('license_plate', $car->license_plate ?? '') }}">
        @error('license_plate') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- Quilometragem -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Quilometragem (km)</label>
        <input type="number" name="mileage" class="form-control @error('mileage') is-invalid @enderror"
               value="{{ old('mileage', $car->mileage ?? '') }}" min="0">
    </div>

    <!-- Número de Portas / Assentos -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Número de Portas</label>
        <input type="number" name="number_of_doors" class="form-control" value="{{ old('number_of_doors', $car->number_of_doors ?? '') }}" min="2" max="6">
    </div>

    <div class="col-lg-4 mb-3">
        <label class="form-label">Número de Assentos</label>
        <input type="number" name="number_of_seats" class="form-control" value="{{ old('number_of_seats', $car->number_of_seats ?? '') }}" min="2" max="56">
    </div>

    <!-- Motor e Transmissão -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Motor</label>
        <input type="text" name="engine" class="form-control" value="{{ old('engine', $car->engine ?? '') }}" placeholder="">
    </div>

    <div class="col-lg-4 mb-3">
        <label class="form-label">Transmissão</label>
        <select name="transmission" class="form-select">
            <option value="Manual" {{ old('transmission', $car->transmission ?? '') == 'Manual' ? 'selected' : '' }}>Manual</option>
            <option value="Automático" {{ old('transmission', $car->transmission ?? '') == 'Automático' ? 'selected' : '' }}>Automático</option>
        </select>
    </div>

    <!-- Ano de Fabricação -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Ano de Fabricação</label>
        <select name="manufacture_date" class="form-select">
            <option value="">Selecione o ano</option>
            @for ($year = now()->year + 1; $year >= 1990; $year--)
                <option value="{{ $year }}" {{ old('manufacture_date', $car->manufacture_date ?? '') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endfor
        </select>
    </div>

    <!-- Data de Registro -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Data de Registro</label>
        <input type="date" name="registration_date" class="form-control"
               value="{{ old('registration_date', $car->registration_date ?? now()->format('Y-m-d')) }}">
    </div>



    <!-- Estado -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Estado</label>
        <select name="status" class="form-select">
            <option value="available" {{ old('status', $car->status ?? '') == 'available' ? 'selected' : '' }}>Disponível</option>
            <option value="reserved" {{ old('status', $car->status ?? '') == 'reserved' ? 'selected' : '' }}>Reservado</option>
            <option value="rented" {{ old('status', $car->status ?? '') == 'rented' ? 'selected' : '' }}>Alugado</option>
            <option value="maintenance" {{ old('status', $car->status ?? '') == 'maintenance' ? 'selected' : '' }}>Em Manutenção</option>
            <option value="unavailable" {{ old('status', $car->status ?? '') == 'unavailable' ? 'selected' : '' }}>Inativo</option>
        </select>
    </div>

     <!-- Documentos -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Seguro</label>
        <div class="input-group">
            <input type="text" name="car_insurance" class="form-control" value="{{ old('car_insurance', $car->car_insurance ?? '') }}" placeholder="">
            <input type="file" name="car_insurance_upload" class="form-control" accept="application/pdf">
        </div>
    </div>

    

    <!-- Fotos Adicionais -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Foto do Interior</label>
        @if(isset($car) && $car->interior_image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $car->interior_image) }}" width="150" class="rounded img-thumbnail">
            </div>
        @endif
        <input type="file" name="interior_image" class="form-control" accept="image/*">
    </div>

    <div class="col-lg-4 mb-3">
        <label class="form-label">Foto Lateral</label>
        @if(isset($car) && $car->lateral_image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $car->lateral_image) }}" width="150" class="rounded img-thumbnail">
            </div>
        @endif
        <input type="file" name="lateral_image" class="form-control" accept="image/*">
    </div>

    <div class="col-lg-4 mb-3">
        <label class="form-label">Foto do Exterior</label>
        @if(isset($car) && $car->exterior_image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $car->exterior_image) }}" width="150" class="rounded img-thumbnail">
            </div>
        @endif
        <input type="file" name="exterior_image" class="form-control" accept="image/*">
    </div>

   <div class="col-lg-4 mb-3">
        <label class="form-label">Documento do Carro</label>
        <div class="input-group">
            <input type="text" name="car_document" class="form-control" value="{{ old('car_document', $car->car_document ?? '') }}" placeholder="">
            <input type="file" name="car_document_upload" class="form-control" accept="application/pdf">
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <label class="form-label">Inspeção</label>
        <div class="input-group">
            <input type="date" name="inspection_date" class="form-control" value="{{ old('inspection_date', $car->inspection_date ?? '') }}">
            <input type="file" name="inspection_document_upload" class="form-control" accept="application/pdf">
        </div>
    </div>

    <!-- Preço -->
    <div class="col-lg-4 mb-3">
        <label class="form-label">Preço Diário (Kz)</label>
        <input type="number" name="price" class="form-control" step="0.01" min="0"
               value="{{ old('price', $car->price ?? '') }}">
    </div>

    <!-- Tipo de Carro -->
    <div class="col-lg-12 mb-3">
        <label class="form-label">Tipo de Carro</label>
        <select name="type_car" class="form-select" required>
            <option value="sedan" {{ old('type_car', $car->type_car ?? '') == 'sedan' ? 'selected' : '' }}>Executivo</option>
            <option value="suv" {{ old('type_car', $car->type_car ?? '') == 'suv' ? 'selected' : '' }}>Aventura</option>
            <option value="compact" {{ old('type_car', $car->type_car ?? '') == 'compact' ? 'selected' : '' }}>Urbano</option>
            <option value="station_wagon" {{ old('type_car', $car->type_car ?? '') == 'station_wagon' ? 'selected' : '' }}>Turismo</option>
            <option value="sports_car" {{ old('type_car', $car->type_car ?? '') == 'sports_car' ? 'selected' : '' }}>Esportivo</option>
            <option value="minivan" {{ old('type_car', $car->type_car ?? '') == 'minivan' ? 'selected' : '' }}>Viagem</option>
            <option value="compact_suv" {{ old('type_car', $car->type_car ?? '') == 'compact_suv' ? 'selected' : '' }}>Família</option>
            <option value="coupe" {{ old('type_car', $car->type_car ?? '') == 'coupe' ? 'selected' : '' }}>Gala</option>
            <option value="sports_coupe" {{ old('type_car', $car->type_car ?? '') == 'sports_coupe' ? 'selected' : '' }}>Gala Esportivo</option>
        </select>
    </div>

    <!-- Observações -->
    <div class="col-lg-12 mb-4">
        <label class="form-label">Observações</label>
        <textarea name="observations" class="form-control" rows="4" id="editor">{{ old('observations', $car->observations ?? '') }}</textarea>
    </div>

    <!-- Botões -->
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            {{ $buttonText ?? 'Salvar Carro' }}
        </button>
    </div>
</div>