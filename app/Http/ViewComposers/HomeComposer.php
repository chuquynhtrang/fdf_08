<?php 
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Category\CategoryRepositoryInterface;
use Cart;

/**
* HomeComposer
*/
class HomeComposer
{
    protected $categoryRepository;
    protected $categoriesParent;
    protected $categoriesChild;
    protected $totalCartItems;
    protected $productCarts;
    protected $totalPrice;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoriesParent = $this->categoryRepository->findBy('parent_id', config('common.parent'));
        $this->categoriesChild = $this->categoryRepository->all();
        $this->totalCartItems = Cart::count();
        $this->productCarts = Cart::content();
        $this->totalPrice = Cart::subtotal();
    }

    public function compose(View $view)
    {
        $view->with([
            'categoriesParent' => $this->categoriesParent,
            'categoriesChild' => $this->categoriesChild,
            'totalCartItems' => $this->totalCartItems,
            'productCarts' => $this->productCarts,
            'totalPrice' => $this->totalPrice,
        ]);
    }
}
