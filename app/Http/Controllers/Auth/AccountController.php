<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Overtrue\LaravelLike\Traits\Likeable;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\PageTitle;
use App\Models\Friendship;
use Alert;

class AccountController extends Controller
{

    use Likeable;

    public function index()
    {

        $pageTitle = PageTitle::where('page_identifier', 'account')->first();

        return view('frontend.account.setting')->with([
            'site_name' => 'Necrologi',
            'site_description' => __('app.update_your_account_desc'),
            'site_image' => asset('img/avatar/' . Auth::id()) . '/' . Auth::user()->avatar,
            'page_name' => __('app.update_your_account'),
            'pageTitle' => $pageTitle
        ]);
    }

    public function store(Request $request)
    {

        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,' . Auth::id(),
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Check if the resend verification button was clicked
        if ($request->has('resend_verification') && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            return redirect()->back()->with('success', 'A new verification link has been sent to your email address.');
        }


        // new password
        if ($request->filled('new_password')) {

            $this->validate($request, [
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'same:new_password',
            ]);

            $update = User::where('id', Auth::id())
                ->update([
                    'password' => bcrypt(request('new_password'))
                ]);

            if ($update) {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('login');
            } else {
                return back();
            }
        }

        // avatar
        if ($request->hasfile('avatar')) {

            if (!is_null(Auth::user()->avatar)) {
                File::delete(public_path('img/avatar/' . Auth::id()) . '/' . Auth::user()->avatar);
            }

            $file = $request->file('avatar');
            $name = Str::random(35) . '.' . $file->extension();
            $file->move(public_path('img/avatar/' . Auth::id()), $name);

            // store in db
            $update = Auth::user()->update([
                'avatar' => $name
            ]);
        }

        $update = Auth::user()->update([
            'email' => $request->email,
            'name' => $request->name
        ]);

        if ($update) {
            Alert::success(__('app.you_have_updated_your_account'));
            return back();
        } else {
            Alert::error(__('app.error_message'));
            return back();
        }
    }

    public function profile($id, $name)
    {
        $pageTitle = PageTitle::where('page_identifier', 'profile')->first();

        $user = User::findOrFail($id);

        $friendship = null;
        if (Auth::check() && Auth::id() !== $user->id) {
            $friendship = Friendship::where(function ($q) use ($user) {
                $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
            })->orWhere(function ($q) use ($user) {
                $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
            })->first();
        }

        return view('frontend.account.profile')->with([
            'site_name'       => 'Necrologi',
            'site_description' => __('app.sd_the_profile_of'),
            'site_image'      => asset('img/avatar/' . $user->id) . '/' . $user->avatar,
            'page_name'       => __('app.pn_the_profile_of', ['name' => $user->name]),
            'user'            => $user,
            'friendship'      => $friendship,
            'pageTitle'       => $pageTitle,
        ]);
    }
}
