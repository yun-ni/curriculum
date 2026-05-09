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
                            <h2 class="p-2  m-1 align-items-center font-semibold text-center text-gray-800 leading-tight">
                                {{ __('プロフィール追加') }}
                            </h2>
                        </x-slot>
                    </div>
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
                        }
                    </style>
                    <div class="text-center">
                        <div class="image-container"
                             style="position: relative; display: inline-block;">
                            <img src="{{ asset('images/no_image.png') }}"
                                 alt="プロフィール画像"
                                 width="150"
                                 height="150"
                                 style="border-radius: 50%; object-fit: cover;">
                            <button type="button" class="edit-button">編集</button>
                        </div>
                    </div>
                    <div>
                        <label for="name" class="mb-1">ペットの名前</label>
                            <input type='text' class='form-control' name='name' value="{{ old('name') }}"/>
                        <label for="birth_date" class="mb-1">誕生日</label>
                            <input type='date' class='form-control' name='birth_date' id='birth_date' value="{{ old('birth_date') }}"/>
                        <label for="breed" class="mb-1">犬種</label>
                            <input type='text' class='form-control' name='breed' value="{{ old('breed') }}"/>
                        <label for="gender" class="mb-1">性別</label>
                            <select name="gender" class="form-control">
                                <option value="0" {{ old('gender') === '0'? 'selected' : '' }}>女の子</option>
                                <option value="1" {{ old('gender') === '1'? 'selected' : '' }}>男の子</option>
                            </select>
                        <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
