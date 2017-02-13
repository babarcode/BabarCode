<?php namespace system;
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/
	use system\Babar;

	class router
	{
		private static $root_uri = '/';
		private static $request_uri = '';
		private static $real_request_uri = '';
		private static $request_method = '';
		private static $routes = array();
		private static $_404_page = SYSTEM_VIEW_PATH.'/page_not_found'.VIEW_EXT;
		private static $_error_page = SYSTEM_VIEW_PATH.'/error'.VIEW_EXT;

		/*
		|--------------------------------------------------------------------------
		| Start Router
		|--------------------------------------------------------------------------
		|
		*/
		public static function start()
		{
			
			self::_start();
			
		}

		/*
		|--------------------------------------------------------------------------
		| Register Route
		|--------------------------------------------------------------------------
		| Parameter:
		| $uri => Page URL
		| $action => Callback Function
		|
		*/
		public static function register($uri,$action)
		{
			if($uri == '') $uri = "/";

			if($uri != '')
			{
				self::$routes[$uri] = $action;
			}
		}

		/*
		|--------------------------------------------------------------------------
		| Set 404 View
		|--------------------------------------------------------------------------
		|
		*/
		public static function set_404($page='')
		{
			if($page == '') self::$_404_page = SYSTEM_VIEW_PATH.'/page_not_found'.VIEW_EXT;

			if($page != '')
			{
				self::$_404_page = $page;
			}
		}

		/*
		|--------------------------------------------------------------------------
		| Start Router
		|--------------------------------------------------------------------------
		|
		*/
		private static function _start()
		{

			self::_set_root_uri();
			self::_set_request_uri();
			self::_set_real_request_uri();
			self::_set_request_method();
			self::run_route();

		}

		/*
		|--------------------------------------------------------------------------
		| Run Route
		|--------------------------------------------------------------------------
		|
		*/
		private static function run_route()
		{
			ob_start();
			
			$route = '';

			foreach (self::$routes as $key => $value) {

				$key = self::_route_regex($key);
				
				if(preg_match_all("/(?<route>".$key.")/",self::$real_request_uri,$match))
				{

					ob_clean();
					
					if($match['route'][0] == self::$real_request_uri){
						
						$value(Babar::set_end_time());
						
						exit;

					}

				}
			}

			ob_clean();
			Babar::set_end_time();

			$url = self::$request_uri;
			include self::$_404_page;
			
			exit;
		}

		/*
		|--------------------------------------------------------------------------
		| Route Regex
		|--------------------------------------------------------------------------
		|
		*/
		private static function _route_regex($route)
		{
			
			$pjg = strlen($route);
			if($pjg > 1)
			{
				if(substr($route,0,1) == "/")
				{
					$route = substr($route,1,($pjg-1));
				}
			}
			$route = str_replace("[:any]",".*",$route);
			$route = str_replace("[:num]","\d+",$route);
			$route = str_replace("[:string]","[a-zA-Z]+",$route);
			$route = str_replace("[:alphanum]","[a-zA-Z0-9]+",$route);
			$route = str_replace("/","\/",$route);
			return $route;

		}

		/*
		|--------------------------------------------------------------------------
		| Set Real Request Uri
		|--------------------------------------------------------------------------
		|
		*/
		private static function _set_real_request_uri()
		{
			self::$real_request_uri = str_replace(self::$root_uri,"",self::$request_uri);
			$pjg = strlen(self::$real_request_uri);
			if(substr(self::$real_request_uri,($pjg-1),1) == "/"){
				self::$real_request_uri = substr(self::$real_request_uri,0,($pjg-1));
			}
			if(self::$real_request_uri == "") self::$real_request_uri = "/";
		}

		/*
		|--------------------------------------------------------------------------
		| Start Request Method
		|--------------------------------------------------------------------------
		|
		*/
		private static function _set_request_method()
		{
			self::$request_method = $_SERVER['REQUEST_METHOD'];
		}

		/*
		|--------------------------------------------------------------------------
		| Set Request Uri
		|--------------------------------------------------------------------------
		|
		*/
		private static function _set_request_uri()
		{
			$req = $_SERVER['REQUEST_URI'];
			if(strpos($req,'?') > 0)
			{
				$_req = explode("?",$req);
				$req = $_req[0];
			}
			self::$request_uri = $req;
		}

		/*
		|--------------------------------------------------------------------------
		| Set Root Request Uri
		|--------------------------------------------------------------------------
		|
		*/
		private static function _set_root_uri()
		{
			$x = explode('/',$_SERVER['PHP_SELF']);
			if($x != null)
			{
				foreach ($x as $key => $value) {
				
					$ext = pathinfo($value, PATHINFO_EXTENSION);
				
					if($value == '' || $ext == 'php') continue;
				
					self::$root_uri .= $value.'/';
				
				}
			}
		}

		/*
		|--------------------------------------------------------------------------
		| Get Real Request Uri
		|--------------------------------------------------------------------------
		|
		*/
		public static function get_real_request_uri()
		{
			return self::$real_request_uri;
		}
	}