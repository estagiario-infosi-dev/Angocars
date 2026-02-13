<div class="row">
    <!-- Nome Completo -->
    <div class="col-md-6 mb-3">
        <label for="full_name" class="form-label">Nome Completo <span class="text-danger">*</span></label>
        <input type="text"
               name="full_name"
               placeholder=""
               id="full_name"
               class="form-control @error('full_name') is-invalid @enderror"
               value="{{ old('full_name', $driver->full_name ?? '') }}"
               required>
        @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email"
               name="email"
               id="email"
               placeholder=""
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $driver->email ?? '') }}"
               required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Telefone -->
    <div class="col-md-6 mb-3">
        <label for="phone_number" class="form-label">Telefone <span class="text-danger">*</span></label>
        <input type="text"
               name="phone_number"
               placeholder=""
               id="phone_number"
               class="form-control @error('phone_number') is-invalid @enderror"
               value="{{ old('phone_number', $driver->phone_number ?? '') }}"
               required>
        @error('phone_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Gênero -->
    <div class="col-md-6 mb-3">
        <label for="gender" class="form-label">Gênero</label>
        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
            <option value="">Selecione</option>
            <option value="male" {{ old('gender', $driver->gender ?? '') == 'male' ? 'selected' : '' }}>Masculino</option>
            <option value="female" {{ old('gender', $driver->gender ?? '') == 'female' ? 'selected' : '' }}>Feminino</option>
        </select>
        @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Anos de Experiência -->
    <div class="col-md-6 mb-3">
        <label for="experience_years" class="form-label">Anos de Experiência</label>
        <input type="number"
               name="experience_years"
               id="experience_years"
               class="form-control @error('experience_years') is-invalid @enderror"
               value="{{ old('experience_years', $driver->experience_years ?? 0) }}"
               min="0">
        @error('experience_years')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Endereço -->
    <div class="col-md-6 mb-3">
        <label for="address" class="form-label">Endereço</label>
        <textarea name="address"
                  id="address"
                  placeholder=""
                  class="form-control @error('address') is-invalid @enderror"
                  rows="2">{{ old('address', $driver->address ?? '') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Documento de Identificação -->
    <div class="col-md-6 mb-3">
        <label class="form-label">Documento de Identificação <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text"
                   name="document_identification"
                   placeholder=""
                   class="form-control @error('document_identification') is-invalid @enderror"
                   value="{{ old('document_identification', $driver->document_identification ?? '') }}"
                   required>
            <input type="file"
                   name="id_image"
                   class="form-control @error('id_image') is-invalid @enderror"
                   accept="application/pdf,application/msword,image/*">
        </div>
        @error('document_identification')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error('id_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if(isset($driver) && $driver->id_image)
            <small class="text-muted d-block mt-1">Imagem atual: {{ basename($driver->id_image) }}</small>
        @endif
    </div>

    <!-- Carta de Condução -->
    <div class="col-md-6 mb-3">
        <label class="form-label">Tipo de Carta de Condução <span class="text-danger">*</span></label>
        <div class="input-group">
            <select name="license_type" class="form-select @error('license_type') is-invalid @enderror" required>
                <option value="">Selecione o tipo</option>
                <option value="Ligeiro Profissional" {{ old('license_type', $driver->license_type ?? '') == 'Ligeiro Profissional' ? 'selected' : '' }}>
                    Ligeiro Profissional
                </option>
                <option value="Pesado Profissional" {{ old('license_type', $driver->license_type ?? '') == 'Pesado Profissional' ? 'selected' : '' }}>
                    Pesado Profissional
                </option>
            </select>
            <input type="file"
                   name="license_image"
                   class="form-control @error('license_image') is-invalid @enderror"
                   accept="application/pdf,application/msword,image/*">
        </div>
        @error('license_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error('license_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if(isset($driver) && $driver->license_image)
            <small class="text-muted d-block mt-1">Imagem atual: {{ basename($driver->license_image) }}</small>
        @endif
    </div>

    <!-- Tipo de Motorista & Expiração da Carta -->
    <div class="col-md-6 mb-3">
        <label class="form-label">Tipo de Motorista <span class="text-danger">*</span></label>
        <select name="driver_type" class="form-select @error('driver_type') is-invalid @enderror" required>
            <option value="">Selecione o tipo</option>
            <option value="Motorista Local" {{ old('driver_type', $driver->driver_type ?? '') == 'Motorista Local' ? 'selected' : '' }}>
                Motorista Local
            </option>
            <option value="Motorista Interprovincial" {{ old('driver_type', $driver->driver_type ?? '') == 'Motorista Interprovincial' ? 'selected' : '' }}>
                Motorista Interprovincial
            </option>
        </select>
        @error('driver_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Data de Expiração da Carta -->
    <div class="col-md-6 mb-3">
        <label for="license_expiry_date" class="form-label">Expiração da Carta <span class="text-danger">*</span></label>
        <input type="date"
               name="license_expiry_date"
               id="license_expiry_date"
               class="form-control @error('license_expiry_date') is-invalid @enderror"
               value="{{ old('license_expiry_date', $driver->license_expiry_date ?? '') }}"
               required>
        @error('license_expiry_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Preço Diário -->
    <div class="col-md-6 mb-3">
        <label for="daily_price" class="form-label">Preço Diário (Kz) <span class="text-danger">*</span></label>
        <input type="number"
               name="daily_price"
               id="daily_price"
               class="form-control @error('daily_price') is-invalid @enderror"
               value="{{ old('daily_price', $driver->daily_price ?? 0) }}"
               min="0"
               step="0.01"
               required>
        @error('daily_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Botões -->
<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('drivers.index') }}" class="btn btn-light">Cancelar</a>
    <button type="submit" class="btn btn-primary">
        {{ $buttonText ?? 'Salvar Motorista' }}
    </button>
</div>