@extends('layouts.admin', ['title' => "Keuangan - Sammpah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <i class="fas fa-home breadcrumb-item mt-0_5"></i>
                    <li class="breadcrumb-item"> <a class="text-decoration-none" href="{{ route('home') }}"> Home </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Keuangan </li>
                </ol>
            </div>

            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="row">
            <!-- Total Pemasukan -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                                    Pemasukan (bulanan)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
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
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">
                                    Pengeluaran (bulanan)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
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
            <div class="    col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                    Total Saldo</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
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
        {{-- card form --}}
        <div class="card shadow mb-4">
            <a href="#form-penarikan-tunai" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="form-penarikan-tunai">
                <h6 class="m-0 font-weight-bold text-primary">FORM PENGELUARAN</h6>
            </a>

            <div class="collapse show" id="form-penarikan-tunai">
                <div class="card-body">

                    <form action="{{route('pengeluaran.store')}}" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="kredit">Nominal</label>
                                <input type="number" id="kredit" name="kredit" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangab" cols="30" rows="4"></textarea>
                            <small class="text-danger">*Form keterangan boleh tidak diisi</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        @csrf
                    </form>

                </div>
            </div>
        </div>

        {{-- card form --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">PENGELUARAN PERUSAHAAN </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Keterangan</th>
                                <th>Kredit</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Keterangan</th>
                                <th>Kredit</th>
                                <th>Dibuat</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($Pengeluaran as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->keterangan }}</td>
                                    <td>{{ number_format($value->kredit, 0, ',', '.') }}</td>
                                    <td>{{ $value->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>

@endsection
