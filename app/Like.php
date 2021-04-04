<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Like
{

	//@var int

  public $tid;

	//@var string

  public $handle;

	public function LikeInfo()
	{
		return $this->handle . " liked tweetid " . $this->tid;
}
?>
