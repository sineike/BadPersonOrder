<?php
/**
 * Created by PhpStorm.
 * User: BadPerson
 * Date: 2018/9/13 0013
 * Time: 16:24
 */

namespace BadpersonOrder\lib;

use think\Db;

class Model
{
    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function add ($data)
    {
        return Db::name('order')->insert($data);
    }

    public function update ($id, $data)
    {
        return Db::name('order')->where($id)->update($data);
    }

    public function del ($id)
    {
        return Db::name('order')->delete($id);
    }
}
