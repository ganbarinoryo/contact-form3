<!--confirm.blade.php-->
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
            <!-- first_name, last_name を連結 -->
            <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
          </tr>
          <tr>
            <th>性別</th>
            <td>
              @if($contact['gender'] == 1)
                男性
              @elseif($contact['gender'] == 2)
                女性
              @else
                その他
              @endif
            </td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td>{{ $contact['email'] }}</td>
          </tr>
          <tr>
            <th>電話番号</th>
            <!-- 電話番号は3つのフィールドを連結 -->
            <td>{{ $contact['phone1'] }}-{{ $contact['phone2'] }}-{{ $contact['phone3'] }}</td>
          </tr>
          <tr>
            <th>住所</th>
            <td>{{ $contact['address'] }}</td>
          </tr>
          <tr>
            <th>建物名</th>
            <td>{{ $contact['building'] ?? '' }}</td>
          </tr>
          <tr>
            <th>お問い合わせの種類</th>
            <td>
              @if($contact['content'] == 1)
                商品の交換について
              @endif
            </td>
          </tr>
          <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $contact['detail'] }}</td>
          </tr>
        </table>
      </div>
      <div class="button-group">
        <!-- 送信ボタンは最終確定時にPOSTするなど実装 -->
        <form action="{{ route('contact.send') }}" method="POST">
          @csrf
          <button type="submit" class="submit-button">送信</button>
        </form>
        <a class="back-button" href="{{ route('contact.edit') }}">修正</a>
      </div>
    </section>
  </main>
</body>
</html>