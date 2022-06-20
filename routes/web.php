<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::group([
    'as' => 'blog.',
    'prefix' => 'news'
], function () {
    // Новости
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('index');
    Route::get('/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('show');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::group([
    'as' => 'products.',
    'prefix' => 'store'
], function () {
    // Товары
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('list');
    Route::get('{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show');
});

// Комментарии к новостям
Route::post('/comment/store', [\App\Http\Controllers\User\CommentController::class, 'store'])->middleware('auth')->name('comment.add');
Route::post('/reply/store', [\App\Http\Controllers\User\CommentController::class, 'replyStore'])->middleware('auth')->name('reply.add');


// Отзывы к товару
Route::post('/review/store', [\App\Http\Controllers\User\ReviewController::class, 'store'])->middleware('auth')->name('review.add');

Route::group([
    'as' => 'orders.',
    'prefix' => 'orders'
], function () {
    // Новости
    Route::get('/', [\App\Http\Controllers\User\OrderController::class, 'index'])->name('index');
    Route::get('/{order}', [\App\Http\Controllers\User\OrderController::class, 'show'])->name('show');
});


Route::group([
    'as' => 'cart.',
], function () {
    Route::get('cart', [\App\Http\Controllers\CartController::class, 'cartList'])->name('list');
    Route::post('cart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('store');
    Route::post('update-cart', [\App\Http\Controllers\CartController::class, 'updateCart'])->name('update');
    Route::post('remove', [\App\Http\Controllers\CartController::class, 'removeCart'])->name('remove');
    Route::post('clear', [\App\Http\Controllers\CartController::class, 'clearAllCart'])->name('clear');
    Route::post('cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout')->middleware(['auth', 'verified']);
    Route::post('cart/saveorder', [\App\Http\Controllers\CartController::class, 'saveorder'])->name('saveorder')->middleware(['auth', 'verified']);
    Route::get('cart/success', [\App\Http\Controllers\CartController::class, 'success'])
        ->name('success')->middleware(['auth', 'verified']);
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');

    Route::resource('/roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::post('/roles/{role}/permissions', [\App\Http\Controllers\Admin\RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [\App\Http\Controllers\Admin\RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

    Route::resource('/permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::post('/permissions/{permission}/roles', [\App\Http\Controllers\Admin\PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [\App\Http\Controllers\Admin\PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

    Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('/users/{user}/roles', [\App\Http\Controllers\Admin\UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [\App\Http\Controllers\Admin\UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [\App\Http\Controllers\Admin\UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [\App\Http\Controllers\Admin\UserController::class, 'revokePermission'])->name('users.permissions.revoke');

    Route::resource('/posts', \App\Http\Controllers\PostController::class);
    Route::get('/posts', [\App\Http\Controllers\PostController::class, 'admin'])->name('news.index');

    Route::resource('/products', \App\Http\Controllers\ProductController::class);
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'admin'])->name('products.index');

    Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
});


require __DIR__ . '/auth.php';
