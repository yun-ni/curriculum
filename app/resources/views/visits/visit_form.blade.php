@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
    <div style="height: calc(97.2vh - 56px);" class="d-flex align-items-center justify-content-center">
        <div class="border bg-light d-flex flex-column align-items-center justify-content-center"
             style="width: 70%; height: 99%;">
            <form action="{{ route('create.visit', ['id' => $id]) }}" method="post">
                @csrf
                <h2 class="p-2  mt-3 align-items-center font-semibold text-center text-gray-800 leading-tight">
                    {{ __('通院記録') }}
                </h2>
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
                        <label for="weightmedical_fees" class="ml-2 mt-2 mb-0">医療費</label>
                        <div style="position: relative;">
                            <input type="number" step="0" min="0" class='form-control' name="medical_fees" value="{{ old('medical_fees') }}"/>
                            <span style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); color: #666;">円</span>
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
@endsection
