<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'session_id' => 'nullable|string',
            'name' => 'required_without:session_id|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $sessionId = $request->session_id;

        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
            ChatSession::create([
                'session_id' => $sessionId,
                'visitor_name' => $request->name,
                'visitor_email' => $request->email,
                'status' => 'active'
            ]);
        }

        $chatSession = ChatSession::where('session_id', $sessionId)->first();

        if (!$chatSession) {
            return response()->json(['error' => 'Sesi chat tidak valid.'], 404);
        }

        $message = $chatSession->messages()->create([
            'sender' => 'visitor',
            'message' => $request->message,
            'is_read' => false
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
            'message' => $message
        ]);
    }

    public function pollMessages(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string',
            'last_id' => 'nullable|integer'
        ]);

        $chatSession = ChatSession::where('session_id', $request->session_id)->first();

        if (!$chatSession) {
            return response()->json(['messages' => []]);
        }

        $query = $chatSession->messages();

        if ($request->has('last_id') && $request->last_id > 0) {
            $query->where('sender', 'admin')->where('id', '>', $request->last_id);
        }

        $messages = $query->orderBy('id', 'asc')->get();

        // Mark as read
        if ($messages->count() > 0) {
            $chatSession->messages()->whereIn('id', $messages->pluck('id'))->update(['is_read' => true]);
        }

        return response()->json(['messages' => $messages]);
    }
}
