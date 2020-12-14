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

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }
    
    public function getAll($relations = [], $paginate = 0)
    {
        
        if ($paginate) {
            return $this->model->with($relations)->paginate($paginate);
        }

        return $this->model->with($relations)->get();
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
    
    public function update($id, $attributes = [])
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }
    
    public function delete($id)
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function createPolymorphic($id, $relation, $attributes = [])
    {
        $result = $this->model->find($id);

        return $result ? $result->$relation()->create($attributes) : false;
    }

    public function updatePolymorphic($id, $relation, $attributes = [])
    {
        $result = $this->model->find($id);

        return $result ? $result->$relation()->update($attributes) : false;
    }

    public function loadRelations($id, $relations = [])
    {
        $result = $this->model->find($id);

        return $result ? $result->load($relations) : false;
    }

    public function updateWithWhere($conditionAttributes = [], $updateAttributes = [])
    {
        return $this->model->where($conditionAttributes)->update($updateAttributes) ? true : false;
    }

    public function getAllWithWhere($relations = [], $conditionAttributes = [])
    {
        return $this->model->with($relations)->where($conditionAttributes)->get();
    }
}
