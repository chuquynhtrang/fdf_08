<?php 
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Cart;

/**
* ProductComposer
*/
class ProductComposer
{
    protected $products;
    protected $totalCartItems;
    protected $productCarts;
    protected $totalPrice;

    public function __construct()
    {
        $this->products = Cart::content();
        $this->totalCartItems = Cart::count();
        $this->productCarts = Cart::content();
        $this->totalPrice = Cart::subtotal();
    }

    public function compose(View $view)
    {
        $view->with([
            'products' => $this->products,
            'totalCartItems' => $this->totalCartItems,
            'productCarts' => $this->productCarts,
            'totalPrice' => $this->totalPrice,
        ]);
    }
}
