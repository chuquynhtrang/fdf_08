<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Response;
use App\Http\Requests\LoginRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Category;
use Session;

class HomeController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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

        return view('home' , compact('categoriesParent', 'categoriesChild'));
    }

    public function changeLanguage($lang)
    {
        Session::put('lang', $lang);
        return redirect()->back();
    }
}
