<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Setting;
use Alert;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->new_comments = Setting::find('new_comments')->value;
    }

    public function store(Request $request, $item_id)
    {
        $validation = $request->validate([
            'content' => 'required|string|max:300'
        ]);

        $create = Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'status' => $this->new_comments
        ]);

        if ($create) {

            if ($this->new_comments == 1) {
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

    public function destroy(Request $request)
    {

        $comment = Comment::findOrFail($request->comment_id);

        if ($comment->isMyComment()) {
            $delete = Comment::findOrFail($request->comment_id)->delete();
            alert()->success(__('app.you_successfully_delete_the_comment'));
            return back();
        } else {
            alert()->error(__('app.error_message'));
            return back();
        }
    }
}
