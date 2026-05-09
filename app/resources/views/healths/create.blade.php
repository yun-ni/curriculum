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
                            <h2 class="p-2  m-4 align-items-center font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('体調記録') }}
                            </h2>
                        </x-slot> 
                    </div>
                    <label for="health_date" class="mb-1">日付</label>
                        <input type='date' class='form-control' name='health_date' id='health_date' value="{{ old('health_date') }}"/>
                    <label for="energy" class="mb-1">元気</label>
                        <input type="text" class='form-control' name='energy' value="{{ old('energy') }}"/>
                    <label for="appetite" class="mb-1">食欲</label>
                        <input type="text" class='form-control' name='appetite' value="{{ old('appetite') }}"/>
                    <label for="toilets" class="mb-1">トイレ</label>
                        <input type="text" class='form-control' name='toilets' value="{{ old('toilets') }}"/>
                    <label for="walk_minutes" class="mb-1">散歩</label>
                        <input type="text" class='form-control' name='walk_minutes' value="{{ old('walk_minutes') }}"/>
                    <label for="weight" class="mb-1">体重</label>
                        <input type="text" class='form-control' name='weight' value="{{ old('weight') }}"/>
                    <a href="" class="btn btn-primary">登録</a> 
                </form>
            </div>
        </div>
    </div>
@endsection
