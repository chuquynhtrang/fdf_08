<?php 

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use Exception;
use Auth;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user) 
    {
        $this->model = $user;
    }
}
