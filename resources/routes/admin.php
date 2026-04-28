<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Blog\BlogComment;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\Blog\BlogCommentController;
use App\Http\Controllers\Admin\Blog\BlogCategoryController;

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


Route::group(['middleware' => ['role:admin']], function () {

    // Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Settings
    Route::get('/admin/settings', [AdminController::class, 'edit'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'update'])->name('admin.settings.update');
    Route::get('/admin/settings/about', [AdminController::class, 'about'])->name('admin.about');
    Route::post('/admin/settings/about', [AdminController::class, 'about_update'])->name('admin.about.update');
    Route::get('/admin/settings/terms', [AdminController::class, 'terms'])->name('admin.terms');
    Route::post('/admin/settings/terms', [AdminController::class, 'terms_update'])->name('admin.terms.update');
    Route::get('/admin/settings/logos', [AdminController::class, 'logos'])->name('admin.logos');
    Route::post('/admin/settings/logos', [AdminController::class, 'logos_update'])->name('admin.logos.update');

    // Users
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{id}', [AdminController::class, 'user_edit'])->name('admin.user.edit');
    Route::post('/admin/users/{id}', [AdminController::class, 'user_update'])->name('admin.user.update');
    Route::get('/admin/users/destroy/{id}', [AdminController::class, 'user_destroy'])->name('admin.user.destroy');

    // Obituaries
    Route::get('/admin/obituaries', [AdminController::class, 'obituaries'])->name('admin.obituaries');
    Route::get('/admin/obituary/create', [AdminController::class, 'obituary_create'])->name('admin.obituary.create');
    Route::post('/admin/obituary/create', [AdminController::class, 'obituary_store'])->name('admin.obituary.store');
    Route::get('/admin/obituary/edit/{id}', [AdminController::class, 'obituary_edit'])->name('admin.obituary.edit');
    Route::post('/admin/obituary/edit', [AdminController::class, 'obituary_update'])->name('admin.obituary.update');
    Route::get('/admin/obituaries/delete/{id}', [AdminController::class, 'obituary_destroy'])->name('admin.obituary.destroy');
    Route::post('/admin/obituaries/delete-all', [AdminController::class, 'obituary_delete_all'])->name('admin.obituary.destroyall');
    Route::get('/admin/obituary/download/{id}', [AdminController::class, 'downloadPDF'])->name('admin.obituary.download');

    // Categories
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/create', [AdminController::class, 'category_create'])->name('admin.category.create');
    Route::post('/admin/categories/create', [AdminController::class, 'category_store'])->name('admin.category.store');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'category_edit'])->name('admin.category.edit');
    Route::post('/admin/categories/edit', [AdminController::class, 'category_update'])->name('admin.category.update');
    Route::get('/admin/categories/delete/{id}', [AdminController::class, 'category_destroy'])->name('admin.category.destroy');

    // Comments
    Route::get('/admin/comments', [AdminController::class, 'comments'])->name('admin.comments');
    Route::get('/admin/comments/edit/{id}', [AdminController::class, 'comment_edit'])->name('admin.comment.edit');
    Route::post('/admin/comments/edit', [AdminController::class, 'comment_update'])->name('admin.comment.update');
    Route::get('/admin/comments/delete/{id}', [AdminController::class, 'comment_destroy'])->name('admin.comment.destroy');

    // Pages
    Route::get('/admin/pages', [AdminController::class, 'pages'])->name('admin.pages');
    Route::get('/admin/pages/create', [AdminController::class, 'page_create'])->name('admin.page.create');
    Route::post('/admin/pages/create', [AdminController::class, 'page_store'])->name('admin.page.store');
    Route::get('/admin/pages/edit/{id}', [AdminController::class, 'page_edit'])->name('admin.page.edit');
    Route::post('/admin/pages/edit', [AdminController::class, 'page_update'])->name('admin.page.update');
    Route::get('/admin/pages/delete/{id}', [AdminController::class, 'page_destroy'])->name('admin.page.destroy');

    // Change Status
    Route::post('/admin/change/status', [AdminController::class, 'change_status'])->name('admin.change.status');

});

Route::group(["middleware" => ["role:admin"], "prefix" => "admin/blog", "as" => "admin.blog."], function () {
    // Posts
    Route::get('posts', [PostController::class, 'index'])->name("posts");
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('posts/delete/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Categories
    Route::get('categories', [BlogCategoryController::class, 'index'])->name('categories');
    Route::get('categories/create', [BlogCategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [BlogCategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/edit/{category}', [BlogCategoryController::class, 'edit'])->name('categories.edit');
    Route::post('categories/update/{category}', [BlogCategoryController::class, 'update'])->name('categories.update');
    Route::get('categories/delete/{category}', [BlogCategoryController::class, 'destroy'])->name('categories.destroy');

    // Comments
    Route::get('comments', [BlogCommentController::class, 'index'])->name('comments');
    Route::get('comments/edit/{comment}', [BlogCommentController::class, 'edit'])->name('comments.edit');
    Route::post('comments/update/{comment}', [BlogCommentController::class, 'update'])->name('comments.update');
    Route::get('comments/delete/{comment}', [BlogCommentController::class, 'destroy'])->name('comments.destroy');

});
