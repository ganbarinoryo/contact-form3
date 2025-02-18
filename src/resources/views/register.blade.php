<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <!-- ヘッダー -->
  <header>
    <div class="header-container">
      <h1 class="site-title">FashionablyLate</h1>
      <a href="/login" class="login-button">login</a>
    </div>
  </header>

  <!-- メインコンテンツ -->
  <main>
    <section class="register-section">
      <h2>Register</h2>
      <form action="/register" method="POST">
        <div class="form-group">
          <label for="name">お名前</label>
          <input type="text" id="name" name="name" placeholder="例: 山田 太郎" required>
        </div>
        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="email" id="email" name="email" placeholder="例: test@example.com" required>
        </div>
        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" id="password" name="password" placeholder="例: coachtech1106" required>
        </div>
        <div class="form-group">
          <button type="submit" class="register-button">登録</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
