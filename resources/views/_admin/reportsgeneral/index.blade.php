@extends('layout._admin.main')
@section('title', 'Relatório Geral')
@section('content-admin')
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Relatório</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">Relatório</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    @if (auth()->user()->role !== 'financial')
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                          <!--   <a href="{{ route('relatorio.reservescompleted' ) }}" class="btn btn-primary">
                                Gerar Relatório
                            </a> -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- [Goal Progress] end -->


        <!-- [Marketing Campaign] end -->
        <!-- [Project Remainders] start -->

        <!-- [Project Remainders] end -->
        <!-- [Social Statistics] start -->
        <div class="col-xxl-4">
            <div class="card stretch stretch-full">
                <div class="card-header">

                    <div class="card-header-action">


                    </div>
                </div>
                <div class="card-body">
                    <div id="social-radar-chart">
                        <div class="booking-timings acting-driver-info">
                            <div class="form-title-head">
                                <h5>Relatório

                                </h5>
                            </div>
                            <ul class="acting-driver-list">
                                <li>
                                    <div class="driver-profile-info mb-3">

                                        <form action="{{ route('relatorio.reservescompleted') }}" method="GET">
                                            <label for="report_type">Relatório Geral:</label>
                                            <select name="report_type" id="report_type" class="form-select" required>
                                                <option value="" disabled selected>Selecione...</option>
                                                <option value="all">Todas as Reservas</option>
                                                <option value="completed">Reservas Concluídas</option>
                                                <option value="cancelled">Reservas Canceladas</option>
                                                <option value="in_progress">Reservas em Progresso</option>
                                            </select>

                                          
                                        
                             </div>
                           
                        
                        <div class="col-lg-4 mb-3">
                                    <!-- filtro por data de inicio e fim-->
                        <label for="start_date">Inicio:</label>
                         <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" max="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-lg-4 mb-3">            
                       <div>
    <label for="end_date">Fim:</label>
    <input 
        type="date"  
        name="end_date" 
        id="end_date"
        class="form-control" 
        value="{{ now()->format('Y-m-d') }}" 
        max="{{ now()->format('Y-m-d') }}" 
        required
    >
</div>

                          <button type="submit" class="btn btn-primary mt-3">
                                                Gerar Relatório
                                            </button>
                        </form>



                                    </div>

                                </li>

                            </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- [Social Statistics] end -->
    </div>
    </div>
    <!-- [ Main Content ] end -->
    </div>
@endsection
