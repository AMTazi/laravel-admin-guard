<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;

class PasswordUpdateController extends Controller
{
    public function __construct() {

        $this->middleware(['auth:admin']);

    }

	public function updatePassword( Request $request )
	{


		$data = $request->validate([
			'old_password' => 'required|string',
			'password' =>  'required|string|min:8|confirmed',
		]);


		if ($updated = Admin::updatePassword($request->user('admin'), $data['old_password'],$data['password'])) {

			// TODO flash message:success
			return redirect(route( 'admin.account'));

		}

		// TODO flash message:error
		return redirect()->back();

    }
}
