<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageImage;
use App\Models\Setting;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageImageController extends Controller
{
    public function index()
    {
        $pageImages = PageImage::paginate(5);

        return view('admin.page_images.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Page Titles'),
            'settings' => Setting::first(),
            'pageImages' => $pageImages
        ]);
    }


    public function edit($id)
    {
        $pageImage = PageImage::findOrFail($id);

        return view('admin.page_images.edit')->with([
            'pageImage' => $pageImage,
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Page Image'),
            'settings' => Setting::first(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'text' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2024',
        ]);

        try {
            DB::beginTransaction();

            $pageImage = PageImage::findOrFail($id);

            $pageImage->text = $request->input('text');
            $pageImage->order = $request->input('order');

            if ($request->hasFile('image_url')) {
                // Delete existing image if exists
                $currentImage = public_path('img/page_images/' . $id . '/' . $pageImage->image_url);

                if (file_exists($currentImage)) {
                    File::delete($currentImage);
                }

                // Generate a new filename and move the uploaded image
                $file = $request->file('image_url');
                $name = Str::random(35) . '.' . $file->extension();

                // Ensure the directory exists, or create it
                $directory = public_path('img/page_images/' . $id);
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Move the uploaded image to the public directory
                $file->move($directory, $name);

                // Update the database with the new image path
                $pageImage->image_url = 'img/page_images/' . $id . '/' . $name;
            }

            $pageImage->save();

            DB::commit();

            alert()->success(__('The page image has been updated.'));
            return redirect()->route("admin.page_images");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();
        }
    }
}
