<?php

namespace BadpersonOrder;

class Index
{
    public function add()
    {
        $result = [
            'status' => false,
            'msg' => '',
            'info' => []
        ];

        $orderObj =  OrderApi::getInstance();
        $orderObj->setVal([
            'goods_id' => 1,
            'name' => '阿飞'
        ]);
        $orderObj->setRule([
            'goods_id' => 'require',
            'name'  => 'require|max:25',
        ]);
        $orderObj->setMsg([
            'goods_id.require' => 'ID不能为空',
            'name.require' => '名称不能为空',
            'name.max'     => '名称最多不能超过25个字符',
        ]);

        $validate = $orderObj->validate();
        if (!$validate['status'] || !empty($validate['error'])) {
            $result['msg'] = '数据格式有误';
            $result['info'] = $validate['error'];
            return json($result);
        }

        $orderObj->addOrder();
        print_r($validate);die;
    }

    public function update()
    {
        $result = [
            'status' => false,
            'msg' => '',
            'info' => []
        ];

        $orderObj =  OrderApi::getInstance();
        $orderObj->setVal([
            'goods_id' => 1,
            'name' => '阿飞'
        ]);
        $orderObj->setRule([
            'goods_id' => 'require',
            'name'  => 'require|max:25',
        ]);
        $orderObj->setMsg([
            'goods_id.require' => 'ID不能为空',
            'name.require' => '名称不能为空',
            'name.max'     => '名称最多不能超过25个字符',
        ]);

        $validate = $orderObj->validate();
        if (!$validate['status'] || !empty($validate['error'])) {
            $result['msg'] = '数据格式有误';
            $result['info'] = $validate['error'];
            return json($result);
        }

        $orderObj->updateOrder();
        print_r($validate);die;
    }
}
