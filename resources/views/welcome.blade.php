<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMANAH</title>
    <link rel="stylesheet" href="{{ asset('stylesheets.css') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">
            </div>
            <div class="header-right">
                <a href="{{ route('login') }}" class="login">AMANAH</a>
            </div>
        </div>
    </header>
    <div class="top-wrapper">
        <div class="container">
            <h1>AMAN<i class="fa fa-twitter"></i>H</h1>
            <h1>APLIKASI MENEJEMEN TOKO HANDAL</h1>
            <p>Amanah adalah platform online untuk mengelola toko anda.</p>
            <p>Kami menawarkan sistem pengelolaan toko yang mudah untuk kehidupan anda.</p>
            <div class="btn-wrapper">
                <a href="https://play.google.com/"><img src="{{ asset('google.svg') }}" alt="a"
                        style="height: 75px"></a>
                <p>lalu</p>
                {{-- <a href="#" class="btn facebook"><span></span>Daftar dengan gmail</a> --}}
                <a href="{{ route('login.provider', 'google') }}"
                    class="btn btn-primary">{{ __('Google Sign in') }}</a>
                <a href="{{ route('login.provider', 'google') }}"
                    class="btn btn-danger">{{ __('Facebook Sign in') }}</a>
                {{-- <a href="#" class="btn twitter"><span></span>Daftar dengan email</a> --}}
            </div>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Mudah Cepat Berguna</h1>
            <p class="lead">kami membangun produk semudah mungkin bagi anda anda yang belom melek teknologi</p>
        </div>
    </div>
    <div class="card-columns">
        <div class="card">
          <img src="{{asset('img/fzn.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title that wraps to a new line</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
        <div class="card p-3">
          <blockquote class="blockquote mb-0 card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">
              <small class="text-muted">
                Someone famous in <cite title="Source Title">Source Title</cite>
              </small>
            </footer>
          </blockquote>
        </div>
        <div class="card">
          <img src="{{asset('img/fzn.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card bg-primary text-white text-center p-3">
          <blockquote class="blockquote mb-0">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
            <footer class="blockquote-footer text-white">
              <small>
                Someone famous in <cite title="Source Title">Source Title</cite>
              </small>
            </footer>
          </blockquote>
        </div>
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has a regular title and short paragraphy of text below it.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card">
          <img src="{{asset('img/fzn.jpg')}}" class="card-img-top" alt="...">
        </div>
        <div class="card p-3 text-right">
          <blockquote class="blockquote mb-0">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">
              <small class="text-muted">
                Someone famous in <cite title="Source Title">Source Title</cite>
              </small>
            </footer>
          </blockquote>
        </div>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is another card with title and supporting text below. This card has some additional content to make it slightly taller overall.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    {{-- <footer>
        <div class="container">
            <p>
                <a target="_blank" href="https://github.com/icatpojan">Irsyad Fauzan</a>
                <a target="_blank" href="https://github.com/hanifazzuhdi">Radiant fadhilah</a>
            </p>
        </div>
    </footer> --}}
</body>

</html>
