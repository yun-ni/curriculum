<?php
// DBからのデータ取得の管理用
namespace App\Http\Controllers;

use App\User;
use App\Pet;
use App\Health;
use App\Visit;

class DisplayController extends Controller
{
    public function index(){

        // Eloquent
        $user = new User;
        $pet = new Pet;

        $all_user = $user->all()->toArray();
        $all_pet = $pet->all()->toArray();

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
    }
}
