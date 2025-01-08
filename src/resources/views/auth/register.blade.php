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
      <input type="text" id="name" name="name" value="{{ old('name') }}" class="form__input @error('name') form__input--error @enderror" placeholder="例: 山田 太郎" aria-describedby="name-error">
      @error('name')
      <div id="name-error" class="form__error" role="alert">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__group">
      <label for="email" class="form__label">メールアドレス</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" class="form__input @error('email') form__input--error @enderror" placeholder="例: test@example.com" aria-describedby="email-error">
      @error('email')
      <div id="email-error" class="form__error" role="alert">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__group">
      <label for="password" class="form__label">パスワード</label>
      <input type="password" id="password" name="password" class="form__input @error('password') form__input--error @enderror" placeholder="例: coachtech1106" aria-describedby="password-error">
      @error('password')
      <div id="password-error" class="form__error" role="alert">{{ $message }}</div>
      @enderror
    </div>

    <div class="form__button">
      <button type="submit" class="button--primary">登録</button>
    </div>
  </form>
</div>
@endsection
