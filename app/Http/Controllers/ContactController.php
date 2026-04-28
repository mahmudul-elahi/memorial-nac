<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Message;
use App\Models\PageTitle;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

use DB;

class ContactController extends Controller
{

    public function index()
    {

        $pageTitle = PageTitle::where('page_identifier', 'contact')->first();

        return view('frontend.contact.index')->with([
            'site_name' => Setting::find('app_name')->value,
            'site_description' => Setting::find('app_description')->value,
            'site_image' => asset('img/logo/logo_big.jpg'),
            'page_name' => Setting::find('app_tagline')->value,
            'pageTitle' => $pageTitle
        ]);
    }

    public function submit(Request $request)
    {

        $ipAddress = $request->ip();
        $cacheKey = 'contact_submission_' . $ipAddress;
        $throttleDuration = 120;


        if (Cache::has($cacheKey)) {
            return redirect()->back()->with('failed', 'You can only submit once every 2 hours.');
        }

        // Validate input fields
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // Create the message entry
            $message = Message::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            DB::commit();

            // Set the cache entry to enforce the throttle
            Cache::put($cacheKey, true, Carbon::now()->addMinutes($throttleDuration));

            return redirect()->route('index')->with('success', 'Your message has been saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()->with('failed', 'A problem has been encountered, please try again!');
        }
    }
}
