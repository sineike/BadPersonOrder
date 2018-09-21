<?php
/**
 * Created by PhpStorm.
 * User: BadPerson
 * Date: 2018/9/13 0013
 * Time: 14:40
 */

namespace BadpersonOrder\lib;

class Common
{

    /**
     * 生成唯一订单号
     *
     * @return string
     */
    public static function OrderNum ()
    {
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    /**
     * 返回数据信息
     *
     * @param string $msg 提示信息
     * @param bool $status 状态
     * @param array $data 返回数据
     * @return array
     */
    public static function msg ($msg = '', $status = false,  $data = array())
    {
        return [
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ];
    }
}
