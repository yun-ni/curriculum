<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // 外部API呼び出し用

use App\Visit;
use App\Pet;

class OcrController extends Controller
{
    public function visitOcr(Request $request, int $petId)
    {
        $visit = new Visit;
        $pet = Pet::findOrFail($petId);
        $visit->pet_id = $petId;
        
        return view('visits.visit_form', [
            'medical_fees' => $totalFees,
            'id' => $visit->pet_id
        ]);
    }

    public function generate(Request $request, int $petId)
    {
        $visit = new Visit;
        $pet = Pet::findOrFail($petId);
        $visit->pet_id = $petId;

        // 画像ファイルのバリデーションと取得
        $receipt = $request->file('receipt');

        if (is_null($receipt)) {
            return back()->withInput();
        }

        // Base64文字列へ変換
        $base64Image = base64_encode(file_get_contents($receipt->getPathname()));
        // 画像の種類を取得
        $mimeType = $receipt->getMimeType();

        // Gemini APIエンドポイント
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";
    

        // プロンプトの条件
        $prompt = "以下のサービスに該当すると判断できる金額は医療費に含めないでください。
                  データ：
                  - カット
                  - カットコース
                  - トリミング
                  - 部分カット
                  - 毛玉
                  - デンタル
                  - シャンプー";
        
        // APIリクエストの送信
        $response = Http::timeout(60)
        ->withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                [
                    'parts' => [
                        // 「$prompt.\n」で変数を結合
                        ['text' => $prompt.  "\n領収書画像から上記データに該当する金額を除いた税込み合計金額のみを数字で返してください。説明文は不要です。例: 7601"],
                        [
                                'inlineData' => [
                                'mimeType' => $mimeType,
                                'data' => $base64Image
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    
        // 結果の取得
        $resultData = $response->json();
    
        if (!isset($resultData['candidates'])) {
            return back()
                ->withInput()
                ->with('error', 'OCRの読み取りに失敗しました。');
        }
        
        $totalFees = $resultData['candidates'][0]['content']['parts'][0]['text'];
    
        return back()
            ->withInput()
            ->with('medical_fees', $totalFees);
    }
    
}
