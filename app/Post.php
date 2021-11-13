<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id', 'user_id', 'content','image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
 
    public function comment()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }


    public static function defaultLiked($post, $user_auth_id)
    {
      // $defaultLiked = $post->likes->where('user_id', $user_auth_id)->first();

      $defaultLiked = 0;
      foreach ($post['likes'] as $key => $like) {
          if($like['user_id'] == $user_auth_id) {
            $defaultLiked = 1;
            break;
          }
      }

      return $defaultLiked;
    }


}
