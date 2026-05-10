<?php
// データの登録や編集用
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pet;
use App\Health;
use App\Visit;
use App\Http\Requests\CreateData;

//use Illuminate\Support\Facades\Auth; //ログインユーザーの取得 あとで！！！！

class RegistrationController extends Controller
{
    public function createPetForm() {
        return view('pets.pet_form');
    }

    public function createPet(Request $request) { //POSTデータの取得にはRequestクラスを使用
        $pet = new Pet;

        $pet->user_id = 1;
        //$pet->user_id = $request->user_id;
        $pet->name = $request->name;
        $pet->birth_date = $request->birth_date;
        $pet->breed = $request->breed;
        $pet->gender = $request->gender;
        $pet->profile_image = $request->profile_image;

        $pet->save();
    }

    public function createHealth() {
        return view('healths.health_form');
    }

    public function createVisit() {
        return view('visits.visit_form');
    }
}
