<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "users";
    public function getUser()
    {
        return $this->hasMany('App\models\Message', 'sender_id');
    }
    public function getUser2()
    {
        return $this->hasMany('App\models\Message', 'receiver_id');
    }

    protected $fillable = ['name', 'email', 'password', 'google_id'];
}
