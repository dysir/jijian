<?php

class ErrorCode
{

    public static function getError($error, $area = 'zh')
    {
        if (isset(self::$code[$area][$error])) {
            return self::$code[$area][$error];
        } else {
            return array(
                "code" => 9999,
                "msg" => "未定义错误:" . $error
            );
        }
    }

    public static $code = array(
        "zh" => array(
            "OK" => array(
                "code" => 1,
                "msg" => "OK"
            )
        )
    );

}

