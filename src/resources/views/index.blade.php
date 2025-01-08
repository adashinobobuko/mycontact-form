@extends('layouts.app')

@section('content')
<h1>お問い合わせフォーム</h1>

<form action="{{ route('inquiry.confirm') }}" method="post">
    @csrf

    <!-- お名前 -->
    <div>
        <label for="last_name">姓:</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
        @error('last_name')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="first_name">名:</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
        @error('first_name')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <!-- 性別 -->
    <div>
        <label>性別:</label>
        <input type="radio" id="male" name="gender" value="male" {{ old('gender', 'male') === 'male' ? 'checked' : '' }}>
        <label for="male">男性</label>
        <input type="radio" id="female" name="gender" value="female" {{ old('gender') === 'female' ? 'checked' : '' }}>
        <label for="female">女性</label>
        <input type="radio" id="other" name="gender" value="other" {{ old('gender') === 'other' ? 'checked' : '' }}>
        <label for="other">その他</label>
        @error('gender')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <!-- メールアドレス -->
    <div>
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <!-- 電話番号 -->
    <div>
        <label for="tel1">電話番号:</label>
        <input type="text" id="tel1" name="tel1" value="{{ old('tel1') }}" placeholder="例: 090" maxlength="4">
        -
        <input type="text" id="tel2" name="tel2" value="{{ old('tel2') }}" placeholder="例: 1234" maxlength="4">
        -
        <input type="text" id="tel3" name="tel3" value="{{ old('tel3') }}" placeholder="例: 5678" maxlength="4">
        @error('tel1') <p class="error">{{ $message }}</p> @enderror
        @error('tel2') <p class="error">{{ $message }}</p> @enderror
        @error('tel3') <p class="error">{{ $message }}</p> @enderror
    </div>

    <!-- 住所 -->
    <div>
        <label for="address">住所:</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="例: 東京都新宿区">
        @error('address')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <!-- 建物名 -->
    <div>
        <label for="building">建物名:</label>
        <input type="text" id="building" name="building" value="{{ old('building') }}" placeholder="例: コーチテックビル 101">
        @error('building')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <!-- お問い合わせの種類 -->
    <div>
        <label for="type">お問い合わせの種類:</label>
        <select id="type" name="type">
            <!--仮、のちにシーディング-->
            <option value="default" {{ old('type') === 'default' ? 'selected' : '' }}>選択してください</option>
            <option value="general" {{ old('type') === 'general' ? 'selected' : '' }}>一般</option>
            <option value="support" {{ old('type') === 'support' ? 'selected' : '' }}>サポート</option>
            <option value="feedback" {{ old('type') === 'feedback' ? 'selected' : '' }}>フィードバック</option>
        </select>
        @error('type')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <!-- お問い合わせ内容 -->
    <div>
        <label for="message">お問い合わせ内容:</label>
        <textarea id="message" name="message" rows="4" placeholder="お問い合わせ内容を入力してください">{{ old('message') }}</textarea>
        @error('message')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <!-- 確認画面ボタン -->
    <div>
        <button type="submit">確認画面</button>
    </div>
</form>
@endsection
