@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container admin-container">
  <h1 class="admin-title">Admin</h1>
  
  <!-- 検索フォーム -->
  <form action="/admin/search" method="GET" class="search-form">
    <div class="form-group">
        <label for="name">名前</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="名前を入力" value="{{ request('name') }}">
    </div>
    <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="メールアドレスを入力" value="{{ request('email') }}">
    </div>
      <div class="form-group">
          <label for="gender">性別</label>
          <select name="gender" id="gender" class="form-control">
              <option value="">すべて</option>
              <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
              <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
              <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
          </select>
      </div>
    <div class="form-group">
      <div class="form-group">
          <label for="category">お問い合わせ種類</label>
          <select name="category" id="category" class="form-control">
              <option value="">すべて</option>
              @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                      {{ $category->content }}
                  </option>
              @endforeach
          </select>
      </div>
      </div>
    <div class="form-group">
        <label for="date">日付</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">検索</button>
      <button type="reset" class="btn btn-secondary">リセット</button>
      <button type="button" class="btn btn-info" onclick="exportData()">エクスポート</button>
    </div>
  </form>

  <!-- 検索結果表示 -->
  <div class="results-container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>お名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>お問い合わせ種類</th>
          <th>日付</th>
          <th>操作</th>
        </tr>
      </thead>
  <tbody>
      @foreach($contacts as $contact)
      <tr>
          <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
          <td>
            @if ($contact->gender == 1)
                男性
            @elseif ($contact->gender == 2)
                女性
            @elseif ($contact->gender == 3)
                その他
            @else
                不明
            @endif
          </td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->category->content ?? '未分類' }}</td>
          <td>{{ $contact->created_at->format('Y-m-d') }}</td>
          <td>
              <button class="btn btn-info btn-sm">詳細</button>
              <form action="{{ route('admin.delete', $contact->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">削除</button>
              </form>
          </td>
      </tr>
      @endforeach
  </tbody>

    </table>

    <div class="pagination-container">
      {{ $contacts->links() }} <!-- ページネーションリンク -->
    </div>
  </div>

  <!-- モーダルウィンドウ -->
  <div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div id="modal-details"></div>
    </div>
  </div>
</div>
@endsection
