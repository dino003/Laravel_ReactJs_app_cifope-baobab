<?php

namespace App\Repositories;

use App\User;
use Carbon\Carbon;
use App\Messagerie;


class ConversationRepository
{
    private $user;

    private $message;

    public function __construct(User $user, Messagerie $message)
    {
        $this->user = $user;
        $this->message = $message;
    }


    public function getConversations($userId)
    {
        $conversations =  $this->user->newQuery()
        ->where('id', '!=', $userId)
        ->get();

        

        return $conversations;
        
    }

    public function createMessage($message, $from, $to)
    {
       return  $this->message->newQuery()->create([
            'message' =>$message,
            'from_id' =>$from,
            'to_id' => $to
        ]);
    }

    public function getMessagesFor(int $from, int $to)
    {
        return $this->message->newQuery()
        ->whereRaw("((from_id = $from AND to_id = $to) OR (from_id = $to AND to_id = $from))")
        ->orderBy('created_at', 'DESC')
        ->with('user');
    }

    public function unreadCount(int $userId)
    {
        return $this->message->newQuery()
        ->where('to_id', $userId)
        ->groupBy('from_id')
        ->selectRaw('from_id, COUNT(id) as count')
        ->whereRaw('read_at IS NULL')
        ->get()
        ->pluck('count', 'from_id');
    }

    public function readAll($from, $to)
    {
        $this->message->where('from_id', $from)
        ->where('to_id', $to)
        ->update(['read_at' => Carbon::now()]);
    }
}