<?php

namespace App\Repositories\LineItem;

use Auth;
use App\Models\LineItem;
use App\Repositories\BaseRepository;
use App\Repositories\LineItem\LineItemRepositoryInterface;
use Cart;

class LineItemRepository extends BaseRepository implements LineItemRepositoryInterface
{

    public function __construct(LineItem $lineItem)
    {
        $this->model = $lineItem;
    }

    public function save($orderId)
    {
        $products = Cart::content();

        foreach ($products as $product) {
            $lineItem = new LineItem();

            $lineItem['product_id'] = $product->id;
            $lineItem['order_id'] = $orderId;
            $lineItem['quantity_product'] = $product->qty;
            $lineItem['price'] = $product->price;

            if (!$lineItem->save()) {
                throw new Exception(trans('message.update_error'));
            }
        }

        return $lineItem;
    }

    public function orderByBestSelling()
    {
        return $this->model->join('products', 'products.id', '=', 'line_items.product_id')
                ->groupBy('product_id')
                ->selectRaw('*, sum(quantity_product) as sum')
                ->orderBy('sum', 'desc')
                ->paginate(config('common.items_per_page'));
    }
}
