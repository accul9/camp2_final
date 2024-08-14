<?php

use App\Models\Item;
use App\Models\Set;
use App\Models\Recipe;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\LifeCycleTestController;
use App\Http\Controllers\ComponentTestController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\StripeWebhookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//トップページ
Route::get('/', function () {
    return view('welcome');
})->name('index');

//Dashboardページ
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('sets.index');

//Setsの一覧表示
Route::get('/sets', [SetController::class, 'index'])->name('sets.index');

//Setの個別表示（レシピ一覧）
Route::get('/sets/{set}', [SetController::class, 'show'])->name('sets.show');

//Recipe個別表示
Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

//Itemの一覧表示

Route::get('/items', [ItemController::class, 'index'])->name('items.index');

//Itemの詳細表示
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

//Categoryの個別表示
Route::get('/categories/{category_id}', 'App\Http\Controllers\CategoryController@show')->name('categories.show');

//レシピの使用食材の一覧表示
Route::get('/recipes/{recipe_id}/items', [RecipeController::class, 'items'])->name('recipes.items');


//ログイン後のユーザーのみのページ
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sets', [SetController::class, 'index'])->name('sets.index');
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
});

//マイページを編集する
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

//ログイン後Itemの一覧を表示
/* Route::middleware('auth:users')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('items.index');
    Route::get('show/{item}', [ItemController::class, 'show'])->name('items.show');
}); */

//カート機能
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/delete/', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/success', [CartController::class, 'success'])->name('cart.success');
Route::get('/cart/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
//Route::get('/cancel', [CartController::class, 'cancel'])->name('cart.cancel');
Route::get('cancel', [CartController::class, 'cancel'])->name('cart.cancel');
Route::get('payment_completed', [CartController::class, 'paymentCompleted'])->name('cart.payment_completed');

Route::get('/component-test1', [ComponentTestController::class, 'showComponent1']);
Route::get('/component-test2', [ComponentTestController::class, 'showComponent2']);
Route::get('/servicecontainertest', [LifeCycleTestController::class, 'showServiceContainerTest']);
Route::get('/serviceprovidertest', [LifeCycleTestController::class, 'showServiceProviderTest']);

//購入履歴一覧機能
Route::post('/orders/create', [OrderController::class, 'createOrder'])->name('orders.create')->middleware('auth');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');


//メール機能
//入力フォームページ
Route::get('/contact', [ContactsController::class, 'index'])->name('contact.index');
//確認フォームページ
Route::post('/contact/confirm', [ContactsController::class, 'confirm'])->name('contact.confirm');
//送信完了ページ
Route::post('/contact/thanks', [ContactsController::class, 'send'])->name('contact.send');;

Route::get('/contact/thanks', function () {
    return view('contact.thanks');
})->name('contact.thanks');

//Stripeのテスト
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
//Route::post('/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::post('/webhook', [WebhookController::class, 'handle']);

Route::post('/webhook', function () {
    return view('webhook.index');
})->name('webhook.index');





require __DIR__ . '/auth.php';
