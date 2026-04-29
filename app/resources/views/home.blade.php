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
                <div class = "">
                    <div class = "">
                        <tbody>
                            @foreach ($pets as $pet)
                                <tr>
                                    <a href="">
                                        <img src="{{ asset($pet['profile_image']) }}" 
                                            alt="プロフィール画像" 
                                            width="200" height="200" 
                                            style="border-radius: 50%; object-fit: cover;">
                                        <th>{{ $pet['name'] }}</th>
                                    </a>
                                </tr>
                            @endforeach
                        </tbody>
                    </div>
                    <div class = "col">
                        <a href="" >＋ペットを追加</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>