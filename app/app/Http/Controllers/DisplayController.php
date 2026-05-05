<?php
// DBからのデータ取得の管理用
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pet;
use App\Health;
use App\Visit;

class DisplayController extends Controller
{
    //
    public function index(){
        // return view('welcome');

        // Eloquent
        // モデルのインスタンスを生成し、変数visitに代入
        $user = new User;
        $pet = new Pet;
        $pets = Pet::with('health')->get();
        // $health = new Health;
        // $visit = new Visit;

        // visitモデルから全レコードを取得
        $all_user = $user->all()->toArray();
        $all_pet = $pet->all()->toArray();
        // $all_visit = $visit->all()->toArray();
        // $all_health = $health->all()->toArray();

        // var_dump($all);

        return view('home.home', [ 
            'users' => $all_user,
            'pets' => $all_pet,
        ]);
    }

    public function petIndex(int $petId) {
        $pet = Pet::find($petId);
        $healths = Health::where('pet_id', $petId)->get();
        $visits = Visit::where('pet_id', $petId)->get();
        return view('pets.index', compact('pet', 'healths', 'visits'));
        // echo $petId;
    }
}
