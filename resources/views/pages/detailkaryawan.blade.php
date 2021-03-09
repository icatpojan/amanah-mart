@extends('layouts.admin', ['title' => "Daftar Karyawan - Amanah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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
                    <li class="breadcrumb-item active" aria-current="page"> Detail Karyawan </li>
                </ol>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">DETAIL KARYAWAN</h6>
            </div>
            <div class="card-body">
                @include('card.karyawan')
                @foreach ($User as $user)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $user->image }}" width="200" height="300" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->user->name }} <a class="see text-decoration-none"
                                            href="#" data-toggle="modal"
                                            data-target="#update-karyawan-{{ $user->user_id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </h5>
                                    <p class="card-text">nomor telpon:
                                        {{ $user->phone_number == null ? 'data belum ada' : $user->phone_number }}
                                        <hr>
                                        umur: {{ $user->umur == null ? 'data belum ada' : $user->umur }}
                                        <hr>
                                        masuk: {{ $user->created_at }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @include('components.modal-karyawan')
                <button onclick="goBack()" class="btn btn-outline-danger">kembali</button>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Bootstrap + Animate.css -->
    <script>
        function goBack() {
          window.history.back();
        }
    </script>
@endsection
