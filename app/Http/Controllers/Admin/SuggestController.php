<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Suggest\SuggestRepositoryInterface;
use App\Repositories\Suggest\SuggestRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use Cloudder;

class SuggestController extends Controller
{
    private $suggestRepository;
    private $categoryRepository;
    private $productRepository;

    public function __construct(SuggestRepositoryInterface $suggestRepository, CategoryRepositoryInterface $categoryRepository, ProductRepositoryInterface $productRepository)
    {
        $this->suggestRepository = $suggestRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestProduct = $this->suggestRepository->all();

        return view('suggest.index', compact('suggestProduct'));
    }

    public function storeProduct(Request $request)
    {
        $addProduct = $request->only('name', 'description', 'price', 'status', 'quantity', 'rating', 'category_id');

        if ($request->hasFile('image')) {
            $fileName = $request->image;
            Cloudder::upload($fileName, config('common.path_cloud_product') . $request->name);
            $addProduct['image'] = Cloudder::getResult()['url'];
        }

        $suggestId = $request->suggest_id;

        try {
            $this->productRepository->store($addProduct);

            $this->suggestRepository->delete($suggestId);

            return redirect()->route('admin.products.index');
        } catch (Exception $e) {

            return redirect()->route('admin.products.index')->withError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suggestProduct = $this->suggestRepository->find($id);
        $listCategories = $this->categoryRepository->listCategories();

        return view('suggest.edit', compact('suggestProduct', 'listCategories'));
    }

    public function destroy($id)
    {
        try {
            $this->suggestRepository->delete($id);

            return redirect()->route('admin.suggests.index');
        } catch (Exception $e) {
            return redirect()->route('admin.suggests.index')->withError($e->getMessage());
        }
    }
}
