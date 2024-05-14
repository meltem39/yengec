<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class EloquentBaseRepository.
 */
class EloquentBaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }



    public function authUser(){
        $user = auth()->guard('api')->user();
        return $user;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }


}
