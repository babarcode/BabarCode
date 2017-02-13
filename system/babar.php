<?php namespace system;
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/

	/*----------------------------------------------------------------------------
	 * Initial Load
	 *--------------------------------------------------------------------------*/
	require __DIR__.'/autoload.php';
	use system\router;

	class Babar
	{
		private static $versi;
		private static $_error_page = SYSTEM_VIEW_PATH.'/error'.VIEW_EXT;
		private static $start_time;
		private static $end_time;
		private static $load_time;
		private static $config = array();

		/*
		|--------------------------------------------------------------------------
		| Register Route
		|--------------------------------------------------------------------------
		|
		*/
		public static function route($uri,$action)
		{
			router::register($uri,$action);
		}

		/*
		|--------------------------------------------------------------------------
		| Run Application
		|--------------------------------------------------------------------------
		|
		*/
		public static function run()
		{

			self::_run();
		
		}

		/*
		|--------------------------------------------------------------------------
		| Set Custom 404 Page
		|--------------------------------------------------------------------------
		|
		*/
		public static function set_404($page='')
		{
			router::set_404($page);
		}

		/*
		|--------------------------------------------------------------------------
		| Get BabarPHP Version
		|--------------------------------------------------------------------------
		|
		*/
		public static function get_version()
		{
			return self::$versi;
		}

		/*
		|--------------------------------------------------------------------------
		| Set Start Time
		|--------------------------------------------------------------------------
		|
		*/
		private static function _set_start_time()
		{
			self::$start_time = microtime();
		}

		/*
		|--------------------------------------------------------------------------
		| Set End Time
		|--------------------------------------------------------------------------
		|
		*/
		public static function set_end_time()
		{
			self::$end_time = microtime();
			self::_set_load_time();
		}

		/*
		|--------------------------------------------------------------------------
		| Set Load Time
		|--------------------------------------------------------------------------
		|
		*/
		private static function _set_load_time()
		{
			self::$load_time = round(self::$end_time - self::$start_time,4);
		}

		/*
		|--------------------------------------------------------------------------
		| Get Load Time
		|--------------------------------------------------------------------------
		|
		*/
		public static function get_load_time()
		{
			return self::$load_time;
		}

		/*
		|--------------------------------------------------------------------------
		| Set BabarPHP Version
		|--------------------------------------------------------------------------
		|
		*/
		private static function _set_version()
		{
			self::$versi = VERSI;
		}

		/*
		|--------------------------------------------------------------------------
		| Run Application
		|--------------------------------------------------------------------------
		|
		*/
		private static function _run()
		{
			self::_set_start_time();
			self::_set_version();
			router::start();
		}

		/*
		|--------------------------------------------------------------------------
		| Register Config
		|--------------------------------------------------------------------------
		|
		*/
		public static function reg_config($config = array())
		{
			self::$config = $config;
		}

		/*
		|--------------------------------------------------------------------------
		| Read Config
		|--------------------------------------------------------------------------
		|
		*/
		public static function read_config($index = '')
		{
			$config = self::$config;
			if($index != '')
			{
				$config = null;
				if(array_key_exists($index,self::$config))
				{
					$config = self::$config[$index];
				}
			}
			return $config;
		}

	}