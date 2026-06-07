<?php

namespace App\Http\Controllers;

// PDFを作成・出力するための外部パッケージ（laravel-dompdf）
use Barryvdh\DomPDF\Facade\Pdf;

use App\User;
use App\Pet;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VetController extends Controller
{
    public function dashboard()
    {
        $users = User::with('pets')->get();
    
        return view('vets.dashboard', [
            'users' => $users,
        ]);
    }

    public function show(int $id)
    {
        $user = User::with('pets')->findOrFail($id);
    
        return view('vets.show', [
            'pets' => $user->pets,
        ]);
    }

    public function index(int $id)
    {
        $pet = Pet::findOrFail($id);
        $visits = Visit::where('pet_id', $id)->get();

        return view('vets.index', [
            'pet' => $pet,
            'visits' => $visits,
        ]);
    }

    public function search(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $petName = $request->input('pet_name');
        $birthDate = $request->input('birth_date');
    
        $query = User::with('pets');
    
        if (!empty($email)) {
            $query->where('email', 'LIKE', "%{$email}%");
        }
    
        if (!empty($name)) {
            $query->where('name', 'LIKE', "%{$name}%");
        }
    
        if (!empty($petName)) {
            $query->whereHas('pets', function ($q) use ($petName) {
                $q->where('name', 'LIKE', "%{$petName}%");
            });
        }
    
        if (!empty($birthDate)) {
            $query->whereHas('pets', function ($q) use ($birthDate) {
                $q->where('birth_date', $birthDate);
            });
        }
    
        $users = $query->get();
    
        return view('vets.dashboard', [
            'users' => $users,
        ]);
    }

    public function pdf(int $id)
    {
        $pet = Pet::findOrFail($id);
        $visits = Visit::where('pet_id', $id)->get();

        // resources/views/vets/pdf.blade.php を読み込む
        $pdf = Pdf::loadView('vets.pdf', [
            'pet' => $pet,
            'visits' => $visits,
        ])->set_option('compress', 1)
        ->setPaper('a4', 'portrait'); // 縦A4サイズに指定

        // PDFライブラリの圧縮設定を有効化
        $pdf->setOption('is_font_subseting_enabled', true); // フォントサブセット化で軽量化
        $pdf->setOption('dpi', 150); // 解像度を下げて容量削減


        // ブラウザで表示する場合
        // return $pdf->stream('vets.pdf');
        
        // 直接ダウンロードさせる場合
        $fileName = '通院記録.pdf';
        
        return $pdf->download($fileName);   
    }

    public function logout()
    {
        Auth::guard('vet')->logout();

        return redirect()->route('login');
    }
}