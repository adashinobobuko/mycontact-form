<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    //
    public function index()
    {
        // カテゴリーを取得
        $categories = Category::all();

        // ビューにデータを渡す
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        
        // 電話番号を1つに結合
        $validated['tel'] = implode('-', [
            $validated['tel1'],
            $validated['tel2'],
            $validated['tel3'],
        ]);

        return view('inquiry.confirm', ['data' => $validated]); // 確認画面のビューを返す
    }

    public function edit(Request $request)
    {
        // 前回入力したデータをフォームに表示
        return redirect('/')->withInput($request->all());
    }

    public function submit(ContactRequest $request)
    {
        // リクエストバリデーションを適用
        $validated = $request->validated();

        // 電話番号を1つに結合
        $validated['tel'] = implode('-', [
            $validated['tel1'] ?? '',
            $validated['tel2'] ?? '',
            $validated['tel3'] ?? '',
        ]);

        // 不要なキーを削除
        unset($validated['tel1'], $validated['tel2'], $validated['tel3']);

        // データを保存
        Contact::create($validated);

        // サンクスページの表示
        return view('thanks');
    }

}
