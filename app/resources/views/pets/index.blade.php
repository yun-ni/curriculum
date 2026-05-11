@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
<main class="py-4">
    <div class="row justify-conten-around">
        <div class="container-fluid p-0 text-center">
            <div class="row">
                <div class="col">
                    <img src="{{ asset('images/'. $pet['profile_image']) }}"                    
                         alt="プロフィール画像" 
                         width="200" height="200" 
                         style="border-radius: 50%; object-fit: cover;">
                </div>
                <div class="col">
                    <p>{{ $pet->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">体調記録</h5>
                            <div class=" text-left">
                                <a href="{{ route('create.health') }}">+体調を記録</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope='col'>詳細</th>
                                        <th scope='col'>日付</th>
                                        <th scope='col'>体調</th>
                                        <th scope='col'>お散歩</th>
                                        <th scope='col'>体重</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($healths as $health)
                                    <tr>
                                        <td scope='col'>
                                            <a href="">*</a>
                                        </td>
                                        <td scope='col'>{{ $health['health_date'] }}</dh>
                                        <td scope='col'>{{ $health['energy'] }}</dh>
                                        <td scope='col'>{{ $health['walk_minutes'] }}</dh>
                                        <td scope='col'>{{ $health['weight'] }}</dh>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">通院記録</h5>
                            <div class=" text-left">
                                <a href="{{ route('create.visit') }}">+通院を記録</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope='col'>詳細</th>
                                        <th scope='col'>日付</th>
                                        <th scope='col'>症状</th>
                                        <th scope='col'>通院</th>
                                        <th scope='col'>メモ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visits as $visit)
                                    <tr>
                                        <td scope='col'>
                                            <a href="">*</a>
                                        </td>
                                        <td scope='col'>{{ $visit['visit_date'] }}</td>
                                        <td scope='col'>{{ $visit['symptom'] }}</td>
                                        <td scope='col'>{{ $visit['has_visit'] === 0 ? '有' : '無' }}</td>
                                        <td scope='col'>{{ $visit['memo'] }}</td>
                                        <td scope='col'>{{ $visit[''] }}</td>                          
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection