<?php
// DBからのデータ取得の管理用
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;

class DisplayController extends Controller
{
    //
    public function index(){
        // return view('welcome');

        // Eloquent
        // モデルのインスタンスを生成し、変数visitに代入
        $visit = new Visit;
        // visitモデルから全レコードを取得
        $all = $visit->all()->toArray();

        // var_dump($all);

        return view('welcome', [
            'visits' => $all,
        ]);
    }
}
