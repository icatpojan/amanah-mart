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
                </ol>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR KARYAWAN</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn-outline-primary" data-toggle="modal" data-target="#tambah-karyawan">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama</th>
                                <th>phone number</th>
                                <th>Umur</th>
                                <th>alamat</th>
                                <th>foto</th>
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
                                <th>foto</th>
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
                                    <td>
                                        <a href="#" class="pop">
                                            <img width="80" height="80" src="{{ $user->image }}">
                                        </a>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('karyawan.show', $user->user_id) }}" method="get">
                                            <button type="submit" class="btn btn-outline-danger">has</button>
                                        </form>
                                        <form action="{{ route('karyawan.destroy', $user->user_id) }}" method="POST">
                                            <button class="btn btn-outline-warning mt-1" type="submit"
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
        {{-- modal foto preview --}}

        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-
                             only">Close</span></button>
                        <img src="" class="imagepreview" style="width: 350px;">

                    </div>
                </div>
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
        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');
            });
        });

    </script>
    <script type="text/javascript">
        $('#tambah-karyawan').on('show.bs.modal', function(e) {
            $('.modal .modal-tambah').attr('class', 'modal-tambah tada animated');
        })
        $('#tambah-karyawan').on('hide.bs.modal', function(e) {
            $('.modal .modal-tambah').attr('class', 'modal-tambah rollOut animated');
        })

    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });

    </script>
@endsection
