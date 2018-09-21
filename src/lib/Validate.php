<?php
/**
 * Created by PhpStorm.
 * User: BadPerson
 * Date: 2018/9/13 0013
 * Time: 15:05
 */

namespace BadpersonOrder\lib;

use think\Validate as tpVali;

class Validate extends tpVali
{
    protected $rule = [];
    protected $message  =  [];
    protected $data = [];
    protected $error = [];

    public function __construct(array $rules = [], array $message = [], array $data = [])
    {
        $this->rule = $rules;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * 获取验证错误信息
     */
    public function error ()
    {
        return $this->error;
    }

    /**
     * 验证数据
     *
     * @return bool
     */
    public function checkData ()
    {
        $validate = new tpVali($this->rule, $this->message);
        $result   = $validate->batch()->check($this->data);
        if (!$result) {
            $this->error = $validate->getError();
        }
        return $result;
    }

}
