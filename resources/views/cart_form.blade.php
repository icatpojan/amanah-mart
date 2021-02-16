<html lang="en">
<head>
    <title>Laravel Ajax jquery Validation Tutorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>

<div class="container panel panel-default ">
        <h2 class="panel-heading">Laravel Ajax jquery Validation</h2>
    <form id="contactForm">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" id="name">
        </div>

        <div class="form-group">
            <input type="text" name="jumlah" class="form-control" placeholder="Enter jumlah" id="jumlah">
        </div>

        <div class="form-group">
            <input type="text" name="harga" class="form-control" placeholder="Enter Mobile Number" id="harga">
        </div>

        <div class="form-group">
            <input type="text" name="jumlah_harga" class="form-control" placeholder="Enter jumlah_harga" id="jumlah_harga">
        </div>

        {{-- <div class="form-group">
          <textarea class="form-control" name="message" placeholder="Message" id="message"></textarea>
        </div> --}}
        <div class="form-group">
            <button class="btn btn-success" id="submit">Submit</button>
        </div>
    </form>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

   <script type="text/javascript">

    $('#contactForm').on('submit',function(event){
        event.preventDefault();

        let name = $('#name').val();
        let jumlah = $('#jumlah').val();
        let harga = $('#harga').val();
        let jumlah_harga = $('#jumlah_harga').val();
        // let message = $('#message').val();

        $.ajax({
          url: "/cart-form",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            name:name,
            jumlah:jumlah,
            harga:harga,
            jumlah_harga:jumlah_harga,
            // message:message,
          },
          success:function(response){
            console.log(response);
          },
         });
        });
      </script>
 </body>
</html>
