<?php
/**
 * Created by PhpStorm.
 * User: BadPerson
 * Date: 2018/9/13 0013
 * Time: 14:40
 */

namespace order\lib;

class Common
{
    public static function OrderNum ()
    {
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

}
