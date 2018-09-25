<?php

namespace BadpersonOrder;

use BadpersonOrder\OrderApi;

class Test
{
    private $orderObj;

    public function __construct()
    {
        $this->orderObj =  OrderApi::getInstance();
    }

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
        $where = ['is_delete' => 1];
        $list = $this->orderObj->orderList ($where, 2);
        print_r($list);die;
    }

    /**
     * 添加订单
     */
    public function add()
    {
        //设置（order表）订单数据
        $orderList = [
            'price' => 1,
            'user_id' => 1
        ];
        $this->orderObj->setVal($orderList);

        /*---------------验证（order表）数据开始--------------------*/
        $this->orderObj->setRule([
            'price' => 'require',
            'user_id'  => 'require',
        ]);
        $this->orderObj->setMsg([
            'price.require' => '价格不能为空',
            'user_id.require' => '用户ID不能为空',
        ]);
        $validate = $this->orderObj->validate();
        if (!$validate['status'] || !empty($validate['data'])) {
            print_r($validate['data']);die;
        }
        /*---------------验证数据结束--------------------*/


        //设置（order_info表）订单数据
        $orderInfo = [
            'goods_id' => 1,
            'price' => 1.2,
        ];
        $this->orderObj->setVal($orderInfo);

        /*---------------验证（order_info表）数据开始--------------------*/
        $this->orderObj->setRule([
            'price' => 'require',
            'goods_id'  => 'require',
        ]);
        $this->orderObj->setMsg([
            'price.require' => '价格不能为空',
            'user_id.require' => '商品ID不能为空',
        ]);
        $validate = $this->orderObj->validate();
        if (!$validate['status'] || !empty($validate['data'])) {
            print_r($validate['data']);die;
        }
        /*---------------验证数据结束--------------------*/

        //重新设置订单添加的数据
        $orderList['orderInfo'] = $orderInfo;
        $this->orderObj->setVal($orderList);

        //添加数据
        $result = $this->orderObj->addOrder();
        print_r($result);die;
    }

    /**
     * 修改订单
     *
     *  int $id 订单id
     */
    public function update()
    {
        //设置要修改的数据
        $this->orderObj->setVal([
            'status' => 2,
        ]);

        /*---------------验证数据开始--------------------*/
        $this->orderObj->setRule([
            'status' => 'require',
        ]);
        $this->orderObj->setMsg([
            'status.require' => '不能为空',
        ]);
        $validate = $this->orderObj->validate();
        if (!$validate['status'] || !empty($validate['data'])) {
            //打印验证错误结果
            print_r($validate['data']);die;
        }
        /*---------------验证数据结束--------------------*/

        //修改数据
        $id = 1;
        $result = $this->orderObj->updateOrder($id);
        print_r($result);die;
    }

    /**
     * 删除订单 (此删除为软删除 修改数据库 is_delete 字段)
     *
     *  int $id 订单id
     */
    public function delete()
    {
        //删除数据
        $id = 2;
        $result = $this->orderObj->delOrder($id);
        print_r($result);die;
    }
}
