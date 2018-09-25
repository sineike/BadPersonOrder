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
    private $table = 'order';

    /**
     * Model单例
     *
     * @return object
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 获取订单列表
     *
     * @param array $where 查询条件
     * @param string $orderBy 排序规则
     * @param int $type  1 获取带分页的object 2 查询多条数据 3查询一条数据
     * @param int $page  页码
     * @param int $limit 每页条数
     * @return object|array
     */
    public function getList ($where, $type, $page, $limit, $orderBy)
    {
        $obj = Db::name($this->table);
        if (!empty($where)) {
            $obj->where($where);
        }
        if ($type == 1) {
            $result = $obj->order($orderBy)->paginate($limit);
        } elseif ($type == 2) {
            $newPage = $page * $limit;
            $result = $obj->order($orderBy)->limit($newPage, $limit)->select();
        } else {
            $result = $obj->find();
        }
        return $result;
    }

    /**
     * 添加订单信息
     *
     * @param array $data 订单数据
     * @return bool
     */
    public function add ($data)
    {
        $orderInfo = $data['orderInfo'];
        unset($data['orderInfo']);

        Db::startTrans();
        try{
            $orderId = Db::name($this->table)->insertGetId($data);
            if (!$orderId) {
                Db::rollback();
                return false;
            }

            $orderInfo['order_id'] = $orderId;
            $orderInfo['order_num'] = $data['order_num'];
            $info_status = Db::name('order_info')->insert($orderInfo);
            if ($info_status) {
                Db::commit();
                return true;
            } else {
                Db::rollback();
                return false;
            }
        } catch (\Exception $e) {
            Db::rollback();
            return false;
        }
    }

    /**
     * 修改订单信息
     *
     * @param int $id 订单id
     * @param array $data 订单修改数据
     * @return int
     */
    public function update ($id, $data)
    {
        return Db::name($this->table)->where('id', $id)->update($data);
    }

    /**
     * 删除订单信息
     *
     * @param int $id 订单id
     * @return int
     */
    public function del ($id)
    {
        return Db::name($this->table)->where('id', $id)->update(['is_delete' => 2, 'update_time' => date('Y-m-d H:i:s')]);
    }
}
