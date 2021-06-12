<?php

namespace App\Models;

use App\Models\User;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    /**
     * Particular user cannot like a post more than once
    */
    public function likedBy(User $user)  # Altered from, likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); # Altered from, contains('user_id', $user->id);
    }

    // Below was moved to a post policy (PostPolicy.php)
    // public function ownedBy(User $user)  
    // {
    //     return $user->id == $this->user_id;
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
