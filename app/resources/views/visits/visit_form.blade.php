@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
    <!-- ローディング画面 -->
    <div id="loading">
        <img class="spinner" src="{{ asset('images/loading.png') }}" alt="">
    </div>

    <div style="height: calc(97.2vh - 56px);" class="d-flex align-items-center justify-content-center">
        <div class="border bg-light d-flex flex-column align-items-center justify-content-center"
             style="width: 70%; height: 99%;">
            <form action="{{ route('create.visit', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2 class="p-2  mt-3 align-items-center font-semibold text-center text-gray-800 leading-tight">
                    {{ __('通院記録') }}
                </h2>
                @if ($errors->visit->any())
                    <div class="alert alert-danger error-area">
                        <ul class="mb-0">
                            @foreach ($errors->visit->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <style>
                    /* 横幅 */
                    .form-control {
                        width: 320px;
                    }
                    /* 地図のサイズを指定 */
                    #map {
                        height: 170px;
                        width: 300px;
                        /* 上下は0、左右は自動 */
                        margin: 0 auto;
                    }
                    .error-area {
                        position: absolute;
                        top: 20px;
                        left: 50%;
                        transform: translateX(-50%);
                        width: 380px;
                        padding: 8px 16px;
                        font-size: 16px;
                        background: rgba(255, 200, 200, 0.6);
                        backdrop-filter: blur(3px);
                        border: 1px solid rgba(255, 150, 150, 0.5);
                        border-radius: 10px;
                        z-index: 1000;
                    }
                    .error-area ul {
                        padding-left: 20%;
                        margin-bottom: 0;
                    }
                    .receipt-area {
                        width: 320px;
                    }
                    /* ローディング画面 */
                    #loading {
                        transition: all 1s;
                        background-color: rgba(93, 93, 93, 0.7);
                        position: fixed;
                        inset: 0;
                        z-index: 9999;
                        display: grid;
                        place-items: center;

                        /* 最初は非表示 */
                        opacity: 0;
                        visibility: hidden;
                    }
                    /* OCR開始時に表示 */
                    #loading.loading-active {
                        opacity: 1;
                        visibility: visible;
                    }
                    .spinner {
                        width: 200px;
                        height: 200px;
                    }
                </style> 
                <div class="row">
                    <!-- 左側 -->
                    <div class="col-md-6">
                        <label for="visit_date" class="ml-2 mt-2 mb-0">日付</label>
                        <input type="date" class="form-control" name="visit_date" 
                                id="visit_date" value="{{ old('visit_date') }}"/>
                        <label for="has_visit" class="ml-2 mt-2 mb-0">通院</label>
                        <select name="has_visit" class="form-control">
                            <option value="0" {{ old('has_visit') === '0'? 'selected' : '' }}>あり</option>
                            <option value="1" {{ old('has_visit') === '1'? 'selected' : '' }}>なし</option>
                        </select>
                        <label for="hospital_name" class="ml-2 mt-2 mb-0">動物病院名
                            <button type="button" id="search-button" 
                                    class="btn btn-outline-primary px-1 py-0 ml-2 mb-1 btn-sm">
                                場所を表示
                            </button>
                        </label>                        
                            <input type="text" class="form-control" name="hospital_name"
                                    id="hospital_name" value="{{ old('hospital_name') }}" />
                        
                        {{-- 地図を表示する領域 --}}
                        <div id="map" class="mt-3"></div>

                        {{-- Google Maps APIの読み込み --}}
                        <script async
                                src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async&callback=initMap">
                        </script>
                        <script src="{{ asset('js/map.js') }}"></script>
                    </div>
                    <!-- 右側 -->
                    <div class="col-md-6">
                        <label for="symptom" class="ml-2 mt-2 mb-0">症状</label>
                        <input type="text" class="form-control" name="symptom"
                                id="symptom" value="{{ old('symptom') }}"/>
                        <label for="medication" class="ml-2 mt-2 mb-0">投薬</label>
                        <input type="text" class="form-control" name="medication"
                                id="medication" value="{{ old('medication') }}"/>
                        <label for="prescription" class="ml-2 mt-2 mb-0">処方薬</label>
                        <input type="text" class="form-control" name="prescription"
                                id="prescription" value="{{ old('prescription') }}"/>                
                        <label for="medical_fees" class="ml-2 mt-2 mb-0">医療費</label>
                        <div style="position: relative;">
                            <input type="number" step="0" min="0" class='form-control' name="medical_fees" 
                                   value="{{ session('medical_fees') ?? old('medical_fees') }}"/>
                            <span style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); color: #666;">円</span>
                        </div>
                        <!-- OCR専用form -->
                        <div class="receipt-area">
                            <label for="receipt" class="ml-2 mt-2 mb-0">医療費を計算</label>
                            <input type="file" name="receipt" id="receipt" accept="image/*">
                            <button type="submit" formaction="{{ route('visit.ocr.generate', ['petId' => $id]) }}"
                                    id="my-button" onclick="startLoading()"
                                    formmethod="post"
                                    formenctype="multipart/form-data">読み取る</button>
                        </div>
                        <label for="memo" class="ml-2 mt-2 mb-0">メモ</label>
                        <textarea class="form-control"
                            style="height: 100px;"
                            name="memo"
                            id="memo">{{ old('memo') }}</textarea>
                    </div>
                </div>

                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary mt-2 mb-4' style='width: 80px;'>登録</button>
                </div>
            </form>
        </div>
    </div>

<!-- 制御用スクリプト -->
<script>
function startLoading() {
    const btn = document.getElementById('my-button');
    // 画面全体にローディング画像を表示
    loading.classList.add('loading-active');

    // 読み込み中状態に変更
    btn.innerHTML = `
        読み込み中...
    `;
}
</script>

@endsection
