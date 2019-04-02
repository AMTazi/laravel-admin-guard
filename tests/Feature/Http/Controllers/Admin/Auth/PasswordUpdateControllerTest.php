<?php

namespace Tests\Feature\Http\Controllers\Admin\Auth;

use App\Admin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordUpdateControllerTest extends TestCase
{
    use DatabaseTransactions;


    /** @test */

    function it_should_update_admin_password()
    {

    	$admin = factory(Admin::class)->create();

    	Auth::guard('admin')->login($admin);

        $this->post( route( 'admin.auth.password.update'),[
        	'old_password' => 'password',
	        'password' => 'secret_password',
	        'password_confirmation' => 'secret_password'
        ])->assertRedirect(route('admin.account'));

        $this->assertTrue(Hash::check( 'secret_password', Admin::find($admin->id)->password));
    }

}
