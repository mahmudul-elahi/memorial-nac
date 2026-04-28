<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PageTitle;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class PageTitleController extends Controller
{
    // Display the list of page titles
    public function index()
    {
        $pageTitles = PageTitle::paginate(5);

        return view('admin.page_images.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Page Titles'),
            'settings' => Setting::first(),
            'pageTitles' => $pageTitles
        ]);
    }

    // Show the form for editing a specific page title
    public function edit($id)
    {
        $pageTitle = PageTitle::findOrFail($id);

        return view('admin.page_titles.edit')->with([
            'pageTitle' => $pageTitle,
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Edit Page Title'),
            'settings' => Setting::first(),
        ]);
    }

    // Update a specific page title in the database
    public function update(Request $request, $id)
    {
        // Validate input fields
        $validation = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        try {
            // Find the page title
            $pageTitle = PageTitle::findOrFail($id);

            // Update the page title entry
            $pageTitle->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]);

            alert()->success(__('The page title has been updated.'));
            return redirect()->route('admin.page_titles');
        } catch (\Exception $e) {
            // Log the error
            Log::error($e);
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();
        }
    }
}
