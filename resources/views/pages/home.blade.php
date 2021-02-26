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
        <div class="row">
            <!-- Jumlah User Aktif -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Member Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $Member }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi (Bulan) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Karyawan aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $Kariyawan }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-receipt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendapatan Bulanan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pendapatan (Bulan ini)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $Keuangan }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keuangan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Keuangan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">IDR
                                    {{ $Keuangan }}
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
        @if (Auth::user()->role_id < 5 && Auth::user()->role_id > 1)
            @include('components.cardkasir')
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
                    <img src="{{ $Karyawan->image == null ? $Karyawan->name : $Karyawan->image }}" class="card-img"
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

                            <div class="modal fade" id="update-karyawan" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="text-primary font-weight-bold pt-2">UPDATE KARYAWAN</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-12 p-3">
                                                    {{-- start form --}}
                                                    <form action="{{ route('karyawan.update', $Karyawan->user_id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>Nama : </label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $Karyawan->user->name }}" required>

                                                            </div>
                                                            <div class="col">
                                                                <label>email : </label>
                                                                <input type="text" class="form-control" name="email"
                                                                    value="{{ $Karyawan->user->email }}" disabled
                                                                    required>

                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>Role : </label>
                                                                <select class="form-control" name="role_id">
                                                                    <option value="2" selected>Pimpinan</option>
                                                                    <option value="3">Staff</option>
                                                                    <option value="4">Kasir</option>
                                                                </select>

                                                            </div>

                                                            <div class="col select-role">
                                                                <label>nomor telpon : </label>
                                                                <input type="text" class="form-control" name="phone_number"
                                                                    value="{{ $Karyawan->phone_number }}" required>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>alamat : </label>
                                                                <input type="text" class="form-control" name="address"
                                                                    value="{{ $Karyawan->address }}" required>

                                                            </div>
                                                            <div class="col">
                                                                <label>umur : </label>
                                                                <input type="number" class="form-control" name="umur"
                                                                    value="{{ $Karyawan->umur }}" value="0" required>

                                                            </div>
                                                        </div>

                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>foto : </label>
                                                                <input type="file" class="form-control" name="image" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col" style="text-align: center">
                                                                <img src="{{ $Karyawan->image }}" width="250px" />
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                aria-label="Close">
                                                Close
                                            </button>
                                            <button class="btn btn-primary">
                                                Update
                                            </button>
                                            </form>
                                            {{-- End form --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
