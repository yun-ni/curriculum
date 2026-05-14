<?php
// データの登録や編集用
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pet;
use App\Health;
use App\Visit;
use App\Http\Requests\CreateData;

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

        $imageName = $noImage = 'no_image.png';

        if ($request->hasFile('profile_image')) {
            $profile_image = $request->file('profile_image');  
            $imageName = time() . '.' . $profile_image->getClientOriginalExtension();    
            $profile_image->move(public_path('images'), $imageName);    
        }

        $pet->user_id = $request->user_id;
        $pet->name = $request->name;
        $pet->birth_date = $request->birth_date;
        $pet->breed = $request->breed;
        $pet->gender = $request->gender;
        $pet->profile_image = $imageName;

        $pet->save();

        return redirect()->route('pet.index', ['id' => $pet->id]);
    }

  // 体調記録
    public function createHealthForm() {
        return view('healths.health_form');
    }

    public function createHealth(Request $request) {
        $health = new Health;

        $health->pet_id = 1;
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
        $instance = new Health;
        $record = $instance->find($id);

        // $columns = ['health_date', 'energy', 'appetite', 'toilets', 'walk_minutes', 'weight'];

        // foreach ($columns as $column) {
        //     $record->$colmun = $request->$colmun;
        // }
        // $record->save();
        $record->pet_id = 1;
        $record->health_date = $request->health_date;
        $record->energy = $request->energy;
        $record->appetite = $request->appetite;
        $record->toilets = $request->toilets;
        $record->walk_minutes = $request->walk_minutes;
        $record->weight = $request->weight;

        $record->save();
        
        return redirect()->route('pet.index', ['id' => $health->pet_id]);
    }

  // 通院記録
    public function createVisitForm() {
        return view('visits.visit_form');
    }

    public function createVisit(Request $request) {
        $visit = new Visit;

        $visit->pet_id = 1;
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
}
