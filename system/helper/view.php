<?php namespace system\helper;
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/
	use system\Babar;

	class View{

		private static $ext = '.php';
		private static $path = '';

		/*
		|--------------------------------------------------------------------------
		| Set View Extension
		|--------------------------------------------------------------------------
		|
		*/
		public static function set_extension($ext='.php')
		{
			self::$ext = $ext;
		}

		/*
		|--------------------------------------------------------------------------
		| Set View Path
		|--------------------------------------------------------------------------
		|
		*/
		public static function set_path($path='')
		{
			self::$path = $path;
		}

		/*
		|--------------------------------------------------------------------------
		| Render View
		|--------------------------------------------------------------------------
		|
		*/
		public static function render($tpl,$data = null)
		{
		
			$file = self::$path.$tpl.self::$ext;

			if(file_exists($file))
			{
				if(is_array($data))
				{
					extract($data);
				}

				require $file;
			}
			else
			{
				echo 'Template '.$file.' tidak ditemukan!';
				exit;
			}

		}

	}
