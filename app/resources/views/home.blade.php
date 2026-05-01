<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ペットケア＋') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div id="">
        <nav>
            <div>
                <a href="">ペットケア＋</a>
            </div>
        </nav>
        <main>
            <div class = "container">
                {{-- row-cols-* で1行あたりの列数を指定 (例: md以上で3列、smで2列、xsで1列) --}}
                <div class="row">
                    @foreach ($pets as $pet)
                        <div class = "col-md-4 mb-4">
                            <div class = "p-3 border bg-light h-100 d-flex flex-column align-items-center justify-content-center" 
                                 style="aspect-ratio: 1 / 1;">
                                <div class="text-center"> {{-- 画像も中央寄せ --}}
                                        <a href="">
                                        <img src="{{ asset($pet['profile_image']) }}" 
                                        alt="プロフィール画像" 
                                        width="200" height="200" 
                                        style="border-radius: 50%; object-fit: cover;">
                                    </a>
                                </div>
                                <div class="text-center">
                                    <p>{{ $pet['name'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class = "col-md-4 mb-4">
                        <div class = "p-3 border bg-light h-100 d-flex flex-column align-items-center justify-content-center" 
                             style="aspect-ratio: 1 / 1;">
                        <a href="" class="text-decoration-none text-center">
                            <p class="mb-0">＋ペットを追加</p>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>