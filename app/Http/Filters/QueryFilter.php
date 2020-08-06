<?php 

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    /***
     * This class is built with the Adapter Pattern in mind.
     * The QueryFilter class provides a way for query filters to be appended to our requests in a more efficient and
     * cleaner way. It checks parameters passed through the Request objects and append builder queries on the go.
     * 
     */
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->fields() as $field => $value) {
            $method = $field;
            if (method_exists($this, $method) && $value !== null) {
                call_user_func_array([$this, $method], [$value]);
            }
        }

        return $this->builder;
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return $this->request->all();
       
    }
}