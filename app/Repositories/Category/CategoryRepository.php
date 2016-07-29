<?php 

namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Models\Category;
use Exception;
use Auth;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category) 
    {
        $this->model = $category;
    }
}
