<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
  <header>
    <div class="header-container">
      <h1 class="site-title">FashionablyLate</h1>
    </div>
  </header>

<main>
  <section class="contact-section">
    <h2>Contact</h2>
    <form action="/contact" method="POST">
      <div class="form-group">
        <label for="last-name">お名前<span>※</span></label>
        <input class="first_name" type="text" id="last-name" name="last_name" placeholder="例: 山田" required>
        <input class="last_name" type="text" id="first-name" name="first_name" placeholder="例: 太郎" required>
      </div>

      <div class="form-group">
        <label>性別<span>※</span></label>
         <div class="radio-button">
         <input type="radio" id="male" name="gender" value="男性" checked>
         <label for="male">男性</label>
         <input type="radio" id="female" name="gender" value="女性">
         <label for="female">女性</label>
         <input type="radio" id="other" name="gender" value="その他">
         <label for="other">その他</label>
        </div>
      </div>

      <div class="form-group">
        <label for="email">メールアドレス<span>※</span></label>
        <input class="email"type="email" id="email" name="email" placeholder="例: test@example.com" required>
      </div>

      <div class="form-group">
        <label for="phone1">電話番号<span>※</span></label>
        <div class="phone inika-font">
         <input type="text" id="phone1" name="phone1" pattern="\d{3}" maxlength="3" placeholder="080" required> -
         <input type="text" id="phone2" name="phone2" pattern="\d{4}" maxlength="4" placeholder="1234" required> -
         <input type="text" id="phone3" name="phone3" pattern="\d{4}" maxlength="4" placeholder="5678" required>
        </div>
      </div>

      <div class="form-group">
        <label for="address">住所<span>※</span></label>
        <input class="address" type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" required>
      </div>

      <div class="form-group">
        <label for="building">建物名</label>
        <input class="building" type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101">
      </div>

      <div class="form-group">
        <label for="inquiry-type">お問い合わせの種類<span>※</span></label>
        <select id="inquiry-type" name="inquiry_type" class="custom-select" required>
          <option value="">選択してください</option>
          <option value="注文">注文</option>
          <option value="返品">返品</option>
          <option value="その他">その他</option>
        </select>
      </div>

      <div class="form-group">
        <label for="message">お問い合わせ内容<span>※</span></label>
        <textarea id="message" name="message" rows="5" placeholder="お問い合わせ内容をご記載ください" required></textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="confirm-button">確認画面</button>
      </div>
    </form>
  </section>
</main>

<style>
  .custom-select {
    appearance: none;
    background: #fff url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><polygon points="0,0 4,0 2,4" fill="%23BEB1A6"/></svg>') no-repeat right 10px center;
    background-size: 18px;
    padding-right: 35px;
  }
</style>

</body>
</html>