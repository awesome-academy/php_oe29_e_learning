<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Create polymorphic
     * @param $id
     * @param $relation
     * @param array $attributes
     * @return mixed
     */
    public function createPolymorphic($id, $relation, $attributes = []);

    /**
     * Load relations
     * @param $id
     * @param array $relation
     * @return mixed
     */
    public function loadRelations($id, $relations = []);
}