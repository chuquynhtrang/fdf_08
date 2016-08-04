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

    public function all()
    {
        $limit = isset($options['limit']) ? $options['limit'] : config('common.base_repository.limit');
        $products = $this->model->paginate($limit);

        return $products;
    }
}
