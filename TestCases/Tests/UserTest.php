
<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	public function testReturnsProfile()
	{
		require 'User.php';
	
		$user = new User;

		$user->handle = "Thomas";
		$user->username = "Williamson";
		$user->password = "Password";
		$user->bio = "Hello World";

		$this->assertEquals('Handle: Thomas Username: Williamson Password: Password BIO: Hello World')
	}

}
?>
