@extends('layouts.admin', ['title' => "Daftar Produk - Amanah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <i class="fas fa-home mt-0_5 breadcrumb-item"></i>
                    <li class="breadcrumb-item"> <a class="text-decoration-none" href=""> Home </a> </li>
                    <li class="breadcrumb-item "> Kelola Produk </li>
                    <li class="breadcrumb-item active" aria-current="page"> Product </li>
                </ol>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR PRODUCT</h6>
                <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#tambah-product">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>barcode</th>
                                <th>merek</th>
                                <th>stok</th>
                                <th>harga beli</th>
                                <th>harga_jual</th>
                                <th>diskon</th>
                                <th>kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>barcode</th>
                                <th>merek</th>
                                <th>stok</th>
                                <th>harga beli</th>
                                <th>harga_jual</th>
                                <th>diskon</th>
                                <th>kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($Product as $produk)
                                <tr>
                                    <td>{{ $produk->name }}</td>
                                    <td>{{ $produk->barcode }}</td>
                                    <td>{{ $produk->merek }}</td>
                                    <td>{{ $produk->stock }}</td>
                                    <td>{{ $produk->harga_beli }}</td>
                                    <td>{{ $produk->harga_jual }}</td>
                                    <td>{{ $produk->diskon }}</td>
                                    <td>{{ $produk->category_id }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#update-product-{{ $produk->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <form action="{{ route('product.destroy', $produk->id) }}" method="POST">
                                            <button class="btn border p-1 bg-warning text-black" type="submit"
                                                title="Blacklist User" onclick="return confirm ('Yakin hapus Produk ?')">
                                                <i class="fas fa-fire">hapus</i>
                                            </button>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{-- {{$User->links()}} --}}
                    </div>
                </div>
            </div>
        </div>

        @include('components.modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>

@endsection
