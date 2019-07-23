<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ConversationRepository;

class MessageController extends Controller
{
    private $repo;

    public function __construct(ConversationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $conversations =  $this->repo->getConversations($request->user()->id);
        $unread = $this->repo->unreadCount($request->user()->id);
        foreach ($conversations as $key => $conversation) {
            if(isset($unread[$conversation->id])){
                $conversation->unread = $unread[$conversation->id];
            }else {
                $conversation->unread = 0;
            }
        }

      

        return response()
        ->json([
            'conversations' => $conversations
        ]);
    }

    public function show(User $user, Request $request)
    {
        $messagesQuery = $this->repo->getMessagesFor($request->user()->id, $user->id);

        $count = null;

        if($request->get('before'))
        {
         $messagesQuery = $messagesQuery->where('created_at', '<', $request->get('before'));   
        }else{
            $count = $messagesQuery->count();
 
        }

        $messages =  $messagesQuery->limit(10)->get();

       foreach($messages as $message){
           if($message->read_at === null && $message->to_id === $request->user()->id){
               $this->repo->readAll( $message->from_id, $message->to_id);
               break;
           }
       }

        return [
            'messages' => array_reverse($messages->toArray()),
            'count' => $count
        ];
    }

    public function store(Request $request, User $user)
    {
      $message =  $this->repo->createMessage(
            $request->get('message'),
            $request->user()->id,
            $user->id
        );


        return [
            'message' => $message
        ];

    }
}
