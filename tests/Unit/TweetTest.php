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

		$this->assertEquals($user->getTweet(), "Tid: 1 Handle: Thomas Tweet_title: Hello World Content: Hello my name is Thomas Date_posted: 4/2/2021 Total_likes: 100");
	}

}
?>
