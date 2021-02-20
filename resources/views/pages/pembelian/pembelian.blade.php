@extends('layouts.admin', ['title' => "Keuangan - Sammpah.com"])

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
                <h6 class="m-0 font-weight-bold text-primary">KULAKAN BARANG</h6>
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <form id="contactForm">
                                <input onfocus="this.value=''" type="text" name="name" class="form-control"
                                    placeholder="Enter Barcode" id="name" autofocus>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-success btn" data-toggle="modal" data-target="#exampleModal">
                            CARI
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
                                        <th>Name</th>
                                        <th>jumlah</th>
                                        <th>harga</th>
                                        <th>total harga</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="text" placeholder="total" disabled class="form-control mb-2">
                        <input type="text" placeholder="diskon" class="form-control mb-2">
                        <input type="text" placeholder="bayar" disabled class="form-control mb-2">
                        <button>terima</button>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="harga">harga</label>
                        <select class="form-control" name="harga" id="selectharga">
                            {{-- @foreach ($users as $user)
                        <option value="{{$user->harga}}"> {{$user->harga}} </option>
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
    </div>
    <!-- /.container-fluid -->
    @include('components.modal-product')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery CDN -->

    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            selesai();
        });

        function selesai() {
            $('#contactForm').on('submit', function() {
                selesai();
                fetchRecords();
            });
        }

        function fetchRecords() {
            $.ajax({
                url: "{{ route('pembelian.get') }}",
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    $('#userTable tbody').empty(); // Empty <tbody>
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }
                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var jumlah = response['data'][i].jumlah;
                            var name = response['data'][i].name;
                            var harga = response['data'][i].harga;
                            var tr_str = "<tr>" +
                                "<td align='center'>" + (i + 1) + "</td>" +
                                "<td align='center'>" + name + "</td>" +
                                "<td align='center'><input class='form-control mb-2' type='text' value='" +
                                jumlah + "'></td>" +
                                "<td align='center'><input class='form-control mb-2' type='text' value='" +
                                harga + "'></td>" +
                                "<td align='center'>" + harga + "</td>" +
                                "</tr>";
                            $("#userTable tbody").append(tr_str);
                        }
                    } else if (response['data'] != null) {
                        var tr_str = "<tr>" +
                            "<td align='center'>1</td>" +
                            "<td align='center'>" + response['data'].jumlah + "</td>" +
                            "<td align='center'>" + response['data'].name + "</td>" +
                            "<td align='center'>" + response['data'].harga + "</td>" +
                            "<td align='center'>" + response['data'].harga + "</td>" +
                            "</tr>";
                        $("#userTable tbody").append(tr_str);
                    } else {
                        var tr_str = "<tr>" +
                            "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";
                        $("#userTable tbody").append(tr_str);
                    }

                }
            });
        }

    </script>
    <script type="text/javascript">
        $('#contactForm').on('submit', function(event) {
            event.preventDefault();
            fetchRecords();
            let name = $('#name').val();
            let jumlah = $('#jumlah').val();
            let harga = $('#harga').val();
            let jumlah_harga = $('#jumlah_harga').val();
            // let message = $('#message').val();

            $.ajax({
                url: "{{ route('cart-form') }}",
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
            document.getElementById('name').value = ''
        });

    </script>
@endsection
