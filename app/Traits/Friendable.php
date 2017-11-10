<?php

namespace App\Traits;
use App\Friendship;

trait Friendable
{
	public function test()
	{
		return 'hi';
	}

	public function addfriend($user_id)
	{

      $Friendship = Friendship::create([
        
         'requester' => $this->id,
         'user_requested' => $user_id,

      	]);

      if($Friendship)
      {
      	return $Friendship;
      }
      return 'failed';
	}
}




?>