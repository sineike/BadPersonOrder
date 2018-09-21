<?php

namespace BadpersonOrder;

use Exception;

class Test
{
    /**
     * 获取订单列表
     *
     *  array $where 查询条件
     *  int $type  1 获取带分页的object 2 查询多条数据 3查询一条数据 默认1)
     *  int $page  页码   (默认0)
     *  int $limit 每页条数 (默认10)
     *  string $orderBy 排序规则 (默认id DESC)
     * @return array|object
     */
    public function index()
    {
       //获取Order对象
        $orderObj =  OrderApi::getInstance();
        $where = ['is_delete' => 1];
        return $orderObj->orderList ($where, 2);

    }

    /**
     * 添加订单
     */
    public function add()
    {
        //获取Order对象
        $orderObj =  OrderApi::getInstance();

        //设置要添加的数据
        $orderObj->setVal([
            'goods_id' => 1,
            'user_id' => 1
        ]);

        /*---------------验证数据开始--------------------*/
        $orderObj->setRule([
            'goods_id' => 'require',
            'user_id'  => 'require',
        ]);
        $orderObj->setMsg([
            'goods_id.require' => '商品ID不能为空',
            'user_id.require' => '用户ID不能为空',
        ]);
        $validate = $orderObj->validate();
        if (!$validate['status'] || !empty($validate['error'])) {
            throw new Exception("数据格式有误");
        }
        /*---------------验证数据结束--------------------*/

        //添加数据
        return  $orderObj->addOrder();
    }

    /**
     * 修改订单
     *
     *  int $id 订单id
     */
    public function update()
    {
        //获取Order对象
        $orderObj =  OrderApi::getInstance();

        //设置要修改的数据
        $orderObj->setVal([
            'goods_id' => 1,
            'user_id' => 1
        ]);

        /*---------------验证数据开始--------------------*/
        $orderObj->setRule([
            'goods_id' => 'require',
            'user_id'  => 'require',
        ]);
        $orderObj->setMsg([
            'goods_id.require' => '商品ID不能为空',
            'user_id.require' => '用户ID不能为空',
        ]);
        $validate = $orderObj->validate();
        if (!$validate['status'] || !empty($validate['error'])) {
            throw new Exception("数据格式有误");
        }
        /*---------------验证数据结束--------------------*/

        //修改数据
        $id = '';
        return  $orderObj->updateOrder($id);
    }

    /**
     * 删除订单 (此删除为软删除 修改数据库 is_delete 字段)
     *
     *  int $id 订单id
     */
    public function delete()
    {
        //获取Order对象
        $orderObj =  OrderApi::getInstance();
        //删除数据
        $id = '';
        return  $orderObj->delOrder($id);
    }
}
