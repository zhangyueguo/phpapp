<?php

  /**
  * php 单例模式链接数据库
  */
  class Db 
  {

  	private static $_instace;

  	static private $con;

  	private $config = array(
                         'host'     => '127.0.0.1',
                         'user'     => 'root',
                         'password' => '',
                         'databases'=> 'test'  
  		              );
  	
  	private function __construct()
  	{
  		
  	}
     public static function getinstance()
     {
     	if(!(self::$_instace instanceof self))
     	{
     		self::$_instace = new self();
     	}
        
        return self::$_instace;
       
     }


     public function connect()
     {

     	if (!self::$con)
     {
     		
     	
     	self::$con = mysql_connect($this->config['host'],$this->config['user'],$this->config['password']);

     	if (!self::$con) {
     		die('数据库连接失败'.mysql_errno());
     	}

     	mysql_select_db($this->config['databases']);

     	mysql_query('set names UTF8',self::$con);

     }

        return self::$con;

     }
  }

  //var_dump(Db::getinstance());exit;

  $con = Db::getinstance()->connect();

  //var_dump($con);exit;

  $sql = "select * from ceshi";

  $res = mysql_query($sql,$con);

  var_dump($res);

?>

