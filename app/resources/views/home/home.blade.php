@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
        <main>
            <div class = "container">
                {{-- row-cols-* で1行あたりの列数を指定 (例: md以上で3列、smで2列、xsで1列) --}}
                <div class="row">
                    @foreach ($pets as $pet)
                        <div class = "col-md-4 mb-4">
                            <div class = "p-2  m-4 border bg-light h-100 d-flex flex-column align-items-center justify-content-center" 
                                 style="aspect-ratio: 1 / 1;">
                                <div class="text-center"> {{-- 画像も中央寄せ --}}
                                    <a href="{{ route('pet.index', ['id' => $pet['id']]) }}">
                                        <img src="{{ asset($pet['profile_image']) }}" 
                                        alt="プロフィール画像" 
                                        width="200" height="200" 
                                        style="border-radius: 50%; object-fit: cover;">
                                        <div class="text-center">
                                            <p>{{ $pet['name'] }}</p>
                                        </div> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class = "col-md-4 mb-4">
                        <div class = "p-3 m-4 border bg-light h-100 d-flex flex-column align-items-center justify-content-center" 
                             style="aspect-ratio: 1 / 1;">
                        <a href="" class="text-decoration-none text-center">
                            <p class="mb-0">＋ペットを追加</p>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection <!-- 6-1 Bootstrap -->
