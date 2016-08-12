<?php

namespace App\Repositories\Order;

use Auth;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use Cart;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function storeOrder()
    {
        $order = new Order();
        $order['user_id'] = Auth::user()->id;
        $order['price'] = Cart::total();
        $order['status'] = config('common.unpaid');
        $order['shipping_address'] = Auth::user()->address;

        if (!$order->save()) {
            throw new Exception(trans('message.update_error'));
        }

        return $order;
    }

    public function orderDetails($id)
    {
        $order = $this->model->with('lineItems')->find($id);

        return $order;
    }

    public function getOrderLastest($userId)
    {
        $order = $this->model->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->first();

        return $order;
    }
}
