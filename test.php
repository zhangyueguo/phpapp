<?php
//header('content-type:text/html;charset=utf8');
 require_once "./response.php";

 $data = array(
      'id' => 2,
      'name' =>'zhang dan'
 );

 // echo Response::json(200,'成功',$data);

 echo Response::xml();