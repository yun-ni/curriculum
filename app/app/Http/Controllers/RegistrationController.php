<?php
// データの登録や編集用
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pet;
use App\Health;
use App\Visit;
use App\Http\Requests\CreateData;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File; // Fileファサードを追加
use Illuminate\Support\Facades\Storage; // ファイル操作用ファサードを追加

//use Illuminate\Support\Facades\Auth; //ログインユーザーの取得 あとで！！！！

class RegistrationController extends Controller
{
    public function createPetForm() {
        return view('pets.pet_form');
    }

    public function createPet(Request $request) { //POSTデータの取得にはRequestクラスを使用
        $pet = new Pet;

        // 画像が選択されている場合
        if ($request->hasFile('profile_image')) {
            // 画像名を作成
            $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            // public/images に保存
            $request->file('profile_image')->move(public_path('images'), $imageName);
            // DBに保存するパス
            $path = 'images/' . $imageName;   
        } else {
            // 画像が選択されていない場合はデフォルト画像を登録
            $path = 'images/no_image.png';
        }

        $pet->name = $request->name;
        $pet->birth_date = $request->birth_date;
        $pet->breed = $request->breed;
        $pet->gender = $request->gender;
        $pet->profile_image = $path;

        Auth::user()->pets()->save($pet);

        return redirect()->route('pet.index', ['id' => $pet->id]);
    }

    // 体調記録
    public function createHealthForm($id) {
        return view('healths.health_form', [
            'id' => $id,
        ]);
    }

    public function createHealth(int $petId, Request $request) {
        // ペットを取得（見つからない場合は404エラーを出すなら findOrFail を推奨）
        $pet = Pet::findOrFail($petId);

        // リクエストデータをもとにHealthモデルのインスタンスを生成して保存
        $health = new Health;

        $health->pet_id = $petId;
        $health->health_date = $request->health_date;
        $health->energy = $request->energy;
        $health->appetite = $request->appetite;
        $health->toilets = $request->toilets;
        $health->walk_minutes = $request->walk_minutes;
        $health->weight = $request->weight;

        $health->save();

        return redirect()->route('pet.index', ['id' => $health->pet_id]);
    }

    public function editHealthForm($id) {
        $health = Health::find($id);
    
        return view('healths.health_edit', [
            'health' => $health,
        ]);
    }

    public function editHealth(int $id, Request $request) {
        $record = Health::findOrFail($id);

        $record->health_date = $request->health_date;
        $record->energy = $request->energy;
        $record->appetite = $request->appetite;
        $record->toilets = $request->toilets;
        $record->walk_minutes = $request->walk_minutes;
        $record->weight = $request->weight;

        $record->save();
        
        return redirect()->route('pet.index', ['id' => $record->pet_id]);
    }

  // 通院記録
    public function createVisitForm($id) {
        return view('visits.visit_form', [
            'id' => $id,
        ]);
    }

    public function createVisit(int $petId, Request $request) {
        $pet = Pet::findOrFail($petId);
        $visit = new Visit;
        
        $visit->pet_id = $petId;
        $visit->visit_date = $request->visit_date;
        $visit->has_visit = $request->has_visit;
        $visit->hospital_name = $request->hospital_name;
        $visit->symptom = $request->symptom;
        $visit->medication = $request->medication;
        $visit->prescription = $request->prescription;
        $visit->medical_fees = $request->medical_fees;
        $visit->memo = $request->memo;

        $visit->save();

        return redirect()->route('pet.index', ['id' => $visit->pet_id]);
    }

    public function editVisitForm($id) {
        $visit = Visit::find($id);
    
        return view('visits.visit_edit', [
            'visit' => $visit,
        ]);
    }

    public function editVisit(int $id, Request $request) {
        $record = Visit::findOrFail($id);

        $visit->visit_date = $request->visit_date;
        $visit->has_visit = $request->has_visit;
        $visit->hospital_name = $request->hospital_name;
        $visit->symptom = $request->symptom;
        $visit->medication = $request->medication;
        $visit->prescription = $request->prescription;
        $visit->medical_fees = $request->medical_fees;
        $visit->memo = $request->memo;

        $record->save();
        
        return redirect()->route('pet.index', ['id' => $record->pet_id]);
    }
}
