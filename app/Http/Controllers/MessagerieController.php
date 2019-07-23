<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ConversationRepository;

class MessagerieController extends Controller
{
    private $repo;
    private $auth;

    public function __construct(ConversationRepository $repo, AuthManager $auth)
    {
       $this->repo = $repo; 
       $this->auth = $auth;
    }
    public function index()
    {
        return view('conversations.index');
    }


    public function show(User $user)
    {
        $me = $this->auth->user();
        $unread = $this->repo->unreadCount($me->id);
        $messages = $this->repo->getMessagesFor($me->id, $user->id)->paginate(50);
       
            if(isset($unread[$user->id]))
            {
                $this->repo->readAll($user->id, $me->id);
               unset($unread[$user->id]); 
            }

        return view('conversations.show', [
            'users' => $this->repo->getConversations($me->id),
            'user' => $user,
            'unread' => $unread,

            'messages' => $messages
 
        ]);
    }

    public function store(Request $request, User $user)
    {
        $this->repo->createMessage(
            $request->get('message'),
            $this->auth->user()->id,
            $user->id
        );

        return redirect(route('tchat_prive', ['id' => $user->id]));

    }
}
