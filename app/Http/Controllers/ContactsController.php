<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactsSendmail;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'email' => 'required|email',
            'body' => 'required',
        ]);

        $inputs = $request->all();

        return view('contact.confirm', compact('inputs'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        //actionの値を取得
        $action = $request->input('action');

        //action以外の値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if ($action !== 'submit') {
            //修正ボタンが押された時
            return redirect()
                ->route('contact.index')
                ->withInput($inputs);
        } else {
            //メール送信処理
            \Mail::to($inputs['email'])
                ->send(new ContactsSendmail($inputs));
            \Mail::to(config('mail.from.address'))
                ->send(new ContactsSendmail($inputs));
            //二重送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
            //送信完了ページへのリダイレクト
            return redirect()->route('contact.thanks');
        }
    }
}
