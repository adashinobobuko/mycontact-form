@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
  <div class="login-form__heading">
    <h2>Login</h2>
  </div>
  <form class="form" action="{{ route('login.submit') }}" method="post">
    @csrf
    <div class="form__group">
      <label for="email" class="form__label--item">メールアドレス</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" class="form__input--text" placeholder="例: test@example.com">
      @error('email')
      <div class="form__error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__group">
      <label for="password" class="form__label--item">パスワード</label>
      <input type="password" id="password" name="password" class="form__input--text" placeholder="例: coachtech1106">
      @error('password')
      <div class="form__error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__button">
      <button type="submit" class="form__button-submit">ログイン</button>
    </div>
  </form>
</div>
@endsection
