<?php

namespace BadpersonOrder;

use BadpersonOrder\lib\Common;
use BadpersonOrder\lib\Validate;
use BadpersonOrder\lib\Model;

class OrderApi
{
    private $values = [];

    protected $rule = [];

    protected $message  =  [];

    protected $model;

    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new OrderApi();
        }

        return static::$instance;
    }

    public function __construct()
    {
        $this->model = Model::getInstance();
    }

    public function setVal ($val)
    {
        $this->values = $val;
    }

    public function getOrderNum ()
    {
        return Common::OrderNum();
    }

    public function setRule ($rule)
    {
        $this->rule = $rule;
    }

    public  function setMsg ($msg)
    {
        $this->message = $msg;
    }

    public function validate ()
    {
        $validate = new Validate($this->rule, $this->message, $this->values);
        return [
            'status' =>  $validate->checkData(),
            'error' =>  $validate->error(),
        ];
    }

    public function addOrder ()
    {
        $this->values['order_num'] = $this->getOrderNum();
        $this->values['add_time'] = date('Y-m-d H:i:s');
        return $this->model->add($this->values);
    }

    public function delOrder ($id)
    {
        return $this->model->del($id);
    }
}
