@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
<div class="container">
    <div class="container-fluid p-0">
        <!-- 上部フレーム (30%) -->
        <div class="row">
            <div class="col">
                <img src="{{ asset('images/kuusan.png') }}" 
                     alt="プロフィール画像" 
                     width="100" height="100" 
                     style="border-radius: 50%; object-fit: cover;">
            </div>
            <div class="col">
                <p>{{ $pet->name }}</p>
            </div>
        </div>
        <!-- 下部フレーム (70%) -->
        <div class="row">
            <!-- 体調記録 -->
            <div class="card-header">
                <div class='text-center'>体調記録</div>
            </div>
            <div>
                <a href="">+体調を記録</a>
            </div>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th scope='col'>日付</th>
                            <th scope='col'>体調</th>
                            <th scope='col'>お散歩</th>
                            <th scope='col'>体重</th>
                            <th scope='col'>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($healths as $health)
                        <tr>
                            <th scope='col'>{{ $health['health_date'] }}</th>
                            <th scope='col'>{{ $health['energy'] }}</th>
                            <th scope='col'>{{ $health['walk_minutes'] }}</th>
                            <th scope='col'>{{ $health['weight'] }}</th>
                            <th scope='col'>
                                <a href="">*</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- 通院記録 -->
            <div class="card-header">
                <div class='text-center'>通院記録</div>
            </div>
            <div>
                <a href="">+通院を記録</a>
            </div>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th scope='col'>日付</th>
                            <th scope='col'>症状</th>
                            <th scope='col'>通院</th>
                            <th scope='col'>メモ</th>
                            <th scope='col'>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $visit)
                        <tr>
                            <th scope='col'>{{ $visit['visit_date'] }}</th>
                            <th scope='col'>{{ $visit['symptom'] }}</th>
                            <th scope='col'>{{ $visit['has_visit'] }}</th>
                            <th scope='col'>{{ $visit['memo'] }}</th>
                            <th scope='col'>{{ $visit[''] }}</th> 
                            <th scope='col'>
                                <a href="">*</a>
                            </th> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection <!-- 6-1 Bootstrap -->

<!-- 
参照元
http://www.fureai.or.jp/~irie/html-tag/frame.html
 -->