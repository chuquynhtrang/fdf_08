<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Product\ProductRepositoryInterface;
use Session;
use App\Models\Cart;

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

        return view('product.show', compact('product'));
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = $this->productRepository->find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        
        return redirect()->route('home');
    }
}
