<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatSession;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function index()
    {
        $sessions = ChatSession::orderBy('updated_at', 'desc')->get();
        return view('admin.chat.index', compact('sessions'));
    }

    public function show($id)
    {
        $session = ChatSession::with('messages')->findOrFail($id);
        
        // Mark visitor messages as read
        $session->messages()->where('sender', 'visitor')->where('is_read', false)->update(['is_read' => true]);

        return response()->json([
            'session' => $session,
            'messages' => $session->messages
        ]);
    }

    public function reply(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);
        
        $session = ChatSession::findOrFail($id);
        
        $message = $session->messages()->create([
            'sender' => 'admin',
            'message' => $request->message,
            'is_read' => false
        ]);

        $session->touch(); // Update updated_at to bring it to top

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function close($id)
    {
        $session = ChatSession::findOrFail($id);
        $session->update(['status' => 'closed']);
        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $session = ChatSession::findOrFail($id);
        $session->messages()->delete();
        $session->delete();
        return response()->json(['success' => true]);
    }

    public function deleteAll()
    {
        ChatMessage::truncate();
        ChatSession::truncate();
        return response()->json(['success' => true]);
    }
}
