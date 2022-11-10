<?php

use App\Models\User;
use App\Models\UserPageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\UserPageController;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\UserSettingsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('is_admin')->group( function () {

    Route::get('/admin-panel', [AdminPanelController::class, 'view_users']);

    Route::get('/change-user/{id}', [AdminPanelController::class, 'store']);

    Route::post('/change-user-info/{id}', [AdminPanelController::class, 'change']);

    Route::get('/delete-user/{id}', [AdminPanelController::class, 'delete']);

    Route::post('/create-user', [AdminPanelController::class, 'create']);
});

Route::middleware('auth')->group( function () {

    Route::get('/user-settings', [UserSettingsController::class, 'view']);

    Route::post('/change-user-info', [UserSettingsController::class, 'update']);

    Route::post('/delete-user', [UserSettingsController::class, 'delete']);

    Route::get('/change-password', [UserSettingsController::class, 'change_password_view']);

    Route::post('/change-password', [UserSettingsController::class, 'change_password']);

    Route::get('/user-pages', [UserPageController::class, 'user_pages_view']);


    Route::get('/create-page', function () {
        return view('/create_page');
    });

    Route::post('/create-page', [UserPageController::class, 'user_create_page']);

    Route::post('/delete-page', [UserPageController::class, 'delete_page']);

    Route::post('/edit-page', [UserPageController::class, 'edit_page']);

    Route::get('/edit-page/{page_id}', function ($page_id) {
        $page = UserPageModel::find($page_id);
        $author = User::find($page->customer_id);
        return view('/edit-page', [
            'author' => $author,
            'page' => $page,
        ]);
    });

    Route::post('/search', function (Request $request) {
        if (!empty($request['search']))
        {
            $pages = UserPageModel::where('title', 'like', '%'.$request->search.'%')->orWhere('description', 'like', '%'.$request->search.'%')->simplePaginate(10);
        }
        return view('browse_pages', [
            'pages' => $pages,
        ]);
    });
});

Route::get('/page/{page_id}', [UserPageController::class, 'single_page_view']);


Route::get('/browse-pages', function () {
    $pages = DB::table('user_page_models')->simplePaginate(10);
    return view('browse_pages', [
        'pages' => $pages,
    ]);
});
