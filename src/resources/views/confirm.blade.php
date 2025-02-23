<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>
<body>
    <header>
    <div class="header-container">
      <h1 class="site-title">FashionablyLate</h1>
    </div>
  </header>

  <main>
    <section class="confirm-section">
      <h2>Confirm</h2>
      <div class="confirm-table">
        <table>
          <tr>
            <th>お名前</th>
            <td>山田 太郎</td>
          </tr>
          <tr>
            <th>性別</th>
            <td></td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td></td>
          </tr>
          <tr>
            <th>電話番号</th>
            <td></td>
          </tr>
          <tr>
            <th>住所</th>
            <td></td>
          </tr>
          <tr>
            <th>建物名</th>
            <td></td>
          </tr>
          <tr>
            <th>お問い合わせの種類</th>
            <td></td>
          </tr>
          <tr>
            <th>お問い合わせ内容</th>
            <td></td>
          </tr>
        </table>
      </div>
      <div class="button-group">
        <button type="submit" class="submit-button">送信</button>
        <a class="back-button" href="">修正</a></button>
      </div>
    </section>
  </main>

</body>
</html>