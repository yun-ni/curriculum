@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"> 
                <div class = "p-2  m-4 border bg-light h-100 d-flex flex-column align-items-center justify-content-center" 
                     style="aspect-ratio: 1 / 1;">
                    <x-slot name="header">
                        <h2 class="p-2  m-4 align-items-center font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('プロフィール') }}
                        </h2>
                    </x-slot>     
                    <img src="{{ asset('images/kuusan.png') }}" 
                        alt="プロフィール画像" 
                        width="200" height="200" 
                        style="border-radius: 50%; object-fit: cover;">
                    <div>
                        <a href="" class="btn btn-primary">編集する</a>
                    </div>
                    
                    
                    <h4>ペットの名前</h4>
                    <p>誕生日</p>
                    <p>犬種</p>
                    <p>性別</p>
                    
                    <a href="" class="btn btn-primary">更新</a>
                    <a href="" class="btn btn-primary">削除</a>
                </div>
            </div>
        </div>
    </div>
@endsection
