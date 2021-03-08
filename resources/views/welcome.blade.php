<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMANAH</title>
    <link rel="stylesheet" href="{{ asset('stylesheets.css') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
            <h1>AMAN<span class="fa  fa-twitter"></span>H</h1>
            <h1>APLIKASI MENEJEMEN TOKO HANDAL</h1>
            <p>Amanah adalah platform online untuk mengelola toko anda.</p>
            <p>Kami menawarkan sistem pengelolaan toko yang mudah untuk kehidupan anda.</p>
            <div class="btn-wrapper">
                <a href="https://play.google.com/"><img src="{{ asset('google.svg') }}" alt="a"
                        style="height: 75px"></a>
                <p>lalu</p>
                {{-- <a href="#" class="btn facebook"><span></span>Daftar dengan gmail</a> --}}
                <a href="{{ route('login.provider', 'google') }}"
                class="btn facebook">{{ __('Google Sign in') }}</a>
                <a href="{{ route('login.provider', 'google') }}"
                class="btn twitter">{{ __('Facebook Sign in') }}</a>
                {{-- <a href="#" class="btn twitter"><span></span>Daftar dengan email</a> --}}
            </div>
        </div>
    </div>
    <div>

    </div>
    <footer>
        <div class="container">
            <p>
                <a target="_blank" href="https://github.com/icatpojan">Irsyad Fauzan</a>
                <a target="_blank" href="https://github.com/hanifazzuhdi">Radiant fadhilah</a>
            </p>
        </div>
    </footer>
</body>

</html>
