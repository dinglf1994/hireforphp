<?php

namespace app\api\model;

use think\Model;

class Order extends Model
{
    public function getList()
    {
        $order = new Order();
        $bid_list = $order
            ->where('type', 'bid')
            ->where('quantity', 'neq', 0)
            ->limit(20)
            ->order('price', 'desc')
            ->select();

        $ask_list = $order
            ->where('type', 'ask')
            ->where('quantity', 'neq', 0)
            ->limit(20)
            ->order('price', 'desc')
            ->select();

        return ['bid' => $bid_list, 'ask' => $ask_list];
    }
}