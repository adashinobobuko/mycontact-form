<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

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
        if ($request->filled('query')) {
            $searchQuery = $request->input('query'); 
            $query->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('first_name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('email', 'LIKE', '%' . $searchQuery . '%');
            });
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
        $contacts = Contact::all();
        $csvData = "お名前,性別,メールアドレス,お問い合わせ種類,日付\n";

        foreach ($contacts as $contact) {
            $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $csvData .= "{$contact->last_name} {$contact->first_name},{$gender},{$contact->email}," .
            (optional($contact->category)->content ?? '未分類') . 
            ",{$contact->created_at->format('Y-m-d')}\n";
        }

        $response = Response::make($csvData);
        $response->header('Content-Type', 'text/csv');
        $response->header('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }

    public function showDetails($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.details', compact('contact'));
    }

}
