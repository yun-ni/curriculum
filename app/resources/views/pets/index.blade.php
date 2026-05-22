@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
@if (session('message'))
    <div class="alert alert-success text-center">
        {{ session('message') }}
    </div>
@endif
<main class="py-2">
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col py-2">
                <div class="card">
                    <!-- bg-light：薄い色 -->
                    <div class="d-flex flex-column flex-md-row align-items-center bg-light"
                    style="min-height: 26vh; padding: 20px; border-radius: .25rem;">
                        <style>
                            .image-container .edit-button {
                                display: none;
                                position: absolute;
                                bottom: 20px;
                                left: 50%;
                                transform: translateX(-50%);
                                border: none;
                                background: rgba(0, 0, 0, 0.5);
                                color: white;
                                padding: 4px 12px;
                                border-radius: 12px;
                            }
                            .image-container:hover .edit-button {
                                display: block;
                                width: 155px;
                            }
                        </style>
                        <div class="image-container"
                            style="position: relative; display: inline-block;">
                            <span class="align-baseline">
                                <img src="{{ asset($pet->profile_image) }}"                   
                                    alt="プロフィール画像" 
                                    width="140" height="140" 
                                    style="border-radius: 50%; object-fit: cover;">
                            </span>
                        </div>
                        <span class="align-baseline pl-5">
                            {{ $pet->name }} の
                        </span>
                        <!-- #：現在のページにとどまる -->
                        <a href="#" data-toggle="modal" class="ml-1"
                           data-target="#petEditModal{{ $pet->id }}">
                            プロフィールを表示
                        </a>
                        <!-- モーダルの外枠 -->
                        <div class="modal fade" id="petEditModal{{ $pet->id }}" tabindex="-1">
                            <div class="modal-dialog">                                          
                                <!-- ここで別ファイルを読み込む -->
                                @include('pets.pet_edit')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 pr-1">                   
                <div class="card">
                    <!-- bg-light：薄い色 -->
                    <div class="card-body bg-light">
                        <h5 class="card-title">体調記録</h5>
                        <div class=" text-left">
                            <a href="{{ route('create.health_form', ['id' => $pet->id]) }}">+体調を記録</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope='col'>詳細</th>
                                    <th scope='col'>日付</th>
                                    <th scope='col'>元気</th>
                                    <th scope='col'>お散歩</th>
                                    <th scope='col'>体重</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- 84行目の {!! ... !!}: 文字列としてHTML要素（<i>タグ）を出力する --}}
                                @foreach ($healths as $health)
                                <tr>
                                    <td scope='col'>
                                        <!-- モーダルボタン -->
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#healthEditModal{{ $health->id }}">
                                            <i class="bi bi-clipboard-check"></i>
                                        </a>
                                    </td>
                                    <td scope='col'>{{ $health['health_date'] }}</td>
                                    <td scope='col'>
                                        @if($health['energy'] === 2)
                                            <i class="bi bi-emoji-laughing"></i>
                                        @elseif($health['energy'] === 1)
                                            <i class="bi bi-emoji-smile"></i>
                                        @elseif($health['energy'] === 0)
                                            <i class="bi bi-emoji-frown"></i>
                                        @else
                                            <i class="bi bi-emoji-dizzy"></i>
                                        @endif
                                    </td>
                                    <td scope='col'>{{ $health['walk_minutes'] }}</td>
                                    <td scope='col'>{{ $health['weight'] }}</td>
                                </tr>
                                <!-- モーダルの外枠 -->
                                <div class="modal fade" id="healthEditModal{{ $health->id }}" tabindex="-1">
                                    <div class="modal-dialog">                                          
                                        <!-- ここで別ファイルを読み込む -->
                                        @include('healths.health_edit')
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-sm-7 pl-1">                   
                <div class="card">
                    <!-- bg-light：薄い色 -->
                    <div class="card-body bg-light">
                        <h5 class="card-title">通院記録</h5>
                        <div class=" text-left">
                            <a href="{{ route('create.visit_form', ['id' => $pet->id]) }}">+通院を記録</a>
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
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#visitEditModal{{ $visit->id }}">
                                            <i class="bi bi-clipboard-heart"></i>
                                        </a>
                                    </td>
                                    <td scope='col'>{{ $visit['visit_date'] }}</td>
                                    <td scope='col'>{{ $visit['symptom'] }}</td>
                                    <td scope='col'>{{ $visit['has_visit'] === 0 ? '有' : '無' }}</td>
                                    <td scope='col'>{{ $visit['memo'] }}</td>                 
                                </tr>
                                <!-- モーダルの外枠 -->
                                <div class="modal fade" id="visitEditModal{{ $visit->id }}" tabindex="-1" aria-labelledby="visitEditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="width: 60%; max-width: none;">                                          
                                        <!-- ここで別ファイルを読み込む -->
                                        @include('visits.visit_edit', ['visitId' => $visit->id])
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('js/map.js') }}"></script>
<script async
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async">
</script>
@endsection