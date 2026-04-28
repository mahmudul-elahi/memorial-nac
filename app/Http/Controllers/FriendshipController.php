<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function send(User $user)
    {
        if ($user->id === Auth::id()) {
            return back();
        }

        $exists = Friendship::where(function ($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->exists();

        if (!$exists) {
            Friendship::create([
                'sender_id'   => Auth::id(),
                'receiver_id' => $user->id,
                'status'      => 'pending',
            ]);
        }

        return back();
    }

    public function accept(Friendship $friendship)
    {
        if ($friendship->receiver_id !== Auth::id()) {
            return back();
        }

        $friendship->update(['status' => 'accepted']);

        return back();
    }

    public function decline(Friendship $friendship)
    {
        if ($friendship->receiver_id !== Auth::id()) {
            return back();
        }

        $friendship->update(['status' => 'declined']);

        return back();
    }

    public function cancel(Friendship $friendship)
    {
        if ($friendship->sender_id !== Auth::id() && $friendship->receiver_id !== Auth::id()) {
            return back();
        }

        $friendship->delete();

        return back();
    }

    public function friends()
    {
        $user = Auth::user();
        $friends = $user->friends();

        return view('frontend.friendship.friends', [
            'friends'     => $friends,
            'site_name'   => Setting::find('app_name')->value ?? 'Necrologi',
            'page_name'   => 'My Friends',
            'site_description' => 'Your friends list',
            'site_image'  => asset('img/avatar/no_avatar.jpg'),
        ]);
    }

    public function requests()
    {
        $user = Auth::user();
        $received = $user->pendingReceivedRequests();
        $sent     = $user->pendingSentRequests();

        return view('frontend.friendship.requests', [
            'received'    => $received,
            'sent'        => $sent,
            'site_name'   => Setting::find('app_name')->value ?? 'Necrologi',
            'page_name'   => 'Friend Requests',
            'site_description' => 'Manage your friend requests',
            'site_image'  => asset('img/avatar/no_avatar.jpg'),
        ]);
    }
}
