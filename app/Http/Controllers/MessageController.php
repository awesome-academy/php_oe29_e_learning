<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageEvent;
use App\Repositories\Advisor\AdvisorRepositoryInterface;
use App\Repositories\Message\MessageRepositoryInterface;
use Auth;

class MessageController extends Controller
{
    protected $advisorRepo, $messageRepo;

    public function __construct(AdvisorRepositoryInterface $advisorRepo, MessageRepositoryInterface $messageRepo)
    {
        $this->advisorRepo = $advisorRepo;
        $this->messageRepo = $messageRepo;
    }

    public function getMessages($id)
    {
        $receiveId = Auth::id();
        $messages = $this->messageRepo->getMessageBetweenUser($id, $receiveId);
        $this->messageRepo->updateWithWhere([['from_id', $id], ['to_id', $receiveId]], ['is_read' => config('message.read')]);

        return view('layouts.message', compact('messages', 'id'));
    }

    public function sendMessage(Request $request)
    {
        $fromId = Auth::id();
        $toId = $request->receiver_id;
        $message = $request->message;
        $newMessage = $this->messageRepo->create([
            'from_id' => $fromId,
            'to_id' => $toId,
            'message' => $message,
            'is_read' => config('message.unread'),
        ]);
        $this->messageRepo->updateWithWhere([['from_id', $toId], ['to_id', $fromId]], ['is_read' => config('message.read')]);
        $data = [
            'from_id' => $fromId, 
            'to_id' => $toId, 
            'content' => $message,
            'created_at' => date('d M y, h:i a', strtotime($newMessage->created_at)),
        ];
        event(new MessageEvent($data));

        return response()->json($data);
    }
}
