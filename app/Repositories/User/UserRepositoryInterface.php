<?php
namespace App\Repositories\User;

interface UserRepositoryInterface
{

    public function lists($column, $key = null);
    public function create($inputs);
    public function insert($inputs);
    public function delete($ids);
    public function search($column, $value);
    public function update($inputs, $id);
    public function find($id);
    public function paginate($limit);
    public function store($inputs);

}
