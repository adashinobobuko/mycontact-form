@extends('layouts.app')

@section('content')
<div class="container">
  <h1>データ管理ページ</h1>
  
  <!-- 検索フォーム -->
  <form action="{{ route('admin.search') }}" method="GET">
    @csrf
    <div>
      <label for="name">名前</label>
      <input type="text" name="name" id="name" placeholder="名前を入力">
      <label>
        <input type="radio" name="name_match" value="partial" checked> 部分一致
      </label>
      <label>
        <input type="radio" name="name_match" value="exact"> 完全一致
      </label>
    </div>
    <div>
      <label for="email">メールアドレス</label>
      <input type="text" name="email" id="email" placeholder="メールアドレスを入力">
    </div>
    <div>
      <label for="gender">性別</label>
      <select name="gender" id="gender">
        <option value="">性別</option>
        <option value="all">全て</option>
        <option value="male">男性</option>
        <option value="female">女性</option>
        <option value="other">その他</option>
      </select>
    </div>
    <div>
      <label for="type">お問い合わせ種類</label>
      <input type="text" name="type" id="type" placeholder="種類を入力">
    </div>
    <div>
      <label for="date">日付</label>
      <input type="date" name="date" id="date">
    </div>
    <div>
      <button type="submit">検索</button>
      <button type="reset">リセット</button>
      <button type="button" onclick="exportData()">エクスポート</button>
    </div>
  </form>

  <!-- 検索結果表示 -->
  <table>
    <thead>
      <tr>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>性別</th>
        <th>お問い合わせ種類</th>
        <th>日付</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach($results as $data)
      <tr>
        <td>{{ $data->name }}</td>
        <td>{{ $data->email }}</td>
        <td>{{ $data->gender }}</td>
        <td>{{ $data->type }}</td>
        <td>{{ $data->date }}</td>
        <td>
          <button onclick="showDetails({{ $data->id }})">詳細</button>
          <form action="{{ route('admin.delete', $data->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- ページネーション -->
  {{ $results->links() }}

  <!-- モーダルウィンドウ -->
  <div id="modal" style="display: none;">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <div id="modal-details"></div>
    </div>
  </div>
</div>
@endsection
