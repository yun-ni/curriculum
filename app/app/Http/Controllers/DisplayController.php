<?php
// DBからのデータ取得の管理用
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Pet;
use App\User;

class DisplayController extends Controller
{
    //
    public function index(){
        // return view('welcome');

        // Eloquent
        // モデルのインスタンスを生成し、変数visitに代入
        $visit = new Visit;
        $pet = new Pet;
        $user = new User;

        // visitモデルから全レコードを取得
        $all = $visit->all()->toArray();
        $all_pet = $pet->all()->toArray();
        $all_user = $user->all()->toArray();

        // var_dump($all);

        return view('healths.create', [
            'visits' => $all,
            'pets' => $all_pet,
            'users' => $all_user,
        ]);
    }
}
