<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','status','content'];


    public function user()
    {
    	return $this->belongsTo(User::class);
    }

     public function like()
    {
        return $this->hasMany(Like::class);
    }

      public function comment()
    {
        return $this->hasMany(comment::class);
    }
}
