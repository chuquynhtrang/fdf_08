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

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        LineItemRepositoryInterface $lineItemRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->lineItemRepository = $lineItemRepository;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->paginate(config('common.items_per_page'));
 
        return view('home', compact('products'));
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

        return view('home', compact('products'));
    }

    public function bestPrice()
    {
        $products = $this->productRepository->orderBy('price', 'asc');
        
        return view('home' , compact('products'));
    }

    public function bestSelling()
    {
        $products = $this->lineItemRepository->orderByBestSelling();

        return view('home' , compact('products'));
    }
}
