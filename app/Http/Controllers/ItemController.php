<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Category;
use App\Models\PageTitle;
use App\Models\View;

class ItemController extends Controller
{

    public function __construct(Request $request)
    {
        $this->fingerprint = $request->fingerprint();
        $this->num_comments_at_time = Setting::find('num_comments_at_time')->value; // 
    }

    public function show($id, $slug)
    {

        $item = Item::whereHas('category', function ($q) {
            $q->where('status', 1);
        })->where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        $comments = Comment::query()
            ->where('item_id', $id)
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->paginate($this->num_comments_at_time);

        $pageTitle = PageTitle::where('page_identifier', 'memorial')->first();

        // Store single view
        View::store($this->fingerprint, 'item_id', $item->id);

        return view('frontend.memorial.show')->with([
            'site_name' => 'Necrologi',
            'site_description' => Str::limit($item->description, 155, '...'),
            'site_image' => asset($item->getThumb()),
            'page_name' => $item->title,
            'item' => $item,
            'pageTitle' => $pageTitle,
            'comments' => $comments
        ]);
    }
}
