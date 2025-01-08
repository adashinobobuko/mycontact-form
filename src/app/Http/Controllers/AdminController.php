<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data; // 適切なモデルを指定

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Data::query();

        // 検索条件
        if ($request->filled('name')) {
            if ($request->name_match === 'partial') {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            } else {
                $query->where('name', $request->name);
            }
        }
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('type')) {
            $query->where('type', 'LIKE', '%' . $request->type . '%');
        }
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // データ取得とページネーション
        $results = $query->paginate(7);

        return view('admin', compact('results'));
    }

    public function delete($id)
    {
        Data::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('message', '削除しました');
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
        $data = Data::findOrFail($id);
        return response()->json($data);
    }
}
