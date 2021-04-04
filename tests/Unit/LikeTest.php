<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	public function testReturnsTweet()
	{
		require 'Tweet.php';
	
		$like = new like;

		$like->tid = 1;
		$like->handle = "Lundy";


		this->assertEquals($user->LikeInfo() 'Lundy liked tweetid 1');
	}
}
?>
