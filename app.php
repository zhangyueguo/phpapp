<?php

   //echo phpinfo();exit;
   require_once('./response.php');
   require_once('./Db.php');
   require_once('./file.php');

   $page = isset($_GET['page']) ? $_GET['page'] : 1;

   $pagesize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 6;

   $data = array();

   if(!is_numeric($page) || !is_numeric($pagesize))
   {
        Response::show(401,'数据不合法');
   }


   $offset = ($page-1)*$pagesize;

   $sql = "select * from diqu where parentid = 0 order by id desc limit ".$offset.",".$pagesize;


   $cache = new file();
   $results = array();

if(!$results = $cache->cacheDate('index_mk'.$page.'-'.$pagesize)) {
        try {

            $con = Db::getinstance()->connect();
        } catch (Exception $e) {
            return response::show(440, '数据库连接失败');
        }

        $res = mysql_query($sql, $con);

        $results = array();

        while ($result = mysql_fetch_assoc($res)) {
            $results[] = $result;
        }

      if($results){
          $cache->cacheDate('index_mk'.$page.'-'.$pagesize,$results,1200);
      }
}

     //返回接口数据

     if($results)
     {
     	return response::show(200,'数据获取成功',$results);
     }else{
     	return response::show(403,'数据获取失败');
     }

?>