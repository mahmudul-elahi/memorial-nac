<?php

namespace App\Http\Controllers;

use App\Models\Admin\Blog\BlogCategory;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Admin\Blog\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Blog\BlogComment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Models\PageTitle;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::withCount("comments")
            ->with("category")
            ->whereHas('category', function ($q) {
                $q->where('status', 1);
            })
            ->where('status', 1)
            ->orderByDesc('id')
            ->paginate(6);

        $blogCategories = BlogCategory::where("status", 1)
            ->withCount("posts")
            ->get();

        $pageTitle = PageTitle::where('page_identifier', 'blog')->first();

        return view('frontend.blog.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_description')->value,
            'site_image' => asset('img/logo/logo_big.jpg'),
            'page_name' => Setting::find('app_tagline')->value,
            'posts' => $posts,
            'pageTitle' => $pageTitle,
            'blogCategories' => $blogCategories,
            'totalCategories' => count($blogCategories),
        ]);
    }

    public function show(Post $post)
    {
        $blogCategories = BlogCategory::where("status", 1)
            ->withCount("posts")
            ->get();
        $comments = $post->comments()
            ->where("status", 1)
            ->with("commentedBy")
            ->paginate();

        $pageTitle = PageTitle::where('page_identifier', 'blog')->first();

        return view('frontend.blog.show')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Str::limit($post->description, 155, '...'),
            'site_image' => asset('img/logo/logo_big.jpg'),
            'page_name' => $post->title,
            'post' => $post,
            'blogCategories' => $blogCategories,
            'comments' => $comments,
            'pageTitle' => $pageTitle,
            'totalCategories' => count($blogCategories),
        ]);
    }

    public function store_comment(Request $request, Post $post)
    {
        $new_comments = Setting::find('new_comments')->value;

        $validation = $request->validate([
            'comment' => 'required|string|min:5|max:300'
        ]);

        $create = BlogComment::create([
            'comment' => $request->comment,
            'commented_by' => Auth::id(),
            'post_id' => $post->id,
            'status' => $new_comments
        ]);

        if ($create) {

            if ($new_comments == 1) {
                Alert::success(__('app.your_comment_has_been_posted'));
                return back();
            } else {
                Alert::warning(__('app.comment_must_be_approved'));
                return back();
            }
        } else {
            Alert::error(__('app.error_message'));
            return back();
        }
    }

    public function destroy_comment(Request $request, BlogComment $comment)
    {
        if ($comment->isMyComment()) {
            info("hi");
            $comment->delete();
            alert()->success(__('app.you_successfully_delete_the_comment'));
            return back();
        } else {
            alert()->error(__('app.error_message'));
            return back();
        }
    }

    public function show_category(BlogCategory $category)
    {
        $posts = $category->posts()->withCount("comments")
            ->with("category")
            ->where('status', 1)
            ->orderByDesc('id')
            ->paginate(8);

        $blogCategories = BlogCategory::where("status", 1)
            ->withCount("posts")
            ->get();

        return view('frontend.blog.bycategory')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_description')->value,
            'site_image' => asset('img/logo/logo_big.jpg'),
            'page_name' => Setting::find('app_tagline')->value,
            'category' => $category,
            'blogCategories' => $blogCategories,
            'totalCategories' => count($blogCategories),
            'posts' => $posts,
        ]);
    }
}
