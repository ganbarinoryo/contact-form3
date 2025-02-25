<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    public function confirm(Request $request)
    {
        $contact = session('contact');

        // セッションにデータがない場合は入力画面へリダイレクト
        if (!$contact) {
            return redirect()->route('contact.create');
        }

        return view('confirm', compact('contact'));
    }

}
