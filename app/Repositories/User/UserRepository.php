<?php
namespace App\Repositories\User;

use Auth;
use App\Models\User;
use App\Repositories\BaseRepository;
Use App\Repositories\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
        $limit = isset($options['limit']) ? $options['limit'] : config('common.base_repository.limit');
        $users = $this->model->paginate($limit);

        return $users;
    }
}
