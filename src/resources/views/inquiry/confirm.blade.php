@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<h1>Confirm</h1>

<!-- 入力されたデータの表示 -->
<table>
    <tr>
        <th>お名前</th>
        <td>{{ $data['last_name'] }} {{ $data['first_name'] }}</td>
    </tr>
    <tr>
        <th>性別</th>
        <td>
            @php
                $validated['gender'] = match ($validated['gender']) {
                    'male' => 1,
                    'female' => 2,
                    'other' => 3,
                };
            @endphp

            <p>性別: {{ $genderLabel[$data['gender']] }}</p>
        </td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>{{ $data['email'] }}</td>
    </tr>
    <tr>
        <th>電話番号</th>
        <td>{{ $data['tel1'] }}{{ $data['tel2'] }}{{ $data['tel3'] }}</td>
    </tr>
    <tr>
        <th>住所</th>
        <td>{{ $data['address'] }}</td>
    </tr>
    <tr>
        <th>建物名</th>
        <td>{{ $data['building'] ?? '（未記入）' }}</td>
    </tr>
    <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $data['categories'] }}</td>
    </tr>
    <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $data['message'] }}</td>
    </tr>
</table>

<!-- 修正と送信ボタン -->
<div>
    <a href="/inquiry/edit">修正</a>

    <form id="edit-form" action="/inquiry/edit" method="post" style="display: none;">
        @csrf
    </form>

    <form action="/inquiry/submit" method="post">
        @csrf
        <!-- データをhiddenで送信 -->
        <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
        <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
        <input type="hidden" name="gender" value="{{ $data['gender'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="tel1" value="{{ $data['tel1'] }}">
        <input type="hidden" name="tel2" value="{{ $data['tel2'] }}">
        <input type="hidden" name="tel3" value="{{ $data['tel3'] }}">
        <input type="hidden" name="address" value="{{ $data['address'] }}">
        <input type="hidden" name="building" value="{{ $data['building'] }}">
        <input type="hidden" name="type" value="{{ $data['type'] }}">
        <input type="hidden" name="message" value="{{ $data['message'] }}">
        <button type="submit">送信</button>
    </form>
</div>
@endsection
