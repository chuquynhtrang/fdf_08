<?php
/**
* Base Repository 
*/

namespace App\Repositories;

use Exception;
use DB;
use Carbon\Carbon;

abstract class BaseRepository
{
    protected $model;

    public function count()
    {
        return $this->model->count();
    }

    public function all() 
    {
        return $this->model->all();
    }
    public function find($id) 
    {
        return $this->model->find($id);
    }

    public function findBy($column, $option) 
    {
        return $this->model->where($column, $option)->get();
    }
    
    public function paginate($limit)
    {
        $paginate = $limit ? $limit : config('common.paginate');
        
        return $this->model->paginate($paginate); 
    }

    public function lists($column, $key = null)
    {
        return $this->model->lists($column, $key);
    }

    public function create($inputs)
    {
        return $this->model->create($inputs);
    }

    public function insert($inputs)
    {
        $now = Carbon::now();
        foreach ($inputs as $input) {
            $input['created_at'] = $now;
            $input['updated_at'] = $now;
        }

        return $this->model->insert($inputs);
    }

    public function update($inputs, $id) 
    {
        return $this->model->where('id', $id)->update($inputs);
    }

    public function delete($ids)
    {
        foreach ($ids as $id)
            $data = $this->model->destroy($id);
        
        return $data;
    }

    public function search($column, $value)
    {
        return $this->model->where('$column LIKE $value');
    }
}
