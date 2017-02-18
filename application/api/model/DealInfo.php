<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 17-2-18
 * Time: 下午4:08
 */

namespace app\api\model;


use think\Model;

class DealInfo extends Model
{
    public function getList()
    {
        $deal = new DealInfo();
        $list = $deal->limit(30)->order('create_time', 'desc')->select();
        return $list;
    }
}