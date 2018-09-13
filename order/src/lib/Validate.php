<?php
/**
 * Created by PhpStorm.
 * User: BadPerson
 * Date: 2018/9/13 0013
 * Time: 15:05
 */

namespace order\lib;

use think\Validate as tpVali;

class Validate extends tpVali
{
    protected $rule = [];
    protected $message  =  [];
    protected $data = [];
    protected $error = [];

    public function __construct(array $rules = [], array $message = [], array $data = [])
    {
        $this->setRule($rules);
        $this->setMsg($message);
        $this->setData($data);
    }


    private function setRule ($rule)
    {
       $this->rule = $rule;
    }

    private function setMsg ($msg)
    {
        $this->message = $msg;
    }

    private function setData ($data)
    {
        $this->data = $data;
    }

    public function error ()
    {
        return $this->error;
    }

    public function checkData ()
    {
        $validate = new tpVali/Validate($this->rule, $this->message);
        $result   = $validate->check($this->data);
        if (!$result) {
            $this->error = $validate->getError();
        }
        return $result;
    }

}
