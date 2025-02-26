<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    // 入力画面表示（contact.blade.php）
    public function create()
    {
        // セッションにデータがある場合は編集用として渡す
        $contact = session('contact');
        return view('contact', compact('contact'));
    }

    // 入力内容を受け取り、確認画面へ遷移
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string|max:50',
            'last_name'   => 'required|string|max:50',
            'gender'      => 'required|in:1,2,3',
            'email'       => 'required|email',
            'phone1'      => 'required|digits:3',
            'phone2'      => 'required|digits:4',
            'phone3'      => 'required|digits:4',
            'address'     => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
            'content'     => 'required|in:1', // content をカテゴリー情報として利用
            'detail'      => 'required|string',
            'category_id' => 'nullable|integer', // 後で設定するので nullable にしておく
        ]);

        // DB保存ではなく、確認画面用にセッションに保存
        session(['contact' => $validated]);

        return redirect()->route('confirm');
    }

    // 送信処理：セッションのデータをDBに保存し、thanks画面へ遷移
    public function send(Request $request)
    {
        $contactData = session('contact');

        // セッションにデータがなければ入力画面へ戻す
        if (!$contactData) {
            return redirect()->route('contact.create');
        }

        // カテゴリーIDを取得し、存在しなければ作成
        $category = Category::firstOrCreate(
            ['id' => $contactData['content']], // content の値を id として利用
            ['content' => '商品の交換について']  // 存在しなければ指定の値で作成
        );
        $contactData['category_id'] = $category->id;

        // phone1, phone2, phone3 を連結して tel を生成
        $contactData['tel'] = $contactData['phone1'] . '-' . $contactData['phone2'] . '-' . $contactData['phone3'];

        // 不要なフィールド（個別の電話番号フィールド）があれば削除する
        unset($contactData['phone1'], $contactData['phone2'], $contactData['phone3']);

        // Contactモデル経由でDBにレコードを作成
        Contact::create($contactData);

        // セッションのデータをクリア
        $request->session()->forget('contact');

        // 完了画面へリダイレクト
        return redirect()->route('thanks');
    }

    // 修正用：入力画面に戻り、セッションのデータを編集できるようにする
    public function edit()
    {
        $contact = session('contact');
        if (!$contact) {
            return redirect()->route('contact.create');
        }
        return view('contact', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}