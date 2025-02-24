<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function store(Request $request)
{
    $request->validate([
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'gender' => 'required|integer',
        'email' => 'required|email',
        'phone1' => 'required|digits:3',
        'phone2' => 'required|digits:4',
        'phone3' => 'required|digits:4',
        'address' => 'required|string',
        'building' => 'nullable|string',
        'content' => 'required|integer|min:1',
        'detail' => 'required|string',
    ]);

    $tel = "{$request->phone1}-{$request->phone2}-{$request->phone3}";

    $gender_code = $request->input('gender');

    // カテゴリーIDを取得し、存在しなければ作成
    $category = Category::firstOrCreate(['id' => $request->input('content')], [
        'content' => '商品の交換について'
    ]);

    $category_id = $category->id;

    Contact::create([
        'last_name' => $request->last_name,
        'first_name' => $request->first_name,
        'gender' => $gender_code,
        'email' => $request->email,
        'tel' => $tel,
        'address' => $request->address,
        'building' => $request->building,
        'category_id' => $category_id,
        'detail' => $request->detail,
    ]);

    return redirect()->back();
}



}
