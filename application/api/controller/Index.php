<?php
namespace app\api\controller;

use app\api\model\DealInfo;
use app\api\model\Order;
use think\Controller;
use think\Request;

class Index extends Controller
{

    protected $order;
    protected $deal;
    public function __construct(Request $request, Order $order, DealInfo $deal)
    {
        parent::__construct($request);
        $this->order = $order;
        $this->deal = $deal;
    }

    public function index()
    {
        echo 'nothing can get';
    }

    /**
     * 订单列表
     *
     */
    public function order()
    {
        $data = $this->_order();
        return $data;
    }

    public function _order()
    {
        $list = $this->order->getList();
        if ($list) {
            return json(['code' => 1, 'data' => $list]);
        } else {
            return josn(['code' => 0, 'message' => 'nothing get']);
        }
    }

    /**
     * 成交记录
     */
    public function deal()
    {
        $data = $this->_deal();
        return $data;
    }

    public function _deal()
    {
        $list = $this->deal->getList();
        if ($list) {
            return json(['code' => 1, 'data' => $list]);
        } else {
            return josn(['code' => 0, 'message' => 'nothing get']);
        }
    }
}
