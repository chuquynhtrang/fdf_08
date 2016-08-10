<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Response;
use App\Http\Requests\LoginRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\LineItem\LineItemRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use Session;
use Cart;

class HomeController extends Controller
{
    private $categoryRepository;
    private $productRepository;
    private $lineItemRepository;
    private $categoriesParent;
    private $categoriesChild;
    private $totalCartItems;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        LineItemRepositoryInterface $lineItemRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->lineItemRepository = $lineItemRepository;
        $this->categoriesParent = $this->categoryRepository->findBy('parent_id', config('common.parent'));
        $this->categoriesChild = $this->categoryRepository->all();
        $this->totalCartItems = Cart::count();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->paginate(config('common.items_per_page'));

        $categoriesParent = $this->categoriesParent;
        $categoriesChild = $this->categoriesChild;
        $totalCartItems = $this->totalCartItems;
        return view('home' , compact('categoriesParent', 'categoriesChild', 'products', 'totalCartItems'));
    }

    public function changeLanguage($lang)
    {
        Session::put('lang', $lang);
        return redirect()->back();
    }

    public function getLink($link)
    {
        $categories = $this->categoryRepository->findBy('link', $link);
        foreach ($categories as $category) {
            $products = $this->productRepository->findBy('category_id', $category->id);
        }

        $categoriesParent = $this->categoriesParent;
        $categoriesChild = $this->categoriesChild;
        $totalCartItems = $this->totalCartItems;

        return view('home' , compact('categories', 'categoriesParent', 'categoriesChild', 'products', 'totalCartItems'));
    }

    public function bestPrice()
    {
        $products = $this->productRepository->orderBy('price', 'asc');
        $categoriesParent = $this->categoriesParent;
        $categoriesChild = $this->categoriesChild;
        $totalCartItems = $this->totalCartItems;
        
        return view('home' , compact('categoriesParent', 'categoriesChild', 'products', 'totalCartItems'));
    }

    public function bestSelling()
    {
        $products = $this->lineItemRepository->orderByBestSelling();
        $categoriesParent = $this->categoriesParent;
        $categoriesChild = $this->categoriesChild;
        $totalCartItems = $this->totalCartItems;

        return view('home' , compact('categoriesParent', 'categoriesChild', 'products', 'totalCartItems'));
    }
}
