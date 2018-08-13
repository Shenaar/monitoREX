<?php

namespace App\Repositories;

use App\Models\AbstractModel;

/**
 *
 */
abstract class EloquentRepository
{
    /**
     * @var AbstractModel
     */
    protected $model;

    /**
     * @param AbstractModel $model
     */
    public function __construct(AbstractModel $model = null)
    {
        $this->model = $model ? : $this->getModel();

        if (!$this->model instanceof AbstractModel) {
            throw new \InvalidArgumentException('Model should be an instance of AbstractModel');
        }
    }

    /**
     * @param int $id
     *
     * @return AbstractModel
     */
    public function find($id)
    {
        $id = (int) $id;

        return  $this->model->find($id);
    }

    /**
     * @param AbstractModel $model
     *
     * @return AbstractModel
     *
     * @throws \InvalidArgumentException
     */
    public function create($model)
    {
        if (get_class($model) !== get_class($this->model)) {
            throw new \InvalidArgumentException();
        }

        $model->save();

        return $model;
    }

    /**
     * @param AbstractModel $model
     *
     * @return AbstractModel
     *
     * @throws \InvalidArgumentException
     */
    public function update($model)
    {
        if (get_class($model) !== get_class($this->model)) {
            throw new \InvalidArgumentException();
        }

        $model->save();

        return $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQuery()
    {
        return $this->model->newQuery();
    }

    /**
     * @return AbstractModel
     */
    private function getModel()
    {
        $reflection = new \ReflectionClass($this);

        $modelClass = str_replace('Repository', '', $reflection->getShortName());

        return app('\\App\\Models\\' . $modelClass);
    }
}
