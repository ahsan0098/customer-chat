<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $me;
    public $users;
    public $he = null;
    public $test = 1;
    public $test1 = [];
    public $message;
    public $chat;
    public $alert = 1;
    public $chat_number = null;
    public $chat_status = true;
    public $test2;
    protected $listeners = ['confirmDelete', 'confirmDeactivate'];
    public function mount()
    {
        $this->me = User::where('email', session('user_email'))->first();
        $this->me = $this->me->id;
        $this->test = Message::with('sender')->orderBy("created_at", "DESC")->groupBy('chat_number')->get();
        $this->test = json_decode($this->test, true);
        foreach ($this->test as $i => $user) {

            if ($user['receiver_id'] != null) {
                $this->test1 = User::where('id', $user['receiver_id'])->first();
                $this->test1 = json_decode($this->test1, true);
                $user['agent'] = $this->test1['name'];
            } else {
                $user['agent']  = "Not replied";
            }
            $this->test1 = $user['agent'];
        }
        $this->users = $this->test;
    }
    public function replyUser($id = null, $chat_num = null)
    {
        if ($id != null) {
            $this->he = $id;
        }

        if ($chat_num != null) {
            $this->test2 = $this->chat_number = $chat_num;
        }
        $agent = User::where('id', $this->he)->first();
        $this->test1 = $agent = json_decode($agent, true);
        // $this->test1 = $this->test1;
        // $this->test1 = $this->test1['name'];  here in want to add agent name in chat
        $this->chat = Message::where('chat_number', $this->chat_number)->with('sender')->get();
        $this->chat = json_decode($this->chat, true);
        foreach ($this->chat as $ct) {
            $this->chat_status = $ct['status'];
        }
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
            $this->message = "";
        }
    }
    public function confirmDeactivate($id)
    {
        $message = Message::where('chat_number', $id)->get();
        foreach ($message as $msg) {
            $msg->status = 0;
            if ($msg->save()) {
                $this->test1 = $message;
            }
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
    public function deleteChat($id)
    {
        $this->dispatchBrowserEvent('swal:confirmDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $id,

        ]);
    }
    public function confirmDelete($id)
    {
        // $this->alert = $id;
        $message = Message::where('chat_number', $id)->get();
        foreach ($message as $msg) {
            if ($msg->delete()) {
                $this->test1 = $message;
            }
        }
    }
    public function booted()
    {
        $this->test = Message::with('sender')->orderBy("created_at", "DESC")->groupBy('chat_number')->get();

        $this->test = json_decode($this->test, true);
        // foreach ($this->test as $i => $user) {

        //     if ($user['receiver_id'] != null) {
        //         $this->test1 = User::where('id', $user['receiver_id'])->first();
        //         // $this->test1 = json_decode($this->test1, true);
        //         $this->test1 = $this->test1->name;
        //     } else {
        //         $user['agent']  = "Not replied";
        //     }
        //     // $this->test1 = $user['agent'];
        // }
        $this->users = $this->test;
    }
    public function render()
    {
        return view('livewire.admin-dashboard')->layout('layouts.base');
    }
}
