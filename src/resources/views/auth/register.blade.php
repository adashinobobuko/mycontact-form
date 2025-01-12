@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
  <div class="register-form__heading">
    <h2>Register</h2>
  </div>
  <form class="form" action="/register" method="post">
    @csrf
    <div class="form__group">
      <label for="name" class="form__label">お名前</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" class="form__input" placeholder="例: 山田 太郎">
      @error('name')
      <div class="form__error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__group">
      <label for="email" class="form__label">メールアドレス</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" class="form__input" placeholder="例: test@example.com">
      @error('email')
      <div class="form__error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__group">
      <label for="password" class="form__label">パスワード</label>
      <input type="password" id="password" name="password" class="form__input" placeholder="例: coachtech1106">
      @error('password')
      <div class="form__error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__group">
      <button type="submit" class="button--primary">登録</button>
    </div>
  </form>
</div>
@endsection
