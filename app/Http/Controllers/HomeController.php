<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Models\User;
use Response;
use App\Http\Requests\LoginRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Category;

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
        try { 
            $categoriesParent = $this->categoryRepository->findBy('parent_id', config('common.path_parent'));
            $categoriesChild = $this->categoryRepository->all();
        } catch (Exception $ex) {
            return redirect()->route('home')->withError($ex->getMessage());
        }
        
        return view('home' , compact('categoriesParent', 'categoriesChild'));
    }
}
