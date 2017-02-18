<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 17-2-18
 * Time: 上午11:26
 */

namespace app\admin\controller;


use think\Controller;

class Showorder extends Controller
{
    public function order()
    {
        $url = 'http://www.hire.com/api/index/order';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        $list = json_decode($result, true);
        if (1 == $list['code']) {
            $bid_list = $list['data']['bid'];
            $ask_list = $list['data']['ask'];

            $this->assign('bid', $bid_list);
            $this->assign('ask', $ask_list);

            return $this->fetch();

        } else {
            $this->error('获取数据失败');
        }
    }

    public function deal()
    {
        $url = 'http://www.hire.com/api/index/deal';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        $list = json_decode($result, true);
        if (1 == $list['code']) {
        $deal = $list['data'];

        $this->assign('deal', $deal);

        return $this->fetch();

    } else {
        $this->error('获取数据失败');
    }
    }
}