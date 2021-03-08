@extends('layouts.admin', ['title' => "Kasir - Amanah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        th {
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">

        {{-- card form --}}
        <div class="card shadow mb-4">
            <div class="d-block card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">KASIR</h6>
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <form action="{{ route('penjualan.store') }}" method="POST">
                                @csrf
                                <input onfocus="this.value=''" type="text" name="barcode" class="form-control"
                                    placeholder="Enter Barcode" id="barcode" autofocus>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-success btn" data-toggle="modal" data-target="#modal-barang">
                            <i class="fa fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id='userTable' width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>no</th>
                                        <th>barcode</th>
                                        <th>Name</th>
                                        <th>harga</th>
                                        <th>jumlah</th>
                                        <th>diskon</th>
                                        <th>total harga</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Cart as $cart)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $cart->barcode }}</td>
                                            <td>{{ $cart->name }}</td>
                                            <td>{{ $cart->harga }}</td>
                                            <td style="width: 3cm">
                                                <form action="{{ route('penjualan.update', $cart->id) }}" method="post">
                                                    @csrf
                                                    <input style="text-align: center" class="form-control" type="number"
                                                        name="jumlah_product" value="{{ $cart->jumlah_product }}">
                                                </form>
                                            </td>
                                            <td>{{ $cart->diskon }}</td>
                                            <td>{{ $cart->jumlah_harga }}</td>
                                            <td style="text-align: center">
                                                <form action="{{ route('penjualan.destroy', $cart->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div style="background-color: red">
                            <h1 style="color: white; text-align:center">Total =
                                Rp.{{ $Penjualan->harus_dibayar ?? 'jumlah harga' }}</h1>
                            <div style="background-color: blue">
                                <h5 style="color: white; text-align:center">
                                    {{ terbilang($Penjualan->harus_dibayar ?? '0') }}</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <table class="table table-bordered table-dark" id='kulakanTable' width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <td style="text-align: center">
                                        {{ $Penjualan->jumlah_harga ?? 'jumlah harga' }}
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <form action="{{ route('penjualan.diskon') }}" method="post">
                            @csrf
                            <input value="{{ $Penjualan->member_id ?? 'member id' }}" style="text-align: center"
                                type="number" placeholder="member id" class="form-control mb-2" name="member_id">
                        </form>

                        <input style="text-align: center" type="text" value="{{ $Penjualan->diskon ?? 'diskon' }}%"
                            class="form-control mb-2" disabled placeholder="Diskon">

                        <form action="{{ route('penjualan.bayar') }}" method="post">
                            @csrf
                            <input style="text-align: center" type="number" placeholder="bayar"
                                value="{{ $Penjualan->dibayar ?? 'dibayar' }}" name="dibayar" class="form-control mb-2">
                        </form>
                        <input style="text-align: center" type="text" class="form-control mb-2" disabled
                            placeholder="Kembalian" value="Rp.{{ $Penjualan->kembalian ?? 'kembalian' }}">
                        <div class="row">
                            <div class="col" style="text-align: center">
                                <form action="{{ route('penjualan.confirm') }}" method="POST">
                                    @csrf
                                    <label for="cetak">cetak</label>
                                    <input type="checkbox" id="cetak" name="cetak">
                                    <button class="btn btn-outline-success mb-1" type="submit">TUNAI</button>
                                </form>
                            </div>
                            <div class="col" style="text-align: center">
                                <form action="{{ route('penjualan.confirm-saldo') }}" method="POST">
                                    @csrf
                                    <label for="cetak">cetak</label>
                                    <input type="checkbox" id="cetak" name="cetak">
                                    <button class="btn btn-outline-warning" type="submit">SALDO</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" style="text-align: center">
                                <a href="{{ route('penjualan.cetak') }}" class="btn btn-outline-primary mt-2 mb-2" target="_blank">CETAK NOTA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    @include('components.modal-kasir')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery CDN -->

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- @include('script.penjualan') --}}
@endsection
<!-- Button trigger modal -->
