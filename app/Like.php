<?php
class Tweet
{

  public $tid;

	//@var int

  public $handle;
	//@var string

	public function getLikeTweet()
	{
		return " Tid: " . $this->tid . " Liked by " . $this->handle;
	}
}
?>
