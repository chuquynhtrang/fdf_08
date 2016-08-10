<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use Auth;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\LineItem\LineItemRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use DB;
use Mail;
use wataridori\ChatworkSDK\ChatworkSDK;
use wataridori\ChatworkSDK\ChatworkRoom;

class OrderController extends Controller
{
    private $orderRepository;
    private $lineItemRepository;
    private $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        LineItemRepositoryInterface $lineItemRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->lineItemRepository = $lineItemRepository;
        $this->productRepository = $productRepository;
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $order = $this->orderRepository->storeOrder();
            $orderId = $order->id;

            $lineItem = $this->lineItemRepository->save($orderId);
            $quantity = $lineItem->quantity_product;

            $product = $this->productRepository->find($lineItem->product_id);

            $quantityRest = $product->quantity - $lineItem->quantity_product;

            $this->productRepository->update(['quantity' => $quantityRest], $product->id);

            DB::commit();
            Cart::destroy();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $roomId = env('ROOM_ID');
        $apiKey = env('CHATWORK_API_KEY');
        ChatworkSDK::setApiKey($apiKey);
        $room = new ChatworkRoom($roomId);
        $room->sendMessageToAll(trans('settings.buy_success'));

        return redirect()->route('home');
    }
}
