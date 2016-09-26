<?php

   class file{
       private $_dir;

       const EXT = '.txt';

       public function __construct()
       {
           $this->_dir = dirname(__FILE__).'/files/';
       }

       public function cacheDate($key,$value='',$path='')
       {
           $filename = $this->_dir.$path.$key.self::EXT;
           if($value !== '')
           {
               if($value=='del'){
                  // return $filename;
                   return @unlink($filename);
               }else{
                   //将数据写入缓存
                   $dir = dirname($filename);
                   if(!is_dir($dir)){
                       mkdir($dir,0777);
                   }
                   return file_put_contents($filename,json_encode($value));
               }

           }

           //获取缓存
           if(!is_file($filename)){
               return false;
           }else{
               return json_decode(file_get_contents($filename),true);
           }
       }
   }

?>