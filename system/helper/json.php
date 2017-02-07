<?php namespace system\helper;
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/

	class Json{

		/*
		|--------------------------------------------------------------------------
		| Json Encode
		|--------------------------------------------------------------------------
		|
		*/
		public static function encode($text)
		{
			return json_encode($text);
		}

		/*
		|--------------------------------------------------------------------------
		| Json Decode
		|--------------------------------------------------------------------------
		|
		*/
		public static function decode($text)
		{
			return json_decode($text);
		}

	}
