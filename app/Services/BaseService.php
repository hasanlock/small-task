<?php
namespace App\Services;

use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

/**
 *
 */
abstract class BaseService
{
    protected $models;

    public function __construct()
    {
        $this->models = [];
    }

    /**
     * buildModel takes a model class name, create the class and saves it in-momery
     *
     * @param  string $modelClass class to resolve
     * @return array              returns the models collection
     */
    protected function buildModel($modelClass): Model
    {
        $model = app()->make($modelClass);

        if (!$model instanceof Model) {
            throw new \Exception('model_not_found', 500);
        }

        return $model;
    }

    /**
     * setModel sets models to a model tag supplied
     *
     * @param Model $model Illuminate\Database\Eloquent\Model
     * @param string $tag Model tag to bind
     * @return void
     */
    public function setModel(Model $model, string $tag): void
    {
        $this->models[$tag] = $model;
    }

    /**
     * getModelOf gets the reolved model class or throws exception
     *
     * @param  string $tag named tag of the model
     * @return Model       Model stored against the tag
     */
    protected function getModelOf($tag)
    {
        if (empty($tag)) {
            throw new \Exception('Required model tag missing', 500);
        }

        if (!array_key_exists($tag, $this->models)) {
            throw new \Exception('Model not initiated', 500);
        }

        return $this->models[$tag];
    }

    /**
     * array utility function
     * takes an array and return only those keys
     * listed in $only
     *
     * @param array $data
     * @param array $only
     * @return array
     */
    protected function arrayOnly($data, $only)
    {
        $returnData = [];
        array_filter($data, function ($value, $key) use ($only, &$returnData) {
            if (in_array($key, $only)) {
                $returnData[$key] = $value;
            }
        }, ARRAY_FILTER_USE_BOTH);
        return $returnData;
    }

    /**
     * array utility function
     * takes an array and return only those keys
     * not listed in $except
     *
     * @param array $data
     * @param array $except
     * @return array
     */
    protected function arrayExcept($data, $except)
    {
        $returnData = [];
        array_filter($data, function ($value, $key) use ($except, &$returnData) {
            if (!in_array($key, $except)) {
                $returnData[$key] = $value;
            }
        }, ARRAY_FILTER_USE_BOTH);
        return $returnData;
    }

    /**
     * does URL encode on array values for string values
     * multi-dimensional array might not support
     *
     * @param array $data
     * @return array
     */
    protected function arrayUrlDecode($data)
    {
        return array_map(function ($value) {
            $_value = is_string($value) ? urldecode($value) : $value;
            return $_value;
        }, $data);
        return $data;
    }

    /**
     * getFillables gets the fillable table columns as array
     *
     * @param Model $mdlCls
     * @return void
     */
    protected function getFillables(Model $mdlCls): array
    {
        $reflection = new ReflectionClass($mdlCls);
        $property = $reflection->getProperty('fillable');
        $property->setAccessible(true);
        
        $fillable = $property->getValue($mdlCls);
        return $fillable;
    }
}
