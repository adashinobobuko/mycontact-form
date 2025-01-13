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
        <input type="text" name="query" id="query" class="form-control" placeholder="名前やメールアドレスを入力してください" value="{{ request('query') }}">
    </div>
      <div class="form-group">
          <select name="gender" id="gender" class="form-control">
              <option value="">性別</option>
              <option value="">すべて</option>
              <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
              <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
              <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
          </select>
      </div>
    <div class="form-group">
      <div class="form-group">
          <select name="category" id="category" class="form-control">
              <option value="">お問い合わせの種類</option>
              @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                      {{ $category->content }}
                  </option>
              @endforeach
          </select>
      </div>
      </div>
    <div class="form-group">
        <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">検索</button>
      <button type="reset" class="btn btn-secondary">リセット</button>
      <button type="button" class="btn btn-info" onclick="location.href='{{ route('admin.export') }}'">エクスポート</button>
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
        <td>
            <!-- 詳細ボタンにデータを埋め込む -->
            <button 
                class="btn btn-info btn-sm"
                data-id="{{ $contact->id }}"
                data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                data-email="{{ $contact->email }}"
                data-gender="@if ($contact->gender == 1) 男性 @elseif ($contact->gender == 2) 女性 @elseif ($contact->gender == 3) その他 @else 不明 @endif"
                data-category="{{ $contact->category->content ?? '未分類' }}"
                data-date="{{ $contact->created_at->format('Y-m-d') }}"
                data-detail="{{ $contact->detail }}"
                onclick="showDetails(this)">
                詳細
            </button>
            <!--
            <form action="{{ route('admin.delete', $contact->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">削除</button>
            </form>-->
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
  <!-- admin.blade.phpの最後に追加 -->
<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>詳細情報</h3>
        <p><strong>お名前:</strong> <span id="modal-name"></span></p>
        <p><strong>性別:</strong> <span id="modal-gender"></span></p>
        <p><strong>メールアドレス:</strong> <span id="modal-email"></span></p>
        <p><strong>お問い合わせの種類:</strong> <span id="modal-category"></span></p>
        <p><strong>お問い合わせ内容:</strong> <span id="modal-detail"></span></p>
        <p><strong>登録日:</strong> <span id="modal-date"></span></p>
        <!-- 削除ボタン -->
        <form id="modal-delete-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    </div>
</div>
<script>
    function showDetails(button) {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const email = button.getAttribute('data-email');
        const gender = button.getAttribute('data-gender');
        const category = button.getAttribute('data-category');
        const detail = button.getAttribute('data-detail');
        const date = button.getAttribute('data-date');

        document.getElementById('modal-name').innerText = name;
        document.getElementById('modal-gender').innerText = gender;
        document.getElementById('modal-email').innerText = email;
        document.getElementById('modal-category').innerText = category;
        document.getElementById('modal-detail').innerText = detail;
        document.getElementById('modal-date').innerText = date;

        const deleteForm = document.getElementById('modal-delete-form');
        deleteForm.action = `/admin/delete/${id}`;

        document.getElementById('modal').style.display = 'block';
    }

  function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }

  function exportCsv() {
    window.location.href = '/admin/export';
    }
</script>
@endsection
