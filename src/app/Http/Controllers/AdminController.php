<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        // 名前またはメールアドレスの検索など、$request を利用する処理が正しく動作します。
        $query = Contact::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('order')) {
            $query->where('content', $request->input('order'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->paginate(7);

        return view('admin', compact('contacts'))->with('request', $request);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function export()
    {
        $contacts = Contact::with('category')->get(); // カテゴリ情報を含めて取得

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // CSVのヘッダー
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせ内容']);

            // CSVのデータ
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                    $contact->email,
                    $contact->category->content ?? ''
                ]);
            }

            fclose($handle);
        });

        // CSVのレスポンスヘッダー
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }


}
