<?php
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/

	/*
	|--------------------------------------------------------------------------
	| Load Framework
	|--------------------------------------------------------------------------
	|
	*/
	require 'system/babar.php';
	require 'config.php';

	/*
	|--------------------------------------------------------------------------
	| Use Core Class
	|--------------------------------------------------------------------------
	|
	*/
	use system\Babar;


	/*
	|--------------------------------------------------------------------------
	| Use Helper Class
	|--------------------------------------------------------------------------
	|
	*/
	use system\helper\Request;
	use system\helper\Json;
	use system\helper\View;
	use system\db\DB;

	/*
	|--------------------------------------------------------------------------
	| Register Config
	|--------------------------------------------------------------------------
	|
	*/
	Babar::reg_config($config);

	/*
	|--------------------------------------------------------------------------
	| Set View Path
	|--------------------------------------------------------------------------
	|
	*/
	View::set_path(__DIR__.'/');

	/*
	|--------------------------------------------------------------------------
	| Routes
	|--------------------------------------------------------------------------
	|
	*/
	Babar::route('/',function(){
		$data['version'] = Babar::get_version();
		$data['load_time'] = Babar::get_load_time();
		View::render('sample_view', $data);
	});

	Babar::route('/testmysql',function(){
		$cfg = Babar::read_config('database');
		DB::init($cfg['default']);
		$iskonek = DB::$is_connect;
		echo $iskonek.'<br>';
		if($iskonek == 1)
		{
			$list = DB::query("select * from user")->fetchAll();

			print'<pre>';print_r($list);

			echo DB::disconnect();
		}
	});

	Babar::route('/testsqlsrv',function(){
		$cfg = Babar::read_config('database');
		DB::init($cfg['sqlsrv']);
		$iskonek = DB::$is_connect;
		echo $iskonek.'<br>';
		if($iskonek == 1)
		{
			$list = DB::query("select * from produk")->fetchAll();

			print'<pre>';print_r($list);

			echo DB::disconnect();
		}
	});

	/*
	|--------------------------------------------------------------------------
	| Run The Application
	|--------------------------------------------------------------------------
	|
	*/
	Babar::run();
