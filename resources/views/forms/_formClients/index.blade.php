<div class="row">
    <!-- Nome -->
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
        <input type="text" 
               class="form-control @error('name') is-invalid @enderror" 
               id="name" 
               name="name"
               value="{{ old('name', $client->name ?? '') }}" 
               required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" 
               class="form-control @error('email') is-invalid @enderror" 
               id="email" 
               name="email"
               value="{{ old('email', $client->email ?? '') }}" 
               required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Telefone -->
    <div class="col-md-6 mb-3">
        <label for="phone" class="form-label">Telefone</label>
        <input type="text" 
               class="form-control @error('phone') is-invalid @enderror" 
               id="phone" 
               name="phone"
               value="{{ old('phone', $client->phone ?? '') }}">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Senha -->
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">Senha</label>
        <div class="pass-group">
            <input type="password" 
                   class="form-control pass-input @error('password') is-invalid @enderror"
                   id="password" 
                   name="password"
                   placeholder="">
            <span class="fas fa-eye-slash toggle-password"></span>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <small class="text-muted">Deixe vazio para não alterar a senha</small>
    </div>
</div>

<!-- Botões -->
<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">
        {{ $buttonText ?? 'Salvar Cliente' }}
    </button>
</div>

<style>
    .pass-group {
        position: relative;
    }

    .pass-group .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        font-size: 1rem;
    }

    .pass-group .toggle-password:hover {
        color: #000;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.querySelector('.toggle-password');
        const input = document.querySelector('.pass-input');

        if (toggle && input) {
            toggle.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>