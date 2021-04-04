<?php

namespace tests/Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use app\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	use DatabaseMigrations;
	public function testReturnsProfile()
	{
		require 'User.php';
	
		$user = new User;

		$user->handle = "Thomas";
		$user->username = "Williamson";
		$user->password = "Password";
		$user->bio = "Hello World";

		$this->assertEquals($user->getProfile(), 'Handle: Thomas Username: Williamson Password: Password BIO: Hello World');
	}

}
?>
