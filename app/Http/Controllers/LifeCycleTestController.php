<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    //
    public function showServiceProviderTest()
    {
        $encrypt = app()->make('encrypter');
        $password = $encrypt->encrypt('password');

        $sample = app()->make('serviceProviderTest');

        dd($sample, $password, $encrypt->decrypt($password));
    }


    public function showServiceContainerTest()
    {
        // bindメソッドでサービスコンテナに 'lifeCycleTest' を登録
        app()->bind('lifeCycleTest', function () {
            return 'ライフサイクルテスト';
        });

        // makeメソッドで 'lifeCycleTest' を解決し、変数$testに格納
        $test = app()->make('lifeCycleTest');

        // サービスコンテナなしのパターン
        // $message = new Message();
        // $sample = new Sample($message);
        // $sample->run();

        // サービスコンテナを使うパターン
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();
        // 結果を出力
        dd($test, app());
    }
}
class Sample
{
    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    public function run()
    {
        $this->message->send();
    }
}

class Message
{
    public function send()
    {
        echo ('メッセージを表示');
    }
}
