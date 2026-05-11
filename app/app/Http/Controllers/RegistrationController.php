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

        $pet->user_id = 1;
        $pet->name = $request->name;
        $pet->birth_date = $request->birth_date;
        $pet->breed = $request->breed;
        $pet->gender = $request->gender;
        $pet->profile_image = $imageName;

        $pet->save();

        return redirect()->route('pet.index', ['id' => $pet->id]);
    }

    public function createHealth() {
        return view('healths.health_form');
    }

    public function createVisit() {
        return view('visits.visit_form');
    }
}
