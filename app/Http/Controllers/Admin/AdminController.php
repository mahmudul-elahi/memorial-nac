<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Item;
use App\Models\Detail;
use App\Models\Image;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
use App\Models\Like;
use App\Models\User;
use App\Models\SuccessMessage;
use PDF;
use Alert;

class AdminController extends Controller
{

    public $new_entries;
    public $new_comments;

    public function __construct()
    {
        $this->new_entries = Setting::find('new_entries')->value;
        $this->new_comments = Setting::find('new_comments')->value;
    }

    function make_slug($string)
    {
        $string = preg_replace('~[^\\pL\d]+~u', '-', trim($string));
        return Str::lower($string);
    }

    public function index()
    {

        return view('admin.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Dashboard'),
            'items' => new Item,
            'categories' => new Category,
            'comments' => new Comment,
            'users' => new User,
        ]);
    }

    public function edit()
    {

        return view('admin.settings')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Settings'),
            'settings' => Setting::first()
        ]);
    }

    public function update(Request $request)
    {

        $validation = $request->validate([
            'app_name' => 'required|string|min:3',
            'app_tagline' => 'nullable|string|min:3',
            'app_description' => 'nullable|string|max:150',
            'num_of_results' => 'required|numeric|min:1',
            'num_comments_at_time' => 'required|numeric|min:3',
            'app_logo' => 'nullable',
            'app_color' => 'required',
            'new_entries' => 'nullable',
            'new_comments' => 'nullable',
            'dir' => 'required'
        ]);

        // logo
        if (!empty(request('app_logo'))) {

            $request->validate([
                'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if (!empty(Setting::find('app_logo')->value)) {
                $delete = File::delete('img/logo/' . Setting::find('app_logo')->value);
            }

            $value = Str::random(24) . '.' . $request->file('app_logo')->extension();
            $destinationPath = 'img/logo';

            $img = Image::make($request->file('app_logo')->path());
            $img->save($destinationPath . '/' . $imageName);
        }
        // end logo

        foreach ($request->all() as $key => $value) {
            $update = Setting::where('name', $key)->update([
                'value' => $value
            ]);
        }

        if ($update) {
            alert()->success(__('Updated changes!'));
            return back();
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function about()
    {

        return view('admin.about')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('About'),
            'settings' => Setting::first()
        ]);
    }

    public function about_update(Request $request)
    {

        $validation = $request->validate([
            'about' => 'required|string|min:100',
        ]);

        $update = Setting::where('name', 'about')->update([
            'value' => Purify::clean($request->about)
        ]);

        if ($update) {
            alert()->success(__('Updated changes!'));
            return back();
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function terms()
    {

        return view('admin.terms')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Terms & Conditions'),
            'settings' => Setting::first()
        ]);
    }

    public function terms_update(Request $request)
    {

        $validation = $request->validate([
            'terms' => 'required|string|min:100',
        ]);

        $update = Setting::where('name', 'terms')->update([
            'value' => Purify::clean($request->terms)
        ]);

        if ($update) {
            alert()->success(__('Updated changes!'));
            return back();
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function logos()
    {
        return view('admin.logos')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Update Logos'),
            'settings' => Setting::first()
        ]);
    }

    public function logos_update(Request $request)
    {

        $validation = $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasfile('logo')) {


            // delete existing file
            $setting = Setting::first();
            $currentImage = public_path($setting->getLogo());

            if (file_exists($currentImage)) {
                File::delete($currentImage);
            }


            $file = $request->file('logo');
            $name = Str::random(35) . '.' . $file->extension();
            $file->move(public_path('img/logo/'), $name);

            $update = Setting::where('name', 'app_logo')->update([
                'value' => $name
            ]);

            if ($update) {
                alert()->success(__('The logo has been updated!'));
                return back();
            } else {
                alert()->error(__('A problem has been encountered, try again!'));
                return back();
            }
        }
    }

    //

    //

    //

    //

    //

    public function users()
    {

        return view('admin.users.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Users'),
            'users' => User::orderByDesc('created_at')->paginate(25)
        ]);
    }

    public function user_edit($id)
    {

        return view('admin.users.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Users'),
            'user' => User::findOrFail($id),
            'roles' => \Spatie\Permission\Models\Role::all()
        ]);
    }

    public function user_update(Request $request, $id)
    {
        // Update password if provided
        if (!empty($request->new_password)) {
            $this->validate($request, [
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'same:new_password',
            ]);

            $update = User::where('id', $id)
                ->update([
                    'password' => bcrypt($request->new_password),
                ]);

            if ($update) {
                alert()->success(__('Password updated!'));
                return redirect()->route('admin.user.edit', $id);
            } else {
                return back()->with('error', __('A problem has been encountered, try again!'));
            }
        }

        // Validate name and email
        $request->validate([
            'name' => 'required|max:150|unique:users,name,' . $id,
            'email' => 'required|unique:users,email,' . $id,
        ]);

        // Handle avatar removal (just set to null in the database)
        $user = User::find($id);
        if ($request->has('remove_avatar')) {
            // Set avatar field to null
            $user->avatar = null;
        }

        // Update name and email
        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update role
        $user->roles()->detach();
        $user->roles()->attach(\Spatie\Permission\Models\Role::where('name', $request->role)->first());

        if ($update) {
            alert()->success(__('Updated changes!'));
            return redirect()->route('admin.user.edit', $id);
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }


    /**
     * @delete User
     *
     * @return \Illuminate\Http\Response
     */
    public function user_destroy($id)
    {

        $user = User::findOrFail($id);

        // remove his avatar
        if (!is_null($user->avatar)) {
            File::delete(public_path('img/avatar/' . $id) . '/' . $user->avatar);
        }

        $delete = User::where('id', $id)->delete();

        if ($delete) {
            alert()->success(__('Updated changes!'));
            return redirect()->route('admin.users');
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    //

    //

    //

    //

    public function obituaries()
    {

        $message = SuccessMessage::where('key', 'memorial_post_success')->first();

        return view('admin.obituaries.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Obituaries'),
            'obituaries' => Item::orderBy('status', 'desc')->latest()->paginate(25),
            'message' => $message
        ]);
    }

    public function obituary_create()
    {

        return view('admin.obituaries.create')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Create Obituary')
        ]);
    }

    public function obituaries_message(Request $request)
    {

        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        SuccessMessage::where('key', 'memorial_post_success')->update([
            'message' => $request->input('message'),
        ]);

        alert()->success(__('Successfully Updated!'));
        return redirect()->back();
    }

    public function obituary_store(Request $request)
    {

        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required|string|min:150',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sex' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'death_date' => 'required|date',
            'funeral_place' => 'nullable|string|min:1|max:150',
        ]);

        $create = Item::create([
            'title' => $request->title,
            'description' => Purify::clean($request->description),
            'user_id' => Auth::id(),
            'category_id' => $request->category,
            'slug' => $this->make_slug($request->title),
            'status' => $request->status,
            'terms' => 1
        ]);

        // if obituary has been created, save the present details
        if ($create) {

            Detail::create([
                'sex' => $request->sex,
                'birth_date' => $request->birth_date,
                'death_date' => $request->death_date,
                'funeral_place' => $request->funeral_place,
                'item_id' => $create->id,
            ]);
        }

        // if there is an image
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $name = Str::random(35) . '.' . $file->extension();
            $file->move(public_path('img/obituary/' . $create->id), $name);

            // store in db
            Image::create([
                'filename' => $name,
                'imageable_id' => $create->id,
                'imageable_type' => 'App\Models\Item'
            ]);
        }

        if ($create) {
            alert()->success(__('Successfully posted!'));
            return redirect()->route('admin.obituaries');
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function obituary_edit($id)
    {

        $item = Item::findOrFail($id);

        return view('admin.obituaries.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edi Obituary'),
            'item' => $item
        ]);
    }

    public function obituary_update(Request $request)
    {

        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required|string|min:150',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sex' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'death_date' => 'required|date',
            'funeral_place' => 'nullable|string|min:1|max:150',
        ]);

        //
        // if there is an image
        if ($request->hasfile('image')) {

            $item = Item::findOrFail($request->id);

            // delete existing file
            $currentImage = public_path('img/obituary/' . $item->id . '/' . $item->thumb->filename);

            if (file_exists($currentImage)) {
                File::delete($currentImage);
            }

            $file = $request->file('image');
            $name = Str::random(35) . '.' . $file->extension();
            $file->move(public_path('img/obituary/' . $request->id), $name);

            // update in db
            Image::where('imageable_id', $request->id)->update([
                'filename' => $name,
            ]);
        }
        //
        //

        $update = Item::where('id', $request->id)->update([
            'title' => $request->title,
            'description' => Purify::clean($request->description),
            // 'user_id' => Auth::id(),
            'category_id' => $request->category,
            'slug' => $this->make_slug($request->title),
            'status' => $request->status,
            'terms' => 1
        ]);

        // Update details
        Detail::where('item_id', $request->id)->update([
            'sex' => $request->sex,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'funeral_place' => $request->funeral_place,
        ]);

        if ($update) {
            alert()->success(__('The item has been updated!'));
            return back();
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function obituary_destroy($id)
    {

        $item = Item::findOrFail($id);

        // delete folder
        $currentImage = public_path('img/obituary/' . $item->id);

        if (file_exists($currentImage)) {
            File::deleteDirectory($currentImage);
        }

        $delete = $item->delete();

        alert()->success(__('Successfully deleted!'));
        return redirect()->route('admin.obituaries');
    }

    public function obituary_delete_all(Request $request)
    {

        $ids = $request->ids;
        $images = explode(",", $ids);

        foreach ($images as $image) {
            $image_path = public_path('img/obituary/' . $image);
            File::deleteDirectory($image_path);
        }

        $deleteAll = Item::whereIn('id', explode(",", $ids))->delete();

        return response()->json(['success' => "Products Deleted successfully."]);
    }

    public function downloadPDF($id)
    {

        $item = Item::findOrFail($id);

        $data = [
            'item' => $item
        ];

        $pdf = PDF::loadView('admin.obituaries.pdf', $data);

        return $pdf->download($item->title . '.pdf');
    }

    //

    //

    //

    //

    //

    public function categories()
    {

        return view('admin.categories.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Categories'),
            'categories' => Category::orderBy('status', 'desc')->latest()->paginate(25)
        ]);
    }

    public function category_create()
    {

        return view('admin.categories.create')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Create New Category')
        ]);
    }

    public function category_store(Request $request)
    {

        $validation = $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required|string|min:5',
            'status' => 'required'
        ]);


        $create = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $this->make_slug($request->name),
            'status' => $request->status,
        ]);

        if ($create) {
            alert()->success(__('The category has been created!'));
            return redirect()->route('admin.categories');
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function category_edit($id)
    {

        return view('admin.categories.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Category'),
            'category' => Category::findOrFail($id)
        ]);
    }

    public function category_update(Request $request)
    {

        $validation = $request->validate([
            'name' => 'required|unique:categories,name,' . $request->id,
            'description' => 'required|string|min:5',
            'status' => 'required'
        ]);

        $update = Category::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $this->make_slug($request->name),
            'status' => $request->status,
        ]);

        if ($update) {
            alert()->success(__('The category has been updated!'));
            return back();
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function category_destroy($id)
    {

        $items = Item::where('category_id', $id)->get();

        foreach ($items as $item) {
            $image_path = public_path('img/obituary/' . $item->id);
            File::deleteDirectory($image_path);
        }

        $delete = Category::findOrFail($id)->delete();

        alert()->success(__('Successfully deleted!'));
        return back();
    }

    //

    //

    //

    //

    //

    public function comments()
    {

        return view('admin.comments.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Comments'),
            'comments' => Comment::orderBy('status', 'desc')->latest()->paginate(25)
        ]);
    }

    public function comment_edit($id)
    {

        return view('admin.comments.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Comment'),
            'comment' => Comment::findOrFail($id)
        ]);
    }

    public function comment_update(Request $request)
    {

        $validation = $request->validate([
            'content' => 'required|string|min:5',
            'status' => 'required'
        ]);

        $update = Comment::where('id', $request->id)->update([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        if ($update) {
            alert()->success(__('The comment has been updated!'));
            return back();
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function comment_destroy($id)
    {
        $delete = Comment::findOrFail($id)->delete();

        alert()->success(__('Successfully deleted!'));
        return back();
    }

    //

    //

    //

    //

    //

    public function pages()
    {

        return view('admin.pages.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Pages'),
            'pages' => Page::orderBy('status', 'desc')->latest()->paginate(25)
        ]);
    }

    public function page_create()
    {

        return view('admin.pages.create')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Create Page')
        ]);
    }

    public function page_store(Request $request)
    {

        $validation = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:150',
            'content' => 'required|string|min:5',
            'status' => 'required'
        ]);

        $create = Page::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => Purify::clean($request->content),
            'slug' => $this->make_slug($request->title),
            'status' => $request->status,
        ]);

        if ($create) {
            alert()->success(__('The page has been created!'));
            return redirect()->route('admin.pages');
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function page_edit($id)
    {

        return view('admin.pages.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Page'),
            'page' => Page::findOrFail($id)
        ]);
    }

    public function page_update(Request $request)
    {

        $validation = $request->validate([
            'title' => 'required|unique:pages,title,' . $request->id,
            'description' => 'required|string|max:150',
            'content' => 'required|string|min:5',
            'status' => 'required'
        ]);

        $update = Page::where('id', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => Purify::clean($request->content),
            'slug' => $this->make_slug($request->title),
            'status' => $request->status,
        ]);

        if ($update) {
            alert()->success(__('The page has been updated!'));
            return back();
        } else {
            alert()->error(__('A problem has been encountered, try again!'));
            return back();
        }
    }

    public function page_destroy($id)
    {
        $delete = Page::findOrFail($id)->delete();

        alert()->success(__('Successfully deleted!'));
        return back();
    }

    //

    //

    //

    //

    //

    public function change_status(Request $request)
    {

        $table = $request->table;

        if ($table == "item") {
            $table = new Item;
        } elseif ($table == "comment") {
            $table = new Comment;
        } elseif ($table == "category") {
            $table = new Category;
        } else {
            $table = new Page;
        }

        $item = $table->findOrFail($request->id);

        if ($item->getStatus()) {

            $item->status = '0';
            $item->save();

            return response()->json([
                'bool' => true
            ]);
        } else {

            $item->status = '1';
            $item->save();

            return response()->json([
                'bool' => false
            ]);
        }
    }
}
