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

    public function all()
    {
        $limit = isset($options['limit']) ? $options['limit'] : config('common.base_repository.limit');
        $categories = $this->model->paginate($limit);

        return $categories;
    }

    public function listCategories()
    {
        $listCategories = Category::pluck('name', 'id')->all();

        return $listCategories;
    }
}
