@extends('layouts.layout') <!-- 使用するテンプレートの宣言/('一つ上のディレクトリ.｢.blade.phpの前のファイル名｣') -->
@section('content')
    <div style="height: calc(100vh - 56px);" class="d-flex align-items-center justify-content-center">
        <div class="border bg-light d-flex flex-column align-items-center justify-content-center"
             style="width: 50%; aspect-ratio: 1 / 1;">
            <div>
                <form action="{{ route('create.pet', ['redirect' => 'home']) }}" method="post">
                    @csrf
                    <div>
                        <x-slot name="header">
                            <h2 class="p-2  m-2 align-items-center font-semibold text-center text-gray-800 leading-tight">
                                {{ __('体調記録') }}
                            </h2>
                        </x-slot> 
                    </div>
                    <label for="health_date" class="mb-1">日付</label>
                        <input type='date' class='form-control' style="width: 300px;" name='health_date' 
                                 id='health_date' value="{{ old('health_date') }}"/>
                    <style>
                        .radio-group label {
                            margin-right: 15px; /* 選択肢の間のスペース */
                            cursor: pointer;
                        }
                    </style>
                    <label for="energy" class="mb-1">元気</label>
                    <div class='form-control radio-group text-center'>
                        <label>
                            <input type="radio" name='energy' value='2' {{ old('energy') == '2' ? 'checked' : '' }} />
                            <i class="bi bi-emoji-laughing" style="font-size: 1rem;"></i>
                        </label>
                        <label>
                            <input type="radio" name='energy' value='1' {{ old('energy') == '1' ? 'checked' : '' }} />
                            <i class="bi bi-emoji-smile"></i>
                        </label>
                        <label>
                            <input type="radio" name='energy' value='0' {{ old('energy') == '0' ? 'checked' : '' }} />
                            <i class="bi bi-emoji-frown"></i>
                        </label>
                        <label>
                            <input type="radio" name='energy' value='-1' {{ old('energy') == '-1' ? 'checked' : '' }} />
                            <i class="bi bi-emoji-dizzy"></i>
                        </label>
                    </div>
                    <label for="appetite" class="mb-1">食欲</label>
                    <div class='form-control radio-group text-center'>
                        <label><input type="radio" name='appetite' value='2' {{ old('appetite') == '2' ? 'checked' : '' }} /> ◎</label>
                        <label><input type="radio" name='appetite' value='1' {{ old('appetite') == '1' ? 'checked' : '' }} /> ◯</label>
                        <label><input type="radio" name='appetite' value='0' {{ old('appetite') == '0' ? 'checked' : '' }} /> △</label>
                        <label><input type="radio" name='appetite' value='-1' {{ old('appetite') == '-1' ? 'checked' : '' }} /> ✕</label>
                    </div>
                    <label for="toilets" class="mb-1">トイレ</label>
                    <div class='form-control radio-group text-center'>
                        <label><input type="radio" name='toilets' value='2' {{ old('toilets') == '2' ? 'checked' : '' }} /> ◎</label>
                        <label><input type="radio" name='toilets' value='1' {{ old('toilets') == '1' ? 'checked' : '' }} /> ◯</label>
                        <label><input type="radio" name='toilets' value='0' {{ old('toilets') == '0' ? 'checked' : '' }} /> △</label>
                        <label><input type="radio" name='toilets' value='-1' {{ old('toilets') == '-1' ? 'checked' : '' }} /> ✕</label>
                    </div>
                    <label for="walk_minutes" class="mb-1">散歩</label>
                        <input type="time" pattern="\d*" class='form-control' name='walk_minutes' value="{{ old('walk_minutes') }}" />
                    <label for="weight" class="mb-1">体重</label>
                    <div style="position: relative;">
                        <input type="number" step="0.01" min="0" class='form-control' name='weight' value="{{ old('weight') }}"/>
                        <span style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #666;">kg</span>
                    </div>
                    <div class='row justify-content-center'>
                        <button type='submit' class='btn btn-primary w-25 mt-3 mb-3'>登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
