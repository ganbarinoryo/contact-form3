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
    <form action="{{ route('contact.store') }}" method="POST" novalidate>
      @csrf
      
      <div class="form-group">
        <label for="last-name">お名前<span>※</span></label>
        <div>
          <input class="first_name" type="text" id="last-name" name="last_name" placeholder="例: 山田" required value="{{ old('last_name') }}">
          @error('last_name')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <div>
          <input class="last_name" type="text" id="first-name" name="first_name" placeholder="例: 太郎" required value="{{ old('first_name') }}">
          @error('first_name')
            <div class="first_name_error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label>性別<span>※</span></label>
        <div class="radio-button">
          <input type="radio" id="male" name="gender" value="1" checked>
          <label for="male">男性</label>
          <input type="radio" id="female" name="gender" value="2">
          <label for="female">女性</label>
          <input type="radio" id="other" name="gender" value="3">
          <label for="other">その他</label>
        </div>
        @error('gender')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">メールアドレス<span>※</span></label>
        <div>
          <input class="email" type="email" id="email" name="email" placeholder="例: test@example.com" required value="{{ old('email') }}">
          @error('email')
            <div class="email_error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
          <label for="phone1">電話番号<span>※</span></label>
          <div>
              <div class="phone inika-font">
                  <input type="tel" id="phone1" name="phone1" inputmode="numeric" pattern="\d{3}" maxlength="3" size="3" placeholder="080" required value="{{ old('phone1') }}"> -
                  <input type="tel" id="phone2" name="phone2" inputmode="numeric" pattern="\d{4}" maxlength="4" size="4" placeholder="1234" required value="{{ old('phone2') }}"> -
                  <input type="tel" id="phone3" name="phone3" inputmode="numeric" pattern="\d{4}" maxlength="4" size="4" placeholder="5678" required value="{{ old('phone3') }}">
              </div>
              @if ($errors->hasAny(['phone1', 'phone2', 'phone3']))
                  <div class="error">
                      {!! implode('<br>', array_merge($errors->get('phone1'), $errors->get('phone2'), $errors->get('phone3'))) !!}
                  </div>
              @endif
          </div>
      </div>



      <div class="form-group">
        <label for="address">住所<span>※</span></label>
        <div>
          <input class="address" type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" required value="{{ old('address') }}">
          @error('address')
            <div class="address_error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="building">建物名</label>
        <div>
          <input class="building" type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
          @error('building')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="content">お問い合わせの種類<span>※</span></label>
        <div>
          <select id="content" name="content" class="custom-select" required>
            <option value="">選択してください</option>
            <option value="1" {{ old('content') == '1' ? 'selected' : '' }}>商品の交換について</option>
          </select>
          @error('content')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label for="detail">お問い合わせ内容<span>※</span></label>
        <div>
          <textarea id="detail" name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください" required>{{ old('detail') }}</textarea>
          @error('detail')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
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