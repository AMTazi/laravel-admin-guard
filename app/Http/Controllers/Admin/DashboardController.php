<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class DashboardController extends Controller
{

	public function __construct() {

		$this->middleware( ['auth:admin']);
	}

	public function index() {

		return view('admin.dashboard');
	}

	public function account() {

		return view('admin.account');

	}

	public function addModerator(Request $request) {

		if (!$request->user('admin')->isSuperAdmin())
			throw new UnauthorizedException(__("You're not allowed to perform this action"), Response::HTTP_UNAUTHORIZED);


		$data = $this->validateModeratorCredentials( $request );

		$this->createNewModerator( $data );

		return redirect(route('admin.dashboard'));

	}

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	protected function validateModeratorCredentials( Request $request ) {

		return $request->validate( [
			'name'  => 'required|string|min:6',
			'email' => 'required|email|unique:admins,email'
		] );

	}

	/**
	 * @param $data
	 *
	 * @return Admin
	 */
	protected function createNewModerator( array $data ): Admin {

		return Admin::create( array_merge( $data, [
			'password' => Hash::make( config( 'admin.moderator_default_password' ) )
		] ) );

	}
}
