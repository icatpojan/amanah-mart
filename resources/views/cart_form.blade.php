@extends('layouts.admin', ['title' => "Keuangan - Sammpah.com"])

@section('style')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">

            <div class="container panel panel-default ">
                <a href="#form-penarikan-tunai" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="form-penarikan-tunai">
                    <h6 class="m-0 font-weight-bold text-primary">KASIR</h6>
                    <form id="contactForm">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" id="name">
                        </div>

                        <div class="form-group">
                            <input type="text" name="jumlah" class="form-control" placeholder="Enter jumlah" id="jumlah">
                        </div>

                        <div class="form-group">
                            <input type="text" name="harga" class="form-control" placeholder="Enter Mobile Number"
                                id="harga">
                        </div>

                        <div class="form-group">
                            <input type="text" name="jumlah_harga" class="form-control" placeholder="Enter jumlah_harga"
                                id="jumlah_harga">
                        </div>

                        {{-- <div class="form-group">
          <textarea class="form-control" name="message" placeholder="Message" id="message"></textarea>
        </div> --}}
                        <div class="form-group">
                            <button class="btn btn-success" id="submit">Submit</button>
                        </div>
                    </form>
                </a>
            </div>
        </div>
    </div>
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
            let jumlah_harga = $('#jumlah_harga').val();
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

</script> @endsection
