<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        Log::info('STORE DIPANGGIL', [
            'user_id' => auth()->check() ? auth()->user()->id_user : 'guest',
            'request' => $request->all()
        ]);
        $request->validate([
            'to_id' => 'required|exists:users,id_user',
            'message' => 'required|string|max:1000',
        ]);

        $authId = auth()->user()->id_user;

        Log::info('Storing chat message', [
            'from_id' => $authId,
            'to_id' => $request->to_id,
            'message' => $request->message,
        ]);

        $message = Message::create([
            'from_id' => $authId,
            'to_id' => $request->to_id,
            'message' => $request->message,
        ]);

        Log::info('Chat message stored', ['message_id' => $message->id]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'sent', 'data' => $message]);
    }

    public function fetch($userId)
    {
        $authId = auth()->user()->id_user;

        $messages = Message::where(function ($q) use ($userId, $authId) {
            $q->where('from_id', $authId)->where('to_id', $userId);
        })->orWhere(function ($q) use ($userId, $authId) {
            $q->where('from_id', $userId)->where('to_id', $authId);
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }

    public function adminChat($userId = null)
    {
        $authId = auth()->id();
    
        // Ambil semua user selain admin yang punya role pasien
        $users = User::where('id_user', '!=', $authId)
                     ->where('role', 'pasien')
                     ->get();
    
        if ($userId) {
            $chatWith = User::where('id_user', $userId)->firstOrFail();
        } else {
            $chatWith = $users->first();
        }
    
        return view('admin.chatadmin', [
            'chatWith' => $chatWith,
            'users' => $users,
            'role' => 'admin',
        ]);
    }

    public function pasienChat()
    {
        $authId = auth()->user()->id_user;

        // Cari user dengan role 'admin'
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            abort(404, 'Admin tidak ditemukan');
        }

        return view('pasien.chatpasien', [
            'chatWith' => $admin,
            'role' => 'pasien',
            'users' => null, // jika tidak ingin tampilkan daftar user
        ]);
    }
}
