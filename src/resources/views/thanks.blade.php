@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-container">
    <div class="thanks-message">
        <h1>お問い合わせありがとうございました</h1>
    </div>
    <div class="thanks-button">
        <a href="/" class="home-button">HOME</a>
    </div>
</div>
@endsection
