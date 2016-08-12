<?php

namespace App\Repositories\Suggest;

use Auth;
use App\Models\Suggest;
use App\Repositories\BaseRepository;
use App\Repositories\Suggest\SuggestRepositoryInterface;

class SuggestRepository extends BaseRepository implements SuggestRepositoryInterface
{
    public function __construct(Suggest $suggest)
    {
        $this->model = $suggest;
    }

    public function all()
    {
        $limit = isset($options['limit']) ? $options['limit'] : config('common.base_repository.limit');
        $suggests = $this->model->paginate($limit);

        return $suggests;
    }
}
