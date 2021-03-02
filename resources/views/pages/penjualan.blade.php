@extends('layouts.admin', ['title' => "penjualan - Amanah.com"])

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
                    <li class="breadcrumb-item active" aria-current="page"> Penjualan </li>
                </ol>
            </div>

            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        @include('card.penjualan')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">PENJUALAN PERUSAHAAN </h6>
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
                            <tr>
                                <td colspan="6" style="text-align: center">
                                    No record found.
                                </td>
                            </tr>
                            @foreach ($Penjualan as $value)
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
            </div>
        </div>
        <a href="{{ route('cetak.penjualan') }}" class="btn btn-primary mb-2" target="_blank">CETAK LAPORAN</a>
@include('card.laporpenjualan')
    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <script type="text/javascript">
        $('#contactForm').on('submit', function(event) {
            event.preventDefault();

            let name = $('#name').val();
            let jumlah = $('#jumlah').val();
            let harga = $('#harga').val();
            let jumkzlah_harga = $('#jumlah_harga').val();
            // let message = $('#message').val();

            $.ajax({
                url: "/cart-form",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    jumlah: jumlah,
                    harga: harga,
                    jumlah_harga: jumlah_harga,
                    // message:message,
                },
                success: function(response) {
                    console.log(response);
                },
            });
        });

    </script>
@endsection
