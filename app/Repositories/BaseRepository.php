<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {

        return $this->model->all();
    }

    public function getByPaginate($limit)
    {
        
        return $this->model->paginate($limit);
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {

        return $this->model->create($attributes);
    }

    public function update($model, $attributes = [])
    {

        return $model->update($attributes);
    }

    public function delete($model)
    {

        return $model->delete();
    }
}
