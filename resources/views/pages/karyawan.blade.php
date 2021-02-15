@extends('layouts.admin', ['title' => "Daftar Karyawan - Amanah.com"])

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
                    <li class="breadcrumb-item "> Kelola User </li>
                    <li class="breadcrumb-item active" aria-current="page"> Karyawan </li>
                </ol>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR KARYAWAN</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#tambah-karyawan">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>phone number</th>
                                <th>Umur</th>
                                <th>alamat</th>
                                <th>dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>phone number</th>
                                <th>umur</th>
                                <th>alamat</th>
                                <th>dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($User as $user)
                                <tr>
                                    <td>{{ $user->user->name }}</td>
                                    <td>{{ $user->phone_number == null ? 'data belum ada' : $user->phone_number }}</td>
                                    <td>{{ $user->umur == null ? 'data belum ada' : $user->umur }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td class="text-center">
                                        <a class="see text-decoration-none" href="#" data-toggle="modal"
                                            data-target="#update-karyawan-{{ $user->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('karyawan.destroy', $user->user_id) }}" method="POST">
                                            <button class="btn border p-1 bg-warning text-black" type="submit"
                                                title="Blacklist User" onclick="return confirm ('Yakin hapus User ?')">
                                                <i class="fas fa-user-times"></i>
                                                <small></small>
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
