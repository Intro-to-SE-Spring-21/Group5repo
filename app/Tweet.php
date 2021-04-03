<?php

class Tweet
{

	//@var int

  public $tid;

	//@var string

  public $handle;

	//@var string

  public $tweet_title;
	
	//@var string

  public $content;
	
	//@var date

  public $date_posted;

	//@var int

  public $total_likes;


	public function getTweet()
	{
		return " Tid: " . $this->tid . " Handle: " . $this->handle " Tweet_title: " . $this->tweet_title . " Content: " . $this->content . " Date_posted: " $this->date_posted . " Total_likes: " . $this->total_likes";
	}
}
?>
