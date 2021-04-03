<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	public function testReturnsTweet()
	{
		require 'Tweet.php';
	
		$tweet = new Tweet;

		$tweet->tid = 1;
		$tweet->handle = "Lundy";


		this->assertEquals($user->getLikeTweet()'Handle: Thomas Username: Williamson Password: Password BIO: Hello World');
	}

}
?>
