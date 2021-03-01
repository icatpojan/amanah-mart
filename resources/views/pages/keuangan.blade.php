@extends('layouts.admin', ['title' => "Keuangan - Amanah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        @include('card.keuangan')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">KEUANGAN PERUSAHAAN </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Keterangan</th>
                                <th>debit</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Keterangan</th>
                                <th>debit</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                                <th>Dibuat</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($Keuangan as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->keterangan }}</td>
                                    <td>{{ number_format($value->debit, 0, ',', '.') }}</td>
                                    <td>{{ number_format($value->kredit, 0, ',', '.') }}</td>
                                    <td>{{ number_format($value->saldo, 0, ',', '.') }}</td>
                                    <td>{{ $value->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('cetak.keuangan') }}" class="btn btn-primary" target="_blank">CETAK LAPORAN</a>
            </div>
        </div>
        @include('card.laporan')
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
