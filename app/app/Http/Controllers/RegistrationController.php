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
        return view('pets.create');
    }
}
