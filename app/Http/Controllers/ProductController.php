<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Product\ProductRepositoryInterface;
use Session;
use App\Models\Product;
use Cart;
use Auth;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    public function show($id) 
    {
        $product = $this->productRepository->find($id);
        $totalCartItems = Cart::count();

        return view('product.show', compact('product', 'totalCartItems'));
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = $this->productRepository->find($id);
        $totalCartItems = Cart::count();

        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => 1, 
            'price' => $product->price, 
            'options' => [
                'image' => $product->image,
            ],
        ]);

        return redirect()->route('products.getCart');
    }

    public function getCart()
    {
        $products = Cart::content();

        $totalCartItems = Cart::count();
        $totalPrice = Cart::subtotal();
        $tax = Cart::tax();
        $totalIncludeTax = Cart::total();

        return view('product.get-cart', compact('products', 'totalCartItems', 'totalPrice', 'tax', 'totalIncludeTax'));
    }

    public function updateCart(Request $request, $rowId)
    {
        $quantity = intval($request->quantity);

        Cart::update($rowId, $quantity);

        return redirect()->route('products.getCart');
    }
    
    public function deleteItem($rowId)
    {
        Cart::remove($rowId);

        return redirect()->route('products.getCart');
    }

    public function deleteAllCart()
    {
        Cart::destroy();

        return redirect()->route('products.getCart');
    }

    public function checkout()
    {
        $totalCartItems = Cart::count();
        $products = Cart::content();
        $totalPrice = Cart::subtotal();
        $tax = Cart::tax();
        $totalIncludeTax = Cart::total();
        
        return view('product.checkout', compact('totalCartItems', 'products', 'totalPrice', 'tax', 'totalIncludeTax'));
    }
}
