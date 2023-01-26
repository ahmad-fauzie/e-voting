<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\MessageDelete;
use App\Models\Message;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $messages = Message::all();
        $kandidats = Kandidat::where('id', $id)->first();
        return view('qna.detail', ['id' => $id, 'kandidats' => $kandidats, 'messages' => $messages] );
    }


    public function showKandidat()
    {
        $allKandidats = Kandidat::all();
        $allMessages = Message::all();
        $kandidats = $allKandidats->map(function($user, $key){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'nis' => $user->nis,
                'kelas' => $user->kelas,
                'jurusan' => $user->jurusan,
                'visi' => $user->visi,
                'misi' => $user->misi,
                'foto' => $user->foto,
                'messages' => Message::where('kandidat_id', $user->id)->count()
            ];
        });
        return view('qna.index', compact('kandidats'));
    }


    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'kandidat_id' => $request->input('kandidat_id'),
            'group_id' => $request->input('group_id'),
        ]);

        $message = Message::find($message->id);

        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }

    public function deleteMessage(Request $request){
        $user = Auth::user();
        $message = Message::find($request->input('id'));
        if (!$message) {
            return ['status' => $request];
        }
        broadcast(new MessageDelete($user, $message))->toOthers();
        $message->delete();
        return ['status' => 'Message Deleted!'];
    }

    public function deleteMessageGroup(Request $request){
        $user = Auth::user();
        $group_id = $request->input('group_id');
        $messages = Message::where('group_id', $group_id)->get();
        $messages->each(function($message) use($user) {
            broadcast(new MessageDelete($user, $message))->toOthers();
            $message->delete();
        });
        return ['status' => 'Message Group Deleted!'];
    }

    public function deleteMessageAll(Request $request){
        $user = Auth::user();
        $kandidat_id = $request->id;
        $messages = Message::where('kandidat_id', $kandidat_id)->get();
        $messages->each(function($message) use($user) {
            broadcast(new MessageDelete($user, $message))->toOthers();
            $message->delete();
        });
        return response()->json([
            'status' => 200,
        ]);
    }
}
