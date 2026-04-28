<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Page;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if 2FA is enabled for the user and OTP is not verified
            if ($user->two_factor_enabled && !session('otp_verified')) {
                // Log the user out immediately if OTP is not verified
                Auth::logout();
                return redirect()->route('login')->withErrors(['otp' => 'Please complete 2FA to continue.']);
            }
        }

        // Category list
        View::share('categories', Category::with('subcategory')->whereNull('parent_id')->where('status', '1')->orderBy('id', 'ASC')->get());

        View::share('condolences', Like::whereHas('item', function ($q) {
            $q->where('status', 1);
        })->orderByDesc('created_at')->take(5)->get());

        View::share('latestComments', Comment::whereHas('itemsFilter', function ($q) {
            $q->where('status', 1);
        })->where('status', 1)->orderByDesc('created_at')->take(6)->get());

        View::share('pages', Page::where('status', 1)->orderByDesc('id')->get());

        View::share('settings', Setting::first());
        Carbon::setLocale(config('locale'));

        View::share('socialLinks', SocialLink::all());

        // Pagination
        Paginator::useBootstrap();
    }
}
