<?php
/*----------------------------------------------------------------------------
 *	BabarCode
 *	a super micro PHP Framework
 *	Developed by Muhammad Babar Jihad <mbabarjihad@gmail.com>
 *--------------------------------------------------------------------------*/
use system\db\driver\iDriver;

class mysql implements iDriver
{
	
	public $host;
	public $db;
	public $user;
	public $password;
	public $port;
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
			$this->host = $this->host.':'.$this->port;
		}
		if(array_key_exists('auto_connect',$config)) $this->auto_connect = $config['auto_connect'];
	}

	public function connect()
	{
		$this->connection = mysql_connect($this->host, $this->user, $this->password);
		
		if($this->connection){
			$this->is_connect = 1;
			mysql_select_db($this->db);
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
		if(mysql_close($this->connection)) $ok = 1;
		
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
			$qry = mysql_query($this->sql,$this->connection);
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
				$this->qry_result = mysql_query($this->sql,$this->connection);
			}

			if($this->qry_result != null){
				while ($rs = mysql_fetch_array($this->qry_result, MYSQL_ASSOC)) {
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
			if($this->qry_result == null)
			{
				$this->qry_result = mysql_query($this->sql,$this->connection);
			}

			$rs = mysql_fetch_row($this->qry_result, MYSQL_ASSOC);
			$result = $rs;
		}

		return $result;
	}
}