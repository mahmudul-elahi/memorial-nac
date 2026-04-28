<?php

namespace App\Http\Controllers\Admin\Blog;

use Log;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog\BlogCategory;

class BlogCategoryController extends Controller
{
    public function index()
    {

        return view('admin.blog.categories.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Categories'),
            'categories' => BlogCategory::orderBy('status', 'desc')->latest()->paginate(25)
        ]);

    }

    public function create()
    {

        return view('admin.blog.categories.create')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Create New Category')
        ]);

    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required|string|min:5',
            'status' => 'required'
        ]);


        try {
            // Create category
            BlogCategory::create([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug($request->name),
                'status' => $request->status,
            ]);

            alert()->success(__('The category has been created!'));
            return redirect()->route('admin.blog.categories');

        } catch (\Exception $e) {
            Log::error($e);

            alert()->error(__('A problem has been encountered, try again!'));
            return back();

        }

    }

    public function edit(BlogCategory $category)
    {

        return view('admin.blog.categories.edit')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Category'),
            'category' => $category
        ]);

    }

    public function update(Request $request, BlogCategory $category)
    {

        $validation = $request->validate([
            'name' => 'required|unique:categories,name,'.$request->id,
            'description' => 'required|string|min:5',
            'status' => 'required'
        ]);

        try {
            $update = $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug($request->name),
                'status' => $request->status,
            ]);

            alert()->success(__('The category has been updated!'));
            return back();

        } catch (\Exception $e) {
            Log::error($e);

            alert()->error(__('A problem has been encountered, try again!'));
            return back();

        }

        if ($update) {
        } else {
        }

    }

    public function destroy(BlogCategory $category)
    {

        try {
            // Delete category
            $delete = $category->delete();
            // Send success message
            alert()->success(__('Successfully deleted!'));
            return back();

        } catch (\Exception $e) {
            // Log original error
            Log::error($e);

            // Send error response
            alert()->error(__('A problem has been encountered, try again!'));
            return back();

        }
    }
}
