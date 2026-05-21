<!-- モーダル本体 -->
<div class="modal-content">
    <form action="{{ route('edit.pet', ['id' => $pet->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 閉じるボタン -->
        <div class="modal-header border-0 pt-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- タイトル -->
        <div class="modal-body d-flex flex-column align-items-center">
            <h2>{{ __('プロフィール') }}</h2>
            
            <!-- バリデーション -->
            @if ($errors->pet->any())
                <div class="alert alert-danger error-area">
                    <ul class="mb-0">
                        @foreach ($errors->pet->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                
                <script>
                    $(function () {
                        // エラーがある場合はモーダルを表示
                        $('#petEditModal{{ $pet->id }}').modal('show');

                        // モーダルが閉じられたときにエラーメッセージをクリア（次回開いた時に残らないようにする）
                        $('#petEditModal{{ $pet->id }}').on('hidden.bs.modal', function () {
                            $(this).find('.error-area').remove();
                        });
                    });
                </script>
            @endif
            <style>
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
            </style>
            <!-- 入力フォーム -->
            <div class="pet-form-area">
                <div class="">
                    <div class="image-container"
                         style="position: relative; display: inline-block;">
                        <!-- 一時保存された画像をプレビュー表示 -->
                        <img src="{{ asset($pet->profile_image) }}"
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
                    <input type='text' class='form-control' name='name' value="{{ old('name', $pet->name) }}"/>
                    <label for="birth_date" class="ml-1 mt-2 mb-0">誕生日</label>
                    <input type='date' class='form-control' name='birth_date' id='birth_date' value="{{ old('birth_date', $pet->birth_date) }}"/>
                    <label for="breed" class="ml-2 mt-1 mb-0">犬種</label>
                    <input type='text' class='form-control' name='breed' value="{{ old('breed', $pet->breed) }}"/>
                    <label for="gender" class="ml-2 mt-1 mb-0">性別</label>
                    <select name="gender" class="form-control">
                        <option value="0" {{ old('gender', $pet->gender) == '0'? 'selected' : '' }}>女の子</option>
                        <option value="1" {{ old('gender', $pet->gender) == '1'? 'selected' : '' }}>男の子</option>
                    </select>
                </div>
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-2 mb-3 mr-2'>変更</button>
                    <button type='submit' form="delete-pet-form" class='btn btn-danger w-25 mt-2 mb-3 ml-2'
                            onclick="return confirm('プロフィールを削除しますか')">削除</button>
                </div>
            </div> 
        </div>
    </form> 
    <!-- 削除フォーム -->
    <form id="delete-pet-form"
          action="{{ route('destroy.pet', ['id' => $pet->id]) }}" method="post">
        @csrf
        @method('DELETE')
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