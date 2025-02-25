<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            // バリデーション
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            // ユーザー登録（パスワードはハッシュ化）
            User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            // 登録完了後、ホーム画面にリダイレクト（ルート名は適宜変更）
            return redirect()->route('auth.login');
        }

        // GETの場合は登録フォームを表示
        return view('auth.register');
    }

    public function login(Request $request)
    {
        // POSTの場合はログイン処理を実施
        if ($request->isMethod('post')) {
            // バリデーション
            $credentials = $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

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

        // GETの場合はログインフォームを表示
        return view('auth.login');
    }
}
