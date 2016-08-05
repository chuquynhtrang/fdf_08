<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use Auth;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\LineItem\LineItemRepositoryInterface;
use DB;
use Mail;

class OrderController extends Controller
{
    private $orderRepository;
    private $lineItemRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        LineItemRepositoryInterface $lineItemRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->lineItemRepository = $lineItemRepository;
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $order = $this->orderRepository->store();
            $orderId = $order->id;

            $this->lineItemRepository->save($orderId);
            DB::commit();
            Cart::destroy();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('home');
    }
}
