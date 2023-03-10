<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class);
    }
    // public function chat_fetch()
    // {
    //     return $this->belongsTo(User::class);
    // }
    use HasFactory;
}
