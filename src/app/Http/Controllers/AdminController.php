<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\AdminRequest;//提出前に必要かどうか確認しファイルごと削除する

class AdminController extends Controller
{
    //$query = Data::query();
        
    public function index(Request $request)
    {
        // 必要なデータを取得
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();

         // compactの中の変数名を修正
        return view('admin', compact('contacts', 'categories'));
    }

     public function delete($id)
    {
        Data::findOrFail($id)->delete();
         return redirect()->route('admin.index')->with('message', '削除しました');
    }

    public function search(Request $request)
    {
        // クエリビルダーの初期化
        $query = Contact::query();

        // 検索条件を追加
        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('content', 'like', '%' . $request->category . '%');
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 絞り込んだデータを取得 (ページネーション)
        $contacts = $query->paginate(7);

        // カテゴリーデータも取得（ドロップダウンが必要な場合）
        $categories = Category::all();

        // ビューにデータを渡す
        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        $query = Data::query();

        // 同じ検索条件を適用
        // ...
        
        // CSV形式でエクスポート処理
        // ...
    }

    public function showDetails($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.details', compact('contact'));
    }

}
