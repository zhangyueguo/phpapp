<?php
Class Response{

    /*
     * 综合方式输出数据格式
     * param integer $code 状态码
     * param string $message 提示信息
     * param array $data 数据
     * param string $type 类型
     * return string
     */


  public static function show($code,$message='',$data=array(),$type='json')
  {
    if (!is_numeric($code)) {
        return '';
    }
    $result = array(
        'code'    => $code,
        'message' => $message,
        'data'    => $data
    );

    $type = isset($_GET['format']) ? $_GET['format'] : 'json';
    if($type == 'json'){
      echo self :: json($code,$message,$data);
      exit();
    }elseif ($type == 'array') {
      //调试模式
      var_dump($result);
    }elseif ($type == 'xml') {
      echo self :: xmlEncode($code,$message,$data);
      exit();
    }else{
      //根据业务可在添加逻辑
    }

  }

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

    /*
     * xml 数据格式
     * param integer $code 状态码
     * param string $message 提示信息
     * param array $data 数据
     * return string
     */

    public static function xmlEncode($code,$message,$data=array())
    {
      if(!is_numeric($code)){
        return '';
      }
      $result = array(
           'code'     => $code,
           'message'  => $message,
           'data'     => $data
      );
      header('Content-Type:text/xml');
      $xml  = "<?xml version='1.0' encoding='UTF-8'?>\n";
      $xml .= "<root>\n";

      $xml .= self::xmlToEncode($result);

      $xml .= "</root>\n";

      return $xml;
    }


    public static function xmlToEncode($data)
    {
        $xml = ""; 
        $attr = "";
        foreach ($data as $key => $value) {
          if(is_numeric($key))
          {
            $attr = "id = '{$key}'";
            $key = "item";
          }
           $xml  .= "<{$key} $attr>\n";
           $xml  .= is_array($value) ? self::xmlToEncode($value): $value;
           $xml  .= "</{$key}>\n"; 
        }
        return $xml;
    }



}


?>
