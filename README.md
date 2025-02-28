# お問い合わせフォーム

![お問い合わせフォーム](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/contact.png?raw=true)

## 機能

このお問い合わせフォームには以下の主な機能があります：

- **会員登録**
  ![会員登録](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/register.png)

  "localhost/auth/register"で開きます。
  お名前・メールアドレス・パスワードを入力し、登録ボタンを押すことで users テーブルにデータを作成できます。データが無事作成された場合、ログイン画面（/login）に遷移します。

- **ログイン**
  ![ログイン](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/login.png)

  メールアドレスとパスワードを入力しログインに成功した場合、管理画面（/Admin）に遷移します。登録ページのヘッダー右上にある login ボタンを押した場合もこのページに遷移できます。

- **管理画面**
  ![管理画面](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/admin.png)

  ログイン画面からログインに成功した場合に遷移します。お名前・性別・お問い合わせの種類・生年月日のいずれかの情報を入力することで Contacts テーブルに保存されているお問い合わせ情報を検索できます。

- **管理画面日付検索**
  ![管理画面](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/admin_month.png)

  年月日検索フォームでは、矢印ボタンを押すとカレンダーが表示されます。日付等を選択することで自分の探しているお問い合わせデータを検索できます。

- **管理画面モーダルウィンドウ**
  ![管理画面モーダルウィンドウ](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/admin_modal.png)

  お問い合わせテーブルの詳細ボタンをクリックすると、モーダルウィンドウでお問い合わせ内容が表示されます。お問い合わせ内容を確認後にモーダルウィンドウ下部にある削除ボタンを押すと、表示されているお問い合わせデータをデータテーブルから削除できます。

- **お問い合わせフォームの入力画面（ルートページ）**
  ![お問い合わせフォームの入力画面](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/contact.png)

  お問い合わせ内容を入力する画面です。お名前・性別・メールアドレス・電話番号・住所・お問い合わせの種類・お問い合わせの内容が必須の入力事項に設定されています。入力終了後に確認画面ボタンを押すと、確認画面（/confirm）に遷移します。

- **お問い合わせフォームの確認画面**
  ![お問い合わせフォームの確認画面](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/confirm.png)

  お問い合わせフォームで入力した項目を確認するためのページです。修正ボタンを押すとお問い合わせフォームの入力画面に戻り、入力内容を修正できます。送信ボタンを押すと Contacts テーブルと Categories テーブルに各データが作成され、サンクスページ（/thanks）に遷移します。

- **サンクスページ**
  ![サンクスページ](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/thanks.png)

  確認画面で送信ボタンを押してお問い合わせデータが無事に送信された場合に遷移します。HOME ボタンを押すとお問い合わせフォームの入力画面に遷移します。

## 環境

このプロジェクトは以下の環境で動作します：

- **作業 OS**: MacOS Ventura 13.7.2
- **PHP バージョン**: 7.4.9
- **Docker 使用**
- **MySQL（Docker 内で設定）**

## ER 図

![ER図](https://github.com/ganbarinoryo/contact-form3/raw/main/src/public/images/ER.png)

## セットアップ方法

### 前提条件

- Docker と Docker Compose がインストールされていること

### 手順

1. リポジトリをクローン

   git clone https://github.com/ganbarinoryo/contact-form3.git

2. 必要なコンテナをビルドして起動

   下記を docker-compose.yml があるディレクトリで実行してください。

   docker-compose down && docker-compose build && docker-compose up -d

3. コンテナが立ち上がったら、Laravel のセットアップを行うために以下のコマンドを実行してください。依存関係をインストールします。

   docker-compose exec app composer install

4. 以下のコマンドを実行して、環境設定ファイル.env を設定します。

   cp .env.example .env

   .env ファイルが作成できたら以下のように設定してください。

   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass

5. 以下のコマンドを実行して APP_KEY を作成する。

   php artisan key:generate

   .env ファイルを開き、APP_KEY が設定されていれば OK です。

6. マイグレーションを実行して、データベースを作成します。

   docker-compose exec app php artisan migrate

7. サーバーを立ち上げ、ブラウザでアクセスします。

   docker-compose exec app php artisan serve

   サイトにアクセスするには、http://localhost:8000 にブラウザでアクセスしてください。
