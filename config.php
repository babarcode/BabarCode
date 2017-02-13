<?php
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/

	/*
	|--------------------------------------------------------------------------
	| Database Config
	|--------------------------------------------------------------------------
	|
	*/
	$config['database']['default'] = array(
		'host' => 'localhost',
		'db' => 'test',
		'user' => 'root',
		'password' => '',
		'port' => 3306,
		'driver' => 'mysql'
	);

	$config['database']['sqlsrv'] = array(
		'host' => 'localhost',
		'db' => 'OTOMAX_FREE',
		'user' => 'sa',
		'password' => 'integrity',
		'driver' => 'sqlsrv'
	);