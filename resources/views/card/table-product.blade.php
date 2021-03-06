<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th colspan="2" style="text-align: center">RANK</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>Terbeli</td>
                </tr>
                @foreach ($Cart as $cart)
                    <tr>
                        <td>{{ $cart->name }}</td>
                        <td>{{ $cart->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
