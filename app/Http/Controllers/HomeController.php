<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Response;
use App\Http\Requests\LoginRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use Session;

class HomeController extends Controller
{
    private $categoryRepository;
    private $productRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesParent = $this->categoryRepository->findBy('parent_id', config('common.parent'));
        $categoriesChild = $this->categoryRepository->all();

        $products = $this->productRepository->paginate(config('common.items_per_page'));

        return view('home' , compact('categoriesParent', 'categoriesChild', 'products'));
    }

    public function changeLanguage($lang)
    {
        Session::put('lang', $lang);
        return redirect()->back();
    }
}
