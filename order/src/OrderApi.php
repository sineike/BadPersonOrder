<?php

namespace order;

use order\lib\Common;
use order\lib\Validate;
use order\lib\Model;

class OrderApi
{
    private $values = [];

    private $orderNum;

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

    public function __construct(Model $model)
    {
        $this->model = $model::getInstance();
    }

    public function setVal ($val)
    {
        $this->values = $val;
    }

    public function setOrderNum ()
    {
        $this->orderNum = Common::OrderNum();
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
        $this->values['add_time'] = date('Y-m-d H:i:s');

        return $this->model->add($this->values);
    }

    public function delOrder ($id)
    {
        return $this->model->del($id);
    }
}
