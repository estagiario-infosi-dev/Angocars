@extends('site.reservation.layouts.main')
@section('title', 'AngoCars Detalhe do Carro')
@section('content')

    <div class="main-wrapper">
        <!-- Breadcrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">{{ $car->brand->name }} {{ $car->models->name }}</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">{{ $car->brand->name }}
                                    {{ $car->models->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb Section -->

        <!-- Detail Page Head -->
        <section class="product-detail-head">
            <div class="container">
                <div class="detail-page-head">
                    <div class="detail-headings">
                        <div class="star-rated">
                            <ul class="list-rating">
                                <li>
                                    <div class="car-brand">
                                        <span>
                                            <img src="{{ url('assets/user/img/icons/car-icon.svg') }}" alt="img">
                                        </span>
                                        {{ $car->category }}
                                    </div>
                                </li>
                                <li>
                                    <span class="year">{{ $car->manufacture_date }}</span>
                                </li>
                            
                            </ul>
                            <div class="camaro-info">
                                <h3>{{ $car->brand->name }} {{ $car->models->name }}</h3>
                                <div class="camaro-location">
                                    <!-- <div class="camaro-location-inner">
                                        <i class='bx bx-map'></i>
                                        <span>Localização: {{ $car->supplier->address ?? 'Não informado' }}</span>
                                    </div> -->
                                    <!-- Restante do código -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Detail Page Head -->

        <section class="section product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="detail-product" >
                            <div class="pro-info">
                                <div class="pro-badge"></div>
                            </div>
                            <div class="slider detail-bigimg slider detail-bigimg img-slider owl-carousel owl-theme" >
                                @if ($car->image)
                                    <div class="product-img">
                                        <img src="{{ url('uploads/car/car_images/' . $car->image) }}" alt="Car Image">
                                    </div>
                                @else
                                    <div class="product-img">
                                        <img src="{{url('uploads/car/car_images/' . $car->image)}}" alt="Slider">
                                    </div>
                                @endif
                               
                                 @if ($car->interior_image)
                                    <div class="product-img">
                                        <img src="{{ asset($car->interior_image) }}" alt="Imagem do Interior" class="img-fluid">
                                    </div>
                                @else
                                    <div class="product-img">
                                        <img src="{{url('uploads/car/car_images/' . $car->image)}}" alt="Slider">
                                    </div>
                                @endif
                                
                                @if($car->interior_image)
                                <div class="product-img">
                                    <img src="{{ asset($car->exterior_image) }}" alt="Imagem do exterior" class="img-fluid">
                                </div>
                                @else
                                <div class="product-img">
                                    <img src="{{ url('uploads/car/car_images/' . $car->image)}}" alt="Slider">
                                </div>
                                @endif

                                 
                                @if($car->lateral_image)
                                <div class="product-img">
                                    <img src="{{ asset($car->lateral_image) }}" alt="Imagem lateral" class="img-fluid">
                                </div>
                                @else
                                <div class="product-img">
                                    <img src="{{ url('uploads/car/car_images/' . $car->image)}}" alt="Slider">
                                </div>
                                @endif
                            </div>
                        </div>
                      

                        <!-- Listing Section -->
                        <div class="review-sec mb-0">
                            <div class="review-header">
                                <h4>Descrição do Carro</h4>
                            </div>
                            <div class="description-list">
                                <p>{{ $car->observations ?? 'Sem descrição disponível.' }}</p>
                            </div>
                        </div>
                        <!-- /Listing Section -->

                        <!-- Specifications -->
                        <div class="review-sec specification-card">
                            <div class="review-header">
                                <h4>Especificações</h4>
                            </div>
                            <div class="card-body">
                                <div class="lisiting-featues">
                                    <div class="row">
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-1.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>Categoria</span>
                                                <h6>{{ $car->category }}</h6>
                                            </div>
                                        </div>
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-2.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>Marca</span>
                                                <h6>{{ $car->brand->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-3.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>Transmissão</span>
                                                <h6>{{ $car->transmission }}</h6>
                                            </div>
                                        </div>
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-4.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>Combustível</span>
                                                <h6>{{ $car->fuel->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-5.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>Quilometragem</span>
                                                <h6>{{ $car->mileage ?? 'N/A' }} (Km)</h6>
                                            </div>
                                        </div>
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-7.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>ANO</span>
                                                <h6>{{ $car->manufacture_date ?? 'N/A' }}</h6>
                                            </div>
                                        </div>
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-10.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>PORTAS</span>
                                                <h6>{{ $car->number_of_doors ?? 'N/A' }} Doors</h6>
                                            </div>
                                        </div>
                                        <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                            <div class="feature-img">
                                                <img src="{{ url('assets/user/img/specification/specification-icon-12.svg') }}"
                                                    alt="Icon">
                                            </div>
                                            <div class="featues-info">
                                                <span>Potencia</span>
                                                <h6>{{ $car->engine ?? 'N/A' }} (KVA)</h6>
                                            </div>
                                        </div>
                                        <!-- Mantendo campos estáticos que não têm correspondência no modelo -->
                                        {{-- <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                        <div class="feature-img">
                                            <img src="{{ url('assets/user/img/specification/specification-icon-6.svg')}}" alt="Icon">
                                        </div>
                                        <div class="featues-info">
                                            <span>Drivetrain</span>
                                            <h6>Front Wheel</h6>
                                        </div>
                                    </div>
                                    <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                        <div class="feature-img">
                                            <img src="{{ url('assets/user/img/specification/specification-icon-8.svg')}}" alt="Icon">
                                        </div>
                                        <div class="featues-info">
                                            <span>AC</span>
                                            <h6>Air Condition</h6>
                                        </div>
                                    </div> 
                                    <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                        <div class="feature-img">
                                            <img src="{{ url('assets/user/img/specification/specification-icon-9.svg')}}" alt="Icon">
                                        </div>
                                        <div class="featues-info">
                                            <span>VIN</span>
                                            <h6>{{ $car->chassi }}</h6>
                                        </div>
                                    </div>
                                    <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                        <div class="feature-img">
                                            <img src="{{ url('assets/user/img/specification/specification-icon-11.svg')}}" alt="Icon">
                                        </div>
                                        <div class="featues-info">
                                            <span>Brake</span>
                                            <h6>ABS</h6>
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Specifications -->

                        <!-- Gallery -->
                        <!--  <div class="review-sec mb-0 pb-0">
                                <div class="review-header">
                                    <h4>Galeria</h4>
                                </div>
                                <div class="gallery-list">
                                    <ul>
                                        @if ($car->image)
    <li>
                                                <div class="gallery-widget">
                                                    <a href="{{ url('uploads/car/car_images/' . $car->image) }}" data-fancybox="gallery1">
                                                        <img class="img-fluid" alt="Image" src="{{ url('uploads/car/car_images/' . $car->image) }}">
                                                    </a>
                                                </div>
                                            </li>
@else
    <li>
                                                <div class="gallery-widget">
                                                    <a href="{{ url('uploads/car/car_images/' . $car->image) }}" data-fancybox="gallery1">
                                                        <img class="img-fluid" alt="Image" src="{{ url('uploads/car/car_images/' . $car->image) }}">
                                                    </a>
                                                </div>
                                            </li>
    @endif
                                        Mantendo imagens estáticas adicionais
                                       
                                    </ul>
                                </div>
                            </div> -->
                        <!-- /Gallery -->

                        <!-- Video -->
                        <!-- <div class="review-sec mb-0">
                            <div class="review-header">
                                <h4>Video</h4>
                            </div>
                            <div class="short-video">

                                <img class="img-fluid" alt="Image" src="{{ url('assets/user/img/video-img.jpg') }}">
                                <a href="https://www.youtube.com/embed/ExJZAegsOis" data-fancybox="video"
                                    class="video-icon">
                                    <i class="bx bx-play"></i>
                                </a>
                            </div>
                        </div> -->
                        <!-- /Video -->
                    </div>

                    <div class="col-lg-4 theiaStickySidebar">
                        <div class="review-sec mt-0">
                            <div class="review-header">
                                <h4>Precificação</h4>
                            </div>
                            <div class="mb-3">
                                <label class="booking_custom_check bookin-check-2">
                                    <input type="radio" name="price_rate" checked="">
                                    <span class="booking_checkmark">
                                        <span class="checked-title">Diário</span>
                                        <span class="price-rate">{{formatKz($car->price)}} Kz</span>
                                    </span>
                                </label>
                                {{-- <label class="booking_custom_check bookin-check-2">
                                    <input type="radio" name="price_rate">
                                    <span class="booking_checkmark">
                                        <span class="checked-title">Semanalmente</span>
                                        <span class="price-rate">$820</span>
                                    </span>
                                </label>
                                <label class="booking_custom_check bookin-check-2">
                                    <input type="radio" name="price_rate">
                                    <span class="booking_checkmark">
                                        <span class="checked-title">Mensal</span>
                                        <span class="price-rate">$2400</span>
                                    </span>
                                </label>
                                <label class="booking_custom_check bookin-check-2">
                                    <input type="radio" name="price_rate">
                                    <span class="booking_checkmark">
                                        <span class="checked-title">Anual</span>
                                        <span class="price-rate">$9400</span>
                                    </span>
                                </label> --}}
                            </div>
                            <div class="location-content">
                                {{-- <div class="delivery-tab">
                                    <ul class="nav">
                                        <li>
                                            <label class="booking_custom_check">
                                                <input type="radio" name="rent_type" checked="">
                                                <span class="booking_checkmark">
                                                    <span class="checked-title">Entrega</span>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="booking_custom_check">
                                                <input type="radio" name="rent_type">
                                                <span class="booking_checkmark">
                                                    <span class="checked-title">Auto-Retirada</span>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div> --}}
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="delivery">
                                        <form action="{{ route('site.reservation.step1', $car) }}"
                                            method="POST">
                                            @csrf
                                            <ul>
                                                <li class="column-group-main">
                                                    <div class="input-block">
                                                        <label>Local de Entrega</label>
                                                        <div class="group-img">
                                                            <div class="form-wrap">
                                                                <input type="text" name="pickup_location" class="form-control"
                                                                    placeholder="digite o lugar para entrega" required>
                                                                <span class="form-icon">
                                                                    <i class="fa-solid fa-location-crosshairs"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                {{-- <li class="column-group-main">
                                                    <div class="input-block">
                                                        <label class="custom_check d-inline-flex location-check m-0"><span>Retornar
                                                                ao mesma local</span>
                                                            <input type="checkbox" name="remeber">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </li>--}}
                                                <li class="column-group-main">
                                                    <div class="input-block">
                                                        <label>Local De devolução</label>
                                                        <div class="group-img">
                                                            <div class="form-wrap">
                                                                <input type="text" name="return_location" class="form-control"
                                                                    placeholder="digite o lugar para retorno" required>
                                                                <span class="form-icon">
                                                                    <i class="fa-solid fa-location-crosshairs"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li> 
                                                <li class="column-group-main">
                                                    <div class="input-block m-0">
                                                        <label>Data de Entrega</label>
                                                    </div>
                                                    <div class="input-block-wrapp sidebar-form">
                                                        <div class="input-block me-lg-2">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="start_date"
                                                                        class="form-control datetimepicker"
                                                                        placeholder="04/11/2023" required>
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-calendar-days"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-block">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="delivery_time" class="form-control timepicker"
                                                                        placeholder="11:00 AM" required>
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-clock"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="column-group-main">
                                                    <div class="input-block m-0">
                                                        <label>Data de Retorno</label>
                                                    </div>
                                                    <div class="input-block-wrapp sidebar-form">
                                                        <div class="input-block me-lg-2">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="end_date"
                                                                        class="form-control datetimepicker"
                                                                        placeholder="04/11/2023" required>
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-calendar-days"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-block">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="return_time" class="form-control timepicker"
                                                                        placeholder="11:00 AM" required>
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-clock"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="column-group-last">
                                                    <div class="input-block mb-0">
                                                        <div class="search-btn">
                                                            <button type="submit"
                                                                class="btn btn-primary check-available w-100">
                                                                Reservar
                                                            </button>
                                                            {{-- <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#enquiry"
                                                                class="btn btn-theme">Consulte-nos</a> --}}
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pickup">
                                        <form action="{{ route('site.reservation.step1',$car) }}" method="POST">
                                            @csrf
                                            <ul>
                                                <li class="column-group-main">
                                                    <div class="input-block">
                                                        <label>Local de Entrega</label>
                                                        <div class="group-img">
                                                            <select class="select" name="pickup_location">
                                                                <option>Newyork Office - 78, 10th street Laplace USA</option>
                                                                <option>Newyork Office - 12, 5th street USA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="column-group-main">
                                                    <div class="input-block">
                                                        <label class="custom_check d-inline-flex location-check m-0">
                                                            <span>Retornar ao mesmo local</span>
                                                            <input type="checkbox" name="remember">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li class="column-group-main">
                                                    <div class="input-block">
                                                        <label>Local de Retorno</label>
                                                        <div class="group-img">
                                                            <div class="form-wrap">
                                                                <input type="text" name="return_location" class="form-control"
                                                                    placeholder="78, 10th street Laplace USA">
                                                                <span class="form-icon">
                                                                    <i class="fa-solid fa-location-crosshairs"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="column-group-main">
                                                    <div class="input-block m-0">
                                                        <label>Data de Entrega</label>
                                                    </div>
                                                    <div class="input-block-wrapp sidebar-form">
                                                        <div class="input-block me-2">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="start_date" class="form-control datetimepicker"
                                                                        placeholder="04/11/2023">
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-calendar-days"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-block">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="delivery_time" class="form-control timepicker"
                                                                        placeholder="11:00 AM">
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-clock"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="column-group-main">
                                                    <div class="input-block m-0">
                                                        <label>Data de Retorno</label>
                                                    </div>
                                                    <div class="input-block-wrapp sidebar-form">
                                                        <div class="input-block me-2">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="end_date" class="form-control datetimepicker"
                                                                        placeholder="04/11/2023">
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-calendar-days"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-block">
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" name="return_time" class="form-control timepicker"
                                                                        placeholder="11:00 AM">
                                                                    <span class="form-icon">
                                                                        <i class="fa-regular fa-clock"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="column-group-last">
                                                    <div class="input-block mb-0">
                                                        <div class="search-btn">
                                                            <button type="submit" class="btn btn-primary check-available w-100">
                                                                Reservar
                                                            </button>
                                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#enquiry" class="btn btn-theme">Consulte-nos</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- <div class="review-sec share-car mt-0">
                            <div class="review-header">
                                <h4>Ver localização do carro</h4>
                            </div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509170.989457427!2d-123.80081967108484!3d37.192957227641294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2sin!4v1669181581381!5m2!1sen!2sin"
                                class="iframe-video"></iframe>
                        </div> --}}
                       </div>
                </div>
               </section>

        <!-- Modal -->
        <div class="modal custom-modal fade check-availability-modal" id="pages_edit" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="form-header text-start mb-0">
                            <h4 class="mb-0 text-dark fw-bold">Availability Details</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="align-center" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="available-for-ride">
                                    <p><i class="fa-regular fa-circle-check"></i>{{ $car->brand->name }}
                                        {{ $car->models->name }} is available for a ride</p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="row booking-info">
                                    <div class="col-md-4 pickup-address">
                                        <h5>Pickup</h5>
                                        <p>{{ $car->supplier->location ?? '45, 4th Avanue Mark Street USA' }}</p>
                                        <span>Date & time: 11 Jan 2023</span>
                                    </div>
                                    <div class="col-md-4 drop-address">
                                        <h5>Drop Off</h5>
                                        <p>{{ $car->supplier->location ?? '78, 10th street Laplace USA' }}</p>
                                        <span>Date & time: 11 Jan 2023</span>
                                    </div>
                                    <div class="col-md-4 booking-amount">
                                        <h5>Booking Amount</h5>
                                        <h6><span>$300</span> /day</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="booking-info seat-select">
                                    <h6>Extra Service</h6>
                                    <label class="custom_check">
                                        <input type="checkbox" name="rememberme" class="rememberme">
                                        <span class="checkmark"></span>
                                        Baby Seat - <span class="ms-2">$10</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="booking-info pay-amount">
                                    <h6>Deposit Option</h6>
                                    <div class="radio radio-btn">
                                        <label>
                                            <input type="radio" name="radio"> Pay Deposit
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="radio"> Full Amount
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="booking-info service-tax">
                                    <ul>
                                        <li>Booking Price <span>$300</span></li>
                                        <li>Extra Service <span>$10</span></li>
                                        <li>Tax <span>$5</span></li>
                                    </ul>
                                </div>
                                <div class="grand-total">
                                    <h5>Grand Total</h5>
                                    <span>$315</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="booking.html" class="btn btn-back">Go to Details<i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal -->

        <!-- Custom Date Modal -->
        <div class="modal new-modal fade enquire-mdl" id="enquiry" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inquérito</h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="https://dreamsrent.dreamstechnologies.com/html/template/listing-details.html"
                            class="enquire-modal">
                            <div class="booking-header">
                                <div class="booking-img-wrap">
                                    <div class="book-img">
                                        <img src="{{ $car->image ? url('storage/' . $car->image) : url('assets/user/img/cars/car-05.jpg') }}"
                                            alt="img">
                                    </div>
                                    <div class="book-info">
                                        <h6>{{ $car->brand->name }} {{ $car->models->name }}</h6>
                                        <p><i class="feather-map-pin"></i> Localização:
                                            {{ $car->supplier->location ?? 'Luanda, Cazenga' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="modal-form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="modal-form-group">
                                <label>Numero de Telefone</label>
                                <input type="text" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="modal-form-group">
                                <label>Mensagem</label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div>
                            <label class="custom_check w-100">
                                <input type="checkbox" name="username">
                                <span class="checkmark"></span> Eu aceito com <a href="javascript:void(0);">os Termos e
                                    Serviços</a> & <a href="javascript:void(0);">Política de Privacidade</a>
                            </label>
                            <div class="modal-btn modal-btn-sm">
                                <button type="submit" class="btn btn-primary w-100">
                                    Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Custom Date Modal -->

        <!-- Custom Date Modal -->
        <div class="modal new-modal fade enquire-mdl" id="fare_details" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Fare Details</h4>
                        <button type="button" class="close-btn" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="enquire-modal">
                            <div class="booking-header fare-book">
                                <div class="booking-img-wrap">
                                    <div class="book-img">
                                        <img src="{{ $car->image ? url('storage/' . $car->image) : url('assets/user/img/cars/car-05.jpg') }}"
                                            alt="img">
                                    </div>
                                    <div class="book-info">
                                        <h6>{{ $car->brand->name }} {{ $car->models->name }}</h6>
                                        <p><i class="feather-map-pin"></i> Location:
                                            {{ $car->supplier->location ?? 'Miami St, Destin, FL 32550, USA' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="fare-table">
                                <div class="table-responsive">
                                    <table class="table table-center">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Doorstep delivery <span>(1 day )</span>
                                                    <p class="text-danger">(This does not include fuel)</p>
                                                </td>
                                                <td>
                                                    <select class="select">
                                                        <option>Per Day</option>
                                                        <option>Per Hr</option>
                                                    </select>
                                                </td>
                                                <td class="amt text-end">+ $300</td>
                                            </tr>
                                            <tr>
                                                <td>Door delivery & Pickup</td>
                                                <td colspan="2" class="amt text-end"> + $60</td>
                                            </tr>
                                            <tr>
                                                <td>Trip Protection Fees</td>
                                                <td colspan="2" class="amt text-end"> + $25</td>
                                            </tr>
                                            <tr>
                                                <td>Convenience Fees</td>
                                                <td colspan="2" class="amt text-end"> + $2</td>
                                            </tr>
                                            <tr>
                                                <td>Tax</td>
                                                <td colspan="2" class="amt text-end"> + $2</td>
                                            </tr>
                                            <tr>
                                                <td>Refundable Deposit</td>
                                                <td colspan="2" class="amt text-end">+$1200</td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal</th>
                                                <th colspan="2" class="amt text-end">+$1604</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-btn modal-btn-sm">
                                <a href="booking-checkout.html" class="btn btn-primary w-100">
                                    Continue to Booking
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Custom Date Modal -->
    </div>
    
    

@endsection
