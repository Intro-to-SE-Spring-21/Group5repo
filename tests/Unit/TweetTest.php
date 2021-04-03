<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	public function testReturnsTweet()
	{
		require 'Tweet.php';
	
		$tweet = new Tweet;

		$tweet->tid = 1;
		$tweet->handle = "Thomas";
		$tweet->tweet_title = "Hello World";
		$tweet->content = "Hello my name is Thomas";
		$tweet->date_posted = "4/2/2021";
		$tweet->total_likes = 100;

		this->assertEquals('Handle: Thomas Username: Williamson Password: Password BIO: Hello World');
	}

}
?>
