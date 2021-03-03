@extends('layouts.admin', ['title' => "Dashboard Admin - Sammpah.com"])

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <i class="fas fa-home breadcrumb-item mt-0_5"></i>
                    <li class="breadcrumb-item active" aria-current="page"> Home </li>
                </ol>
            </div>

            <h1>SELAMAT DATANG {{ Auth::user()->name }}</h1>
            <a class=" d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        @include('card.admin')
        @if (Auth::user()->role_id < 5 && Auth::user()->role_id > 1)
            @include('card.cardkasir')
            @if (strtotime(date('H:i:s')) >= strtotime('07:00:00') && strtotime(date('H:i:s')) < strtotime('15:00:00'))
                <form action="{{ route('kehadiran.check-in') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Absen
                        masuk</button>
                </form>
            @endif
            @if (strtotime(date('H:i:s')) > strtotime('15:00:00') && strtotime(date('H:i:s')) < strtotime('18:00:00'))
                <p>Jika pekerjaan telah selesai silahkan check-out</p>
                <form action="{{ route('kehadiran.check-out') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning btn-lg btn-block mb-3">Absen pulang</button>
                </form>
            @endif
        @endif
        <div class="card mb-3 mt-4 shadow" style="max-width: 1540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    {{-- <img src="{{ $Karyawan->image == null ? $Karyawan->name : $Karyawan->image }}" class="card-img" --}}
                        alt="kosong">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $Karyawan->user->name }}</h5>
                        <div class="row">
                            <div class="col">
                                <label for="kredit">umur</label>
                                <input class="form-control" value="{{ $Karyawan->umur }}">
                                <label for="kredit">alamat</label>
                                <input class="form-control" value="{{ $Karyawan->address }}">
                                <label for="kredit">nomor telpon</label>
                                <input class="form-control" value="{{ $Karyawan->phone_number }}">
                                <label for="kredit">role</label>
                                <input class="form-control" value="{{ $Karyawan->user->role_id }}">
                                <button class="btn btn-primary mt-2" href="#" data-toggle="modal"
                                    data-target="#update-karyawan">Update profile
                                </button>
                            </div>
                            @include('components.modal-home')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
