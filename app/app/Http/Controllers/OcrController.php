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
        $prompt = $request->input('prompt');

        // 【OpenAI / GPT API の場合】
        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://openai.com', [
                'model' => 'gpt-4o',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
            ]);

        // JSONとしてフロントエンドに結果を返す
        return response()->json($response->json());
    }
}
