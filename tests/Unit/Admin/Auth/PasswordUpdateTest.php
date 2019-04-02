<?php

namespace Tests\Unit\Admin\Auth;

use App\Admin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception\InvalidArgumentException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordUpdateTest extends TestCase
{

	use DatabaseTransactions;

	/** @test */

	function it_should_update_admin_password()
	{
	    $admin = factory(Admin::class)->create();

	    Admin::updatePassword( $admin, 'password', 'secret');

	    $this->assertFalse(Hash::check( 'password', $admin->password));

	    $this->assertTrue(Hash::check( 'secret', Admin::find($admin->id)->password));
	}

	/** @test */

	function it_should_throw_an_exception_when_the_old_password_is_wrong()
	{
		$admin = factory(Admin::class)->create();

		$this->expectException(InvalidArgumentException::class);

		Admin::updatePassword( $admin, 'password2', 'secret');

	}

}
