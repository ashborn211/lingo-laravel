<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function showAddFriendForm()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('addFriend', compact('users'));
    }

    public function sendFriendRequest(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
        ]);

        FriendRequest::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $request->input('recipient_id'),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Friend request sent successfully!');
    }

    public function acceptFriendRequest($friendRequestId)
    {
        $friendRequest = FriendRequest::findOrFail($friendRequestId);

        if ($friendRequest->recipient_id === Auth::id()) {
            $friendRequest->update(['status' => 'accepted']);

            // Add both users to the friends table
            $sender = User::find($friendRequest->sender_id);
            $recipient = User::find($friendRequest->recipient_id);

            $sender->friends()->attach($friendRequest->recipient_id);
            $recipient->friends()->attach($friendRequest->sender_id);
        }

        return redirect()->back()->with('success', 'Friend request accepted!');
    }

    public function rejectFriendRequest($friendRequestId)
    {
        $friendRequest = FriendRequest::findOrFail($friendRequestId);

        if ($friendRequest->recipient_id === Auth::id()) {
            $friendRequest->update(['status' => 'rejected']);
        }

        return redirect()->back()->with('success', 'Friend request rejected!');
    }
}
