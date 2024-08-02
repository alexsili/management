<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;


    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(Model $model, array $attributes)
    {
        return $model->update($attributes);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }
}