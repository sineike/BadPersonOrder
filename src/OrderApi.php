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

    /**
     * OrderApi单例
     *
     * @return object
     */
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

    /**
     * 设置订单数据
     */
    public function setVal ($val)
    {
        $this->values = $val;
    }

    /**
     * 设置验证规则
     */
    public function setRule ($rule)
    {
        $this->rule = $rule;
    }

    /**
     * 设置验证提示信息
     */
    public  function setMsg ($msg)
    {
        $this->message = $msg;
    }

    /**
     * 验证数据
     *
     * @return array
     */
    public function validate ()
    {
        if (empty($this->rule) || empty($this->values)) {
           return Common::msg('验证数据和规则不能为空');
        }

        $validate = new Validate($this->rule, $this->message, $this->values);
        return Common::msg('验证完成', $validate->checkData(), $validate->error());
    }

    /**
     * 获取订单列表
     *
     * @param array $where 查询条件
     * @param string $orderBy 排序规则
     * @param int $type  1 获取带分页的object 2 查询多条数据 3查询一条数据
     * @param int $page  页码
     * @param int $limit 每页条数
     * @return array|object
     */
    public function orderList ($where = array(), $type = 1, $page = 0, $limit = 10, $orderBy = 'id DESC')
    {
        $list = $this->model->getList ($where, $type, $page, $limit, $orderBy);
        return Common::msg('获取信息成功', true, $list);
    }

    /**
     * 添加订单
     *
     * @return array
     */
    public function addOrder ()
    {
        if (empty($this->values) || !isset($this->values['orderInfo']) || empty($this->values['orderInfo'])) {
            return Common::msg('订单数据不能为空');
        }

        $this->values['order_num'] = Common::OrderNum();
        $this->values['add_time'] = date('Y-m-d H:i:s');
        $result = $this->model->add($this->values);

        if ($result) {
            return Common::msg('添加订单成功', true);
        } else {
            return Common::msg('添加订单失败');
        }

    }

    /**
     * 修改订单
     *
     * @param int $id 订单id
     * @return array
     */
    public function updateOrder ($id)
    {
        if (empty($this->values)) {
            return Common::msg('订单修改数据不能为空');
        }

        $list = $this->orderList (['id' => $id], 3);
        if (empty($list)) {
            return Common::msg('订单信息不存在');
        }

        $this->values['update_time'] = date('Y-m-d H:i:s');
        $result = $this->model->update ($id, $this->values);
        if ($result) {
            return Common::msg('修改订单成功', true);
        } else {
            return Common::msg('修改订单失败');
        }
    }

    /**
     * 删除订单
     *
     * @param int $id 订单id
     * @return array
     */
    public function delOrder ($id)
    {
        $list = $this->orderList (['id' => $id], 3);
        if (empty($list)) {
            return Common::msg('订单信息不存在');
        }

        $result = $this->model->del($id);
        if ($result) {
            return Common::msg('删除订单成功', true);
        } else {
            return Common::msg('删除订单失败');
        }
    }
}
