@extends('layouts.admin', ['title' => "Keuangan - Sammpah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        {{-- card form --}}
        <div class="card shadow mb-4">
            <a href="#form-penarikan-tunai" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="form-penarikan-tunai">
                <h6 class="m-0 font-weight-bold text-primary">KASIR</h6>
                <form action="" method="POST">
                    <div class="row mb-2">
                        <div class="col-md-11">
                            <label for="nominal">id barang</label>
                            <input type="text" id="nominal" name="nominal" class="form-control">
                        </div>
                        <div class="col-md-1">
                            <label for=""></label>
                            <button type="submit" class="btn btn-primary mt-2">CARI</button>
                        </div>
                    </div>
                    @csrf
                </form>
            </a>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>nama produk</th>
                                <th>harga</th>
                                <th>jumlah</th>
                                <th>subtotal</th>
                                <th>diskon</th>
                                <th>subtotal</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Cart as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td><input type="number" value="{{ $value->id }}"></td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->keterangan }}</td>
                                    <td>{{ number_format($value->kredit, 0, ',', '.') }}</td>
                                    <td>{{ $value->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <select class="form-control" name="email" id="selectEmail">
                            {{-- @foreach ($users as $user)
                            <option value="{{$user->email}}"> {{$user->email}} </option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="nominal">Nominal</label>
                        <input type="number" id="nominal" name="nominal" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <table style="border: 1px;">

        </table>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('fungsi.js') }}"></script>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('script')

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>
<script>
    $(document).ready(function() {
    selesai();
});

function selesai() {
    setTimeout(function() {
        update();
        selesai();
    }, 200);
}
var ctx = document.getElementById("myPieChart").getContext('2d');
function update() {
    $.getJSON(function(Cart) {
        $("table").empty();
        var no = 1;
        $.each(Cart.result, function() {
            $("table").append("<tr><td>" + (no++) + "</td><td>" + this['product'] + "</td><td>" + this['jurusan'] + "</td></tr>");
        });
    });
}
</script>
    @endsection
