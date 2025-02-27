<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // GET: 登録フォームの表示
    public function showRegister()
    {
        return view('auth.register');
    }

    // POST: 登録処理
    public function register(RegisterRequest $request)
    {
        // バリデーション済みのデータを取得
        $validated = $request->validated();

        // ユーザー登録（パスワードはハッシュ化）
        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // 登録完了後、ログイン画面へリダイレクト
        return redirect()->route('auth.login');
    }

    // GET: ログインフォームの表示
    public function showLogin()
    {
        return view('auth.login');
    }

    // POST: ログイン処理
    public function login(LoginRequest $request)
    {
        // LoginRequest によりバリデーション済みのデータを取得
        $credentials = $request->validated();

        // 認証試行（成功すれば /admin へ）
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // 認証失敗時はエラーメッセージ付きでリダイレクト
        return back()->withErrors([
            'email' => '入力情報が正しくありません。',
        ]);
    }
}
