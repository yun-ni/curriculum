@extends('layouts.layout')
@section('content')
    <div style="height: calc(97.2vh - 56px);" class="d-flex align-items-center justify-content-center">
        <div class="border bg-light d-flex flex-column align-items-center justify-content-center"
             style="width: 50%; height: 99%;">
            <div>
                <form action="{{ route('create.pet', ['redirect' => 'home']) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <h2 class="p-2  m-1 align-items-center font-semibold text-center text-gray-800 leading-tight">
                            {{ __('プロフィール追加') }}
                        </h2>
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
                            width: 110px;
                        }
                    </style>
                    <div class="text-center">
                        <div class="image-container"
                             style="position: relative; display: inline-block;">
                            <img src="{{ asset('images/no_image.png') }}"
                                 alt="プロフィール画像"
                                 {{-- profile-preview :プレビュー表示 --}}
                                 id="profile-preview"
                                 width="150"
                                 height="150"
                                 style="border-radius: 50%; object-fit: cover;">
                            {{-- ファイル選択 input (画像のみ許可) display: none;で非表示 --}}
                            <input type='file' class='' name='profile_image' id='profile_image' value="{{  old('profile_image') }}" 
                                    accept="image/*" onchange="previewImage(this)" style="display: none;"/>
                            <button type="button" class="edit-button" onclick="document.getElementById('profile_image').click()">
                                画像を追加
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="name" class="ml-2 mt-1 mb-0">ペットの名前</label>
                        <input type='text' class='form-control' name='name' value="{{ old('name') }}"/>
                        <label for="birth_date" class="ml-1 mt-2 mb-0">誕生日</label>
                        <input type='date' class='form-control' name='birth_date' id='birth_date' value="{{ old('birth_date') }}"/>
                        <label for="breed" class="ml-2 mt-1 mb-0">犬種</label>
                        <input type='text' class='form-control' name='breed' value="{{ old('breed') }}"/>
                        <label for="gender" class="ml-2 mt-1 mb-0">性別</label>
                        <select name="gender" class="form-control">
                            <option value="0" {{ old('gender') === '0'? 'selected' : '' }}>女の子</option>
                            <option value="1" {{ old('gender') === '1'? 'selected' : '' }}>男の子</option>
                        </select>
                        <div class='row justify-content-center'>
                            <button type='submit' class='btn btn-primary w-25 mt-2 mb-3'>登録</button>
                        </div> 
                    </div>
                </form>
                <!-- プロフィール画像用 -->
                <script>
                    function previewImage(obj) {
                        const fileReader = new FileReader();
                        fileReader.onload = (function() {
                            document.getElementById('profile-preview').src = fileReader.result;
                        });
                        fileReader.readAsDataURL(obj.files[0]);
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
