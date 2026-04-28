<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use DB;
use Illuminate\Support\Facades\Log;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::all();

        return view('admin.social_links.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Social Links'),
            'settings' => Setting::first(),
            'socialLinks' => $socialLinks
        ]);
    }



    public function create()
    {
        return view('admin.social_links.create')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Create New Post'),
            'settings' => Setting::first(),
        ]);
    }


    public function store(Request $request)
    {
        // Validate input fields
        $validation = $request->validate([
            'platform' => 'required|string|unique:social_links,platform|max:50',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:50'
        ]);

        try {
            DB::beginTransaction();

            // Create the social link entry
            $socialLink = SocialLink::create([
                'platform' => $request->platform,
                'url' => $request->url,
                'icon' => $request->icon,
            ]);

            DB::commit();
            // Return success message
            alert()->success(__('The social link has been created.'));
            return redirect()->route("admin.social_links");
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error
            Log::error($e);
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);

        return view('admin.social_links.edit')->with([
            'socialLink' => $socialLink,
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_tagline')->value,
            'page_name' => __('Social Links Edit'),
            'settings' => Setting::first(),
        ]);
    }


    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'platform' => 'required|string|max:50|unique:social_links,platform,' . $id,
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:50'
        ]);

        try {
            DB::beginTransaction();

            // Update the social link entry
            $socialLink = SocialLink::findOrFail($id);
            $socialLink->update([
                'platform' => $request->platform,
                'url' => $request->url,
                'icon' => $request->icon,
            ]);

            DB::commit();
            alert()->success(__('The social link has been updated.'));
            return redirect()->route("admin.social_links");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();
        }
    }



    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Find the social link by ID
            $socialLink = SocialLink::findOrFail($id);

            // Delete the social link from the database
            $socialLink->delete();

            DB::commit();

            alert()->success(__('Successfully deleted!'));
            return redirect()->route('admin.social_links');
        } catch (\Exception $e) {
            // Rollback
            DB::rollBack();

            // Log the original error for troubleshooting
            Log::error($e);

            // Send error response
            alert()->error(__('A problem has been encountered, try again!'));
            return redirect()->back();
        }
    }
}
