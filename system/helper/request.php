<?php namespace system\helper;
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/
	use system\router;

	class Request{

		/*
		|--------------------------------------------------------------------------
		| GET Variables
		|--------------------------------------------------------------------------
		|
		*/
		public static function get($name='')
		{
			$param = $_GET;
			if($name != ''){
				if(isset($_GET[$name])) $param = $_GET[$name];
			} 
			return $param;
		}

		/*
		|--------------------------------------------------------------------------
		| Is GET?
		|--------------------------------------------------------------------------
		|
		*/
		public static function is_get()
		{
			$return = false;
			if(self::server('REQUEST_METHOD') == 'GET'){
				$return = true;
			} 
			return $return;
		}

		/*
		|--------------------------------------------------------------------------
		| POST Variables
		|--------------------------------------------------------------------------
		|
		*/
		public static function post($name='')
		{
			$param = $_POST;
			if($name != ''){
				if(isset($_POST[$name])) $param = $_POST[$name];
			} 
			return $param;
		}

		/*
		|--------------------------------------------------------------------------
		| Is POST?
		|--------------------------------------------------------------------------
		|
		*/
		public static function is_post()
		{
			$return = false;
			if(self::server('REQUEST_METHOD') == 'POST'){
				$return = true;
			} 
			return $return;
		}

		/*
		|--------------------------------------------------------------------------
		| SERVER Variables
		|--------------------------------------------------------------------------
		|
		*/
		public static function server($name='')
		{
			$param = $_SERVER;
			if($name != ''){
				if(isset($_SERVER[$name])) $param = $_SERVER[$name];
			} 
			return $param;
		}

		/*
		|--------------------------------------------------------------------------
		| Header Variables
		|--------------------------------------------------------------------------
		|
		*/
		public static function header($name='')
		{
			$param = getallheaders();
			if($name != '')
			{
				if(isset($param[$name])) $param = $param[$name];
			}
			return $param;
		}

		/*
		|--------------------------------------------------------------------------
		| GET CURRENT URI
		|--------------------------------------------------------------------------
		|
		*/
		public static function uri()
		{
			return router::get_real_request_uri();
		}

		/*
		|--------------------------------------------------------------------------
		| GET URI SEGMENT
		|--------------------------------------------------------------------------
		|
		*/
		public static function uri_segment($ke='')
		{
			$uri = self::uri();
			$uri_segment[1] = $uri;

			if(strpos($uri,'/') > 0)
			{
				$i = 1;
				foreach (explode("/",$uri) as $key => $value) {
					$uri_segment[$i] = $value;
					$i++;
				}
			}

			if($ke != '' && $ke > 0)
			{
				if(isset($uri_segment[$ke]))
				{
					$uri_segment = $uri_segment[$ke];
				}
				else
				{
					$uri_segment = '';
				}
			}

			return $uri_segment;
		}

	}