<!-- モーダル本体 -->
<div class="modal-content">
    <form action="{{ route('edit.visit', ['id' => $visit->id]) }}" method="post">
        @csrf
        @method('PUT')

        <!-- 閉じるボタン -->
        <div class="modal-header border-0 pt-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body d-flex flex-column align-items-center">
            <h2>{{ __('通院記録') }}</h2>
            <style>
                .visit-map {
                    height: 170px;
                    width: 100%;
                    margin: 0 auto;
                }
                .visit-form-row {
                    width: 100%;
                }
            </style>
            <div class="row visit-form-row">
                <!-- 入力フォーム -->
                <!-- 左側 -->
                <div class="col-md-6">
                    <label for="visit_date" class="mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">日付</label>
                    <input type="date" class="form-control" name="visit_date" 
                           id="visit_date" value="{{ old('visit_date', $visit->visit_date) }}"/>
                    <label for="has_visit" class="mt-2 mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">通院</label>
                    <select name="has_visit" class="form-control">
                        <option value="0" {{ old('has_visit', $visit->has_visit) == '0'? 'selected' : '' }}>あり</option>
                        <option value="1" {{ old('has_visit', $visit->has_visit) == '1'? 'selected' : '' }}>なし</option>
                    </select>
                    <label for="hospital_name" class="mt-2 mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">動物病院名
                           <button type="button" id="search-button{{ $visitId }}" 
                                class="btn btn-outline-primary px-1 py-0 ml-2 mb-1 btn-sm">
                            場所を表示
                        </button>
                    </label>                        
                    <input type="text" class="form-control" name="hospital_name"
                           id="hospital_name{{ $visitId }}" value="{{ old('hospital_name', $visit->hospital_name) }}" />
                        
                    {{-- 地図を表示する領域 --}}
                    <div id="map{{ $visitId }}" class="visit-map mt-3"></div>
                    {{-- Google Maps APIの読み込み --}}
                    <script>
                        $('#visitEditModal{{ $visitId }}').on('shown.bs.modal', function () {
                            editMap({{ $visitId }});
                        });
                    </script>
                </div>

                <!-- 右側 -->
                <div class="col-md-6">
                    <label for="symptom" class="mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">症状</label>
                    <input type="text" class="form-control" name="symptom"
                           id="symptom" value="{{ old('symptom', $visit->symptom) }}"/>
                    <label for="medication" class="mt-2 mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">投薬</label>
                    <input type="text" class="form-control" name="medication"
                           id="medication" value="{{ old('medication', $visit->medication) }}"/>
                    <label for="prescription" class="mt-2 mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">処方薬</label>
                    <input type="text" class="form-control" name="prescription"
                            id="prescription" value="{{ old('prescription', $visit->prescription) }}"/>                
                    <label for="medical_fees" class="mt-2 mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">医療費</label>
                    <div style="position: relative;">
                        <input type="number" step="0" min="0" class='form-control' name="medical_fees" value="{{ old('medical_fees', $visit->medical_fees) }}"/>
                        <span style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); color: #666;">円</span>
                    </div>
                    <label for="memo" class="mt-2 mb-0 pl-1"
                           style="display: flex; justify-content: flex-start;">メモ</label>
                        <textarea class="form-control"
                                style="height: 100px;"
                                name="memo"
                                id="memo">{{ old('memo', $visit->memo) }}
                        </textarea>
                    </div>
                </div>
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary mt-2 mb-4' style='width: 80px;'>更新</button>
                </div>    
            </div>
        </div>
    </form>
</div>
