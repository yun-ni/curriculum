@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
    <div style="height: calc(100vh - 56px);" class="d-flex align-items-center justify-content-center">
        <div class="border bg-light d-flex flex-column align-items-center justify-content-center"
             style="width: 50%; aspect-ratio: 1 / 1;">
            <x-slot name="header">
                <h2 class="p-2  m-4 align-items-center font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('通院記録') }}
                </h2>
            </x-slot>     
            <p>日付</p>
            <p>元気</p>
            <p>食欲</p>
            <p>トイレ</p>
            <p>散歩</p>
            <p>体重</p>
            <a href="" class="btn btn-primary">登録</a>
        </div>
    </div>
@endsection
