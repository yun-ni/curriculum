<?php
// DBからのデータ取得の管理用
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function petIndex(Request $request, int $petId) {
        $pet = Pet::findOrFail($petId);
        $healths = Health::where('pet_id', $petId)->get();
        $visits = Visit::where('pet_id', $petId)->get();
    
        $today = Carbon::today()->toDateString();

        $todayHealth = Health::where('pet_id', $petId)
        ->whereDate('health_date', $today)
        ->first();

        if (is_null($todayHealth)) {
            return redirect()->route('create.health_form', ['id' => $petId]);
        }

        // 非同期処理 記録を無限スクロール
        // レコードを10件ずつ取得
        $health_records = Health::where('pet_id', $petId)->latest()->paginate(10);
        $visit_records = Visit::where('pet_id', $petId)->latest()->paginate(10);

        // Ajax通信の場合はJSONを返す
        if ($request->ajax()) {
            return response()->json([
                'health_html' => view('pets.health_list', compact('health_records'))->render(),
                'visit_html' => view('pets.visit_list', compact('visit_records'))->render(),
                'healthHasMorePages' => $health_records->hasMorePages(),
                'visitHasMorePages' => $visit_records->hasMorePages(),
            ]);
        }

        return view('pets.index', compact('pet', 'healths', 'visits'));
    }
}
