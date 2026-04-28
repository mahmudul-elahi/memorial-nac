<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\ChatController;

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

/**
 * [DEV] Création d'une route pour command.php
 * command.php permet de supprimer un dossier et de dézipper un ZIP
 * Permet d'exécuter des commandes sans SSH
 */
Route::match(['get', 'post'], '/command/{secret}', function ($secret) {
    if ($secret !== env('COMMAND_SECRET')) {
        abort(403, 'Unauthorized action.');
    }
    require_once '../command.php';
});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/page/{id}/{slug}', [PageController::class, 'show'])->name('page.show');

// Theme (Light/Dark)
Route::post('/themes', function (Request $request) {
    $request->validate([
        'theme' => ['required']
    ]);

    $time = "43200";

    Cookie::queue('theme', $request->theme, $time);
    return back();
})->name('themes.update');

// Dir (RTL/LTR)
Route::post('/dir', function (Request $request) {
    $request->validate([
        'dir' => ['required']
    ]);

    $time = "43200";

    Cookie::queue('dir', $request->dir, $time);
    return back();
})->name('dir.update');

// Item
Route::get('/show/{id}/{slug}', [ItemController::class, 'show'])->name('show.obituary');

// Blog Posts
Route::get('blog/posts', [BlogController::class, 'index'])->name('blog.posts.view');
Route::get('blog/posts/{post:slug}', [BlogController::class, 'show'])->name('blog.posts.show');
Route::get('blog/categories/{category:slug}', [BlogController::class, 'show_category'])->name('blog.categories.show');

// Insert
Route::get('/insert', [InsertController::class, 'index'])->name('insert.obituary');
Route::post('/insert', [InsertController::class, 'store'])->name('store.obituary');

Route::group(['middleware' => ['auth']], function () {

    // Condolence
    Route::post('/save-condolence/{item_id}', [HomeController::class, 'save_condolence'])->name('store.condolence');

    // Comment
    Route::post('/comments/{item_id}', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');
    // Blog Comment
    Route::post('blog/comments/{post:slug}', [BlogController::class, 'store_comment'])->name('blog.comments.store');
    Route::post('blog/comments/destroy/{comment}', [BlogController::class, 'destroy_comment'])->name('blog.comments.destroy');

    // Friendship
    Route::post('/friendship/send/{user}', [FriendshipController::class, 'send'])->name('friendship.send');
    Route::post('/friendship/accept/{friendship}', [FriendshipController::class, 'accept'])->name('friendship.accept');
    Route::post('/friendship/decline/{friendship}', [FriendshipController::class, 'decline'])->name('friendship.decline');
    Route::post('/friendship/cancel/{friendship}', [FriendshipController::class, 'cancel'])->name('friendship.cancel');
    Route::get('/friends', [FriendshipController::class, 'friends'])->name('friendship.friends');
    Route::get('/friend-requests', [FriendshipController::class, 'requests'])->name('friendship.requests');

    // Chat
    Route::get('/conversations', [ChatController::class, 'conversationsPage'])->name('chat.conversations.page');
    Route::get('/chat/conversations/list', [ChatController::class, 'conversations'])->name('chat.conversations');
    Route::get('/chat/unread/count', [ChatController::class, 'unread'])->name('chat.unread');
    Route::get('/chat/{user}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{user}', [ChatController::class, 'store'])->name('chat.store');
});

// Categorie
Route::get('/category/{id}/{slug}', [CategoryController::class, 'index'])->name('category');

// Search
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

require __DIR__ . '/social.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
