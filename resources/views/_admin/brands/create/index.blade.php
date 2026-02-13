@extends('layout._admin.main')
@section('title', 'Duralux || Brand Create')
@section('content-admin')

<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Marcas</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Criar</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                <!--<a href="javascript:void(0);" class="btn btn-light-brand successAlertMessage">
                        <i class="feather-layers me-2"></i>
                        <span>Save as Draft</span>
                    </a>  -->
                    <!-- <a href="javascript:void(0);" class="btn btn-primary successAlertMessage">
                        <i class="feather-save me-2"></i>
                        <span>Salvar Marca</span>
                    </a> -->
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <div class="col-xl-16">
                <div class="card invoice-container">
                    <div class="card-header">
                        <h5>Cadastro de Marca</h5>
                    
                    </div>
                    <div class="card-body p-0">
                        <div class="px-4 pt-4">
                            <div class="d-md-flex align-items-center justify-content-between">
                             
                            </div>
                        </div>
                       
                        
                              <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('forms._formBrands.index', [
        'brand' => null,
        'buttonText' => 'Criar Marca'
    ])
</form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection