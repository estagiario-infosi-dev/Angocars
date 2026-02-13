<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/admin" class="b-brand">
                <div style="display: flex; justify-content: center; align-items: center;">
                    <img src="{{ url('assets/user/img/ango-cars.png') }}" alt="Ango Cars"
                         style="width: 7.5rem; height: 3.5rem; margin-top: -1px;">
                </div>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="nxl-navbar">

                <!-- DASHBOARD - SÓ ADMIN -->
                @if (Auth::user()->role === 'admin')
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{ route('dashboard') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>
                @endif

                <!-- RELATÓRIOS SÓ ADMIN-->
                @if (Auth::user()->role === 'admin')
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
                            <span class="nxl-mtext">Relatórios</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('reportsgeneral')}}"><i class="feather-file-text"></i>Ver Relatório</a></li>
                        </ul>
                    </li>
                @endif
                <!-- MARCAS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-tag"></i></span>
                            <span class="nxl-mtext">Marcas</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('brands.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('brands.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                <!-- MODELOS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-box"></i></span>
                            <span class="nxl-mtext">Modelos</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('models.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('models.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                <!-- COMBUSTÍVEIS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-droplet"></i></span>
                            <span class="nxl-mtext">Combustíveis</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('fuels.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('fuels.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                <!-- CORES -->
                @if (in_array(Auth::user()->role, ['admin', 'employee']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-square"></i></span>
                            <span class="nxl-mtext">Cores</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('colors.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('colors.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                <!-- FORNECEDORES -->
                @if (in_array(Auth::user()->role, ['admin', 'employee']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-truck"></i></span>
                            <span class="nxl-mtext">Fornecedores</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('suppliers.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('suppliers.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                <!-- CARROS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-truck"></i></span>
                            <span class="nxl-mtext">Carros</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('cars.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('cars.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                <!-- MOTORISTAS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="fas fa-user-tie"></i></span>
                            <span class="nxl-mtext">Motoristas</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('drivers.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('drivers.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                <!-- CLIENTES -->
                @if (in_array(Auth::user()->role, ['admin']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-user"></i></span>
                            <span class="nxl-mtext">Clientes</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('clients.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('clients.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

               

                <!-- RESERVAS - TODOS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee', 'financial']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-calendar"></i></span>
                            <span class="nxl-mtext">Reservas</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            @if (in_array(Auth::user()->role, ['admin', 'employee']))
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('reserves.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('reserves.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                            @elseif (Auth::user()->role === 'financial')
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('financeiro.reserves') }}"><i class="feather-dollar-sign"></i> Listagem</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- VENDAS - TODOS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee', 'financial']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-dollar-sign"></i></span>
                            <span class="nxl-mtext">Vendas</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            @if (in_array(Auth::user()->role, ['admin', 'employee']))
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('sells.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('sells.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                            @elseif (Auth::user()->role === 'financial')
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('financeiro.sells') }}"><i class="feather-dollar-sign"></i> Listagem</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- ACESSÓRIOS - TODOS -->
                @if (in_array(Auth::user()->role, ['admin', 'employee', 'financial']))
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-package"></i></span>
                            <span class="nxl-mtext">Acessórios</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            @if (in_array(Auth::user()->role, ['admin', 'employee']))
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('accessories.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('accessories.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                            @elseif (Auth::user()->role === 'financial')
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('financeiro.accessories')}}"><i class="feather-eye"></i> Listagem</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                 <!-- USUÁRIOS - SÓ ADMIN -->
                @if (Auth::user()->role === 'admin')
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Usuários</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('users.index') }}"><i class="feather-eye"></i> Listagem</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('users.create') }}"><i class="feather-plus"></i> Adicionar Outro</a></li>
                        </ul>
                    </li>
                @endif

                
     

            </ul>
        </div>
    </div>
</nav>