<?php
/**
 * 成交脚本
 */

require_once './Mysql.php';

Mysql::_init();

const BID = 0; // 买
const ASK = 1; // 卖

$order_table = 'hire_order'; // 单表
$deal_table = 'hire_deal_info'; // 交易信息表

while (true) {
    $where = ['type' => 'bid'];
    $bid_queue = Mysql::findAll($where, $order_table);


    foreach ($bid_queue as $item => $value) {
        // 查找可以交易的卖单
        $ask_queue = Mysql::findDeal($value['price']);
        if (!empty($ask_queue)) {
//            var_dump($ask_queue);
            $deal_quantity = $value['quantity'] > $ask_queue['quantity'] ? $ask_queue['quantity'] : $value['quantity'];
            $ask_number = $value['number'];
            $bid_number = $ask_queue['number'];
            $deal_price = ($value['price'] + $ask_queue['price'])/2;
            $data = [
                'bid_number' => $bid_number,
                'ask_number' => $ask_number,
                'deal_price' => $deal_price,
                'deal_quantity' => $deal_quantity
            ];
            Mysql::insertOne($data, $deal_table);

            // 更新下单列表
            // bid:
            $bid_number = $value['number'];
            $bid_quantity = $value['quantity'] - $deal_quantity;

            $bid_where = ['number' => $bid_number];
            $bid_data = ['quantity' => $bid_quantity];

            // ask:
            $ask_number = $ask_queue['number'];
            $ask_quantity = $ask_queue['quantity'] - $deal_quantity;

            $ask_where = ['number' => $ask_number];
            $ask_data = ['quantity' => $ask_quantity];

            Mysql::upDateOne($bid_data, $bid_where, $order_table);
            Mysql::upDateOne($ask_data, $ask_where, $order_table);
        }
    }
}
