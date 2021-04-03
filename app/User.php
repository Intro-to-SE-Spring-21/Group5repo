<?php

class User
{

	//@var string

  public $handle;

	//@var string

  public $username;

	//@var string

  public $password;
	
	//@var string

  public $bio;

	//@return string

	public function getProfile()
	{
		return "Handle: $this->handle Username: $this->username Password: $this->password BIO: $this->bio ";
	}
}
?>
