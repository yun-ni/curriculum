<!-- モーダル本体 -->
<div class="modal-content">
    <form action="{{ route('edit.health', ['id' => $health->id]) }}" method="post">
        @csrf
        @method('PUT')

        <!-- 閉じるボタン -->
        <div class="modal-header border-0 pt-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body d-flex flex-column align-items-center">
            <h2>{{ __('体調記録') }}</h2>

            <!-- 入力フォーム -->
            <div class="health-form-area">
                <label for="health_date" class="mb-0 pl-1" 
                       style="display: flex; justify-content: flex-start;">日付</label>
                    <input type='date' class='form-control' name='health_date' 
                        id='health_date' value="{{ old('health_date', $health->health_date) }}"/>
                <label for="energy" class="mt-2 mb-0 pl-1"
                       style="display: flex; justify-content: flex-start;">元気</label>
                <div class='form-control radio-group'>
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
                <label for="appetite" class="mt-2 mb-0 pl-1"
                       style="display: flex; justify-content: flex-start;">食欲</label>
                <div class='form-control radio-group'>
                    <label><input type="radio" name='appetite' value='2' {{ old('appetite', $health->appetite) == '2' ? 'checked' : '' }} /> ◎</label>
                    <label><input type="radio" name='appetite' value='1' {{ old('appetite', $health->appetite) == '1' ? 'checked' : '' }} /> ◯</label>
                    <label><input type="radio" name='appetite' value='0' {{ old('appetite', $health->appetite) == '0' ? 'checked' : '' }} /> △</label>
                    <label><input type="radio" name='appetite' value='-1' {{ old('appetite', $health->appetite) == '-1' ? 'checked' : '' }} /> ✕</label>
                </div>
                <label for="toilets" class="mt-2 mb-0 pl-1"
                       style="display: flex; justify-content: flex-start;">トイレ</label>
                <div class='form-control radio-group text-center'>
                    <label><input type="radio" name='toilets' value='2' {{ old('toilets', $health->toilets) == '2' ? 'checked' : '' }} /> ◎</label>
                    <label><input type="radio" name='toilets' value='1' {{ old('toilets', $health->toilets) == '1' ? 'checked' : '' }} /> ◯</label>
                    <label><input type="radio" name='toilets' value='0' {{ old('toilets', $health->toilets) == '0' ? 'checked' : '' }} /> △</label>
                    <label><input type="radio" name='toilets' value='-1' {{ old('toilets', $health->toilets) == '-1' ? 'checked' : '' }} /> ✕</label>
                </div>
                <label for="walk_minutes" class="mt-2 mb-0 pl-1"
                       style="display: flex; justify-content: flex-start;">散歩</label>
                <div style="position: relative;">
                    <input type="number" class='form-control' name='walk_minutes' value="{{ old('walk_minutes', $health->walk_minutes) }}" min="0" />
                    <span style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); color: #666;">分</span>
                </div>
                <label for="weight" class="mt-2 mb-0 pl-1"
                       style="display: flex; justify-content: flex-start;">体重</label>
                <div style="position: relative;">
                    <input type="number" step="0.01" min="0" class='form-control' name='weight' value="{{ old('weight', $health->weight) }}"/>
                    <span style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); color: #666;">kg</span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 mb-3" style="width: 90px;">変更</button>
        </div>   
    </form>
</div>
