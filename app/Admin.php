<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception\InvalidArgumentException;


class Admin extends Authenticatable
{
	use Notifiable;

	const SUPER_ADMIN_LEVEL = 1;

	const MODERATOR_LEVEL = 2;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'role_level'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * Update current admin password
	 *
	 * @param Admin $admin
	 * @param string $old_password
	 * @param string $password
	 *
	 * @return bool
	 */
	public static function updatePassword(Admin $admin, string $old_password, string $password ) : bool
	{

		if (Hash::check( $old_password, $admin->password)) {

			return $admin->update(['password' => Hash::make( $password)]);

		}

		throw new InvalidArgumentException(__('You entered invalid Old password'));

	}

	public function isSuperAdmin() {
		return $this->role_level === self::SUPER_ADMIN_LEVEL;
	}
}
