<?php

namespace App\Repositories\Category;

use Auth;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function categoryExceptParent($limit, $id)
    {
    	return $this->model->where('parent_id', '<>', $id)->paginate($limit);
    }
}
