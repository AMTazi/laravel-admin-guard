<?php
/**
 * Created by PhpStorm.
 * User: naimo
 * Date: 4/2/19
 * Time: 2:34 PM
 */
return [

	'email' => env( 'SUPER_ADMIN_EMAIL', 'super-admin@example.com'),
	'password' => env( 'SUPER_ADMIN_PASSWORD', 'admin'),
	'moderator_default_password' => env( 'MODERATOR_DEFAULT_PASSWORD', 'password')

];