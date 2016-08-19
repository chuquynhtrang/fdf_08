<?php

namespace App\Repositories\Product;

use Auth;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function findBy($column, $option)
    {
        $data = $this->model->where($column, $option)->paginate(config('common.items_per_page'));

        if (!$data) {
            throw new Exception(trans('message.find_error'));
        }

        return $data;
    }

    public function orderBy($column, $option)
    {
        return $this->model->orderBy($column, $option)->paginate(config('common.items_per_page'));
    }
}
