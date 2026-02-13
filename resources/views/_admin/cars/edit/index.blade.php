@extends('layout._admin.main')
@section('title', 'Duralux || Editar Carro')

@section('content-admin')

<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Editar Carro</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cars.index') }}">Carros</a></li>
                <li class="breadcrumb-item">Editar</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('forms._formCars.index', [
                                'car' => $car,
                                'brands' => $brands,
                                'models' => $models,
                                'colors' => $colors,
                                'fuels' => $fuels,
                                'suppliers' => $suppliers,
                                'buttonText' => 'Atualizar Carro'
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection