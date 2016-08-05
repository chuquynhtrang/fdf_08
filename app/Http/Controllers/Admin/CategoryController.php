<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Excel;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->categoryExceptParent(config('common.paginate'), config('common.parent'));

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category['name'] = $request->name;
        $parent_id = $request->parent_id;
        $category['parent_id'] = intval($parent_id);
        $this->categoryRepository->store($category);

        return redirect()->route('admin.categories.index');
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
        $category = $this->categoryRepository->find($id);

        return view('admin.category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $requestOnly = $request->only('name', 'parent_id');
        $this->categoryRepository->update($requestOnly, $id);

        return redirect()->route('admin.categories.index');
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
        $this->categoryRepository->delete($ids);

        return redirect()->route('admin.categories.index');
    }

    public function importExcel(Request $request)
    {
        if ($request->hasFile('fileCategory')) {
            $path = $request->file('fileCategory')->getRealPath();
            $categoryExcel = Excel::load($path)->get();
            if (!empty($categoryExcel) && $categoryExcel->count()) {
                foreach ($categoryExcel as $key => $value) {
                    $insert[] = ['name' => $value->name, 'parent_id' => $value->parent_id];
                }
                if (!empty($insert)) {
                    $this->categoryRepository->insert($insert);
                }
            }
        }
        return redirect()->route('admin.categories.index');
    }

    public function downloadExcel($type)
    {
        $data  = Category::get()->toArray();

        return Excel::create('fileDownloadCategory', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
