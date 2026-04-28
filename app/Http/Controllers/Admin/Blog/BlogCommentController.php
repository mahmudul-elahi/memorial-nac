<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\BlogComment;

class BlogCommentController extends Controller
{
    public function index()
    {

        return view('admin.blog.comments.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Comments'),
            'comments' => BlogComment::with("commentedBy", "post")->orderBy('status', 'desc')->latest()->paginate(25)
        ]);

    }

    public function edit(BlogComment $comment)
    {
        return view('admin.blog.comments.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Comment'),
            'comment' => $comment
        ]);

    }

    public function update(Request $request, BlogComment $comment)
    {

        $validation = $request->validate([
            'comment' => 'required|string|min:5',
            'status' => 'required'
        ]);

        try {
            // Update the comment
            $comment->update([
                'comment' => $request->comment,
                'status' => $request->status,
            ]);

            alert()->success(__('The comment has been updated!'));
            return back();

        } catch (\Exception $e) {
            // Log original error message
            Log::error($e);

            alert()->error(__('A problem has been encountered, try again!'));
            return back();

        }

    }

    public function destroy(BlogComment $comment)
    {
        try {
            // Delete the comment
            $comment->delete();

            alert()->success(__('Comment deleted!'));
            return back();

        } catch (\Exception $e) {
            // Log original error message
            Log::error($e);

            alert()->error(__('A problem has been encountered, try again!'));
            return back();

        }

    }
}
