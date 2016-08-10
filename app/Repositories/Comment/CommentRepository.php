<?php

namespace App\Repositories\Comment;

use Auth;
use App\Models\Comment;
use App\Repositories\BaseRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Models\User;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function all()
    {
        $limit = isset($options['limit']) ? $options['limit'] : config('common.base_repository.limit');
        $comments = $this->model->paginate($limit);

        return $comments;
    }

    public function showComment($id)
    {
        $comments = $this->model->with('user')->where('product_id', $id)->get();

        return $comments;
    }
}

