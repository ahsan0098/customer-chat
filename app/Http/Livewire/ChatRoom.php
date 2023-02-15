<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;

class ChatRoom extends Component
{
    public $test = "ahsan";
    public $me;
    public $agent;
    public $users;
    public $chat;
    public $chat_number;
    public $message;
    public function mount()
    {
        $this->me = User::where('email', session('user_email'))->first();
        $this->me = $this->me->id;
        $this->users = Message::where(function ($query) {
            $query->where('status', '=', 1);
        })->where(
            function ($query) {
                $query->orWhere('sender_id', $this->me)
                    ->orWhere('receiver_id', $this->me);
            }
        )->with('sender')->orderBy("created_at", "ASC")->get();
        $this->chat = json_decode($this->users, true);
        foreach ($this->chat as $ct) {
            $this->chat_number = $ct['chat_number'];
            break;
        }
    }
    public function replyUser()
    {

        $this->users = Message::where('status', '=', 1)->where(
            function ($query) {
                $query->orWhere('sender_id', $this->me)
                    ->orWhere('chat_number', $this->chat_number);
            }
        )->where('message', '!=', 'Hey agent help me to handle this customer')->with('sender')->orderBy("created_at", "ASC")->get();
        $this->chat = json_decode($this->users, true);
        foreach ($this->chat as $ct) {
            $this->chat_number = $ct['chat_number'];
            $this->agent = $ct['receiver_id'];
            break;
        }
    }
    public function sendMsg()
    {
        if ($this->chat == []) {
            $chat_num = rand(10, 10000);
            $cht = Message::where('chat_number', $chat_num)->first();
            if ($cht == []) {
                $message = new Message;
                $message->sender_id = $this->me;
                $message->message = $this->message; //here chat is new
                $message->chat_number = $chat_num;
                $message->save();
            } else {
                $chat_num = rand(10, 10000);
                $cht = Message::where('chat_number', $chat_num)->first();
                if ($cht == ![]) {
                    $message = new Message;
                    $message->sender_id = $this->me;
                    $message->message = $this->message; //here chat is active
                    $message->chat_number = $chat_num;
                    $message->save();
                }
            }
        } else {
            $message = new Message;
            $message->sender_id = $this->me;
            $message->receiver_id = $this->agent;
            $message->message = $this->message;
            $message->chat_number = $this->chat_number;
            $message->save();
        }
        $this->message = "";
    }
    public function render()
    {
        return view('livewire.chat-room');
    }
}
