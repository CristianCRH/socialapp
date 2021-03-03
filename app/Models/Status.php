<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;
    protected $guarded=[];
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function like(){
        $this->likes()->firstOrCreate([
            'user_id'=>auth()->id(),
        ]);
    }



    public function unlike(){
        $this->likes()->where([
            'user_id'=>auth()->id(),
        ])->delete();
    }


    public function isLiked(){
        return $this->likes()->where('user_id',auth()->id())->exists();
    }


    public function likesCount(){
      return   $this->likes()->count();
    }
}
