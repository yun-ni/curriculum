<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // 外部API呼び出し用

class OcrController extends Controller
{
    public function visitOcr()
    {
        return view('ai'); // フロントエンドのビュー
    }

    public function generate(Request $request)
    {
        // 画像ファイルのバリデーションと取得
        $receipt = $request->file('receipt');
        // Base64文字列へ変換
        $base64Image = base64_encode(file_get_contents($receipt->getPathname()));
        // 画像の種類を取得
        $mimeType = $receipt->getMimeType();
    
        // Gemini APIエンドポイント
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";
    
        // APIリクエストの送信
        $response = Http::timeout(60)
        ->withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => '領収書画像から税込み合計金額のみを数字で返してください。説明文は不要です。例: 7601'],
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
        // dd($resultData['candidates'][0]['content']['parts']);
        
        $totalFees = $resultData['candidates'][0]['content']['parts'][0]['text'];
    
        return view('visits.visit_form', [
            'medical_fees' => $totalFees
        ]);
    }
    
}
