<?php

   class file{
       private $_dir;

       const EXT = '.txt';

       public function __construct()
       {
           $this->_dir = dirname(__FILE__).'/files/';
       }

      // public function cacheDate($key,$value='',$path='')
       public function cacheDate($key,$value='',$cacheTime = 0)
       {
           //$filename = $this->_dir.$path.$key.self::EXT;
           $filename = $this->_dir.$key.self::EXT;
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

                   $cacheTime = sprintf('%011d',$cacheTime);
                   return file_put_contents($filename,$cacheTime.json_encode($value));
               }

           }

           //获取缓存
           if(!is_file($filename)){
               return false;
           }
           //获取缓存失效时间
           $contents = file_get_contents($filename);
           $cacheTime = (int)substr($contents,0,11);
           $value = substr($contents,11);
           //echo $cacheTime;exit;
           if($cacheTime!=0 && ($cacheTime + filemtime($filename) < time())){
               @unlink($filename);
               return false;
           }

           //return json_decode(file_get_contents($filename),true);
           return json_decode($value,true);

       }
   }

//  $file = new file();
//  $file->cacheDate('test1');

?>