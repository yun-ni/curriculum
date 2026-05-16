@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
    <div style="height: calc(97.2vh - 56px);" class="d-flex align-items-center justify-content-center">
        <div class="border bg-light d-flex flex-column align-items-center justify-content-center"
             style="width: 50%; height: 99%;">
            <form action="{{ route('edit.health', ['id' => $health->id]) }}" method="post">
                @csrf                
                <h2 class="p-2  mt-3 align-items-center font-semibold text-center text-gray-800 leading-tight">
                    {{ __('体調記録') }}
                </h2>
                <style>
                    .form-control {
                        width: 300px;
                    }
                    .radio-group label {
                        margin-right: 15px; /* 選択肢の間のスペース */
                        cursor: pointer;
                    }
                </style>
                <label for="health_date" class="ml-2 mb-0">日付</label>
                    <input type='date' class='form-control' name='health_date' 
                             id='health_date' value="{{ $health->health_date }}"/>
                <label for="energy" class="ml-2 mt-2 mb-0">元気</label>
                <div class='form-control radio-group text-center'>
                    <label>
                        <input type="radio" name='energy' value='2' {{ old('energy', $health->energy) == '2' ? 'checked' : '' }} />
                        <i class="bi bi-emoji-laughing"></i>
                    </label>
                    <label>
                        <input type="radio" name='energy' value='1' {{ old('energy', $health->energy) == '1' ? 'checked' : '' }} />
                        <i class="bi bi-emoji-smile"></i>
                    </label>
                    <label>
                        <input type="radio" name='energy' value='0' {{ old('energy', $health->energy) == '0' ? 'checked' : '' }} />
                        <i class="bi bi-emoji-frown"></i>
                    </label>
                    <label>
                        <input type="radio" name='energy' value='-1' {{ old('energy', $health->energy) == '-1' ? 'checked' : '' }} />
                        <i class="bi bi-emoji-dizzy"></i>
                    </label>
                </div>
                <label for="appetite" class="ml-2 mt-2 mb-0">食欲</label>
                <div class='form-control radio-group text-center'>
                    <label><input type="radio" name='appetite' value='2' {{ old('appetite', $health->appetite) == '2' ? 'checked' : '' }} /> ◎</label>
                    <label><input type="radio" name='appetite' value='1' {{ old('appetite', $health->appetite) == '1' ? 'checked' : '' }} /> ◯</label>
                    <label><input type="radio" name='appetite' value='0' {{ old('appetite', $health->appetite) == '0' ? 'checked' : '' }} /> △</label>
                    <label><input type="radio" name='appetite' value='-1' {{ old('appetite', $health->appetite) == '-1' ? 'checked' : '' }} /> ✕</label>
                </div>
                <label for="toilets" class="ml-2 mt-2 mb-0">トイレ</label>
                <div class='form-control radio-group text-center'>
                    <label><input type="radio" name='toilets' value='2' {{ old('toilets', $health->toilets) == '2' ? 'checked' : '' }} /> ◎</label>
                    <label><input type="radio" name='toilets' value='1' {{ old('toilets', $health->toilets) == '1' ? 'checked' : '' }} /> ◯</label>
                    <label><input type="radio" name='toilets' value='0' {{ old('toilets', $health->toilets) == '0' ? 'checked' : '' }} /> △</label>
                    <label><input type="radio" name='toilets' value='-1' {{ old('toilets', $health->toilets) == '-1' ? 'checked' : '' }} /> ✕</label>
                </div>
                <label for="walk_minutes" class="ml-2 mt-2 mb-0">散歩</label>
                <div style="position: relative;">
                    <input type="number" class='form-control' name='walk_minutes' value="{{ $health->walk_minutes }}" min="0" />
                    <span style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); color: #666;">分</span>
                </div>
                <label for="weight" class="ml-2 mt-2 mb-0">体重</label>
                <div style="position: relative;">
                    <input type="number" step="0.01" min="0" class='form-control' name='weight' value="{{ $health->weight }}"/>
                    <span style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); color: #666;">kg</span>
                </div>
                <div class='row justify-content-center'>
                    <a href="{{  route('edit.health', ['id' => $health['id']]) }}" >
                        <button type='submit' class='btn btn-primary w-25 mt-2 mb-4'>変更</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
