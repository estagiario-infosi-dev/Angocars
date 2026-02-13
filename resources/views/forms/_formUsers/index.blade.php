

<div class="row">
    <!-- Nome -->
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            class="form-control @error('name') is-invalid @enderror" 
            value="{{ old('name', $user->name ?? '') }}" 
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            class="form-control @error('email') is-invalid @enderror" 
            value="{{ old('email', $user->email ?? '') }}" 
            required
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Senha (condicional) -->
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">
            Senha 
            @if(Route::currentRouteName() == 'users.create')
                <span class="text-danger">*</span>
            @else
                <small class="text-muted">(deixe em branco para manter)</small>
            @endif
        </label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            class="form-control @error('password') is-invalid @enderror" 
            autocomplete="new-password"
            {{ Route::currentRouteName() == 'users.create' ? 'required' : '' }}
        >
        @error('password')
    <div class="invalid-feedback d-block text-danger fw-bold">
        {{ $message }}
    </div>
@enderror
    </div>

    <!-- confirmaçao da senha -->
    <div class="col-md-6 mb-3">
        <label for="password_confirmation" class="form-label">
            Confirmar Senha 
            @if(Route::currentRouteName() == 'users.create')
                <span class="text-danger">*</span>
            @endif
        </label>
        <input 
            type="password" 
            name="password_confirmation" 
            id="password_confirmation" 
            class="form-control @error('password_confirmation') is-invalid @enderror" 
            autocomplete="new-password"
            {{ Route::currentRouteName() == 'users.create' ? 'required' : '' }}
        >
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    

    <!-- Role -->
    <div class="col-md-6 mb-3">
        <label for="role" class="form-label">Nivel de Acesso <span class="text-danger">*</span></label>
        <select 
            name="role" 
            id="role" 
            class="form-control @error('role') is-invalid @enderror" 
            required
        >
            <option value="">Selecione um Nivel</option>
            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>
                Administrador
            </option>
            <option value="financial" {{ old('role', $user->role ?? '') == 'financial' ? 'selected' : '' }}>
                Financeiro
            </option>
            <option value="employee" {{ old('role', $user->role ?? '') == 'employee' ? 'selected' : '' }}>
                Funcionário
            </option>
        </select>
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- parametro para criar senha -->
    <div class="col-md-6 mb-3" style="color: #00ff; font-size: 0.9em;">
        <label class="form-label">Parâmetros da Senha</label>
        <ul>
        <li>Deve ter pelo menos 8 caracteres</li>
        <li>Deve ter um caracter especial($,#,&)</li>
        <li>Deve ter pelo menos uma letra maiúscula</li>
        <li>Deve ter pelo menos um número</li>
     </ul>
    </div>

     
</div>

<!-- Botões -->
<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('users.index') }}" class="btn btn-light">Cancelar</a>
    <button type="submit" class="btn btn-primary">
        {{ Route::currentRouteName() == 'users.create' ? 'Criar Usuário' : 'Atualizar Usuário' }}
    </button>
</div>