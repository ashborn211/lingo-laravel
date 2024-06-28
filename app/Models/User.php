<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'last_seen',
    ];

    protected $dates = ['last_seen'];

    public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'recipient_id');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('created_at')
            ->withTimestamps();
    }

    public function isOnline()
    {
        return $this->last_seen !== null && $this->last_seen->diffInMinutes(Carbon::now()) <= 5;
    }

    public function markOnline()
    {
        $this->update(['last_seen' => now()]);
    }

    public function markOffline()
    {
        $this->update(['last_seen' => null]);
    }
}
