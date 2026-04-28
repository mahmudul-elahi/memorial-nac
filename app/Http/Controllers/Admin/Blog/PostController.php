<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Admin\Blog\BlogCategory;
use App\Models\Image;
use App\Models\Setting;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Blog\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.posts.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Categories'),
            'posts' => Post::with("category")->orderBy('status', 'desc')->latest()->paginate(25)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.posts.create')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Create New Post'),
            'categories' => BlogCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|unique:posts,title',
            'thumbnail' => 'nullable|image|max:2024',
            'description' => 'nullable|string|min:5|max:150',
            'body' => 'required|string|min:5',
            'category_id' => 'required|exists:blog_categories,id',
            'status' => 'required|boolean'
        ]);

        try {
            DB::beginTransaction();

            // Update the post
            $post = Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'body' => $request->body,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);

            // Update thumbnail
            if($request->hasFile('thumbnail')) {
                $this->storeOrUpdateThumbnail($request->file("thumbnail"), $post);

            }

            DB::commit();
            // Return success message
            alert()->success(__('The post has been created.'));
            return redirect()->route("admin.blog.posts");

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error
            Log::error($e);
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.blog.posts.create')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'post' => $post
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.blog.posts.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Post'),
            'categories' => BlogCategory::get(),
            'post' => $post
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validation = $request->validate([
            'title' => ['string', Rule::unique("posts", "title")->ignore($post->id)],
            'thumbnail' => 'nullable|image|max:2024',
            'description' => 'required|string|min:5|max:150',
            'body' => 'required|string|min:5',
            'category_id' => 'required|exists:blog_categories,id',
            'status' => 'required'
        ]);

        try {
            DB::beginTransaction();

            // Update thumbnail
            if($request->hasFile('thumbnail')) {
                $this->storeOrUpdateThumbnail($request->file("thumbnail"), $post);

            }

            // Update the post
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'body' => $request->body,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);

            DB::commit();
            // Return success message
            alert()->success(__('The post has been updated!'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error
            Log::error($e);
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        try {
            DB::beginTransaction();

            // Delete post thumbnail directory
            $image_path = public_path('img/posts/'.$post->id);
            File::deleteDirectory($image_path);
            // Delete thumbnail from DB
            $post->thumbnail()->delete();

            // Delete the post
            $post->delete();

            DB::commit();

            alert()->success(__('Successfully deleted!'));
            return redirect()->back();

        } catch (\Exception $e) {
            // Rollback
            DB::rollBack();
            // Log the original error
            Log::error($e);

            // Send error response
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();

        }
    }


    public function storeOrUpdateThumbnail(UploadedFile $thumbnail, Post $post) {

        if($post->thumbnail()->exists()) {
            // delete existing file
            $currentImage = public_path('img/posts/'.$post->id.'/'.$post->thumbnail->filename);

            if(file_exists($currentImage)) {
                File::delete($currentImage);
            }

        }

         $name = Str::random(35).'.'.$thumbnail->extension();
         $thumbnail->move(public_path('img/posts/'.$post->id), $name);

         // update or store in the db
         $post->thumbnail()->updateOrCreate([
                 "imageable_id" => $post->id
             ], [
                 'filename' => $name
             ]);
    }
}
