<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function admin()
    {
        //contactsテーブルからお問い合わせ情報を取得
        $contacts = Contact::all();

        //ビューに渡す
        return view('admin', compact('contacts'));
    }
}
