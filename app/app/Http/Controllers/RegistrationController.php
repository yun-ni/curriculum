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

class RegistrationController extends Controller
{
    public function createPetForm() {
        return view('pets.pet_form');
    }

    public function createPet(Request $request) { //POSTデータの取得にはRequestクラスを使用

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

        $pet = new Pet;
        $columns = ['name', 'birth_date', 'breed', 'gender'];
        
        foreach ($columns as $column) {
            $pet->$column = $request->$column;
        }

        $pet->profile_image = $path;

        Auth::user()->pets()->save($pet);

        return redirect()->route('pet.index', ['id' => $pet->id]);
    }

    public function editPetForm($id) {
        $pet = Pet::find($id);
    
        return view('pets.pet_edit', [
            'pet' => $pet,
        ]);
    }

    public function editPet(int $id, Request $request) {
        $record = Pet::findOrFail($id);
        
        $columns = [
            'name', 
            'birth_date', 
            'breed', 
            'gender', 
        ];

        foreach ($columns as $column) {
            $record->$column = $request->$column;
        }

        if ($request->hasFile('profile_image')) {
            $profile_image = $request->file('profile_image');
            $imageName = time() . '.' . $profile_image->getClientOriginalExtension();
            $profile_image->move(public_path('images'), $imageName);
        
            $record->profile_image = 'images/' . $imageName;
        }
        
        $record->save();
        
        return redirect()->route('pet.index', ['id' => $record->id]);
    }

    public function destroyPet(int $id) {
        $pet = Pet::findOrFail($id);
        $pet->delete();
    
        return redirect()->route('home')->with('message', 'ペットデータを削除しました');
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
        $columns = ['health_date', 'energy', 'appetite', 'toilets', 'walk_minutes', 'weight'];
        
        foreach ($columns as $column) {
            $health->$column = $request->$column;
        }

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

        $columns = ['health_date', 'energy', 'appetite', 'toilets', 'walk_minutes', 'weight'];

        foreach ($columns as $column) {
            $record->$column = $request->$column;
        }

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
        $visit = new Visit;
        $pet = Pet::findOrFail($petId);
        $visit->pet_id = $petId;

        $columns = [
            'visit_date', 
            'has_visit', 
            'hospital_name', 
            'symptom', 
            'medication', 
            'prescription', 
            'medical_fees', 
            'memo'
        ];

        foreach ($columns as $column) {
            $visit->$column = $request->$column;
        }

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

        $columns = [
            'visit_date', 
            'has_visit', 
            'hospital_name', 
            'symptom', 
            'medication', 
            'prescription', 
            'medical_fees', 
            'memo'
        ];

        foreach ($columns as $column) {
            $record->$column = $request->$column;
        }

        $record->save();
        
        return redirect()->route('pet.index', ['id' => $record->pet_id]);
    }
    
}
