<script type='text/javascript'>
    $(document).ready(function() {
        selesai();
        fetchRecords();
    });

    function selesai() {
        $('#contactForm').on('submit', function() {
            selesai();
            fetchRecords();
            kulakanRecords();
        });
        $('#tambahForm').on('submit', function() {
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
                        var jumlah_product = response['data'][i].jumlah_product;
                        var name = response['data'][i].name;
                        var harga = response['data'][i].harga;
                        var harga_jual = response['data'][i].harga_jual;
                        var tr_str = "<tr><form id='updateForm'>" +
                            "<td align='center'>" + (i + 1) + "</td>" +
                            "<td align='center'>" + name + "</td>" +
                            "<td align='center'><input class='form-control mb-2' type='text' name='jumlah_product' value='" + jumlah_product + "'></td>" +
                            "<td align='center'><input class='form-control mb-2' type='text' name='harga' value='" +
                            harga + "'></td>" +
                            "<td align='center'><input class='form-control mb-2' type='text' name='harga_jual' value='" +
                            harga_jual + "'></td>" +
                            "<td align='center'><input class='form-control mb-2' type='text' value='" +
                            harga_jual + "'disabled></td>" +
                            "</tr></form>";
                        $("#userTable tbody").append(tr_str);
                    }
                } else if (response['data'] != null) {
                    var tr_str = "<tr>" +
                        "<td align='center'>1</td>" +
                        "<td align='center'>" + response['data'].jumlah + "</td>" +
                        "<td align='center'>" + response['data'].name + "</td>" +
                        "<td align='center'>" + response['data'].harga + "</td>" +
                        "<td align='center'>" + response['data'].harga_jual + "</td>" +
                        "<td align='center'>" + response['data'].harga_jual + "</td>" +
                        "</tr>";
                    $("#userTable tbody").append(tr_str);
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='6'>No record found.</td>" +
                        "</tr>";
                    $("#total").append(tr_str);
                }

            }
        });
    }

    function kulakanRecords() {
        $.ajax({
            url: "{{ route('kulakan.get') }}",
            type: 'get',
            dataType: 'json',
            success: function(response) {
                var len = 0;
                $('#kulakanTable thead').empty(); // Empty <thead>
                if (response['data'] != null) {
                    len = response['data'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var jumlah_harga = response['data'][i].jumlah_harga;
                        var tr_str = "<tr>" +
                            "<td align='center'>" + jumlah_harga + "</td>" +
                            "</tr>";
                        $("#kulakanTable thead").append(tr_str);
                    }
                } else if (response['data'] != null) {
                    var tr_str = "<tr>" +
                        "<td align='center'>" + jumlah_harga + "</td>" +
                        "</tr>";
                    $("#kulakanTable thead").append(tr_str);
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4'>No record found.</td>" +
                        "</tr>";
                    $("#total").append(tr_str);
                }

            }
        });
    }

</script>
<script type="text/javascript">
    $('#contactForm').on('submit', function(event) {
        event.preventDefault();
        fetchRecords();
        let barcode = $('#barcode').val();

        $.ajax({
            url: "{{ route('pembelian.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                barcode: barcode,
            },
            success: function(response) {
                console.log(response);
            },
        });
        document.getElementById('barcode').value = ''
    });

    $('#tambahForm').on('submit', function(event) {
        event.preventDefault();
        fetchRecords();
        let kode = $('#kode').val();

        $.ajax({
            url: "{{ route('pembelian.stire') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                kode: kode,
            },
            success: function(response) {
                console.log(response);
            },
        });
    });

</script>
