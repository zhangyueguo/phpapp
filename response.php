<?php
Class Response{

    /*
     * json 数据格式
     * param integer $code 状态码
     * param integer $message 提示信息
     * param integer $data 数据
     * return string
     */

    public static function json($code,$message='',$data=array())
    {
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
             'code'       => $code,
             'message'   => $message,
             'date'      => $data
        );

        return json_encode($result);
        exit;
    }

    /*
    *return xml
    */

    public static function xml()
    {
      header('Content-Type:text/xml');  
      $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
      $xml .= "<root>\n";
      $xml .= "<code>200</code>\n";
      $xml .= "<message>数据返回成功</message>\n";
      $xml .= "<data>\n"; 
      $xml .= "<id>1</id>\n"; 
      $xml .= "<name>zhang yue guo</name>\n"; 
      $xml .= "</data>\n"; 
      $xml .= "</root>";

      return $xml;

    }


}


?>