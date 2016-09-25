<?php
//header('content-type:text/html;charset=utf8');

 require_once "./response.php";

 $data = array(
      'id'    => 2,
      'name'  =>'zhang dan',
      'ceshi' => array(2323,44,4,4,array(1,3,4,5,66,)),
 );

 // echo Response::json(200,'成功',$data);

 //echo Response::xml();

// echo Response::xmlEncode('200','sucess',$data);


 echo Response::show(200,'sucess',$data,'array');

