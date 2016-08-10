<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Cloudder;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->all();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listCategories = $this->categoryRepository->listCategories();

        return view('admin.product.create', compact('listCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $request->only('name', 'description', 'price', 'status', 'quantity', 'rating', 'category_id');

        if ($request->hasFile('image')) {
            $fileName = $request->image;
            Cloudder::upload($fileName, config('common.path_cloud_product') . "$request->name");
            $product['image'] = Cloudder::getResult()['url'];
        }

        try {
            $data = $this->productRepository->store($product);

            return redirect()->route('admin.products.index');
        } catch (Exception $e) {

            return redirect()->route('admin.products.index')->withError($e->getMessage());
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
        $product = $this->productRepository->find($id);
        $listCategories = $this->categoryRepository->listCategories();

        return view('admin.product.edit', compact('product', 'listCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $request->only('name', 'description', 'price', 'status', 'quantity', 'rating', 'category_id');

        if ($request->hasFile('image')) {
            $fileName = $request->image;
            Cloudder::upload($fileName, config('common.path_cloud_product')."$request->name");
            $product['image'] = Cloudder::getResult()['url'];
        }

        try {
            $data = $this->productRepository->update($product, $id);

            return redirect()->route('admin.products.index');
        } catch (Exception $e) {

            return redirect()->route('admin.products.index')->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->checkbox;

        try {
            $data = $this->productRepository->delete($ids);

            return redirect()->route('admin.products.index');
        } catch (Exception $e) {

            return redirect()->route('admin.products.index')->withError($e->getMessage());
        }
    }
}
