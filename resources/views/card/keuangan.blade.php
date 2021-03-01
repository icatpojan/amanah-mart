<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <i class="fas fa-home breadcrumb-item mt-0_5"></i>
            <li class="breadcrumb-item"> <a class="text-decoration-none" href="{{ route('home') }}"> Home </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Keuangan </li>
        </ol>
    </div>

    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<div class="row">
    <!-- Total Pemasukan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                            Pemasukan penjualan(bulanan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $jumlah_penjualan }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                            Pengeluaran (bulanan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $jumlah_pengeluaran}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Saldo -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                            Total Saldo</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $saldo }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                            Pembelian (bulanan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $jumlah_pembelian}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-bottom-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                             Penjualan Harian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $harian_penjualan }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-bottom-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                            Pengeluaran Harian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $harian_pengeluaran}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Saldo -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                            Harian Pembelian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $harian_pembelian }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

