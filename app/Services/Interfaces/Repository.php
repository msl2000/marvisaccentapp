<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
     /**
     * Get all objects functionality 
     *
     * @param  App\Http\Filters\QueryFilter
     * @return Illuminate\Database\Eloquent\Model|null|mixed
     */
    public function all($filters);
    /**
     * Create functionality 
     *
     * @param  mixed  $identifier
     * @return Illuminate\Database\Eloquent\Model|null|mixed
     */
    public function create($request);
     /**
     * Read functionality 
     *
     * @param  Illuminate\Database\Eloquent\Model|Request
     * @return Illuminate\Database\Eloquent\Model|null|mixed
     */
    public function read($object);
      /**
     * Read functionality 
     *
     * @param  Illuminate\Http\Request
     * @param  Illuminate\Database\Eloquent\Model
     * @return Illuminate\Database\Eloquent\Model|null|mixed
     */
    public function update($request, $object);
    /**
     * Read functionality 
     *
     * @return null
     */
    public function delete($object);
}
