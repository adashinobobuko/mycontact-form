@extends('layouts.app')

@section('content')
<h1>Confirm</h1>

<p>以下の内容でよろしいですか？</p>
<ul>
    <li>姓: {{ $validated['last_name'] }}</li>
    <li>名: {{ $validated['first_name'] }}</li>
    <li>性別: {{ $validated['gender'] === 'male' ? '男性' : '女性' }}</li>
    <li>お問い合わせの種類: {{ $validated['type'] }}</li>
    <li>お問い合わせ内容: {{ $validated['message'] }}</li>
</ul>

<form action="#" method="post">
    @csrf
    <button type="submit">送信する</button>
</form>
<a href="{{ url()->previous() }}">戻る</a>
@endsection
