<?php

namespace Tests\Feature\Http\Controllers\Admin\Auth;

use App\Admin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
	use DatabaseTransactions;
    /** @test */

    function it_should_show_admin_login_form()
    {
        $this->get(route('admin.auth.show_login_form'))
             ->assertSeeInOrder([
	             __('E-Mail Address'),
	             __('Password'),
	             __('Remember Me'),
	             __('Login'),
//	             __('Forgot Your Password?')
             ]);
    }

    /** @test */

    function it_should_login_the_admin()
    {
    	$admin = factory(Admin::class)->create();

        $this->post( route( 'admin.auth.login'), [
        	'email' => collect($admin)->get( 'email'),
	        'password' => 'password'
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs( $admin, 'admin');
    }

    /** @test */

    function it_should_set_remember_me_to_true()
    {
	    $admin = factory(Admin::class)->create(['remember_token' => '']);

	    $this->post( route( 'admin.auth.login'), [
		    'email' => $admin->email,
		    'password' => 'password',
		    'remember' => true
	    ])->assertRedirect(route('admin.dashboard'));

	    $this->assertNotEmpty( Admin::find($admin->id)->remember_token);
	    
    }



}
