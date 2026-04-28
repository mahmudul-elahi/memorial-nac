<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
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
            'otherUser'        => $user,
            'messages'         => $messages,
            'channelName'      => $channelName,
            'site_name'        => Setting::find('app_name')->value ?? 'Necrologi',
            'page_name'        => 'Chat with ' . $user->name,
            'site_description' => 'Chat with ' . $user->name,
            'site_image'       => asset($user->getAvatar()),
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

    public function poll(Request $request, User $user)
    {
        $afterId = (int) $request->query('after', 0);

        $messages = ChatMessage::where(function ($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->where('id', '>', $afterId)
          ->orderBy('created_at')
          ->with('sender')
          ->get()
          ->map(fn($m) => [
              'id'         => $m->id,
              'body'       => $m->body,
              'sender_id'  => $m->sender_id,
              'sender'     => [
                  'id'     => $m->sender->id,
                  'name'   => $m->sender->name,
                  'avatar' => asset($m->sender->getAvatar()),
              ],
              'created_at' => $m->created_at->format('H:i'),
          ]);

        // Mark received as read
        ChatMessage::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json($messages);
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
        $authId = Auth::id();

        // Get the latest message for each unique conversation partner
        $messages = ChatMessage::where('sender_id', $authId)
            ->orWhere('receiver_id', $authId)
            ->orderByDesc('created_at')
            ->with(['sender', 'receiver'])
            ->get();

        $seen   = [];
        $convos = [];

        foreach ($messages as $msg) {
            $partnerId = $msg->sender_id === $authId ? $msg->receiver_id : $msg->sender_id;
            if (isset($seen[$partnerId])) continue;
            $seen[$partnerId] = true;

            $partner = $msg->sender_id === $authId ? $msg->receiver : $msg->sender;
            if (!$partner) continue;

            $unread = ChatMessage::where('sender_id', $partnerId)
                ->where('receiver_id', $authId)
                ->whereNull('read_at')
                ->count();

            $convos[] = [
                'user' => [
                    'id'         => $partner->id,
                    'name'       => $partner->name,
                    'avatar_url' => asset($partner->getAvatar()),
                ],
                'last_msg'   => $msg->body,
                'updated_at' => $msg->created_at,
                'unread'     => $unread,
            ];

            if (count($convos) === 10) break;
        }

        return response()->json($convos);
    }
}
