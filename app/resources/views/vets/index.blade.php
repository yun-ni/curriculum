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
                            .th-text {
                                color: #6c757d !important;
                                font-size: 0.875rem;
                            }
                            .td-text {
                                font-size: 1.2rem;
                            }
                            .suffix-text {
                                font-size: 0.8rem;
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
                        <table class="table">
                            <thead>
                                <tr >
                                    <th scope='col' class="th-text">飼い主</th>
                                    <th scope='col' class="th-text">ペット名</th>
                                    <th scope='col' class="th-text">誕生日</th>
                                    <th scope='col' class="th-text">犬種</th>
                                    <th scope='col' class="th-text">性別</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope='col' class="td-text">{{ $pet->user['name'] }}
                                        <span class="suffix-text">様</span>
                                    </td>
                                    <td scope='col' class="td-text">{{ $pet['name'] }}
                                        <span class="suffix-text">{{ $pet['gender'] === 0 ? 'ちゃん' : 'くん' }}</span>
                                    </td>
                                    <td scope='col' class="td-text">{{ $pet['birth_date'] }}</td>
                                    <td scope='col' class="td-text">{{ $pet['breed'] }}</td>
                                    <td scope='col' class="td-text">{{ $pet['gender'] === 0 ? '女の子' : '男の子' }}</td>                
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col py-2">                 
                <div class="card">
                    <!-- bg-light：薄い色 -->
                    <div class="card-body bg-light">
                        <h5 class="card-title">通院記録</h5>
                        <div class=" text-left">
                            <a href="{{ route('vet.pdf', ['id' => $pet->id]) }}">PDFで印刷</a>
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