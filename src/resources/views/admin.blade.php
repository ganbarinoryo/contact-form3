<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
</head>
<body>
  <header>
    <div class="header-container">
      <h1 class="site-title">FashionablyLate</h1>
      <a href="/register" class="register-button">logout</a>
    </div>
  </header>

  <main>
    <!-- 検索フォーム -->
    <section class="search-section">
      <h2>Admin</h2>
      <form action="{{ route('admin.search') }}" method="GET">
        <div class="search-container">
          <input type="text" name="search" placeholder="名前やメールアドレスを入力してください" class="search-input" value="{{ request('search') }}">
          <select name="gender" class="search_gender-select">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
          </select>
          <select name="order" class="search_order-select">
            <option value="">お問い合わせの種類</option>
            <option value="1" {{ request('order') == '1' ? 'selected' : '' }}>商品の交換について</option>
            <option value="2" {{ request('order') == '2' ? 'selected' : '' }}>返品</option>
            <option value="3" {{ request('order') == '3' ? 'selected' : '' }}>その他</option>
          </select>
          <input type="date" name="date" class="search-date" value="{{ request('date') ?? date('Y-m-d') }}">
          <button type="submit" class="search-button">検索</button>
          <button type="reset" class="reset-button">リセット</button>
        </div>
      </form>
    </section>


    <section class="export-section">
      <button class="export-button">エクスポート</button>
      <!-- ページネーション -->
      <div class="pagination">
          {{ $contacts->links('vendor.pagination.bootstrap-4') }}
      </div>
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
          @foreach ($contacts as $contact)
          <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>{{ $contact->gender }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '' }}</td>
            <td>
              <button class="detail-button"
              data-id="{{ $contact->id }}"
              data-last-name="{{ $contact->last_name }}"
              data-first-name="{{ $contact->first_name }}"
              data-gender="{{ $contact->gender }}"
              data-email="{{ $contact->email }}"
              data-tel="{{ $contact->tel }}"
              data-address="{{ $contact->address }}"
              data-building="{{ $contact->building }}"
              data-content="{{ $contact->category->content ?? '' }}"
              data-detail="{{ $contact->detail }}"
              >
                詳細
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- モーダルウィンドウ用の HTML -->
      <div id="detailModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <div class="confirm-table" id="modalTable">
            <!-- 詳細テーブルが動的に挿入される -->
          </div>
          <!-- 削除ボタン -->
          <button id="deleteButton" class="delete-button">
      削除
    </button>
        </div>
      </div>

    </section>
  </main>

  <!--モーダルウィンドウ用-->

<script>
document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('detailModal');
  var modalTable = document.getElementById('modalTable');
  var closeBtn = document.querySelector('.modal .close');
  var deleteButton = document.getElementById('deleteButton');
  var currentContactId = null; // 現在表示中の問い合わせIDを保持

  // 各詳細ボタンにクリックイベントを設定
  document.querySelectorAll('.detail-button').forEach(function(button) {
    button.addEventListener('click', function() {
      currentContactId = this.getAttribute('data-id');
      var lastName = this.getAttribute('data-last-name');
      var firstName = this.getAttribute('data-first-name');
      var gender = this.getAttribute('data-gender'); // 既に「男性」「女性」「その他」
      var email = this.getAttribute('data-email');
      var tel = this.getAttribute('data-tel');
      var address = this.getAttribute('data-address');
      var building = this.getAttribute('data-building') || '';
      var content = this.getAttribute('data-content');
      var detail = this.getAttribute('data-detail');

      // モーダル内のテーブルの HTML を構築
      var html = '<table>';
      html += '<tr><th>お名前</th><td>' + lastName + ' ' + firstName + '</td></tr>';
      html += '<tr><th>性別</th><td>' + gender + '</td></tr>';
      html += '<tr><th>メールアドレス</th><td>' + email + '</td></tr>';
      html += '<tr><th>電話番号</th><td>' + tel + '</td></tr>';
      html += '<tr><th>住所</th><td>' + address + '</td></tr>';
      html += '<tr><th>建物名</th><td>' + building + '</td></tr>';
      html += '<tr><th>お問い合わせの種類</th><td>' + content + '</td></tr>';
      html += '<tr><th>お問い合わせ内容</th><td>' + detail + '</td></tr>';
      html += '</table>';

      modalTable.innerHTML = html;
      modal.style.display = 'block';
    });
  });

  // 削除ボタンのクリックイベント
  deleteButton.addEventListener('click', function() {
    if (!currentContactId) {
      alert("問い合わせIDが取得できませんでした。");
      return;
    }
    if (confirm("本当に削除しますか？")) {
      fetch('/contact/' + currentContactId, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Content-Type': 'application/json'
        }
      }).then(function(response) {
        if (response.ok) {
          alert("削除しました。");
          modal.style.display = 'none';
          // 一覧から削除した行も削除する（任意）
          var row = document.querySelector('[data-row-id="' + currentContactId + '"]');
          if (row) { row.remove(); }
        } else {
          alert("削除に失敗しました。");
        }
      }).catch(function(error) {
        console.error('Error:', error);
      });
    }
  });

  // モーダルの閉じるボタンの処理
  closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  // モーダル外をクリックしたら閉じる処理
  window.addEventListener('click', function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  });
});

  document.addEventListener('DOMContentLoaded', function() {
    var resetButton = document.querySelector('.reset-button');
    var searchForm = document.getElementById('searchForm');
    
    resetButton.addEventListener('click', function(event) {
      // フォームのすべての input, select 要素を空にする
      searchForm.querySelectorAll('input[type="text"], input[type="date"]').forEach(function(input) {
        input.value = '';
      });
      searchForm.querySelectorAll('select').forEach(function(select) {
        select.selectedIndex = 0;
      });
    });
  });

</script>

</body>
</html>
