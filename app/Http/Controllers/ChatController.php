<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\Friendship;
use App\Models\User;
use App\Models\PageTitle;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('index');
        }

        // Mark received messages as read
        ChatMessage::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = ChatMessage::where(function ($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        $ids = [Auth::id(), $user->id];
        sort($ids);
        $channelName = 'chat.' . $ids[0] . '.' . $ids[1];

        return view('frontend.chat.index', [
            'otherUser'   => $user,
            'messages'    => $messages,
            'channelName' => $channelName,
            'site_name'   => Setting::find('app_name')->value,
            'page_name'   => 'Chat with ' . $user->name,
        ]);
    }

    public function store(Request $request, User $user)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        $message = ChatMessage::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $user->id,
            'body'        => $request->body,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'id'         => $message->id,
            'body'       => $message->body,
            'sender_id'  => $message->sender_id,
            'sender'     => [
                'id'     => Auth::id(),
                'name'   => Auth::user()->name,
                'avatar' => asset(Auth::user()->getAvatar()),
            ],
            'created_at' => $message->created_at->format('H:i'),
        ]);
    }

    public function unread()
    {
        $count = ChatMessage::where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }

    public function conversationsPage()
    {
        $user = Auth::user();
        $friends = $user->friends();

        // Build conversation data for each friend who has messages
        $convos = collect();
        foreach ($friends as $friend) {
            $lastMsg = \App\Models\ChatMessage::where(function ($q) use ($friend) {
                $q->where('sender_id', Auth::id())->where('receiver_id', $friend->id);
            })->orWhere(function ($q) use ($friend) {
                $q->where('sender_id', $friend->id)->where('receiver_id', Auth::id());
            })->orderByDesc('created_at')->first();

            $unread = \App\Models\ChatMessage::where('sender_id', $friend->id)
                ->where('receiver_id', Auth::id())
                ->whereNull('read_at')
                ->count();

            $convos->push([
                'user'       => $friend,
                'last_msg'   => $lastMsg ? $lastMsg->body : null,
                'updated_at' => $lastMsg ? $lastMsg->created_at : null,
                'unread'     => $unread,
            ]);
        }

        $convos = $convos->filter(fn($c) => $c['last_msg'] !== null)
                         ->sortByDesc('updated_at')
                         ->values();

        return view('frontend.chat.conversations', [
            'convos'           => $convos,
            'friends'          => $friends,
            'site_name'        => Setting::find('app_name')->value ?? 'Necrologi',
            'page_name'        => 'Messages',
            'site_description' => 'Your conversations',
            'site_image'       => asset('img/avatar/no_avatar.jpg'),
        ]);
    }

    public function conversations()
    {
        // Latest message per conversation
        $sent = ChatMessage::where('sender_id', Auth::id())
            ->with('receiver')
            ->orderByDesc('created_at')
            ->get()
            ->keyBy('receiver_id');

        $received = ChatMessage::where('receiver_id', Auth::id())
            ->with('sender')
            ->orderByDesc('created_at')
            ->get()
            ->keyBy('sender_id');

        $convos = collect();

        foreach ($sent as $userId => $msg) {
            $convos[$userId] = [
                'user'       => $msg->receiver,
                'last_msg'   => $msg->body,
                'updated_at' => $msg->created_at,
                'unread'     => 0,
            ];
        }

        foreach ($received as $userId => $msg) {
            $unread = ChatMessage::where('sender_id', $userId)
                ->where('receiver_id', Auth::id())
                ->whereNull('read_at')
                ->count();

            if (isset($convos[$userId])) {
                if ($msg->created_at > $convos[$userId]['updated_at']) {
                    $convos[$userId]['last_msg']   = $msg->body;
                    $convos[$userId]['updated_at'] = $msg->created_at;
                }
                $convos[$userId]['unread'] = $unread;
            } else {
                $convos[$userId] = [
                    'user'       => $msg->sender,
                    'last_msg'   => $msg->body,
                    'updated_at' => $msg->created_at,
                    'unread'     => $unread,
                ];
            }
        }

        $convos = collect($convos)->sortByDesc('updated_at')->take(5)->values();

        return response()->json($convos);
    }
}
