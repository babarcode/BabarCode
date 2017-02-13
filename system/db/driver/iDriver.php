<?php namespace system\db\driver;
	/*----------------------------------------------------------------------------
	 *	BabarCode
	 *	a super micro PHP Framework
	 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
	 *--------------------------------------------------------------------------*/
	interface iDriver
	{

	   /*-----------------------------------------------------------------------
		* Method List For Drivers
		*---------------------------------------------------------------------*/
		function __construct($config = array());
		public function connect();
		public function disconnect();
		public function select($field = '*',$tbl = '');
		public function where($field = '',$opr= '=', $value = '');
		public function whereRaw($where = '');
		public function query($sql='');
		public function result();
		public function fetchAll();
		public function first();

	}