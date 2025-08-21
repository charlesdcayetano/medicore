<?php

namespace App\Http\Controllers;

use App\Notifications\SystemBroadcast;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request) {
        $notifications = $request->user()->notifications()->latest()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markRead(string $id, Request $request) {
        $n = $request->user()->notifications()->findOrFail($id);
        $n->markAsRead();
        return back();
    }

    public function destroy(string $id, Request $request) {
        $n = $request->user()->notifications()->findOrFail($id);
        $n->delete();
        return back()->with('success','Notification deleted.');
    }

    public function broadcast(Request $request) {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'message'=>'required|string',
            'priority'=>'required|in:low,medium,high,urgent',
        ]);
        foreach (\App\Models\User::cursor() as $user) {
            $user->notify(new SystemBroadcast($data['title'],$data['message'],$data['priority']));
        }
        return back()->with('success','Broadcast sent.');
    }
}
