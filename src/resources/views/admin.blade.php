<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
  <header>
    <div class="header-container">
      <h1 class="site-title">FashionablyLate</h1>
      <a href="/register" class="register-button">logout</a>
    </div>
  </header>

  <main>
    <section class="search-section">
      <h2>Admin</h2>
      <div class="search-container">
        <input type="text" placeholder="名前またはメールアドレス" class="search-input">
        <select class="search_gender-select">
          <option value="">性別</option>
          <option value="1">男性</option>
          <option value="2">女性</option>
          <option value="3">その他</option>
        </select>
        <select class="search_order-select">
          <option value="">お問い合わせ種類</option>
          <option value="1">注文</option>
          <option value="2">返品</option>
          <option value="3">その他</option>
        </select>
        <input type="date" class="search-date">
        <button class="search-button">検索</button>
        <button class="reset-button">リセット</button>
      </div>
    </section>

    <section class="export-section">
      <button class="export-button">エクスポート</button>
    </section>

    <section class="table-section">
      <table class="data-table">
        <thead>
          <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせ内容</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>山田 太郎</td>
            <td>男性</td>
            <td>taro@example.com</td>
            <td>注文に関する質問</td>
            <td><button class="detail-button" data-message="注文に関するお問い合わせです。">詳細</button></td>
          </tr>
          <tr>
            <td>佐藤 花子</td>
            <td>女性</td>
            <td>hanako@example.com</td>
            <td>返品について</td>
            <td><button class="detail-button" data-message="返品についてのご相談です。">詳細</button></td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
