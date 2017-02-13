<?php namespace system\db;
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/

	/*----------------------------------------------------------------------------
	 * AutoLoad Driver
	 *--------------------------------------------------------------------------*/
	require __DIR__.'/autoload.php';

	class DB
	{
	   /*-----------------------------------------------------------------------
		* Default driver : mysql
		*---------------------------------------------------------------------*/

		public static $config;
		public static $driver = 'mysql';
		public static $host;
		public static $db;
		public static $user;
		public static $password;
		public static $port = '';
		public static $is_connect;
		public static $auto_connect = true;
		private static $sql = '';
		private static $qry_result = null;
		private static $obj_driver = null;

		/*
		|--------------------------------------------------------------------------
		| INIT CONFIG
		|--------------------------------------------------------------------------
		|
		*/
		public static function init($config=array())
		{
			self::$config = $config;
			if(array_key_exists('driver',$config)) self::$driver = $config['driver'];
			if(array_key_exists('auto_connect',$config)) self::$auto_connect = $config['auto_connect'];
			if(self::$auto_connect) self::connect();
		}


		/*
		|--------------------------------------------------------------------------
		| CONNECT DB
		|--------------------------------------------------------------------------
		|
		*/
		public static function connect()
		{
			self::$obj_driver = self::_driver_factory();
			if(self::$obj_driver != null)
			{
				self::$is_connect = self::$obj_driver->connect();
			}
		}


		/*
		|--------------------------------------------------------------------------
		| DISCONNECT DB
		|--------------------------------------------------------------------------
		|
		*/
		public static function disconnect()
		{
			$ok = 0;

			if(self::$is_connect == 1)
			$ok = self::$obj_driver->disconnect();
			
			return $ok;
		}


		/*
		|--------------------------------------------------------------------------
		| DB QUERY
		|--------------------------------------------------------------------------
		|
		*/
		public static function query($sql='')
		{
			$qry = null;

			if(self::$is_connect == 1){
				self::$sql = $sql;
				$qry = self::$obj_driver->query(self::$sql);
			}

			self::$qry_result = $qry;

			return self::$obj_driver;

		}


		/*
		|--------------------------------------------------------------------------
		| DRIVER FACTORY
		|--------------------------------------------------------------------------
		|
		*/
		private static function _driver_factory()
		{

			$obj = null;

			$driver = self::$driver;
			
			$obj = new $driver(self::$config);

			return $obj;

		}
	}