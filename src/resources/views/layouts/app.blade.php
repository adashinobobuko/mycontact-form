<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>

  <header class="header">
    <div class="header-item">
      <h1>FashionablyLate</h1>
      <nav>
        <ul>
          <li>
            @if (Request::is('register'))
              <!-- 現在が「register」ページの場合 -->
              <a href="{{ route('login') }}">login</a>
            @elseif (Request::is('login'))
              <!-- 現在が「login」ページの場合 -->
              <a href="{{ route('register') }}">register</a>
            @else
              <!-- その他のページ -->
              <a href="{{ route('login') }}">login</a>
            @endif
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>
