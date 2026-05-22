<?php
// DBからのデータ取得の管理用
namespace App\Http\Controllers;

use App\User;
use App\Pet;
use App\Health;
use App\Visit;

use Carbon\Carbon;

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

        // エラーハンドリング findOrFailの場合は不要
        if (is_null($pet)) {
            abort(404);
        }
        
        // 今日の日付を取得
        $today = Carbon::today();
        // 今日の体調記録が記録されているか確認
        $healthExists = Health::where('pet_id', $petId)
    ->whereDate('health_date', $today)
    ->exists();

        if ($healthExists) {
            // 記録がある場合は完了画面や一覧画面を表示
            return view('pets.index', compact('pet', 'healths', 'visits'));
        }

        // 記録がない場合は登録フォームを表示
        return view('healths.health_form', compact('pet', 'healths'));
    }
}
