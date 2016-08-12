<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use app\Http\SuggestRequests;
use Cloudder;
use Auth;
use App\Repositories\Suggest\SuggestRepositoryInterface;
use App\Repositories\Suggest\SuggestRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class SuggestController extends Controller
{
    private $suggestRepository;
    private $categoryRepository;

    public function __construct(SuggestRepositoryInterface $suggestRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->suggestRepository = $suggestRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listCategories = $this->categoryRepository->listCategories();

        return view('product.suggest', compact('listCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suggest = $request->only('category_id', 'name', 'price', 'description');

        if ($request->hasFile('image')) {
            $fileName = $request->image;
            Cloudder::upload($fileName, config('common.path_cloud_product') . $request->name);
            $suggest['image'] = Cloudder::getResult()['url'];
        }
        $suggest['user_id'] = Auth::user()->id;

        try {
            $this->suggestRepository->store($suggest);

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('home')->withError($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
