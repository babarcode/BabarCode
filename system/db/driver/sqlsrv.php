<?php
/*----------------------------------------------------------------------------
 *	BabarCode
 *	a super micro PHP Framework
 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
 *--------------------------------------------------------------------------*/
use system\db\driver\iDriver;

class sqlsrv implements iDriver
{
	
	public $host;
	public $db;
	public $user;
	public $password;
	public $port = '1542';
	public $connection;
	public $is_connect;
	public $auto_connect = true;
	private $sql = '';
	private $qry_result = null;

	function __construct($config=array())
	{
		$this->_init($config);
	}

	private function _init($config = array())
	{
		$this->host = $config['host'];
		$this->db = $config['db'];
		$this->user = $config['user'];
		$this->password = $config['password'];
		if(array_key_exists('port',$config))
		{ 
			$this->port = $config['port'];
			$this->host = $this->host.','.$this->port;
		}
		if(array_key_exists('auto_connect',$config)) $this->auto_connect = $config['auto_connect'];
	}

	public function connect()
	{
		$connInfo = array('Database' => $this->db, 'UID' => $this->user, 'PWD' => $this->password);
		$this->connection = sqlsrv_connect($this->host, $connInfo);
		
		if($this->connection){
			$this->is_connect = 1;
		}
		else{
			$this->is_connect = 0;

		}

		return $this->is_connect;
	}

	public function disconnect()
	{
		$ok = 0;

		if($this->is_connect == 1)
		if(sqlsrv_close($this->connection)) $ok = 1;
		
		return $ok;
	}

	public function select($field = '*',$tbl = '')
	{
		$this->sql = "SELECT {$field} FROM {$tbl} WHERE 1=1 ";

		return $this;
	}

	public function where($field = '',$opr= '=', $value = '')
	{

		$this->sql .= " AND {$field} {$opr} {$value}";

		return $this;
	}

	public function whereRaw($where = '')
	{
		
		$this->sql .= " AND {$where}";

		return $this;
	}

	public function query($sql='')
	{
		$qry = null;

		if($this->is_connect == 1){
			$this->sql = $sql;
			$qry = sqlsrv_query($this->connection,$this->sql);
		}

		$this->qry_result = $qry;

		return $this;
	}

	public function result()
	{
		$result = null;

		if($this->is_connect == 1){

			$result = $this->qry_result;

		}
		
		return $result;
	}

	public function fetchAll()
	{
		$result = null;

		if($this->is_connect == 1){

			if($this->qry_result == null)
			{
				$this->qry_result = sqlsrv_query($this->connection,$this->sql);
			}

			if($this->qry_result != null){
				while ($rs = sqlsrv_fetch_array($this->qry_result, SQLSRV_FETCH_ASSOC)) {
					$result[] = $rs;
				}
			}
		}

		return $result;
	}

	public function first()
	{
		$result = null;
		
		if($this->is_connect == 1){
			$rs = self::fetchAll();
			$result = $rs[0];
		}

		return $result;
	}
}