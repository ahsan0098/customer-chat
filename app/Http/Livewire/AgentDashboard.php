<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;

class AgentDashboard extends Component
{
    public $me;
    public $users;
    public $active;
    public $he = null;
    public $test = 1;
    public $message;
    public $chat;
    public $chat_number = null;
    public $invitebox;
    public $inviteagents;
    protected $listeners = ['confirmDeactivate'];
    public function mount()
    {
        $this->invitebox = false;
        $this->me = User::where('email', session('user_email'))->first();
        $this->me = $this->me->id;
        $this->users = Message::where(function ($query) {
            $query->where('status', '=', 1);
        })->where(
            function ($query) {
                $query->where('receiver_id', null)
                    ->orWhere('sender_id', $this->me)
                    ->orWhere('receiver_id', $this->me);
            }
        )->with('sender')->orderBy("created_at", "DESC")->groupBy('chat_number')->get();

        $this->users = json_decode($this->users, true);
        $this->inviteagents = User::where('type', "AGT")->get();
        $this->inviteagents = json_decode($this->inviteagents, true);
    }
    public function replyUser($id = null, $chat_num = null)
    {
        if ($id != null) {
            $this->he = $id;
        }
        if ($chat_num != null) {
            $this->chat_number = $chat_num;
        }
        $this->chat = Message::where('chat_number', $this->chat_number)->where('status', 1)->with('sender')->get();
        $this->chat = json_decode($this->chat, true);
    }
    public function sendMsg()
    {
        $message = new Message;
        $message->sender_id = $this->me;
        $message->receiver_id = $this->he;
        $message->message = $this->message;
        $message->chat_number = $this->chat_number;
        $this->test = $message;
        if ($message->save()) {
            $message = Message::where('sender_id', $this->he)->get();
            if ($message != []) {
                foreach ($message as $msg) {
                    $msg->receiver_id = $this->me;
                    $msg->save();
                }
            }
            $this->message = "";
        }
    }

    public function deactivateChat($id)
    {
        $this->dispatchBrowserEvent('swal:confirmDeactivate', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, Deactivate!',
            'id' => $id,

        ]);
    }
    public function confirmDeactivate($id)
    {
        $message = Message::where('chat_number', $id)->get();
        foreach ($message as $msg) {
            $msg->status = 0;
            $msg->save();
        }
    }

    public function booted()
    {
        $this->users = Message::where(function ($query) {
            $query->where('status', '=', 1);
        })->where(
            function ($query) {
                $query->where('receiver_id', null)
                    ->orWhere('sender_id', $this->me)
                    ->orWhere('receiver_id', $this->me);
            }
        )->with('sender')->orderBy("created_at", "DESC")->groupBy('chat_number')->get();
    }
    public function invitationMsg($id)
    {
        $this->invitebox = false;
        $message = new Message;
        $message->sender_id = $this->me;
        $message->receiver_id = $id;
        $message->message = "Hey agent help me to handle this customer";
        $message->chat_number = $this->chat_number;
        $message->save();
    }
    public function render()
    {
        return view('livewire.agent-dashboard')->layout('layouts.base');
    }
}
