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


}


?>