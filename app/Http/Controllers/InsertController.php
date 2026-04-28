<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;
use App\Models\Setting;
use App\Models\Item;
use App\Models\Image;
use App\Models\Detail;
use App\Models\PageTitle;
use Alert;

class InsertController extends Controller
{

    public $new_entries;

    public function __construct()
    {
        $this->new_entries = Setting::find('new_entries')->value;
    }

    function make_slug($string)
    {
        $string = preg_replace('~[^\\pL\d]+~u', '-', trim($string));
        return Str::lower($string);
    }

    function isLoggedIn()
    {
        if (Auth::check()) {
            return Auth::id();
        }
    }

    public function index()
    {

        $pageTitle = PageTitle::where('page_identifier', 'add_memorial')->first();

        return view('frontend.memorial.add')->with([
            'site_name' => 'Necrologi',
            'site_description' => __('app.sd_enter_an_obituary'),
            'site_image' => asset('img/logo/logo_big.jpg'),
            'page_name' => __('app.pn_enter_an_obituary'),
            'pageTitle' => $pageTitle
        ]);
    }

    public function store(Request $request)
    {

        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required|string|min:150',
            'category' => 'required',
            'image' => 'required|array|min:1|max:5',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:40960',
            'terms_of_service' => 'accepted',
            'sex' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'death_date' => 'required|date',
            'funeral_place' => 'nullable|string|min:1|max:150',
        ]);

        // Create the item
        $create = Item::create([
            'title' => $request->title,
            'description' => Purify::clean($request->description),
            'user_id' => $this->isLoggedIn(),
            'category_id' => $request->category,
            'slug' => $this->make_slug($request->title),
            'status' => $this->new_entries,
            'terms' => 1
        ]);

        if ($create) {
            Detail::create([
                'sex' => $request->sex,
                'birth_date' => $request->birth_date,
                'death_date' => $request->death_date,
                'funeral_place' => $request->funeral_place,
                'item_id' => $create->id,
            ]);

            if ($request->hasfile('image')) {
                foreach ($request->file('image') as $file) {
                    $name = Str::random(35) . '.' . $file->extension();
                    $file->move(public_path('img/obituary/' . $create->id), $name);


                    Image::create([
                        'filename' => $name,
                        'imageable_id' => $create->id,
                        'imageable_type' => 'App\Models\Item'
                    ]);
                }
            }

            $message = (Setting::find('new_entries')->value == 1)
                ? __('app.success_message_subtitle_1')
                : __('app.success_message_subtitle_0');

            $successMessage = DB::table('success_messages')
                ->where('key', 'memorial_post_success')
                ->value('message');

            Alert::success(__('app.pn_successfully_sent'), $message)->persistent(true);
            return redirect()->route('index')->with('success', $successMessage);
        } else {
            Alert::error(__('app.error_message'));
            return back();
        }
    }
}
