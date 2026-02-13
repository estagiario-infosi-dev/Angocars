@include('extra._ckeditor.index')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    {{-- Nome --}}
    <div class="col-lg-4 mb-4">
        <label class="form-label">Marca</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $brand->name ?? '') }}"
            placeholder=""
        >
    </div>

    {{-- Logo --}}
    <!-- <div class="col-lg-4 mb-3">
        <label class="form-label">Logo da Marca</label>
        <input type="file" name="image" class="form-control" accept="image/*">

        @if (!empty($brand->image))
            <small class="d-block mt-2">
                <img src="{{ asset('uploads/brand/brand_logo/' . $brand->image) }}"
                     alt="Logo atual"
                     width="80"
                     class="img-thumbnail">
            </small>
        @endif
    </div> -->

    {{-- Data --}}
    <div class="col-lg-4 mb-3">
        <label class="form-label">Data de Registro</label>
        <input
            type="date"
            name="date"
            class="form-control"
            value="{{ old('date', $brand->date ?? '') }}"
        >
    </div>

    {{-- Descrição --}}
    <div class="col-12 mb-4">
        <label class="form-label">Descrição</label>
        <textarea
            name="description"
            class="form-control"
            rows="4"
            placeholder=""
        id="editor">{{ old('description', $brand->description ?? '') }}</textarea>
    </div>

    {{-- Botão --}}
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            {{ $buttonText ?? 'Salvar' }}
        </button>
    </div>
</div>
