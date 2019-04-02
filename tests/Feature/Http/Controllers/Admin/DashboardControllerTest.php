<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{

	use DatabaseTransactions;

	/** @test */

	function it_should_show_dashboard_view()
	{
	    $this->get( route( 'admin.dashboard'))->assertSee( 'Dashboard');
	}

	/** @test */
	function it_should_show_account_view()
	{
		$this->get( route( 'admin.dashboard'))->assertSee( 'Account');
	}


	/** @test */

	function it_should_add_new_moderator()
	{
		$admin = Admin::where('email', config('admin.email'))->first();

		Auth::guard('admin')->login($admin);

		$data = [
			'name' => "New moderator name",
			'email' => "moderator@email.com"
		];

		$this->post( route('admin.dashboard.add_moderator'), $data)->assertRedirect(route('admin.dashboard'));

		$this->assertTrue( Admin::where('email',$data['email'])->exists());

		$this->assertCount( 2, Admin::all());

	}

}
