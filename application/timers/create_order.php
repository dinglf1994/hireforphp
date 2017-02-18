<?php

/**
 * 生产脚本
 */

require_once './Mysql.php';
require_once './consume_order_function.php';

Mysql::_init();

const BID = 0;
const ASK = 1;

/**
 * 测试数据
 */
    $arr = [
      ['ask', 6, 480],
      ['bid', 8, 470],
      ['bid', 5, 460],
    ];
$i = 0;

while ($i < 100) {
    $type = rand(0, 1) == BID ? 'bid' : 'ask';
    $quantity = rand(1, 10);
    $price = rand(300, 500);

    // 测试:
//    $type = $arr[$i][0];
//    $quantity = $arr[$i][1];
//    $price = $arr[$i][2];

    $data = [
        'type' => $type,
        'quantity' => $quantity,
        'price' => $price
    ];
//    var_dump($data);
    Mysql::insertOne($data, 'hire_order');
    deal();
    sleep(rand(1,3));
    $i++;
}