<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
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
}
