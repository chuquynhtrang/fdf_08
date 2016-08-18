<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Session;
use App\Models\Product;
use Cart;
use Auth;
use App\Models\User;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;

class ProductController extends Controller
{
    private $productRepository;
    private $commentRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository, 
        CommentRepositoryInterface $commentRepository, 
        UserRepositoryInterface $userRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);

        $comments = $this->commentRepository->showComment($id);

        return view('product.show', compact('product', 'comments'));
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
        $tax = Cart::tax();
        $totalIncludeTax = Cart::total();

        return view('product.get-cart', compact('tax', 'totalIncludeTax'));
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
        $tax = Cart::tax();
        $totalIncludeTax = Cart::total();

        return view('product.checkout', compact('tax', 'totalIncludeTax'));
    }

    public function getComments(CreateCommentRequest $request, $id)
    {
        $product = $this->productRepository->find($id);
        $comment = [
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'content' => $request->content,
        ];
        $addComment = $this->commentRepository->create($comment);

        return redirect()->route('products.show', ['id' => $id]);
    }
}
